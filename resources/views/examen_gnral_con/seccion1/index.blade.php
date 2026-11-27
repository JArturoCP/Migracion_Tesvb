@extends('layouts.panel')

@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

<x-panel.encabezado titulo="Instrucciones generales" :migas="['Examen general de conocimientos' => null]" />
    <div class="tw:w-full" style="margin-top: 40px; max-width: 900px;">

    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

        {{-- ENCABEZADO --}}
        

        <div class="tw:p-5 tw:sm:p-6">

            {{-- TÍTULO DINÁMICO --}}
            <h4 class="tw:text-center tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:font-semibold" style="margin-top: 10px">Examen de Conocimientos Generales </h4>

            <h5 class="tw:text-center tw:text-gray-500 tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">
                Modalidad en Línea (aplicación en institución)
            </h5>

            <hr>

            {{-- INSTRUCCIONES --}}
            <x-panel.alerta tipo="info" class="tw:mb-4">
                Lea cuidadosamente las siguientes indicaciones antes de iniciar el examen
            </x-panel.alerta>

            <ul class="tw:divide-y tw:divide-gray-100 tw:rounded-lg tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:mt-5">
                <li class="tw:block tw:px-4 tw:py-3">Permanezca en su lugar durante toda la aplicación del examen.</li>
                <li class="tw:block tw:px-4 tw:py-3">No se permitirá el uso de teléfonos celulares, audífonos, libros, cuadernos o apuntes.</li>
                <li class="tw:block tw:px-4 tw:py-3">Siga en todo momento las instrucciones del personal aplicador.</li>
                <li class="tw:block tw:px-4 tw:py-3">Mantenga una conducta respetuosa y en silencio.</li>
                <li class="tw:block tw:px-4 tw:py-3">No abandone el área de aplicación sin autorización.</li>
                <li class="tw:block tw:px-4 tw:py-3">
                    Cualquier intento de copia o uso de dispositivos no permitidos será motivo de cancelación inmediata del examen.
                </li>
            </ul>

            {{-- ALERTA --}}
            <x-panel.alerta tipo="error" class="tw:mb-4">
                <strong>
                    Al continuar, usted acepta cumplir con estas disposiciones.
                </strong>
            </x-panel.alerta>

            {{-- BOTÓN --}}
            <div class="tw:text-center" style="margin-top: 30px;">
                <a href="{{ route('examen_general.seccion.pregunta', ['id_seccion' => $id_seccion]) }}"
                   class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
                    <i class="fa fa-play"></i>
                    Iniciar Examen
                </a>
            </div>

        </div>
    </div>

</div>

</div>
@endsection