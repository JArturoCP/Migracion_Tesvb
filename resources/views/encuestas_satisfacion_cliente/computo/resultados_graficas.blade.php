@extends('layouts.panel')
@section('title', 'Resultados de encuestas de Cómputo')
@include('partials.panel.recursos_app', ['graficas' => true])

@use('App\View\EncuestaMantenimiento')

@section('content')
    @php
        $historial = session('historial_enc_c') == 1;
        $base = '/encuestas_satisfaccion/';
        $migas = $historial ? ['Historial de encuestas' => url($base.'menu_historial_mantenimiento')] : [];
        $migas['Periodos de las encuestas'] = $historial
            ? url($base.'menu_historial_mantenimiento_year/'.$year)
            : url($base.'periodo_mantenimiento');
        $periodo = ($mes == 1 ? 'Enero' : 'Julio').' de '.$year;
        $total_valor_encuestas = $total_encuestas * 20;
        $porcentaje_final = $total_valor_encuestas ? $resultado_final / $total_valor_encuestas * 100 : 0;
        $total_resultado = $total_preg_1 + $total_preg_2 + $total_preg_3 + $total_preg_4;
    @endphp
    <x-panel.encabezado titulo="Resultados de encuestas de Cómputo" :migas="$migas" />

    <div class="tw:space-y-5">
        <x-panel.tarjeta titulo="Indicador de satisfacción" :subtitulo="$periodo">
            <dl class="tw:grid tw:gap-4 tw:text-sm tw:sm:grid-cols-2 tw:xl:grid-cols-4">
                @foreach (['Satisfacción del cliente' => $porcentaje_final.' %', 'Total de encuestas' => $total_encuestas, 'Valor por encuesta' => 20, 'Puntos esperados' => $total_valor_encuestas] as $etiqueta => $valor)
                    <div class="tw:rounded-lg tw:bg-gray-50 tw:p-3 tw:dark:bg-white/5">
                        <dt>{{ $etiqueta }}</dt><dd class="tw:font-semibold">{{ $valor }}</dd>
                    </div>
                @endforeach
            </dl>
        </x-panel.tarjeta>
        <x-panel.tarjeta titulo="Respuestas por pregunta">
            <x-panel.tabla compacta>
                <thead>
                    <tr><th scope="col">Calificación</th><th scope="col">Valor</th><th scope="col">P1</th><th scope="col">P2</th><th scope="col">P3</th><th scope="col">P4</th><th scope="col">Total</th></tr>
                </thead>
                <tbody>
                    @foreach ([1 => 'malo', 2 => 'regular', 3 => 'bueno', 4 => 'muy_bueno', 5 => 'excelente'] as $valor => $clave)
                        <tr>
                            <th scope="row">{{ EncuestaMantenimiento::OPCIONES[$valor] }}</th>
                            <td>{{ $valor }}</td>
                            @foreach (range(1, 4) as $numero)
                                <td>{{ ${'preg_'.$numero.'_'.$clave} }}</td>
                            @endforeach
                            <td>{{ ${'total_'.$clave} }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th scope="row" colspan="2">Puntos por pregunta</th>
                        @foreach ([$total_preg_1, $total_preg_2, $total_preg_3, $total_preg_4, $total_resultado] as $total)
                            <td>{{ $total }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </x-panel.tabla>
        </x-panel.tarjeta>
        <div class="tw:grid tw:min-w-0 tw:gap-5 tw:xl:grid-cols-2">
        <x-panel.tarjeta titulo="Resumen general" class="tw:xl:col-span-2">
            <div id="container" class="tw:min-w-0 tw:rounded-lg tw:bg-white"></div>
        </x-panel.tarjeta>
        @foreach (EncuestaMantenimiento::PREGUNTAS as $numero => $pregunta)
            <x-panel.tarjeta :titulo="$numero.'. '.$pregunta">
                <div id="pregunta{{ $numero }}" class="tw:min-w-0 tw:rounded-lg tw:bg-white"></div>
            </x-panel.tarjeta>
        @endforeach
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
@endsection

@push('scripts')
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
@endpush
