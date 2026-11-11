@extends('layouts.app')
@section('title', 'Encuesta de satifacción del cliente')
@section('content')
    <main class="col-md-12">
        <?php
        $historial = Session::get('historial_enc_s');

        ?>
        @if($historial == 1)
            <div class="row">
                <div class="col-md-10 col-xs-10 col-md-offset-1">
                    <p>
                        <span class="glyphicon glyphicon-arrow-right"></span>
                        <a href="{{url("/encuestas_satisfaccion/historial_periodo_year/")}}">Historial de  encuestas de satisfacción del cliente</a>
                        <span class="glyphicon glyphicon-arrow-right"></span>
                        <a href="{{url("/encuestas_satisfaccion/menu_historial_servicio_s_year/".$servicio->year)}}">Periodos</a>
                        <span class="glyphicon glyphicon-arrow-right"></span>
                        <a href="{{url("/encuestas_satisfaccion/ver_carreras_encuesta_servicio/".$servicio->mes."/".$servicio->year)}}">Programas de Estudios</a>
                        <span class="glyphicon glyphicon-arrow-right"></span>
                        <a href="{{url("/encuestas_satisfaccion/ver_enc_serv_alum_terminado/".$nombre_estudiante->id_carrera."/".$servicio->mes."/".$servicio->year)}}">Encuestas contestadas</a>
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
                    <a href="{{url("/encuestas_satisfaccion/agregar_periodo_year/")}}">Periodos</a>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="{{url("/encuestas_satisfaccion/ver_carreras_encuesta_servicio/".$servicio->mes."/".$servicio->year)}}">Programas de Estudios</a>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="{{url("/encuestas_satisfaccion/ver_enc_serv_alum_terminado/".$nombre_estudiante->id_carrera."/".$servicio->mes."/".$servicio->year)}}">Encuestas contestadas</a>
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
                        <h3 class="panel-title text-center">Encuesta de satifacción del cliente del Departamento de Servicio Social y Residencia Profesional <br> (Servicio Social)<br> @if($servicio->mes == 1) Enero @else Julio @endif del {{ $servicio->year }}<br><b>No. cuenta:</b> {{ $nombre_estudiante->cuenta }} <br> <b>Nombre del estudiante:</b> {{ $nombre_estudiante->nombre }} {{ $nombre_estudiante->apaterno }} {{ $nombre_estudiante->amaterno }}</h3>
                    </div>
                </div>
            </div>
        </div>


            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>1.-¿Cómo calificas la impartición del curso de inducción?:<br></b></p>
                                        @if($servicio->cal_preg_1 == 5)
                                        <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="5" checked>Excelente</label>
                                        @elseif($servicio->cal_preg_1 == 4)
                                        <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="4" checked>Bueno</label>
                                        @elseif($servicio->cal_preg_1 == 3)
                                        <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="3" checked>Regular</label>
                                        @elseif($servicio->cal_preg_1 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="2" checked>Malo</label>
                                        @elseif($servicio->cal_preg_1 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta1" id="pregunta1" value="1" checked>Muy malo</label>
                                        @endif

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>2.-La disponibilidad de los requisitos que se necesitan para realizar tu trámite en la pagina oficial del TESVB y Sistemas, las consideras:<br></b></p>
                                            @if($servicio->cal_preg_2 == 5)
                                            <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="5" checked>Excelente</label>
                                            @elseif($servicio->cal_preg_2 == 4)
                                            <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="4" checked>Bueno</label>
                                            @elseif($servicio->cal_preg_2 == 3)
                                            <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="3" checked>Regular</label>
                                            @elseif($servicio->cal_preg_2 == 2)
                                            <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="2" checked>Malo</label>
                                            @elseif($servicio->cal_preg_2 == 1)
                                           <label class="radio-inline"><input   type="radio" name="pregunta2" id="pregunta2" value="1" checked>Muy malo</label>
                                            @endif

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>3.-¿Qué tan claro consideras el trámite?<br></b></p>
                                        @if($servicio->cal_preg_3 == 5)
                                        <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="5" checked>Excelente</label>
                                        @elseif($servicio->cal_preg_3 == 4)
                                        <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="4" checked>Bueno</label>
                                        @elseif($servicio->cal_preg_3 == 3)
                                        <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="3" checked>Regular</label>
                                        @elseif($servicio->cal_preg_3 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="2" checked>Malo</label>
                                        @elseif($servicio->cal_preg_3 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta3" id="pregunta3" value="1" checked>Muy malo</label>
                                        @endif

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>4.-Los formatos proporcionados para realizar tu trámite son:<br></b></p>
                                        @if($servicio->cal_preg_4 == 5)
                                        <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="5" checked>Excelente</label>
                                        @elseif($servicio->cal_preg_4 == 4)
                                        <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="4" checked>Bueno</label>
                                        @elseif($servicio->cal_preg_4 == 3)
                                        <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="3" checked>Regular</label>
                                        @elseif($servicio->cal_preg_4 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="2" checked>Malo</label>
                                        @elseif($servicio->cal_preg_4 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta4" id="pregunta4" value="1" checked>Muy malo</label>
                                        @endif

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>5.-¿Cómo calificas las asesorías recibidas por parte de los docentes?<br></b></p>
                                        @if($servicio->cal_preg_5 == 5)
                                        <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="5" checked>Excelente</label>
                                        @elseif($servicio->cal_preg_5 == 4)
                                        <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="4" checked>Bueno</label>
                                        @elseif($servicio->cal_preg_5 == 3)
                                        <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="3" checked>Regular</label>
                                        @elseif($servicio->cal_preg_5 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="2" checked>Malo</label>
                                        @elseif($servicio->cal_preg_5 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta5" id="pregunta5" value="1" checked>Muy malo</label>
                                        @endif

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>6.-¿Cómo calificas el tiempo de respuesta por el Departamento, durante la gestión del trámite? Esto considerado desde la entrega correcta de tu documentación.<br></b></p>
                                        @if($servicio->cal_preg_6 == 5)
                                        <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="5" checked>Excelente</label>
                                        @elseif($servicio->cal_preg_6 == 4)
                                        <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="4" checked>Bueno</label>
                                        @elseif($servicio->cal_preg_6 == 3)
                                        <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="3" checked>Regular</label>
                                        @elseif($servicio->cal_preg_6 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="2" checked>Malo</label>
                                        @elseif($servicio->cal_preg_6 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta6" id="pregunta6" value="1" checked>Muy malo</label>
                                        @endif

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>7.-En caso de negativa del trámite, se explico claramente  lo que tenias que realizar para no ser  rechazado nuevamente:<br></b></p>
                                        @if($servicio->cal_preg_7 == 5)
                                        <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="5" checked>Excelente</label>
                                        @elseif($servicio->cal_preg_7 == 4)
                                        <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="4" checked>Bueno</label>
                                        @elseif($servicio->cal_preg_7 == 3)
                                        <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="3" checked>Regular</label>
                                        @elseif($servicio->cal_preg_7 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="2" checked>Malo</label>
                                        @elseif($servicio->cal_preg_7 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta7" id="pregunta7" value="1" checked>Muy malo</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>8.-El nivel de satisfacción personal por el servicio y atención brindada en el TESVB al término del trámite es:<br></b></p>
                                        @if($servicio->cal_preg_8 == 5)
                                        <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="5" checked>Excelente</label>
                                        @elseif($servicio->cal_preg_8 == 4)
                                        <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="4" checked>Bueno</label>
                                        @elseif($servicio->cal_preg_8 == 3)
                                        <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="3" checked>Regular</label>
                                        @elseif($servicio->cal_preg_8 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="2" checked>Malo</label>
                                        @elseif($servicio->cal_preg_8 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta8" id="pregunta8" value="1" checked>Muy malo</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>9.-¿Cómo calificas las asesorías recibidas por parte del Departamento de Servicio Social y Residencia Profesional?:<br></b></p>
                                        @if($servicio->cal_preg_9 == 5)
                                        <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="5" checked>Excelente</label>
                                        @elseif($servicio->cal_preg_9 == 4)
                                        <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="4" checked>Bueno</label>
                                        @elseif($servicio->cal_preg_9 == 3)
                                        <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="3" checked>Regular</label>
                                        @elseif($servicio->cal_preg_9 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="2" checked>Malo</label>
                                        @elseif($servicio->cal_preg_9 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta9" id="pregunta9" value="1" checked>Muy malo</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>10.- En términos generales la atención recibida por parte del Departamento de Servicio social y Residencia Profesional fue:<br></b></p>
                                        @if($servicio->cal_preg_10 == 5)
                                        <label class="radio-inline"><input   type="radio" name="pregunta10" id="pregunta10" value="5" checked>Excelente</label>
                                        @elseif($servicio->cal_preg_10 == 4)
                                        <label class="radio-inline"><input   type="radio" name="pregunta10" id="pregunta10" value="4" checked>Bueno</label>
                                        @elseif($servicio->cal_preg_10 == 3)
                                        <label class="radio-inline"><input   type="radio" name="pregunta10" id="pregunta10" value="3" checked>Regular</label>
                                        @elseif($servicio->cal_preg_10 == 2)
                                        <label class="radio-inline"><input   type="radio" name="pregunta10" id="pregunta10" value="2" checked>Malo</label>
                                        @elseif($servicio->cal_preg_10 == 1)
                                        <label class="radio-inline"><input   type="radio" name="pregunta10" id="pregunta10" value="1" checked>Muy malo</label>
                                        @endif
                                    </div>
                                </div>
                            @if($servicio->comentario !="")
                                <div class="row" >
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Comentarios">Comentario:</label>
                                            <p>{{ $servicio->comentario }}</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row" >
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Comentarios">Sin comentarios</label>
                                          </div>
                                    </div>
                                </div>

                            @endif
                        </div>
                    </div>
                </div>
            </div>






    </main>

@endsection