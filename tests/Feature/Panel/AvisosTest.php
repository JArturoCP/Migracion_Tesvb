<?php

/*
 * Verifica que panel/inicio.blade.php muestra los mismos avisos que home_recargado.blade.php
 * con los mismos datos: mensaje global (men), nota de fecha del docente con actividad,
 * aviso verde de RETÍCULA/DOCENTE, aviso de tutor (y su conteo), encuestas del alumno y adeudos.
 */

use Illuminate\Support\Facades\View;
use Tests\Support\EscenariosPanel;

beforeEach(function () {
    EscenariosPanel::crearEsquema();
    $this->withoutVite();
});

/** Datos que HomeController2@index entrega a la vista (mismos nombres que su compact()). */
function datosVista(array $cambios = []): array
{
    return array_merge([
        'adeudo' => 0, 'departamento_carrera' => '',
        'estado_encuesta1' => 0, 'estado_encuesta2' => 0, 'estado_encuesta3' => 0, 'estado_encuesta4' => 0,
        'estado_servicio' => 0, 'estado_inscripcion' => 0, 'estado_reinscripcion' => 0, 'estado_residencia' => 0,
        'es_tutor_reprobacion' => false, 'total_alumnos_reprobacion_tutor' => 0, 'periodo_reprobacion_tutor' => null,
        'debug_tutor_reprobacion' => [],
    ], $cambios);
}

function normalizarTexto(string $texto): string
{
    $texto = strtr($texto, ['á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U']);

    return trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($texto))));
}

/** Resumen comparable de los avisos de una página. */
function resumenAvisos(string $html, string $men = '', ?string $fecha = null): array
{
    $texto = normalizarTexto($html);

    preg_match('/Estudiantes con reprobacion detectados: (\d+)/', $texto, $tutor);

    // Encuestas: viejo con onclick="window.location='…'", nuevo con href.
    preg_match_all("#(?:window\\.location='|href=\")([^'\"]*encuestas_satisfaccion/encuesta_[a-z_]+/?)#", $html, $encuestas);

    // Adeudos: "Nombre del departamento o jefatura: X … adeudas en el departamento? Y"
    preg_match_all('/Nombre del departamento o jefatura: (.*?) ¿Que es lo que adeudas en el departamento\? (.*?)\s*(?=Nombre del departamento|Cerrar|$)/u', $texto, $adeudos, PREG_SET_ORDER);

    return [
        'reticula' => str_contains($texto, 'ATENCION: !!!!El modulo de RETICULA y DOCENTE se cambio a Generales en el submenu ACADEMICO!!'),
        'men' => $men !== '' && str_contains($texto, normalizarTexto($men)),
        'fecha' => $fecha !== null && str_contains($texto, 'La ultima fecha de liberacion de Actividades Complementarias es el ' . $fecha),
        'tutor' => isset($tutor[1]) ? (int) $tutor[1] : null,
        'boton_canalizar' => str_contains($html, '/canalizacion-reprobacion-principal') && isset($tutor[1]),
        'encuestas' => array_values(array_unique($encuestas[1])),
        'adeudos' => array_map(fn ($a) => [$a[1], $a[2]], $adeudos),
    ];
}

function renderizar(string $vista, array $datos): string
{
    View::flushState();

    return view($vista, $datos)->render();
}

dataset('avisos', [
    'directivo' => ['directivo', [], []],
    'jefe de división' => ['jefe_division', [], []],
    'desarrollo académico (sin men)' => ['desarrollo', [], []],
    'docente con actividad (nota de fecha)' => ['docente_actividad', [], []],
    'docente sin actividad' => ['docente', [], []],
    'docente tutor con 3 reprobados' => ['docente', ['tutor' => true, 'reprobados' => 3], []],
    'docente tutor sin reprobados' => ['docente', ['tutor' => true, 'reprobados' => 0], []],
    'servicios escolares' => ['escolar', [], []],
    'alumno sin encuestas ni adeudos' => ['alumno', ['semestre' => 3], []],
    'alumno con encuestas y adeudos' => ['alumno', ['semestre' => 3], [
        'estado_encuesta1' => 1, 'estado_inscripcion' => 1,
        'estado_encuesta3' => 1, 'estado_servicio' => 1,
        'estado_encuesta4' => 1, 'estado_residencia' => 1,
        'adeudo' => 1,
        'departamento_carrera' => [
            ['nombre' => 'CENTRO DE INFORMACIÓN', 'comentario' => 'Libro no devuelto'],
            ['nombre' => 'LABORATORIO', 'comentario' => 'Material de práctica'],
        ],
    ]],
    'alumno con reinscripción pendiente' => ['alumno', ['semestre' => 5], ['estado_encuesta2' => 1, 'estado_reinscripcion' => 1]],
]);

it('panel.inicio muestra los mismos avisos que home_recargado', function (string $rol, array $opciones, array $datos) {
    $this->actingAs(EscenariosPanel::preparar($rol, $opciones));
    $men = (string) session('men', '');
    $fecha = session('fecha');

    $viejo = resumenAvisos(renderizar('home_recargado', datosVista($datos)), $men, $fecha);
    $nuevo = resumenAvisos(renderizar('panel.inicio', datosVista($datos)), $men, $fecha);

    expect($nuevo)->toBe($viejo);
})->with('avisos');

it('los escenarios de avisos ejercitan cada aviso al menos una vez', function () {
    $vistos = ['reticula' => false, 'fecha' => false, 'tutor' => false, 'encuestas' => false, 'adeudos' => false];
    $casos = [
        ['directivo', [], []],
        ['docente_actividad', [], []],
        ['docente', ['tutor' => true, 'reprobados' => 2], []],
        ['alumno', ['semestre' => 3], ['estado_encuesta1' => 1, 'estado_inscripcion' => 1, 'adeudo' => 1, 'departamento_carrera' => [['nombre' => 'X', 'comentario' => 'Y']]]],
    ];
    foreach ($casos as [$rol, $opciones, $datos]) {
        EscenariosPanel::vaciar();
        EscenariosPanel::crearEsquema();
        $this->actingAs(EscenariosPanel::preparar($rol, $opciones));
        $r = resumenAvisos(renderizar('panel.inicio', datosVista($datos)), (string) session('men', ''), session('fecha'));
        $vistos['reticula'] = $vistos['reticula'] || $r['reticula'];
        $vistos['fecha'] = $vistos['fecha'] || $r['fecha'];
        $vistos['tutor'] = $vistos['tutor'] || $r['tutor'] !== null;
        $vistos['encuestas'] = $vistos['encuestas'] || $r['encuestas'] !== [];
        $vistos['adeudos'] = $vistos['adeudos'] || $r['adeudos'] !== [];
    }

    expect($vistos)->each->toBeTrue();
});
