@section('modal_editar_pregunta')

<main>
<!-- Modal para editar pregunta -->
<div class="modal fade bs-example-modal-lg" id="modal_editar_pregunta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="{{ route('admin.pregunta.update', $pregunta->id_pregunta) }}" method="POST" class="form-horizontal">
        @csrf
        <div class="modal-header bg-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span> EDITAR PREGUNTA</h4>
        </div>
        <div class="modal-body">

          <input type="hidden" name="id_examen_egel" value="{{ $pregunta->id_examen_egel }}">

          <div class="form-group">
            <label class="col-sm-2 control-label"><span class="glyphicon glyphicon-pencil"></span> Pregunta</label>
            <div class="col-sm-10">
              <textarea name="pregunta" class="form-control" rows="4" placeholder="Escribe la pregunta aquí" style="resize:none;">{{ $pregunta->pregunta }}</textarea>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label"><span class="glyphicon glyphicon-book"></span> Módulo</label>
            <div class="col-sm-10">
              <select name="id_modulo" class="form-control">
                @foreach($modulos_pregunta as $m)
                  <option value="{{ $m->id_modulo }}" {{ $m->id_modulo == $pregunta->id_modulo ? 'selected' : '' }}>{{ $m->nombre }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label"><span class="glyphicon glyphicon-sort-by-order"></span> Número</label>
            <div class="col-sm-10">
              <input type="number" name="numero_pregunta" class="form-control" value="{{ $pregunta->numero_pregunta }}">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</button>
          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> Actualizar Pregunta</button>
        </div>
      </form>
    </div>
  </div>
</div>
</main>

<script>
  $(document).ready(function(){

    $("#modal_editar_pregunta").modal("show");

  });

</script>

@endsection
