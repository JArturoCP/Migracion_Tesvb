@extends('layouts.panel')
@section('title', 'Periodo de encuestas de inscripción')
@include('partials.panel.recursos_app')
@include('partials.panel.formularios')

@section('content')
    @include('encuestas_satisfacion_cliente.partials.periodo_escolar', [
        'titulo' => 'Periodo de encuestas de inscripción',
        'urlCarreras' => url('/encuestas_satisfaccion/carrera_enc_incripcion'),
        'urlResultados' => url('/encuestas_satisfaccion/ver_resultados_enc_incripcion'),
        'urlCierre' => url('/encuestas_satisfaccion/envio_periodo_terminado/'),
    ])
@endsection
