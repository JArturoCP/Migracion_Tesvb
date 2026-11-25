@extends('tutorias.app_tutorias')
@section('content')

<main>
<!-- Modal para comentario de autoevaluación -->
<div class="modal fade" id="modal_comentario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form data-panel-envio action="{{ url('/tutoras_evaluacion/auto_eveluacion/comentario/')}}" class="form" role="form" method="POST">
        {{ csrf_field() }}
        <div class="modal-header bg-info">
          <h4 class="modal-title" id="myModalLabel">Comentario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <input class="form-control" type="hidden" id="id_asigna_tutor" name="id_asigna_tutor" value=" {{ $tutores->id_asigna_tutor }}">
          <p>Si marcó alguna de las preguntas de factores que afectan el desempeño como tutor con Nada de Acuerdo, escriba su comentario al respecto</p>
          <p>Comentarios u opiniones: A continuación, podrás expresar tus comentarios u opiniones, respecto a Fortalezas del Programa de Tutorias.</p>
          <textarea class="form-control" rows="3" name="comentario" data-panel-etiqueta="el comentario" id="comentario" required></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" id="siguiente" class="btn btn-success">Siguiente</button>
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

@include('partials.panel.validacion_envio')
@endsection
