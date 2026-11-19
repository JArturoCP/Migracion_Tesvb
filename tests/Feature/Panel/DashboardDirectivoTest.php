<?php

/*
 * Dashboard del directivo en /inicio: datos de App\Services\Panel\DatosDirectivo.
 * Verifica las reglas de cada indicador (iguales a las pantallas existentes), que solo se hagan
 * lecturas, la caché por periodo, "Sin datos" cuando no hay datos y que los demás roles no lo vean.
 */

use App\Services\Panel\DatosDirectivo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Tests\Support\EscenariosPanel;

beforeEach(function () {
    EscenariosPanel::crearEsquema();
    $this->withoutVite();
    Cache::flush(); // CACHE_STORE=array en pruebas
});

/**
 * Datos de prueba para el periodo 10 (y el 9 como anterior):
 *  - carreras 1 (ISC), 2 (IIND) y 9 (excluida por la pantalla de Estadísticas)
 *  - alumnos con carga validada (2, 8, 9) y no validada (1); uno con género "X" (no cuenta)
 *  - cargas: ISC con 1 aprobada y 1 reprobada; IIND con 1 aprobada
 *  - docentes: 2 en ISC, 1 en IIND, y uno que da clase en ambas (cuenta una vez en el total)
 */
function sembrarDatosDirectivo(): void
{
    DB::table('gnral_carreras')->insert([
        ['id_carrera' => 1, 'nombre' => 'SISTEMAS', 'siglas' => 'ISC', 'COLOR' => '#1565C0'],
        ['id_carrera' => 2, 'nombre' => 'INDUSTRIAL', 'siglas' => 'IIND', 'COLOR' => '#2E7D32'],
        ['id_carrera' => 9, 'nombre' => 'EXCLUIDA', 'siglas' => 'EXC', 'COLOR' => null],
    ]);
    foreach (range(1, 12) as $s) {
        DB::table('gnral_semestres')->insert(['id_semestre' => $s, 'descripcion' => "SEMESTRE $s"]);
    }
    $alumnos = [
        // id, carrera, semestre, género, validación en periodo 10
        [1, 1, 1, 'M', 2], [2, 1, 3, 'F', 8], [3, 1, 5, 'F', 9], [4, 1, 1, 'X', 2],
        [5, 2, 2, 'M', 2], [6, 2, 2, 'F', 1], [7, 9, 1, 'M', 2],
    ];
    foreach ($alumnos as [$id, $carrera, $semestre, $genero, $validacion]) {
        DB::table('gnral_alumnos')->insert(['id_alumno' => $id, 'id_usuario' => 1000 + $id, 'id_carrera' => $carrera, 'id_semestre' => $semestre, 'genero' => $genero]);
        DB::table('eva_validacion_de_cargas')->insert(['id_alumno' => $id, 'id_periodo' => 10, 'estado_validacion' => $validacion]);
    }
    // Periodo anterior (9): un inscrito de ISC.
    DB::table('eva_validacion_de_cargas')->insert(['id_alumno' => 1, 'id_periodo' => 9, 'estado_validacion' => 2]);

    // Cargas del periodo 10 (status 1 = cursando); alumno 2 tiene validación 8, que no entra al índice.
    $cargas = [
        // id_alumno, status, calificaciones por unidad
        [1, 1, [80, 90]],   // aprobada
        [3, 1, [85, 60]],   // reprobada (una unidad < 70)
        [2, 1, [50]],       // validación 8: fuera del índice
        [5, 1, [75]],       // aprobada (IIND)
        [5, 2, [40]],       // status 2: fuera del índice
    ];
    foreach ($cargas as [$alumno, $status, $calificaciones]) {
        $id = DB::table('eva_carga_academica')->insertGetId(['id_alumno' => $alumno, 'id_periodo' => 10, 'id_status_materia' => $status]);
        foreach ($calificaciones as $c) {
            DB::table('cal_evaluaciones')->insert(['id_carga_academica' => $id, 'calificacion' => $c]);
        }
    }

    // Docentes con horario en el periodo 10.
    DB::table('gnral_periodo_carreras')->insert([
        ['id_periodo_carrera' => 1, 'id_carrera' => 1, 'id_periodo' => 10],
        ['id_periodo_carrera' => 2, 'id_carrera' => 2, 'id_periodo' => 10],
        ['id_periodo_carrera' => 3, 'id_carrera' => 1, 'id_periodo' => 9],
    ]);
    foreach ([701, 702, 703] as $id) {
        DB::table('gnral_personales')->insert(['id_personal' => $id, 'nombre' => "DOCENTE $id"]);
    }
    DB::table('gnral_horarios')->insert([
        ['id_periodo_carrera' => 1, 'id_personal' => 701],
        ['id_periodo_carrera' => 1, 'id_personal' => 702],
        ['id_periodo_carrera' => 2, 'id_personal' => 702], // mismo docente en dos carreras
        ['id_periodo_carrera' => 2, 'id_personal' => 703],
        ['id_periodo_carrera' => 3, 'id_personal' => 701], // periodo anterior
    ]);
}

it('calcula cada indicador con la regla de la pantalla existente', function () {
    sembrarDatosDirectivo();

    $d = (new DatosDirectivo(10))->calcular();
    $porSiglas = collect($d['carreras'])->keyBy('siglas');

    // Inscritos: validación 2/8/9, género M o F, sin carrera 9 (Estadísticas de Servicios Escolares).
    expect($d['inscritos'])->toBe(['valor' => 4, 'anterior' => 1])
        ->and($porSiglas['ISC']['inscritos'])->toBe(3)
        ->and($porSiglas['IIND']['inscritos'])->toBe(1)
        ->and($porSiglas->has('EXC'))->toBeFalse();

    // Docentes distintos con horario (Ver Horarios Docentes): 701, 702, 703.
    expect($d['docentes'])->toBe(['valor' => 3, 'anterior' => 1])
        ->and($porSiglas['ISC']['docentes'])->toBe(2)
        ->and($porSiglas['IIND']['docentes'])->toBe(2);

    // Aprobación por carga (índice de reprobación): 3 cargas elegibles, 2 aprobadas.
    expect($d['aprobacion'])->toBe(['cargas' => 3, 'aprobadas' => 2, 'reprobadas' => 1, 'porcentaje' => 66.67])
        ->and($porSiglas['ISC']['aprobacion'])->toBe(50.0)
        ->and($porSiglas['IIND']['aprobacion'])->toBe(100.0);

    // Histórico: periodos 5 a 10 que existan (aquí 9 y 10; el esquema de prueba tiene 9, 10 y 11).
    expect(collect($d['historico'])->pluck('inscritos', 'periodo')->all())
        ->toBe(['FEB-JUL 2026' => 1, 'AGO-DIC 2026' => 4]);
});

it('solo hace consultas de lectura', function () {
    sembrarDatosDirectivo();
    $consultas = [];
    DB::listen(function ($q) use (&$consultas) {
        $consultas[] = $q->sql;
    });

    (new DatosDirectivo(10))->calcular();

    expect($consultas)->not->toBeEmpty();
    foreach ($consultas as $sql) {
        expect(strtolower(ltrim($sql)))->toStartWith('select');
    }
});

it('guarda los datos en caché por periodo', function () {
    sembrarDatosDirectivo();
    $primera = DatosDirectivo::paraPeriodo(10);

    $consultas = 0;
    DB::listen(function () use (&$consultas) {
        $consultas++;
    });
    $segunda = DatosDirectivo::paraPeriodo(10);

    expect($segunda)->toBe($primera)
        ->and($consultas)->toBe(0)
        ->and(Cache::has('panel:directivo:periodo:10'))->toBeTrue()
        ->and(Cache::has('panel:directivo:periodo:9'))->toBeFalse();
});

it('el directivo ve el dashboard completo con datos reales', function () {
    sembrarDatosDirectivo();
    $this->actingAs(EscenariosPanel::preparar('directivo', []));

    $html = $this->get('/inicio')->assertOk()->getContent();

    foreach (['data-panel-metrica="inscritos"', 'data-panel-metrica="docentes"', 'data-grafica="barras"', 'data-grafica="radial"',
        'data-grafica="linea"', 'data-panel-bloque="lista"', 'data-panel-bloque="tabla"', 'data-panel-bienvenida', 'data-panel-avisos'] as $marca) {
        expect($html)->toContain($marca);
    }
    preg_match_all('/data-panel-valor>([^<]*)</', $html, $valores);
    expect($valores[1])->toBe(['4', '3'])
        ->and(substr_count($html, 'data-panel-fila'))->toBe(2)
        ->and($html)->not->toContain('data-panel-sin-datos')
        // La bienvenida y los avisos quedan arriba del dashboard.
        ->and(strpos($html, 'data-panel-avisos'))->toBeLessThan(strpos($html, 'data-panel-dashboard="directivo"'));
});

it('muestra "Sin datos" y no números cuando no hay datos', function () {
    $this->actingAs(EscenariosPanel::preparar('directivo', []));

    $html = $this->get('/inicio')->assertOk()->getContent();

    expect($html)->toContain('data-panel-dashboard="directivo"')
        ->not->toContain('data-grafica="barras"')
        ->not->toContain('data-grafica="radial"')
        ->not->toContain('data-grafica="linea"')
        ->and(substr_count($html, 'data-panel-sin-datos'))->toBeGreaterThanOrEqual(4);
});

it('muestra "Sin datos" si las consultas fallan', function () {
    \Illuminate\Support\Facades\Schema::drop('eva_validacion_de_cargas');
    $this->actingAs(EscenariosPanel::preparar('directivo', []));

    $html = $this->get('/inicio')->assertOk()->getContent();

    expect($html)->toContain('data-panel-dashboard="directivo"')
        ->toContain('No fue posible obtener los indicadores del periodo.')
        ->not->toContain('data-grafica=');
});

it('los demás roles no ven el dashboard del directivo', function (string $rol, array $opciones) {
    sembrarDatosDirectivo();
    $this->actingAs(EscenariosPanel::preparar($rol, $opciones));

    $html = $this->get('/inicio')->assertOk()->getContent();

    expect($html)->not->toContain('data-panel-dashboard')
        ->not->toContain('data-grafica=');
})->with([
    'alumno' => ['alumno', ['semestre' => 3]],
    'docente' => ['docente', []],
    'jefe de división' => ['jefe_division', []],
    'servicios escolares' => ['escolar', []],
    'finanzas' => ['finanzas', []],
]);
