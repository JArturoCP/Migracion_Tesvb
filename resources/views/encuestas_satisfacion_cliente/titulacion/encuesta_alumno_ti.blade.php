@extends('layouts.app')
@section('title', 'Encuesta de satifacción del cliente')
@section('content')
    <main class="col-md-12">
        <div class="row">
            <div class="col-md-10 col-xs-10 col-md-offset-1">
                <p>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="{{url("/titulacion/registro_jurado")}}">Registro de jurado</a>
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span>Encuesta de satisfacción</span>
                </p>
                <br>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3 ">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Encuesta de satifacción del cliente del Departamento de Titulación</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <p>
                            Estimado profesionista y egresado del TESVB. Gracias por realizar la Encuesta de Satisfacción del Cliente. No tardaras más de 5 minutos en completarla y nos será de gran ayuda para mejorar nuestros servicios los datos que en ella se viertan serán tratados de forma anónima.<br>
                            **********************************************************************************************<br>
                            EL AVISO DE PRIVACIDAD TE FUE DADO A CONOCER EN EL DEPARTAMENTO DE TITULACIÓN JUSTO ANTES DE REALIZAR ESTA ENCUESTA, DICHO AVISO, FUE PRIVADO POR TI EN PAPEL Y FUE AGREGADO A TU EXPEDIENTE.
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
                        <form id="form_enviar_encuesta" class="form" action="{{url("/encuestas_satisfaccion/guardar_encuesta_titulacion/".$id_alumno)}}" role="form" method="POST" >
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>1.-Se me comento donde debo realizar el trámite de titulación:*<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="1">Si</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="2">No</label>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>2.-Se me brindó la información acerca de cómo debo realizar el trámite de titulacón:*<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="1">Si</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="2">No</label>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>3.-Se me dieron a conocer las opciones de titulación:*<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="1">Si</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="2">No</label>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>4.-La persona que me atendió respondió a mis dudas:*.<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="1">Si</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="2">No</label>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>5.-Se me informó en tiempo y forma si se realizaron cambios en el proceso de titulación:*.<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="1">Si</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="2">No</label>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>6.-Creo que tener una plática de titulación antes de egresar es: *<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="5">Muy importante</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="4">Importante</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="3">Me da igual</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="2">Poca importancia</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="1">Sin importancia</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>7.-Me informaron sobre la plática de titulación:*.<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="1">Si</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="2">No</label>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>8.-Asistí a la plática de titulación:*.<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="1">Si</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="2">No</label>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>9.-Fue clara la plática de titulación:*.<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="1">Si</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="2">No</label>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>10.-Se respetó mi turno:*.<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta10" id="pregunta10" value="1">Si</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta10" id="pregunta10" value="2">No</label>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>11.-Me atendieron adecuadamente:*.<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta11" id="pregunta11" value="1">Si</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta11" id="pregunta11" value="2">No</label>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>12.-El tiempo del proceso de titulación fue:*<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta12" id="pregunta12" value="5">Muy Extenso</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta12" id="pregunta12" value="4">Extenso</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta12" id="pregunta12" value="3">Adecuado</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta12" id="pregunta12" value="2">Corto</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta12" id="pregunta12" value="1">Muy corto</label>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>13.-El tramite fue sencillo:*<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta13" id="pregunta13" value="1">Si</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta13" id="pregunta13" value="2">No</label>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>14.-El proceso es claro:*<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta14" id="pregunta14" value="1">Si</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta14" id="pregunta14" value="2">No</label>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>15.-Fui tratado con respeto, cortesía y amabilidad:*<br></b></p>
                                    <label class="radio-inline"><input   type="radio" name="pregunta15" id="pregunta15" value="1">Si</label>
                                    <label class="radio-inline"><input   type="radio" name="pregunta15" id="pregunta15" value="2">No</label>

                                </div>
                            </div>

                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Comentarios">16.-Comentarios adicionales o sugerencias *</label>
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
                                                                    var pregunta12 = $("input[type='radio'][name='pregunta12']:checked").val();
                                                                    //alert(pregunta12);
                                                                    if(pregunta12 != undefined){

                                                                        var pregunta13 = $("input[type='radio'][name='pregunta13']:checked").val();
                                                                        if(pregunta13 != undefined){

                                                                            var pregunta14 = $("input[type='radio'][name='pregunta14']:checked").val();
                                                                            if(pregunta14 != undefined){

                                                                                var pregunta15 = $("input[type='radio'][name='pregunta15']:checked").val();
                                                                                if(pregunta15 != undefined){
                                                                                    var comentario= $("#comentario").val();
                                                                                    if(comentario != ""){
                                                                                        $("#enviar_encuesta").attr("disabled", true);
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
                                                                                            title: "Ingresa los comentarios adicionales o sugerencias",
                                                                                            showConfirmButton: false,
                                                                                            timer: 3500
                                                                                        });
                                                                                    }

                                                                                }
                                                                                else {
                                                                                    swal({
                                                                                        position: "top",
                                                                                        type: "warning",
                                                                                        title: "Te falta responder la pregunta 15",
                                                                                        showConfirmButton: false,
                                                                                        timer: 3500
                                                                                    });
                                                                                }
                                                                            }
                                                                            else {
                                                                                swal({
                                                                                    position: "top",
                                                                                    type: "warning",
                                                                                    title: "Te falta responder la pregunta 14",
                                                                                    showConfirmButton: false,
                                                                                    timer: 3500
                                                                                });
                                                                            }
                                                                        }
                                                                        else {
                                                                            swal({
                                                                                position: "top",
                                                                                type: "warning",
                                                                                title: "Te falta responder la pregunta 13",
                                                                                showConfirmButton: false,
                                                                                timer: 3500
                                                                            });
                                                                        }
                                                                    }
                                                                    else {
                                                                        swal({
                                                                            position: "top",
                                                                            type: "warning",
                                                                            title: "Te falta responder la pregunta 12",
                                                                            showConfirmButton: false,
                                                                            timer: 3500
                                                                        });
                                                                    }

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