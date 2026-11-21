@extends('layouts.panel')
@include('partials.panel.recursos_app', ['datepicker' => true])
@foreach($auditorias as $auditoria)
    @if($auditoria->id_auditoria==$auditoria_id)
        @section('title', 'Detalle auditoria '.\Carbon\Carbon::parse($auditoria->fecha_i)->format('Y').'-'.$loop->iteration)
    @endif
@endforeach
@section('content')
    <?php use \Carbon\Carbon; ?>

    <style>
        .informe-section-card {
            border: 1px solid #d9e2ec;
            border-radius: 8px;
            background: #ffffff;
            margin-top: 15px;
            margin-bottom: 18px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .informe-section-header {
            background: #f3f8fc;
            border-bottom: 1px solid #d9e2ec;
            padding: 12px 14px;
            color: #1f4e79;
        }

        .informe-section-header h4 {
            margin: 0;
            font-weight: 700;
        }

        .informe-section-body {
            padding: 14px;
        }

        .tabla-seguimiento-informe {
            table-layout: fixed;
            width: 100%;
            font-size: 12px;
            margin-bottom: 0;
        }

        .tabla-seguimiento-informe th,
        .tabla-seguimiento-informe td {
            vertical-align: top !important;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .tabla-seguimiento-informe th:nth-child(1),
        .tabla-seguimiento-informe td:nth-child(1) { width: 4%; }

        .tabla-seguimiento-informe th:nth-child(2),
        .tabla-seguimiento-informe td:nth-child(2) { width: 14%; }

        .tabla-seguimiento-informe th:nth-child(3),
        .tabla-seguimiento-informe td:nth-child(3) { width: 13%; }

        .tabla-seguimiento-informe th:nth-child(4),
        .tabla-seguimiento-informe td:nth-child(4) { width: 17%; }

        .tabla-seguimiento-informe th:nth-child(5),
        .tabla-seguimiento-informe td:nth-child(5) { width: 27%; }

        .tabla-seguimiento-informe th:nth-child(6),
        .tabla-seguimiento-informe td:nth-child(6) { width: 12%; }

        .tabla-seguimiento-informe th:nth-child(7),
        .tabla-seguimiento-informe td:nth-child(7) { width: 13%; }

        .ultima-nota-box {
            max-height: 95px;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 8px;
            border: 1px solid #e5e5e5;
            background: #fbfbfb;
            border-radius: 4px;
            text-align: justify;
        }

        .clave-nota-informe {
            display: inline-block;
            font-weight: 700;
            color: #1f4e79;
            margin-bottom: 5px;
        }

        .texto-muted-informe {
            color: #777;
            font-size: 12px;
        }

        .label-cumplimiento-informe {
            display: inline-block;
            white-space: normal;
            line-height: 1.25;
            padding: 6px 8px;
        }

        .mensaje-sin-seguimiento {
            margin-bottom: 0;
        }
    </style>
    <main class="tw-pantalla tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                <nav aria-label="Ruta de navegación" class="tw:mb-5 tw:flex tw:flex-wrap tw:items-center tw:gap-x-2 tw:gap-y-1 tw:text-sm tw:text-gray-500">
                    <span class="fa fa-arrow-right tw:text-brand-500"></span>
                    <a class="tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{url('/auditorias/programas')}}">Programas de auditoría</a>
                    <span class="fa fa-chevron-right tw:text-[10px] tw:text-gray-400"></span>
                    <a class="tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{url('/auditorias/programas')}}/{{\Illuminate\Support\Facades\Session::get('id_programa')}}">Detalles del programa</a>
                    <span class="fa fa-chevron-right tw:text-[10px] tw:text-gray-400"></span>
                    <a class="tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{url('/auditorias/programas')}}/{{\Illuminate\Support\Facades\Session::get('id_programa')}}/edit">Planes del programa</a>
                    <span class="fa fa-chevron-right tw:text-[10px] tw:text-gray-400"></span>
                    <a class="tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{url('/auditorias/planes')}}/{{$auditoria_id}}">Detalles del plan</a>
                    <span class="fa fa-chevron-right tw:text-[10px] tw:text-gray-400"></span>
                    <span class="tw:text-gray-800 tw:dark:text-white/90">Informe de la auditoria</span>
                </nav>
                @if (session()->has('flash_notification.message'))
                    <x-panel.alerta class="tw:mb-4" :tipo="['success' => 'exito', 'danger' => 'error', 'warning' => 'advertencia'][session('flash_notification.level')] ?? 'info'">{!! session('flash_notification.message') !!}</x-panel.alerta>
                @endif
                @foreach($auditorias as $auditoria)
                    @if($auditoria->id_auditoria==$auditoria_id)
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4 tw:text-center">
                                Informe de la auditoría {{\Carbon\Carbon::parse($auditoria->fecha_i)->format('Y').'-'.$loop->iteration}}
                                @if($auditoria->objetivo AND $auditoria->alcance AND $auditoria->criterio)
                                    <a href="#" data-id="{{$auditoria->id_auditoria}}" class="btn_export tw:float-right"  style="margin-left: 1.5em;" data-all="{{$auditoria}}"><span class="fa fa-print" data-toggle="tooltip" title="Imprimir informe de auditoria"></span></a>
                                @endif
                            </div>
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">Número de auditoría: <strong> {{\Carbon\Carbon::parse($auditoria->fecha_i)->format('Y').'-'.$loop->iteration}} </strong></div>
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">Fechas de la auditoría: Del <strong>{{Carbon::parse($auditoria->fecha_i)->format('d/m/Y')}}</strong> al <strong>{{Carbon::parse($auditoria->fecha_f)->format('d/m/Y')}}</strong></div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:text-center tw:px-2">
                                        <h4>Norma de Referencia:</h4>
                                        <h4>{{$auditoria->criterio}}</h4>
                                    </div>
                                </div>

                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <label>Objetivo</label>

                                        <p>{{$auditoria->objetivo}}</p>
                                    </div>
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <label>Alcance</label>
                                        <p>{{$auditoria->alcance}}</p>
                                        {{--                                        <p>{{count($procesosE)." procesos"}}</p>--}}
                                    </div>
                                </div>
                                <hr>
                                {{--<a href="#" class="btn_add_auditores tw:float-right" data-id="{{$auditoria->id_auditoria}}" data-toggle="modal" data-target="#modal_add_auditores"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar Auditores"></span></a>--}}
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <label>Auditor Líder:</label>
                                        @if($lider->isEmpty())
                                            {{--                                        <a href="#" class="btn-add-lider" data-id="{{$auditoria->id_auditoria}}" data-toggle="modal" data-target="#modal_edit_lider"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar lider"></span></a>--}}
                                            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" role="alert">No se ha agregado un lider</div>
                                        @else
                                            @foreach($lider as $auditores)
                                                @foreach($auditores->getAbr->getAbreviatura as $auditor)
                                                    <li class="tw:block tw:px-4 tw:py-3">
                                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                            <span class="tw:w-full tw:lg:w-10/12 tw:px-2">{{\App\audParseCase::parseAbr($auditor->titulo).' '.\App\audParseCase::parseNombre($auditores->getName->nombre)}}</span>
                                                            {{--<a href="#" class="btn-edit-lider tw:w-full tw:lg:w-1/12 tw:px-2" data-id="{{$auditor->id_asigna_audi}}" data-toggle="modal" data-target="#modal_edit_lider"><span class="fa fa-cog" data-toggle="tooltip" title="Editar lider"></span></a>--}}
                                                            {{--                                                        <a href="#" class="btn_delete_auditor tw:w-full tw:float-right tw:lg:w-1/12 tw:px-2" data-id="{{$auditor->id_auditor_auditoria}}"><span aria-hidden="true" class="fa fa-trash" data-toggle="tooltip" title="Eliminar lider"></span></a>--}}
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endforeach
                                        @endif
                                    </div>

                                </div>

                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <label>Equipo de auditores:</label>
                                        {{--                                    <a href="#" class="btn-add-aquipo" data-id="{{$auditoria->id_auditoria}}" data-toggle="modal" data-target="#modal_edit_equipo"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar auditor"></span></a>--}}
                                        @if($equipo=$auditoria->getAuditores($auditoria->id_auditoria, 2) AND sizeof($equipo)<1)
                                            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" role="alert">No se han agregado auditores al equipo</div>
                                        @else
                                            <ul class="tw:divide-y tw:divide-gray-100 tw:rounded-lg tw:border tw:border-gray-200">
                                                @foreach($equipo as $auditor)
                                                    <li class="tw:block tw:px-4 tw:py-3">
                                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                            <span class="tw:w-full tw:lg:w-10/12 tw:px-2"><label>Auditor {{$loop->iteration}}:</label>{{' '.\App\audParseCase::parseAbr($auditor->titulo).' '.\App\audParseCase::parseNombre($auditor->nombre)}}</span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <label>Auditores en entrenamiento:</label>
                                        {{--                                    <a href="#" class="btn-add-entrenado" data-id="{{$auditoria->id_auditoria}}" data-toggle="modal" data-target="#modal_edit_entrenado"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar auditor"></span></a>--}}


                                        @if(count($entrenados=$auditoria->getAuditores($auditoria->id_auditoria, 3))==0)
                                            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" role="alert">No se cuenta con auditores en entrenamiento</div>
                                        @else
                                            <ul class="tw:divide-y tw:divide-gray-100 tw:rounded-lg tw:border tw:border-gray-200">
                                                @foreach($entrenados as $auditor)
                                                    <li class="tw:block tw:px-4 tw:py-3">
                                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                            <span class="tw:w-full tw:lg:w-10/12 tw:px-2"><label>AE {{$loop->iteration}}:</label>{{' '.\App\audParseCase::parseAbr($auditor->titulo).' '.\App\audParseCase::parseNombre($auditor->nombre)}}</span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>

                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        @php $asistentes=""; @endphp
                                        @foreach($personas as $persona)
                                            @php
                                                $asistentes .= ($loop->index + 1) . '- ' .
                                                    $persona->nombre . ', ' .
                                                    $persona->jefe_descripcion .
                                                    ($persona->funciones != null ? ' ' . $persona->funciones . ';' : ';') .
                                                    "\n";
                                            @endphp
                                        @endforeach
                                        <h4>RESUMEN:</h4>
                                        <a href="#" data-id="resumenInforme"  data-field="resumen" class="btnInforme tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Guardar Resumen</a><br><br>
                                        <p>
                                            <textarea name="" id="resumenInforme" cols="80" rows="10">{{$informe->resumen}}
                                                @if (strlen($informe->resumen)<=800)
                                                    Se contó con la presencia de las siguientes personas:
                                                    {{$asistentes}}@endif
                                            </textarea>
                                        </p>
                                        <h4></h4>

                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <h4>OBSERVACIONES</h4>
                                        <a href="#" data-id="cierreInforme"  data-field="cierre" class="btnInforme tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Guardar Observaciones</a><br><br>
                                        <p>
                                            <textarea name="" id="cierreInforme" cols="80" rows="10">{{$informe->cierre}}</textarea>
                                        </p>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <h4>Reporte de no conformidades levantadas:</h4>
                                        @if(count($noConformidad)>0)
                                            @foreach($noConformidad as $registro)
                                                <h5>{{($loop->index+1)}} <strong>{{$registro->punto_proceso}}</strong> {{$registro->resultado}}</h5>
                                            @endforeach
                                        @else
                                            No se encontraron  No conformidades.
                                        @endif
                                    </div>
                                </div>

                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <h4>Fortalezas del sistema:</h4>
                                        @if(count($fortalezas)>0)
                                            @foreach($fortalezas as $registro)
                                                <h5>{{($loop->index+1)}} <strong>{{$registro->punto_proceso}}</strong> {{$registro->resultado}}</h5>
                                            @endforeach
                                        @else
                                            No se detectaron fortalezas.
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-full tw:px-2">
                                    <h4>Oportunidades:</h4>
                                    @if(count($oportunidades)>0)
                                        @foreach($oportunidades as $registro)
                                            <h5>{{($loop->index+1)}} <strong>{{$registro->punto_proceso}}</strong> {{$registro->resultado}}</h5>
                                        @endforeach
                                    @else
                                        No se detectaron oportunidades.
                                    @endif
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="seguimiento-acciones-informe">
                                <div class="tw:w-full tw:lg:w-full tw:px-2">
                                    <div class="informe-section-card">
                                        <div class="informe-section-header">
                                            <h4>
                                                <span class="fa fa-tasks"></span>
                                                Seguimiento de acciones
                                            </h4>
                                        </div>

                                        <div class="informe-section-body">
                                            @php
                                                $seguimientoAcciones = isset($seguimientoAcciones) ? collect($seguimientoAcciones) : collect();
                                                $returnUrlInforme = urlencode(url()->current() . '#seguimiento-acciones-informe');
                                                $mapaAuditoriasInforme = [];

                                                foreach ($auditorias as $indiceAuditoriaInforme => $auditoriaInforme) {
                                                    $mapaAuditoriasInforme[$auditoriaInforme->id_auditoria] = \Carbon\Carbon::parse($auditoriaInforme->fecha_i)->format('Y') . '-' . ($indiceAuditoriaInforme + 1);
                                                }
                                            @endphp

                                            @if($seguimientoAcciones->count() > 0)
                                                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tabla-seguimiento-informe tw-tabla tw-tabla-bordes tw-tabla-compacta">
                                                    <thead>
                                                    <tr class="info">
                                                        <th>#</th>
                                                        <th>Clave</th>
                                                        <th>Auditoría origen</th>
                                                        <th>Punto / proceso</th>
                                                        <th>Última nota</th>
                                                        <th>Estado</th>
                                                        <th>Detalle</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @foreach($seguimientoAcciones as $registro)
                                                        @php
                                                            $idResponsable = isset($registro->id_responsable) ? $registro->id_responsable : null;
                                                            $idClasificacion = isset($registro->id_clasificacion) ? (int) $registro->id_clasificacion : null;

                                                            $tipoNota = isset($registro->tipo_hallazgo)
                                                                ? $registro->tipo_hallazgo
                                                                : ($idClasificacion === 1 ? 'NC' : ($idClasificacion === 2 ? 'OM' : ''));

                                                            $claveNota = isset($registro->clave_nota) ? $registro->clave_nota : '';
                                                            $claveCompleta = trim($tipoNota . ' ' . $claveNota);

                                                            $ultimaNota = null;

                                                            if (isset($registro->nota_seguimiento) && trim($registro->nota_seguimiento) !== '') {
                                                                $ultimaNota = $registro->nota_seguimiento;
                                                            } elseif (isset($registro->ultima_nota) && trim($registro->ultima_nota) !== '') {
                                                                $ultimaNota = $registro->ultima_nota;
                                                            } elseif (isset($registro->observacion_seguimiento) && trim($registro->observacion_seguimiento) !== '') {
                                                                $ultimaNota = $registro->observacion_seguimiento;
                                                            }

                                                            $estadoCumplimiento = isset($registro->estado_cumplimiento) ? (int) $registro->estado_cumplimiento : null;

                                                            if ($estadoCumplimiento === 1) {
                                                                $estadoTexto = 'Cumplió';
                                                                $estadoClase = 'success';
                                                            } elseif ($estadoCumplimiento === 2) {
                                                                $estadoTexto = 'Cumplimiento parcial';
                                                                $estadoClase = 'warning';
                                                            } elseif ($estadoCumplimiento === 3) {
                                                                $estadoTexto = 'No cumplió';
                                                                $estadoClase = 'danger';
                                                            } elseif ($estadoCumplimiento === 0) {
                                                                $estadoTexto = 'Sin revisar';
                                                                $estadoClase = 'default';
                                                            } else {
                                                                $estadoTexto = isset($registro->semaforo_texto) ? $registro->semaforo_texto : 'Sin datos de seguimiento';
                                                                $estadoClase = isset($registro->semaforo_clase) ? $registro->semaforo_clase : 'default';
                                                            }

                                                            $idAuditoriaOrigen = isset($registro->id_auditoria_origen) ? (int) $registro->id_auditoria_origen : null;
                                                            $auditoriaOrigenTexto = $idAuditoriaOrigen && isset($mapaAuditoriasInforme[$idAuditoriaOrigen])
                                                                ? $mapaAuditoriasInforme[$idAuditoriaOrigen]
                                                                : ($idAuditoriaOrigen ? 'Auditoría ' . $idAuditoriaOrigen : 'No identificada');

                                                            $urlDetalle = null;

                                                            if ($idResponsable) {
                                                                if ($idClasificacion === 1 || $tipoNota === 'NC') {
                                                                    $urlDetalle = url('auditorias/lider_acciones/reporte_nc/' . $idResponsable) . '?modo_consulta=1&return_url=' . $returnUrlInforme;
                                                                } elseif ($idClasificacion === 2 || $tipoNota === 'OM') {
                                                                    $urlDetalle = url('auditorias/lider_acciones/reporte_om/' . $idResponsable) . '?modo_consulta=1&return_url=' . $returnUrlInforme;
                                                                }
                                                            }
                                                        @endphp

                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>

                                                            <td>
                                                                @if($claveCompleta !== '')
                                                                    <span class="clave-nota-informe">
                                                                            {{ $claveCompleta }}
                                                                        </span>
                                                                @else
                                                                    <span class="texto-muted-informe">Sin clave</span>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                    <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-brand-50 tw:text-brand-500">
                                                                        {{ $auditoriaOrigenTexto }}
                                                                    </span>
                                                            </td>

                                                            <td>
                                                                <strong>{{ isset($registro->punto_proceso) ? $registro->punto_proceso : 'No especificado' }}</strong>
                                                                @if(isset($registro->resultado) && trim($registro->resultado) !== '')
                                                                    <br>
                                                                    <span class="texto-muted-informe">
                                                                            {{ \Illuminate\Support\Str::limit($registro->resultado, 180) }}
                                                                        </span>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                <div class="ultima-nota-box">
                                                                    @if($ultimaNota)
                                                                        {!! nl2br(e($ultimaNota)) !!}
                                                                        @if(isset($registro->fecha_revision) && $registro->fecha_revision)
                                                                            <br>
                                                                            <small class="texto-muted-informe">
                                                                                Fecha de revisión: {{ $registro->fecha_revision }}
                                                                            </small>
                                                                        @endif
                                                                    @else
                                                                        <span class="texto-muted-informe">
                                                                                No hay datos para seguimiento.
                                                                            </span>
                                                                    @endif
                                                                </div>
                                                            </td>

                                                            <td>
                                                                    <span class="{{ ['success' => 'tw:bg-green-50 tw:text-green-700', 'info' => 'tw:bg-sky-50 tw:text-sky-600', 'warning' => 'tw:bg-amber-50 tw:text-amber-700', 'danger' => 'tw:bg-red-50 tw:text-red-600', 'primary' => 'tw:bg-brand-50 tw:text-brand-500'][$estadoClase] ?? 'tw:bg-gray-100 tw:text-gray-700' }} label-cumplimiento-informe tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium">
                                                                        {{ $estadoTexto }}
                                                                    </span>
                                                            </td>

                                                            <td>
                                                                @if($urlDetalle)
                                                                    <a href="{{ $urlDetalle }}"
                                                                       class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-1 tw:px-2 tw:py-1 tw:text-xs">
                                                                        <span class="fa fa-eye"></span>
                                                                        Ver detalle
                                                                    </a>
                                                                @else
                                                                    <span class="texto-muted-informe">
                                                                            Sin detalle disponible
                                                                        </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
</div>
                                            @else
                                                <div class="mensaje-sin-seguimiento tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-sky-200 tw:bg-sky-50 tw:text-sky-800">
                                                    No hay datos para seguimiento.
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-full tw:px-2">
                                    <h4>Conclusiones:</h4>
                                    <a href="#" data-id="conclusionesInforme"  data-field="conclusiones" class="btnInforme tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Guardar</a><br><br>
                                    <p>
                                        <textarea name="" id="conclusionesInforme" cols="80" rows="10">{{$informe->conclusiones}}</textarea>
                                    </p>
                                </div>
                            </div>
                        </div>
            </div>
            @endif
            @endforeach
        </div>
        {{-- (se quitó un </div> sobrante del original, que cerraba el área de contenido) --}}
    </main>

    <form  method="POST" role="form" id="form_informe" action="{{url('auditorias/informe/'.$informe->id_informe)}}">
        {{ csrf_field() }}
        {{ method_field('PUT')}}
        <input type="hidden" name="field" id="fieldInforme">
        <input type="hidden" name="value" id="valueInforme">

    </form>

    <x-panel.modal id="modal_export_programa" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Exportar programa de auditoría</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div class="persona-aprueba tw:mb-4">
                        <label>Persona que aprueba el programa</label>
                        <div class="tw:flex tw:items-center tw:gap-2">
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                    <label>
                                        <input class="aprueba_formato" type="radio" name="aprueba_formato" id="formato1" value="1">
                                        Coordinadora del SGOE
                                    </label>
                                </div>
                                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                    <label>
                                        <input class="aprueba_formato" type="radio" name="aprueba_formato" id="formato2" value="2">
                                        Director General
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                    <input type="button" class="btn-exportar tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Exportar"/>
                </div>
            
        
    </x-panel.modal>

    @foreach($auditorias as $auditoria)
        @if($auditoria->id_auditoria==$auditoria_id)

            <form id="form_edit_aud" class="" role="form" method="POST" action="{{url('auditorias/planes')}}/{{$auditoria->id_auditoria}}">
                <x-panel.modal id="modal_edit_aud" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                
                                <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Editar plan de auditorias</h4>
                            </div>
                            <div class="tw-modal-cuerpo">

                                @csrf
                                @method("PUT")
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="">Periodo</label>
                                            <div class="input-daterange tw:flex tw:w-full tw:items-stretch">
                                                <input type="text" class="periodo tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Fecha de inicio" name="fecha_i" value="{{Carbon::parse($auditoria->fecha_i)->format('d-m-Y')}}">
                                                <div class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:bg-gray-50 tw:px-3 tw:text-sm tw:text-gray-600">a</div>
                                                <input type="text" class="periodo tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Fecha de término" name="fecha_f" id="f_fin" value="{{Carbon::parse($auditoria->fecha_f)->format('d-m-Y')}}">
                                            </div>
                                        </div>
                                        {{--                                <label for="fecha_i">Fecha de inicio</label>--}}
                                        {{--                                <input id="fecha_i" name="fecha_i" type="date">--}}
                                        {{--                            </div>--}}
                                        {{--                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">--}}
                                        {{--                                <label for="fecha_f">Fecha de termino</label>--}}
                                        {{--                                <input id="fecha_f" name="fecha_f" type="date">--}}
                                    </div>
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="objetivo">Objetivo</label>
                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="objetivo" name="objetivo" placeholder="Objetivo del plan de auditoria">{{$auditoria->objetivo}}</textarea>
                                        </div>
                                        <div class="tw:mb-4">
                                            <label for="alcance">Alcance</label>
                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="alcance" name="alcance" placeholder="Alcance del plan de auditoria">{{$auditoria->alcance!=""?$auditoria->alcance:\App\audParseCase::parseProceso(implode(", ",$procesosE->pluck('des_proceso')->toArray()))}}</textarea>
                                        </div>
                                        <div class="tw:mb-4">
                                            <label for="criterios">Criterios</label>
                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="criterios" name="criterios" placeholder="Criterios del plan de auditoria">{{$auditoria->criterio}}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                                <input type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
                            </div>
                        
                    
                </x-panel.modal>
            </form>
        @endif

    @endforeach

    <script>
        $(document).ready(function () {
            $('.input-daterange').datepicker({
                autoclose: true,
                format: "dd-mm-yyyy",
                language: 'es'
            });
            $(".btnInforme").click(function(){
                var id=$(this).data('id');
                var field=$(this).data("field")
                $("#valueInforme").val($("#"+id).val())
                $("#fieldInforme").val(field);
                $("#form_informe").submit();
            });

            $(".btn_export").click(function () {
                programa=$(this).data('id');
                $('#modal_export_programa').modal('show');
            });

            $('.btn-exportar').click(function () {
                if ((typeof $('.aprueba_formato:checked').val() === "undefined")) {
                    // $('.formato-exportacion').addClass('has-error');
                    $('.persona-aprueba').addClass('has-error');
                }
                else{
                    var formato = $('.formato:checked').val();
                    var aprueba_formato = $('.aprueba_formato:checked').val();
                    window.open('{{url("auditorias/printinforme")}}/'+programa+'/'+aprueba_formato,'_blank',"fullscreen=yes");
                }
            });

        });

        $(".btn-edit-plan").click(function () {
            var data=$(this).data('all');
            $("#modal_edit_aud").modal('show');
        });

        $('[data-toggle="tooltip"]').tooltip();



    </script>
@endsection

