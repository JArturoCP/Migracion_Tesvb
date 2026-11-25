@extends('layouts.app')
@section('title', 'Constancias de no adeudo')
@section('content')

<main>
<!-- Modal de verificación de adeudo -->
<div class="modal fade" id="modal_estado_adeudo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Consulta de adeudos</h4>
      </div>
      <div class="modal-body">
        @if($adeudo == 0)
          <div class="alert alert-success">
            <h4 class="text-center">No tienes adeudos. Puedes solicitar tu constancia en las siguientes áreas: </h4>
            <h4>Subdirección de Servicios Escolares:</h4>
            <p>-  Para tramite de Credencial</p>
            <p>-  Para tramite Certificado </p>
            <h4>Departamento de Titulación:</h4>
            <p>-  Para el trámite de titulación</p>
          </div>
        @elseif($adeudo == 1)
          <div class="alert alert-danger">
            <h4 class="text-center">Para tramitar tu constancia de no adeudo, primero resuelve los adeudos con las siguientes áreas: </h4>
            @foreach($departamento_carrera as $departamento)
              <h4>{{ $departamento['nombre'] }}</h4>
              <p>{{$departamento['comentario']}}</p>
            @endforeach
          </div>
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

    $("#modal_estado_adeudo").modal("show");

  });

</script>

@endsection
