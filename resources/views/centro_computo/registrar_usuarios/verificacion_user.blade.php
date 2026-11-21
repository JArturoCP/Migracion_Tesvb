@extends('layouts.app')
@section('title', 'Centro de Computo')
@section('content')

<main>
<!-- Modal de verificación de usuario -->
<div class="modal fade" id="modal_verificacion_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="form-horizontal" action="{{url("/centro_computo/verificar_usuario")}}" role="form" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-header bg-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-center" id="myModalLabel">Verificación de usuario</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="password" class="col-md-4 control-label">ingresa contraseña</label>
            <div class="col-md-6">
              <input id="password" type="password" class="form-control" name="password" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
</main>

<script>
  $(document).ready(function(){

    $("#modal_verificacion_user").modal("show");

  });

</script>

@endsection
