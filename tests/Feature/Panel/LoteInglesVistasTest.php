<?php

/*
 * Lote 1 de Inglés: cada rama de las vistas del profesor, con datos sintéticos (también las que los datos
 * de prueba de MySQL no alcanzan: unidad 19, evaluaciones realizadas o pendientes, cada etapa de captura).
 * La vista nueva y la anterior (tests/Fixtures/vistas_antes) se renderizan con los mismos datos y se comparan:
 * formularios (action, method, _token, name), campos, ids, clases que usan los scripts y textos.
 */

use Illuminate\Support\Facades\View;
use Tests\Support\BalanceHtml;
use Tests\Support\CompararVistas;
use Tests\Support\EscenariosPanel;

beforeEach(function () {
    EscenariosPanel::crearEsquema();
    $this->withoutVite();
    View::addNamespace('antes', base_path('tests/Fixtures/vistas_antes'));
});

/** Renderiza la vista nueva y la anterior con los mismos datos y las compara. Devuelve el HTML nuevo. */
function compararVistaIngles(string $vista, array $datos): string
{
    View::flushState();
    $nuevo = view($vista, $datos)->render();
    View::flushState();
    $viejo = view('antes::' . $vista, $datos)->render();

    expect($nuevo)->toContain('data-panel-contenido')->not->toContain('class="tesvb-contenido"')
        ->and(array_values(array_filter(BalanceHtml::errores($nuevo), fn ($e) => ! preg_match('#^<(td|th|tr)> de la línea \d+ sin cerrar \(lo cierra </(td|th|tr|tbody|thead|table)>#', $e))))->toBe([]);
    foreach (CompararVistas::recursos($nuevo) as $r) {
        expect($r)->not->toMatch('/bootstrap(\.min)?\.(css|js)|\/css\/app\.css|dataTables\.bootstrap/i');
    }
    expect(preg_match('#<main.*</main>#s', $nuevo, $m) ? preg_match('/class="(?:[^"]* )?(btn|form-control|panel|col-md-\d+|row)(?: [^"]*)?"/', $m[0], $bs) : 0)->toBe(0, 'clases de Bootstrap: ' . ($bs[0] ?? ''));

    $a = CompararVistas::regionApp($viejo);
    $b = CompararVistas::region($nuevo, '//*[@data-panel-contenido]');
    expect(CompararVistas::formulariosNavegador($nuevo, 'data-panel-contenido', 'data-panel-pie'))
        ->toEqual(CompararVistas::formulariosNavegador($viejo, 'class="tesvb-contenido"', '<footer'), "formularios de $vista")
        ->and(CompararVistas::camposNavegador($nuevo, 'data-panel-contenido', 'data-panel-pie'))
        ->toEqual(CompararVistas::camposNavegador($viejo, 'class="tesvb-contenido"', '<footer'), "campos de $vista")
        ->and(array_values(array_diff(CompararVistas::ids($a), CompararVistas::ids($b))))->toBe([], "ids de $vista");
    $clasesUsadas = array_intersect(CompararVistas::clasesDeScripts($a), CompararVistas::clases($a));
    expect(array_values(array_diff($clasesUsadas, CompararVistas::clases($b))))->toBe([], "clases de scripts en $vista");
    $texto = CompararVistas::textoPlano(CompararVistas::region($nuevo, '//body'));
    expect(array_values(array_filter(CompararVistas::textos($a), fn ($t) => ! str_contains($texto, $t))))->toBe([], "textos de $vista");

    return $nuevo;
}

function profesorSintetico(): object
{
    return (object) ['nombre' => 'DANIELA', 'apellido_paterno' => 'PÉREZ', 'apellido_materno' => 'LÓPEZ'];
}

it('periodos_calificaciones conserva cada rama', function (int $cuenta, ?int $evaluada1, ?int $evaluada2, ?int $unidad) {
    $this->actingAs(EscenariosPanel::preparar('ingles', []));
    if ($unidad) {
        session(['id_unidad_admin' => $unidad]);
    }
    $p = fn ($u, $e) => [(object) ['id_unidad' => $u, 'fecha' => '2026-11-20', 'evaluada' => $e, 'id_nivel' => 1, 'id_grupo' => 1]];
    $datos = [
        'cuenta_periodos' => $cuenta, 'id_grupo' => 1, 'id_nivel' => 1, 'nivel' => 'BÁSICO 1', 'profesor' => profesorSintetico(),
        'periodo1' => $cuenta >= 1 ? $p(1, $evaluada1) : 0,
        'periodo2' => $cuenta >= 2 ? $p(4, $evaluada2) : 0,
    ];

    $html = compararVistaIngles('ingles.profesores_ingles.periodos_calificaciones', $datos);

    expect(substr_count($html, 'class="agregar') + substr_count($html, ' agregar"') + substr_count($html, ' agregar '))->toBeGreaterThanOrEqual($cuenta < 2 ? 1 : 0)
        ->and(substr_count($html, 'modificar'))->toBe(substr_count(view('antes::ingles.profesores_ingles.periodos_calificaciones', $datos)->render(), 'modificar'));
})->with([
    'sin fechas' => [0, null, null, null],
    'una fecha pendiente' => [1, 0, null, null],
    'una fecha evaluada' => [1, 1, null, null],
    'una fecha pendiente (unidad 19)' => [1, 0, null, 19],
    'dos fechas pendientes' => [2, 0, 0, null],
    'dos fechas evaluadas' => [2, 1, 1, null],
    'dos fechas pendientes (unidad 19)' => [2, 0, 0, 19],
]);

it('inicio_calificaciones conserva cada rama', function (int $cuenta) {
    $this->actingAs(EscenariosPanel::preparar('ingles', []));
    $niveles = $cuenta ? [
        (object) ['nivel' => 'BÁSICO 1', 'grupo' => 'A', 'id_nivel' => 1, 'id_grupo' => 1],
        (object) ['nivel' => 'BÁSICO 2', 'grupo' => 'B', 'id_nivel' => 2, 'id_grupo' => 3],
    ] : [];

    $html = compararVistaIngles('ingles.profesores_ingles.inicio_calificaciones', ['niveles' => $niveles, 'cuenta_niveles' => $cuenta, 'nombre_profesor' => profesorSintetico()]);

    if ($cuenta) {
        expect($html)->toContain('href="/ingles/Calificaciones/periodos_ingles/2/3"')->toContain('href="/ingles/Calificaciones/mostrar_alumnos/2/3"');
    }
})->with(['sin grupos' => [0], 'con grupos' => [1]]);

it('Datos P. › Editar conserva el formulario y las opciones seleccionadas', function () {
    $this->actingAs(EscenariosPanel::preparar('ingles', []));
    View::share('errors', new \Illuminate\Support\ViewErrorBag());
    $datos = [
        'datos_profesor' => (object) ['nombre' => 'DANIELA', 'apellido_paterno' => 'PÉREZ', 'apellido_materno' => 'LÓPEZ', 'id_sexo' => 2, 'id_nivel_ingles' => 1, 'id_tipo_titulo' => 3, 'fecha_emision_titulo' => '2025/06/01'],
        'sexos' => [(object) ['id_sexo' => 1, 'descripcion' => 'HOMBRE'], (object) ['id_sexo' => 2, 'descripcion' => 'MUJER']],
        'nivel_ingles' => [(object) ['id_nivel_ingles' => 1, 'descripcion' => 'B1'], (object) ['id_nivel_ingles' => 2, 'descripcion' => 'B2']],
        'titulos' => [(object) ['id_titulo' => 3, 'descripcion' => 'TOEFL'], (object) ['id_titulo' => 4, 'descripcion' => 'CAMBRIDGE']],
    ];

    $html = view('ingles.partials.modificar_profesor', $datos)->render();
    $antes = view('antes::ingles.partials.modificar_profesor', $datos)->render();

    expect(CompararVistas::formulariosNavegador($html, 'data-panel-contenido', 'data-panel-pie'))
        ->toBe(CompararVistas::formulariosNavegador($antes, 'class="tesvb-contenido"', '<footer'))
        ->and(BalanceHtml::errores($html))->toBe([])
        ->and($html)->toContain('data-target="#editar_facilitador"')
        ->toMatch('#<option value="2" selected\s*>MUJER</option>#')
        ->toMatch('#<input[^>]*type="date"[^>]*value="2025-06-01"#')
        ->not->toContain('bootstrap-datepicker');
});

dataset('etapas_captura', function () {
    foreach (['ingles.profesores_ingles.asignacion_calificaciones', 'ingles.profesores_ingles.asignacion_calificaciones_act'] as $vista) {
        foreach ([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 13] as $etapa) {
            foreach ([null, 19] as $unidad) {
                yield basename(str_replace('.', '/', $vista)) . " etapa $etapa" . ($unidad ? ' (unidad 19)' : '') => [$vista, $etapa, $unidad];
            }
        }
    }
});

function datosAsignacion(int $etapa, int $inscritos = 3): array
{
    $alumno = fn ($n, $estado, $cal) => [
        'id_carga' => 100 + $n, 'estado_nivel' => $estado, 'cuenta' => '2020' . $n, 'nombre' => "ALUMNO $n", 'carrera' => 'ISC',
        'unidad1' => $cal, 'unidad2' => $cal, 'unidad3' => $cal, 'unidad4' => $cal, 'promedio' => $cal,
    ];

    return [
        'array_calificaciones' => [$alumno(1, 1, 95), $alumno(2, 2, 65), $alumno(3, 4, 75)],
        'calificar_unidad' => ['unidad1' => $etapa],
        'alumnos_inscritos' => $inscritos,
        'id_grupo' => 2, 'id_nivel' => 1, 'nivel' => 'BÁSICO 1', 'profesor' => profesorSintetico(),
        'porcentaje' => ['unidad1' => 30, 'unidad2' => 20, 'unidad3' => 80, 'unidad4' => 30, 'promedio_general' => 67],
    ];
}

it('asignacion_calificaciones conserva cada etapa de captura', function (string $vista, int $etapa, ?int $unidad) {
    $this->actingAs(EscenariosPanel::preparar('ingles', []));
    if ($unidad) {
        session(['id_unidad_admin' => $unidad]);
    }
    $datos = datosAsignacion($etapa);

    $html = compararVistaIngles($vista, $datos);
    View::flushState();
    $viejo = view('antes::' . $vista, $datos)->render();

    // mismas celdas, colores de aprobación, campos de captura, botones de guardar y lápices de modificación
    $cuerpo = fn ($h) => preg_match('#<tbody>(.*)</tbody>#s', $h, $m) ? $m[1] : '';
    $estilos = fn ($h) => preg_match_all('#style="([^"]*)"#', $cuerpo($h), $m) ? $m[1] : [];
    expect($estilos($html))->toBe($estilos($viejo))
        ->and(preg_match_all('#<td\b#', $cuerpo($html)))->toBe(preg_match_all('#<td\b#', $cuerpo($viejo)));
    foreach (['id="guardar_calificacion"', 'data-id_unidad=', 'modificar_cal1', 'modificar_cal2', 'modificar_cal3', 'modificar_cal4', 'id="error_', 'calificacion_'] as $marca) {
        expect(substr_count($html, $marca))->toBe(substr_count($viejo, $marca), "$marca en la etapa $etapa");
    }
    $acta = str_ends_with($vista, '_act') ? '/ingles/acta_ordinaria_act/1/2' : '/ingles/acta_ordinaria/1/2';
    expect(str_contains($html, $acta))->toBe($etapa === 13)
        ->and($html)->toContain('/ingles/lista_asistencia/1/2');
})->with('etapas_captura');

it('asignacion_calificaciones sin alumnos inscritos muestra el mismo aviso', function () {
    $this->actingAs(EscenariosPanel::preparar('ingles', []));
    $html = compararVistaIngles('ingles.profesores_ingles.asignacion_calificaciones', datosAsignacion(1, 0));
    expect($html)->toContain('No hay usuarios inscrito en este grupo')->not->toContain('table_enviado');
});
