@extends('layouts.panel')
@section('title', 'Encuestas de reinscripción')

@section('content')
    @include('encuestas_satisfacion_cliente.partials.encuesta_escolar_contestada', [
        'titulo' => 'Encuestas de reinscripción',
        'migas' => [
            'Periodos de las encuestas' => url('/encuestas_satisfaccion/encuesta_reincripcion_periodo'),
            'Programas de estudio' => url('/encuestas_satisfaccion/carrera_enc_reincripcion'),
        ] + ($estudiante ? [
            'Encuestas contestadas' => url('/encuestas_satisfaccion/alumnos_enc_reincripcion/'.$estudiante->id_carrera),
        ] : []),
    ])
@endsection
