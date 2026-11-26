@extends('tutorias.app_tutorias')
@section('content')

<main>
<!-- Modal sin registro -->
<div class="modal fade" id="modal_sin_registro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h4 class="modal-title" id="myModalLabel">No tiene registro</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>
</main>

<script>
  $(document).ready(function(){

    $("#modal_sin_registro").modal("show");

  });

</script>

@endsection
