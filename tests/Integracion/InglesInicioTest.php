<?php

/*
 * /ingles con el diseño del panel, contra la MySQL local (.env), dentro de una transacción que se revierte
 * (los datos extra que se agregan para tener números distintos de cero también se revierten).
 * Se omite si no hay MySQL.
 *
 * Dashboard del profesor (App\Services\Panel\DatosIngles) comparadas con lo que entregan hoy
 * las pantallas del profesor:
 *   M1 = grupos de /ingles/Calificaciones (In_inicioController@inicio_calificaciones, $niveles)
 *   M2 = suma de $alumnos_inscritos de /ingles/Calificaciones/mostrar_alumnos/{n}/{g}
 *   M3 = evaluaciones "pendientes" (evaluada 0) de /ingles/Calificaciones/periodos_ingles/{n}/{g}
 *   M4 = 2 − $cuenta_periodos de esa misma pantalla, por grupo
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
            'host' => $env['DB_HOST'] ?? '127.0.0.1', 'port' => $env['DB_PORT'] ?? '3306', 'database' => $env['DB_DATABASE'] ?? '',
            'username' => $env['DB_USERNAME'] ?? '', 'password' => $env['DB_PASSWORD'] ?? '',
        ]),
        'database.default' => 'mysql',
        // caché en memoria: las métricas calculadas con datos de la transacción no quedan guardadas
        'cache.default' => 'array',
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

function entrarIngles($prueba, string $email)
{
    if (! DB::table('users')->where('email', $email)->exists()) {
        $prueba->markTestSkipped("No existe la cuenta $email");
    }
    $prueba->post('/login', ['email' => $email, 'password' => \Database\Seeders\UsersSeeder::PASSWORD_PRUEBA]);

    return $prueba->get('/home');
}

function metricasEsperadas($prueba): array
{
    $calificaciones = $prueba->get('/ingles/Calificaciones')->assertOk();
    $grupos = collect($calificaciones->viewData('niveles'));
    $esperado = ['mis_grupos' => $grupos->count(), 'alumnos_inscritos' => 0, 'por_capturar' => 0, 'sin_fecha' => 0];

    foreach ($grupos as $g) {
        $esperado['alumnos_inscritos'] += (int) $prueba->get("/ingles/Calificaciones/mostrar_alumnos/{$g->id_nivel}/{$g->id_grupo}")->viewData('alumnos_inscritos');

        $periodos = $prueba->get("/ingles/Calificaciones/periodos_ingles/{$g->id_nivel}/{$g->id_grupo}")->assertOk();
        $esperado['sin_fecha'] += max(0, 2 - (int) $periodos->viewData('cuenta_periodos'));
        foreach (['periodo1', 'periodo2'] as $clave) {
            $periodo = $periodos->viewData($clave);
            if ($periodo && count($periodo) > 0 && (int) $periodo[0]->evaluada === 0) {
                $esperado['por_capturar']++;
            }
        }
        // La misma pantalla, renderizada: una insignia "Evaluación pendiente" por evaluación por capturar.
        $esperado['pendientes_html'] = ($esperado['pendientes_html'] ?? 0) + substr_count($periodos->getContent(), 'title="Evaluación pendiente"');
    }

    return $esperado;
}

it('el profesor de inglés sigue llegando a /ingles y ve el panel con bienvenida, aviso y métricas', function () {
    entrarIngles($this, 'ingles01@example.com')->assertRedirect('/ingles/');

    $consultas = [];
    DB::listen(function ($q) use (&$consultas) {
        $consultas[] = $q->sql;
    });
    $respuesta = $this->get('/ingles')->assertOk();
    $html = $respuesta->getContent();

    expect($html)->toContain('data-panel-bienvenida')
        ->toContain(e(session('nombre_ingles')))
        ->toContain('Periodo de Inglés: ' . e(session('nombre_periodo_ingles')))
        ->toContain('data-panel-aviso="men"')
        ->toContain('data-panel-dashboard="profesor_ingles"')
        ->toContain('data-panel-ingles-periodo')
        ->toContain('Inicio de Inglés')
        ->toContain(url('/ingles/Calificaciones'))
        ->not->toContain('bootstrap.min.css');
    // mismos bloques que el dashboard del directivo en /inicio
    foreach (['barras', 'radial', 'linea', 'lista', 'tabla'] as $bloque) {
        expect($html)->toContain('data-panel-bloque="' . $bloque . '"');
    }
    expect($html)->toContain('data-panel-metrica="mis_grupos"')->toContain('data-panel-metrica="alumnos_inscritos"');

    // /ingles solo lee (además de lo que ya hacía la sesión)
    foreach ($consultas as $sql) {
        expect(strtolower(ltrim($sql)))->toStartWith('select');
    }
});

it('M1 a M4 coinciden con las pantallas de calificaciones del profesor (datos de prueba)', function () {
    entrarIngles($this, 'ingles01@example.com');
    $tablero = $this->get('/ingles')->viewData('tablero');
    $esperado = metricasEsperadas($this);

    expect($tablero)->not->toBeNull()
        ->and($tablero['mis_grupos']['valor'])->toBe($esperado['mis_grupos'])
        ->and($tablero['alumnos_inscritos']['valor'])->toBe($esperado['alumnos_inscritos'])
        ->and($tablero['captura']['por_capturar'])->toBe($esperado['por_capturar'])
        ->and($tablero['captura']['por_capturar'])->toBe($esperado['pendientes_html'])
        ->and($tablero['captura']['sin_fecha'])->toBe($esperado['sin_fecha'])
        ->and(count($tablero['grupos']))->toBe($esperado['mis_grupos']);
});

it('M1 a M4 coinciden también con más grupos, inscritos y evaluaciones pendientes', function () {
    entrarIngles($this, 'ingles01@example.com');
    $idProfesor = (int) session('id_profesor_ingles');
    $periodo = (int) session('periodo_ingles');

    // Datos extra (se revierten): un segundo grupo con 2 evaluaciones (una pendiente) y un alumno inscrito.
    $nivel = (int) DB::table('in_niveles_ingles')->orderBy('id_niveles_ingles')->skip(1)->value('id_niveles_ingles');
    $grupo = (int) DB::table('in_grupo_ingles')->orderBy('id_grupo_ingles')->skip(1)->value('id_grupo_ingles');
    DB::table('in_hrs_ingles_profesor')->insert(['id_profesor' => $idProfesor, 'id_nivel' => $nivel, 'id_grupo' => $grupo, 'id_periodo' => $periodo, 'id_estado' => 1]);
    DB::table('in_cal_periodo')->insert([
        ['fecha' => '2026-11-20', 'id_unidad' => 1, 'id_periodo' => $periodo, 'id_nivel' => $nivel, 'id_grupo' => $grupo, 'evaluada' => 1],
        ['fecha' => '2026-12-10', 'id_unidad' => 4, 'id_periodo' => $periodo, 'id_nivel' => $nivel, 'id_grupo' => $grupo, 'evaluada' => 0],
    ]);
    $alumno = (int) DB::table('gnral_alumnos')->orderBy('id_alumno', 'desc')->value('id_alumno');
    DB::table('in_carga_academica_ingles')->insert(['id_alumno' => $alumno, 'id_nivel' => $nivel, 'id_grupo' => $grupo, 'id_periodo_ingles' => $periodo, 'estado_nivel' => (int) DB::table('eva_tipo_curso')->value('id_tipo_curso')]);
    DB::table('in_validar_carga')->insert(['id_alumno' => $alumno, 'id_periodo' => $periodo, 'id_estado' => 2, 'comentario' => 'prueba']);

    $tablero = $this->get('/ingles')->viewData('tablero');
    $esperado = metricasEsperadas($this);

    expect($esperado['mis_grupos'])->toBeGreaterThanOrEqual(2)
        ->and($esperado['alumnos_inscritos'])->toBeGreaterThanOrEqual(1)
        ->and($esperado['por_capturar'])->toBeGreaterThanOrEqual(1)
        ->and($tablero['mis_grupos']['valor'])->toBe($esperado['mis_grupos'])
        ->and($tablero['alumnos_inscritos']['valor'])->toBe($esperado['alumnos_inscritos'])
        ->and($tablero['captura']['por_capturar'])->toBe($esperado['por_capturar'])
        ->and($tablero['captura']['por_capturar'])->toBe($esperado['pendientes_html'])
        ->and($tablero['captura']['sin_fecha'])->toBe($esperado['sin_fecha']);
});

it('el alumno ve el nuevo /ingles sin métricas y con sus accesos de inglés', function () {
    entrarIngles($this, 'alumno03@example.com');
    $html = $this->get('/ingles')->assertOk()->getContent();

    expect($html)->toContain('data-panel-bienvenida')
        ->toContain('data-panel-aviso="men"')
        ->toContain('data-panel-ingles-periodo')
        ->not->toContain('data-panel-dashboard="profesor_ingles"')
        ->toContain(url('/ingles_horarios/cargar_voucher_pago'))
        ->toContain(url('/ingles/ver_cal_alumno_ingles/'))
        ->not->toContain(url('/ingles/vouchers_validacion'));
});

it('la coordinación de inglés (unidad 19) ve el nuevo /ingles con sus 22 accesos', function () {
    // docente01 pasa a la unidad 19 solo dentro de la transacción
    $usuario = DB::table('users')->where('email', 'docente01@example.com')->value('id');
    $personal = DB::table('gnral_personales')->where('tipo_usuario', $usuario)->value('id_personal');
    if (! $personal) {
        $this->markTestSkipped('No existe el personal de docente01');
    }
    DB::table('gnral_unidad_personal')->where('id_personal', $personal)->update(['id_unidad_admin' => 19]);

    entrarIngles($this, 'docente01@example.com');
    expect(session('id_unidad_admin'))->toBe(19);

    $html = $this->get('/ingles')->assertOk()->getContent();
    preg_match('#data-panel-accesos.*#s', $html, $accesos);

    expect($html)->toContain('Inicio de Inglés')
        ->toContain('data-panel-ingles-periodo')
        ->not->toContain('data-panel-dashboard="profesor_ingles"')
        ->and(substr_count($accesos[0], '<li><a href='))->toBe(22);
});

it("la línea por periodo coincide con /ingles/Calificaciones y mostrar_alumnos en cada periodo de inglés", function () {
    entrarIngles($this, "ingles01@example.com");
    $actual = (int) session("periodo_ingles");
    $tablero = $this->get("/ingles")->viewData("tablero");

    expect($tablero["historico"])->not->toBeEmpty()
        ->and(end($tablero["historico"])["id"])->toBe($actual);

    foreach ($tablero["historico"] as $punto) {
        // mismo cambio de periodo que el botón "Inglés" del header (solo escribe en la sesión)
        $this->from("/ingles")->get("/recargar/periodos_ingles/" . $punto["id"]);
        $esperado = metricasEsperadas($this);
        expect($punto["grupos"])->toBe($esperado["mis_grupos"], "Grupos en el periodo " . $punto["id"])
            ->and($punto["inscritos"])->toBe($esperado["alumnos_inscritos"], "Inscritos en el periodo " . $punto["id"]);
    }
    $this->get("/recargar/periodos_ingles/" . $actual);
});
