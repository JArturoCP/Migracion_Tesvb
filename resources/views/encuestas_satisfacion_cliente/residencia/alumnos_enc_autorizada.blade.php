@extends('layouts.panel')
@section('title', 'Encuestas de Residencia por carrera')
@include('partials.panel.recursos_app', ['datatables' => true])

@section('content')
    @include('encuestas_satisfacion_cliente.partials.encuestas_escolares_carrera', [
        'titulo' => 'Residencia Profesional',
        'migas' => [
            'Periodos de las encuestas' => url('/encuestas_satisfaccion/agregar_periodo_year_residencia/'),
            'Programas de estudio' => url('/encuestas_satisfaccion/ver_enc_contestadas_residencia/'.$id_periodo_residencia),
        ],
        'periodo_nom' => $periodo,
        'estudiantes' => $alumnos,
        'urlEncuesta' => url('/encuestas_satisfaccion/ver_enc_alumno_contestada'),
        'columnaEncuesta' => 'id_residencia_profesional',
    ])
@endsection
