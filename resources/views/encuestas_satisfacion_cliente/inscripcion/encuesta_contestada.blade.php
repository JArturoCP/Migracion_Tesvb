@extends('layouts.panel')
@section('title', 'Encuestas de inscripción')

@section('content')
    @include('encuestas_satisfacion_cliente.partials.encuesta_escolar_contestada', [
        'titulo' => 'Encuestas de inscripción',
        'migas' => [
            'Periodos de las encuestas' => url('/encuestas_satisfaccion/encuesta_incripcion_periodo'),
            'Programas de estudio' => url('/encuestas_satisfaccion/carrera_enc_incripcion'),
        ] + ($estudiante ? [
            'Encuestas contestadas' => url('/encuestas_satisfaccion/alumnos_enc_incripcion/'.$estudiante->id_carrera),
        ] : []),
    ])
@endsection
