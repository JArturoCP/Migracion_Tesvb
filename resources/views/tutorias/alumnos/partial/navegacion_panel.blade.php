{{--
    Encabezado y navegación interna de Tutorías del alumno en el panel (antes el menú de
    tutorias/partials/cuerpo.blade.php). Mismas opciones con las MISMAS condiciones de sesión:
      - con tutor asignado: Expediente, Actividades, Calendario de Actividades y, si estado_eva, Evaluación al Tutor;
      - sin tutor asignado: los mismos menús de jefe, tutor, coordinador, coordinador institucional y
        desarrollo académico (según su variable de sesión).
    "Regresar al sistema académico" y "Salir" ya están en el marco (Inicio y Cerrar sesión).
    Las insignias muestran los mismos datos que antes: nombre y periodo, tutor y generación.
    Parámetros: $titulo (título de la página) y $activa (url de la pestaña actual).
--}}
@php
    $items = [];
    if (Session::has('tutor_asignado')) {
        $items[] = ['etiqueta' => 'Expediente', 'url' => '/tutorias/inicioalu'];
        $items[] = ['etiqueta' => 'Actividades', 'url' => '/tutorias/actividad'];
        $items[] = ['etiqueta' => 'Calendario de actividades', 'url' => '/tutorias/calendario'];
        if (Session::get('estado_eva') == true) {
            $items[] = ['etiqueta' => 'Evaluación al tutor', 'url' => '/tutoras_evaluacion/evaluacion_al_tutor/'];
        }
    } elseif (Auth::check()) {
        if (Session::get('jefe')) {
            array_push($items,
                ['etiqueta' => 'Tutores y Coordinador', 'url' => '/tutorias/jefevista'],
                ['etiqueta' => 'Asigna Coordinador', 'url' => '/tutorias/asignacovista'],
                ['etiqueta' => 'Asigna Tutor', 'url' => '/tutorias/asignatuvista'],
                ['etiqueta' => 'Estudiantes', 'url' => '/tutorias/alumnos'],
                ['etiqueta' => 'Evaluación al Tutor', 'url' => '/tutoras_evaluacion/resultado_tutorias_jefe/carreras']);
        }
        if (Session::get('tutor')) {
            array_push($items,
                ['etiqueta' => Session::get('tutor') > 1 ? 'Grupos Tutorías' : 'Grupo Tutorías', 'url' => '/tutorias/tutorvista'],
                ['etiqueta' => 'Seguimiento', 'url' => '/tutorias/seguimiento'],
                ['etiqueta' => 'Deserción', 'url' => '/tutorias/desercion'],
                ['etiqueta' => 'Reporte Semestral', 'url' => '/tutorias/repsemestral'],
                ['etiqueta' => 'Evaluación al tutor', 'url' => '/tutoras_evaluacion/resultado_tutorias/']);
            if (Session::get('estado_eva') == false) {
                $items[] = ['etiqueta' => 'Cuestionario al tutor', 'url' => '/tutoras_evaluacion/auto_eveluacion/'];
            }
        }
        if (Session::get('coordinador')) {
            array_push($items,
                ['etiqueta' => Session::get('coordinador') > 1 ? 'Programas educativos' : 'Programa educativo', 'url' => '/tutorias/carreras'],
                ['etiqueta' => 'Evaluación al Tutor', 'url' => '/tutoras_evaluacion/resultado_tutorias_jefe/carreras'],
                ['etiqueta' => 'Reporte Semestral', 'url' => '/tutorias/reportecoordinador/repsemestralcarrera']);
        }
        if (Session::get('coordinadorgeneral')) {
            array_push($items,
                ['etiqueta' => 'Planeación', 'url' => '/tutorias/planeacioncoorgen'],
                ['etiqueta' => 'Programas educativos', 'url' => '/tutorias/estadisticas/carreras'],
                ['etiqueta' => 'Evaluación al tutor', 'url' => '/tutoras_evaluacion/resultado_tutorias_cordinador/'],
                ['etiqueta' => 'Reporte Semestral', 'url' => '/tutorias/reporteinstitucional/repsemestral_ins'],
                ['etiqueta' => 'Seguimiento a Coordinadores', 'url' => '/tutorias/FO-40/'],
                ['etiqueta' => 'Análisis de tutores', 'url' => '/tutorias/analisis/'],
                ['etiqueta' => 'Buscador', 'url' => '/tutorias/formulario/']);
        }
        if (Session::get('desarrollo')) {
            array_push($items,
                ['etiqueta' => 'Coordinador Institucional', 'url' => '/tutorias/desarrollovista'],
                ['etiqueta' => 'Asigna Coordinador Institucional', 'url' => '/tutorias/asignacorgenvista'],
                ['etiqueta' => 'Planeación', 'url' => '/tutorias/planeaciondesarrollo'],
                ['etiqueta' => 'Programas educativos', 'url' => '/tutorias/estadisticas/carreras'],
                ['etiqueta' => 'Evaluación al Tutor', 'url' => '/tutoras_evaluacion/resultado_tutorias_cordinador/'],
                ['etiqueta' => 'Activacion de Evaluacion al Tutor', 'url' => '/tutorias/evaluacion_tutor/estado/'],
                ['etiqueta' => 'Seguimiento a Coordinadores', 'url' => '/tutorias/FO-40/'],
                ['etiqueta' => 'Buscador', 'url' => '/tutorias/formulario/']);
        }
    }
    foreach ($items as &$item) {
        $item['activa'] = isset($activa) && $item['url'] === $activa;
    }
    unset($item);
@endphp

<x-panel.encabezado :titulo="$titulo" :migas="['Tutorías' => url('/tutorias/inicioalu')]">
    @if (Session::get('nombre') || Session::has('tutor_asignado'))
        <x-slot:extra>
            @if (Session::get('nombre'))
                <x-panel.badge data-tutorias-insignia="alumno">{{ Session::get('nombre') }} · Periodo: {{ Session::get('nombre_periodo') }}</x-panel.badge>
            @endif
            @if (Session::has('tutor_asignado'))
                <x-panel.badge tono="info" data-tutorias-insignia="tutor">Tutor {{ Session::get('tutor_asignado') }} · {{ Session::get('generacion_asignada') }}</x-panel.badge>
            @endif
        </x-slot:extra>
    @endif
</x-panel.encabezado>

@if (count($items))
    <x-panel.pestanas :items="$items" data-tutorias-navegacion />
@endif
