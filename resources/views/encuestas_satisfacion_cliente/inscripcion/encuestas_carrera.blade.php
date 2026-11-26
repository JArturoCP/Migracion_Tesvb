@extends('layouts.panel')
@section('title', 'Encuestas de inscripción')
@include('partials.panel.recursos_app', ['datatables' => true])

@section('content')
    @include('encuestas_satisfacion_cliente.partials.encuestas_escolares_carrera', [
        'titulo' => 'Encuestas de inscripción',
        'migas' => [
            'Periodos de las encuestas' => url('/encuestas_satisfaccion/encuesta_incripcion_periodo'),
            'Programas de estudio' => url('/encuestas_satisfaccion/carrera_enc_incripcion'),
        ],
        'urlEncuesta' => url('/encuestas_satisfaccion/enc_est_inscripcion'),
        'columnaEncuesta' => 'id_incripcion',
    ])
@endsection
