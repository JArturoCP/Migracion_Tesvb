<?php

/*
 * Complementarias del alumno: cada rama de sus vistas con datos sintéticos (también las que los datos de prueba de
 * MySQL no alcanzan). La vista nueva y la anterior (tests/Fixtures/vistas_antes) se renderizan con los mismos datos
 * y se comparan: formularios y campos como los arma el navegador (action, method, enctype, _token, _method, name,
 * value), ids, clases que usan los scripts y textos; sin clases ni archivos de Bootstrap y con el HTML balanceado.
 */

use Illuminate\Support\Facades\View;
use Tests\Support\BalanceHtml;
use Tests\Support\CompararVistas;
use Tests\Support\EscenariosPanel;

beforeEach(function () {
    EscenariosPanel::crearEsquema();
    $this->withoutVite();
    View::addNamespace('antes', base_path('tests/Fixtures/vistas_antes'));
    $this->actingAs(EscenariosPanel::preparar('alumno', ['semestre' => 5]));
    session(['ip' => 'http://localhost', 'usuario' => '202610001']);
});

function compararVistaComplementarias(string $vista, array $datos): string
{
    View::flushState();
    $nuevo = view($vista, $datos)->render();
    View::flushState();
    $viejo = view('antes::' . $vista, $datos)->render();

    expect($nuevo)->toContain('data-panel-contenido')->not->toContain('class="tesvb-contenido"')
        ->and(BalanceHtml::errores($nuevo))->toBe([]);
    foreach (CompararVistas::recursos($nuevo) as $r) {
        expect($r)->not->toMatch('/bootstrap(\.min)?\.(css|js)|\/css\/app\.css|dataTables\.bootstrap/i');
    }
    preg_match('#<main.*</main>#s', $nuevo, $main);
    expect(preg_match('/class="(?:[^"]* )?(btn|form-control|form-group|panel|modal fade|col-md-\d+|row|table|glyphicon)(?: [^"]*)?"/', $main[0], $bs) ? $bs[0] : '')->toBe('', 'clases de Bootstrap');

    $a = CompararVistas::regionApp($viejo);
    $b = CompararVistas::region($nuevo, '//*[@data-panel-contenido]');
    expect(CompararVistas::formulariosNavegador($nuevo, 'data-panel-contenido', 'data-panel-pie'))
        ->toEqual(CompararVistas::formulariosNavegador($viejo, 'class="tesvb-contenido"', '<footer'), "formularios de $vista")
        ->and(CompararVistas::camposNavegador($nuevo, 'data-panel-contenido', 'data-panel-pie'))
        ->toEqual(CompararVistas::camposNavegador($viejo, 'class="tesvb-contenido"', '<footer'), "campos de $vista")
        // agregar_actividad_alu: <form> anidado del original que el navegador nunca creaba (ver la vista)
        ->and(array_values(array_diff(CompararVistas::ids($a), CompararVistas::ids($b), ['agregar_actividad_alu'])))->toBe([], "ids de $vista");
    $clasesUsadas = array_intersect(CompararVistas::clasesDeScripts($a), CompararVistas::clases($a));
    expect(array_values(array_diff($clasesUsadas, CompararVistas::clases($b))))->toBe([], "clases de scripts en $vista");
    $texto = CompararVistas::textoPlano(CompararVistas::region($nuevo, '//body'));
    expect(CompararVistas::textosFaltantes($a, $texto, $vista))->toBe([], "textos de $vista");

    return $nuevo;
}

function registroComplementaria(int $id, int $liberacion): object
{
    return (object) ['id_registro_alumno' => $id, 'descripcion' => "ACTIVIDAD $id", 'descripcion_cat' => 'DEPORTIVA', 'fecha_registro' => '2026-09-01',
        'titulo' => 'ING.', 'nombre' => 'DOCENTE PRUEBA', 'horas' => 20, 'creditos' => 1, 'liberacion' => $liberacion, 'id_docente_actividad' => $id];
}

function actividadesDisponibles(): array
{
    return [
        (object) ['id_actividad_comple' => 7, 'id_docente_actividad' => 1, 'horas' => 20, 'titulo' => 'ING.', 'nombre' => 'DOCENTE UNO', 'descripcion' => 'FUTBOL'],
        (object) ['id_actividad_comple' => 8, 'id_docente_actividad' => 2, 'horas' => 10, 'titulo' => 'LIC.', 'nombre' => 'DOCENTE DOS', 'descripcion' => 'AJEDREZ'],
    ];
}

it('Registrar conserva cada rama', function (int $suma, int $condicion, bool $edicion) {
    $datos = [
        'condicion' => $condicion, 'liberaa' => '', 'libera' => '', 'actividad' => '', 'nuevo' => 0, 'suma' => $suma,
        'consulta_alumno' => [registroComplementaria(1, 0), registroComplementaria(2, 1), registroComplementaria(3, 2)],
        'docente_actividad' => $edicion ? [] : actividadesDisponibles(),
    ];
    if ($edicion) {
        $datos += ['editar_actalu' => (object) ['id_registro_alumno' => 1, 'id_docente_actividad' => 2], 'edit' => true];
    }

    $html = compararVistaComplementarias('actividades_complementarias.alumnos.consulta_reg_actividades', $datos);

    expect(substr_count($html, 'id="agrega"'))->toBe($suma >= 40 ? 0 : 1)
        ->and(substr_count($html, 'class="elimina'))->toBe(1)
        ->and($html)->toContain('id="form_confirma"')->toContain('id="form_delete"')
        ->and(str_contains($html, "\$('#actividad_registrada').modal('show')"))->toBe($condicion === 1)
        ->and(str_contains($html, 'id="modal_edit_actalu"'))->toBe($edicion);
    if ($edicion) {
        expect($html)->toContain('action="/consulta_actividades/1"')->toContain('name="_method" value="PUT"');
    }
})->with([
    'menos de 40 horas' => [20, 0, false],
    'con 40 horas (sin botón de agregar)' => [40, 0, false],
    'actividad repetida (aviso)' => [20, 1, false],
    'modificar actividad (edit, sin actividades disponibles)' => [20, 0, true],
]);

it('Modificar actividad falla igual que antes cuando hay actividades disponibles', function () {
    // La vista principal reutiliza $docente_actividad como variable del @foreach y el parcial de edición recorre
    // después ese último elemento: error heredado del original (no se toca la lógica). Debe fallar igual.
    $datos = [
        'condicion' => 0, 'liberaa' => '', 'libera' => '', 'actividad' => '', 'nuevo' => 0, 'suma' => 20,
        'consulta_alumno' => [registroComplementaria(1, 0)], 'docente_actividad' => actividadesDisponibles(),
        'editar_actalu' => (object) ['id_registro_alumno' => 1, 'id_docente_actividad' => 2], 'edit' => true,
    ];
    $error = function (string $vista) use ($datos) {
        View::flushState();
        try {
            view($vista, $datos)->render();

            return null;
        } catch (\Throwable $e) {
            return preg_replace('/ \(View: .*$/s', '', ($e->getPrevious() ?? $e)->getMessage());
        }
    };

    expect($error('antes::actividades_complementarias.alumnos.consulta_reg_actividades'))->not->toBeNull()
        ->toBe($error('actividades_complementarias.alumnos.consulta_reg_actividades'));
});

it('Evidencias conserva un formulario de subida por evidencia faltante', function (array $faltan) {
    $alumnos = [];
    foreach ($faltan as $i => $f) {
        $alumnos[] = (object) ['descripcion' => "ACTIVIDAD $i", 'descripcion_cat' => 'CULTURAL', 'horas' => 20, 'creditos' => 1, 'no_evidencias' => 3,
            'rubrica' => "rubrica$i.pdf", 'id_registro_alumno' => 50 + $i, 'faltan' => $f];
    }
    $datos = ['restas' => $faltan, 'existe_id' => 0, 'alumnos' => $alumnos, 'numero_evidencia' => [], 'tabla_evidencias' => '', 'resta' => ''];

    $html = compararVistaComplementarias('actividades_complementarias.alumnos.carga_evidencias_alumnos', $datos);

    expect(substr_count($html, 'enctype="multipart/form-data"'))->toBe(array_sum($faltan))
        ->and(substr_count($html, 'name="urlImg[]"'))->toBe(array_sum($faltan))
        ->and($html)->toContain('/ArchivosDocentes//rubrica0.pdf')->toContain('jquery.blockUI.js');
})->with([
    'una actividad, 2 faltantes' => [[2]],
    'dos actividades, 0 y 3 faltantes' => [[0, 3]],
]);

it('Liberación y Créditos conservan sus datos', function () {
    $libera = [(object) ['descripcion' => 'FUTBOL', 'descripcion_cat' => 'DEPORTIVA', 'horas' => 20, 'creditos' => 1, 'promedio' => 95]];
    compararVistaComplementarias('actividades_complementarias.alumnos.liberacion_actividades', ['libera_activi' => $libera]);

    $creditos = [(object) ['ac' => 'FUTBOL', 'cre' => 1, 'titulo' => 'ING.', 'docente' => 'DOCENTE UNO', 'semestre' => 3, 'promedio' => 95]];
    $html = compararVistaComplementarias('actividades_complementarias.alumnos.creditos_semestres', ['historial_creditos' => $creditos]);
    expect($html)->toContain('ING. DOCENTE UNO');
});

it('el mensaje de Complementarias (vista compartida) conserva texto y lógica para cada rol que lo ve', function (string $rol, array $opciones, string $mensaje, string $tono) {
    EscenariosPanel::vaciar();
    $this->actingAs(EscenariosPanel::preparar($rol, $opciones));
    session(['ip' => 'http://localhost']);

    $html = compararVistaComplementarias('actividades_complementarias.alumnos.mensajes', ['mensaje_evidencias' => $mensaje]);

    $tonos = ['advertencia' => 'tw:bg-amber-50', 'error' => 'tw:bg-red-50'];
    preg_match('#<div[^>]*data-panel-mensaje[^>]*>#', $html, $alerta);
    expect($html)->toContain($mensaje)->toContain('window.location.href=direccion+"/evidencias_alumnos/";')
        ->and($alerta[0] ?? '')->toContain('role="alert"');
    // tono solo de diseño: aviso para el alumno con actividad sin aceptar, error en los demás casos
    expect(preg_match('#data-panel-mensaje[^>]*>#', $html) && str_contains(substr($html, strpos($html, 'data-panel-mensaje') - 600, 700), explode(' ', $tonos[$tono])[0]))->toBeTrue();
})->with([
    'alumno: actividad aún no aceptada (/evidencias_alumnos)' => ['alumno', ['semestre' => 5], 'AÚN NO HA SIDO ACEPTADA TU ACTIVIDAD', 'advertencia'],
    'jefe de división: sin actividad (/docente_actividad)' => ['jefe_division', [], 'NO EXISTE ACTIVIDAD', 'error'],
    'jefe de división: sin docentes (/docente_actividad)' => ['jefe_division', [], 'NO EXISTEN DOCENTES', 'error'],
    'docente con actividad: sin asignación (/planeacion_actividad)' => ['docente_actividad', [], 'NO EXISTE ASIGNACIÓN DE ACTIVIDAD', 'error'],
    'personal sin ninguna acción (/home)' => ['docente', [], 'NO TIENES NINGUNA ACCION', 'error'],
]);
