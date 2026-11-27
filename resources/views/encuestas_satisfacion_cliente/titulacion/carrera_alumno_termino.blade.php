@extends('layouts.panel')
@section('title', 'Encuestas contestadas de Titulación')
@include('partials.panel.recursos_app', ['datatables' => true])

@section('content')
    @php
        $base = '/encuestas_satisfaccion/';
        $historial = session('historial_enc_t') == 1;
        $migas = $historial
            ? ['Historial de encuestas' => url($base.'historial_encuesta_estudiante_titulacion'), 'Periodos de las encuestas' => url($base.'menu_historial_titulacion_year/'.$year)]
            : ['Periodos de las encuestas' => url($base.'enviar_encuesta_estudiante_titulacion')];
        $migas['Programas de estudio'] = url($base.'enc_contestadas_carreras_ti/'.$mes.'/'.$year);
        $nombrePeriodo = ($mes == 1 ? 'Enero' : 'Julio').' de '.$year;
    @endphp

    @include('encuestas_satisfacion_cliente.partials.encuestas_escolares_carrera', [
        'titulo' => 'Titulación',
        'subtitulo' => 'Titulación · '.$nombrePeriodo,
        'estudiantes' => $alumnos,
        'urlEncuesta' => url($base.'enc_est_ti_alumno_termino'),
        'columnaEncuesta' => 'id_titulacion',
    ])
@endsection
