@extends('layouts.app')
@section('title', 'Encuesta de satifacción del cliente')
@section('content')
    <main class="col-md-12">
        <div class="row">
            <div class="col-md-10 col-xs-10 col-md-offset-1">
                <p>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="{{url("/encuestas_satisfaccion/encuesta_reincripcion_periodo")}}">Periodos de las encuestas</a>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="{{url("/encuestas_satisfaccion/carrera_enc_reincripcion")}}">Programas de Estudios</a>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="{{url("/encuestas_satisfaccion/alumnos_enc_reincripcion/".$estudiante->id_carrera)}}">Encuestas contestadas</a>
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span>Encuesta del estudiante</span>
                </p>
                <br>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3 ">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Encuesta de satifacción del cliente de Reinscripción <br> <b>{{ $estudiante->cuenta }} {{ $estudiante->nombre }} {{ $estudiante->apaterno }} {{ $estudiante->amaterno }}</b>  </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <div class="row">
                            <div class="col-md-12">
                                <p><b>1.- ¿Considerando que el personal de la Subdirección de Servicios Escolares atiende ventanillas en un horario 9:00 a 18:00 horas, el tiempo es? *<br></b></p>
                                @if($estudiante->cal_preg_1 == 4)
                                    <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="4" checked>Excelente</label>
                                @elseif($estudiante->cal_preg_1 == 3)
                                    <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="3" checked>Buena</label>
                                @elseif($estudiante->cal_preg_1 == 2)
                                    <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="2" checked>Regular</label>
                                @elseif($estudiante->cal_preg_1 == 1)
                                    <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="1" checked>Mala</label>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>2.-¿El tiempo de espera para ser atendido en ventanilla es adecuado?*<br></b></p>
                                @if($estudiante->cal_preg_2 == 4)
                                    <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="4" checked>Excelente</label>
                                @elseif($estudiante->cal_preg_2 == 3)
                                    <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="3" checked>Buena</label>
                                @elseif($estudiante->cal_preg_2 == 2)
                                    <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="2" checked>Regular</label>
                                @elseif($estudiante->cal_preg_2 == 1)
                                    <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="1" checked>Mala</label>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>3.-¿El tiempo de respuesta a mi solicitud es eficiente, cuando me presento con mi documentación completa?*<br></b></p>
                                @if($estudiante->cal_preg_3 == 4)
                                    <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="4" checked>Excelente</label>
                                @elseif($estudiante->cal_preg_3 == 3)
                                    <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="3" checked>Buena</label>
                                @elseif($estudiante->cal_preg_3 == 2)
                                    <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="2" checked>Regular</label>
                                @elseif($estudiante->cal_preg_3 == 1)
                                    <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="1" checked>Mala</label>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>4.-¿La disponibilidad del personal para consultar dudas de tipo académico es adecuada?*<br></b></p>
                                @if($estudiante->cal_preg_4 == 4)
                                    <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="4" checked>Excelente</label>
                                @elseif($estudiante->cal_preg_4 == 3)
                                    <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="3" checked>Buena</label>
                                @elseif($estudiante->cal_preg_4 == 2)
                                    <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="2" checked>Regular</label>
                                @elseif($estudiante->cal_preg_4 == 1)
                                    <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="1" checked>Mala</label>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>5.-Me atienden de forma adecuada cuando solicito su apoyo.*<br></b></p>
                                @if($estudiante->cal_preg_5 == 4)
                                    <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="4" checked>Excelente</label>
                                @elseif($estudiante->cal_preg_5 == 3)
                                    <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="3" checked>Buena</label>
                                @elseif($estudiante->cal_preg_5 == 2)
                                    <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="2" checked>Regular</label>
                                @elseif($estudiante->cal_preg_5 == 1)
                                    <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="1" checked>Mala</label>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>6.-¿Cómo consideras el trámite de inscripción, reinscripción y afiliación al IMSS de manera presencial?*<br></b></p>
                                @if($estudiante->cal_preg_6 == 4)
                                    <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="4" checked>Excelente</label>
                                @elseif($estudiante->cal_preg_6 == 3)
                                    <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="3" checked>Buena</label>
                                @elseif($estudiante->cal_preg_6 == 2)
                                    <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="2" checked>Regular</label>
                                @elseif($estudiante->cal_preg_6 == 1)
                                    <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="1" checked>Mala</label>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>7.-¿Conoces los requisitos para realizar tus trámites?*<br></b></p>
                                @if($estudiante->cal_preg_7 == 4)
                                    <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="4" checked>Excelente</label>
                                @elseif($estudiante->cal_preg_7 == 3)
                                    <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="3" checked>Buena</label>
                                @elseif($estudiante->cal_preg_7 == 2)
                                    <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="2" checked>Regular</label>
                                @elseif($estudiante->cal_preg_7 == 1)
                                    <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="1" checked>Mala</label>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>8.- ¿Son claros los requisitos solicitados en las convocatorias para la inscripción, reinscripción y afiliación al IMSS?*<br></b></p>
                                @if($estudiante->cal_preg_8 == 4)
                                    <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="4" checked>Excelente</label>
                                @elseif($estudiante->cal_preg_8 == 3)
                                    <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="3" checked>Buena</label>
                                @elseif($estudiante->cal_preg_8 == 2)
                                    <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="2" checked>Regular</label>
                                @elseif($estudiante->cal_preg_8 == 1)
                                    <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="1" checked>Mala</label>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>9.-¿Cómo consideras el trámite de inscripción, reinscripción y afiliación al IMSS en línea?*<br></b></p>
                                @if($estudiante->cal_preg_9 == 4)
                                    <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="4" checked>Excelente</label>
                                @elseif($estudiante->cal_preg_9 == 3)
                                    <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="3"checked>Buena</label>
                                @elseif($estudiante->cal_preg_9 == 2)
                                    <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="2" checked>Regular</label>
                                @elseif($estudiante->cal_preg_9 == 1)
                                    <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="1" checked>Mala</label>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>10.-Si tu tramite fue rechazado, menciona el motivo o requisito que te hizo falta.<br></b></p>
                                @if($estudiante->cal_preg_10 == 2)
                                    <label class="radio-inline"><input   type="radio" name="pregunta10" id="pregunta10" value="2" checked>No</label>
                                @elseif($estudiante->cal_preg_10 == 1)
                                    <label class="radio-inline"><input   type="radio" name="pregunta10" id="pregunta101" value="1" checked>Si</label>
                                @endif
                            </div>
                        </div>
                        @if($estudiante->cal_preg_10 == 1)
                            <div class="row motivo_requisito" >
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Motivo">Menciona el motivo o requisito que te hizo falta</label>
                                        <h4>{{ $estudiante->comentario_res_preg_10 }}</h4>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>11.-En términos generales el servicio recibido fue*<br></b></p>
                                @if($estudiante->cal_preg_11 == 4)
                                    <label class="radio-inline"><input   type="radio" name="pregunta11" id="pregunta11" value="4" checked>Excelente</label>
                                @elseif($estudiante->cal_preg_11 == 3)
                                    <label class="radio-inline"><input   type="radio" name="pregunta11" id="pregunta11" value="3" checked>Buena</label>
                                @elseif($estudiante->cal_preg_11 == 2)
                                    <label class="radio-inline"><input   type="radio" name="pregunta11" id="pregunta11" value="2" checked>Regular</label>
                                @elseif($estudiante->cal_preg_11 == 1)
                                    <label class="radio-inline"><input   type="radio" name="pregunta11" id="pregunta11" value="1" checked>Mala</label>
                                @endif
                            </div>
                        </div>
                        @if($estudiante->cal_preg_11 != "")
                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Comentarios">COMENTARIOS:</label>
                                        <h4>{{ $estudiante->comentario_res_preg_10 }}</h4> </div>
                                </div>
                            </div>
                        @endif
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




        </script>


    </main>

@endsection