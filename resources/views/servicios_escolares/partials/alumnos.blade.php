@extends('layouts.app')
@section('title', 'Estadisticas por Genero')
@section('content')
<?php 
    $totg_masc = 0; 
    $totg_fem = 0; 
    $tot_gnral = 0;
?>
@foreach($carreras as $carrera)
    <?php  
        $totg_masc += $carrera['tot_masculino']; 
        $totg_fem += $carrera['tot_femenino']; 
        $tot_gnral += $carrera['tot_masculino'] + $carrera['tot_femenino'];
    ?>
@endforeach

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-primary">
            <div class="panel-heading text-center">
                DATOS ESTADISTICOS DE LOS ESTUDIANTES DEL TESVB POR GENERO
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-info" style="margin:5px 0;">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#ca_generales" style="text-decoration: none;">
                        DATOS GENERALES
                    </a>
                </h4>
            </div>
            <div id="ca_generales" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="col-md-6" style="padding-top: 5%;">
                        <table class="table table-hover text-center my-0 border-table">
                            <thead>
                                <tr class="text-center">
                                    <th></th>
                                    <th>MASCULINO</th>
                                    <th>FEMENINO</th>
                                    <th>TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>TOTAL</td>
                                    <td>{{ $totg_masc }}</td>
                                    <td>{{ $totg_fem }}</td>
                                    <td>{{ $tot_gnral }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-md-12 text-center">
                            <a href="/generar_excel/alumnos" class="btn btn-success">
                                Exportar información <span class="oi oi-document p-1"></span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4" id="container_al"></div>
                </div>
            </div>
        </div>

        @foreach($carreras as $carrera)
            @php
                $total_carrera = $carrera['tot_masculino'] + $carrera['tot_femenino'];
            @endphp
            <div class="panel panel-info" style="margin:5px 0;">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#ca_{{ $carrera['id_carrera'] }}" style="text-decoration: none;">
                            {{ $carrera['nom_carrera'] }}
                        </a>
                    </h4>
                </div>
                <div id="ca_{{ $carrera['id_carrera'] }}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="col-md-6">
                            <table class="table table-hover text-center my-0 border-table">
                                <thead>
                                    <tr>
                                        <th>SEMESTRE</th>
                                        <th>MASCULINO</th>
                                        <th>FEMENINO</th>
                                        <th>TOTAL</th>
                                        <th>PORCENTAJE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($carrera['semestres'] as $semestre)
                                        @php
                                            $dato = $semestre['datos'][0];
                                            $porcentaje = $total_carrera > 0 ? round(($dato['total'] * 100) / $total_carrera, 1) : 0;
                                        @endphp
                                        <tr>
                                            <td>{{ $semestre['nom_semestre'] }}</td>
                                            <td>{{ $dato['masculino'] }}</td>
                                            <td>{{ $dato['femenino'] }}</td>
                                            <td>{{ $dato['total'] }}</td>
                                            <td>{{ $porcentaje }} %</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>TOTAL</td>
                                        <td>{{ $carrera['tot_masculino'] }}</td>
                                        <td>{{ $carrera['tot_femenino'] }}</td>
                                        <td>{{ $total_carrera }}</td>
                                        <td>100%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6" id="content_chart_{{ $carrera['id_carrera'] }}"></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
$(document).ready(function() {
    // Gráfico general
    var total_general = {{ $totg_masc + $totg_fem }};
    Highcharts.chart('container_al', {
        chart: { width: 300, height: 200, type: 'pie' },
        title: { text: 'Datos Generales' },
        tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' },
        plotOptions: {
            pie: { allowPointSelect: true, cursor: 'pointer', dataLabels: { enabled: false }, showInLegend: true }
        },
        series: [{
            name: 'Porcentaje',
            colorByPoint: true,
            data: [
                { name: 'Masculino', y: {{ $totg_masc }} },
                { name: 'Femenino', y: {{ $totg_fem }} }
            ]
        }]
    });

    // Gráficos por carrera
    @foreach($carreras as $carrera)
        Highcharts.chart('content_chart_{{ $carrera['id_carrera'] }}', {
            chart: { width: 400, height: 500, type: 'pie' },
            title: { text: 'Distribución por semestre' },
            tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' },
            plotOptions: {
                pie: { allowPointSelect: true, cursor: 'pointer', dataLabels: { enabled: false }, showInLegend: true }
            },
            series: [{
                name: 'Porcentaje',
                colorByPoint: true,
                data: [
                    @foreach($carrera['semestres'] as $semestre)
                        @php $dato = $semestre['datos'][0]; @endphp
                        { name: '{{ $semestre['nom_semestre'] }}', y: {{ $dato['total'] }} },
                    @endforeach
                ]
            }]
        });
    @endforeach
});
</script>
@endsection