@extends('layouts.app')
@section('title', 'Inicio')
@section('content')

<main>
<!-- Modal de mensaje de carga académica -->
<div class="modal fade" id="modal_mensaje_carga" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">VER CARGA ACADEMICA</h4>
      </div>
      <div class="modal-body">
        @if($color==1)
          <div class="alert alert-danger text-center">{{$mensage_carga}}</div>
        @else
          <div class="alert alert-success text-center">{{$mensage_carga}}</div>
        @endif
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

    $("#modal_mensaje_carga").modal("show");

  });

</script>

@endsection
