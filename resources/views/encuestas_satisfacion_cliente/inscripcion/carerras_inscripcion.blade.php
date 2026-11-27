@extends('layouts.panel')
@section('title', 'Encuestas de inscripción')

@section('content')
    @include('encuestas_satisfacion_cliente.partials.carreras_escolares', [
        'titulo' => 'Encuestas de inscripción',
        'urlPeriodos' => url('/encuestas_satisfaccion/encuesta_incripcion_periodo'),
        'urlAlumnos' => url('/encuestas_satisfaccion/alumnos_enc_incripcion'),
    ])
@endsection
