@extends('layouts.app')
@section('title', 'Encuesta de satifacción del cliente')
@section('content')
    <main class="col-md-12">

        <div class="row">
            <div class="col-md-6 col-md-offset-3 ">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Encuesta de satifacción del cliente de reinscripción</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <p>
                            Estimado estudiante:<br><br>
                            En nuestro Tecnológico tenemos el firme compromiso de satisfacer plenamente tus necesidades y requerimientos en los servicios que ofrecemos, buscando mejorar permanentemente nuestro desempeño y serviste mejor.
                            <br>
                            Para lograr esto, lo más valioso es tu opinión, por lo que se solicita responder con sinceridad un breve cuestionario anexo, cuya respuesta será la mejor ayuda para superamos.
                            <br>
                            Se agradece tu atención a la presente y me reitero a tu disposición.
                            <br><br>
                            ATENTAMENTE
                            <br>
                            SUBDIRECCIÓN DE SERVICIO ESCOLARES
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
                        <form id="form_enviar_encuesta" class="form" action="{{url("/encuestas_satisfaccion/enviar_encuesta_reinscripcion/")}}" role="form" method="POST" >
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>1.- ¿Considerando que el personal de la Subdirección de Servicios Escolares atiende ventanillas en un horario 9:00 a 18:00 horas, el tiempo es? *<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="4">Excelente</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="3">Buena</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="2">Regular</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="1">Mala</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>2.-¿El tiempo de espera para ser atendido en ventanilla es adecuado?*<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="4">Excelente</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="3">Buena</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="2">Regular</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="1">Mala</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>3.-¿El tiempo de respuesta a mi solicitud es eficiente, cuando me presento con mi documentación completa?*<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="4">Excelente</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="3">Buena</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="2">Regular</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="1">Mala</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>4.-¿La disponibilidad del personal para consultar dudas de tipo académico es adecuada?*<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="4">Excelente</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="3">Buena</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="2">Regular</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="1">Mala</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>5.-Me atienden de forma adecuada cuando solicito su apoyo.*<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="4">Excelente</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="3">Buena</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="2">Regular</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="1">Mala</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>6.-¿Cómo consideras el trámite de inscripción, reinscripción y afiliación al IMSS de manera presencial?*<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="4">Excelente</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="3">Buena</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="2">Regular</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="1">Mala</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>7.-¿Conoces los requisitos para realizar tus trámites?*<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="4">Excelente</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="3">Buena</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="2">Regular</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="1">Mala</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>8.- ¿Son claros los requisitos solicitados en las convocatorias para la inscripción, reinscripción y afiliación al IMSS?*<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="4">Excelente</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="3">Buena</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="2">Regular</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="1">Mala</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>9.-¿Cómo consideras el trámite de inscripción, reinscripción y afiliación al IMSS en línea?*<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="4">Excelente</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="3">Buena</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="2">Regular</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="1">Mala</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>10.-Si tu tramite fue rechazado, menciona el motivo o requisito que te hizo falta.<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta10" id="pregunta10" value="2">No</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta10" id="pregunta101" value="1">Si</label>
                                </div>
                            </div>
                            <div class="row motivo_requisito" style="display:none; ">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Motivo">Menciona el motivo o requisito que te hizo falta</label>
                                        <textarea class="form-control" id="motivo" name="motivo" rows="2" placeholder="Ingresa  el motivo o requisito que te hizo falta"  required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>11.-En términos generales el servicio recibido fue*<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta11" id="pregunta11" value="4">Excelente</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta11" id="pregunta11" value="3">Buena</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta11" id="pregunta11" value="2">Regular</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta11" id="pregunta11" value="1">Mala</label>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Comentarios">COMENTARIOS:</label>
                                        <textarea class="form-control" id="comentario" name="comentario" rows="3" placeholder="Ingresa  comentario"  required></textarea>
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
                                                        if(pregunta10 == 1)
                                                        {
                                                            var motivo = $("#motivo").val();
                                                            if(motivo != ""){
                                                                var pregunta11 = $("input[type='radio'][name='pregunta11']:checked").val();
                                                                if(pregunta11 != undefined){
                                                                    $("#enviar_encuesta").attr("disabled", true);
                                                                    $("#form_enviar_encuesta").submit();
                                                                    swal({
                                                                        position: "top",
                                                                        type: "success",
                                                                        title: "Se envio correctamente su encuesta.",
                                                                        showConfirmButton: false,
                                                                        timer: 3500
                                                                    });

                                                                }
                                                                else {
                                                                    swal({
                                                                        position: "top",
                                                                        type: "warning",
                                                                        title: "Te falta responder la pregunta 11",
                                                                        showConfirmButton: false,
                                                                        timer: 3500
                                                                    });
                                                                }

                                                            }else{
                                                                swal({
                                                                    position: "top",
                                                                    type: "warning",
                                                                    title: "Ingresa el motivo de la pregunta 10",
                                                                    showConfirmButton: false,
                                                                    timer: 3500
                                                                });
                                                            }
                                                        }else{
                                                            var pregunta11 = $("input[type='radio'][name='pregunta11']:checked").val();
                                                            if(pregunta11 != undefined){
                                                                $("#enviar_encuesta").attr("disabled", true);
                                                                $("#form_enviar_encuesta").submit();
                                                                swal({
                                                                    position: "top",
                                                                    type: "success",
                                                                    title: "Registro exitoso",
                                                                    showConfirmButton: false,
                                                                    timer: 3500
                                                                });

                                                            }
                                                            else {
                                                                swal({
                                                                    position: "top",
                                                                    type: "warning",
                                                                    title: "Te falta responder la pregunta 11",
                                                                    showConfirmButton: false,
                                                                    timer: 3500
                                                                });
                                                            }
                                                        }

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