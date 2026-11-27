@extends('layouts.panel')
@section('title', 'Encuestas de reinscripción')
@include('partials.panel.recursos_app', ['datatables' => true])

@section('content')
    @include('encuestas_satisfacion_cliente.partials.encuestas_escolares_carrera', [
        'titulo' => 'Encuestas de reinscripción',
        'migas' => [
            'Periodos de las encuestas' => url('/encuestas_satisfaccion/encuesta_reincripcion_periodo'),
            'Programas de estudio' => url('/encuestas_satisfaccion/carrera_enc_reincripcion'),
        ],
        'urlEncuesta' => url('/encuestas_satisfaccion/enc_est_reinscripcion'),
        'columnaEncuesta' => 'id_reinscripcion',
    ])
@endsection
