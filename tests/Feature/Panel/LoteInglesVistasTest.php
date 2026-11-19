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
    $datos = [
        'datos_profesor' => (object) ['nombre' => 'DANIELA', 'apellido_paterno' => 'PÉREZ', 'apellido_materno' => 'LÓPEZ', 'id_sexo' => 2, 'id_nivel_ingles' => 1, 'id_tipo_titulo' => 3, 'fecha_emision_titulo' => '2025/06/01'],
        'sexos' => [(object) ['id_sexo' => 1, 'descripcion' => 'HOMBRE'], (object) ['id_sexo' => 2, 'descripcion' => 'MUJER']],
        'nivel_ingles' => [(object) ['id_nivel_ingles' => 1, 'descripcion' => 'B1'], (object) ['id_nivel_ingles' => 2, 'descripcion' => 'B2']],
        'titulos' => [(object) ['id_titulo' => 3, 'descripcion' => 'TOEFL'], (object) ['id_titulo' => 4, 'descripcion' => 'CAMBRIDGE']],
    ];

    $html = compararVistaIngles('ingles.partials.modificar_profesor', $datos);

    expect($html)->toMatch('#<option value="2" selected="selected"\s*>MUJER</option>#')
        ->toMatch('#class="[^"]*datepicker fecha_termino[^"]*"#');
});
