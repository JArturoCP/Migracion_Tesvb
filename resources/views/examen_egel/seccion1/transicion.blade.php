@extends('layouts.panel')
@section('title', 'Área concluida')
@include('partials.panel.recursos_app')
@section('content')

<main class="tw-pantalla tw:mx-auto tw:max-w-2xl">
    <x-panel.encabezado titulo="Área concluida" :migas="['Examen EGEL' => url('/examen_egel/dashboard')]" />

    <x-panel.tarjeta class="tw:text-center">

        <span class="fa fa-check-circle-o tw:text-5xl tw:text-green-500" aria-hidden="true"></span>

        <x-panel.alerta tipo="exito" class="tw:mt-4 tw:text-left">
            Has concluido el área: <strong>{{ $moduloActual->nombre }}</strong>
        </x-panel.alerta>

        <h4 class="tw:mt-6 tw:mb-5 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
            Prepárate para comenzar la siguiente área
        </h4>

        <x-panel.boton tamano="lg" href="{{ route('egel.seccion.pregunta', [
                'id_seccion' => $id_seccion,
                'page' => $nextPage
            ]) }}">
            <span class="fa fa-arrow-right" aria-hidden="true"></span>
            Comenzar siguiente área
        </x-panel.boton>

    </x-panel.tarjeta>
</main>

@endsection
