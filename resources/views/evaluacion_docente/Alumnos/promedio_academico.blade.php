@extends('layouts.panel')
@section('title', 'S.Escolares')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Promedio académico" :migas="['Estudiantes' => null]" />

    <div class="tw:mx-auto tw:max-w-sm tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-6 tw:text-center tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
        <p class="tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">Tu promedio académico</p>
        <p class="tw:mt-2 tw:text-4xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{$promedio_alumno}}</p>
    </div>

    <!-- Modal de mensaje -->
    <x-panel.modal id="modal_mensaje" tamano="sm" sin-relleno clase-cerrar="close" aria-labelledby="modal_mensaje_titulo">
        <div class="tw:px-6 tw:pt-6 tw:pr-14">
            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="modal_mensaje_titulo">Promedio académico</h4>
        </div>
        <div class="tw-modal-cuerpo tw:text-center">
            <x-panel.alerta tipo="exito" data-panel-mensaje>
                Tu promedio académico es <span class="tw:text-lg tw:font-semibold">{{$promedio_alumno}}</span>
            </x-panel.alerta>
        </div>
        <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Aceptar</button>
        </div>
    </x-panel.modal>
</div>
<script>
    $(document).ready(function(){
        $("#modal_mensaje").modal("show");
    });
</script>
@endsection
