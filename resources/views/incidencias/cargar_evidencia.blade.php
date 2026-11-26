@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('title', 'Incidencias')
@section('content')

<main>
<!-- Modal para subir evidencia -->
<div class="modal fade tw-modal-compat" id="modal_cargar_evidencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-panel-modal hidden>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header tw:bg-sky-100">
        <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title tw:text-center" id="myModalLabel">SUBIR EVIDENCIAS DE CONOCIMIENTO QUE NO REQUIERE AUTORIZACIÓN DE JEFE INMEDIATO</h4>
      </div>
      <div class="modal-body">
        <form data-panel-envio id="form_enviar_evidencia" action="{{url('/incidencias/guardar_evidencia',$evidencia->id_evid)}}" role="form" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="tw:mb-4">
            <label>Instrucciones: </label><br>
            <label> Para poder subir la evidencia correspondiente es necesario que su archivo, que desea subir este en formato PDF y que este legible.</label>
          </div>
          <div class="tw:mb-4">
            <label for="Tipo_evi">Tipo de evidencia </label>
            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Seleciona una opción" id="id_tipo_evid" name="id_tipo_evid" data-panel-etiqueta="el tipo de evidencia" required>
              <option value="" disabled selected hidden> Selecciona una opción </option>
              @foreach($tipo_evidencia as $tipo_evidencia)
                <option value="{{$tipo_evidencia->id_tipo_evid}}" data-evid="{{$tipo_evidencia->nombre_evidencia}}"> {{$tipo_evidencia->nombre_evidencia}} </option>
              @endforeach
            </select>
          </div>
          <div class="tw:mb-4">
            <label for="archivo_subir">Archivo a subir:</label>
            <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden" id="arch_evidencia" name="arch_evidencia" data-panel-etiqueta="el archivo PDF" data-panel-archivo="pdf" type="file" accept="application/pdf" required/>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
        <button id="enviar_evidencia" type="submit" form="form_enviar_evidencia" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Guardar Evidencia</button>
      </div>
    </div>
  </div>
</div>
</main>

<script>
$(function () {
    $("#modal_cargar_evidencia").modal("show");
});
</script>

@include('partials.panel.validacion_envio')
@endsection
