@extends('layouts.app')
@section('title', 'Encuesta de satifacción del cliente')
@section('content')
    <main class="col-md-12">

        <div class="row">
            <div class="col-md-6 col-md-offset-3 ">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Encuesta de satifacción del cliente del Departamento de Servicio Social y Residencia Profesional <br> <b>Trámite de Residencia Profesional</b></h3>
                    </div>
                </div>
            </div>
        </div>
        @if($estado_encuesta == 0)
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <p>
                                Estudiantes del TESVB:<br>
                                **********************************************************************************************<br>
                                <b>Gracias </b> por realizar la encuesta de satisfacción del cliente. No tardarás más de 5 minutos en completarla y nos será de gran ayuda para mejorar nuestros servicios. Los datos que en ella se viertan serán tratados de forma anónima.
                                <br>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <form id="form_enviar_encuesta" class="form" action="{{url("/encuestas_satisfaccion/guardar_encuesta_residencia/".$id_alumno)}}" role="form" method="POST" >
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>1.-¿Cómo calificas la impartición del curso de inducción?:<br></b></p>
                                        <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="5">Excelente</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="4">Bueno</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="3">Regular</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="2">Malo</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="1">Muy malo</label>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>2.-La disponibilidad de los requisitos que se necesitan para realizar tu trámite en la pagina oficial del TESVB YSistemas, las consideras:<br></b></p>
                                        <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="5">Excelente</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="4">Bueno</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="3">Regular</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="2">Malo</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="1">Muy malo</label>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>3.-¿Qué tan claro consideras el trámite?<br></b></p>
                                        <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="5">Excelente</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="4">Bueno</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="3">Regular</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="2">Malo</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="1">Muy malo</label>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>4.-Los formatos proporcionados para realizar tu trámite son:<br></b></p>
                                        <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="5">Excelente</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="4">Bueno</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="3">Regular</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="2">Malo</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="1">Muy malo</label>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>5.-¿Cómo calificas las asesorías recibidas por parte de los docentes?<br></b></p>
                                        <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="5">Excelente</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="4">Bueno</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="3">Regular</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="2">Malo</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="1">Muy malo</label>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>6.-¿Cómo calificas el tiempo de respuesta por el Departamento, durante la gestión del trámite? Esto considerado desde la entrega correcta de tu documentación.<br></b></p>
                                        <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="5">Excelente</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="4">Bueno</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="3">Regular</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="2">Malo</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="1">Muy malo</label>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>7.-En caso de negativa del trámite, se explico claramente  lo que tenias que realizar para no ser  rechazado nuevamente:<br></b></p>
                                        <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="5">Excelente</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="4">Bueno</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="3">Regular</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="2">Malo</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="1">Muy malo</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>8.-El nivel de satisfacción personal por el servicio y atención brindada en el TESVB al término del trámite es:<br></b></p>
                                        <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="5">Excelente</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="4">Bueno</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="3">Regular</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="2">Malo</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="1">Muy malo</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>9.-¿Cómo calificas las asesorías recibidas por parte del Departamento de Servicio Social y Residencia Profesional?:<br></b></p>
                                        <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="5">Excelente</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="4">Bueno</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="3">Regular</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="2">Malo</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="1">Muy malo</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>10.- En términos generales la atención recibida por parte del Departamento de Servicio social y Residencia Profesional fue:<br></b></p>
                                        <label class="radio-inline"><input   type="radio" name="pregunta10" id="pregunta10" value="5">Excelente</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta10" id="pregunta10" value="4">Bueno</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta10" id="pregunta10" value="3">Regular</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta10" id="pregunta10" value="2">Malo</label>
                                        <label class="radio-inline"><input   type="radio" name="pregunta10" id="pregunta10" value="1">Muy malo</label>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Comentarios">Si desea agregar un comentario, describalo:</label>
                                            <textarea class="form-control" id="comentario" name="comentario" rows="3" placeholder="Si desea agregar un comentario, describalo:"  required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="row">
                                <div class="col-md-2 col-md-offset-5">
                                    <button type="button" class="btn btn-primary" id="enviar_encuesta">Enviar encuesta</button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        @elseif($estado_encuesta == 1)
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h4 style="text-align: center">
                                Encuesta enviada correctamente.
                            </h4>
                        </div>
                    </div>

                </div>
            </div>
        @endif

        <script type="text/javascript">
            $(document).ready( function() {
                $("#pregunta10").click(function (){
                    $(".motivo_requisito").css("display", "none");
                });
                $("#pregunta101").click(function (){
                    $(".motivo_requisito").css( {"background-color": "##FFFFFF", "display": "block"});
                });
            });
            $("#enviar_encuesta").click(function (){
                var pregunta1 = $("input[type='radio'][name='pregunta1']:checked").val();
                // alert
                if(pregunta1 != undefined){
                    var pregunta2 = $("input[type='radio'][name='pregunta2']:checked").val();
                    if(pregunta2 != undefined){
                        var pregunta3 = $("input[type='radio'][name='pregunta3']:checked").val();
                        if(pregunta3 != undefined){
                            var pregunta4 = $("input[type='radio'][name='pregunta4']:checked").val();
                            if(pregunta4 != undefined){
                                var pregunta5 = $("input[type='radio'][name='pregunta5']:checked").val();
                                if(pregunta5 != undefined){
                                    var pregunta6 = $("input[type='radio'][name='pregunta6']:checked").val();
                                    if(pregunta6 != undefined){
                                        var pregunta7 = $("input[type='radio'][name='pregunta7']:checked").val();
                                        if(pregunta7 != undefined){
                                            var pregunta8 = $("input[type='radio'][name='pregunta8']:checked").val();
                                            if(pregunta8 != undefined){
                                                var pregunta9 = $("input[type='radio'][name='pregunta9']:checked").val();
                                                if(pregunta9 != undefined){
                                                    var pregunta10 = $("input[type='radio'][name='pregunta10']:checked").val();

                                                    if(pregunta10 != undefined){
                                                        $("#enviar_encuesta").attr("disabled", true);
                                                        $("#form_enviar_encuesta").submit();
                                                        swal({
                                                            position: "top",
                                                            type: "success",
                                                            title: "Registro exitoso.",
                                                            showConfirmButton: false,
                                                            timer: 3500
                                                        });
                                                    }
                                                    else {
                                                        swal({
                                                            position: "top",
                                                            type: "warning",
                                                            title: "Te falta responder la pregunta 10",
                                                            showConfirmButton: false,
                                                            timer: 3500
                                                        });
                                                    }
                                                }
                                                else {
                                                    swal({
                                                        position: "top",
                                                        type: "warning",
                                                        title: "Te falta responder la pregunta 9",
                                                        showConfirmButton: false,
                                                        timer: 3500
                                                    });
                                                }
                                            }
                                            else {
                                                swal({
                                                    position: "top",
                                                    type: "warning",
                                                    title: "Te falta responder la pregunta 8",
                                                    showConfirmButton: false,
                                                    timer: 3500
                                                });
                                            }

                                        }
                                        else {
                                            swal({
                                                position: "top",
                                                type: "warning",
                                                title: "Te falta responder la pregunta 7",
                                                showConfirmButton: false,
                                                timer: 3500
                                            });
                                        }

                                    }
                                    else {
                                        swal({
                                            position: "top",
                                            type: "warning",
                                            title: "Te falta responder la pregunta 6",
                                            showConfirmButton: false,
                                            timer: 3500
                                        });
                                    }
                                }
                                else {
                                    swal({
                                        position: "top",
                                        type: "warning",
                                        title: "Te falta responder la pregunta 5",
                                        showConfirmButton: false,
                                        timer: 3500
                                    });
                                }

                            }
                            else {
                                swal({
                                    position: "top",
                                    type: "warning",
                                    title: "Te falta responder la pregunta 4",
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                            }
                        }
                        else {
                            swal({
                                position: "top",
                                type: "warning",
                                title: "Te falta responder la pregunta 3",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }

                    }
                    else {
                        swal({
                            position: "top",
                            type: "warning",
                            title: "Te falta responder la pregunta 2",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }

                }

                else {
                    swal({
                        position: "top",
                        type: "warning",
                        title: "Te falta responder la pregunta 1",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }


            });



        </script>


    </main>

@endsection