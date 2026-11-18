@extends('layouts.panel')
@section('title', 'Evaluacion docente')
@include('evaluacion_docente.partials.recursos_panel')
@section('content')
    <x-panel.encabezado titulo="Evaluación docente" />

    <div class="tw:mx-auto tw:max-w-2xl">
        <x-panel.alerta tipo="error">Derivado a que cursas un programa de estudio en el sistema dual no es posible la realización de evaluacion docente.</x-panel.alerta>
    </div>
@endsection
