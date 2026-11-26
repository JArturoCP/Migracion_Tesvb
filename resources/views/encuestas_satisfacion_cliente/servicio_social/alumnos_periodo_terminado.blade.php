@extends('layouts.panel')
@section('title', 'Encuestas contestadas de Servicio Social')
@include('partials.panel.recursos_app', ['datatables' => true])

@section('content')
    @php
        $base = '/encuestas_satisfaccion/';
        $historial = session('historial_enc_s') == 1;
        $migas = $historial
            ? ['Historial de encuestas' => url($base.'historial_periodo_year/'), 'Periodos de las encuestas' => url($base.'menu_historial_servicio_s_year/'.$year)]
            : ['Periodos de las encuestas' => url($base.'agregar_periodo_year/')];
        $migas['Programas de estudio'] = url($base.'ver_carreras_encuesta_servicio/'.$mes.'/'.$year);
        $nombrePeriodo = ($mes == 1 ? 'Enero' : 'Julio').' de '.$year;
    @endphp

    @include('encuestas_satisfacion_cliente.partials.encuestas_escolares_carrera', [
        'titulo' => 'Servicio Social',
        'subtitulo' => 'Servicio Social · '.$nombrePeriodo,
        'estudiantes' => $encuestas,
        'urlEncuesta' => url($base.'ver_enc_terminada'),
        'columnaEncuesta' => 'id_servicio',
    ])
@endsection
