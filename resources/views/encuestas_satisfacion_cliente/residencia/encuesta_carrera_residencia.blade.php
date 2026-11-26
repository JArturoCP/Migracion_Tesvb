@extends('layouts.panel')
@section('title', 'Programas de estudio · Envío de encuestas de Residencia')

@section('content')
    @include('encuestas_satisfacion_cliente.partials.carreras_escolares', [
        'titulo' => 'Enviar encuestas de Residencia Profesional',
        'urlPeriodos' => url('/encuestas_satisfaccion/agregar_periodo_year_residencia/'),
        'urlAlumnos' => url('/encuestas_satisfaccion/ver_encuesta_residencia_alumno'),
        'periodo_nom' => null,
    ])
@endsection
