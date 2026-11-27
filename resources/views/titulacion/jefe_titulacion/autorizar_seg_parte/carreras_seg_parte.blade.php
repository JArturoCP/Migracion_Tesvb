@extends('layouts.panel')
@section('title', 'Datos personales de Titulación')

@section('content')
    @include('titulacion.partials.programas_estudio', [
        'titulo' => 'Datos personales de Titulación',
        'ruta' => '/titulacion/carrera_alum_reg_datos',
    ])
@endsection
