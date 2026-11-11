@extends('layouts.app')
@section('title', 'Analisis de Encuestas de Satisfacción del Cliente')
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
                            <a href="{{url("/encuestas_satisfaccion/menu_historial_titulacion_year/".$year)}}">Periodos de las encuestas</a>
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span>Ver resultados</span>
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
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span>Ver resultados</span>
                        </p>
                        <br>
                    </div>
                </div>
            @endif
        <div class="row">
            <div class="col-md-6 col-md-offset-3 ">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Ver resultados de Encuestas de Satisfacción del Cliente del Departamento de Titulación</h3>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table id="tabla_envio" class="table table-bordered table-resposive">
                    <thead>
                    <tr>
                        <th>Preguntas</th>
                        <th style="background: green;">4</th>
                        <th style="background: green;">5</th>
                        <th style="background: green;">6</th>
                        <th style="background: deepskyblue;">7</th>
                        <th style="background: green;">8</th>
                        <th style="background: deepskyblue;">9</th>
                        <th style="background: green;">10</th>
                        <th style="background: deepskyblue;">11</th>
                        <th style="background: deepskyblue;">12</th>
                        <th style="background: deepskyblue;">13</th>
                        <th style="background: deepskyblue;">14</th>
                        <th style="background: yellow;">15</th>
                        <th style="background: deepskyblue;">16</th>
                        <th style="background: green;">17</th>
                        <th style="background: deepskyblue;">18</th>
                        <th style="">t. a. r.</th>
                        <th style="">Total de puntos por rubro</th>
                        <th style="">Porcentaje</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td style="background: deepskyblue;"><b>Servicio (t. p. s.)</b></td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>{{ $preg7 }}</td>
                        <td>0</td>
                        <td>{{ $preg9 }}</td>
                        <td>0</td>
                        <td>{{ $preg11 }}</td>
                        <td>{{ $preg12 }}</td>
                        <td>{{ $preg13 }}</td>
                        <td>{{ $preg14 }}</td>
                        <td>0</td>
                        <td>{{ $preg16 }}</td>
                        <td>0</td>
                        <td>{{ $preg18 }}</td>
                        <td>{{ $total_serv_rubro }}</td>
                        <td>{{ $total_serv_satisfacion }}</td>
                        <td>{{ $porcentaje_serv_sat }} %</td>

                    </tr>
                    <tr>
                        <td style="background: green;"><b>Información (t. p. i.)</b></td>
                        <td>{{ $preg4 }}</td>
                        <td>{{ $preg5 }}</td>
                        <td>{{ $preg6 }}</td>
                        <td>0</td>
                        <td>{{ $preg8 }}</td>
                        <td>0</td>
                        <td>{{ $preg10 }}</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>{{ $preg17 }}</td>
                        <td>0</td>
                        <td>{{ $total_inf_rubro }}</td>
                        <td>{{ $total_inf_satisfacion }}</td>
                        <td>{{ $porcentaje_inf_sat }} %</td>

                    </tr>
                    <tr>
                        <td style="background: yellow;"><b>Tiempo (t. r. a. + t. e. r. c. + t. e. r. mc.)</b> </td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>{{ $preg15 }}</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>{{ $total_tiempo_rubro }} </td>
                        <td>{{ $total_tiempo_satisfacion }} </td>
                        <td>{{ $porcentaje_tiempo_sat }} %</td>

                    </tr>


                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <table id="tabla_envio" class="table table-bordered table-resposive">
                <tbody>
                <tr>
                    <td style="background: deepskyblue;"><b>Servicio</b></td>
                    <td>{{ $porcentaje_serv_sat }} %</td>

                </tr>
                <tr>
                    <td style="background: green;"><b>Información</b></td>
                    <td>{{ $porcentaje_inf_sat }} %</td>

                </tr>
                <tr>
                    <td style="background: yellow;"><b>Tiempo</b> </td>
                    <td>{{ $porcentaje_tiempo_sat }} %</td>

                </tr>
                <tr>
                    <td><b>% de satisfacción</b></td>
                    <td><b>{{ $satisfacion_total }}%</b></td>
                </tr>


                </tbody>
            </table>
        </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div  id="container"></div>


            </div>
        </div>



        <script>
            $(document).ready(function() {

// Build the chart
                // Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

// Create the chart
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
                                name: 'Servicio',
                                y: {{ $porcentaje_serv_sat }},
                            },
                            {
                                name: 'Información',
                                y: {{ $porcentaje_inf_sat }},
                            },
                            {
                                name: 'Tiempo',
                                y: {{ $porcentaje_tiempo_sat }},
                            },
                            {
                                name: 'Satisfacción Total',
                                y: {{ $satisfacion_total }},
                            },

                        ]
                    }]
                });

            });

        </script>


    </main>

@endsection