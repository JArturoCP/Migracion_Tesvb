@extends('layouts.app')
@section('title', 'Encuesta de satifacción del cliente')
@section('content')
    <main class="col-md-12">
        <div class="row">
            <div class="col-md-10 col-xs-10 col-md-offset-1">
                <p>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="{{url("/encuestas_satisfaccion/encuesta_incripcion_periodo")}}">Periodos</a>
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span>Encuestas</span>
                </p>
                <br>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3 ">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Encuestas de satifacción del cliente de inscripción<br> Periodo {{ $periodo_nom->periodo }}<br>(Subdirección de servicios escolares)</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table id="tabla_envio" class="table table-bordered table-resposive">
                <thead>
                <tr>
                    <th>Pregunta Respuesta</th>
                    <th>Excelente</th>
                    <th>Buena</th>
                    <th>Regular</th>
                    <th>Mala</th>
                    <th>Muy mala</th>
                    <th>NÚMERO DE ENCUESTAS</th>
                    <th>Grafica</th>
                </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>1.- ¿Considerando que el personal de la Subdirección de Servicios Escolares atiende ventanillas en un horario 9:00 a 18:00 horas, el tiempo es?</td>
                        <td>{{ $excelente1 }}</td>
                        <td>{{ $buena1 }}</td>
                        <td>{{ $regular1 }}</td>
                        <td>{{ $mala1 }}</td>
                        <td>0</td>
                        <td>{{ $total_enc_preg1 }}</td>
                        <td><div style="width: 500px; height: 200px;"  id="container1">

                            </div></td>
                    </tr>
                    <tr>
                        <td>2.-¿El tiempo de espera para ser atendido en ventanilla es adecuado?</td>
                        <td>{{ $excelente2 }}</td>
                        <td>{{ $buena2 }}</td>
                        <td>{{ $regular2 }}</td>
                        <td>{{ $mala2 }}</td>
                        <td>0</td>
                        <td>{{ $total_enc_preg2 }}</td>
                        <td><div style="width: 500px; height: 200px;"  id="container2">

                            </div></td>
                    </tr>
                    <tr>
                        <td>3.-¿El tiempo de respuesta a mi solicitud es eficiente, cuando me presento con mi documentación completa?</td>
                        <td>{{ $excelente3 }}</td>
                        <td>{{ $buena3 }}</td>
                        <td>{{ $regular3 }}</td>
                        <td>{{ $mala3 }}</td>
                        <td>0</td>
                        <td>{{ $total_enc_preg3 }}</td>
                        <td><div style="width: 500px; height: 200px;"  id="container3">

                            </div></td>
                    </tr>
                    <tr>
                        <td>4.-¿La disponibilidad del personal para consultar dudas de tipo académico es adecuada?</td>
                        <td>{{ $excelente4 }}</td>
                        <td>{{ $buena4 }}</td>
                        <td>{{ $regular4 }}</td>
                        <td>{{ $mala4 }}</td>
                        <td>0</td>
                        <td>{{ $total_enc_preg4 }}</td>
                        <td><div style="width: 500px; height: 200px;"  id="container4">

                            </div></td>
                    </tr>
                    <tr>
                        <td>5.-Me atienden de forma adecuada cuando solicito su apoyo.</td>
                        <td>{{ $excelente5 }}</td>
                        <td>{{ $buena5 }}</td>
                        <td>{{ $regular5 }}</td>
                        <td>{{ $mala5 }}</td>
                        <td>0</td>
                        <td>{{ $total_enc_preg5 }}</td>
                        <td><div style="width: 500px; height: 200px;"  id="container5">

                            </div></td>
                    </tr>
                    <tr>
                        <td>6.-¿Cómo consideras el trámite de inscripción, reinscripción y afiliación al IMSS de manera presencial?</td>
                        <td>{{ $excelente6 }}</td>
                        <td>{{ $buena6 }}</td>
                        <td>{{ $regular6 }}</td>
                        <td>{{ $mala6 }}</td>
                        <td>0</td>
                        <td>{{ $total_enc_preg6 }}</td>
                        <td><div style="width: 500px; height: 200px;"  id="container6">

                            </div></td>
                    </tr>
                    <tr>
                        <td>7.-¿Conoces los requisitos para realizar tus trámites?</td>
                        <td>{{ $excelente7 }}</td>
                        <td>{{ $buena7 }}</td>
                        <td>{{ $regular7 }}</td>
                        <td>{{ $mala7 }}</td>
                        <td>0</td>
                        <td>{{ $total_enc_preg7 }}</td>
                        <td><div style="width: 500px; height: 200px;"  id="container7">

                            </div></td>
                    </tr>
                    <tr>
                        <td>8.- ¿Son claros los requisitos solicitados en las convocatorias para la inscripción, reinscripción y afiliación al IMSS?</td>
                        <td>{{ $excelente8 }}</td>
                        <td>{{ $buena8 }}</td>
                        <td>{{ $regular8 }}</td>
                        <td>{{ $mala8 }}</td>
                        <td>0</td>
                        <td>{{ $total_enc_preg8 }}</td>
                        <td><div style="width: 500px; height: 200px;"  id="container8">

                            </div></td>
                    </tr>
                    <tr>
                        <td>9.-¿Cómo consideras el trámite de inscripción, reinscripción y afiliación al IMSS en línea?</td>
                        <td>{{ $excelente9 }}</td>
                        <td>{{ $buena9 }}</td>
                        <td>{{ $regular9 }}</td>
                        <td>{{ $mala9 }}</td>
                        <td>0</td>
                        <td>{{ $total_enc_preg9 }}</td>
                        <td><div style="width: 500px; height: 200px;"  id="container9">

                            </div></td>
                    </tr>
                    <tr>
                        <td>11.-En términos generales el servicio recibido fue</td>
                        <td>{{ $excelente11 }}</td>
                        <td>{{ $buena11 }}</td>
                        <td>{{ $regular11 }}</td>
                        <td>{{ $mala11 }}</td>
                        <td>0</td>
                        <td>{{ $total_enc_preg11 }}</td>
                        <td><div style="width: 500px; height: 200px;"  id="container11">

                            </div></td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>{{ $total_excelente }}</td>
                        <td>{{ $total_buena }}</td>
                        <td>{{ $total_regular }}</td>
                        <td>{{ $total_mala }}</td>
                        <td>0</td>
                        <td>{{ $total_total }}</td>
                        <td><div style="width: 500px; height: 200px;"  id="container_t">

                            </div></td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>


        <?php
        if($excelente1 == 0){
            $por_excel1=0;
        }else{
            $por_excel1=($excelente1/$total_enc_preg1)*100;
        }
        if($buena1 == 0){
            $por_buena1=0;
        }else{
            $por_buena1=($buena1/$total_enc_preg1)*100;
        }
        if($regular1 == 0){
            $por_regular1=0;
        }else{
            $por_regular1=($regular1/$total_enc_preg1)*100;
        }
        if($mala1 == 0){
            $por_mala1=0;
        }else{
            $por_mala1=($mala1/$total_enc_preg1)*100;
        }
//////////////////////////////////////////////////
        if($excelente2 == 0){
            $por_excel2=0;
        }else{
            $por_excel2=($excelente2/$total_enc_preg2)*100;
        }
        if($buena2 == 0){
            $por_buena2=0;
        }else{
            $por_buena2=($buena2/$total_enc_preg2)*100;
        }
        if($regular2 == 0){
            $por_regular2=0;
        }else{
            $por_regular2=($regular2/$total_enc_preg2)*100;
        }
        if($mala2 == 0){
            $por_mala2=0;
        }else{
            $por_mala2=($mala2/$total_enc_preg2)*100;
        }
        //////////////////////////////////////////////////
        if($excelente3 == 0){
            $por_excel3=0;
        }else{
            $por_excel3=($excelente3/$total_enc_preg3)*100;
        }
        if($buena3 == 0){
            $por_buena3=0;
        }else{
            $por_buena3=($buena3/$total_enc_preg3)*100;
        }
        if($regular3 == 0){
            $por_regular3=0;
        }else{
            $por_regular3=($regular3/$total_enc_preg3)*100;
        }
        if($mala3 == 0){
            $por_mala3=0;
        }else{
            $por_mala3=($mala3/$total_enc_preg3)*100;
        }
        //////////////////////////////////////////////////
        if($excelente4 == 0){
            $por_excel4=0;
        }else{
            $por_excel4=($excelente4/$total_enc_preg4)*100;
        }
        if($buena4 == 0){
            $por_buena4=0;
        }else{
            $por_buena4=($buena4/$total_enc_preg4)*100;
        }
        if($regular4 == 0){
            $por_regular4=0;
        }else{
            $por_regular4=($regular4/$total_enc_preg4)*100;
        }
        if($mala4 == 0){
            $por_mala4=0;
        }else{
            $por_mala4=($mala4/$total_enc_preg4)*100;
        }
        //////////////////////////////////////////////////
        if($excelente5 == 0){
            $por_excel5=0;
        }else{
            $por_excel5=($excelente5/$total_enc_preg5)*100;
        }
        if($buena5 == 0){
            $por_buena5=0;
        }else{
            $por_buena5=($buena5/$total_enc_preg5)*100;
        }
        if($regular5 == 0){
            $por_regular5=0;
        }else{
            $por_regular5=($regular5/$total_enc_preg5)*100;
        }
        if($mala5 == 0){
            $por_mala5=0;
        }else{
            $por_mala5=($mala5/$total_enc_preg5)*100;
        }
        //////////////////////////////////////////////////
        if($excelente6 == 0){
            $por_excel6=0;
        }else{
            $por_excel6=($excelente6/$total_enc_preg6)*100;
        }
        if($buena6 == 0){
            $por_buena6=0;
        }else{
            $por_buena6=($buena6/$total_enc_preg6)*100;
        }
        if($regular6 == 0){
            $por_regular6=0;
        }else{
            $por_regular6=($regular6/$total_enc_preg6)*100;
        }
        if($mala6 == 0){
            $por_mala6=0;
        }else{
            $por_mala6=($mala6/$total_enc_preg6)*100;
        }
        //////////////////////////////////////////////////
        if($excelente7 == 0){
            $por_excel7=0;
        }else{
            $por_excel7=($excelente7/$total_enc_preg7)*100;
        }
        if($buena7 == 0){
            $por_buena7=0;
        }else{
            $por_buena7=($buena7/$total_enc_preg7)*100;
        }
        if($regular7 == 0){
            $por_regular7=0;
        }else{
            $por_regular7=($regular7/$total_enc_preg7)*100;
        }
        if($mala7 == 0){
            $por_mala7=0;
        }else{
            $por_mala7=($mala7/$total_enc_preg7)*100;
        }

        //////////////////////////////////////////////////
        if($excelente8 == 0){
            $por_excel8=0;
        }else{
            $por_excel8=($excelente8/$total_enc_preg8)*100;
        }
        if($buena8 == 0){
            $por_buena8=0;
        }else{
            $por_buena8=($buena8/$total_enc_preg8)*100;
        }
        if($regular8 == 0){
            $por_regular8=0;
        }else{
            $por_regular8=($regular8/$total_enc_preg8)*100;
        }
        if($mala8 == 0){
            $por_mala8=0;
        }else{
            $por_mala8=($mala8/$total_enc_preg8)*100;
        }
        //////////////////////////////////////////////////
        if($excelente9 == 0){
            $por_excel9=0;
        }else{
            $por_excel9=($excelente9/$total_enc_preg9)*100;
        }
        if($buena9 == 0){
            $por_buena9=0;
        }else{
            $por_buena9=($buena9/$total_enc_preg9)*100;
        }
        if($regular9 == 0){
            $por_regular9=0;
        }else{
            $por_regular9=($regular9/$total_enc_preg9)*100;
        }
        if($mala9 == 0){
            $por_mala9=0;
        }else{
            $por_mala9=($mala9/$total_enc_preg9)*100;
        }
        //////////////////////////////////////////////////
        if($excelente11 == 0){
            $por_excel11=0;
        }else{
            $por_excel11=($excelente11/$total_enc_preg11)*100;
        }
        if($buena11 == 0){
            $por_buena11=0;
        }else{
            $por_buena11=($buena11/$total_enc_preg11)*100;
        }
        if($regular11 == 0){
            $por_regular11=0;
        }else{
            $por_regular11=($regular11/$total_enc_preg11)*100;
        }
        if($mala11 == 0){
            $por_mala11=0;
        }else{
            $por_mala11=($mala11/$total_enc_preg11)*100;
        }

        //////////////////////////////////////////////////
        if($total_excelente == 0){
            $por_excel_total=0;
        }else{
            $por_excel_total=($total_excelente/$total_total)*100;
        }
        if($total_buena == 0){
            $por_buena_total=0;
        }else{
            $por_buena_total=($total_buena/$total_total)*100;
        }
        if($total_regular == 0){
            $por_regular_total=0;
        }else{
            $por_regular_total=($total_regular/$total_total)*100;
        }
        if($total_mala == 0){
            $por_mala_total=0;
        }else{
            $por_mala_total=($total_mala/$total_total)*100;
        }
        ?>
        <script>
            $(document).ready(function() {

// Build the chart
                // Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

// Create the chart
                Highcharts.chart('container1', {
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
                                y: {{ $por_excel1 }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_buena1 }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular1 }},
                            },
                            {
                                name: 'Mala',
                                y: {{ $por_mala1 }},
                            },
                            {
                                name: 'Muy mala',
                                y: 0,
                            },
                        ]
                    }]
                });
                Highcharts.chart('container2', {
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
                         //   borderWidth: 0,
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
                                y: {{ $por_excel2 }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_buena2 }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular2 }},
                            },
                            {
                                name: 'Mala',
                                y: {{ $por_mala2 }},
                            },
                            {
                                name: 'Muy mala',
                                y: 0,
                            },
                        ]
                    }]
                });
                Highcharts.chart('container3', {
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
                                y: {{ $por_excel3 }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_buena3 }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular3 }},
                            },
                            {
                                name: 'Mala',
                                y: {{ $por_mala3 }},
                            },
                            {
                                name: 'Muy mala',
                                y: 0,
                            },
                        ]
                    }]
                });
                Highcharts.chart('container4', {
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
                           // borderWidth: 0,
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
                                y: {{ $por_excel4 }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_buena4 }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular4 }},
                            },
                            {
                                name: 'Mala',
                                y: {{ $por_mala4 }},
                            },
                            {
                                name: 'Muy mala',
                                y: 0,
                            },
                        ]
                    }]
                });
                Highcharts.chart('container5', {
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
                                y: {{ $por_excel5 }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_buena5 }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular5 }},
                            },
                            {
                                name: 'Mala',
                                y: {{ $por_mala5 }},
                            },
                            {
                                name: 'Muy mala',
                                y: 0,
                            },
                        ]
                    }]
                });
                Highcharts.chart('container6', {
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
                           // borderWidth: 0,
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
                                y: {{ $por_excel6 }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_buena6 }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular6 }},
                            },
                            {
                                name: 'Mala',
                                y: {{ $por_mala6 }},
                            },
                            {
                                name: 'Muy mala',
                                y: 0,
                            },
                        ]
                    }]
                });
                Highcharts.chart('container7', {
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
                           // borderWidth: 0,
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
                                y: {{ $por_excel7 }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_buena7 }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular7 }},
                            },
                            {
                                name: 'Mala',
                                y: {{ $por_mala7 }},
                            },
                            {
                                name: 'Muy mala',
                                y: 0,
                            },
                        ]
                    }]
                });
                Highcharts.chart('container8', {
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
                           // borderWidth: 0,
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
                                y: {{ $por_excel8 }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_buena8 }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular8 }},
                            },
                            {
                                name: 'Mala',
                                y: {{ $por_mala8 }},
                            },
                            {
                                name: 'Muy mala',
                                y: 0,
                            },
                        ]
                    }]
                });
                Highcharts.chart('container9', {
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
                           // borderWidth: 0,
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
                                y: {{ $por_excel9 }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_buena9 }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular9 }},
                            },
                            {
                                name: 'Mala',
                                y: {{ $por_mala9 }},
                            },
                            {
                                name: 'Muy mala',
                                y: 0,
                            },
                        ]
                    }]
                });
                Highcharts.chart('container11', {
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
                          ///  borderWidth: 0,
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
                                y: {{ $por_excel11 }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_buena11 }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular11 }},
                            },
                            {
                                name: 'Mala',
                                y: {{ $por_mala11 }},
                            },
                            {
                                name: 'Muy mala',
                                y: 0,
                            },
                        ]
                    }]
                });
                Highcharts.chart('container_t', {
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
                           /// borderWidth: 0,
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
                                y: {{ $por_excel_total }},
                            },
                            {
                                name: 'Buena',
                                y: {{ $por_buena_total }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $por_regular_total }},
                            },
                            {
                                name: 'Mala',
                                y: {{ $por_mala_total }},
                            },
                            {
                                name: 'Muy mala',
                                y: 0,
                            },
                        ]
                    }]
                });
            });

        </script>


    </main>

@endsection