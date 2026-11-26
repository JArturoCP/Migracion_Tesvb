@extends('layouts.panel')
@section('title', 'Centro de Computo')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

<main>
<!-- Modal para registrar usuarios -->
<x-panel.modal id="modal_registrar_usuario" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
      <form data-panel-envio class="" action="{{url("/centro_computo/registro_datos_estudiante_excel/")}}" role="form" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="tw:px-6 tw:pt-6 tw:pr-14">
          
          <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Registrar correo y contraseña de los estudiantes</h4>
        </div>
        <div class="tw-modal-cuerpo">
          <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden" id="excel_registro" name="excel_registro" data-panel-etiqueta="el archivo Excel" accept=".xlsx,.xls,.csv,.ods,.xlsm" data-panel-archivo="xlsx,xls,csv,ods,xlsm" type="file" required/>
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

    $("#modal_registrar_usuario").modal("show");

  });

</script>

@include('partials.panel.validacion_envio')
</div>
@endsection
