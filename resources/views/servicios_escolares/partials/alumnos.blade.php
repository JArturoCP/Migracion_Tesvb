@extends('layouts.panel')
@section('title', 'Estadisticas por Genero')
@include('partials.panel.recursos_app', ['graficas' => true])
@section('content')
<div class="tw-pantalla">
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

<x-panel.encabezado titulo="Datos estadísticos de los estudiantes del TESVB por género" :migas="['Servicios escolares' => null]" />

<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                <h4 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">
                    <a class="tw:text-brand-500 tw:hover:underline tw:no-underline" data-toggle="collapse" data-parent="#accordion" href="#ca_generales">
                        DATOS GENERALES
                    </a>
                </h4>
            </div>
            <div id="ca_generales" class="collapse">
                <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2 tw:pt-[5%]">
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada border-table tw-tabla tw:my-0">
                            <thead>
                                <tr class="tw:text-center">
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
</div>
                        <div class="tw:w-full tw:lg:w-full tw:text-center tw:px-2">
                            <a href="/generar_excel/alumnos" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
                                Exportar información <span class="oi oi-document tw:p-1"></span>
                            </a>
                        </div>
                    </div>
                    <div class="tw:w-full tw:lg:w-4/12 tw:px-2" id="container_al"></div>
                </div>
            </div>
        </div>

        @foreach($carreras as $carrera)
            @php
                $total_carrera = $carrera['tot_masculino'] + $carrera['tot_femenino'];
            @endphp
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    <h4 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">
                        <a class="tw:text-brand-500 tw:hover:underline tw:no-underline" data-toggle="collapse" data-parent="#accordion" href="#ca_{{ $carrera['id_carrera'] }}">
                            {{ $carrera['nom_carrera'] }}
                        </a>
                    </h4>
                </div>
                <div id="ca_{{ $carrera['id_carrera'] }}" class="collapse">
                    <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada border-table tw-tabla tw:my-0">
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
                        </div>
                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2" id="content_chart_{{ $carrera['id_carrera'] }}"></div>
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
</div>
@endsection