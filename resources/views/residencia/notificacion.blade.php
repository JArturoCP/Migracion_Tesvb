@extends('layouts.app')
@section('title', 'Notificacion de anteproyecto')
@section('content')

<main>
<!-- Modal de notificación de anteproyecto -->
<div class="modal fade" id="modal_notificacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Notificación de Dictamen de anteproyecto</h4>
      </div>
      <div class="modal-body">
        <h4 class="text-center">Se encuentra en actualización.</h4>
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

    $("#modal_notificacion").modal("show");

  });

</script>

@endsection
