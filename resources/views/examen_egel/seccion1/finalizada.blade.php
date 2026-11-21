@extends('layouts.panel')
@section('title', 'Sección finalizada')
@include('partials.panel.recursos_app')
@section('content')

<main class="tw-pantalla tw:mx-auto tw:max-w-xl">
    <x-panel.encabezado titulo="Sección {{ $id_seccion }} finalizada" :migas="['Examen EGEL' => url('/examen_egel/dashboard')]" />

    <x-panel.tarjeta class="tw:text-center">

        <span class="fa fa-check-circle-o tw:text-5xl tw:text-green-500" aria-hidden="true"></span>

        <h4 class="tw:mt-4 tw:text-lg tw:font-semibold tw:text-green-700 tw:dark:text-green-500">
            Has completado correctamente la sección del examen.
        </h4>

        <p class="tw:mt-2 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">
            Tus respuestas han sido registradas correctamente.
        </p>

        <div class="tw:mt-6">
            <x-panel.boton tamano="lg" href="{{ url('/examen_egel/dashboard') }}">
                <span class="fa fa-home" aria-hidden="true"></span>
                Regresar al menú principal
            </x-panel.boton>
        </div>

    </x-panel.tarjeta>
</main>

@endsection
