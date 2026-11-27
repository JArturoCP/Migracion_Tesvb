@extends('layouts.panel')
@section('title', 'Encuestas de reinscripción')

@section('content')
    @include('encuestas_satisfacion_cliente.partials.carreras_escolares', [
        'titulo' => 'Encuestas de reinscripción',
        'urlPeriodos' => url('/encuestas_satisfaccion/encuesta_reincripcion_periodo'),
        'urlAlumnos' => url('/encuestas_satisfaccion/alumnos_enc_reincripcion'),
    ])
@endsection
