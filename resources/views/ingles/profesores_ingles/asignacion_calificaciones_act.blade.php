{{--
    Calificaciones de un grupo de inglés (/ingles/Calificaciones/mostrar_alumnos/{nivel}/{grupo},
    In_inicioController@mostrar_alumnos; periodo de inglés 18 en adelante). Diseño del panel; la lógica no cambia:
    mismas ramas por etapa de captura ($calificar_unidad['unidad1']) y por unidad 19, mismas celdas y colores
    de aprobación, mismos campos .calificacion_N (id error_{carga}, data-id), mismos botones #guardar_calificacion
    (data-id_unidad, data-token), mismos enlaces .modificar_calN, Lista de asistencia y Acta ordinaria (PDF),
    modal #modal_modificar_cal con el formulario POST /ingles/guardar_modificacion/calificacion y el mismo script.
    Versión anterior: tests/Fixtures/vistas_antes.
--}}
@extends('layouts.panel')
@section('title', 'Calificaciones de ingles')
@include('partials.panel.recursos_app')
@section('content')
    <main>
        <?php
        $moduloIngles = true;
        $unidad = Session::get('id_unidad_admin');
        ?>
        <x-panel.encabezado titulo="Calificaciones de ingles" :migas="['Inglés' => url('/ingles/'), 'Calificaciones de ingles' => url('/ingles/Calificaciones')]" />

        <x-panel.tarjeta class="tw:mb-6">
            <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">CALIFICACIONES DE INGLES</h3>
            <p class="tw:mt-1 tw:text-sm tw:text-gray-600 tw:dark:text-gray-300">NIVEL: {{$nivel}}  GRUPO: {{$id_grupo}}</p>
            <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $profesor->nombre }} {{ $profesor->apellido_paterno }} {{ $profesor->apellido_materno }}</p>
        </x-panel.tarjeta>
        @if($alumnos_inscritos ==0)
            <x-panel.vacio titulo="No hay usuarios inscrito en este grupo" />
        @else
                @if($calificar_unidad['unidad1'] ==13)
                    <div class="tw:mb-4 tw:flex tw:flex-wrap tw:items-center tw:justify-between tw:gap-3">
                        <x-panel.boton variante="advertencia" class="center" onclick="window.open('{{url('/ingles/lista_asistencia/'.$id_nivel.'/'.$id_grupo)}}')"><i class="fa fa-list" aria-hidden="true"></i> Lista de asistencia</x-panel.boton>
                        <x-panel.boton variante="exito" class="center" onclick="window.open('{{url('/ingles/acta_ordinaria_act/'.$id_nivel.'/'.$id_grupo)}}')"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Acta ordinaria</x-panel.boton>
                    </div>
                    @else
                    <div class="tw:mb-4 tw:flex tw:flex-wrap tw:items-center tw:gap-3">
                        <x-panel.boton variante="advertencia" class="center" onclick="window.open('{{url('/ingles/lista_asistencia/'.$id_nivel.'/'.$id_grupo)}}')"><i class="fa fa-list" aria-hidden="true"></i> Lista de asistencia</x-panel.boton>
                    </div>
              @endif
            <div id="consultar">
                    <x-panel.tabla id="table_enviado" class="tw-tabla-bordes tw-tabla-centrada" compacta>
                        <thead>
                        <tr>
                            <th>NO.</th>
                            <th>NO. CUENTA </th>
                            <th>NOMBRE DEL USUARIO</th>
                            <th>CARRERA</th>
                            <th>SPEAKING</th>
                            <th>WRITING</th>
                            <th>READING</th>
                            <th>LISTENING</th>
                            <th>PROMEDIO</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $numero=1;
                        @endphp
                        @foreach($array_calificaciones as $alumnos)

                            <tr>
                                <td >{{ $numero }}</td>
                                @if($alumnos['estado_nivel'] == 1)
                                    <td style="color: black">{{ $alumnos['cuenta']}}</td>
                                @elseif($alumnos['estado_nivel']== 2)
                                    <td  style="background: green; color: white;">{{$alumnos['cuenta'] }}</td>
                                @elseif($alumnos['estado_nivel'] == 3)
                                    <td  style="background: yellow; color: orange">{{ $alumnos['cuenta'] }}</td>
                                @elseif($alumnos['estado_nivel'] == 4)
                                    <td  style="background: red; color: white">{{ $alumnos['cuenta'] }}</td>
                                @endif

                                <td style="color: black; text-align: left">{{ $alumnos['nombre']}}</td>
                                <td style="color: black; text-align: left">{{ $alumnos['carrera']}}</td>
                                @if($calificar_unidad['unidad1'] ==9 || $calificar_unidad['unidad1'] ==5)
                                    <td style="color: black">{{$alumnos['unidad1']}}</td>
                                    <td style="color: black">{{$alumnos['unidad2']}}</td>
                                    <td style="color: black">{{$alumnos['unidad3']}}</td>
                                    <td style="color: black">{{$alumnos['unidad4']}}</td>
                                    <td style="color: black; text-align: left">{{ $alumnos['promedio']}}</td>


                                @elseif($calificar_unidad['unidad1'] ==1)
                                    <td class="tw:text-center"><input id="error_{{$alumnos['id_carga']}}" type="text" value="0" class="calificacion_1 tw:rounded-md tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:px-2 tw:py-1.5 tw:text-center tw:text-sm tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden" style="width:7em; border-radius: 4px" data-id="{{$alumnos['id_carga']}}" name="calificacion_1" ></td>
                                    <td style="color: black">{{$alumnos['unidad2']}}</td>
                                    <td style="color: black">{{$alumnos['unidad3']}}</td>
                                    <td style="color: black">{{$alumnos['unidad4']}}</td>
                                    <td style="color: black; text-align: left">{{ $alumnos['promedio']}}</td>
                                @elseif($calificar_unidad['unidad1'] ==10 ||  $calificar_unidad['unidad1'] ==6)
                                    @if($alumnos['unidad1']<70)
                                        <td style="color: black;background: red;">
                                            @if($unidad ==19)
                                                {{$alumnos['unidad1']}}
                                                <a class="modificar_cal1"   href="#" data-id_carga_academica1="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif
                                        </td>
                                    @else
                                        <td style="color: black">{{$alumnos['unidad1']}}   @if($unidad ==19)
                                                <a class="modificar_cal1"   href="#" data-id_carga_academica1="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif  </td>
                                    @endif
                                    <td style="color: black">{{$alumnos['unidad2']}}</td>
                                    <td style="color: black">{{$alumnos['unidad3']}}</td>
                                    <td style="color: black">{{$alumnos['unidad4']}}</td>
                                    @if($alumnos['promedio']<70)
                                        <td style="color: black;background: red;">{{$alumnos['promedio']}}</td>
                                    @else
                                        <td style="color: black">{{$alumnos['promedio']}}</td>
                                    @endif
                                @elseif($calificar_unidad['unidad1'] ==2)
                                    @if($alumnos['unidad1']<70)
                                        <td style="color: black;background: red;">{{$alumnos['unidad1']}}   @if($unidad ==19)
                                                <a class="modificar_cal1"   href="#" data-id_carga_academica1="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif</td>
                                    @else
                                        <td style="color: black">{{$alumnos['unidad1']}}   @if($unidad ==19)
                                                <a class="modificar_cal1"   href="#" data-id_carga_academica1="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif </td>
                                    @endif
                                    <td class="tw:text-center"><input id="error_{{$alumnos['id_carga']}}" type="text" value="0" class="calificacion_2 tw:rounded-md tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:px-2 tw:py-1.5 tw:text-center tw:text-sm tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden" style="width:7em; border-radius: 4px" data-id="{{$alumnos['id_carga']}}" name="calificacion_2" ></td>
                                    <td style="color: black">{{$alumnos['unidad3']}}</td>
                                    <td style="color: black">{{$alumnos['unidad4']}}</td>
                                    @if($alumnos['promedio']<70)
                                        <td style="color: black;background: red;">{{$alumnos['promedio']}}</td>
                                    @else
                                        <td style="color: black">{{$alumnos['promedio']}}</td>
                                    @endif
                                @elseif($calificar_unidad['unidad1'] ==7)
                                    @if($alumnos['unidad1']<70)
                                        <td style="color: black;background: red;">{{$alumnos['unidad1']}}   @if($unidad ==19)
                                                <a class="modificar_cal1"   href="#" data-id_carga_academica1="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif </td>
                                    @else
                                        <td style="color: black">{{$alumnos['unidad1']}}   @if($unidad ==19)
                                                <a class="modificar_cal1"   href="#" data-id_carga_academica1="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif   </td>
                                    @endif
                                    @if($alumnos['unidad2']<70)
                                        <td style="color: black;background: red;">{{$alumnos['unidad2']}} @if($unidad ==19)
                                                <a class="modificar_cal2"   href="#" data-id_carga_academica2="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif</td>
                                    @else
                                        <td style="color: black">{{$alumnos['unidad2']}} @if($unidad ==19)
                                                <a class="modificar_cal2"   href="#" data-id_carga_academica2="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif</td>
                                    @endif

                                    <td style="color: black">{{$alumnos['unidad3']}}</td>
                                    <td style="color: black">{{$alumnos['unidad4']}}</td>
                                    @if($alumnos['promedio']<70)
                                        <td style="color: black;background: red;">{{$alumnos['promedio']}}</td>
                                    @else
                                        <td style="color: black">{{$alumnos['promedio']}}</td>
                                    @endif

                                @elseif($calificar_unidad['unidad1'] ==3)
                                    @if($alumnos['unidad1']<70)
                                        <td style="color: black;background: red;">{{$alumnos['unidad1']}}   @if($unidad ==19)
                                                <a class="modificar_cal1"   href="#" data-id_carga_academica1="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif   </td>
                                    @else
                                        <td style="color: black">{{$alumnos['unidad1']}}   @if($unidad ==19)
                                                <a class="modificar_cal1"   href="#" data-id_carga_academica1="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif </td>
                                    @endif
                                    @if($alumnos['unidad2']<70)
                                        <td style="color: black;background: red;">{{$alumnos['unidad2']}} @if($unidad ==19)
                                                <a class="modificar_cal2"   href="#" data-id_carga_academica2="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif</td>
                                    @else
                                        <td style="color: black">{{$alumnos['unidad2']}} @if($unidad ==19)
                                                <a class="modificar_cal2"   href="#" data-id_carga_academica2="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif</td>
                                    @endif

                                    <td class="tw:text-center"><input id="error_{{$alumnos['id_carga']}}" type="text" value="0" class="calificacion_3 tw:rounded-md tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:px-2 tw:py-1.5 tw:text-center tw:text-sm tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden" style="width:7em; border-radius: 4px" data-id="{{$alumnos['id_carga']}}" name="calificacion_3" ></td>

                                    <td style="color: black">{{$alumnos['unidad4']}}</td>
                                    @if($alumnos['promedio']<70)
                                        <td style="color: black;background: red;">{{$alumnos['promedio']}}</td>
                                    @else
                                        <td style="color: black">{{$alumnos['promedio']}}</td>
                                    @endif
                                @elseif($calificar_unidad['unidad1'] ==8)
                                    @if($alumnos['unidad1']<70)
                                        <td style="color: black;background: red;">{{$alumnos['unidad1']}}   @if($unidad ==19)
                                                <a class="modificar_cal1"   href="#" data-id_carga_academica1="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif </td>
                                    @else
                                        <td style="color: black">{{$alumnos['unidad1']}}   @if($unidad ==19)
                                                <a class="modificar_cal1"   href="#" data-id_carga_academica1="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif</td>
                                    @endif
                                    @if($alumnos['unidad2']<70)
                                        <td style="color: black;background: red;">{{$alumnos['unidad2']}}  @if($unidad ==19)
                                                <a class="modificar_cal2"   href="#" data-id_carga_academica2="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif</td>
                                    @else
                                        <td style="color: black">{{$alumnos['unidad2']}}  @if($unidad ==19)
                                                <a class="modificar_cal2"   href="#" data-id_carga_academica2="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif</td>
                                    @endif
                                    @if($alumnos['unidad3']<70)
                                        <td style="color: black;background: red;">{{$alumnos['unidad3']}} <a class="modificar_cal3"   href="#" data-id_carga_academica3="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a></td>
                                    @else
                                        <td style="color: black">{{$alumnos['unidad3']}} <a class="modificar_cal3"   href="#" data-id_carga_academica3="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a></td>
                                    @endif

                                    <td style="color: black">{{$alumnos['unidad4']}}</td>
                                    @if($alumnos['promedio']<70)
                                        <td style="color: black;background: red;">{{$alumnos['promedio']}}</td>
                                    @else
                                        <td style="color: black">{{$alumnos['promedio']}}</td>
                                    @endif
                                @elseif($calificar_unidad['unidad1'] ==4)
                                    @if($alumnos['unidad1']<70)
                                        <td style="color: black;background: red;">{{$alumnos['unidad1']}}   @if($unidad ==19)
                                                <a class="modificar_cal1"   href="#" data-id_carga_academica1="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif </td>
                                    @else
                                        <td style="color: black">{{$alumnos['unidad1']}}   @if($unidad ==19)
                                                <a class="modificar_cal1"   href="#" data-id_carga_academica1="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif </td>
                                    @endif
                                    @if($alumnos['unidad2']<70)
                                        <td style="color: black;background: red;">{{$alumnos['unidad2']}} @if($unidad ==19)
                                                <a class="modificar_cal2"   href="#" data-id_carga_academica2="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif</td>
                                    @else
                                        <td style="color: black">{{$alumnos['unidad2']}} @if($unidad ==19)
                                                <a class="modificar_cal2"   href="#" data-id_carga_academica2="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif</td>
                                    @endif
                                    @if($alumnos['unidad3']<70)
                                        <td style="color: black;background: red;">{{$alumnos['unidad3']}}
                                            @if($unidad ==19)
                                                <a class="modificar_cal3"   href="#" data-id_carga_academica3="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif
                                        </td>
                                    @else
                                        <td style="color: black">{{$alumnos['unidad3']}}   @if($unidad ==19)
                                                <a class="modificar_cal3"   href="#" data-id_carga_academica3="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif</td>
                                    @endif

                                    <td class="tw:text-center"><input id="error_{{$alumnos['id_carga']}}" type="text" value="0" class="calificacion_4 tw:rounded-md tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:px-2 tw:py-1.5 tw:text-center tw:text-sm tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden" style="width:7em; border-radius: 4px" data-id="{{$alumnos['id_carga']}}" name="calificacion_4" ></td>

                                    @if($alumnos['promedio']<70)
                                        <td style="color: black;background: red;">{{$alumnos['promedio']}}</td>
                                    @else
                                        <td style="color: black">{{$alumnos['promedio']}}</td>
                                    @endif
                                @elseif($calificar_unidad['unidad1'] ==13)
                                    @if($alumnos['unidad1']<70)
                                        <td style="color: black;background: red;">{{$alumnos['unidad1']}}   @if($unidad ==19)
                                                <a class="modificar_cal1"   href="#" data-id_carga_academica1="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif</td>
                                    @else
                                        <td style="color: black">{{$alumnos['unidad1']}}   @if($unidad ==19)
                                                <a class="modificar_cal1"   href="#" data-id_carga_academica1="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif</td>
                                    @endif
                                    @if($alumnos['unidad2']<70)
                                        <td style="color: black;background: red;">{{$alumnos['unidad2']}}
                                            @if($unidad ==19)
                                                <a class="modificar_cal2"   href="#" data-id_carga_academica2="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif
                                        </td>
                                    @else
                                        <td style="color: black">{{$alumnos['unidad2']}}  @if($unidad ==19)
                                                <a class="modificar_cal2"   href="#" data-id_carga_academica2="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif</td>
                                    @endif
                                    @if($alumnos['unidad3']<70)
                                        <td style="color: black;background: red;">{{$alumnos['unidad3']}}   @if($unidad ==19)
                                                <a class="modificar_cal3"   href="#" data-id_carga_academica3="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif</td>
                                    @else
                                        <td style="color: black">{{$alumnos['unidad3']}}  @if($unidad ==19)
                                                <a class="modificar_cal3"   href="#" data-id_carga_academica3="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif</td>
                                    @endif

                                    @if($alumnos['unidad4']<70)
                                        <td style="color: black;background: red;">{{$alumnos['unidad4']}}
                                            @if($unidad ==19)
                                                <a class="modificar_cal4"   href="#" data-id_carga_academica4="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif</td>
                                    @else
                                        <td style="color: black">{{$alumnos['unidad4']}}
                                            @if($unidad ==19)
                                                <a class="modificar_cal4"   href="#" data-id_carga_academica4="{{$alumnos['id_carga']}}"><i class="fa fa-pencil tw:ml-1" aria-hidden="true"></i></a>
                                            @endif</td>
                                    @endif
                                    @if($alumnos['promedio']<70)
                                        <td style="color: black;background: red;">{{$alumnos['promedio']}}</td>
                                    @else
                                        <td style="color: black">{{$alumnos['promedio']}}</td>
                                    @endif

                                @endif


                            </tr>


                            @php
                                ++$numero;
                            @endphp
                        @endforeach

                        @if($calificar_unidad['unidad1'] == 9)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="background: #5cb750">0%</td>
                                <td style="background: #5cb750">0%</td>
                                <td style="background: #5cb750">0%</td>
                                <td style="background: #5cb750">0%</td>
                                <td style="background: #5cb750">0%</td>
                            </tr>
                        @elseif($calificar_unidad['unidad1'] ==1)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="tw:text-center"><input style="width: 7em" type="button" class="tooltip-options link tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:cursor-not-allowed tw:disabled:bg-brand-300" id="guardar_calificacion" name="guardar_calificacion" data-token="{{ csrf_token() }}" data-id_unidad="1" data-toggle="tooltip" data-placement="top" value="guardar"></td>
                            </tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="background: #5cb750">0%</td>
                            <td style="background: #5cb750">0%</td>
                            <td style="background: #5cb750">0%</td>
                            <td style="background: #5cb750">0%</td>
                            <td style="background: #5cb750">0%</td>
                        @elseif($calificar_unidad['unidad1'] ==5)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="tw:text-center"><input style="width: 7em" type="button" class="tooltip-options link tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:cursor-not-allowed tw:disabled:bg-brand-300" id="guardar_calificacion" name="guardar_calificacion" data-token="{{ csrf_token() }}" data-id_unidad="1" data-toggle="tooltip" data-placement="top" title="La fecha limite para evaluar expiro" value="guardar" disabled></td>
                            </tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="background: #5cb750">0%</td>
                            <td style="background: #5cb750">0%</td>
                            <td style="background: #5cb750">0%</td>
                            <td style="background: #5cb750">0%</td>
                            <td style="background: #5cb750">0%</td>
                        @elseif($calificar_unidad['unidad1'] ==10)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @if($porcentaje['unidad1'] == 30)
                                    <td style="background: yellow;color: white">{{$porcentaje['unidad1']}}%</td>
                                @elseif($porcentaje['unidad1'] < 30)
                                    <td style="background: red;color: white">{{$porcentaje['unidad1']}}%</td>
                                @elseif($porcentaje['unidad1'] > 30)
                                    <td style="background: green;color: white">{{$porcentaje['unidad1']}}%</td>
                                @endif
                                <td style="background: #5cb750">0%</td>
                                <td style="background: #5cb750">0%</td>
                                <td style="background: #5cb750">0%</td>
                                @if($porcentaje['promedio_general'] == 30)
                                    <td style="background: yellow;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @elseif($porcentaje['promedio_general'] < 30)
                                    <td style="background: red;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @elseif($porcentaje['promedio_general'] >30)
                                    <td style="background: green;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @endif
                            </tr>
                        @elseif($calificar_unidad['unidad1'] ==6)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="tw:text-center"><input style="width: 7em" type="button" class="tooltip-options link tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:cursor-not-allowed tw:disabled:bg-brand-300" id="guardar_calificacion" name="guardar_calificacion" data-token="{{ csrf_token() }}" data-id_unidad="2" data-toggle="tooltip" data-placement="top" title="La fecha limite para evaluar expiro" value="guardar" disabled></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @if($porcentaje['unidad1'] == 30)
                                    <td style="background: yellow;color: white">{{$porcentaje['unidad1']}}%</td>
                                @elseif($porcentaje['unidad1'] < 30)
                                    <td style="background: red;color: white">{{$porcentaje['unidad1']}}%</td>
                                @elseif($porcentaje['unidad1'] > 30)
                                    <td style="background: green;color: white">{{$porcentaje['unidad1']}}%</td>
                                @endif
                                <td style="background: #5cb750">0%</td>
                                <td style="background: #5cb750">0%</td>
                                <td style="background: #5cb750">0%</td>
                                @if($porcentaje['promedio_general'] == 30)
                                    <td style="background: yellow;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @elseif($porcentaje['promedio_general'] < 30)
                                    <td style="background: red;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @elseif($porcentaje['promedio_general'] >30)
                                    <td style="background: green;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @endif
                            </tr>
                        @elseif($calificar_unidad['unidad1'] ==2)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="tw:text-center"><input style="width: 7em" type="button" class="tooltip-options link tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:cursor-not-allowed tw:disabled:bg-brand-300" id="guardar_calificacion" name="guardar_calificacion" data-token="{{ csrf_token() }}" data-id_unidad="2" data-toggle="tooltip" data-placement="top"  value="guardar"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @if($porcentaje['unidad1'] == 30)
                                    <td style="background: yellow;color: white">{{$porcentaje['unidad1']}}%</td>
                                @elseif($porcentaje['unidad1'] < 30)
                                    <td style="background: red;color: white">{{$porcentaje['unidad1']}}%</td>
                                @elseif($porcentaje['unidad1'] > 30)
                                    <td style="background: green;color: white">{{$porcentaje['unidad1']}}%</td>
                                @endif
                                <td style="background: #5cb750">0%</td>
                                <td style="background: #5cb750">0%</td>
                                <td style="background: #5cb750">0%</td>
                                @if($porcentaje['promedio_general'] == 30)
                                    <td style="background: yellow;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @elseif($porcentaje['promedio_general'] < 30)
                                    <td style="background: red;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @elseif($porcentaje['promedio_general'] >30)
                                    <td style="background: green;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @endif
                            </tr>
                        @elseif($calificar_unidad['unidad1'] ==7)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="tw:text-center"><input style="width: 7em" type="button" class="tooltip-options link tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:cursor-not-allowed tw:disabled:bg-brand-300" id="guardar_calificacion" name="guardar_calificacion" data-token="{{ csrf_token() }}" data-id_unidad="3" data-toggle="tooltip" data-placement="top" title="La fecha limite para evaluar expiro" value="guardar" disabled></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @if($porcentaje['unidad1'] == 30)
                                    <td style="background: yellow;color: white">{{$porcentaje['unidad1']}}%</td>
                                @elseif($porcentaje['unidad1'] < 30)
                                    <td style="background: red;color: white">{{$porcentaje['unidad1']}}%</td>
                                @elseif($porcentaje['unidad1'] > 30)
                                    <td style="background: green;color: white">{{$porcentaje['unidad1']}}%</td>
                                @endif
                                @if($porcentaje['unidad2'] == 30)
                                    <td style="background: yellow;color: white">{{$porcentaje['unidad2']}}%</td>
                                @elseif($porcentaje['unidad2'] < 30)
                                    <td style="background: red;color: white">{{$porcentaje['unidad2']}}%</td>
                                @elseif($porcentaje['unidad2'] > 30)
                                    <td style="background: green;color: white">{{$porcentaje['unidad2']}}%</td>
                                @endif
                                <td style="background: #5cb750">0%</td>
                                <td style="background: #5cb750">0%</td>
                                @if($porcentaje['promedio_general'] == 30)
                                    <td style="background: yellow;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @elseif($porcentaje['promedio_general'] < 30)
                                    <td style="background: red;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @elseif($porcentaje['promedio_general'] >30)
                                    <td style="background: green;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @endif
                            </tr>
                        @elseif($calificar_unidad['unidad1'] ==3)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="tw:text-center"><input style="width: 7em" type="button" class="tooltip-options link tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:cursor-not-allowed tw:disabled:bg-brand-300" id="guardar_calificacion" name="guardar_calificacion" data-token="{{ csrf_token() }}" data-id_unidad="3" data-toggle="tooltip" data-placement="top"  value="guardar"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @if($porcentaje['unidad1'] == 30)
                                    <td style="background: yellow;color: white">{{$porcentaje['unidad1']}}%</td>
                                @elseif($porcentaje['unidad1'] < 30)
                                    <td style="background: red;color: white">{{$porcentaje['unidad1']}}%</td>
                                @elseif($porcentaje['unidad1'] > 30)
                                    <td style="background: green;color: white">{{$porcentaje['unidad1']}}%</td>
                                @endif
                                @if($porcentaje['unidad2'] == 30)
                                    <td style="background: yellow;color: white">{{$porcentaje['unidad2']}}%</td>
                                @elseif($porcentaje['unidad2'] < 30)
                                    <td style="background: red;color: white">{{$porcentaje['unidad2']}}%</td>
                                @elseif($porcentaje['unidad2'] > 30)
                                    <td style="background: green;color: white">{{$porcentaje['unidad2']}}%</td>
                                @endif
                                <td style="background: #5cb750">0%</td>
                                <td style="background: #5cb750">0%</td>
                                @if($porcentaje['promedio_general'] == 30)
                                    <td style="background: yellow;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @elseif($porcentaje['promedio_general'] < 30)
                                    <td style="background: red;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @elseif($porcentaje['promedio_general'] >30)
                                    <td style="background: green;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @endif
                            </tr>
                        @elseif($calificar_unidad['unidad1'] ==8)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="tw:text-center"><input style="width: 7em" type="button" class="tooltip-options link tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:cursor-not-allowed tw:disabled:bg-brand-300" id="guardar_calificacion" name="guardar_calificacion" data-token="{{ csrf_token() }}" data-id_unidad="4" data-toggle="tooltip" data-placement="top" title="La fecha limite para evaluar expiro" value="guardar" disabled></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @if($porcentaje['unidad1'] == 30)
                                    <td style="background: yellow;color: white">{{$porcentaje['unidad1']}}%</td>
                                @elseif($porcentaje['unidad1'] < 30)
                                    <td style="background: red;color: white">{{$porcentaje['unidad1']}}%</td>
                                @elseif($porcentaje['unidad1'] > 30)
                                    <td style="background: green;color: white">{{$porcentaje['unidad1']}}%</td>
                                @endif
                                @if($porcentaje['unidad2'] == 30)
                                    <td style="background: yellow;color: white">{{$porcentaje['unidad2']}}%</td>
                                @elseif($porcentaje['unidad2'] < 30)
                                    <td style="background: red;color: white">{{$porcentaje['unidad2']}}%</td>
                                @elseif($porcentaje['unidad2'] > 30)
                                    <td style="background: green;color: white">{{$porcentaje['unidad2']}}%</td>
                                @endif
                                @if($porcentaje['unidad3'] == 30)
                                    <td style="background: yellow;color: white">{{$porcentaje['unidad3']}}%</td>
                                @elseif($porcentaje['unidad3'] < 30)
                                    <td style="background: red;color: white">{{$porcentaje['unidad3']}}%</td>
                                @elseif($porcentaje['unidad3'] > 30)
                                    <td style="background: green;color: white">{{$porcentaje['unidad3']}}%</td>
                                @endif
                                <td style="background: #5cb750">0%</td>
                                @if($porcentaje['promedio_general'] == 30)
                                    <td style="background: yellow;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @elseif($porcentaje['promedio_general'] < 30)
                                    <td style="background: red;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @elseif($porcentaje['promedio_general'] >30)
                                    <td style="background: green;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @endif
                            </tr>
                        @elseif($calificar_unidad['unidad1'] ==4)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="tw:text-center"><input style="width: 7em" type="button" class="tooltip-options link tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:bg-brand-500 tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:cursor-not-allowed tw:disabled:bg-brand-300" id="guardar_calificacion" name="guardar_calificacion" data-token="{{ csrf_token() }}" data-id_unidad="4" data-toggle="tooltip" data-placement="top"  value="guardar"></td>
                            </tr>
                            <tr>

                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @if($porcentaje['unidad1'] == 30)
                                    <td style="background: yellow;color: white">{{$porcentaje['unidad1']}}%</td>
                                @elseif($porcentaje['unidad1'] < 30)
                                    <td style="background: red;color: white">{{$porcentaje['unidad1']}}%</td>
                                @elseif($porcentaje['unidad1'] > 30)
                                    <td style="background: green;color: white">{{$porcentaje['unidad1']}}%</td>
                                @endif
                                @if($porcentaje['unidad2'] == 30)
                                    <td style="background: yellow;color: white">{{$porcentaje['unidad2']}}%</td>
                                @elseif($porcentaje['unidad2'] < 30)
                                    <td style="background: red;color: white">{{$porcentaje['unidad2']}}%</td>
                                @elseif($porcentaje['unidad2'] > 30)
                                    <td style="background: green;color: white">{{$porcentaje['unidad2']}}%</td>
                                @endif
                                @if($porcentaje['unidad3'] == 30)
                                    <td style="background: yellow;color: white">{{$porcentaje['unidad3']}}%</td>
                                @elseif($porcentaje['unidad3'] < 30)
                                    <td style="background: red;color: white">{{$porcentaje['unidad3']}}%</td>
                                @elseif($porcentaje['unidad3'] > 30)
                                    <td style="background: green;color: white">{{$porcentaje['unidad3']}}%</td>
                                @endif
                                <td style="background: #5cb750">0%</td>
                                @if($porcentaje['promedio_general'] == 30)
                                    <td style="background: yellow;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @elseif($porcentaje['promedio_general'] < 30)
                                    <td style="background: red;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @elseif($porcentaje['promedio_general'] >30)
                                    <td style="background: green;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @endif
                            </tr>
                        @elseif($calificar_unidad['unidad1'] ==13)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                                @if($porcentaje['unidad1'] == 30)
                                    <td style="background: yellow;color: white">{{$porcentaje['unidad1']}}%</td>
                                @elseif($porcentaje['unidad1'] < 30)
                                    <td style="background: red;color: white">{{$porcentaje['unidad1']}}%</td>
                                @elseif($porcentaje['unidad1'] > 30)
                                    <td style="background: green;color: white">{{$porcentaje['unidad1']}}%</td>
                                @endif
                                @if($porcentaje['unidad2'] == 30)
                                    <td style="background: yellow;color: white">{{$porcentaje['unidad2']}}%</td>
                                @elseif($porcentaje['unidad2'] < 30)
                                    <td style="background: red;color: white">{{$porcentaje['unidad2']}}%</td>
                                @elseif($porcentaje['unidad2'] > 30)
                                    <td style="background: green;color: white">{{$porcentaje['unidad2']}}%</td>
                                @endif
                                @if($porcentaje['unidad3'] == 30)
                                    <td style="background: yellow;color: white">{{$porcentaje['unidad3']}}%</td>
                                @elseif($porcentaje['unidad3'] < 30)
                                    <td style="background: red;color: white">{{$porcentaje['unidad3']}}%</td>
                                @elseif($porcentaje['unidad3'] > 30)
                                    <td style="background: green;color: white">{{$porcentaje['unidad3']}}%</td>
                                @endif
                                @if($porcentaje['unidad4'] == 30)
                                    <td style="background: yellow;color: white">{{$porcentaje['unidad4']}}%</td>
                                @elseif($porcentaje['unidad4'] < 30)
                                    <td style="background: red;color: white">{{$porcentaje['unidad4']}}%</td>
                                @elseif($porcentaje['unidad4'] > 30)
                                    <td style="background: green;color: white">{{$porcentaje['unidad4']}}%</td>
                                @endif
                                @if($porcentaje['promedio_general'] == 30)
                                    <td style="background: yellow;color: white" >{{ $porcentaje['promedio_general']}}%</td>
                                @elseif($porcentaje['promedio_general'] < 30)
                                    <td style="background: red;color: white">{{ $porcentaje['promedio_general']}}%</td>
                                @elseif($porcentaje['promedio_general'] >30)
                                    <td style="background: green; color: white">{{ $porcentaje['promedio_general']}}%</td>
                        @endif
                        @endif





                        </tbody>
                    </x-panel.tabla>
            </div>






        @endif
        <x-panel.modal id="modal_modificar_cal" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
            <form id="form_mod_periodo_ingles" class="form" action="{{url("/ingles/guardar_modificacion/calificacion")}}" role="form" method="POST" >
                {{ csrf_field() }}
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar Calificación</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_modificar_cal">
                    </div>
                </div>
                <x-panel.modal-pie>
                    <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
                    <x-panel.boton type="submit">Guardar</x-panel.boton>
                </x-panel.modal-pie>
            </form>
        </x-panel.modal>

    </main>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $(".modificar_cal1").click(function () {

                var id_carga_academica1=$(this).data("id_carga_academica1");
                var id_unidad=1;
                $.get("/ingles/modificar_cal/ingles/"+id_carga_academica1+"/"+id_unidad,function (request) {
                    $("#contenedor_modificar_cal").html(request);
                    $("#modal_modificar_cal").modal('show');
                });

            });
            $(".modificar_cal2").click(function () {

                var id_carga_academica2=$(this).data("id_carga_academica2");
                var id_unidad=2;
                $.get("/ingles/modificar_cal/ingles/"+id_carga_academica2+"/"+id_unidad,function (request) {
                    $("#contenedor_modificar_cal").html(request);
                    $("#modal_modificar_cal").modal('show');
                });

            });
            $(".modificar_cal3").click(function () {

                var id_carga_academica3=$(this).data("id_carga_academica3");
                var id_unidad=3;
                $.get("/ingles/modificar_cal/ingles/"+id_carga_academica3+"/"+id_unidad,function (request) {
                    $("#contenedor_modificar_cal").html(request);
                    $("#modal_modificar_cal").modal('show');
                });

            });
            $(".modificar_cal4").click(function () {

                var id_carga_academica4=$(this).data("id_carga_academica4");
                var id_unidad=4;
                $.get("/ingles/modificar_cal/ingles/"+id_carga_academica4+"/"+id_unidad,function (request) {
                    $("#contenedor_modificar_cal").html(request);
                    $("#modal_modificar_cal").modal('show');
                });

            });
            $("#guardar_calificacion").click(function ()
            {

                var calificaciones= { alumno:[] };
                var id_unidad=$(this).data("id_unidad");
                var token=$(this).data("token");
                cal_noValida=false;
                cal_reprobatoria=false;
                var cal_rep=0;
                $(".calificacion_"+id_unidad).each(function () {
                    var id_carga_academica=$(this).data("id");
                    var calificacion=$(this).val();
                    document.getElementById("error_"+id_carga_academica).style.backgroundColor = "white";
                    document.getElementById("error_"+id_carga_academica).style.color = "black";
                    if(calificacion<0 || calificacion>100 || !/^([0-9])*$/.test(calificacion))
                    {
                        cal_noValida=true;
                        document.getElementById("error_"+id_carga_academica).style.color = "white";
                        document.getElementById("error_"+id_carga_academica).style.backgroundColor = "#cd4545";
                    }
                    else if(calificacion>=0 && calificacion<70)
                    {
                        cal_reprobatoria=true;
                        cal_rep++;
                        document.getElementById("error_"+id_carga_academica).style.color = "white";
                        document.getElementById("error_"+id_carga_academica).style.backgroundColor = "#f3a333";
                    }
                    calificaciones.alumno.push({
                        "id_carga_academica" : id_carga_academica,
                        "calificacion" : calificacion,
                        "id_unidad" : id_unidad
                    });
                });
                var data_cal = JSON.stringify(calificaciones);
                if(cal_noValida)
                {
                    swal({
                        type: "error",
                        title: "Existen calificaciones erroneas",
                        text: 'las calificaciones erroneas estan marcadas en rojo',
                        showConfirmButton: true,
                    });
                }
                else
                {
                    if(cal_reprobatoria)
                    {
                        //pide confirmacion
                        Swal({
                            title: 'Ingreso '+(cal_rep==1 ? ''+cal_rep+' calificación reprobatoria': ''+cal_rep+' calificaciones reprobatorias'),
                            text: "¿Esta seguro que desea continuar?",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, continuar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.value) {
                                //calificaciones con sumativas
                                $("#guardar_calificacion").attr("disabled", true);
                                $.post('/ingles/agregar_calificaciones_unidad/{{ $id_nivel }}/{{ $id_grupo }}/'+id_unidad+'/insert_calificacion',{_token:token,calificaciones:data_cal},function(request)
                                {
                                    swal({
                                        type: "success",
                                        title: "Registro exitoso",
                                        showConfirmButton: false,
                                        timer: 1500
                                    }). then(function(result)
                                    {
                                        location.reload(true);
                                    });
                                });
                            }
                        })
                    }
                    else
                    {
                        $("#guardar_calificacion").attr("disabled", true);
                        $.post('/ingles/agregar_calificaciones_unidad/{{ $id_nivel }}/{{ $id_grupo }}/'+id_unidad+'/insert_calificacion',{_token:token,calificaciones:data_cal},function(request)
                        {
                            swal({
                                type: "success",
                                title: "Registro exitoso",
                                showConfirmButton: false,
                                timer: 1500
                            }). then(function(result)
                            {
                                location.reload(true);
                            });
                        });
                    }
                }
            });

        });
    </script>
@endsection