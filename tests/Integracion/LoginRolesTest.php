<?php

/*
 * Destino del login por rol contra la MySQL local (.env), dentro de una transacción que se revierte.
 * /home sigue ejecutando HomeController@index igual; cuando devuelve la vista "home" (pantalla
 * intermedia), esta ya no usa el layout viejo y manda de inmediato a /inicio, que responde 200.
 * Los casos que redirigen a otro lado siguen igual: profesor de inglés → /ingles, alumno sin
 * ficha → datos_alumno, personal sin ficha → /docentes/create. Se omite si no hay MySQL.
 */

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

uses(Tests\TestCase::class);

beforeEach(function () {
    $env = \Dotenv\Dotenv::parse(@file_get_contents(base_path('.env')) ?: '');
    if (($env['DB_CONNECTION'] ?? '') !== 'mysql') {
        $this->markTestSkipped('No hay base MySQL configurada en .env');
    }
    config([
        'database.connections.mysql' => array_merge(config('database.connections.mysql'), [
            'host' => $env['DB_HOST'] ?? '127.0.0.1', 'port' => $env['DB_PORT'] ?? '3306', 'database' => $env['DB_DATABASE'] ?? '',
            'username' => $env['DB_USERNAME'] ?? '', 'password' => $env['DB_PASSWORD'] ?? '',
        ]),
        'database.default' => 'mysql',
    ]);
    DB::purge('mysql');
    try {
        DB::connection('mysql')->getPdo();
    } catch (\Throwable $e) {
        $this->markTestSkipped('MySQL local no disponible');
    }
    DB::beginTransaction();
    $this->withoutVite();
});

afterEach(function () {
    if (DB::transactionLevel() > 0) {
        DB::rollBack();
    }
});

function entrarYAbrirHome($prueba, string $email)
{
    $prueba->post('/login', ['email' => $email, 'password' => \Database\Seeders\UsersSeeder::PASSWORD_PRUEBA]);

    return $prueba->get('/home');
}

dataset('cuentas_inicio', [
    'alumno' => ['alumno03@example.com'], 'alumno con carga validada' => ['alumno02@example.com'],
    'docente' => ['docente01@example.com'], 'directivo' => ['directivo@example.com'], 'jefe de división' => ['jefe.division@example.com'],
    'desarrollo académico' => ['desarrollo@example.com'], 'servicios escolares' => ['escolar@example.com'], 'recursos humanos' => ['rh@example.com'],
    'centro de cómputo' => ['computo@example.com'], 'residencias' => ['residencia@example.com'], 'titulación' => ['titulacion@example.com'],
    'finanzas' => ['finanzas@example.com'], 'consultas' => ['consultas@example.com'],
]);

it('llega a /inicio a través de la pantalla intermedia', function (string $email) {
    if (! DB::table('users')->where('email', $email)->exists()) {
        $this->markTestSkipped("No existe $email en la base local");
    }
    $home = entrarYAbrirHome($this, $email)->assertOk()->assertViewIs('home');

    $html = $home->getContent();
    expect($html)->toContain("window.location.replace('/inicio')")
        ->toContain('<noscript>')->toContain('href="/inicio"')
        ->toContain('data-panel-cargando')
        ->not->toContain('CARGANDO....')                 // modal del diseño anterior
        ->not->toContain('navbar');                      // menú viejo (layouts.app)
    foreach (\Tests\Support\CompararVistas::recursos($html) as $r) {
        expect(strtolower($r))->not->toContain('bootstrap')->not->toContain('jquery');
    }

    $this->get('/inicio')->assertOk()->assertViewIs('panel.inicio');
})->with('cuentas_inicio');

it('el profesor de inglés sigue yendo a /ingles', function () {
    if (! DB::table('users')->where('email', 'ingles01@example.com')->exists()) {
        $this->markTestSkipped('No existe la cuenta de inglés');
    }
    expect(parse_url(entrarYAbrirHome($this, 'ingles01@example.com')->assertRedirect()->headers->get('Location'), PHP_URL_PATH))->toBe('/ingles');
});

it('el alumno sin ficha sigue yendo a datos_alumno y el personal sin ficha a /docentes/create', function () {
    $nuevo = fn (string $email, int $tipo) => DB::table('users')->insert([
        'name' => 'PRUEBA', 'email' => $email, 'password' => Hash::make(\Database\Seeders\UsersSeeder::PASSWORD_PRUEBA),
        'tipo_usuario' => $tipo, 'info_ok' => 1, 'activated' => 1, 'created_at' => now(), 'updated_at' => now(),
    ]);
    $nuevo('alumno.sin.ficha@prueba.test', 1);
    $nuevo('personal.sin.ficha@prueba.test', 2);

    expect(parse_url(entrarYAbrirHome($this, 'alumno.sin.ficha@prueba.test')->assertRedirect()->headers->get('Location'), PHP_URL_PATH))->toBe('/datos_alumno');

    $this->post('/logout');
    app('auth')->forgetGuards();
    $this->flushSession();

    expect(parse_url(entrarYAbrirHome($this, 'personal.sin.ficha@prueba.test')->assertRedirect()->headers->get('Location'), PHP_URL_PATH))->toBe('/docentes/create');
});
