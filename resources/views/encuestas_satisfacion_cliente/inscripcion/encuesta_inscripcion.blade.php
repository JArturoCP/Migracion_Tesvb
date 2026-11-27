@extends('layouts.panel')
@section('title', 'Encuesta de inscripción')
@include('partials.panel.recursos_app')
@include('partials.panel.formularios')

@section('content')
    @include('encuestas_satisfacion_cliente.partials.encuesta_escolar', [
        'titulo' => 'Encuesta de inscripción',
        'accion' => url('/encuestas_satisfaccion/enviar_encuesta_incripcion/'),
    ])
@endsection
