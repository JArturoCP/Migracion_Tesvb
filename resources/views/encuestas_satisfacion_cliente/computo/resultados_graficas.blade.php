@extends('layouts.app')
@section('title', 'Analisis de Encuestas de Satisfacción del Cliente')
@section('content')
    <?php
    $historial = Session::get('historial_enc_c');
    ?>
    <main class="col-md-12">
        @if($historial == 1)
        <div class="row">
            <div class="col-md-10 col-xs-10 col-md-offset-1">
                <p>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="{{url("/encuestas_satisfaccion/menu_historial_mantenimiento")}}">Historial de encuestas de satisfacción del cliente </a>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="{{url("/encuestas_satisfaccion/menu_historial_mantenimiento_year/".$year)}}">Periodos de las encuestas</a>
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
                        <a href="{{url("/encuestas_satisfaccion/periodo_mantenimiento")}}">Periodos de las encuestas</a>
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
                        <h3 class="panel-title text-center">Ver resultados de Encuestas de Satisfacción del Cliente interno<br>(Centro de computo) <br>@if($mes == 1) Enero @else Julio @endif del {{ $year }}</h3>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <table id="tabla_envio" class="table table-bordered table-resposive">
                    <thead>
                    <tr>
                        <th></th>
                        <th>VALOR P/PREGUNTA</th>
                        <th>P1</th>
                        <th>P2</th>
                        <th>P3</th>
                        <th>P4</th>
                        <th>TOTAL</th>

                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td ><b>MALO</b></td>
                        <td ><b>1</b></td>
                        <td>{{ $preg_1_malo }}</td>
                        <td>{{ $preg_2_malo }}</td>
                        <td>{{ $preg_3_malo }}</td>
                        <td>{{ $preg_4_malo }}</td>
                        <td>{{ $total_malo }}</td>

                    </tr>
                    <tr>
                        <td ><b>REGULAR</b></td>
                        <td ><b>2</b></td>
                        <td>{{ $preg_1_regular }}</td>
                        <td>{{ $preg_2_regular }}</td>
                        <td>{{ $preg_3_regular }}</td>
                        <td>{{ $preg_4_regular }}</td>
                        <td>{{ $total_regular }}</td>

                    </tr>
                    <tr>
                        <td ><b>BUENO</b></td>
                        <td ><b>3</b></td>
                        <td>{{ $preg_1_bueno }}</td>
                        <td>{{ $preg_2_bueno }}</td>
                        <td>{{ $preg_3_bueno }}</td>
                        <td>{{ $preg_4_bueno }}</td>
                        <td>{{ $total_bueno }}</td>

                    </tr>
                    <tr>
                        <td ><b>MUY BUENO</b></td>
                        <td ><b>4</b></td>
                        <td>{{ $preg_1_muy_bueno }}</td>
                        <td>{{ $preg_2_muy_bueno }}</td>
                        <td>{{ $preg_3_muy_bueno }}</td>
                        <td>{{ $preg_4_muy_bueno }}</td>
                        <td>{{ $total_muy_bueno }}</td>

                    </tr>
                    <tr>
                        <td ><b>EXCELENTE</b></td>
                        <td ><b>5</b></td>
                        <td>{{ $preg_1_excelente }}</td>
                        <td>{{ $preg_2_excelente }}</td>
                        <td>{{ $preg_3_excelente }}</td>
                        <td>{{ $preg_4_excelente }}</td>
                        <td>{{ $total_excelente }}</td>

                    </tr>
                    <tr>
                        <td colspan="2" ><b>TOTAL P/ PREGUNTA</b></td>
                        <td>{{ $total_preg_1 }}</td>
                        <td>{{ $total_preg_2 }}</td>
                        <td>{{ $total_preg_3 }}</td>
                        <td>{{ $total_preg_4 }}</td>
                        <?php  $total_resultado=$total_preg_1+$total_preg_2+$total_preg_3+$total_preg_4 ?>
                        <td>{{ $total_resultado }}</td>

                    </tr>


                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-md-offset-5">
                <table id="tabla_envio" class="table table-bordered table-resposive">
                    <tbody>
                    <tr>
                        <td ><b>TOTAL DE ENCUESTAS</b></td>
                        <td>{{ $total_encuestas }}</td>

                    </tr>
                    <tr>
                        <td ><b>VALOR POR ENCUESTA</b></td>
                        <td>20</td>
                    </tr>
                    <tr>
                        <?php $total_valor_encuestas=$total_encuestas*20; ?>
                        <td ><b>ESPERADO</b></td>
                        <td>{{ $total_valor_encuestas }}</td>
                    </tr>


                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-md-offset-5">
                <table id="tabla_envio" class="table table-bordered table-resposive">
                    <tbody>
                    <tr>
                        <td ><b>INDICADOR DE SATISFACCIÓN DEL CLIENTE</b></td>
                        <?php
                        if($resultado_final == 0){
                            $porcentaje_final= 0;
                        }else{
                            $porcentaje_final= ($resultado_final/$total_valor_encuestas)*100 ;
                        }

                        ?>
                        <td>{{ $porcentaje_final }} %</td>

                    </tr>


                    </tbody>
                </table>
            </div>
        </div>
        <?php
        $total_puntos_preg= $total_encuestas*5;

        if($preg_1_malo == 0){
            $porcentaje_p1_malo=0;
        }else{
            $porcentaje_p1_malo=(($preg_1_malo*1)/$total_preg_1)*100;
        }
        if($preg_1_regular == 0){
            $porcentaje_p1_regular=0;
        }else{
            $porcentaje_p1_regular=(($preg_1_regular*2)/$total_preg_1)*100;
        }

        if($preg_1_bueno == 0){
            $porcentaje_p1_bueno=0;
        }else{
            $porcentaje_p1_bueno=(($preg_1_bueno*3)/$total_preg_1)*100;
        }
        if($preg_1_muy_bueno == 0){
            $porcentaje_p1_m_bueno=0;
        }else{
            $porcentaje_p1_m_bueno=(($preg_1_muy_bueno*4)/$total_preg_1)*100;
        }
        if($preg_1_excelente == 0){
            $porcentaje_p1_m_excelente=0;
        }else{
            $porcentaje_p1_m_excelente=(($preg_1_excelente*5)/$total_preg_1)*100;
        }

        if($preg_2_malo == 0){
            $porcentaje_p2_malo=0;
        }else{
            $porcentaje_p2_malo=(($preg_2_malo*1)/$total_preg_2)*100;
        }
        if($preg_2_regular == 0){
            $porcentaje_p2_regular=0;
        }else{
            $porcentaje_p2_regular=(($preg_2_regular*2)/$total_preg_2)*100;
        }

        if($preg_2_bueno == 0){
            $porcentaje_p2_bueno=0;
        }else{
            $porcentaje_p2_bueno=(($preg_2_bueno*3)/$total_preg_2)*100;
        }
        if($preg_2_muy_bueno == 0){
            $porcentaje_p2_m_bueno=0;
        }else{
            $porcentaje_p2_m_bueno=(($preg_2_muy_bueno*4)/$total_preg_2)*100;
        }
        if($preg_2_excelente == 0){
            $porcentaje_p2_m_excelente=0;
        }else{
            $porcentaje_p2_m_excelente=(($preg_2_excelente*5)/$total_preg_2)*100;
        }

        if($preg_3_malo == 0){
            $porcentaje_p3_malo=0;
        }else{
            $porcentaje_p3_malo=(($preg_3_malo*1)/$total_preg_3)*100;
        }
        if($preg_3_regular == 0){
            $porcentaje_p3_regular=0;
        }else{
            $porcentaje_p3_regular=(($preg_3_regular*2)/$total_preg_3)*100;
        }
        if($preg_3_bueno == 0){
            $porcentaje_p3_bueno=0;
        }else{
            $porcentaje_p3_bueno=(($preg_3_bueno*3)/$total_preg_3)*100;
        }
        if($preg_3_muy_bueno == 0){
            $porcentaje_p3_m_bueno=0;
        }else{
            $porcentaje_p3_m_bueno=(($preg_3_muy_bueno*4)/$total_preg_3)*100;
        }
        if($preg_3_excelente == 0){
            $porcentaje_p3_m_excelente=0;
        }else{
            $porcentaje_p3_m_excelente=(($preg_3_excelente*5)/$total_preg_3)*100;
        }

        if($preg_4_malo == 0){
            $porcentaje_p4_malo=0;
        }else{
            $porcentaje_p4_malo=(($preg_4_malo*1)/$total_preg_4)*100;
        }
        if($preg_4_regular == 0){
            $porcentaje_p4_regular=0;
        }else{
            $porcentaje_p4_regular=(($preg_4_regular*2)/$total_preg_4)*100;
        }
        if($preg_4_bueno == 0){
            $porcentaje_p4_bueno=0;
        }else{
            $porcentaje_p4_bueno=(($preg_4_bueno*3)/$total_preg_4)*100;
        }
        if($preg_4_muy_bueno == 0){
            $porcentaje_p4_m_bueno=0;
        }else{
            $porcentaje_p4_m_bueno=(($preg_4_muy_bueno*4)/$total_preg_4)*100;
        }
        if($preg_4_excelente == 0){
            $porcentaje_p4_m_excelente=0;
        }else{
            $porcentaje_p4_m_excelente=(($preg_4_excelente*5)/$total_preg_4)*100;
        }

        if($total_malo == 0){
            $porcentaje_malo=0;
        }else{
            $porcentaje_malo=($total_malo/$resultado_final)*100;

        }
        if($total_regular == 0){
            $porcentaje_regular=0;
        }else{
            $porcentaje_regular=($total_regular/$resultado_final)*100;

        }
        if($total_bueno == 0){
            $porcentaje_bueno=0;
        }else{
            $porcentaje_bueno=($total_bueno/$resultado_final)*100;

        }
        if($total_muy_bueno == 0){
            $porcentaje_m_bueno=0;
        }else{
            $porcentaje_m_bueno=($total_muy_bueno/$resultado_final)*100;

        }
        if($total_excelente == 0){
            $porcentaje_excelente=0;
        }else{
            $porcentaje_excelente=($total_excelente/$resultado_final)*100;

        }
        ?>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h4 style="text-align: center">GRAFICA GENERAL DE RESULTADOS DE SOLICITUDES DE SERVICIOS DE MENTENIMIENTO</h4>
                <div  id="container"></div>


            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3 ">
                <p style="text-align: center">El tiempo de respuesta a su Solicitud fue el adecuado.</p>
                <div  id="pregunta1"></div>


            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <p style="text-align: center">La atención proporcionada por el personal de Mantenimiento fue la adecuada</p>
                <div  id="pregunta2"></div>


            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3 ">
                <p style="text-align: center">El personal   técnico resolvió sus necesidades y dio respuesta a sus requerimientos</p>
                <div  id="pregunta3"></div>


            </div>

        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <p style="text-align: center">El Equipo al que se le dio mantenimiento se le entrego limpio.</p>
                <div  id="pregunta4"></div>


            </div>
        </div>



        <script>
            $(document).ready(function() {

// Build the chart
                // Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

// Create the chart
                Highcharts.chart('container', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: true,
                        type: 'pie'
                    },
                    title: {
                        text: 'GRAFICA DE SATISFACCION DEL CLIENTE',
                        align: 'left'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.2f} %',
                            },
                            showInLegend: true
                        }
                    },
                    series: [{
                        name: 'Porcentaje',
                        colorByPoint: true,
                        data: [
                            {
                                name: 'Malo',
                                y: {{ $porcentaje_malo }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $porcentaje_regular }},
                            },
                            {
                                name: 'Bueno',
                                y: {{ $porcentaje_bueno }},
                            },
                            {
                                name: 'Muy bueno',
                                y: {{ $porcentaje_m_bueno }},
                            },
                            {
                                name: 'Excelente',
                                y: {{ $porcentaje_excelente }},
                            },
                        ]
                    }]
                });


                Highcharts.chart('pregunta1', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: true,
                        type: 'pie'
                    },
                    title: {
                        text: 'Pregunta 1',
                        align: 'left'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.2f} %',
                            },
                            showInLegend: true
                        }
                    },

                    series: [{
                        name: 'Porcentaje',
                        colorByPoint: true,
                        data: [

                            {
                                name: 'Malo',
                                y: {{ $porcentaje_p1_malo }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $porcentaje_p1_regular }},
                            },
                            {
                                name: 'Bueno',
                                y: {{ $porcentaje_p1_bueno }},
                            },
                            {
                                name: 'Muy bueno',
                                y: {{ $porcentaje_p1_m_bueno }},
                            },
                            {
                                name: 'Excelente',
                                y: {{ $porcentaje_p1_m_excelente }},
                            },

                        ]
                    }]
                });
                Highcharts.chart('pregunta2', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: true,
                        type: 'pie'
                    },
                    title: {
                        text: 'Pregunta 2',
                        align: 'left'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.2f} %',
                            },
                            showInLegend: true
                        }
                    },

                    series: [{
                        name: 'Porcentaje',
                        colorByPoint: true,
                        data: [

                            {
                                name: 'Malo',
                                y: {{ $porcentaje_p2_malo }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $porcentaje_p2_regular }},
                            },
                            {
                                name: 'Bueno',
                                y: {{ $porcentaje_p2_bueno }},
                            },
                            {
                                name: 'Muy bueno',
                                y: {{ $porcentaje_p2_m_bueno }},
                            },
                            {
                                name: 'Excelente',
                                y: {{ $porcentaje_p2_m_excelente }},
                            },

                        ]
                    }]
                });
                Highcharts.chart('pregunta3', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: true,
                        type: 'pie'
                    },
                    title: {
                        text: 'Pregunta 3',
                        align: 'left'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.2f} %',
                            },
                            showInLegend: true
                        }
                    },

                    series: [{
                        name: 'Porcentaje',
                        colorByPoint: true,
                        data: [

                            {
                                name: 'Malo',
                                y: {{ $porcentaje_p3_malo }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $porcentaje_p3_regular }},
                            },
                            {
                                name: 'Bueno',
                                y: {{ $porcentaje_p3_bueno }},
                            },
                            {
                                name: 'Muy bueno',
                                y: {{ $porcentaje_p3_m_bueno }},
                            },
                            {
                                name: 'Excelente',
                                y: {{ $porcentaje_p3_m_excelente }},
                            },

                        ]
                    }]
                });
                Highcharts.chart('pregunta4', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: true,
                        type: 'pie'
                    },
                    title: {
                        text: 'Pregunta 4',
                        align: 'left'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.2f} %',
                            },
                            showInLegend: true
                        }
                    },
                    series: [{
                        name: 'Porcentaje',
                        colorByPoint: true,
                        data: [

                            {
                                name: 'Malo',
                                y: {{ $porcentaje_p4_malo }},
                            },
                            {
                                name: 'Regular',
                                y: {{ $porcentaje_p4_regular }},
                            },
                            {
                                name: 'Bueno',
                                y: {{ $porcentaje_p4_bueno }},
                            },
                            {
                                name: 'Muy bueno',
                                y: {{ $porcentaje_p4_m_bueno }},
                            },
                            {
                                name: 'Excelente',
                                y: {{ $porcentaje_p4_m_excelente }},
                            },

                        ]
                    }]
                });

            });

        </script>


    </main>

@endsection