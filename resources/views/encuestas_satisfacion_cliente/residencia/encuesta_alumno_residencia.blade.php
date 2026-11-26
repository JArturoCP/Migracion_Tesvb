@extends('layouts.panel')
@section('title', 'Encuesta de Residencia Profesional')
@include('partials.panel.recursos_app')
@include('partials.panel.formularios')

@section('content')
    @include('encuestas_satisfacion_cliente.partials.captura_servicio_residencia', [
        'titulo' => 'Encuesta de Residencia Profesional',
        'accion' => url('/encuestas_satisfaccion/guardar_encuesta_residencia/'.$id_alumno),
    ])
@endsection
