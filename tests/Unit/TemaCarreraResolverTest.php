<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Services\TemaCarreraResolver;
use Closure;
use Illuminate\Auth\GenericUser;
use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Contracts\Config\Repository as Configuration;
use Illuminate\Database\Connection;
use Illuminate\Database\ConnectionResolverInterface;
use Illuminate\Database\QueryException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/** No inicia Laravel, PDO, migraciones, seeders ni una base de datos en memoria. */
class TemaCarreraResolverTest extends TestCase
{
    public static function institutionalCareers(): array
    {
        return [
            [1, 'Licenciatura en Administración', 'administracion'],
            [2, 'Ingeniería en Sistemas Computacionales', 'ingenieria-sistemas'],
            [3, 'Arquitectura', 'arquitectura'],
            [4, 'Ingeniería Eléctrica', 'ingenieria-electrica'],
            [5, 'Ingeniería Industrial', 'ingenieria-industrial'],
            [6, 'Ingeniería Forestal', 'ingenieria-forestal'],
            [7, 'Licenciatura en Gastronomía', 'gastronomia'],
            [8, 'Licenciatura en Turismo', 'turismo'],
            [13, 'Ingeniería Mecatrónica', 'ingenieria-mecatronica'],
            [14, 'Ingeniería Civil', 'ingenieria-civil'],
        ];
    }

    public static function validNames(): iterable
    {
        foreach (self::institutionalCareers() as [$id, $name, $key]) {
            yield $key.' original' => [$id, $name, $key];
            yield $key.' mayúsculas' => [$id, mb_strtoupper($name, 'UTF-8'), $key];
            yield $key.' minúsculas sin acentos' => [$id, strtr(mb_strtolower($name, 'UTF-8'), ['á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u']), $key];
            yield $key.' espacios y saltos' => [$id, " \t".str_replace(' ', " \n\t ", $name)."\n ", $key];
            yield $key.' espacios Unicode' => [$id, "\u{00A0}".str_replace(' ', "\u{00A0}\u{2003}", $name)."\u{00A0}", $key];
            yield $key.' acentos descompuestos' => [$id, strtr($name, ['á' => "a\u{0301}", 'é' => "e\u{0301}", 'í' => "i\u{0301}", 'ó' => "o\u{0301}", 'ú' => "u\u{0301}"]), $key];
        }
    }

    #[DataProvider('validNames')]
    public function test_real_id_and_normalized_full_name_resolve_the_correct_identity(int $id, string $name, string $key): void
    {
        $result = $this->resolver([self::row($id, $name)])->para($this->user());

        $this->assertTrue($result['matched']);
        $this->assertSame($id, $result['career_id']);
        $this->assertSame($key, $result['key']);
        $this->assertSame('img/login/hurones/'.$key.'.webp', $result['image']);
        $this->assertSame(self::settings()['careers'][$id]['name'], $result['name']);
        $this->assertSame(self::settings()['careers'][$id]['primary'], $result['primary']);
        $this->assertArrayNotHasKey('aliases', $result);
    }

    public static function fictitiousSeederRows(): iterable
    {
        // Leer los datos declarados sin instanciar ni ejecutar el seeder.
        $source = file_get_contents(dirname(__DIR__, 2).'/database/seeders/GnralCarrerasSeeder.php');
        preg_match_all("/'id_carrera'\s*=>\s*(\d+).*?'nombre'\s*=>\s*'([^']+)'/s", $source, $matches, PREG_SET_ORDER);
        if ($matches === []) {
            throw new \LogicException('No se encontraron los registros declarados en GnralCarrerasSeeder.');
        }

        foreach ($matches as $match) {
            yield 'seeder ID '.$match[1] => [(int) $match[1], $match[2]];
        }
    }

    #[DataProvider('fictitiousSeederRows')]
    public function test_current_fictitious_seeder_pairs_do_not_receive_institutional_identities(int $id, string $name): void
    {
        $this->assertNeutral(
            $this->resolver([self::row($id, $name)])->para($this->user()),
            'career_name_mismatch',
        );
    }

    public static function mismatchedNames(): iterable
    {
        $careers = self::institutionalCareers();
        foreach ($careers as $index => [$id, $name]) {
            yield 'ID '.$id.' con nombre de otra carrera' => [$id, $careers[($index + 1) % count($careers)][1]];
        }

        yield 'Civil con ID ficticio de Arquitectura' => [3, 'Ingeniería Civil'];
        yield 'Sistemas con ID ficticio de Administración' => [1, 'Ingeniería en Sistemas Computacionales'];
        yield 'Electrónica no equivale a Eléctrica' => [4, 'Ingeniería Electrónica'];
        yield 'Gestión Empresarial no equivale a Administración' => [1, 'Ingeniería en Gestión Empresarial'];
    }

    #[DataProvider('mismatchedNames')]
    public function test_id_alone_or_name_alone_cannot_select_an_identity(int $id, string $name): void
    {
        $this->assertNeutral($this->resolver([self::row($id, $name)])->para($this->user()), 'career_name_mismatch');
    }

    public static function ambiguousNames(): iterable
    {
        yield 'abreviatura' => [2, 'ISC'];
        yield 'nombre parcial' => [2, 'Ingeniería en Sistemas'];
        yield 'sufijo agregado' => [1, 'Licenciatura en Administración de Empresas'];
        yield 'dos carreras' => [3, 'Arquitectura e Ingeniería Civil'];
        yield 'alias sin confirmar' => [13, 'Ingeniería en Mecatrónica'];
        yield 'separador distinto de espacio' => [4, 'Ingeniería-Eléctrica'];
        yield 'texto adicional' => [8, 'Licenciatura en Turismo (pruebas)'];
    }

    #[DataProvider('ambiguousNames')]
    public function test_partial_ambiguous_and_unconfirmed_denominations_are_not_inferred(int $id, string $name): void
    {
        $this->assertNeutral($this->resolver([self::row($id, $name)])->para($this->user()), 'career_name_mismatch');
    }

    public function test_only_an_explicitly_configured_alias_is_accepted_for_its_own_id(): void
    {
        $settings = self::settings();
        // Alias exclusivo del doble de prueba; el catálogo entregado no lo presupone confirmado.
        $settings['careers'][13]['aliases'] = ['Ingeniería en Mecatrónica'];
        $result = $this->resolver([self::row(13, ' INGENIERIA EN MECATRONICA ')], settings: $settings)->para($this->user());
        $this->assertSame('ingenieria-mecatronica', $result['key']);
        $this->assertTrue($result['matched']);

        $this->assertNeutral(
            $this->resolver([self::row(14, 'Ingeniería en Mecatrónica')], settings: $settings)->para($this->user()),
            'career_name_mismatch',
        );
    }

    public static function incompleteData(): iterable
    {
        yield 'sin ficha' => [[], 'missing_student'];
        yield 'dos fichas de carreras diferentes' => [[self::row(2, 'Ingeniería en Sistemas Computacionales'), self::row(3, 'Arquitectura')], 'ambiguous_student'];
        yield 'dos fichas con la misma carrera' => [[self::row(2, 'Ingeniería en Sistemas Computacionales'), self::row(2, 'Ingeniería en Sistemas Computacionales')], 'ambiguous_student'];
        yield 'ficha sin identificador' => [[(object) ['id_carrera' => 2, 'catalogo_id' => 2, 'nombre' => 'Ingeniería en Sistemas Computacionales']], 'incomplete_student'];
        yield 'carrera nula' => [[self::row(null, null)], 'missing_career'];
        yield 'carrera cero' => [[self::row(0, 'Arquitectura')], 'missing_career'];
        yield 'carrera negativa' => [[self::row(-3, 'Arquitectura')], 'missing_career'];
        yield 'ID no entero' => [[self::row('2sistemas', 'Ingeniería en Sistemas Computacionales')], 'missing_career'];
        yield 'ID booleano' => [[self::row(true, 'Licenciatura en Administración')], 'missing_career'];
        yield 'ID decimal' => [[self::row(2.5, 'Ingeniería en Sistemas Computacionales')], 'missing_career'];
        yield 'ID fuera del rango entero' => [[self::row('9999999999999999999999999', 'Arquitectura')], 'missing_career'];
        yield 'carrera ajena a las diez configuradas' => [[self::row(999, 'Arquitectura')], 'unknown_career'];
        yield 'ID no institucional 9' => [[self::row(9, 'Ingeniería Civil')], 'unknown_career'];
        yield 'nombre nulo' => [[self::row(2, null)], 'missing_career_name'];
        yield 'nombre vacío' => [[self::row(2, " \t\n\u{00A0}")], 'missing_career_name'];
        yield 'nombre numérico' => [[self::row(2, 2)], 'missing_career_name'];
        yield 'nombre no escalar' => [[self::row(2, ['Sistemas'])], 'missing_career_name'];
        yield 'nombre con codificación inválida' => [[self::row(2, "Ingenier\xEDa en Sistemas Computacionales")], 'missing_career_name'];
        yield 'referencia al catálogo inexistente' => [[(object) ['id_alumno' => 701, 'id_carrera' => 2, 'catalogo_id' => null, 'nombre' => null]], 'missing_career'];
        yield 'IDs académico y de catálogo distintos' => [[(object) ['id_alumno' => 701, 'id_carrera' => 2, 'catalogo_id' => 3, 'nombre' => 'Arquitectura']], 'missing_career'];
    }

    #[DataProvider('incompleteData')]
    public function test_incomplete_or_ambiguous_academic_data_falls_back_without_errors(array $rows, string $reason): void
    {
        $this->assertNeutral($this->resolver($rows)->para($this->user()), $reason);
    }

    public static function nonStudents(): iterable
    {
        yield 'invitado' => [null];
        foreach ([2, '2', 0, 3, 99, null, true, false, 1.0, '1admin'] as $index => $type) {
            yield 'perfil no alumno '.$index => [new GenericUser(['id' => 42, 'tipo_usuario' => $type])];
        }
        yield 'sin tipo de usuario' => [new GenericUser(['id' => 42])];
    }

    #[DataProvider('nonStudents')]
    public function test_staff_teachers_other_profiles_and_guests_always_use_neutral_without_queries(?\Illuminate\Contracts\Auth\Authenticatable $user): void
    {
        $this->assertNeutral($this->resolver([], queries: 0)->para($user), 'not_student');
    }

    public static function invalidUserIds(): iterable
    {
        foreach ([null, 0, -1, 'otro', '42 OR 1=1', true, 42.5] as $index => $id) {
            yield 'identificador '.$index => [$id];
        }
    }

    #[DataProvider('invalidUserIds')]
    public function test_invalid_user_identity_never_reaches_the_database(mixed $id): void
    {
        $this->assertNeutral($this->resolver([], queries: 0)->para($this->user($id)), 'invalid_user_id');
    }

    public function test_numeric_strings_from_pdo_are_supported(): void
    {
        $result = $this->resolver([self::row('2', 'Ingeniería en Sistemas Computacionales')])->para($this->user('42', '1'));
        $this->assertTrue($result['matched']);
        $this->assertSame(2, $result['career_id']);
    }

    public function test_legacy_and_current_user_models_are_supported_without_saving_them(): void
    {
        foreach ([\App\User::class, \App\Models\User::class] as $class) {
            $user = new $class;
            $user->setRawAttributes(['id' => 42, 'tipo_usuario' => 1]);
            $this->assertTrue($this->resolver([self::row(3, 'Arquitectura')])->para($user)['matched']);
            $this->assertFalse($user->exists);
        }
    }

    public function test_repeated_resolutions_reuse_one_select_including_negative_results(): void
    {
        foreach ([[self::row(2, 'Ingeniería en Sistemas Computacionales')], [], [self::row(2, 'Arquitectura')]] as $rows) {
            $resolver = $this->resolver($rows);
            $first = $resolver->para($this->user());
            $this->assertSame($first, $resolver->para($this->user()));
            $this->assertSame($first, $resolver->para($this->user('42', '1')));
        }
    }

    public function test_request_cache_does_not_mix_different_accounts_or_override_a_staff_profile(): void
    {
        $database = $this->database(
            fn (array $bindings) => $bindings === [42]
                ? [self::row(2, 'Ingeniería en Sistemas Computacionales')]
                : [self::row(3, 'Arquitectura')],
            queries: 2,
            bindings: [[42], [43]],
        );
        $resolver = new TemaCarreraResolver($database, new Repository(['tesvb_themes' => self::settings()]));
        $this->assertSame('ingenieria-sistemas', $resolver->para($this->user())['key']);
        $this->assertSame('arquitectura', $resolver->para($this->user(43))['key']);
        $this->assertNeutral($resolver->para($this->user(42, 2)), 'not_student');
    }

    public function test_laravel_reuses_the_scoped_resolver_and_refreshes_data_on_the_next_request(): void
    {
        $container = new Container;
        $container->instance(Configuration::class, new Repository(['tesvb_themes' => self::settings()]));
        $container->instance(ConnectionResolverInterface::class, $this->database(
            fn (array $bindings, int $call) => $call === 1
                ? [self::row(2, 'Ingeniería en Sistemas Computacionales')]
                : [self::row(3, 'Arquitectura')],
            queries: 2,
            bindings: [[42], [42]],
        ));

        $first = $container->make(TemaCarreraResolver::class);
        $this->assertSame('ingenieria-sistemas', $first->para($this->user())['key']);
        $sameRequest = $container->make(TemaCarreraResolver::class);
        $this->assertSame($first, $sameRequest);
        $this->assertSame('ingenieria-sistemas', $sameRequest->para($this->user())['key']);
        $container->forgetScopedInstances();
        $nextRequest = $container->make(TemaCarreraResolver::class);
        $this->assertNotSame($first, $nextRequest);
        $this->assertSame('arquitectura', $nextRequest->para($this->user())['key']);
    }

    public function test_query_failures_are_neutral_and_are_not_retried_during_the_same_request(): void
    {
        $resolver = $this->resolver(static function (): array {
            throw new QueryException('themes', 'select ...', [], new \PDOException('Conexión no disponible'));
        });
        $this->assertNeutral($resolver->para($this->user()), 'database_error');
        $this->assertNeutral($resolver->para($this->user()), 'database_error');
    }

    public function test_the_catalog_is_available_if_an_older_config_cache_has_no_new_key(): void
    {
        $resolver = new TemaCarreraResolver($this->database([self::row(2, 'Ingeniería en Sistemas Computacionales')]), new Repository);
        $this->assertSame('ingenieria-sistemas', $resolver->para($this->user())['key']);
    }

    public function test_database_colors_and_extra_attributes_cannot_override_the_central_theme(): void
    {
        $row = self::row(2, 'Ingeniería en Sistemas Computacionales');
        $row->COLOR = 'url(https://example.invalid/tema)';
        $row->image = 'otra-imagen.webp';
        $result = $this->resolver([$row])->para($this->user());
        $this->assertSame('#EF930A', $result['primary']);
        $this->assertSame('img/login/hurones/ingenieria-sistemas.webp', $result['image']);
        $this->assertArrayNotHasKey('COLOR', $result);
    }

    public function test_configuration_contains_exactly_the_ten_institutional_ids_and_existing_local_assets(): void
    {
        $settings = self::settings();
        $this->assertSame([1, 2, 3, 4, 5, 6, 7, 8, 13, 14], array_keys($settings['careers']));
        $keys = [];
        foreach ([$settings['neutral'], ...array_values($settings['careers'])] as $theme) {
            foreach (['primary', 'secondary', 'foreground'] as $color) {
                $this->assertMatchesRegularExpression('/\A#[0-9A-F]{6}\z/', $theme[$color]);
            }
            $this->assertStringNotContainsString('://', $theme['image']);
            $this->assertStringNotContainsString('..', $theme['image']);
            $file = dirname(__DIR__, 2).'/public/'.$theme['image'];
            $this->assertFileExists($file);
            $this->assertNotFalse(getimagesize($file));
            $keys[] = $theme['key'];
        }
        $this->assertCount(11, array_unique($keys));
    }

    private static function settings(): array
    {
        return require dirname(__DIR__, 2).'/config/tesvb_themes.php';
    }

    private static function row(mixed $id, mixed $name): object
    {
        return (object) ['id_alumno' => 701, 'id_carrera' => $id, 'catalogo_id' => $id, 'nombre' => $name];
    }

    private function user(mixed $id = 42, mixed $type = 1): GenericUser
    {
        return new GenericUser(['id' => $id, 'tipo_usuario' => $type]);
    }

    private function resolver(array|Closure $rows, int $queries = 1, ?array $settings = null): TemaCarreraResolver
    {
        return new TemaCarreraResolver(
            $this->database($rows, $queries),
            new Repository(['tesvb_themes' => $settings ?? self::settings()]),
        );
    }

    private function database(array|Closure $rows, int $queries = 1, array $bindings = [[42]]): ConnectionResolverInterface
    {
        $connection = $this->getMockBuilder(Connection::class)
            ->setConstructorArgs([static fn () => throw new \LogicException('Prohibida una conexión PDO real.')])
            ->onlyMethods(['select', 'getPdo', 'getReadPdo'])
            ->getMock();
        $connection->expects($this->never())->method('getPdo');
        $connection->expects($this->never())->method('getReadPdo');
        $call = 0;
        $connection->expects($this->exactly($queries))->method('select')
            ->willReturnCallback(function (string $sql, array $parameters, bool $read) use ($rows, $bindings, &$call): array {
                $this->assertStringStartsWith('select ', strtolower($sql));
                $this->assertStringContainsString('gnral_alumnos', $sql);
                $this->assertStringContainsString('left join', $sql);
                $this->assertStringContainsString('gnral_carreras', $sql);
                $this->assertStringContainsString('limit 2', $sql);
                $this->assertSame($bindings[$call], $parameters);
                $this->assertTrue($read);
                $call++;

                return $rows instanceof Closure ? $rows($parameters, $call) : $rows;
            });
        $database = $this->createMock(ConnectionResolverInterface::class);
        $database->expects($this->exactly($queries))->method('connection')->willReturn($connection);

        return $database;
    }

    private function assertNeutral(array $result, string $reason): void
    {
        $this->assertSame('institucional', $result['key']);
        $this->assertNull($result['career_id']);
        $this->assertSame('assets/img/tes.png', $result['image']);
        $this->assertFalse($result['matched']);
        $this->assertSame($reason, $result['reason']);
    }
}
