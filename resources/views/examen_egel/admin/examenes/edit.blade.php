@section('modal_examen_edit')

<main>
<!-- Modal para editar examen -->
<div class="modal fade" id="modal_examen_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('admin.examen.update',$examen->id_examen_egel) }}" method="POST">
        @csrf
        <div class="modal-header bg-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-pencil"></i> EDITAR EXAMEN</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label><i class="glyphicon glyphicon-education"></i> Carrera</label>
            <select name="id_carrera" class="form-control">
              @foreach($carreras as $c)
                <option value="{{ $c->id_carrera }}" {{ $examen->id_carrera == $c->id_carrera ? 'selected' : '' }}>{{ $c->nombre }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label><i class="glyphicon glyphicon-file"></i> Nombre del examen</label>
            <input type="text" name="nombre" value="{{ $examen->nombre }}" class="form-control" placeholder="Ingrese el nombre del examen" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-arrow-left"></i> Cancelar</button>
          <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>
</main>

<script>
  $(document).ready(function(){

    $("#modal_examen_edit").modal("show");

  });

</script>

@endsection
