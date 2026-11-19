@extends('layouts.panel')
@section('title', 'Inicio')
@include('evaluacion_docente.partials.recursos_panel', ['graficas' => true])
@section('content')
    <?php
    $direccion=Session::get('ip');
    $id_unidad_admin = session()->has('id_unidad_admin') ? session()->has('id_unidad_admin') : false;
    ?>
    <script>





        $(document).ready(function() {

            Highcharts.chart('mostrar_graficas', {
                chart: {
                    type: 'column',
                    width: 1000,
                    x:150,
                },
                title: {
                    text: 'Resultado Grafico:'
                },

                xAxis: {
                    type: 'category',
                    title: {
                        text: 'Aspectos evaluados'
                    }
                },
                yAxis: {
                    title: {
                        text: 'Porcentaje'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.2f}%'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:6px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b><br/>'
                },

                series: [{
                    name: 'CRITERIO',
                    colorByPoint: true,
                    data:
                        [
                                @foreach($preguntas2 as $datos_pregunta)
                            {
                                @if($datos_pregunta["id_criterio"]==0)

                                        @elseif($datos_pregunta["id_criterio"]==1)
                                name: 'A',
                                @elseif($datos_pregunta["id_criterio"]==2)
                                name: 'B',
                                @elseif($datos_pregunta["id_criterio"]==3)
                                name: 'C',
                                @elseif($datos_pregunta["id_criterio"]==4)
                                name: 'D',
                                @elseif($datos_pregunta["id_criterio"]==5)
                                name: 'E',
                                @elseif($datos_pregunta["id_criterio"]==6)
                                name: 'F',
                                @elseif($datos_pregunta["id_criterio"]==7)
                                name: 'G',
                                @elseif($datos_pregunta["id_criterio"]==8)
                                name: 'H',
                                @elseif($datos_pregunta["id_criterio"]==9)
                                name: 'I',
                                @elseif($datos_pregunta["id_criterio"]==10)
                                name: 'J',
                                @endif
                                y: {{$datos_pregunta["calificacion"]}},
                                @if($datos_pregunta["calificacion"]>=0 && $datos_pregunta["calificacion"]<=3.24)
                                color: "#FF69B4",
                                @elseif($datos_pregunta["calificacion"]>=3.25 && $datos_pregunta["calificacion"]<=3.74)
                                color: "#FF69B4",
                                @elseif($datos_pregunta["calificacion"]>=3.75 && $datos_pregunta["calificacion"]<=4.24)
                                color: "#FF69B4",
                                @elseif($datos_pregunta["calificacion"]>=4.25 && $datos_pregunta["calificacion"]<=4.74)
                                color: "#FF4500",
                                @elseif($datos_pregunta["calificacion"]>=4.75 && $datos_pregunta["calificacion"]<=5)
                                color: "#4169E1",
                                @endif




                            },
                                @endforeach
                            {
                                name: 'PROMEDIO GENERAL',
                                y: {{$promedio_t}},
                                color: "#2ab27b",

                            },

                        ]
                }]


            });
            $('#imprime').click(function () {
//TNotify.alert("hola");

                var opcion={
                    chart: {
                        type: 'column'
                    },

                    exporting: {
                        url: 'http://192.168.43.226:8004'
                    },


                    plotOptions:{
                        column:{
                            stacking:'normal'
                        }
                    },
                    xAxis: {
                        categories:arreglorrubross
                    },

                    yAxis:{
                        stackLabels: {
                            enabled: true,


                            format:"x",
                        },
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


                    series:seriesData_global

                };
                console.log(opcion)



            });

            $('#cerrar').click(function(){
                window.close();
            });

            $('#exportar').click(function(){

                var chart = $('#mostrar_graficas').highcharts();

                $.ajax({
                    type: 'POST',
                    url: 'http://127.0.0.1:8004/',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        type: 'png',
                        svg: chart.getSVG()
                    }),
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function (blob) {

                        var reader = new FileReader();

                        reader.onloadend = function () {

                            // esto es base64 completo
                            var base64data = reader.result;

                            $("#dir_imagen").val(base64data);

                            $("#formgeneral").submit();
                        };

                        reader.readAsDataURL(blob);
                    }
                });

            });

        });
    </script>
    <x-panel.encabezado titulo="REPORTE EVALUACIÓN DOCENTE" :migas="['Profesores' => url('/buscar_profesores')]">
        @if($id_unidad_admin == true)
            <x-slot:extra>
                <x-panel.boton variante="secundario" tamano="sm" id="cerrar" title="Cerrar"><span class="fa fa-arrow-left"  aria-hidden="true"></span> </x-panel.boton>
            </x-slot:extra>
        @endif
    </x-panel.encabezado>

    <div class="tw-pantalla tw:space-y-6">
        <div id="imgContainer" class="tw:grid tw:grid-cols-1 tw:gap-6 tw:xl:grid-cols-3">
            @if($id_unidad_admin == true)
                <div id="derecho" class="tw:space-y-4">
                    <div class="tw:flex tw:flex-wrap tw:gap-3">
                        <x-panel.boton tamano="sm" class="crear" href="/reportes2/{{$id_profesor}}/{{1}}/{{0}}"><span class="fa fa-list-alt"  aria-hidden="true"></span> Grafica General</x-panel.boton>
                        <a id="exportar" class="crear tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:gap-1.5 tw:rounded-lg tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-white/3 tw:dark:text-gray-300" target="_blank"><span class="fa fa-print"  aria-hidden="true"></span> Imprimir</a>
                    </div>

                    <div class="tw:space-y-3" id="accordion">
                        @foreach($carreras as $carrera)
                            <div class="tw:overflow-hidden tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:dark:bg-white/3 tw:dark:border-gray-800">
                                <div class="tw:px-5 tw:py-4">
                                    @if($id_unidad_admin == true)
                                        <h4 class="tw:flex tw:items-center tw:justify-between tw:gap-3 tw:text-sm">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#{{ $carrera ["id_carrera"] }}" class="tw:inline-flex tw:items-center tw:gap-2 tw:text-gray-800 tw:hover:text-brand-500 tw:dark:text-white/90"><span class="fa fa-chevron-down tw:text-xs tw:text-gray-400 tw:dark:text-gray-500" aria-hidden="true">
                            </span>{{$carrera["nombre_carrera"]}}</a> <a href="/reportes2/{{$id_profesor}}/{{2}}/{{$carrera["id_carrera"]}}" class="tw:text-brand-500" title="Gráfica de la carrera"><span class="fa fa-list-alt 5em" aria-hidden="true" ></span></a>
                                        </h4>
                                    @endif
                                </div>

                                <div id="{{ $carrera ["id_carrera"] }}" class="panel-collapse collapse ">
                                    @if($id_unidad_admin == true)
                                        <div class="tw:border-t tw:border-gray-100 tw:dark:border-gray-800">
                                            <x-panel.tabla id="example" compacta>
                                                <thead>
                                                <tr>
                                                    <th>MATERIAS</th>
                                                    <th>GRUPO</th>
                                                    @if($id_unidad_admin == true)
                                                        <th class="tw:text-center">CONSULTAR</th>
                                                    @endif
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($carrera["materias"] as $materia)
                                                    <tr>
                                                        <td>{{$materia["nombre_materia"]}}</td>
                                                        <td>{{$materia["nombre_grupo"]}}</td>
                                                        @if($id_unidad_admin == true)
                                                            <td class="tw:text-center"><a href="/reportes2/{{$materia["id_hrs"]}},{{$materia["nombre_materia"]}},{{$materia["nombre_grupo"]}},{{$materia["idcarrera"]}},{{$id_profesor}}/{{3}}/{{0}}" class="tw:text-brand-500" title="Consultar"><span class="fa fa-list-alt 5em" style="font-size:22px;" aria-hidden="true" ></span></a></td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </x-panel.tabla>

                                        </div>
                                    @endif
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div @class(['tw:space-y-6', 'tw:xl:col-span-2' => $id_unidad_admin == true, 'tw:xl:col-span-3' => $id_unidad_admin != true])>
                <x-panel.tarjeta sin-relleno>
                    <x-panel.tabla id="aceptados">
                        <thead>
                        <tr>
                            <th>DOCENTE:</th>
                            <th class="tw:text-center">PROMEDIO GENERAL</th>
                            <th class="tw:text-center">DESCRIPCIÓN</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td scope="col" class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90"> {{$profesor}}</td>
                            <td style="text-align:center;" scope="col">{{$promedio_t}}</td>
                            @if($promedio_t>=0 &&$promedio_t<=3.24)
                                <td style="text-align:center;">DESEMPEÑO INSUFICIENTE</td>
                            @elseif($promedio_t>=3.25 && $promedio_t<=3.74)
                                <td style="text-align:center;">SUFICIENTE</td>
                            @elseif($promedio_t>=3.75 && $promedio_t<=4.24)
                                <td style="text-align:center;">BUENO</td>
                            @elseif($promedio_t>=4.25 && $promedio_t<=4.74)
                                <td style="text-align:center;">NOTABLE</td>
                            @elseif($promedio_t>=4.75 && $promedio_t<=5)
                                <td style="text-align:center;">EXCELENTE</td>
                            @endif
                        </tr>
                        </tbody>
                    </x-panel.tabla>
                </x-panel.tarjeta>

                @if($id_unidad_admin == true)
                    <x-panel.tarjeta sin-relleno>
                        <x-panel.tabla>
                            <thead>
                            <tr>
                                <th>MATERIA</th>
                                <th class="tw:text-center">
                                    ALUMNOS INSCRITOS</th>
                                <th class="tw:text-center">ALUMNOS EVALUARON</th>
                                <th class="tw:text-center">PROMEDIO</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($mat_evaluacion as $por)
                                <tr>
                                    <td >{{$por['materia']}}</td>
                                    <td style="text-align:center;">{{$por['total']}}</td>
                                    <td style="text-align:center;">{{$por['total_si']}}</td>
                                    <td style="text-align:center;">{{$por['promedio']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </x-panel.tabla>
                    </x-panel.tarjeta>
                @endif
            </div>
        </div>

        <!--<input id="exportar" type="button">-->

        <div class="tw:grid tw:grid-cols-1 tw:gap-6 tw:xl:grid-cols-5">
            <x-panel.tarjeta class="tw:xl:col-span-2" titulo="Aspectos evaluados" sin-relleno>
                <x-panel.tabla compacta>
                    <thead>
                    <tr>
                        <th class="tw:text-center">Aspectos evaluados</th>
                        <th class="tw:text-center">Puntuaje</th>
                        <th class="tw:text-center">Calificación</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($preguntas2 as $datos_pregunta)
                        <tr>
                            @if($datos_pregunta["id_criterio"]==0)

                            @elseif($datos_pregunta["id_criterio"]==1)
                                <td style="text-align:center;">A</td>
                            @elseif($datos_pregunta["id_criterio"]==2)
                                <td style="text-align:center;">B</td>
                            @elseif($datos_pregunta["id_criterio"]==3)
                                <td style="text-align:center;">C</td>
                            @elseif($datos_pregunta["id_criterio"]==4)
                                <td style="text-align:center;">D</td>
                            @elseif($datos_pregunta["id_criterio"]==5)
                                <td style="text-align:center;">E</td>
                            @elseif($datos_pregunta["id_criterio"]==6)
                                <td style="text-align:center;">F</td>
                            @elseif($datos_pregunta["id_criterio"]==7)
                                <td style="text-align:center;">G</td>
                            @elseif($datos_pregunta["id_criterio"]==8)
                                <td style="text-align:center;">H</td>
                            @elseif($datos_pregunta["id_criterio"]==9)
                                <td style="text-align:center;">I</td>
                            @elseif($datos_pregunta["id_criterio"]==10)
                                <td style="text-align:center;">J</td>
                            @endif
                            <td style="text-align:center;">{{ $datos_pregunta["calificacion"] }}</td>
                            @if($datos_pregunta["calificacion"]>=0 && $datos_pregunta["calificacion"]<=3.24)
                                <td style="text-align:center;">DESEMPEÑO INSUFICIENTE</td>
                            @elseif($datos_pregunta["calificacion"]>=3.25 && $datos_pregunta["calificacion"]<=3.74)
                                <td style="text-align:center;">SUFICIENTE</td>
                            @elseif($datos_pregunta["calificacion"]>=3.75 && $datos_pregunta["calificacion"]<=4.24)
                                <td style="text-align:center;">BUENO</td>
                            @elseif($datos_pregunta["calificacion"]>=4.25 && $datos_pregunta["calificacion"]<=4.74)
                                <td style="text-align:center;">NOTABLE</td>
                            @elseif($datos_pregunta["calificacion"]>=4.75 && $datos_pregunta["calificacion"]<=5)
                                <td style="text-align:center;">EXCELENTE</td>
                            @endif


                        </tr>

                    @endforeach
                    <tr>
                        <td style="text-align:center;" class="tw:font-semibold">TOTAL</td>
                        <td style="text-align:center;" class="tw:font-semibold">{{$promedio_t}}</td>

                        @if($promedio_t>=0 &&$promedio_t<=3.24)
                            <td style="text-align:center;">DESEMPEÑO INSUFICIENTE</td>
                        @elseif($promedio_t>=3.25 && $promedio_t<=3.74)
                            <td style="text-align:center;">SUFICIENTE</td>
                        @elseif($promedio_t>=3.75 && $promedio_t<=4.24)
                            <td style="text-align:center;">BUENO</td>
                        @elseif($promedio_t>=4.25 && $promedio_t<=4.74)
                            <td style="text-align:center;">NOTABLE</td>
                        @elseif($promedio_t>=4.75 && $promedio_t<=5)
                            <td style="text-align:center;">EXCELENTE</td>
                        @endif
                    </tr>

                    </tbody>
                </x-panel.tabla>
            </x-panel.tarjeta>

            <x-panel.tarjeta class="tw:xl:col-span-3" titulo="Resultado gráfico">
                {{-- Highcharts dibuja aquí con ancho fijo de 1000 px (mismas opciones de siempre): se desplaza en pantallas chicas. --}}
                <div class="tw:overflow-x-auto">
                    <div id="mostrar_graficas"  >
                    </div>
                </div>
            </x-panel.tarjeta>
        </div>

        <x-panel.tarjeta titulo="Detalle por criterio" sin-relleno>
            <x-panel.tabla class="tw-tabla-bordes" id="aceptados">
                <tr>
                    <th>Criterio</th>
                    <th>Pregunta</th>
                    <th class="tw:text-center">Calificacion</th>
                    <th>Observacion</th>
                </tr>
                @foreach($preguntas2 as $pre)
                    <tr>
                        <th scope="rowgroup" rowspan="{{$pre['cantidad']}}" class="tw:bg-gray-50 tw:align-middle tw:dark:bg-white/3">
                            <div style="text-align:center;" class="tw:text-sm tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{$pre["nombre_criterio"]}}</div>
                            <div style="text-align:center;" class="tw:mt-3 tw:text-lg tw:font-semibold tw:text-brand-500">{{$pre["calificacion"]}}</div>
                            <div style="text-align:center;" class="tw:mt-2 tw:text-xs tw:text-gray-500 tw:dark:text-gray-400">
                                @if($pre["calificacion"]>=0 && $pre["calificacion"]<=3.24)
                                    DESEMPEÑO INSUFICIENTE
                                @elseif($pre["calificacion"]>=3.25 && $pre["calificacion"]<=3.74)
                                    SUFICIENTE
                                @elseif($pre["calificacion"]>=3.75 && $pre["calificacion"]<=4.24)
                                    BUENO
                                @elseif($pre["calificacion"]>=4.25 && $datos_pregunta["calificacion"]<=4.74)
                                    NOTABLE
                                @elseif($pre["calificacion"]>=4.75 && $pre["calificacion"]<=5)
                                    EXCELENTE
                                @endif
                            </div>
                        </th>


                    </tr>

                    @foreach($pre["preguntas"] as $preg)
                        <tr>
                            <td scope="col">{{$preg['pregunta']}}</td>
                            <td style="text-align:center;" scope="col">{{$preg['calificacion']}}</td>
                            <td scope="col">{{$preg['observacion']}}</td>
                        </tr>


                    @endforeach


                @endforeach
            </x-panel.tabla>
        </x-panel.tarjeta>
    </div>

    <form class="form" role="form" method="POST" id="formgeneral" action="/imprime_grafica"  style="display:none;">
        <!-- Tab panes -->

        {{ csrf_field()}}

        <div class="tab-content">

            <div role="tabpanel" class="tab-pane active" id="uno">



                <div>
                    <label for="exampleInputEmail1">Curp<b style="color:red; font-size:23px;">*</b></label>
                    <!--<input type="text" class="form-control"  placeholder="" id="dir_imagen" name="dir_imagen" value="">-->
                    <input type="hidden" id="dir_imagen" name="dir_imagen">
                    <input type="text" placeholder="" id="hrs_prof" name="id_hrs" value="{{$g_id_hrs}}" >
                    <input type="text" placeholder="" id="condi" name="condi" value="{{$condi}}" >
                    <input type="text" placeholder="" id="carrera" name="carrera" value="{{$g_carrera}}">
                    <input type="text" placeholder="" id="id_profesor" name="id_profesor" value="{{$id_profesor}}">


                </div>

            </div>
        </div>
    </form>

@endsection
