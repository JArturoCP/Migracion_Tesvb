@extends('layouts.panel')
@section('title', 'Resultados de encuestas de Servicio Social')
@include('partials.panel.recursos_app', ['graficas' => true])

@section('content')
    @php
        $base = '/encuestas_satisfaccion/';
        $historial = session('historial_enc_s') == 1;
        $migas = $historial
            ? ['Historial de encuestas' => url($base.'historial_periodo_year/'), 'Periodos de las encuestas' => url($base.'menu_historial_servicio_s_year/'.$year)]
            : ['Periodos de las encuestas' => url($base.'agregar_periodo_year/')];
        $migas['Programas de estudio'] = url($base.'ver_carreras_encuesta_servicio/'.$mes.'/'.$year);
    @endphp

    @include('encuestas_satisfacion_cliente.partials.resultados_servicio_residencia', [
        'titulo' => 'Resultados de encuestas de Servicio Social',
        'nombrePeriodo' => ($mes == 1 ? 'Enero' : 'Julio').' de '.$year,
        'migas' => $migas,
    ])
@endsection
