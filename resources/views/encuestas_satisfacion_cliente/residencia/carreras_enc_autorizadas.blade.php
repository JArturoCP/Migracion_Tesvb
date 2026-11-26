@extends('layouts.panel')
@section('title', 'Programas de estudio · Encuestas de Residencia')

@section('content')
    @include('encuestas_satisfacion_cliente.partials.carreras_escolares', [
        'titulo' => 'Encuestas contestadas de Residencia Profesional',
        'urlPeriodos' => url('/encuestas_satisfaccion/agregar_periodo_year_residencia/'),
        'urlAlumnos' => url('/encuestas_satisfaccion/ver_enc_contestadas_resi_alum'),
        'sufijoRuta' => '/'.$periodo->id_periodo_residencia,
        'periodo_nom' => $periodo,
    ])
@endsection
