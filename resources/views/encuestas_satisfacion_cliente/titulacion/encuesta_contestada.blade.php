@extends('layouts.app')
@section('title', 'Encuesta de satifacción del cliente')
@section('content')
    <main class="col-md-12">
        <?php
        $historial = Session::get('historial_enc_t');
        ?>
        @if($historial == 1)
                <div class="row">
                    <div class="col-md-10 col-xs-10 col-md-offset-1">
                        <p>
                            <span class="glyphicon glyphicon-arrow-right"></span>
                            <a href="{{url("/encuestas_satisfaccion/historial_encuesta_estudiante_titulacion")}}">Historial de  encuestas (TITULACIÓN)</a>
                            <span class="glyphicon glyphicon-arrow-right"></span>
                            <a href="{{url("/encuestas_satisfaccion/menu_historial_titulacion_year/".$registro->year)}}">Periodos de las encuestas</a>
                            <span class="glyphicon glyphicon-arrow-right"></span>
                            <a href="{{url("/encuestas_satisfaccion/enc_contestadas_carreras_ti/".$registro->mes."/".$registro->year)}}">Programas de Estudios</a>
                            <span class="glyphicon glyphicon-arrow-right"></span>
                            <a href="{{url("/encuestas_satisfaccion/enc_est_ti_carrera_termino/".$registro->id_carrera."/".$registro->mes."/".$registro->year)}}">Encuestas contestadas</a>
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span>Encuesta del estudiante</span>
                        </p>
                        <br>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-10 col-xs-10 col-md-offset-1">
                        <p>
                            <span class="glyphicon glyphicon-arrow-right"></span>
                            <a href="{{url("/encuestas_satisfaccion/enviar_encuesta_estudiante_titulacion")}}">Periodos de las encuestas</a>
                            <span class="glyphicon glyphicon-arrow-right"></span>
                            <a href="{{url("/encuestas_satisfaccion/enc_contestadas_carreras_ti/".$registro->mes."/".$registro->year)}}">Programas de Estudios</a>
                            <span class="glyphicon glyphicon-arrow-right"></span>
                            <a href="{{url("/encuestas_satisfaccion/enc_est_ti_carrera_termino/".$registro->id_carrera."/".$registro->mes."/".$registro->year)}}">Encuestas contestadas</a>
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span>Encuesta del estudiante</span>
                        </p>
                        <br>
                    </div>
                </div>
            @endif

        <div class="row">
            <div class="col-md-6 col-md-offset-3 ">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Encuesta de satifacción del cliente del Departamento <br> (Titulación)<br>@if($registro->mes == 1) Enero @else Julio  @endif del {{ $registro->year }} <br> Estudiante: <b>{{ $registro->cuenta.' '. $registro->nombre.' '. $registro->apaterno.' '.$registro->amaterno }}</b></h3>
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
                                        <p><b>1.-Se me comento donde debo realizar el trámite de titulación:*<br></b></p>
                                        @if($registro->resp_preg4 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="1" checked>Si</label>
                                        @elseif($registro->resp_preg4 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="2" checked>No</label>
                                        @endif

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>2.-Se me brindó la información acerca de cómo debo realizar el trámite de titulacón:*<br></b></p>
                                        @if($registro->resp_preg5 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="1" checked>Si</label>
                                        @elseif($registro->resp_preg5 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="2" checked>No</label>
                                        @endif

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>3.-Se me dieron a conocer las opciones de titulación:*<br></b></p>
                                        @if($registro->resp_preg6 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="1" checked>Si</label>
                                        @elseif($registro->resp_preg6 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="2" checked>No</label>
                                        @endif

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>4.-La persona que me atendió respondió a mis dudas:*.<br></b></p>
                                        @if($registro->resp_preg7 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="1" checked>Si</label>
                                        @elseif($registro->resp_preg7 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="2" checked>No</label>
                                        @endif

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>5.-Se me informó en tiempo y forma si se realizaron cambios en el proceso de titulación:*.<br></b></p>
                                        @if($registro->resp_preg8 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="1" checked>Si</label>
                                        @elseif($registro->resp_preg8 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="2" checked>No</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>6.-Creo que tener una plática de titulación antes de egresar es: *<br></b></p>
                                        @if($registro->resp_preg9 == 5)
                                        <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="5" checked>Muy importante</label>
                                        @elseif($registro->resp_preg9 == 4)
                                        <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="4" checked>Importante</label>
                                        @elseif($registro->resp_preg9 == 3)
                                        <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="3" checked>Me da igual</label>
                                        @elseif($registro->resp_preg9 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="2" checked>Poca importancia</label>
                                        @elseif($registro->resp_preg9 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="1" checked>Sin importancia</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>7.-Me informaron sobre la plática de titulación:*.<br></b></p>
                                        @if($registro->resp_preg10 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="1" checked>Si</label>
                                        @elseif($registro->resp_preg10 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="2" checked>No</label>
                                        @endif

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>8.-Asistí a la plática de titulación:*.<br></b></p>
                                        @if($registro->resp_preg11 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="1" checked>Si</label>
                                        @elseif($registro->resp_preg11 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="2" checked>No</label>
                                        @endif

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>9.-Fue clara la plática de titulación:*.<br></b></p>
                                        @if($registro->resp_preg12 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="1" checked>Si</label>
                                        @elseif($registro->resp_preg12 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="2" checked>No</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>10.-Se respetó mi turno:*.<br></b></p>
                                        @if($registro->resp_preg13 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta10" id="pregunta10" value="1" checked>Si</label>
                                        @elseif($registro->resp_preg13 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta10" id="pregunta10" value="2" checked>No</label>
                                        @endif

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>11.-Me atendieron adecuadamente:*.<br></b></p>
                                        @if($registro->resp_preg14 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta11" id="pregunta11" value="1"checked>Si</label>
                                        @elseif($registro->resp_preg14 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta11" id="pregunta11" value="2" checked>No</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>12.-El tiempo del proceso de titulación fue:*<br></b></p>
                                        @if($registro->resp_preg15 == 5)
                                        <label class="radio-inline"><input   type="radio" name="pregunta12" id="pregunta12" value="5" checked>Muy Extenso</label>
                                        @elseif($registro->resp_preg15 == 4)
                                        <label class="radio-inline"><input   type="radio" name="pregunta12" id="pregunta12" value="4" checked>Extenso</label>
                                        @elseif($registro->resp_preg15 == 3)
                                        <label class="radio-inline"><input   type="radio" name="pregunta12" id="pregunta12" value="3" checked>Adecuado</label>
                                        @elseif($registro->resp_preg15 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta12" id="pregunta12" value="2" checked>Corto</label>
                                        @elseif($registro->resp_preg15 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta12" id="pregunta12" value="1" checked>Muy Corto</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>13.-El tramite fue sencillo:*<br></b></p>
                                        @if($registro->resp_preg16 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta13" id="pregunta13" value="1" checked>Si</label>
                                        @elseif($registro->resp_preg16 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta13" id="pregunta13" value="2" checked>No</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>14.-El proceso es claro:*<br></b></p>
                                        @if($registro->resp_preg17 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta14" id="pregunta14" value="1" checked>Si</label>
                                        @elseif($registro->resp_preg17 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta14" id="pregunta14" value="2" checked>No</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>15.-Fui tratado con respeto, cortesía y amabilidad:*<br></b></p>
                                        @if($registro->resp_preg18 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta15" id="pregunta15" value="1" checked>Si</label>
                                        @elseif($registro->resp_preg18 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta15" id="pregunta15" value="2" checked>No</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="row" >
                                    <div class="col-md-12">
                                       <h4>Comentario: <br>{{ $registro->comentario_adicional }}</h4>
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




        </script>


    </main>

@endsection