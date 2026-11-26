@extends('layouts.panel')
@section('title', 'Residencia')
@include('partials.panel.recursos_app', ['graficas' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Estadisticas institucionales" :migas="['Residencia profesional' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800">
                <li>
                    <a href="{{url('/residencia/institucional_estadisticas')}}">Carreras</a>
                </li>
                <li class="active"><a href="#">Por giro</a></li>
                <li>
                    <a href="{{url('/residencia/sector_estadisticas')}}">Por sector</a>
                </li>
                <li>
                    <a href="{{url('/residencia/empresa_institucional/')}}">Por empresa</a>
                </li>

            </ul>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:p-5 tw:sm:p-6">

                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_enviado" class="tw-tabla tw-tabla-bordes">
                        <thead>
                        <tr>
                            <th>Tipo de giro</th>
                            <th>Total </th>
                            <th>Porcentaje</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($array_giro as $giro)

                            <tr>
                                <td>{{ $giro['giro'] }}</td>
                                <td>{{ $giro['total'] }}</td>
                                <td>{{ $giro['porcentaje'] }}%</td>


                            </tr>


                        @endforeach
                        <tr>
                            <td>Total</td>
                            <td>{{$total_giro}}</td>
                            <td>100 %</td>

                        </tr>
                        </tbody>
                    </table>
</div>
                </div>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2" id="container">

        </div>
    </div>

    <script language="JavaScript">
        $(document).ready(function() {


            Highcharts.chart('container', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Porcentaje de tipo de giro de la empresa'
                },


                accessibility: {
                    announceNewData: {
                        enabled: true
                    },
                    point: {
                        valueSuffix: '%'
                    }
                },

                plotOptions: {
                    series: {
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}: {point.y:.2f}%'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b><br/>'
                },

                series: [
                    {
                        name: "Tipo de giro",
                        colorByPoint: true,
                        data: [

                                @foreach($array_giro as $giro)
                            {
                                name: '{{ $giro['giro'] }}',
                                y: {{ $giro['porcentaje'] }},
                              @if($giro['id_giro'] ==1)
                              color: "#43a1d2",
                                @elseif($giro['id_giro'] ==2)
                                color: "#50d24c",
                                @elseif($giro['id_giro'] ==3)
                                color: "#d2c747",
                                @endif


                            },
                            @endforeach


                        ]
                    }
                ],


            });
        });
    </script>
</div>
@endsection