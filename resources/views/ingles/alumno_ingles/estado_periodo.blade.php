@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Revisión de Carga academica ingles')
@section('content')
@include('ingles.alumno_ingles.estilos')

<main class="ingles-estudiante ingles-inicio">
    <h1 class="ingles-titulo">Carga académica de inglés</h1>
<!-- Modal de estado de periodo -->
<div class="modal fade" id="modal_estado_periodo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Carga académica de inglés</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger text-center">Verifica si el periodo que seleccionaste es correcto.</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary ingles-boton" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>
</main>

<script>
  $(document).ready(function(){

    $("#modal_estado_periodo").modal("show");

  });

</script>

@endsection
