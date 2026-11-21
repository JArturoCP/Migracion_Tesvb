<?php

use Illuminate\Support\Facades\View;
use Tests\Support\BalanceHtml;
use Tests\Support\CompararVistas;
use Tests\Support\EscenariosPanel;

beforeEach(function () {
    EscenariosPanel::crearEsquema();
    $this->withoutVite();
    View::addNamespace('antes', base_path('tests/Fixtures/vistas_antes'));
    View::share('errors', new \Illuminate\Support\ViewErrorBag());
});

dataset('formularios_panel', [
    'alta docente' => ['docentes.docentes_create', 'docente', 'form_docente_crea', ['m_perfil', 'm_situacion', 'm_abreviacion'], [
        'correo' => 'docente@example.test', 'perfiles' => [], 'situaciones' => [], 'abreviaciones' => [], 'cargos' => [],
    ]],
    'docentes en plantilla' => ['plantilla.docentes_plantilla', 'directivo', 'form_docente_crea', ['modal_agrega', 'modal_elimina', 'modal_materias'], [
        'docentes' => [(object) ['id_personal' => 7, 'nombre' => 'Docente demo', 'clave' => '001', 'descripcion' => 'Ingeniería', 'fch_recontratacion' => '2026-01-01']],
        'plantillas' => [(object) ['id_personal' => 8, 'nombre' => 'Docente de plantilla']],
    ]],
    'armar horarios' => ['horarios.armar_horarios', 'directivo', 'form_arma_horario', ['modal_crea_act', 'modal_periodo_change', 'notificacion1'], [
        'activo' => 1, 'id_carrera' => 1, 'tipo_cargo' => 3, 'id_profesor' => 7, 'personales' => [],
        'cargos' => [], 'materias' => [], 'extras' => [], 'aulas' => [], 'aula_comp' => [],
        'act_gestion' => [], 'act_vincu' => [], 'act' => 'false', 'falta_materia' => '',
    ]],
]);

it('mantiene el formulario principal y renderiza los diálogos del panel', function (string $vista, string $rol, string $formulario, array $modales, array $datos) {
    $this->actingAs(EscenariosPanel::preparar($rol, []));
    $html = view($vista, $datos)->render();
    $antes = view('antes::'.$vista, $datos)->render();
    $form = fn (string $pagina) => collect(CompararVistas::formulariosNavegador($pagina, '', ''))->firstWhere('id', $formulario);

    expect($form($html)['campos'])->toBe($form($antes)['campos'])
        ->and($form($html)['method'])->toBe($form($antes)['method'])
        ->and($html)->toContain('data-panel-contenido')
        ->not->toMatch('/<link[^>]*bootstrap|<script[^>]*bootstrap|class="modal fade/');
    foreach ($modales as $modal) {
        expect($html)->toMatch('/<div[^>]*id="'.preg_quote($modal, '/').'"[^>]*>\s*<div class="tw-modal-fondo"/');
    }
    expect(BalanceHtml::errores($html))->toBe([]);
})->with('formularios_panel');

it('enlaza cada paso con su sección y conserva el formulario de guardado', function (string $vista, string $id, string $formulario, array $datos) {
    $html = view($vista, $datos)->render();
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);

    for ($paso = 0; $paso < 3; $paso++) {
        $seccion = "$id-paso-$paso";
        expect($xpath->query("//button[@data-stepper-ir and @aria-controls='$seccion']")->length)->toBe(1)
            ->and($xpath->query("//section[@id='$seccion' and @data-stepper-seccion]")->length)->toBe(1);
    }

    expect($xpath->query("//form[@id='$formulario' and @data-stepper-formulario and @method='POST']")->length)->toBe(1)
        ->and($xpath->query("//button[@type='submit' and (@form='$formulario' or ancestor::form[@id='$formulario'])]")->length)->toBe(1);
})->with([
    'comisión' => ['comision_oficio.solicitud_oficio', 'comision', 'form_solicitud_oficio', [
        'estados_alu' => [], 'lugares' => [], 'estados_segundo' => [], 'estados_tercero' => [],
    ]],
    'incidencias' => ['incidencias.agregar', 'incidencia', 'form_guardar_solicitud', [
        'articulos' => [], 'estado_profesor' => 1, 'array_carreras' => [],
    ]],
    'titulación' => function () {
        $registro = new class
        {
            public function __get(string $nombre): string
            {
                return str_contains($nombre, 'fecha') ? '2025-06-01' : '1';
            }
        };

        return ['titulacion.jefe_titulacion.formulario_datos_titulado.reg_datos_alumno', 'titulacion', 'form_guardar_datos_alumno', [
            'estado_reg_datos' => 0, 'id_alumno' => 1, 'edad' => 23, 'fecha_nacimiento' => '19/01/2002',
            'registro_datos' => $registro, 'clave_carrera' => $registro, 'genero' => $registro, 'sexo' => $registro,
            'descuentos_alumn' => $registro, 'datos_alumnos' => $registro, 'reg_fecha_titulacion' => $registro,
            'titulo_obtenido' => $registro, 'titulos_disponibles' => [], 'tipos_decisiones' => [],
            'fundamentos_legal_s_s' => [], 'autorizaciones_reconocimiento' => [],
        ]];
    },
]);

it('separa la edición de la escuela del formulario de Datos del alumno', function () {
    $this->actingAs(EscenariosPanel::preparar('alumno', ['semestre' => 3]));
    $datosVacios = fn (array $valores) => new class($valores) {
        public function __construct(private array $valores) {}
        public function __get(string $campo): mixed { return $this->valores[$campo] ?? ''; }
    };
    $datos = [
        'datos' => $datosVacios(['id_alumno' => 3, 'fecha_nac' => '23/02/2007', 'promedio_preparatoria' => 8]),
        'datos_t' => $datosVacios(['id_tutor' => 6, 'fecha_nac_T' => '08/07/1982']),
        'institucion' => $datosVacios(['cct' => 'DEMO001', 'nombre_escuela' => 'Escuela de prueba']),
        'existe' => 1, 'dat' => 0, 'ed' => 0, 'edad' => 19, 'genero' => 'M', 'sem' => 3,
    ] + array_fill_keys(['carreras', 'grados', 'seguro', 'respuesta', 'estados_alu', 'estados_tutor', 'entidadnac', 'semestres'], []);

    $html = view('evaluacion_docente.Alumnos.datos_alumno', $datos)->render();
    $antes = view('antes::evaluacion_docente.Alumnos.datos_alumno', $datos)->render();
    $form = fn (string $pagina, string $id) => collect(CompararVistas::formulariosNavegador($pagina, '', ''))->firstWhere('id', $id);
    expect($form($html, 'formgeneral')['campos'])->toBe($form($antes, 'formgeneral')['campos'])
        ->and($form($html, 'formgeneral')['action'])->toEndWith('/datos_alumno')
        ->and($form($html, 'form_escuela_cct_modal')['campos'])->toBe(['_token', 'id_escuela'])
        ->and($html)->toContain('data-target="#editar_escuela_cct"', 'value="2007-02-23"', 'value="1982-07-08"')
        ->toContain('role="progressbar"', 'Paso 1 de 5', 'id="buscar_escuela_cct"', 'id="paso_alumno_fin" hidden')
        ->and(substr_count($html, 'aria-labelledby="paso-alumno-'))->toBe(5)
        ->and($html)->toContain('data-escuela-campo="cct"', 'data-escuela-campo="nombre_escuela"')
        ->not->toContain('bootstrap-datepicker')
        ->and(BalanceHtml::errores($html))->toBe([]);
});

it('renderiza la cuadrícula dinámica con el modal para quitar bloques', function () {
    $html = view('horarios.partialsh.partial_armar_horarios', [
        'ver_totales' => [], 'ssuma' => 0, 'imprime' => 1, 'noti' => 0, 'estado' => 0,
        'nombre_materia' => 'Demo', 'dias' => [], 'semanas' => [], 'ok' => 'false',
    ])->render();
    expect($html)->toContain('data-target="#modal_periodo_change"', 'id="modal_elimina"', 'id="confirma_elimina"')
        ->and(BalanceHtml::errores($html))->toBe([]);
});
