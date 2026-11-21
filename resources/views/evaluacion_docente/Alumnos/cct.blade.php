@extends('layouts.panel')
@section('title', 'Registro de CCT')
@include('partials.panel.recursos_app', ['datatables' => true])
@include('partials.panel.formularios')
@section('content')
    @include('evaluacion_docente.Alumnos.selector_cct', [
        'titulo' => 'Seleccionar escuela de procedencia',
        'urlGuardado' => url('/datos_alumnos/registrar_cct/'.$datos->id_alumno),
        'institucionActual' => null,
    ])
@endsection
