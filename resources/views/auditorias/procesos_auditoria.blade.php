<?php
/**
 * Created by PhpStorm.
 * User: Juan Carlos
 * Date: 09/07/2019
 * Time: 08:16 PM
 */
?>
@extends('layouts.panel')
@section('title','Planes del programa')
@include('partials.panel.recursos_app', ['datepicker' => true])
@section('content')
    @if(Session::get('errors'))
        <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" role="alert">
            @foreach(Session::get('errors')->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>
    @endif
    <main class="tw-pantalla tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-6/12 tw:lg:ml-[25%] tw:px-2">
                @if (session()->has('flash_notification.message'))
                    <x-panel.alerta class="tw:mb-4" :tipo="['success' => 'exito', 'danger' => 'error', 'warning' => 'advertencia'][session('flash_notification.level')] ?? 'info'">{!! session('flash_notification.message') !!}</x-panel.alerta>
                @endif
            </div>
        </div>
        <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
            <nav aria-label="Ruta de navegación" class="tw:mb-5 tw:flex tw:flex-wrap tw:items-center tw:gap-x-2 tw:gap-y-1 tw:text-sm tw:text-gray-500">
                <span class="fa fa-arrow-right tw:text-brand-500"></span>
                <a class="tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{url('/auditorias/programas')}}">Programas de auditoría</a>
                <span class="fa fa-chevron-right tw:text-[10px] tw:text-gray-400"></span>
                @foreach($programas as $programa)
                    <a class="tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{url('/auditorias/programas')}}/{{$programa->id_programa}}">Detalle del programa</a>
                @endforeach
                <span class="fa fa-chevron-right tw:text-[10px] tw:text-gray-400"></span>
                <span class="tw:text-gray-800 tw:dark:text-white/90">Planes del programa</span>
            </nav>
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white" id="planesExistentes">
                @foreach($programas as $programa)
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                        @if($esLider)
                            @if(sizeof($auditorias) < 5)
                                <a href="#" class="btn_add_plan" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="fa fa-plus tw:float-right" data-toggle="tooltip" title="Agregar plan"></span></a>
                            @endif
                            {{--@if($porcentaje==100) cancelacion del porcentaje --}}
                            @if($programa->active==1)
                                <a href="#" class="btn_export" data-id="{{$programa->id_programa}}"><span class="fa fa-download tw:float-right" data-toggle="tooltip" title="Exportar Programa">&nbsp</span></a>
                            @endif

                            {{--validar si es UIPPE--}}

                        @else
                            <!-- Example single danger button -->


                            @if($programa->active==1)
                                {{-- Menú desplegable de Bootstrap → <details> (el puente no tiene dropdowns) --}}
                                <details class="tw:group tw:relative tw:float-right">
                                    <summary class="tw:inline-flex tw:cursor-pointer tw:list-none tw:items-center tw:justify-center tw:gap-2 tw:rounded-lg tw:bg-white tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:[&::-webkit-details-marker]:hidden" id="dropdownMenu1" aria-haspopup="true">
                                        Acciones
                                        <span class="fa fa-chevron-down tw:text-xs tw:transition-transform tw:group-open:rotate-180" aria-hidden="true"></span>
                                    </summary>
                                    <ul class="tw:absolute tw:right-0 tw:z-30 tw:mt-2 tw:flex tw:w-56 tw:flex-col tw:gap-2 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-3 tw:shadow-theme-lg tw:dark:border-gray-800 tw:dark:bg-gray-900" aria-labelledby="dropdownMenu1">
                                        <li>
                                            <form action="{{url("auditorias/validar_programa",$programa->id_programa)}}" method="post">
                                                @csrf
                                                <input type="hidden" value="3" name="statePrograma">
                                                <button type="submit" class="tw:inline-flex tw:w-full tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Aceptar programa</button>
                                            </form>
                                        </li>
                                        <li>
                                            <a href="#" class="btn_send_programa tw:inline-flex tw:w-full tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-id="{{$programa->id_programa}}" data-value="{{$programa->justificacion}}">Rechazar programa</a>
                                        </li>
                                    </ul>
                                </details>
                             @endif
                        @endif

                        <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Planes de auditoría para el programa
                            <strong>
                                {{\Carbon\Carbon::parse($programa->fecha_i)->locale('es')->translatedFormat('F')}} - {{\Carbon\Carbon::parse($programa->fecha_f)->locale('es')->translatedFormat('F Y')}}
                            </strong>
                        </h3>
                    </div>
                    <div class="tw:p-5 tw:sm:p-6">
                    @if(sizeof($auditorias) > 0)
                        <div class="tw:mb-3 tw:flex tw:h-5 tw:w-full tw:overflow-hidden tw:rounded-full tw:bg-gray-200" id="porcentaje">
                            <div class="tw:flex tw:h-full tw:items-center tw:justify-center tw:bg-brand-500 tw:text-xs tw:font-medium tw:text-white" role="progressbar" aria-valuenow="{{$porcentaje}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$porcentaje}}%;">
                                {{$porcentaje}}% de los procesos
                            </div>
                        </div>
{{--                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="planes">--}}
                        @foreach($auditorias as $data_auditoria)
                            @if(($loop->iteration%3)==0)
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            @endif
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                                            @if($esLider)
                                                <a href="#" class="btn_delete_plan" data-id="{{$data_auditoria->id_auditoria}}"><span class="fa fa-trash tw:float-right" data-toggle="tooltip" title="Eliminar Plan de Auditoria"></span></a>
                                                <a href="{{url('auditorias/procesos_plan/')}}/{{$data_auditoria->id_auditoria}}"><span class="fa fa-cog tw:float-right" data-toggle="tooltip" title="Editar procesos del Plan">&nbsp</span></a>
                                            @endif
                                            <a href="{{url('auditorias/planes/')}}/{{$data_auditoria->id_auditoria}}" data-toggle="tooltip" title="Ver detalles del Plan">{{date('Y',strtotime($data_auditoria->fecha_i)).'-'.$loop->iteration}}</a>
                                            {{'('.count($data_auditoria->getData($data_auditoria->id_auditoria))}}{{count($data_auditoria->getData($data_auditoria->id_auditoria))>1?' elementos)':' elemento)'}}
                                        </div>
                                        <div class="tw:p-5 tw:sm:p-6">
                                            @foreach($data_auditoria->getData($data_auditoria->id_auditoria) as $proceso)
                                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                    <div class="tw:w-full tw:px-2 {{$esLider?'tw:lg:w-9/12':''}}">
                                                        <li>
                                                            <strong>{{$proceso->clave.' '}}</strong>
                                                            {{\App\audParseCase::parseProceso($proceso->des_proceso)}}
                                                        </li>
                                                    </div>
                                                    @if($esLider)
                                                    <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                                        @if($proceso->observacion)
                                                            <a href="#" class="delete-observacion tw:float-right tw:text-red-600" data-id="{{$proceso->id_auditoria_proceso}}" data-toggle="tooltip" title="Eliminar observación del proceso {{$proceso->clave}}"><span class="fa fa-trash"></span></a>
                                                            <a href="#" class="edit-observacion tw:float-left" data-id="{{$proceso->id_auditoria_proceso}}" data-obs="{{$proceso->observacion}}" data-toggle="tooltip" title="Editar observación del proceso {{$proceso->clave}}"><span class="fa fa-pencil"></span></a>
                                                        @else
                                                            <a href="#" class="add-observacion tw:float-right tw:text-green-600" data-id="{{$proceso->id_auditoria_proceso}}"  data-toggle="tooltip" title="Agregar observación al proceso {{$proceso->clave}}"><span class="fa fa-pencil-square-o"></span></a>
                                                        @endif
                                                    </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @if(sizeof($auditorias) > 0 AND ($loop->iteration%3)==0)
                            </div>
                            @endif
                        @endforeach
                    @else
                        <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700 tw:px-2"role="alert">No se han encontrado planes de auditoria para este programa</div>
                    @endif
                        </div>
                @endforeach
            </div>
        {{-- (el original cerraba la tarjeta dentro del @foreach; con un solo programa el resultado es el mismo) --}}
        </div>

    </main>

    <x-panel.modal id="modal_add_plan" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel" class="bs-example-modal-lg">
        
            <form method="post" action="{{url('auditorias/planes')}}" id="form_add_plan">
                @csrf
                
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar plan al programa</h4>
                    </div>
                    <div class="moda-body">
                        <div class="tw:w-full tw:lg:w-full tw:px-2">
                            <label for="">Periodo para evaluar los procesos</label>
                            <div class="input-daterange tw:flex tw:w-full tw:items-stretch">
                                <input type="text" class="periodo1 tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Fecha de inicio" name="fecha_de_inicio">
                                <div class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:bg-gray-50 tw:px-3 tw:text-sm tw:text-gray-600">a</div>
                                <input type="text" class="periodo2 tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Fecha de término" name="fecha_de_fin">
                            </div>
                        </div>

                        <div class="tw:w-full tw:lg:w-full tw:px-2">
                            <hr>
                            <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                <label for="">Seleccione los procesos a auditar en el periodo establecido</label>
                                <br>
                                <p><label for="" class="tw:bg-green-100 tw:text-green-600">Procesos que ya han sido agregados a un plan</label></p>
                            </div>
                            <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                <a href="#!" class="all_selection tw:float-right">Seleccionar todo <span class="fa fa-floppy-o"></span></a>
                                <a href="#!" class="clear_selection tw:float-left">Limpiar selección <span class="fa fa-eraser"></span></a>
                            </div>

                            <hr>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-bordes">
                                    <tbody>
                                    <tr>
                                        @foreach($procesos as $proceso)
                                            <td class="tw:lg:w-4/12">
                                                @if(\Illuminate\Support\Facades\Session::get('procesos'))
                                                    <label class="{{in_array($proceso->id_proceso,$procesosEnAgenda)==true?'bg-success text-success':''}} tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input type="checkbox" data-id="{{$proceso->id_proceso}}" {{in_array($proceso->id_proceso,\Illuminate\Support\Facades\Session::get('procesos'))==true?'checked':''}}><strong>{{$proceso->clave.' '}}</strong>{{\App\audParseCase::parseProceso($proceso->des_proceso)}}</label>
                                                @else
                                                    <label class="{{in_array($proceso->id_proceso,$procesosEnAgenda)==true?'bg-success text-success':''}} tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input type="checkbox" data-id="{{$proceso->id_proceso}}"><strong>{{$proceso->clave.' '}}</strong>{{\App\audParseCase::parseProceso($proceso->des_proceso)}}</label>
                                                @endif
                                            </td>
                                            @if(($loop->iteration%3)==0)
                                    </tr>
                                    @endif
                                    @endforeach
                                    </tbody>
                                </table>
</div>
                            </div>
                        </div>
                        <input name="random" type="text" value="{{\Illuminate\Support\Str::random(20)}}" hidden>
                        <input name="procesos" id="procesos" type="text" value="" hidden>
                        <input type="text" name="id_programa" value="{{$programa->id_programa}}" hidden>
                    </div>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="guardar_plan tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Guardar</button>
                    </div>
                
            </form>
        
    </x-panel.modal>

    <x-panel.modal id="modal_export_programa" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Exportar programa de auditoría</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div class="formato-exportacion tw:mb-4">
                        <label>Formato de exportación</label>

                        <div class="tw:flex tw:items-center tw:gap-2">
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                    <label>
                                        <input class="formato" type="radio" name="formato" id="formato1" value="1">
                                        Excel
                                    </label>
                                </div>
                                <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                    <label>
                                        <input class="formato" type="radio" name="formato" id="formato2" value="2">
                                        PDF
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
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

    {{--<x-panel.modal id="modal_print_programa" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Imprimir programa de auditoría</h4>
                </div>
                    <div class="tw-modal-cuerpo">
                        <div class="tw:mb-4">
                            <label>Persona que aprueba el programa</label>
                            <select id="aprueba" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                <option value="" selected disabled="true">Selecciona...</option>
                                <option value="1">Coordinador del Sistema de Gestión de la Calidad</option>
                                <option value="2">Director General</option>
                            </select>
                        </div>
                    </div>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input type="button" class="btn-print tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Ok"/>
                    </div>
            
        
    </x-panel.modal>
    <x-panel.modal id="modal_print_excel" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Generar archivo Excel del programa de auditoría</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div class="tw:mb-4">
                        <label>Persona que aprueba el programa</label>
                        <select id="apruebaExcel" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                            <option value="" selected disabled="true">Selecciona...</option>
                            <option value="1">Coordinadora del Sistema de Gestión de la Calidad</option>
                            <option value="2">Director General</option>
                        </select>
                    </div>
                </div>
                <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                    <input type="button" class="btn-save tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Ok"/>
                </div>
            
        
    </x-panel.modal>--}}

    <x-panel.modal id="modal_add_obs" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
        
            <form id="form-add-obs" method="POST" action="">
                @csrf
                
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar observación al proceso</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <div class="tw:mb-4">
                            <label>Observación</label>
                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="observacion" rows="5" placeholder="Texto de la observación"></textarea>
                        </div>
                        {{--                        <input type="text" hidden name="id_auditoria_proceso" id="id_auditoria_proceso">--}}

                    </div>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Ok"/>
                    </div>
                
            </form>
        
    </x-panel.modal>

    <x-panel.modal id="modal_edit_obs" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
        
            <form id="form-edit-obs" method="POST" action="">
                @csrf
                
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Editar observación del proceso</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <div class="tw:mb-4">
                            <label>Observación</label>
                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="observacion" rows="5" placeholder="Texto de la observación" id="observacion"></textarea>
                        </div>
                    </div>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Ok"/>
                    </div>
                
            </form>
        
    </x-panel.modal>

    <form  method="POST" role="form" id="form_delete_plan">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
    </form>

    <form  method="POST" role="form" id="form_send_programa">
        <input type="hidden" value="2" name="statePrograma">
        <input type="hidden" value="{{$programa->observaciones}}" id="observacion_programa" name="observaciones">
        <input type="hidden" value="{{$programa->justificacion}}" id="justificacion_programa" name="justificacion">
        {{ csrf_field() }}
    </form>

    <script>
        $(document).ready(function () {
            var programa;
            var errores='{{\Illuminate\Support\Facades\Session::exists('errors')?'true':'false'}}';
            console.log(errores)
            if (errores=='true'){
                $('#planesExistentes').fadeOut();
                $('#agregarPlan').fadeIn();
            }
            else{
                $('#agregarPlan').fadeOut();
            }
            @if(Session::forget('errors'))@endif
{{-- ************************************************************************************************************** --}}

            $(".btn_export").click(function () {
                programa=$(this).data('id');
                $('#modal_export_programa').modal('show');
            });

            $('.btn-exportar').click(function () {
                if ((typeof $('.formato:checked').val() === "undefined") || (typeof $('.aprueba_formato:checked').val() === "undefined")) {
                    $('.formato-exportacion').addClass('has-error');
                    $('.persona-aprueba').addClass('has-error');
                }
                else{
                    var formato = $('.formato:checked').val();
                    var aprueba_formato = $('.aprueba_formato:checked').val();
                    if (formato == 1) window.open('{{url('auditorias/printExcel')}}/'+programa+'/'+aprueba_formato,'_blank',"fullscreen=yes");
                    else window.open('{{url('auditorias/printPrograma')}}/'+programa+'/'+aprueba_formato,'_blank',"fullscreen=yes");
                }
            });

            $('.formato').change(function () {
                $('.formato-exportacion').removeClass('has-error');
            });

            $('.aprueba_formato').click(function () {
                $('.persona-aprueba').removeClass('has-error');
            });

{{-- ************************************************************************************************************** --}}

            {{--$(".btn_print_plan").click(function () {--}}
            {{--    programa=$(this).data('id');--}}
            {{--    $('#modal_print_programa').modal('show');--}}
            {{--});--}}
            {{--$(".btn_print_excel").click(function () {--}}
            {{--    programa=$(this).data('id');--}}
            {{--    $('#modal_print_excel').modal('show');--}}
            {{--});--}}
            {{--$('.btn-print').click(function () {--}}
            {{--    window.open('{{url('auditorias/printPrograma')}}/'+programa+'/'+$('#aprueba').val(),'_blank',"fullscreen=yes");--}}
            {{--});--}}
            {{--$('.btn-save').click(function () {--}}
            {{--    window.open('{{url('auditorias/printExcel')}}/'+programa+'/'+$('#apruebaExcel').val(),'_blank',"fullscreen=yes");--}}
            {{--});--}}
            
            $('.btn_delete_plan').click(function () {
                var id=$(this).data('id');
                swal({
                    title: "Seguro que desea eliminar?",
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Aceptar',
                })
                .then((result) => {
                    if (result.value) { //Si presionas boton aceptar
                        $("#form_delete_plan").attr("action","/auditorias/planes/"+id)
                        $("#form_delete_plan").submit();
                    }
                    else if (result.dismiss === Swal.DismissReason.cancel) { //Si presionas boton cancelar
                        swal.close()
                    }
                });




            });
            $(".btn_send_programa").click(function(){
                var value=$(this).data('value');
                var id=$(this).data('id');
                swal({
                    title: "¿Seguro que desea rechazar el programa?",
                    text: value,
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Aceptar',
                    input: 'textarea',
                    inputLabel: 'Observación',
                    inputPlaceholder: 'Escriba aquí su observación...',
                    inputAttributes: {
                        'aria-label': 'Escriba aquí su observación'
                    },
                    inputValue: '{{$programa->observaciones??""}}',

                    inputValidator: (value) => {
                        if (!value) {
                            return 'Necesitas escribir una observación!'
                        }
                    }
                })
                    .then((result) => {
                        if (result.value) { //Si presionas boton aceptar

                            $("#observacion_programa").val(result.value)
                            $("#form_send_programa").attr("action","/auditorias/validar_programa/"+id)
                            $("#form_send_programa").submit();
                        }
                        else if (result.dismiss === Swal.DismissReason.cancel) { //Si presionas boton cancelar
                            swal.close()
                        }


                    });
            });

            $('.guardar_plan').click(function () {
                var seleccionados=[];
                var datos=[];
                $('input:checkbox:checked').each(function () {
                    seleccionados.push($(this).data('id'));
                });
                $('#procesos').val(JSON.stringify(seleccionados))
                // datos.push({'data' : $('#form_add_plan').serializeArray()});
                // datos.push({'procesos' : seleccionados});
                // console.log($('#form_add_plan').serializeArray())
                {{--$.get('{{url('auditorias/planes/create')}}',{datos:datos});--}}
                $('#form_add_plan').submit();
            });

            $('.clear_selection').click(function () {
                $('input:checkbox').each(function () {
                    $(this).prop("checked", false);
                });
            });

            $('.all_selection').click(function () {
                $('input:checkbox').each(function () {
                    $(this).prop("checked", true);
                });
            });


            $('.add-observacion').click(function () {
                $('#form-add-obs').attr('action','{{url('auditorias/add_observacion')}}/'+$(this).data('id'));
                // $('#id_auditoria_proceso').attr('value',$(this).data('id'))
                $("#modal_add_obs").modal('show');
            });

            $('.edit-observacion').click(function () {
                $('#form-edit-obs').attr('action','{{url('auditorias/edit_observacion')}}/'+$(this).data('id'));
                $('#observacion').html($(this).data('obs'));
                $("#modal_edit_obs").modal('show');
            });

            $('.delete-observacion').click(function () {
                swal({
                    title: "Seguro que desea eliminar?",
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Aceptar',
                })
                    .then((result) => {
                        if (result.value) { //Si presionas boton aceptar
                            $.get("{{url('/auditorias/delete_observacion')}}/"+$(this).data('id'),function (data) {
                                location.reload();
                            })
                        }
                        else if (result.dismiss === Swal.DismissReason.cancel) { //Si presionas boton cancelar
                            swal.close()
                        }
                    });

            });


            @foreach($programas as $programa)
            $('.input-daterange').datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy',
                language : 'es',
                startView: 1,
                startDate: '{{\Carbon\Carbon::parse($programa->fecha_i)->format('d-m-Y')}}',
                endDate: '{{\Carbon\Carbon::parse($programa->fecha_f)->format('d-m-Y')}}'
            });
            @endforeach


            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
@endsection