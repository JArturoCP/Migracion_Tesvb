@extends('layouts.panel')
@section('title', 'DatosEstadisticos')
@include('partials.panel.recursos_app', ['graficas' => true])
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="DATOS ESTADÍSTICOS" />

    <x-panel.tarjeta sin-relleno class="tw:p-6">
        <div id="grafica" class="tw:min-h-[400px]"></div>
    </x-panel.tarjeta>
</main>

<script>
$(document).ready(function(){
    var arreglo_carreras=[];
    var arreF=[];
    var arreM=[];
    var ciclos="{{$numero_carreras}}";

    var mujeres={!!$arregloF!!};
    var hombres={!!$arregloM!!};

    @foreach($carreras as $carreras)
        arreglo_carreras[arreglo_carreras.length]="{{$carreras->nombre}}";
    @endforeach

    $(function () {
        Highcharts.setOptions({
            colors: ['#0D4092','#97087D']
        });
        Highcharts.chart('grafica', {
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: arreglo_carreras
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total de Alumnos por Carrera'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            legend: {
                align: 'right',
                x: -30,
                verticalAlign: 'top',
                y: 25,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                    }
                }
            },
            series: [{
                name: 'Masculino',
                data:hombres
            }, {
                name: 'Femenino',
                data:mujeres
            }]
        });
    });
});
</script>
@endsection
