<?php

/*
 * Pantallas del piloto con las cuentas de prueba reales contra la base MySQL local (.env):
 * cada ruta responde 200 para su rol, dentro del panel y sin el CSS de Bootstrap.
 * Todo corre dentro de una transacción que se revierte (solo GET, más el POST /login).
 * NO se abren /activar ni /Migrar (modifican datos). Si MySQL o las cuentas no existen, se omite.
 * Los reportes completos (reportes2 y reportes con gráfica) no se pueden abrir con los datos de prueba porque
 * sus controladores fallan antes de la vista; esas vistas se prueban con datos en Feature/Panel/PilotoVistasTest.
 *
 * Cuentas (database/seeders/UsersSeeder.php, contraseña PASSWORD_PRUEBA):
 *   alumno03@example.com  alumno con tutor asignado (Tutorías)
 *   alumno02@example.com  alumno con carga validada (Evaluación docente)
 *   directivo@example.com directivo (Evaluación Doc.)
 */

use Illuminate\Support\Facades\DB;

uses(Tests\TestCase::class);

beforeEach(function () {
    $env = \Dotenv\Dotenv::parse(@file_get_contents(base_path('.env')) ?: '');
    if (($env['DB_CONNECTION'] ?? '') !== 'mysql') {
        $this->markTestSkipped('No hay base MySQL configurada en .env');
    }
    config([
        'database.connections.mysql' => array_merge(config('database.connections.mysql'), [
            'host' => $env['DB_HOST'] ?? '127.0.0.1',
            'port' => $env['DB_PORT'] ?? '3306',
            'database' => $env['DB_DATABASE'] ?? '',
            'username' => $env['DB_USERNAME'] ?? '',
            'password' => $env['DB_PASSWORD'] ?? '',
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

dataset('pantallas_piloto', [
    'alumno: Tutorías' => ['alumno03@example.com', ['/tutorias'], [
        '/tutorias/inicioalu', '/tutorias/Alum', '/tutorias/AlumActualizar', '/tutorias/actividad', '/tutorias/calendario',
        '/tutoras_evaluacion/evaluacion_al_tutor/', '/tutoras_evaluacion/evaluacion_al_tutor/dos/', '/tutoras_evaluacion/evaluacion_al_tutor/tres/',
    ]],
    'alumno: Evaluación docente' => ['alumno02@example.com', [], ['/evaluacion_alumno']],
    'directivo: Evaluación Doc.' => ['directivo@example.com', [], [
        '/buscar_profesores', '/buscar_profesores_carrera', '/buscar_alumnos',
        // Con los datos de prueba, reportes_controller2 solo llega a una vista con el docente 3 (aviso "No existe registro",
        // vista mencamper); con los demás falla en el propio controlador (L455), igual que antes de la migración.
        '/reportes2/3/1/0',
    ]],
]);

it('responde 200 dentro del panel para su rol', function (string $cuenta, array $previas, array $rutas) {
    if (! DB::table('users')->where('email', $cuenta)->exists()) {
        $this->markTestSkipped("No existe la cuenta $cuenta en la base local");
    }

    $this->post('/login', ['email' => $cuenta, 'password' => \Database\Seeders\UsersSeeder::PASSWORD_PRUEBA]);
    $this->get('/home');                      // HomeController pone las banderas de sesión del rol
    foreach ($previas as $p) {
        $this->get($p);                       // p. ej. /tutorias pone el tutor asignado en la sesión
    }

    foreach ($rutas as $ruta) {
        // REQUEST_URI: reportes_controller2 lo lee directo de $_SERVER (en el navegador siempre existe).
        $_SERVER['REQUEST_URI'] = $ruta;
        $html = $this->get($ruta)->assertOk()->getContent();
        expect($html)->toContain('data-panel-contenido')
            ->not->toMatch('/<link[^>]+(bootstrap[^"]*\.css|css_tutorias\/app\.css|\/css\/app\.css)/i');
    }
})->with('pantallas_piloto');
