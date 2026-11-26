@extends('layouts.panel')
@include('partials.panel.recursos_app')

@section('content')

<div class="tw:w-full" style="margin-top: 40px; max-width: 900px;">

    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">

        {{-- ENCABEZADO --}}
        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4 tw:text-center" style="background-color: #f0ad4e; color: white;">
            <h3 style="margin: 0;">
                <i class="fa fa-info-circle"></i>
                INSTRUCCIONES GENERALES
            </h3>
        </div>

        <div class="tw:p-5 tw:sm:p-6">

            {{-- TÍTULO DINÁMICO --}}
            <h4 class="tw:text-center" style="font-weight: bold; margin-top: 10px;">Examen de Conocimientos Generales </h4>

            <h5 class="tw:text-center tw:text-gray-500">
                Modalidad en Línea (aplicación en institución)
            </h5>

            <hr>

            {{-- INSTRUCCIONES --}}
            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-sky-200 tw:bg-sky-50 tw:text-sky-800 tw:text-center">
                Lea cuidadosamente las siguientes indicaciones antes de iniciar el examen
            </div>

            <ul class="tw:divide-y tw:divide-gray-100 tw:rounded-lg tw:border tw:border-gray-200" style="margin-top: 20px;">
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
            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700 tw:text-center" style="margin-top: 20px;">
                <strong>
                    Al continuar, usted acepta cumplir con estas disposiciones.
                </strong>
            </div>

            {{-- BOTÓN --}}
            <div class="tw:text-center" style="margin-top: 30px;">
                <a href="{{ route('examen_general.seccion.pregunta', ['id_seccion' => $id_seccion]) }}"
                   class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-5 tw:py-3.5 tw:text-base">
                    <i class="fa fa-play"></i>
                    Iniciar Examen
                </a>
            </div>

        </div>
    </div>

</div>

@endsection