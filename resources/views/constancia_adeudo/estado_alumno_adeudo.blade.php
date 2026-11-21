@extends('layouts.app')
@section('title', 'Constancias de no Adeudo')
@section('content')

<main>
<!-- Modal de verificación de adeudo -->
<div class="modal fade" id="modal_estado_adeudo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Verificación si tienes algun adeudo.</h4>
      </div>
      <div class="modal-body">
        @if($adeudo == 0)
          <div class="alert alert-success">
            <h4 class="text-center">No tienes ningun adeudo puedes tramitar tu constancia de no adeudo, para los tramites correspondientes, en los departamentos: </h4>
            <h4>Subdireccion de servicios escolares:</h4>
            <p>-  Para tramite de Credencial</p>
            <p>-  Para tramite Certificado </p>
            <h4>Departamento de Titulacion:</h4>
            <p>-  Para tramite de Titulacion</p>
          </div>
        @elseif($adeudo == 1)
          <div class="alert alert-danger">
            <h4 class="text-center">No puedes tramitar tus constancia de no adeudo para tu tramite, porque tienes adeudo con los siguientes departamentos: </h4>
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
