@extends('layouts.panel')
@section('title', 'Encuesta contestada de Residencia Profesional')

@section('content')
    @php
        $base = '/encuestas_satisfaccion/';
        $migas = [
            'Periodos de las encuestas' => url($base.'agregar_periodo_year_residencia/'),
            'Programas de estudio' => url($base.'ver_enc_contestadas_residencia/'.$periodo->id_periodo_residencia),
            'Estudiantes de la carrera' => url($base.'ver_enc_contestadas_resi_alum/'.$encuesta_alumno->id_carrera.'/'.$periodo->id_periodo_residencia),
        ];
        $nombre = trim($encuesta_alumno->nombre.' '.$encuesta_alumno->apaterno.' '.$encuesta_alumno->amaterno);
    @endphp

    @include('encuestas_satisfacion_cliente.partials.respuestas_servicio_residencia', [
        'respuestas' => $encuesta_alumno,
        'subtitulo' => 'Residencia Profesional · No. de cuenta '.$encuesta_alumno->cuenta,
    ])
@endsection
