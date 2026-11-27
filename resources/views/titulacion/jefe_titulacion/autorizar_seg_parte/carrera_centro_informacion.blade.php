@extends('layouts.panel')
@section('title', 'Documentos de Titulación autorizados')

@section('content')
    @include('titulacion.partials.programas_estudio', [
        'titulo' => 'Documentos de Titulación autorizados',
        'ruta' => '/titulacion/carrera_informacion',
    ])
@endsection
