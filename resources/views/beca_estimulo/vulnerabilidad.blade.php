@extends('layouts.app')
@section('title', 'Estímulo al Desempeño escolar')
@section('content')

<main>
<!-- Modal de solicitud de estímulo -->
<div class="modal fade bs-example-modal-lg" id="modal_vulnerabilidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Solicitud del Estimulo al Desempeño Escolar</h4>
      </div>
      <div class="modal-body">
        <form id="form_enviar_encuesta" class="form" action="{{url("/beca_estimulo/vulnerabilidad_registrar")}}" role="form" method="POST" >
          {{ csrf_field() }}
          <p>
            <b> QUE ES UN ESTUDIANTE VULNERABLE:</b> Un estudiante que presenta alguna de las siguientes condiciones a lo largo de su trayectoria escolar que le impida continuar en su preparación profesional.<br>
            <b>a) Ser madre de familia:</b> Para este caso se deberá entregar la siguiente documentación:<br>
            I. Copia del acta de nacimiento de los hijos.
            <br>
            <b>b)Tener una discapacidad:</b> Para este  se debera entregar  la siguiente documentación:<br>
            I. Constancia emitida por una institución gubernamental competente que determine la condición de discapacidad.
          </p>
          <p>En caso de que te declares como un estudiante con una condición de vulnerabilidad tal como se establece en el articulo 3 de estos criterios, deberas presentar la documentaciòn oficial que justifique dicha condición en la Subdirección de Estudios Profesionales en las fechas señaladas en la convocatoria.
          </p>
          <p style="background: red">Nota: También igual checa los demás requisitos que debes cumplir para el Estímulo al Desempeño Escolar en la convocatoria.</p>
          <div style="background: #6cb2eb; padding: 10px;">
            <p><b>Selecciona una respuesta por favor, para verificar si eres estudiante vulnerable:<br></b></p>
            <label class="radio-inline"><input type="radio" name="pregunta1" id="pregunta1" value="1">Eres madre de familia</label>
            <label class="radio-inline"><input type="radio" name="pregunta1" id="pregunta1" value="2">Tienes alguna discapacidad</label>
            <label class="radio-inline"><input type="radio" name="pregunta1" id="pregunta1" value="3">Ninguna de las anteriores</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary contestar">Enviar respuesta</button>
      </div>
    </div>
  </div>
</div>
</main>

<script type="text/javascript">
  $(document).ready(function() {

    $("#modal_vulnerabilidad").modal("show");

    $(".contestar").click(function () {
      var pregunta1 = $("input[type='radio'][name='pregunta1']:checked").val();
      if(pregunta1 != undefined){
        $(".contestar").attr("disabled", true);
        $("#form_enviar_encuesta").submit();
        swal({
          position: "top",
          type: "success",
          title: "Se envio correctamente su encuesta.",
          showConfirmButton: false,
          timer: 3500
        });
      }else{
        swal({
          position: "top",
          type: "warning",
          title: "selecciona una respuesta",
          showConfirmButton: false,
          timer: 3500
        });
      }
    });
  });
</script>

@endsection
