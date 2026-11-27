@extends('layouts.panel')
@section('title', 'Encuesta contestada de Servicio Social')

@section('content')
    @php
        $base = '/encuestas_satisfaccion/';
        $historial = session('historial_enc_s') == 1;
        $sufijo = '/'.$servicio->mes.'/'.$servicio->year;
        $migas = $historial
            ? ['Historial de encuestas' => url($base.'historial_periodo_year/'), 'Periodos de las encuestas' => url($base.'menu_historial_servicio_s_year/'.$servicio->year)]
            : ['Periodos de las encuestas' => url($base.'agregar_periodo_year/')];
        $migas['Programas de estudio'] = url($base.'ver_carreras_encuesta_servicio'.$sufijo);
        $migas['Encuestas contestadas'] = url($base.'ver_enc_serv_alum_terminado/'.$nombre_estudiante->id_carrera.$sufijo);
        $nombrePeriodo = ($servicio->mes == 1 ? 'Enero' : 'Julio').' de '.$servicio->year;
        $nombre = trim($nombre_estudiante->nombre.' '.$nombre_estudiante->apaterno.' '.$nombre_estudiante->amaterno);
    @endphp

    @include('encuestas_satisfacion_cliente.partials.respuestas_servicio_residencia', [
        'respuestas' => $servicio,
        'subtitulo' => 'Servicio Social · '.$nombrePeriodo.' · No. de cuenta '.$nombre_estudiante->cuenta,
    ])
@endsection
