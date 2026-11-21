@extends('layouts.app')
@section('title', 'Incidencias')
@section('content')

<main>
<!-- Modal para subir oficio -->
<div class="modal fade" id="modal_cargar_oficio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">SUBIR OFICIO FIRMADO</h4>
      </div>
      <div class="modal-body">
        <form data-panel-envio id="form_enviar_oficio" action="{{url('/incidencias/guardar_oficio/'.$oficio->id_solicitud)}}" role="form" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Instrucciones: </label><br>
            <label> Para poder subir la evidencia correspondiente es necesario que su archivo, que desea subir este en formato PDF y que este legible.</label>
          </div>
          <div class="form-group">
            <label for="archivo_subir">Archivo a subir:</label>
            <input class="form-control" id="arch_solicitud" name="arch_solicitud" data-panel-etiqueta="el archivo PDF" data-panel-archivo="pdf" type="file" accept="application/pdf" required/>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button id="enviar_oficio" type="submit" form="form_enviar_oficio" class="btn btn-success">Guardar oficio</button>
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
