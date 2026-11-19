@extends('layouts.panel')
@section('title', 'Evaluación al Tutor')
@include('tutorias.partials.recursos_panel')
@section('content')
    @include('tutorias.alumnos.partial.navegacion_panel', ['titulo' => 'Evaluación al Tutor', 'activa' => '/tutoras_evaluacion/evaluacion_al_tutor/'])

    <div class="tw:mx-auto tw:max-w-xl">
        <x-panel.alerta tipo="exito">
            <h3 class="tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Encuesta realizada</h3>
        </x-panel.alerta>
    </div>
@endsection
