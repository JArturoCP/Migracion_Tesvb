@extends('layouts.panel')
@section('title', 'Evaluacion docente')
@include('evaluacion_docente.partials.recursos_panel')
@section('content')
    <x-panel.encabezado titulo="Evaluación docente" />

    <div class="tw:mx-auto tw:max-w-2xl">
        <x-panel.alerta tipo="error">Revisa que tu carga académica este autorizada.</x-panel.alerta>
    </div>
@endsection
