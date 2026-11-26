@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('title', 'Incidencias')
@section('content')

<main>
<!-- Modal para subir oficio -->
<div class="modal fade tw-modal-compat" id="modal_cargar_oficio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-panel-modal hidden>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header tw:bg-sky-100">
        <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title tw:text-center" id="myModalLabel">SUBIR OFICIO FIRMADO</h4>
      </div>
      <div class="modal-body">
        <form data-panel-envio id="form_enviar_oficio" action="{{url('/incidencias/guardar_oficio/'.$oficio->id_solicitud)}}" role="form" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="tw:mb-4">
            <label>Instrucciones: </label><br>
            <label> Para poder subir la evidencia correspondiente es necesario que su archivo, que desea subir este en formato PDF y que este legible.</label>
          </div>
          <div class="tw:mb-4">
            <label for="archivo_subir">Archivo a subir:</label>
            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden" id="arch_solicitud" name="arch_solicitud" data-panel-etiqueta="el archivo PDF" data-panel-archivo="pdf" type="file" accept="application/pdf" required/>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
        <button id="enviar_oficio" type="submit" form="form_enviar_oficio" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Guardar oficio</button>
      </div>
    </div>
  </div>
</div>
</main>

<script>
$(function () {
    $("#modal_cargar_oficio").modal("show");
});
</script>

@include('partials.panel.validacion_envio')
@endsection
