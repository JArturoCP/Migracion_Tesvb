@extends('layouts.panel')

@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

<x-panel.encabezado :titulo="'Sección '.$id_seccion.' finalizada'" :migas="['Examen general de conocimientos' => null]" />
    <div class="tw:w-full" style="margin-top: 60px; max-width: 600px;">

    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:text-center">
        
        

        <div class="tw:p-5 tw:sm:p-6">

            <h4 class="tw:text-green-600 tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:mb-5" >
                Has completado correctamente la sección del examen.
            </h4>

            <p style="font-size: 15px;">
                Tus respuestas han sido registradas correctamente.
            </p>

            <hr>

            <a href="{{ url('/examen_conocimientos') }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
                <i class="fa fa-home"></i>
                Regresar al menú principal
            </a>

        </div>
    </div>

</div>

</div>
@endsection