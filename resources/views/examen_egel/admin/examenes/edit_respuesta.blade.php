@section('modal_editar_respuesta')

<main>
<!-- Modal para editar respuesta -->
<div class="modal fade bs-example-modal-lg" id="modal_editar_respuesta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form data-panel-envio action="{{ route('admin.respuesta.update', $respuesta->id_respuesta) }}" method="POST" class="form-horizontal">
        @csrf
        <div class="modal-header bg-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span> EDITAR RESPUESTA DE LA PREGUNTA: {{ $respuesta->numero_pregunta }}</h4>
        </div>
        <div class="modal-body">

          <input type="hidden" name="id_examen_egel" value="{{ $respuesta->id_examen_egel }}">

          <div class="form-group">
            <label class="col-sm-2 control-label"><span class="glyphicon glyphicon-pencil"></span> Respuesta</label>
            <div class="col-sm-10">
              <input type="text" name="respuesta" data-panel-etiqueta="el texto de la respuesta" required class="form-control" value="{{ $respuesta->respuesta }}" placeholder="Escribe la respuesta aquí">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label"><span class="glyphicon glyphicon-ok-circle"></span> ¿Es correcta?</label>
            <div class="col-sm-10">
              <select name="es_correcta" data-panel-etiqueta="si la respuesta es correcta" required class="form-control">
                <option value="1" {{ $respuesta->es_correcta == 1 ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ $respuesta->es_correcta == 0 ? 'selected' : '' }}>No</option>
              </select>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</button>
          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> Actualizar Respuesta</button>
        </div>
      </form>
    </div>
  </div>
</div>
</main>

<script>
  $(document).ready(function(){

    $("#modal_editar_respuesta").modal("show");

  });

</script>

@include('partials.panel.validacion_envio')
@endsection
