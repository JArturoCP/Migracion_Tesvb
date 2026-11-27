@extends('layouts.panel')

@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

<x-panel.encabezado titulo="Área concluida" :migas="['Examen general de conocimientos' => null]" />
    <div class="tw:w-full tw:text-center" style="margin-top: 50px; max-width: 700px;">

    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

        

        <div class="tw:p-5 tw:sm:p-6">

            <x-panel.alerta tipo="exito" class="tw:mb-4">
                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:m-0" >
                    Has concluido el área: <strong>{{ $moduloActual->nombre }}</strong>
                </h4>
            </x-panel.alerta>

            <hr>

            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:mb-5" >
                Prepárate para comenzar la siguiente área
            </h4>

            <a href="{{ route('examen_general.seccion.pregunta', [
        'id_seccion' => $id_seccion,
        'page' => $nextPage
    ]) }}"
   class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
    <i class="fa fa-arrow-right"></i>
    Comenzar siguiente área
</a>

        </div>
    </div>

</div>

</div>
@endsection