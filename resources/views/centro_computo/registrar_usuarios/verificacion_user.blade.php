@extends('layouts.panel')
@section('title', 'Centro de Computo')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

<main>
<!-- Modal de verificación de usuario -->
<x-panel.modal id="modal_verificacion_user" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
      <form data-panel-envio class="" action="{{url("/centro_computo/verificar_usuario")}}" role="form" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="tw:px-6 tw:pt-6 tw:pr-14">
          
          <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Verificación de usuario</h4>
        </div>
        <div class="tw-modal-cuerpo">
          <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:mb-4">
            <label for="password" class="tw:w-full tw:lg:w-4/12 tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300 tw:px-2">Contraseña</label>
            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
              <input id="password" type="password" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="password" data-panel-etiqueta="la contraseña" required>
            </div>
          </div>
        </div>
        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
          <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Guardar</button>
        </div>
      </form>
    </x-panel.modal>
</main>

<script>
  $(document).ready(function(){

    $("#modal_verificacion_user").modal("show");

  });

</script>

@include('partials.panel.validacion_envio')
</div>
@endsection
