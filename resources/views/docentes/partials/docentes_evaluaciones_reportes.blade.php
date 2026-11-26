@extends('layouts.panel')
@section('title', 'Evaluaciones')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <?php $dia = date("d"); $mes = date("m"); $anio = date("Y");$dia_v = date("d"); $mes_v = date("m"); $anio_v = date("Y");?>
    <x-panel.encabezado titulo="Registro de calificaciones" :migas="['Docentes' => null]" />
    @if(!isset($nom_materia))
        <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:px-2">
            <div class="tw:w-full tw:px-2">
                <label class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700 tw:text-center" data-toggle="tab"><h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">No hay alumnos inscritos en esta
                        materia
                    </h3></label>
            </div>
        </div>
    @else
        <div class=" tw:w-10/12 tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:px-2">
                        <label for="" class="tw:w-full tw:lg:w-full tw:text-center tw:px-2">{{$nom_carrera}}</label>
                        <label for="" class="tw:w-full tw:lg:w-6/12 tw:text-left tw:px-2">
                            Materia: {{$nom_materia}}
                            <br>
                            Grupo: {{$grupo}}
                        </label>
                        <label for="" class="tw:w-full tw:lg:w-6/12 tw:text-right tw:px-2">
                            Clave: {{$clave_m}}
                            <br>
                            No. Unidades: {{$unidades}}
                        </label>
                        <label for="" class="tw:w-full tw:lg:w-full tw:text-right tw:px-2">
                            <a href="{{url("reportes/reporte_docente",[$id_docente,$id_materia,$id_grupo])}}"  target="_blank" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Reporte docente</a>
                            <a href="{{url("reportes/reporte_canalizacion",[$id_docente,$id_materia,$id_grupo])}}" target="_blank" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Reporte de canalización</a>
                            <a href="{{url("reportes/reporte_tutor",[$id_docente,$id_materia,$id_grupo])}}"  target="_blank" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Reporte tutor</a>
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                                    onclick="window.open('{{url('genera_listas', ['id_docente' => $id_docente,'id_materia' => $id_materia,'id_grupo' => $id_grupo,'unidades' => $unidades])}}')">
                                Lista de asistencia
                            </button>

                            <input type="{{ $esc_pormateria ? 'hidden' : ($habilitaPDF==2 ? 'button' : 'hidden') }}"
                                   class="tooltip-options link tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="link_genera_pdf"
                                   name="link_genera_pdf" data-token="{{ csrf_token() }}" data-toggle="tooltip"
                                   data-placement="top" title="Generar acta de calificaciones" target="_blank"
                                   value="Acta Ordinaria">
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class=" tw:w-10/12 tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw:w-full tw-tabla tw-tabla-rayas tw:lg:w-full tw:px-2">
                        <thead class="">
                        <tr class="tw:text-center tw:text-gray-800 tw:dark:text-white/90 tw:bg-gray-200 tw:dark:bg-gray-700">
                            <th rowspan="2" class="tw:text-center tw:align-middle">NP
                            </th>
                            <th rowspan="2" class="tw:text-center tw:align-middle">No.
                                CTA
                            </th>
                            <th rowspan="2" class="tw:text-center tw:align-middle">
                                NOMBRE DEL ALUMNO
                            </th>
                            <th colspan="{{ $unidades+2 }}" class="tw:text-center">UNIDADES</th>
                        </tr>
                        <tr>
                            @for ($i = 0; $i < $unidades; $i++)
                                <th class="tw:text-center">
                                    {{($i==0 ? 'I' :
                                            ($i==1 ? 'II' :
                                                    ($i==2 ? 'III' :
                                                            ($i==3 ? 'IV' :
                                                                    ($i==4 ? 'V' :
                                                                            ($i==5 ? 'VI' :
                                                                                    ($i==6 ? 'VII' :
                                                                                            ($i==7 ? 'VIII' :
                                                                                                    ($i==8 ? 'IX' :
                                                                                                            ($i==9 ? 'X' :
                                                                                                                    ($i==10 ? 'XI' :
                                                                                                                            ($i==11 ? 'XII' :
                                                                                                                                    ($i==12 ? 'XIII' :
                                                                                                                                            ($i==13 ? 'XIV' :
                                                                                                                                                    ($i==14 ? 'XV' : ' ' )))))))))))))))}}
                                </th>
                            @endfor
                            <th class="tw:text-center">PROMEDIO</th>
                            <th class="tw:text-center">T.E.</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  $porcentaje_gen = 0; $cont_gen = 0;?>
                        @foreach($alumnos as $alumno)
                            @php $cont_na=0;
                            @endphp
                            <tr class="tw:text-center">
                                <td class="tw:text-center">{{$alumno['np']}}</td>
                                <td class="tw:text-center"
                                    style=" {!! $alumno['curso']=='REPETICION' ? 'background:#ffee62; color:orange' : ($alumno['curso']=='ESPECIAL' ? 'background:#a94442; color:white' : '') !!} "> {{$alumno['cuenta']}}</td>
                                <td class="tw:text-left">{{$alumno['nombre']}}</td>
                                <?php  $cont = 0; $id_unidad_res = 0; $evalPrevia = false;$evalPreviabtn = false;?>
                                @forelse($alumno['calificaciones'] as $calificacion)
                                    <?php  $cont++; $id_unidad_res = ($calificacion['id_unidad'] != 0 ? $calificacion['id_unidad'] : "0")?>
                                    @if(($cont)<=$unidades)
                                        @if( ($cont)==$calificacion['id_unidad'])
                                            @php
                                                if($calificacion['calificacion']<70)
                                                $cont_na++;
                                            @endphp
                                            <td style="background: {{ $calificacion['calificacion']>=70 ? ' ' : '#FFEE62' }}"
                                                data-id-eval="{{ $calificacion['id_evaluacion'] }}"
                                                data-id-unidad="{{ $calificacion['id_unidad'] }}">
                                                {{ $calificacion['calificacion']>=70 ? $calificacion['calificacion'] : 'N.A'  }}
                                                {!! $calificacion['modificado']==1 ? '<span class="oi oi-info tooltip-options link tw:text-white tw:bg-orange-700 tw:text-white tw:rounded-full tw:p-1.25 tw:text-[7px]" data-toggle="tooltip" data-placement="top" title="La calificación fue modificada"></span>' : ''  !!}
                                                <?php $evalPrevia = true; $evalPreviabtn = true;?>
                                            </td>
                                        @else

                                        @endif
                                    @else

                                    @endif
                                @empty

                                @endforelse
                                <?php  $unidades_restantes = $unidades - $cont; ?>
                                @for ($i = 1; $i <= $unidades_restantes; $i++)
                                    @if( empty($uni_asignadas[$i-1]))
                                        <td>0</td>
                                    @else
                                        @if(isset($uni_asignadas[$cont]))
                                            <?php $dia = date("d"); $mes = date("m"); $anio = date("Y");$dia_v = date("d", strtotime((date("d-m-Y", strtotime($uni_asignadas[$evalPrevia ? ($cont) : ($i - 1)]->{'fecha'}))) . "+ 0 days"));$mes_v = date("m", strtotime((date("d-m-Y", strtotime($uni_asignadas[$evalPrevia ? ($cont) : ($i - 1)]->{'fecha'}))) . "+ 0 days"));$anio_v = date("Y", strtotime((date("d-m-Y", strtotime($uni_asignadas[$evalPrevia ? ($cont) : ($i - 1)]->{'fecha'}))) . "+ 0 days"));?>
                                            @if($anio<=$anio_v)
                                                @if($mes<=$mes_v)
                                                    @if($dia<=$dia_v || $mes<$mes_v)
                                                        @if($id_unidad_res+$i==1)
                                                            <td class="tw:text-center"><input
                                                                        id="error_{{$alumno['id_carga_academica']}}"
                                                                        type="text" value="0"
                                                                        class="calificacion_{{$id_unidad_res+$i}} input_calificacion tw:text-center tw:w-28 tw:rounded"
                                                                       
                                                                        data-contna="{{$cont_na}}"
                                                                        data-id="{{$alumno['id_carga_academica']}}"
                                                                        name="calificacion_{{$id_unidad_res+$i}}" {{$alumno['especial_bloq']==1 ? 'disabled':''}}>
                                                                @if($alumno['especial_bloq']!=1 )
                                                                <div id="cont{{$alumno['id_carga_academica']}}"
                                                                     style="display: none">


                                                                    <select name=""
                                                                            id="opcion{{$alumno['id_carga_academica']}}"
                                                                            data-id="{{$alumno['id_carga_academica']}}"
                                                                            class="opciones">
                                                                        <option value="0" disabled="" selected>¿Motivo
                                                                            por el cual reprobó?
                                                                        </option>
                                                                        <option value="1">Faltas</option>
                                                                        <option value="2">Responsabilidad</option>
                                                                        <option value="3">Otro</option>
                                                                    </select>
                                                                    <br>
                                                                    <input
                                                                            id="otro{{$alumno['id_carga_academica']}}"
                                                                            type="text" value=""
                                                                            class="input_otros tw:text-center tw:w-36 tw:rounded"
                                                                            style="display: none"
                                                                            data-id="{{$alumno['id_carga_academica']}}"
                                                                            name="calificacion_{{$id_unidad_res+$i}}" {{$alumno['especial_bloq']==1 ? 'disabled':''}}>
                                                                    <br>
                                                                    <select name=""
                                                                            id="canaliza{{$alumno['id_carga_academica']}}"
                                                                            data-id="{{$alumno['id_carga_academica']}}"
                                                                            style="display: none">
                                                                        <option value="0" disabled="" selected>
                                                                            Canalización
                                                                        </option>
                                                                        @foreach($canalizaciones as $canalizacion)
                                                                            <option value="{{$canalizacion->id}}">{{$canalizacion->descripcion}}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                                    @endif
                                                            </td>
                                                        @else
                                                            @if($evalPrevia)
                                                                <td class="tw:text-center"><input
                                                                            id="error_{{$alumno['id_carga_academica']}}"
                                                                            type="text" value="0"
                                                                            class="calificacion_{{$id_unidad_res+$i}} input_calificacion tw:text-center tw:w-28 tw:rounded"
                                                                           
                                                                            data-id="{{$alumno['id_carga_academica']}}"
                                                                            data-contna="{{$cont_na}}"
                                                                            name="calificacion_{{$id_unidad_res+$i}}"

                                                                            {{$alumno['especial_bloq']==1 ? 'disabled':''}}>

                                                                    @if($alumno['especial_bloq']!=1 )
                                                                    <div id="cont{{$alumno['id_carga_academica']}}"
                                                                         style="display: none">


                                                                        <select name=""
                                                                                id="opcion{{$alumno['id_carga_academica']}}"
                                                                                data-id="{{$alumno['id_carga_academica']}}"
                                                                                class="opciones">
                                                                            <option value="0" disabled="" selected>
                                                                                ¿Motivo por el cual reprobó?
                                                                            </option>
                                                                            <option value="1">Faltas</option>
                                                                            <option value="2">Responsabilidad</option>
                                                                            <option value="3">Otro</option>
                                                                        </select>
                                                                        <br>
                                                                        <input
                                                                                id="otro{{$alumno['id_carga_academica']}}"
                                                                                type="text" value=""
                                                                                class="input_otros tw:text-center tw:text-gray-800 tw:dark:text-white/90 tw:w-36 tw:rounded"
                                                                                style="display: none"
                                                                                data-id="{{$alumno['id_carga_academica']}}"
                                                                                name="calificacion_{{$id_unidad_res+$i}}" {{$alumno['especial_bloq']==1 ? 'disabled':''}}>
                                                                        <br>

                                                                        <select name=""
                                                                                id="canaliza{{$alumno['id_carga_academica']}}"
                                                                                data-id="{{$alumno['id_carga_academica']}}"
                                                                                style="display: none">
                                                                            <option value="0" disabled="" selected>
                                                                                Canalización
                                                                            </option>
                                                                            @foreach($canalizaciones as $canalizacion)
                                                                                <option value="{{$canalizacion->id}}">{{$canalizacion->descripcion}}</option>
                                                                            @endforeach

                                                                        </select>
                                                                    </div>
                                                                        @endif
                                                                </td>
                                                                <?php $evalPrevia = false;?>
                                                            @else
                                                                <td>0</td>
                                                            @endif
                                                        @endif
                                                    @else
                                                        <td>0</td>
                                                    @endif
                                                @else
                                                    <td>0</td>
                                                @endif
                                            @else
                                                <td>0</td>
                                            @endif
                                        @else
                                            <td class="tw:text-center">0</td>
                                        @endif
                                    @endif
                                @endfor
                                <?php  $porcentaje_gen += $alumno['promedio'] >= 70 ? '1' : '0'; $cont_gen++;?>
                                @if($alumno['promedio']>=70)
                                    <td class="tw:bg-white tw:dark:bg-white/[0.03]">{{ $alumno['promedio'] }}</td>
                                @else
                                    <td class="tw:bg-red-700 tw:text-white">{{$alumno['promedio']}}</td>
                                @endif
                                <td>{!! $alumno['curso']=='NORMAL' && $alumno['esc_alumno'] ? 'ESC'  : ( $alumno['curso']=='NORMAL' ? 'O'  : ($alumno['curso']=='REPETICION' && $alumno['esc_alumno'] ? 'ESC2' : ($alumno['curso']=='REPETICION' ? 'O2' : ($alumno['curso']=='ESPECIAL' ? 'CE' : ($alumno['curso']=='GLOBAL' ? 'EG': '' )))))!!}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="{{3+$cont}}"></td>
                            <?php  $unidades_restantes = $unidades - $cont; ?>
                            @for ($i = 1; $i <= $unidades_restantes; $i++)
                                @if( empty($uni_asignadas[$i-1]))
                                @else
                                    @if(isset($uni_asignadas[$cont]))
                                        <?php $dia = date("d"); $mes = date("m"); $anio = date("Y");$dia_v = date("d", strtotime((date("d-m-Y", strtotime($uni_asignadas[$evalPreviabtn ? ($cont) : ($i - 1)]->{'fecha'}))) . "+ 0 days"));$mes_v = date("m", strtotime((date("d-m-Y", strtotime($uni_asignadas[$evalPreviabtn ? ($cont) : ($i - 1)]->{'fecha'}))) . "+ 0 days"));$anio_v = date("Y", strtotime((date("d-m-Y", strtotime($uni_asignadas[$evalPreviabtn ? ($cont) : ($i - 1)]->{'fecha'}))) . "+ 0 days"));?>
                                        @if($anio<=$anio_v)
                                            @if($mes<=$mes_v)
                                                @if($dia<=$dia_v || $mes<$mes_v)
                                                    @if($id_unidad_res+$i==1)
                                                        <td class="tw:text-center"><input type="button"
                                                                                       class="tooltip-options link tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap"
                                                                                       id="guardar_calificacion"
                                                                                       name="guardar_calificacion"
                                                                                       data-token="{{ csrf_token() }}"
                                                                                       data-id_unidad="{{$id_unidad_res+$i}}"
                                                                                       data-toggle="tooltip"
                                                                                       data-placement="top"
                                                                                       title="La fecha limite para evaluar la unidad es {{ $dia_v }}-{{ $mes_v }}-{{ $anio_v }}"
                                                                                       value="guardar">


                                                        </td>
                                                    @else
                                                        @if($evalPreviabtn)
                                                            <td class="tw:text-center"><input
                                                                                           type="button"
                                                                                           class="tooltip-options link tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap"
                                                                                           id="guardar_calificacion"
                                                                                           name="guardar_calificacion"
                                                                                           data-token="{{ csrf_token() }}"
                                                                                           data-id_unidad="{{$id_unidad_res+$i}}"
                                                                                           data-toggle="tooltip"
                                                                                           data-placement="top"
                                                                                           title="La fecha limite para evaluar la unidad es {{ $dia_v }}-{{ $mes_v }}-{{ $anio_v }}"
                                                                                           value="guardar"></td>
                                                            <?php $evalPreviabtn = false;?>
                                                        @else
                                                        @endif
                                                    @endif
                                                @else
                                                @endif
                                            @else
                                            @endif
                                        @else
                                        @endif
                                    @else
                                    @endif
                                @endif
                            @endfor
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            @foreach($porcentajes as $porcentaje)
                                <td class="tw:text-center"
                                    style="background: {{ $porcentaje['porcentaje']>=70 ? '#3c763d' : '#a94442' }}; color: #ffffff">{{ $porcentaje['porcentaje'] }}
                                    %
                                </td>
                            @endforeach
                            <?php  $imp_porcentaje = (($porcentaje_gen * 100) / $cont_gen);?>
                            <td class="tw:text-center"
                                style="background: {{ $imp_porcentaje>=70 ? '#3c763d' : '#a94442' }}; color: #ffffff">{{ round($imp_porcentaje,2) }}
                                %
                            </td>
                        </tr>
                        </tbody>
                    </table>
</div>

                </div>
            </div>
        </div>
        <!-- Modal adeudo en los departamentos -->
        <x-panel.modal id="modal_adeudo" tamano="lg" sin-relleno clase-cerrar="close" estatico>
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                     {{--  --}}
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Alerta</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <p class="tw:text-center" >	<strong>No cuentas con ningún estudiante en sumativa, dar clic en el botón aceptar </strong></p>
                        <form id="form_aceptar" action="{{url("/docente/guardar_sin_alumnos_ensumativa/$id_docente/$id_materia/$id_grupo/")}}" role="form" method="POST" >
                            {{ csrf_field() }}
                        </form>
                        <p class="tw:text-center" ><button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="guardar_notificacion">Aceptar</button></p>

                    </div>
                </x-panel.modal>
        <x-panel.modal id="modal_mensaje" tamano="md" sin-relleno clase-cerrar="close">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Atento aviso</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <x-panel.alerta tipo="advertencia" class="tw:mb-4">
                            <strong>“Estimado(a) docente se le recuerda que el acceso a clases de los estudiantes debe ser conforme a las listas de asistencias que emite esta plataforma con fundamento en el art. 30 del reglamento para estudiantes del TESVB.”</strong>
                        </x-panel.alerta>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                    </div>
                </x-panel.modal>
    @endif
    <script type="text/javascript">


        $(document).ready(function () {

            var mostrar_mensaje = "<?php echo $mostrar_mensaje  ?>";
            if(mostrar_mensaje == 1){
                $('#modal_mensaje').modal('show');
            }

            var estado_reprobado = "<?php echo $estado_reprobado  ?>";
            if(estado_reprobado == 1){

                    $('#modal_adeudo').modal('show');
                $('#modal_adeudo').modal({backdrop: 'static', keyboard: false});
            }
            const total_unidades ={{$unidades}};
            $(".input_calificacion").keyup(function () {
                var id = $(this).data("id");
                var uni_na = $(this).data("contna");
                if ($(this).val() < 70) {
                    $("#cont" + id).show();
                    if ((uni_na + 1) / total_unidades >= 0.4) {
                        $("#canaliza" + id).show();
                    } else
                        $("#canaliza" + id).hide();

                } else {
                    $("#cont" + id).hide();
                }
            });
            $(".opciones").change(function () {
                var id = $(this).data("id");

                if ($(this).val() == 3) {
                    $("#otro" + id).show();

                } else {
                    $("#otro" + id).hide();
                }
            })
            $("#guardar_notificacion").click(function (){
                $("#guardar_notificacion").attr("disabled", true);
                $("#form_aceptar").submit();
                swal({
                    position: "top",
                    type: "success",
                    title: "Aceptación exitosa",
                    showConfirmButton: false,
                    timer: 3500
                });

            });

            $("#link_genera_pdf").click(function (event) {
                var link = "/generar_pdf?id_docente=" + {{ $id_docente }} +"&id_materia=" + {{ $id_materia }} +"&unidades=" + {{ $unidades }}+"&id_grupo=" + {{ $id_grupo }}+"";
                window.open(link);
            });

            $("#guardar_calificacion").click(function () {

                var calificaciones = {alumno: []};
                var id_unidad = $(this).data("id_unidad");
                var token = $(this).data("token");
                var cal_noValida = false;
                var cal_reprobatoria = false;
                var opcion = false;
                var otro = false;
               var canaliza_ban=false;
                var cal_rep = 0;
                $(".calificacion_" + id_unidad).each(function () {
                    var uni_na=$(this).data("contna");
                    if(!$(this).is(":disabled")) {
                        var id_carga_academica = $(this).data("id");
                        var calificacion = $(this).val();
                        var valopcion = $("#opcion" + id_carga_academica).val();
                        var valotro = $("#otro" + id_carga_academica).val();
                        var canaliza = $("#canaliza" + id_carga_academica).val();
                        document.getElementById("error_" + id_carga_academica).style.backgroundColor = "white";
                        document.getElementById("error_" + id_carga_academica).style.color = "black";
                        if (calificacion < 0 || calificacion > 100 || !/^([0-9])*$/.test(calificacion)) {
                            cal_noValida = true;
                            document.getElementById("error_" + id_carga_academica).style.color = "white";
                            document.getElementById("error_" + id_carga_academica).style.backgroundColor = "#cd4545";
                        } else if (calificacion >= 0 && calificacion < 70) {
                            cal_reprobatoria = true;
                            cal_rep++;
                            document.getElementById("error_" + id_carga_academica).style.color = "white";
                            document.getElementById("error_" + id_carga_academica).style.backgroundColor = "#f3a333";
                            if ($("#opcion" + id_carga_academica).val() == 0 || $("#opcion" + id_carga_academica).val() == null) {
                                opcion = true;
                                document.getElementById("cont" + id_carga_academica).style.color = "white";
                                $("#opcion" + id_carga_academica).css("color", "black");
                                $("#canaliza" + id_carga_academica).css("color", "black");
                                document.getElementById("cont" + id_carga_academica).style.backgroundColor = "#cd4545";
                                $("#cont" + id_carga_academica).show()
                            } else if ($("#opcion" + id_carga_academica).val() == 3 && $("#otro" + id_carga_academica).val() == "") {
                                $("#otro" + id_carga_academica).show();
                                otro = true;
                                document.getElementById("cont" + id_carga_academica).style.color = "white";
                                document.getElementById("cont" + id_carga_academica).style.backgroundColor = "#cd4545";
                                $("#otro" + id_carga_academica).css("color", "black");

                            } else {
                                document.getElementById("cont" + id_carga_academica).style.color = "black";
                                document.getElementById("cont" + id_carga_academica).style.backgroundColor = "white";
                            }
                            //  console.log((uni_na + 1) / total_unidades)
                            //console.log($("#canaliza" + id_carga_academica).val())
                            if ((uni_na + 1) / total_unidades >= 0.4 && $("#canaliza" + id_carga_academica).val() == null) {
                                canaliza_ban = true;
                                $("#canaliza" + id_carga_academica).show();

                            }


                        }
                        calificaciones.alumno.push({
                            "id_carga_academica": id_carga_academica,
                            "calificacion": calificacion,
                            "id_unidad": id_unidad,
                            "opcion": valopcion,
                            "otro": valotro,
                            "canaliza": canaliza,
                        });
                    }
                });
                var data_cal = JSON.stringify(calificaciones);
                if (cal_noValida || opcion || otro||canaliza_ban) {
                    console.log(cal_noValida+"--"+opcion+"--"+otro+"--"+canaliza_ban)
                    swal({
                        type: "error",
                        title: cal_noValida ? "Existen calificaciones erroneas" : "Falta información",
                        text: cal_noValida ? 'las calificaciones erroneas estan marcadas en rojo' : opcion ? "Elige un opción por la cual no se acreditó la unidad y de ser necesario canalización" : "Agrega el valor por el cual no se acreditó la unidad",
                        showConfirmButton: true,
                    });
                } else {
                    if (cal_reprobatoria) {
                        //pide confirmacion
                        Swal({
                            title: 'Ingreso ' + (cal_rep == 1 ? '' + cal_rep + ' calificación reprobatoria' : '' + cal_rep + ' calificaciones reprobatorias'),
                            html: "¿Esta seguro que desea continuar?<br> <h6>Ingresa las sugerencias de acciones preventivas para disminuir los índices de reprobación.</h6>",
                            type: 'warning',
                            input: 'textarea',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, continuar',
                            cancelButtonText: 'Cancelar',
                            inputValidator: (value) => {
                                if (!value) {
                                    return 'Ingresa las acciones preventivas!'
                                }
                            }
                        }).then((result) => {
                            // console.log(result)

                            if (result.value) {
                                $("#guardar_calificacion").attr("disabled", true);
                                $.post('/docente/acciones/{{ $id_docente }}/{{ $id_materia }}/{{ $id_grupo }}/' + id_unidad + '/insert_calificacion', {
                                    _token: token,
                                    calificaciones: data_cal,
                                    acciones: result.value
                                }, function (request) {
                                    swal({
                                        type: "success",
                                        title: "Registro exitoso",
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(function (result) {
                                        location.reload(true);
                                    });
                                });
                            }

                        })
                    } else {
                        $("#guardar_calificacion").attr("disabled", true);
                        $.post('/docente/acciones/{{ $id_docente }}/{{ $id_materia }}/{{ $id_grupo }}/' + id_unidad + '/insert_calificacion', {
                            _token: token,
                            calificaciones: data_cal
                        }, function (request) {
                            swal({
                                type: "success",
                                title: "Registro exitoso",
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function (result) {
                                location.reload(true);
                            });
                        });

                    }
                }
            });
        });
    </script>
</div>
@endsection
