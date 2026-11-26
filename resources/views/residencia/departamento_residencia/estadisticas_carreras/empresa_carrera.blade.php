@extends('layouts.panel')
@section('title', 'Residencia')
@include('partials.panel.recursos_app', ['graficas' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Estadisticas por carrera" :migas="['Residencia profesional' => null]" />

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800">
                <li>
                    <a href="{{url('/residencia/carreras_estadisticas')}}">Por giro</a>
                </li>
                <li>
                    <a href="{{url('/residencia/carrera_sector_estadisticas/')}}">Por sector</a>
                </li>
                <li class="active"><a href="#">Por empresa </a></li>

            </ul>
        </div>
    </div>
    @if($mostrar == 0)
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                <div class="tw:mb-4">
                    <label for="exampleInputEmail1">Elige carrrera<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="carrera" name="carrera" required>
                        <option disabled selected hidden>Selecciona una opción</option>
                        @foreach($carreras as $carrera)
                            <option value="{{$carrera->id_carrera}}" data-esta="{{$carrera->nombre}}">{{$carrera->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    @elseif($mostrar == 1)
        @if($no_hay_alumnos == 0)
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                    <div class="tw:mb-4">
                        <label for="exampleInputEmail1">Elige carrrera<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="carrera" name="carrera" required>
                            <option disabled selected hidden>Selecciona una opción</option>
                            @foreach($carreras as $carrera)
                                @if($carrera->id_carrera==$id_carrera)
                                    <option value="{{$carrera->id_carrera}}" selected="selected">{{$carrera->nombre}}</option>
                                @else
                                    <option value="{{$carrera->id_carrera}}" >{{$carrera->nombre}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <x-panel.alerta tipo="error" class="tw:mb-4">No tiene residentes en este periodo</x-panel.alerta>
        @elseif($no_hay_alumnos ==1)
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                    <div class="tw:mb-4">
                        <label for="exampleInputEmail1">Elige carrrera<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="carrera" name="carrera" required>
                            <option disabled selected hidden>Selecciona una opción</option>
                            @foreach($carreras as $carrera)
                                @if($carrera->id_carrera==$id_carrera)
                                    <option value="{{$carrera->id_carrera}}" selected="selected">{{$carrera->nombre}}</option>
                                @else
                                    <option value="{{$carrera->id_carrera}}" >{{$carrera->nombre}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
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
                                    <th>Nombre de la empresa</th>
                                    <th>Total </th>
                                    <th>Porcentaje</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($array_empresa as $empresa)

                                    <tr>
                                        <td>{{ $empresa['nombre'] }}</td>
                                        <td>{{ $empresa['total'] }}</td>
                                        <td>{{ $empresa['porcentaje'] }} %</td>


                                    </tr>


                                @endforeach
                                <tr>
                                    <td>Total</td>
                                    <td>{{$si}}</td>
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
                            text: 'Porcentaje de las empresas'
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
                                name: "Empresa",
                                colorByPoint: true,
                                data: [

                                        @foreach($array_empresa as $empresa)
                                    {
                                        name: '{{ $empresa['nombre'] }}',
                                        y: {{ $empresa['porcentaje'] }},



                                    },
                                    @endforeach


                                ]
                            }
                        ],


                    });
                });
            </script>
        @endif
    @endif
    <script type="text/javascript">
        $(document).ready(function() {
            $("#carrera").on('change',function(e){
                var carrera= $("#carrera").val();
                window.location.href='/residencia/carrera_empresa_mostrar/'+carrera ;


            });
        });
    </script>
</div>
@endsection