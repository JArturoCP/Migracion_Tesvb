@extends('layouts.app')
@section('title', 'Incidencias')
@section('content')

<main>
<!-- Modal para subir evidencia -->
<div class="modal fade" id="modal_cargar_evidencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">SUBIR EVIDENCIAS DE CONOCIMIENTO QUE NO REQUIERE AUTORIZACIÓN DE JEFE INMEDIATO</h4>
      </div>
      <div class="modal-body">
        <form data-panel-envio id="form_enviar_evidencia" action="{{url('/incidencias/guardar_evidencia',$evidencia->id_evid)}}" role="form" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Instrucciones: </label><br>
            <label> Para poder subir la evidencia correspondiente es necesario que su archivo, que desea subir este en formato PDF y que este legible.</label>
          </div>
          <div class="form-group">
            <label for="Tipo_evi">Tipo de evidencia </label>
            <select class="form-control" placeholder="Seleciona una opción" id="id_tipo_evid" name="id_tipo_evid" data-panel-etiqueta="el tipo de evidencia" required>
              <option value="" disabled selected hidden> Selecciona una opción </option>
              @foreach($tipo_evidencia as $tipo_evidencia)
                <option value="{{$tipo_evidencia->id_tipo_evid}}" data-evid="{{$tipo_evidencia->nombre_evidencia}}"> {{$tipo_evidencia->nombre_evidencia}} </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="archivo_subir">Archivo a subir:</label>
            <input class="form-control" id="arch_evidencia" name="arch_evidencia" data-panel-etiqueta="el archivo PDF" data-panel-archivo="pdf" type="file" accept="application/pdf" required/>
          </div>
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
});
</script>

@include('partials.panel.validacion_envio')
@endsection
