@extends('layouts.panel')
@section('title', 'Documentación de alta de residenciaa')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado titulo="Enviar Documentación de Alta de Residencia" :migas="['Residencia profesional' => null]" />
        <!-- Modal de mensaje -->
        <x-panel.modal id="modal_mensaje" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="modal_mensaje_titulo">
            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="modal_mensaje_titulo">Documentación de alta de residencia</h4>
            </div>
            <div class="tw-modal-cuerpo">
                <x-panel.alerta tipo="exito" data-panel-mensaje>Se envió correctamente tu documentación al Departamento de Servicio Social y Residencia Profesional para su revisión</x-panel.alerta>
            </div>
            <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Aceptar</button>
            </div>
        </x-panel.modal>
    </main>
<script>
    $(document).ready(function(){
        $("#modal_mensaje").modal("show");
    });
</script>
</div>
@endsection