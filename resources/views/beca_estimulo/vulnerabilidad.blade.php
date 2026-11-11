@extends('layouts.app')
@section('title', 'Estímulo al Desempeño escolar')
@section('content')
    <main class="col-md-12">

        <div class="row">

            <div class="col-md-6 col-md-offset-3 ">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Solicitud del Estimulo al Desempeño Escolar</h3>
                    </div>
                </div>
            </div>

        </div>


        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <form id="form_enviar_encuesta" class="form" action="{{url("/beca_estimulo/vulnerabilidad_registrar")}}" role="form" method="POST" >
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
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


                                </div>
                            </div>
                            <div class="row " style="background: #6cb2eb;">
                                <div class="col-md-12">
                                    <p><b>Selecciona una respuesta por favor, para verificar si eres estudiante vulnerable:<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="1">Eres madre de familia</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="2">Tienes alguna discapacidad</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="3">Ninguna de las anteriores</label>
                                </div>
                            </div>

                        </form>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                               <p><br><br></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                              <button type="button" class="btn btn-primary contestar" >Enviar respuesta</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <script type="text/javascript">
        $(document).ready(function() {
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