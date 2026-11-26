@extends('layouts.panel')
@section('title', 'Estadisticas por Edad')
@include('partials.panel.recursos_app', ['graficas' => true])
@section('content')
<div class="tw-pantalla">
<?php  $tot_datos=0; ?>
<x-panel.encabezado titulo="Datos estadísticos de los estudiantes del TESVB por edad" :migas="['Servicios escolares' => null]" />
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
<div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
        <h4 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">
            <a class="tw:text-brand-500 tw:hover:underline tw:no-underline" data-toggle="collapse" data-parent="#accordion" href="#edad_generales">DATOS GENERALES</a>
        </h4>
    </div>
    <div id="edad_generales" class="collapse">
        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                <a href="/generar_excel/edades" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Exportar información <span class="oi oi-document tw:p-1"></span></a>
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada border-table tw-tabla tw:my-0">
                    <thead>
                    <tr class="tw:text-center">
                        <th class="tw:text-center">EDAD</th>
                        <th class="tw:text-center">CANTIDAD</th>
                        <th class="tw:text-center">PORCENTAJE</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  $sum_otros_e=0; ?>
                    @foreach($edades as $edad)
                        <tr class="">
                            <td>{{ $edad['edad'] }}</td>
                            <td>{{ $edad['cantidad'] }}</td>
                            <td>{{ round( (($edad['cantidad']*100)/ $edad['tot_edad']),1 ) }}%</td>
                            <?php  $tot_datos+=$edad['cantidad']; ?>
                        </tr>
                        @if($edad['cantidad']<20)
                            <?php
                            $sum_otros_e+=$edad['cantidad'];
                            ?>
                        @else
                        @endif
                    @endforeach
                    <tr>
                        <td>TOTAL</td>
                        <td>{{$tot_datos}}</td>
                    </tr>
                    </tbody>
                </table>
</div>
            </div>
            <div class="tw:w-full tw:lg:w-6/12 tw:text-center tw:px-2" id="container_edad"></div>
        </div>
    </div>
</div>
@foreach($carreras as $carrera)
    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
            <h4 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">
                <a class="tw:text-brand-500 tw:hover:underline tw:no-underline" data-toggle="collapse" data-parent="#accordion" href="#edad_{{ $carrera['id_carrera'] }}">{{$carrera['nom_carrera']}}</a>
            </h4>
        </div>
        <div id="edad_{{ $carrera['id_carrera'] }}" class="collapse">
            <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada border-table tw-tabla tw:my-0">
                        <thead>
                        <tr class="tw:text-center">
                            <th class="tw:text-center">EDAD</th>
                            <th class="tw:text-center">CANTIDAD</th>
                            <th class="tw:text-center">PORCENTAJE</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $tot_mun=0 ?>
                        @foreach($carrera['edades'] as $edad)
                            <tr class="">
                                <td>{{ $edad['edad'] }}</td>
                                <td>{{ $edad['cantidad'] }}</td>
                                <td>{{ round((($edad['cantidad']*100)/$carrera['tot_edades']),1) }}%</td>
                                <?php $tot_mun+=$edad['cantidad'] ?>
                            </tr>
                        @endforeach
                        <tr>
                            <td>TOTAL</td>
                            <td>{{$tot_mun}}</td>
                        </tr>
                        </tbody>
                    </table>
</div>
                </div>
                <div class="tw:w-full tw:lg:w-6/12 tw:text-center tw:px-2" id="container_edad_{{ $carrera['id_carrera'] }}"></div>
            </div>
        </div>
    </div>
@endforeach
    </div>
</div>
<script language="JavaScript">
    $(document).ready(function() {

// Build the chart
        Highcharts.chart('container_edad', {
            chart: {
                width: 350,
                height: 350,
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Datos Generales'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Porcentaje',
                colorByPoint: true,
                data: [
                        @foreach($edades as $edad)
                        @if($edad['cantidad']>=20)
                    {
                        name: '{{ $edad['edad'] }}',
                        y: {{ $edad['cantidad'] }},
                    },
                        @else

                        @endif
                        @endforeach
                    {
                        name: 'OTROS',
                        y: {{ $sum_otros_e }},
                    },
                ]
            }]
        });
        @foreach($carreras as $carrera)
        Highcharts.chart('container_edad_{{ $carrera['id_carrera'] }}', {
            chart: {
                width: 350,
                height: 350,
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Datos Generales'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Porcentaje',
                colorByPoint: true,
                data: [
                        <?php  $sum_otros_edad=0; ?>
                        @foreach($carrera['edades'] as $edad)
                            @if($edad['cantidad']<20)
                            <?php
                            $sum_otros_edad+=$edad['cantidad'];
                            ?>
                            @else
                            @endif
                        @if($edad['cantidad']>=20)
                    {
                        name: '{{ $edad['edad'] }}',
                        y: {{ $edad['cantidad'] }},
                    },
                        @else

                        @endif
                        @endforeach
                    {
                        name: 'OTROS',
                        y: {{ $sum_otros_edad }},
                    },
                ]
            }]
        });
        @endforeach
    });
</script>
</div>
@endsection