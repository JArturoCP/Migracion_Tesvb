@extends('layouts.panel')
@section('title', 'Documentación de alta de residenciaa')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

<main>
<!-- Modal para registrar correo de documentación -->
<x-panel.modal id="modal_registrar_correo" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
      <form data-panel-envio class="" id="formulario_registrar_correo" action="{{url("/residencia/registrar_correo_documentacion")}}" role="form" method="POST" >
        {{ csrf_field() }}
        <div class="tw:px-6 tw:pt-6 tw:pr-14">
          
          <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Enviar Documentación de Alta de Residencia</h4>
        </div>
        <div class="tw-modal-cuerpo">
          <div class="tw:mb-4">
            <label for="nombre_proyecto">Nombre del alumno:</label>
            <p>{{$datosalumno->nombre}} {{$datosalumno->apaterno}} {{$datosalumno->amaterno}}</p>
          </div>
          <div class="tw:mb-4">
            <label for="correo_electronico_doc">Ingresa tu correo electronico. (En el se te notificará, el estado que se encuentra tu documentación, si tienes que corregir o se encuentra autorizada).<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="correo_electronico_doc" name="correo_electronico_doc" data-panel-etiqueta="el correo electrónico" type="email" placeholder="Ingresa tu correo electronico" required/>
          </div>
        </div>
        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
          <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
          <button id="guardar_correo_alta" type="submit" form="formulario_registrar_correo" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Aceptar</button>
        </div>
      </form>
    </x-panel.modal>
</main>

<script>
$(function () {
    $("#modal_registrar_correo").modal("show");
});
</script>

@include('partials.panel.validacion_envio')
</div>
@endsection
