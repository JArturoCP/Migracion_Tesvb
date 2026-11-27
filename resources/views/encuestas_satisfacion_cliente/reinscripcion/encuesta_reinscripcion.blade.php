@extends('layouts.panel')
@section('title', 'Encuesta de reinscripción')
@include('partials.panel.recursos_app')
@include('partials.panel.formularios')

@section('content')
    @include('encuestas_satisfacion_cliente.partials.encuesta_escolar', [
        'titulo' => 'Encuesta de reinscripción',
        'accion' => url('/encuestas_satisfaccion/enviar_encuesta_reinscripcion/'),
    ])
@endsection
