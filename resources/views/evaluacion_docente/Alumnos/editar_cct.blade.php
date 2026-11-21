@extends('layouts.panel')
@section('title', 'Modificar CCT')
@include('partials.panel.recursos_app', ['datatables' => true])
@include('partials.panel.formularios')
@section('content')
    @include('evaluacion_docente.Alumnos.selector_cct', [
        'titulo' => 'Modificar escuela de procedencia',
        'urlGuardado' => url('/datos_alumnos/guardar_mod_cct/'.$id_alumno),
        'institucionActual' => $alumno->id_institucion,
    ])
@endsection
