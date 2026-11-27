@extends('layouts.panel')
@section('title', 'Documentación de requisitos de titulación')

@section('content')
    @include('titulacion.partials.programas_estudio', [
        'titulo' => 'Documentación de requisitos de titulación',
        'ruta' => '/titulacion/autorizar_alumnos_doc_requisitos',
    ])
@endsection
