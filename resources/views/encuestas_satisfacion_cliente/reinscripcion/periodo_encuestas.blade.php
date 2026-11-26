@extends('layouts.panel')
@section('title', 'Periodo de encuestas de reinscripción')
@include('partials.panel.recursos_app')
@include('partials.panel.formularios')

@section('content')
    @include('encuestas_satisfacion_cliente.partials.periodo_escolar', [
        'titulo' => 'Periodo de encuestas de reinscripción',
        'urlCarreras' => url('/encuestas_satisfaccion/carrera_enc_reincripcion'),
        'urlResultados' => url('/encuestas_satisfaccion/ver_resultados_enc_reincripcion'),
        'urlCierre' => url('/encuestas_satisfaccion/envio_periodo_terminado_reins/'),
    ])
@endsection
