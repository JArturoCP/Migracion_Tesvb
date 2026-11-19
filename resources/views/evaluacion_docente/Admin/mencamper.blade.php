@extends('layouts.panel')
@section('title', 'Inicio')
@include('evaluacion_docente.partials.recursos_panel')
@section('content')
    <x-panel.encabezado titulo="Evaluación docente" :migas="['Profesores' => url('/buscar_profesores')]" />

    <div class="tw:mx-auto tw:max-w-2xl">
        <x-panel.alerta tipo="error">{{$mensage}}

        </x-panel.alerta>
    </div>

<script>


</script>
@endsection
