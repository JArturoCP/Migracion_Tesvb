@extends('layouts.app')
@section('title', 'Centro de Computo')
@section('content')

<main>
<!-- Modal para registrar usuarios -->
<div class="modal fade" id="modal_registrar_usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="form" action="{{url("/centro_computo/registro_datos_estudiante_excel/")}}" role="form" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-header bg-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-center" id="myModalLabel">Registrar correo y contraseña de los estudiantes</h4>
        </div>
        <div class="modal-body">
          <input class="form-control" id="excel_registro" name="excel_registro" type="file" required/>
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

    $("#modal_registrar_usuario").modal("show");

  });

</script>

@endsection
