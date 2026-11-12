<?php

namespace Tests\Unit;

use Illuminate\Container\Container;
use Illuminate\Database\ConnectionResolver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\MySqlConnection;
use Illuminate\Session\ArraySessionHandler;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Facade;
use PHPUnit\Framework\TestCase;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use RuntimeException;

/** Tests model metadata and query construction without booting Laravel or connecting to a database. */
class EloquentCompatibilityTest extends TestCase
{
    private function root(): string
    {
        return dirname(__DIR__, 2);
    }

    /** @return array<class-string<Model>, string> */
    private function models(): array
    {
        $models = [];
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($this->root().'/app'));

        foreach ($files as $file) {
            if ($file->getExtension() !== 'php') {
                continue;
            }

            // Tokenize first so comments and string literals cannot introduce fake model declarations.
            $source = '';
            foreach (token_get_all(file_get_contents($file->getPathname())) as $token) {
                $source .= is_array($token) && in_array($token[0], [T_COMMENT, T_DOC_COMMENT], true)
                    ? '' : (is_array($token) ? $token[1] : $token);
            }

            if (!preg_match('/class\s+(\w+)\s+extends\s+(?:Model|Authenticatable|Pivot)\b/', $source, $class)) {
                continue;
            }

            preg_match('/namespace\s+([^;]+);/', $source, $namespace);
            $name = $namespace[1].'\\'.$class[1];
            $this->assertArrayNotHasKey($name, $models, 'Duplicate model: '.$name);
            $models[$name] = $file->getPathname();
        }

        ksort($models);

        return $models;
    }

    public function test_all_models_autoload_with_their_existing_database_mapping(): void
    {
        $expected = json_decode(file_get_contents($this->root().'/tests/Fixtures/eloquent-metadata.json'), true, flags: JSON_THROW_ON_ERROR);
        ksort($expected);
        $models = $this->models();
        $this->assertSame(array_keys($expected), array_keys($models), 'Review the metadata fixture when models are added or removed.');

        foreach ($models as $class => $file) {
            $this->assertTrue(class_exists($class), 'PSR-4 autoload failed: '.$class);
            $reflection = new ReflectionClass($class);
            $this->assertSame(realpath($file), realpath($reflection->getFileName()), $class);
            $expectedFile = $this->root().'/app/'.str_replace('\\', '/', substr($class, 4)).'.php';
            $this->assertSame(str_replace('\\', '/', $expectedFile), str_replace('\\', '/', $file), $class);
            $model = new $class;
            $this->assertInstanceOf(Model::class, $model);
            $this->assertSame($expected[$class], [
                $model->getTable(), $model->getKeyName(), $model->usesTimestamps(),
                $model->getIncrementing(), $model->getKeyType(),
            ], $class);
        }
    }

    public function test_model_imports_and_static_class_references_resolve_without_global_aliases(): void
    {
        foreach ($this->models() as $class => $file) {
            $tokens = token_get_all(file_get_contents($file));
            $imports = [];
            foreach ($tokens as $i => $token) {
                if (!is_array($token) || $token[0] !== T_USE) {
                    continue;
                }
                $use = '';
                for ($j = $i + 1; isset($tokens[$j]) && $tokens[$j] !== ';'; $j++) {
                    $use .= is_array($tokens[$j]) ? $tokens[$j][1] : $tokens[$j];
                }
                $use = trim($use);
                // Trait uses inside classes are resolved by PHP itself, not namespace imports.
                if (!str_contains($use, '\\')) {
                    continue;
                }
                $parts = preg_split('/\s+as\s+/i', $use);
                $full = $parts[0];
                $short = $parts[1] ?? substr($full, strrpos($full, '\\') + 1);
                $imports[strtolower($short)] = $full;
                $this->assertTrue(class_exists($full) || interface_exists($full) || trait_exists($full), $class.' imports '.$full);
            }

            foreach ($tokens as $i => $token) {
                if (!is_array($token) || !in_array($token[0], [T_STRING, T_NAME_QUALIFIED, T_NAME_FULLY_QUALIFIED], true)) {
                    continue;
                }
                $j = $i + 1;
                while (isset($tokens[$j]) && is_array($tokens[$j]) && $tokens[$j][0] === T_WHITESPACE) {
                    $j++;
                }
                if (!isset($tokens[$j]) || !is_array($tokens[$j]) || $tokens[$j][0] !== T_DOUBLE_COLON) {
                    continue;
                }
                $name = $token[1];
                if (in_array(strtolower($name), ['self', 'static', 'parent'], true)) {
                    continue;
                }
                $namespace = substr($class, 0, strrpos($class, '\\'));
                $full = $imports[strtolower($name)] ?? (str_starts_with($name, '\\') ? ltrim($name, '\\') : $namespace.'\\'.$name);
                $this->assertTrue(class_exists($full) || interface_exists($full) || trait_exists($full), $class.' references '.$full);
            }
        }
    }

    public function test_zero_argument_relations_build_queries_without_database_access(): void
    {
        $previousResolver = Model::getConnectionResolver();
        $previousContainer = Container::getInstance();
        $previousFacadeApp = Facade::getFacadeApplication();
        $container = new Container;
        $session = new Store('model-audit', new ArraySessionHandler(120));
        $session->put(['id_unidad_admin' => 7, 'id_jefe_periodo' => 11]);
        $container->instance('session', $session);
        Container::setInstance($container);
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($container);
        $connection = new MySqlConnection(static function () {
            throw new RuntimeException('Database connections are forbidden in model compatibility tests.');
        }, 'model_audit');
        Model::setConnectionResolver(new ConnectionResolver(['' => $connection]));

        try {
            $count = 0;
            foreach ($this->models() as $class => $file) {
                $reflection = new ReflectionClass($class);
                $lines = file($file);
                foreach ($reflection->getMethods() as $method) {
                    if ($method->getDeclaringClass()->getName() !== $class || $method->isStatic()
                        || $method->getNumberOfRequiredParameters() > 0 || realpath($method->getFileName()) !== realpath($file)) {
                        continue;
                    }
                    $body = implode('', array_slice($lines, $method->getStartLine() - 1, $method->getEndLine() - $method->getStartLine() + 1));
                    if (!preg_match('/return\s+\$this->(?:hasMany|hasOne|belongsTo|belongsToMany|morph\w+)\(/', $body)) {
                        continue;
                    }
                    $relation = $method->invoke(new $class);
                    $label = $class.'::'.$method->getName();
                    $this->assertInstanceOf(Relation::class, $relation, $label);
                    $this->assertInstanceOf(Model::class, $relation->getRelated(), $label);
                    $this->assertNotEmpty($relation->toSql(), $label);
                    $count++;
                }
            }
            $this->assertSame('id_jefatura', (new \App\PMSolicitudMaterial)->jefaturas()->getOwnerKeyName());
            $this->assertSame('id_expbebidas', (new \App\Tutorias_Exp_formacion_integral)->escala()->getForeignKeyName());
            // MariaDB metadata confirmed by the user: oc_oficio has only updated_at.
            foreach ([false, true] as $exists) {
                $oficio = new \App\oc_oficio;
                $oficio->exists = $exists;
                $this->assertTrue($oficio->usesTimestamps());
                $this->assertNull($oficio->getCreatedAtColumn());
                $oficio->updateTimestamps();
                $this->assertArrayNotHasKey('created_at', $oficio->getAttributes());
                $this->assertNotEmpty($oficio->getAttributes()['updated_at']);
            }
            $oficio = new \App\oc_oficio;
            $oficio->setRawAttributes(['updated_at' => '2026-01-01 10:00:00']);
            $oficio->updateTimestamps();
            $this->assertSame('2026-01-01 10:00:00', $oficio->getAttributes()['updated_at']);
            $this->assertSame('id_tipoadqui', (new \App\RmBienes)->adquisiciones()->getForeignKeyName());
            $this->assertSame('id_tipoadqui', (new \App\RmTipoadqui)->bienes()->getForeignKeyName());
            $this->assertSame(153, $count, 'Review the relation inventory when relations are added or removed.');
        } finally {
            if ($previousResolver === null) {
                Model::unsetConnectionResolver();
            } else {
                Model::setConnectionResolver($previousResolver);
            }
            Container::setInstance($previousContainer);
            Facade::clearResolvedInstances();
            Facade::setFacadeApplication($previousFacadeApp);
        }
    }
    public function test_legacy_half_hour_ranges_use_numeric_carbon_units(): void
    {
        $this->assertSame(['08:00', '08:30', '09:00'], \App\AudValidarAgenda::generateRange('08:00', '09:00'));
        $this->assertSame([], \App\AudValidarAgenda::generateRange('09:00', '08:00'));
    }
    public function test_verified_timestamp_and_manual_key_sql_without_execution(): void
    {
        $previousResolver = Model::getConnectionResolver();
        $connection = new class(static function () {
            throw new RuntimeException('No database access is allowed, including during pretend().');
        }, 'model_audit') extends MySqlConnection {
            // pretend() interpolates bindings for its log. Quote these test-only values locally.
            protected function escapeString($value)
            {
                return "'".str_replace("'", "''", $value)."'";
            }
        };
        Model::setConnectionResolver(new ConnectionResolver(['' => $connection]));
        try {
            $metadata = json_decode(file_get_contents($this->root().'/tests/Fixtures/eloquent-metadata.json'), true, flags: JSON_THROW_ON_ERROR);
            foreach ($metadata as $class => $mapping) {
                if ($mapping[2] || !in_array($class, [
                    \App\adscripcion_personal::class, \App\amb_encargados::class,
                    \App\oc_oficio_personal::class, \App\serv_datos_alumnos::class,
                    \App\Tutorias_Exp_bachillerato::class,
                ], true)) {
                    continue;
                }
                $model = new $class;
                $model->setAttribute($model->getKeyName(), 123);
                $queries = $connection->pretend(static function () use ($model) {
                    $model->save();
                });
                $this->assertCount(1, $queries);
                $this->assertStringNotContainsString('created_at', $queries[0]['query'], $class);
                $this->assertStringNotContainsString('updated_at', $queries[0]['query'], $class);
            }
            foreach ([\App\Activa_evaluacion::class, \App\Tutorias_Exp_bachillerato::class,
                \App\Tutorias_Exp_familia_union::class, \App\Tutorias_Exp_generacion::class] as $class) {
                $model = new $class;
                $model->setAttribute($model->getKeyName(), 123);
                $connection->pretend(static function () use ($model) {
                    $model->save();
                });
                $this->assertSame(123, $model->getKey(), $class.' must preserve the supplied primary key.');
            }
            foreach ([\App\oc_dependencias::class, \App\oc_oficio::class] as $class) {
                $model = new $class;
                $model->setAttribute($model->getKeyName(), 123);
                $queries = $connection->pretend(static function () use ($model) {
                    $model->save();
                });
                $this->assertCount(1, $queries);
                $this->assertStringNotContainsString('created_at', $queries[0]['query'], $class);
                $this->assertStringContainsString('updated_at', $queries[0]['query'], $class);
            }
        } finally {
            if ($previousResolver === null) {
                Model::unsetConnectionResolver();
            } else {
                Model::setConnectionResolver($previousResolver);
            }
        }
    }
}
