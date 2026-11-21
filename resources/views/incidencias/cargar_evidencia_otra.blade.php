@extends('layouts.app')
@section('title', 'Incidencias')
@section('content')

<main>
<!-- Modal para subir evidencia -->
<div class="modal fade" id="modal_cargar_evidencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">SUBIR EVIDENCIA DE CONOCIMIENTO QUE NO REQUIERE AUTORIZACIÓN DE JEFE INMEDIATO<br><br>
          Tipo de evidencia: {{ $tipo_evidencia->nombre_evidencia }}</h4>
      </div>
      <div class="modal-body">
        <form data-panel-envio id="form_enviar_evidencia" action="{{url('/incidencias/guardar_evidencia_fecha_solicita/'.$tipo_evidencia->id_tipo_evid.'/'.$tipo_fecha)}}" role="form" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Instrucciones: </label><br>
            <label> Para poder subir la evidencia correspondiente es necesario que su archivo, que desea subir este en formato PDF y que este legible.</label>
          </div>
          <div class="form-group" id="fecha_r1">
            <label for="fecha_requerida">Fecha requerida:</label>
            <input class="form-control datepicker fecha_requerida1" type="text" id="fecha_req1" name="fecha_req1" data-panel-etiqueta="la fecha solicitada" required data-date-format="yyyy/mm/dd" placeholder="DD/MM/AAAA">
          </div>
          <div class="form-group">
            <label for="archivo_subir">Archivo a subir:</label>
            <input class="form-control" id="arch_evidencia" name="arch_evidencia" data-panel-etiqueta="el archivo PDF" data-panel-archivo="pdf" type="file" accept="application/pdf" required />
          </div>
          @if($tipo_evidencia->id_tipo_evid == 1 || $tipo_evidencia->id_tipo_evid == 3 ||  $tipo_evidencia->id_tipo_evid == 5  ||  $tipo_evidencia->id_tipo_evid == 6)
          <div class="form-group">
            <label for="archivo_subir">Número de folio:</label>
            <input class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" id="no_folio" name="no_folio" data-panel-etiqueta="el número de folio" type="text" placeholder="Ingresa numero de folio" required>
          </div>
          @endif
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button id="enviar_evidencia" type="submit" form="form_enviar_evidencia" class="btn btn-success">Guardar Evidencia</button>
      </div>
    </div>
  </div>
</div>
</main>

<script>
$(function () {
    $("#modal_cargar_evidencia").modal("show");
    $(".fecha_requerida1").datepicker({pickTime: false, autoclose: true, language: "es", startDate: "-7d"});
});
</script>

@include('partials.panel.validacion_envio')
@endsection
