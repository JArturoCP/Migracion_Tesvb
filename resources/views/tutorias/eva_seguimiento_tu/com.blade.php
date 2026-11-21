@extends('tutorias.app_tutorias')
@section('content')

<main>
<!-- Modal para comentario de seguimiento -->
<div class="modal fade" id="modal_comentario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="{{ url('/seguimiento_tutorias/formulario/comentario/') }}" class="form" role="form" method="POST">
        {{ csrf_field() }}
        <div class="modal-header bg-success">
          <h4 class="modal-title" id="myModalLabel">Comentario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <input class="form-control" type="hidden" id="per" name="per" value=" {{ $come->per }}">
          <input class="form-control" type="hidden" id="id_asigna_tutor" name="id_asigna_tutor" value=" {{ $come->id_asigna_tutor }}">
          <p>Observaciones:</p>
          <p>En caso de No cumplir describir en Observaciones las causas</p>
          <textarea class="form-control" rows="3" name="comentarios" id="comentarios" required></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" id="siguiente" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
</main>

<script>
  $(document).ready(function(){

    $("#modal_comentario").modal("show");

  });

</script>

@endsection
