@extends('layouts.panel')
@section('title', 'Encuesta de Servicio Social')
@include('partials.panel.recursos_app')
@include('partials.panel.formularios')

@section('content')
    @include('encuestas_satisfacion_cliente.partials.captura_servicio_residencia', [
        'titulo' => 'Encuesta de Servicio Social',
        'accion' => url('/encuestas_satisfaccion/guardar_encuesta_servicio/'.$id_alumno),
    ])
@endsection
