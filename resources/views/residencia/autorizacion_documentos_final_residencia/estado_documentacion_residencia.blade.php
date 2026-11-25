@extends('layouts.app')
@section('title', 'Documentación final de residenciaa')
@section('content')

<main>
<!-- Modal de estado de documentación -->
<div class="modal fade" id="modal_estado_documentacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Enviar Documentación de Liberación de Residencia</h4>
      </div>
      <div class="modal-body">
        @if( $estado_calificado == 0)
          <div class="alert alert-danger text-center">No se ha terminado de calificar tu Seguimiento de Residencia</div>
        @elseif( $estado_calificado == 1)
          @if($estado_enviado == 1 || $estado_enviado == 3)
            <div class="alert alert-success text-center">Se envió correctamente tu documentación al Departamento de Servicio Social y Residencia Profesional para su revisión</div>
          @elseif($estado_enviado == 4)
            <div class="alert alert-success text-center">Tu documentación de Liberación de Residencia fue autorizada por el Departamento de Servicio Social y Residencia Profesional.</div>
          @endif
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

    $("#modal_estado_documentacion").modal("show");

  });

</script>

@endsection
