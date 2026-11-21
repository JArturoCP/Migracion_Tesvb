@extends('layouts.panel')
@section('title', 'Instrucciones del examen')
@include('partials.panel.recursos_app')
@section('content')

<main class="tw-pantalla tw:mx-auto tw:max-w-3xl">
    <x-panel.encabezado titulo="INSTRUCCIONES GENERALES" :migas="['Examen EGEL' => url('/examen_egel/dashboard')]" />

    <x-panel.tarjeta titulo="Examen General de Egreso de la Licenciatura en Turismo" subtitulo="Modalidad en Línea (aplicación en institución)">

        <ul class="tw:divide-y tw:divide-gray-100 tw:rounded-xl tw:border tw:border-gray-200 tw:text-sm tw:text-gray-700 tw:dark:divide-gray-800 tw:dark:border-gray-800 tw:dark:text-gray-300">
            <li class="tw:px-4 tw:py-3">Permanezca en su lugar durante toda la aplicación del examen.</li>
            <li class="tw:px-4 tw:py-3">No se permitirá el uso de teléfonos celulares, audífonos, libros, cuadernos, apuntes o cualquier material de apoyo.</li>
            <li class="tw:px-4 tw:py-3">Siga en todo momento las instrucciones del personal aplicador.</li>
            <li class="tw:px-4 tw:py-3">Mantenga una conducta respetuosa y en silencio.</li>
            <li class="tw:px-4 tw:py-3">No abandone el área de aplicación sin autorización.</li>
            <li class="tw:px-4 tw:py-3">Cualquier intento de copia, uso de dispositivos no permitidos o conducta irregular será motivo de cancelación inmediata del examen.</li>
        </ul>

        <x-panel.alerta tipo="error" class="tw:mt-5">
            <strong>Al continuar, usted acepta cumplir con estas disposiciones.</strong>
        </x-panel.alerta>

        <div class="tw:mt-6 tw:text-center">
            <x-panel.boton variante="exito" tamano="lg" href="{{ route('egel.seccion.pregunta', ['id_seccion' => $id_seccion]) }}">
                <span class="fa fa-play" aria-hidden="true"></span> Iniciar Examen
            </x-panel.boton>
        </div>

    </x-panel.tarjeta>
</main>

@endsection
