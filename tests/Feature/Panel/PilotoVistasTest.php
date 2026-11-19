<?php

/*
 * Piloto del rediseño (Tutorías del alumno y Evaluación docente del alumno y del directivo):
 * cada vista migrada se renderiza con los MISMOS datos que su versión anterior
 * (tests/Fixtures/vistas_antes, namespace "antes::") y se compara el área de contenido:
 *   - formularios: action, method, _token y name de los campos, en el mismo orden;
 *   - name de todos los campos (también los que usan Vue y jQuery fuera de formularios);
 *   - ids y clases que usan los scripts;
 *   - textos: todo dato o texto de antes sigue en la página;
 * y que la página nueva usa el panel (layouts.panel) sin Bootstrap.
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

function pilotoRender(string $vista, array $datos): string
{
    View::flushState();

    return view($vista, $datos)->render();
}

function pilotoObj(array $a): object
{
    return (object) $a;
}

dataset('vistas_piloto', function () {
    $tutorias = ['nombre' => 'PÉREZ LÓPEZ ANA', 'nombre_periodo' => 'AGO-DIC 2026', 'tutor_asignado' => 'TUTOR DE PRUEBA', 'generacion_asignada' => 'Generación 2024 Grupo 1', 'estado_eva' => true];
    $actividades = collect([
        pilotoObj(['fi_actividad' => '2026-08-10', 'ff_actividad' => '2026-08-20', 'desc_actividad' => 'Plática de inducción', 'objetivo_actividad' => 'Integrar al grupo', 'estrategia' => 'Dinámica grupal', 'requiere_evidencia' => null, 'id_asigna_planeacion_tutor' => 11, 'evidencia' => collect()]),
        pilotoObj(['fi_actividad' => '2026-09-01', 'ff_actividad' => '2026-09-05', 'desc_actividad' => 'Test de estilos', 'objetivo_actividad' => 'Conocer su estilo', 'estrategia' => 'Cuestionario', 'requiere_evidencia' => 1, 'id_asigna_planeacion_tutor' => 12, 'evidencia' => collect([pilotoObj(['id_evidencia' => 77, 'evidencia' => 'evidencia77.pdf'])])]),
        pilotoObj(['fi_actividad' => '2026-10-01', 'ff_actividad' => '2026-10-03', 'desc_actividad' => 'Hábitos de estudio', 'objetivo_actividad' => 'Mejorar hábitos', 'estrategia' => 'Taller', 'requiere_evidencia' => 1, 'id_asigna_planeacion_tutor' => 13, 'evidencia' => collect()]),
    ]);
    $alumnoTutorias = pilotoObj(['id_asigna_tutor' => 5, 'id_asigna_alumno' => 9, 'foto' => 'image/png', 'cuenta' => '202610003', 'id_alumno' => 3]);
    $docentes = [pilotoObj(['nombre' => 'DOCENTE UNO', 'materias' => 'CÁLCULO', 'id_semestre' => 3, 'grupo' => 1, 'id_hrs_profesor' => 31])];
    $especial = [pilotoObj(['nombre' => 'DOCENTE ESPECIAL', 'materias' => 'TALLER', 'id_semestre' => 3, 'grupo' => 2, 'id' => 900, 'id_hrs_profesor' => 32])];
    $profesores = [
        pilotoObj(['ma' => 'CÁLCULO', 'p' => 'DOCENTE UNO', 'id_alumno_materia' => 41, 'indice' => 1]),
        pilotoObj(['ma' => 'FÍSICA', 'p' => 'DOCENTE DOS', 'id_alumno_materia' => 42, 'indice' => 2]),
    ];
    $evaluacion = fn (array $c) => $c + ['estado' => 0, 'no' => 1, 'docentes' => $docentes, 'materiase' => 0, 'docentes_especial' => $especial,
        'id_pregunta' => 5, 'pregunta' => 'El docente explica con claridad', 'id_tabla' => 77, 'num' => 2, 'profesores' => $profesores];
    $preguntas2 = [
        ['id_criterio' => 1, 'calificacion' => 4.5, 'nombre_criterio' => 'DOMINIO DE LA ASIGNATURA', 'observacioncri' => 'NOTABLE', 'cantidad' => 2,
            'preguntas' => [['pregunta' => '¿Domina la materia?', 'calificacion' => 4.5, 'observacion' => 'NOTABLE']]],
        ['id_criterio' => 2, 'calificacion' => 3.1, 'nombre_criterio' => 'PLANIFICACIÓN DEL CURSO', 'observacioncri' => 'INSUFICIENTE', 'cantidad' => 2,
            'preguntas' => [['pregunta' => '¿Entrega el programa?', 'calificacion' => 3.1, 'observacion' => 'INSUFICIENTE']]],
    ];
    $carrerasReporte = [['id_carrera' => 4, 'nombre_carrera' => 'INGENIERÍA EN GESTIÓN EMPRESARIAL',
        'materias' => [['nombre_materia' => 'MATEMÁTICAS DISCRETAS', 'nombre_grupo' => '404', 'id_hrs' => 55, 'idcarrera' => 4]]]];
    $reporte2 = ['preguntas2' => $preguntas2, 'promedio_t' => 3.8, 'id_profesor' => 4, 'carreras' => $carrerasReporte, 'profesor' => 'CARLOS PÉREZ AGUILAR',
        'mat_evaluacion' => [['materia' => 'MATEMÁTICAS DISCRETAS 404', 'total' => 30, 'total_si' => 25, 'promedio' => 3.8]], 'g_id_hrs' => 0, 'condi' => 1, 'g_carrera' => 0];
    $carrerasAlumnos = [pilotoObj(['id_carrera' => 1, 'nombre' => 'INGENIERÍA EN SISTEMAS', 'por' => 50, 'total' => 3, 'ya' => 1]),
        pilotoObj(['id_carrera' => 2, 'nombre' => 'INGENIERÍA INDUSTRIAL', 'por' => 80, 'total' => 2, 'ya' => 2])];
    $alumnosEval = [pilotoObj(['id_carrera' => 1, 'no_pregunta' => 1000, 'cuenta' => '202610001', 'nombre' => 'ANA', 'apaterno' => 'RUIZ', 'amaterno' => 'SOTO', 'id_semestre' => 3])];
    $alumnosNo = [pilotoObj(['id_carrera' => 1, 'no_pregunta' => 0, 'cuenta' => '202610002', 'nombre' => 'LUIS', 'apaterno' => 'MORA', 'amaterno' => 'PAZ', 'id_semestre' => 3]),
        pilotoObj(['id_carrera' => 1, 'no_pregunta' => 40, 'cuenta' => '202610004', 'nombre' => 'EVA', 'apaterno' => 'LUNA', 'amaterno' => 'RÍOS', 'id_semestre' => 5])];

    // nombre => [vista, rol, datos, sesión, layout anterior (tutorias|app)]
    return [
        'tutorías: iniciar registro de expediente' => ['tutorias.alumnos.incio_registro', 'alumno', [], $tutorias, 'tutorias'],
        'tutorías: expediente sin datos de alumno' => ['tutorias.alumnos.index', 'alumno', ['alumno' => null], $tutorias, 'tutorias'],
        'tutorías: expediente con foto' => ['tutorias.alumnos.index', 'alumno', ['alumno' => $alumnoTutorias], $tutorias, 'tutorias'],
        'tutorías: llenar expediente (Vue + test NSE)' => ['tutorias.alumnos.expediente', 'alumno', [], $tutorias, 'tutorias'],
        'tutorías: editar expediente (Vue)' => ['tutorias.alumnos.expedienteUpdate', 'alumno', [], $tutorias, 'tutorias'],
        'tutorías: actividades' => ['tutorias.actividades_alumno.actividades_alumno', 'alumno', ['datos' => $actividades], $tutorias, 'tutorias'],
        'tutorías: calendario' => ['tutorias.calendario_eventos.calendario_eventos', 'alumno', ['evento' => $actividades], $tutorias, 'tutorias'],
        'tutorías: evaluación al tutor (1)' => ['tutorias.eva_tutorias.alumnos_index', 'alumno', ['alumno' => $alumnoTutorias, 'estado_eva' => true], $tutorias, 'tutorias'],
        'tutorías: evaluación al tutor (2)' => ['tutorias.eva_tutorias.alumnos_index_dos', 'alumno', ['alumno' => $alumnoTutorias], $tutorias, 'tutorias'],
        'tutorías: evaluación al tutor (3)' => ['tutorias.eva_tutorias.alumnos_index_tres', 'alumno', ['alumno' => $alumnoTutorias], $tutorias, 'tutorias'],
        'tutorías: encuesta realizada' => ['tutorias.eva_tutorias.encuesta_realizada', 'alumno', [], $tutorias, 'tutorias'],
        'eval. docente alumno: docentes a evaluar (materias especiales)' => ['evaluacion_docente.Alumnos.evaluacion_docente', 'alumno', $evaluacion(['no' => 0, 'materiase' => 1]), ['ip' => '127.0.0.1'], 'app'],
        'eval. docente alumno: pregunta 5' => ['evaluacion_docente.Alumnos.evaluacion_docente', 'alumno', $evaluacion([]), ['ip' => '127.0.0.1'], 'app'],
        'eval. docente alumno: pregunta 48 con comentarios' => ['evaluacion_docente.Alumnos.evaluacion_docente', 'alumno', $evaluacion(['id_pregunta' => 48]), ['ip' => '127.0.0.1', 'success' => 'Guardado'], 'app'],
        'eval. docente alumno: carga no validada' => ['evaluacion_docente.Alumnos.evaluacion_docente', 'alumno', $evaluacion(['estado' => 1, 'no' => 0]), [], 'app'],
        'eval. docente alumno: fin (pregunta 49)' => ['evaluacion_docente.Alumnos.evaluacion_docente', 'alumno', $evaluacion(['id_pregunta' => 49, 'pregunta' => 'GRACIAS POR EVALUAR']), [], 'app'],
        'eval. docente alumno: mensaje de carga' => ['evaluacion_docente.Alumnos.mensages', 'alumno', ['mensage_carga' => 'Tu carga académica no ha sido dada de alta', 'color' => 1], [], 'app'],
        'eval. docente alumno: mensaje correcto' => ['evaluacion_docente.Alumnos.mensages', 'alumno', ['mensage_carga' => 'Carga validada', 'color' => 2], [], 'app'],
        'eval. docente alumno: carga sin autorizar' => ['evaluacion_docente.Alumnos.mensaje_modi_carga', 'alumno', [], [], 'app'],
        'eval. docente alumno: sistema dual' => ['evaluacion_docente.Alumnos.mensaje_dual', 'alumno', [], [], 'app'],
        'eval. docente directivo: profesores' => ['evaluacion_docente.Admin.buscar', 'directivo', ['profesores' => [pilotoObj(['nombre' => 'CARLOS PÉREZ AGUILAR', 'id_personal' => 4])], 'carreras' => []], [], 'app'],
        'eval. docente directivo: reporte (unidad)' => ['evaluacion_docente.Admin.reportes2', 'directivo', $reporte2, ['id_unidad_admin' => 25], 'app'],
        'eval. docente directivo: reporte (sin unidad)' => ['evaluacion_docente.Admin.reportes2', 'directivo', $reporte2, [], 'app'],
        'eval. docente directivo: reporte sin registro' => ['evaluacion_docente.Admin.mencamper', 'directivo', ['mensage' => 'No existe registro de Evaluación Docente en este periodo'], [], 'app'],
        'eval. docente directivo: reporte anterior' => ['evaluacion_docente.Admin.reportes', 'directivo', ['solo_id_profesor' => 4, 'carreras' => $carrerasReporte, 'preguntas2' => $preguntas2], [], 'app'],
        'eval. docente directivo: alumnos (activa)' => ['evaluacion_docente.Alumnos.buscar', 'directivo', ['carreras' => $carrerasAlumnos, 'alumnos' => $alumnosEval, 'alumnoss' => $alumnosNo, 'activa_eva' => 1, 'evaluar' => 1, 'carreras2' => [], 'evaluar_x' => 0], [], 'app'],
        'eval. docente directivo: alumnos (inactiva)' => ['evaluacion_docente.Alumnos.buscar', 'directivo', ['carreras' => $carrerasAlumnos, 'alumnos' => $alumnosEval, 'alumnoss' => $alumnosNo, 'activa_eva' => 0, 'evaluar' => 0], [], 'app'],
        'eval. docente directivo: migrar' => ['evaluacion_docente.Admin.mensages2', 'directivo', ['mensage_carga' => 'Se realizaron los cálculos', 'color' => 2], [], 'app'],
    ];
});

it('conserva formularios, campos, ids, clases de scripts y datos', function (string $vista, string $rol, array $datos, array $sesion, string $antes) {
    $this->actingAs(EscenariosPanel::preparar($rol, ['semestre' => 3]));
    session($sesion);

    $viejo = pilotoRender('antes::' . $vista, $datos);
    $nuevo = pilotoRender($vista, $datos);

    $a = CompararVistas::region($viejo, $antes === 'tutorias' ? '//div[@id="app"]//main' : '//div[@class="tesvb-contenido"]');
    $b = CompararVistas::region($nuevo, '//*[@data-panel-contenido]');

    expect(CompararVistas::formularios($b))->toEqual(CompararVistas::formularios($a))
        ->and(CompararVistas::nombres($b))->toEqual(CompararVistas::nombres($a));

    $idsNuevos = CompararVistas::ids($b);
    expect(array_values(array_diff(CompararVistas::ids($a), $idsNuevos)))->toBe([]);

    $clasesUsadas = array_intersect(CompararVistas::clasesDeScripts($a), CompararVistas::clases($a));
    expect(array_values(array_diff($clasesUsadas, CompararVistas::clases($b))))->toBe([]);

    // Los datos se buscan en toda la página nueva (algunas vistas anteriores, con HTML sin balancear, dejaban el pie dentro del contenido).
    $textoNuevo = CompararVistas::textoPlano(CompararVistas::region($nuevo, '//body'));
    $faltan = array_values(array_filter(CompararVistas::textos($a), fn ($t) => ! str_contains($textoNuevo, $t)));
    expect($faltan)->toBe([]);
})->with('vistas_piloto');

it('usa el panel, no carga Bootstrap y su HTML está balanceado', function (string $vista, string $rol, array $datos, array $sesion) {
    $this->actingAs(EscenariosPanel::preparar($rol, ['semestre' => 3]));
    session($sesion);

    $html = pilotoRender($vista, $datos);

    expect($html)->toContain('data-panel-marco')
        ->toContain('data-panel-contenido')
        ->toContain('window.PanelModal')                       // puente de modales/pestañas sin Bootstrap
        ->toContain('Cambiar entre modo claro y oscuro')    // modo oscuro en todas las pantallas
        ->and(BalanceHtml::errores($html))->toBe([]);

    foreach (CompararVistas::recursos($html) as $recurso) {
        expect($recurso)->not->toMatch('/bootstrap|css_tutorias\/app\.css|\/css\/app\.css|estilos\.css/i');
    }
})->with('vistas_piloto');

it('Tutorías del alumno: pestañas con las mismas opciones y condiciones de sesión', function () {
    $this->actingAs(EscenariosPanel::preparar('alumno', ['semestre' => 3]));
    $enlaces = function (array $sesion) {
        session()->flush();
        session($sesion);
        $html = pilotoRender('tutorias.eva_tutorias.encuesta_realizada', []);
        preg_match('/data-tutorias-navegacion.*?<\/nav>/s', $html, $m);
        preg_match_all('/href="([^"]+)"/', $m[0] ?? '', $h);

        return $h[1];
    };

    expect($enlaces(['tutor_asignado' => 'X', 'estado_eva' => true]))
        ->toBe(['/tutorias/inicioalu', '/tutorias/actividad', '/tutorias/calendario', '/tutoras_evaluacion/evaluacion_al_tutor/'])
        ->and($enlaces(['tutor_asignado' => 'X', 'estado_eva' => false]))
        ->toBe(['/tutorias/inicioalu', '/tutorias/actividad', '/tutorias/calendario'])
        ->and($enlaces(['tutor' => 2]))
        ->toBe(['/tutorias/tutorvista', '/tutorias/seguimiento', '/tutorias/desercion', '/tutorias/repsemestral', '/tutoras_evaluacion/resultado_tutorias/', '/tutoras_evaluacion/auto_eveluacion/']);
});
