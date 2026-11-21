@section('modal_examen_create')

<main>
<!-- Modal para crear examen -->
<div class="modal fade" id="modal_examen_create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form data-panel-envio action="{{ route('admin.examen.store') }}" method="POST">
        @csrf
        <div class="modal-header bg-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-education"></i> NUEVO EXAMEN</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label><i class="glyphicon glyphicon-education"></i> Carrera</label>
            <select name="id_carrera" data-panel-etiqueta="la carrera" class="form-control" required>
              @foreach($carreras as $c)
                <option value="{{ $c->id_carrera }}">{{ $c->nombre }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label><i class="glyphicon glyphicon-pencil"></i> Nombre del examen</label>
            <input type="text" name="nombre" data-panel-etiqueta="el nombre del examen" maxlength="255" class="form-control" placeholder="Ej. Examen Final Matemáticas" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-arrow-left"></i> Cancelar</button>
          <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
</main>

<script>
  $(document).ready(function(){

    $("#modal_examen_create").modal("show");

  });

</script>

@include('partials.panel.validacion_envio')
@endsection
