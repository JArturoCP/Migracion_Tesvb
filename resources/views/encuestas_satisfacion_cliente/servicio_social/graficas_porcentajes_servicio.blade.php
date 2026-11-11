@extends('layouts.app')
@section('title', 'Analisis de Encuestas de Satisfacción del Cliente')
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
                        <a href="{{url("/encuestas_satisfaccion/menu_historial_servicio_s_year/".$year)}}">Periodos</a>
                        <span class="glyphicon glyphicon-arrow-right"></span>
                        <a href="{{url("/encuestas_satisfaccion/ver_carreras_encuesta_servicio/".$mes."/".$year)}}">Programas de Estudios</a>
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span>Analisis de Encuestas</span>
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
                            <a href="{{url("/encuestas_satisfaccion/ver_carreras_encuesta_servicio/".$mes."/".$year)}}">Programas de Estudios</a>
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span>Analisis de Encuestas</span>

                        </p>
                        <br>
                    </div>
                </div>
        @endif

        <div class="row">
            <div class="col-md-6 col-md-offset-3 ">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Analisis de Encuestas de Satisfacción Cliente<br> (Servicio Social) <br>@if($mes == 1)Enero @else Julio @endif del {{ $year }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <p>1.¿Cómo calificas la impartición del curso de inducción ?</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 ">
                                <table id="tabla_envio" class="table table-bordered table-resposive">
                                    <thead>
                                    <tr>
                                        <th>Descripción</th>
                                        <th>Porcentaje</th>
                                        <th>Resultados</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td>Excelente</td>
                                        <td>{{ $por_excelente1 }} %</td>
                                        <td>{{ $preg1_excelente }}</td>
                                    </tr>
                                    <tr>
                                        <td>Bueno</td>
                                        <td>{{ $por_bueno1 }} %</td>
                                        <td>{{ $preg1_bueno }}</td>
                                    </tr>
                                    <tr>
                                        <td>Regular</td>
                                        <td>{{ $por_regular1 }} %</td>
                                        <td>{{ $preg1_regular }}</td>
                                    </tr>
                                    <tr>
                                        <td>Malo</td>
                                        <td>{{ $por_malo1 }} %</td>
                                        <td>{{ $preg1_malo }}</td>
                                    </tr>
                                    <tr>
                                        <td>Muy Malo</td>
                                        <td>{{ $por_muy_malo1 }} %</td>
                                        <td>{{ $preg1_muymalo }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-md-5 ">
                                <div  id="preg1"></div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <p>2.-La disponibilidad de los requisitos que se necesitan para realizar tu trámite en la pagina oficial del TESVB y Sistemas, las consideras:</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 ">
                                <table id="tabla_envio" class="table table-bordered table-resposive">
                                    <thead>
                                    <tr>
                                        <th>Descripción</th>
                                        <th>Porcentaje</th>
                                        <th>Resultados</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td>Excelente</td>
                                        <td>{{ $por_excelente2 }} %</td>
                                        <td>{{ $preg2_excelente }}</td>
                                    </tr>
                                    <tr>
                                        <td>Bueno</td>
                                        <td>{{ $por_bueno2 }} %</td>
                                        <td>{{ $preg2_bueno }}</td>
                                    </tr>
                                    <tr>
                                        <td>Regular</td>
                                        <td>{{ $por_regular2 }} %</td>
                                        <td>{{ $preg2_regular }}</td>
                                    </tr>
                                    <tr>
                                        <td>Malo</td>
                                        <td>{{ $por_malo2 }} %</td>
                                        <td>{{ $preg2_malo }}</td>
                                    </tr>
                                    <tr>
                                        <td>Muy Malo</td>
                                        <td>{{ $por_muy_malo2 }} %</td>
                                        <td>{{ $preg2_muymalo }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-md-5 ">
                                <div  id="preg2"></div>
                            </div>
                        </div>




                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <p>3.-¿Qué tan claro consideras el trámite?</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 ">
                                <table id="tabla_envio" class="table table-bordered table-resposive">
                                    <thead>
                                    <tr>
                                        <th>Descripción</th>
                                        <th>Porcentaje</th>
                                        <th>Resultados</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td>Excelente</td>
                                        <td>{{ $por_excelente3 }} %</td>
                                        <td>{{ $preg3_excelente }}</td>
                                    </tr>
                                    <tr>
                                        <td>Bueno</td>
                                        <td>{{ $por_bueno3 }} %</td>
                                        <td>{{ $preg3_bueno }}</td>
                                    </tr>
                                    <tr>
                                        <td>Regular</td>
                                        <td>{{ $por_regular3 }} %</td>
                                        <td>{{ $preg3_regular }}</td>
                                    </tr>
                                    <tr>
                                        <td>Malo</td>
                                        <td>{{ $por_malo3 }} %</td>
                                        <td>{{ $preg3_malo }}</td>
                                    </tr>
                                    <tr>
                                        <td>Muy Malo</td>
                                        <td>{{ $por_muy_malo3 }} %</td>
                                        <td>{{ $preg3_muymalo }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-md-5 ">
                                <div  id="preg3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <p>4.-Los formatos proporcionados para realizar tu trámite son:</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 ">
                                <table id="tabla_envio" class="table table-bordered table-resposive">
                                    <thead>
                                    <tr>
                                        <th>Descripción</th>
                                        <th>Porcentaje</th>
                                        <th>Resultados</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td>Excelente</td>
                                        <td>{{ $por_excelente4 }} %</td>
                                        <td>{{ $preg4_excelente }}</td>
                                    </tr>
                                    <tr>
                                        <td>Bueno</td>
                                        <td>{{ $por_bueno4 }} %</td>
                                        <td>{{ $preg4_bueno }}</td>
                                    </tr>
                                    <tr>
                                        <td>Regular</td>
                                        <td>{{ $por_regular4 }} %</td>
                                        <td>{{ $preg4_regular }}</td>
                                    </tr>
                                    <tr>
                                        <td>Malo</td>
                                        <td>{{ $por_malo4 }} %</td>
                                        <td>{{ $preg4_malo }}</td>
                                    </tr>
                                    <tr>
                                        <td>Muy Malo</td>
                                        <td>{{ $por_muy_malo4 }} %</td>
                                        <td>{{ $preg4_muymalo }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-md-5 ">
                                <div  id="preg4"></div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <p>5.-¿Cómo calificas las asesorías recibidas por parte de los docentes?</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 ">
                                <table id="tabla_envio" class="table table-bordered table-resposive">
                                    <thead>
                                    <tr>
                                        <th>Descripción</th>
                                        <th>Porcentaje</th>
                                        <th>Resultados</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td>Excelente</td>
                                        <td>{{ $por_excelente5 }} %</td>
                                        <td>{{ $preg5_excelente }}</td>
                                    </tr>
                                    <tr>
                                        <td>Bueno</td>
                                        <td>{{ $por_bueno5 }} %</td>
                                        <td>{{ $preg5_bueno }}</td>
                                    </tr>
                                    <tr>
                                        <td>Regular</td>
                                        <td>{{ $por_regular5 }} %</td>
                                        <td>{{ $preg5_regular }}</td>
                                    </tr>
                                    <tr>
                                        <td>Malo</td>
                                        <td>{{ $por_malo5 }} %</td>
                                        <td>{{ $preg5_malo }}</td>
                                    </tr>
                                    <tr>
                                        <td>Muy Malo</td>
                                        <td>{{ $por_muy_malo5 }} %</td>
                                        <td>{{ $preg5_muymalo }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-md-5 ">
                                <div  id="preg5"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <p>6.-¿Cómo calificas el tiempo de respuesta por el Departamento, durante la gestión del trámite? Esto considerado desde la entrega correcta de tu documentación.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 ">
                                <table id="tabla_envio" class="table table-bordered table-resposive">
                                    <thead>
                                    <tr>
                                        <th>Descripción</th>
                                        <th>Porcentaje</th>
                                        <th>Resultados</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td>Excelente</td>
                                        <td>{{ $por_excelente6 }} %</td>
                                        <td>{{ $preg6_excelente }}</td>
                                    </tr>
                                    <tr>
                                        <td>Bueno</td>
                                        <td>{{ $por_bueno6 }} %</td>
                                        <td>{{ $preg6_bueno }}</td>
                                    </tr>
                                    <tr>
                                        <td>Regular</td>
                                        <td>{{ $por_regular6 }} %</td>
                                        <td>{{ $preg6_regular }}</td>
                                    </tr>
                                    <tr>
                                        <td>Malo</td>
                                        <td>{{ $por_malo6 }} %</td>
                                        <td>{{ $preg6_malo }}</td>
                                    </tr>
                                    <tr>
                                        <td>Muy Malo</td>
                                        <td>{{ $por_muy_malo6 }} %</td>
                                        <td>{{ $preg6_muymalo }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-md-5 ">
                                <div  id="preg6"></div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <p>7.-En caso de negativa del trámite, se explico claramente  lo que tenias que realizar para no ser  rechazado nuevamente:</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 ">
                                <table id="tabla_envio" class="table table-bordered table-resposive">
                                    <thead>
                                    <tr>
                                        <th>Descripción</th>
                                        <th>Porcentaje</th>
                                        <th>Resultados</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td>Excelente</td>
                                        <td>{{ $por_excelente7 }} %</td>
                                        <td>{{ $preg7_excelente }}</td>
                                    </tr>
                                    <tr>
                                        <td>Bueno</td>
                                        <td>{{ $por_bueno7 }} %</td>
                                        <td>{{ $preg7_bueno }}</td>
                                    </tr>
                                    <tr>
                                        <td>Regular</td>
                                        <td>{{ $por_regular7 }} %</td>
                                        <td>{{ $preg7_regular }}</td>
                                    </tr>
                                    <tr>
                                        <td>Malo</td>
                                        <td>{{ $por_malo7 }} %</td>
                                        <td>{{ $preg7_malo }}</td>
                                    </tr>
                                    <tr>
                                        <td>Muy Malo</td>
                                        <td>{{ $por_muy_malo7 }} %</td>
                                        <td>{{ $preg7_muymalo }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-md-5 ">
                                <div  id="preg7"></div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <p>8.-El nivel de satisfacción personal por el servicio y atención brindada en el TESVB al término del trámite es:</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 ">
                                <table id="tabla_envio" class="table table-bordered table-resposive">
                                    <thead>
                                    <tr>
                                        <th>Descripción</th>
                                        <th>Porcentaje</th>
                                        <th>Resultados</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td>Excelente</td>
                                        <td>{{ $por_excelente8 }} %</td>
                                        <td>{{ $preg8_excelente }}</td>
                                    </tr>
                                    <tr>
                                        <td>Bueno</td>
                                        <td>{{ $por_bueno8 }} %</td>
                                        <td>{{ $preg8_bueno }}</td>
                                    </tr>
                                    <tr>
                                        <td>Regular</td>
                                        <td>{{ $por_regular8 }} %</td>
                                        <td>{{ $preg8_regular }}</td>
                                    </tr>
                                    <tr>
                                        <td>Malo</td>
                                        <td>{{ $por_malo8 }} %</td>
                                        <td>{{ $preg8_malo }}</td>
                                    </tr>
                                    <tr>
                                        <td>Muy Malo</td>
                                        <td>{{ $por_muy_malo8 }} %</td>
                                        <td>{{ $preg8_muymalo }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-md-5 ">
                                <div  id="preg8"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <p>9.-¿Cómo calificas las asesorías recibidas por parte del Departamento de Servicio Social y Residencia Profesional?:</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 ">
                                <table id="tabla_envio" class="table table-bordered table-resposive">
                                    <thead>
                                    <tr>
                                        <th>Descripción</th>
                                        <th>Porcentaje</th>
                                        <th>Resultados</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td>Excelente</td>
                                        <td>{{ $por_excelente9 }} %</td>
                                        <td>{{ $preg9_excelente }}</td>
                                    </tr>
                                    <tr>
                                        <td>Bueno</td>
                                        <td>{{ $por_bueno9 }} %</td>
                                        <td>{{ $preg9_bueno }}</td>
                                    </tr>
                                    <tr>
                                        <td>Regular</td>
                                        <td>{{ $por_regular9 }} %</td>
                                        <td>{{ $preg9_regular }}</td>
                                    </tr>
                                    <tr>
                                        <td>Malo</td>
                                        <td>{{ $por_malo9 }} %</td>
                                        <td>{{ $preg9_malo }}</td>
                                    </tr>
                                    <tr>
                                        <td>Muy Malo</td>
                                        <td>{{ $por_muy_malo9 }} %</td>
                                        <td>{{ $preg9_muymalo }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-md-5 ">
                                <div  id="preg9"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <p>10.- En términos generales la atención recibida por parte del Departamento de Servicio social y Residencia Profesional fue:</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 ">
                                <table id="tabla_envio" class="table table-bordered table-resposive">
                                    <thead>
                                    <tr>
                                        <th>Descripción</th>
                                        <th>Porcentaje</th>
                                        <th>Resultados</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td>Excelente</td>
                                        <td>{{ $por_excelente10 }} %</td>
                                        <td>{{ $preg10_excelente }}</td>
                                    </tr>
                                    <tr>
                                        <td>Bueno</td>
                                        <td>{{ $por_bueno10 }} %</td>
                                        <td>{{ $preg10_bueno }}</td>
                                    </tr>
                                    <tr>
                                        <td>Regular</td>
                                        <td>{{ $por_regular10 }} %</td>
                                        <td>{{ $preg10_regular }}</td>
                                    </tr>
                                    <tr>
                                        <td>Malo</td>
                                        <td>{{ $por_malo10 }} %</td>
                                        <td>{{ $preg10_malo }}</td>
                                    </tr>
                                    <tr>
                                        <td>Muy Malo</td>
                                        <td>{{ $por_muy_malo10 }} %</td>
                                        <td>{{ $preg10_muymalo }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-md-5 ">
                                <div  id="preg10"></div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <p>Resultado Final</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 ">
                    <table id="tabla_envio" class="table table-bordered table-resposive">
                    <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Porcentaje</th>
                        <th>Resultados</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>Excelente</td>
                        <td>{{ $por_excelente }} %</td>
                        <td>{{ $excelente }}</td>
                    </tr>
                    <tr>
                        <td>Bueno</td>
                        <td>{{ $por_bueno }} %</td>
                        <td>{{ $bueno }}</td>
                    </tr>
                    <tr>
                        <td>Regular</td>
                        <td>{{ $por_regular }} %</td>
                        <td>{{ $regular }}</td>
                    </tr>
                    <tr>
                        <td>Malo</td>
                        <td>{{ $por_malo }} %</td>
                        <td>{{ $malo }}</td>
                    </tr>
                    <tr>
                        <td>Muy Malo</td>
                        <td>{{ $por_muy_malo }} %</td>
                        <td>{{ $muy_malo }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="background: #b8daff">Excelente y bueno</td>
                        <td style="background: #b8daff">{{ $por_excelente + $por_bueno }} %</td>
                        <td></td>
                    </tr>


                    </tbody>
                </table>
                    </div>
                    <div class="col-md-5">
                        <div  id="container"></div>
                    </div>
            </div>
        </div>
                </div>
            </div>




        <script>
            $(document).ready(function() {

// Build the chart
                // Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

// Create the chart
                Highcharts.chart('preg1', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        align: 'left',
                        text: ''

                    },
                    subtitle: {
                        align: 'left',
                        text: ''
                    },
                    accessibility: {
                        announceNewData: {
                            enabled: true
                        }
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: ''
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            //  borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.2f}%'
                            }
                        }
                    },

                    tooltip: {
                        //  headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> <br/>'
                    },

                    series: [{
                        name: 'Porcentaje',
                        colorByPoint: true,
                        data: [

                            {
                                name: 'Excelente',
                                y: {{ $por_excelente1 }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_bueno1 }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular1 }},
                            },
                            {
                                name: 'Malo',
                                y: {{ $por_malo1 }},
                            },
                            {
                                name: 'Muy Malo',
                                y: {{ $por_muy_malo1 }},
                            },
                        ]
                    }]
                });
                Highcharts.chart('preg2', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        align: 'left',
                        text: ''

                    },
                    subtitle: {
                        align: 'left',
                        text: ''
                    },
                    accessibility: {
                        announceNewData: {
                            enabled: true
                        }
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: ''
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            //  borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.2f}%'
                            }
                        }
                    },

                    tooltip: {
                        //  headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> <br/>'
                    },

                    series: [{
                        name: 'Porcentaje',
                        colorByPoint: true,
                        data: [

                            {
                                name: 'Excelente',
                                y: {{ $por_excelente2 }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_bueno2 }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular2 }},
                            },
                            {
                                name: 'Malo',
                                y: {{ $por_malo2 }},
                            },
                            {
                                name: 'Muy Malo',
                                y: {{ $por_muy_malo2 }},
                            },
                        ]
                    }]
                });
                Highcharts.chart('preg3', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        align: 'left',
                        text: ''

                    },
                    subtitle: {
                        align: 'left',
                        text: ''
                    },
                    accessibility: {
                        announceNewData: {
                            enabled: true
                        }
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: ''
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            //  borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.2f}%'
                            }
                        }
                    },

                    tooltip: {
                        //  headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> <br/>'
                    },

                    series: [{
                        name: 'Porcentaje',
                        colorByPoint: true,
                        data: [

                            {
                                name: 'Excelente',
                                y: {{ $por_excelente3 }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_bueno3 }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular3 }},
                            },
                            {
                                name: 'Malo',
                                y: {{ $por_malo3 }},
                            },
                            {
                                name: 'Muy Malo',
                                y: {{ $por_muy_malo3 }},
                            },
                        ]
                    }]
                });
                Highcharts.chart('preg4', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        align: 'left',
                        text: ''

                    },
                    subtitle: {
                        align: 'left',
                        text: ''
                    },
                    accessibility: {
                        announceNewData: {
                            enabled: true
                        }
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: ''
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            //  borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.2f}%'
                            }
                        }
                    },

                    tooltip: {
                        //  headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> <br/>'
                    },

                    series: [{
                        name: 'Porcentaje',
                        colorByPoint: true,
                        data: [

                            {
                                name: 'Excelente',
                                y: {{ $por_excelente4 }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_bueno4 }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular4 }},
                            },
                            {
                                name: 'Malo',
                                y: {{ $por_malo4 }},
                            },
                            {
                                name: 'Muy Malo',
                                y: {{ $por_muy_malo4 }},
                            },
                        ]
                    }]
                });
                Highcharts.chart('preg5', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        align: 'left',
                        text: ''

                    },
                    subtitle: {
                        align: 'left',
                        text: ''
                    },
                    accessibility: {
                        announceNewData: {
                            enabled: true
                        }
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: ''
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            //  borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.2f}%'
                            }
                        }
                    },

                    tooltip: {
                        //  headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> <br/>'
                    },

                    series: [{
                        name: 'Porcentaje',
                        colorByPoint: true,
                        data: [

                            {
                                name: 'Excelente',
                                y: {{ $por_excelente5 }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_bueno5 }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular5 }},
                            },
                            {
                                name: 'Malo',
                                y: {{ $por_malo5 }},
                            },
                            {
                                name: 'Muy Malo',
                                y: {{ $por_muy_malo5 }},
                            },
                        ]
                    }]
                });
                Highcharts.chart('preg6', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        align: 'left',
                        text: ''

                    },
                    subtitle: {
                        align: 'left',
                        text: ''
                    },
                    accessibility: {
                        announceNewData: {
                            enabled: true
                        }
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: ''
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            //  borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.2f}%'
                            }
                        }
                    },

                    tooltip: {
                        //  headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> <br/>'
                    },

                    series: [{
                        name: 'Porcentaje',
                        colorByPoint: true,
                        data: [

                            {
                                name: 'Excelente',
                                y: {{ $por_excelente6 }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_bueno6 }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular6 }},
                            },
                            {
                                name: 'Malo',
                                y: {{ $por_malo6 }},
                            },
                            {
                                name: 'Muy Malo',
                                y: {{ $por_muy_malo6 }},
                            },
                        ]
                    }]
                });
                Highcharts.chart('preg7', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        align: 'left',
                        text: ''

                    },
                    subtitle: {
                        align: 'left',
                        text: ''
                    },
                    accessibility: {
                        announceNewData: {
                            enabled: true
                        }
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: ''
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            //  borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.2f}%'
                            }
                        }
                    },

                    tooltip: {
                        //  headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> <br/>'
                    },

                    series: [{
                        name: 'Porcentaje',
                        colorByPoint: true,
                        data: [

                            {
                                name: 'Excelente',
                                y: {{ $por_excelente7 }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_bueno7 }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular7 }},
                            },
                            {
                                name: 'Malo',
                                y: {{ $por_malo7 }},
                            },
                            {
                                name: 'Muy Malo',
                                y: {{ $por_muy_malo7 }},
                            },
                        ]
                    }]
                });
                Highcharts.chart('preg8', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        align: 'left',
                        text: ''

                    },
                    subtitle: {
                        align: 'left',
                        text: ''
                    },
                    accessibility: {
                        announceNewData: {
                            enabled: true
                        }
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: ''
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            //  borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.2f}%'
                            }
                        }
                    },

                    tooltip: {
                        //  headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> <br/>'
                    },

                    series: [{
                        name: 'Porcentaje',
                        colorByPoint: true,
                        data: [

                            {
                                name: 'Excelente',
                                y: {{ $por_excelente8 }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_bueno8 }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular8 }},
                            },
                            {
                                name: 'Malo',
                                y: {{ $por_malo8 }},
                            },
                            {
                                name: 'Muy Malo',
                                y: {{ $por_muy_malo8 }},
                            },
                        ]
                    }]
                });
                Highcharts.chart('preg9', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        align: 'left',
                        text: ''

                    },
                    subtitle: {
                        align: 'left',
                        text: ''
                    },
                    accessibility: {
                        announceNewData: {
                            enabled: true
                        }
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: ''
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            //  borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.2f}%'
                            }
                        }
                    },

                    tooltip: {
                        //  headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> <br/>'
                    },

                    series: [{
                        name: 'Porcentaje',
                        colorByPoint: true,
                        data: [

                            {
                                name: 'Excelente',
                                y: {{ $por_excelente9 }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_bueno9 }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular9 }},
                            },
                            {
                                name: 'Malo',
                                y: {{ $por_malo9 }},
                            },
                            {
                                name: 'Muy Malo',
                                y: {{ $por_muy_malo9 }},
                            },
                        ]
                    }]
                });
                Highcharts.chart('preg10', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        align: 'left',
                        text: ''

                    },
                    subtitle: {
                        align: 'left',
                        text: ''
                    },
                    accessibility: {
                        announceNewData: {
                            enabled: true
                        }
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: ''
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            //  borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.2f}%'
                            }
                        }
                    },

                    tooltip: {
                        //  headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> <br/>'
                    },

                    series: [{
                        name: 'Porcentaje',
                        colorByPoint: true,
                        data: [

                            {
                                name: 'Excelente',
                                y: {{ $por_excelente10 }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_bueno10 }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular10 }},
                            },
                            {
                                name: 'Malo',
                                y: {{ $por_malo10 }},
                            },
                            {
                                name: 'Muy Malo',
                                y: {{ $por_muy_malo10 }},
                            },
                        ]
                    }]
                });
                Highcharts.chart('container', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        align: 'left',
                        text: ''

                    },
                    subtitle: {
                        align: 'left',
                        text: ''
                    },
                    accessibility: {
                        announceNewData: {
                            enabled: true
                        }
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: ''
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            //  borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.2f}%'
                            }
                        }
                    },

                    tooltip: {
                        //  headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> <br/>'
                    },

                    series: [{
                        name: 'Porcentaje',
                        colorByPoint: true,
                        data: [

                            {
                                name: 'Excelente',
                                y: {{ $por_excelente }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_bueno }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular }},
                            },
                            {
                                name: 'Malo',
                                y: {{ $por_malo }},
                            },
                            {
                                name: 'Muy Malo',
                                y: {{ $por_muy_malo }},
                            },
                        ]
                    }]
                });

            });

        </script>


    </main>

@endsection