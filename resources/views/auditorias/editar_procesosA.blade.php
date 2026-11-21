<?php
/**
 * Created by PhpStorm.
 * User: Juan Carlos
 * Date: 09/07/2019
 * Time: 08:16 PM
 */
?>
@extends('layouts.panel')
@section('title','Editar procesos del plan')
@include('partials.panel.recursos_app')
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
                <a class="tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{url('/auditorias/programas')}}/{{\Illuminate\Support\Facades\Session::get('id_programa')}}">Detalles del programa</a>
                <span class="fa fa-chevron-right tw:text-[10px] tw:text-gray-400"></span>
                <a class="tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{url('/auditorias/programas')}}/{{\Illuminate\Support\Facades\Session::get('id_programa')}}/edit">Planes del programa</a>
                <span class="fa fa-chevron-right tw:text-[10px] tw:text-gray-400"></span>
                <span class="tw:text-gray-800 tw:dark:text-white/90">Editar procesos del plan</span>
            </nav>
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                @foreach($auditorias as $auditoria)
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                        <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Editar procesos del plan de auditoría
                            <strong>
                                @if(\Carbon\Carbon::parse($auditoria->fecha_i)->locale('es')->translatedFormat('F')!=\Carbon\Carbon::parse($auditoria->fecha_f)->locale('es')->translatedFormat('F'))
                                    {{\Carbon\Carbon::parse($auditoria->fecha_i)->locale('es')->translatedFormat('F')}} - {{\Carbon\Carbon::parse($auditoria->fecha_f)->locale('es')->translatedFormat('F Y')}}
                                @else
                                    {{\Carbon\Carbon::parse($auditoria->fecha_f)->locale('es')->translatedFormat('F Y')}}
                                @endif
                            </strong>
                        </h3>
                    </div>
                    <div class="tw:p-5 tw:sm:p-6">
{{--                        <a href="#headingDisponibles" class="nuevos_procesos tw:float-right" data-toggle="tooltip" title="Agregar procesos"><span class="fa fa-plus"></span></a>--}}
                        <div id="asignados">

{{--                                <tbody>--}}
{{--                                <tr>--}}
{{--                                    @if($i=0)@endif--}}
{{--                                    @foreach($procesos as $proceso)--}}
{{--                                        @if(in_array($proceso->id_proceso,$procesosExistentes))--}}
{{--                                            @if($i++)@endif--}}
{{--                                            <td class="tw:lg:w-4/12">--}}
{{--                                                <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="existentes" type="checkbox" data-id="{{$proceso->id_proceso}}" checked>{{ucfirst(mb_strtolower($proceso->des_proceso,'utf-8'))}}</label>--}}
{{--                                            </td>--}}
{{--                                        @endif--}}

{{--                                        @if($i==3)--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                @if($i=0)@endif--}}
{{--                                @endif--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}


                        </div>

                        <div class="" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4" role="tab" id="headingExisten">
                                    <h5 class="tw:text-base tw:font-medium tw:text-gray-800" role="button" data-toggle="collapse" class="btn_collapse_factor" data-parent="#accordion" href="#collapseExisten"  aria-expanded="true" aria-controls="collapseExisten">
                                        Procesos asignados
                                    </h5>
                                </div>
                                <div id="collapseExisten" class="collapse" role="tabpanel" aria-labelledby="headingExisten">
                                    <div class="tw:p-5 tw:sm:p-6">
                                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-bordes">
                                            <tbody>
                                            <tr>
                                                @foreach($procesosE as $proceso)
                                                    <td class="tw:lg:w-4/12">
                                                        <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="existentes" type="checkbox" data-id="{{$proceso->id_auditoria_proceso}}" checked><strong>{{$proceso->clave.' '}}</strong>{{\App\audParseCase::parseProceso($proceso->des_proceso)}}</label>
                                                    </td>
                                                    @if(($loop->iteration%3)==0)
                                            </tr>
                                            <tr>
                                                @endif
                                                @endforeach
                                            </tr>
                                            </tbody>
                                        </table>
</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4" role="tab" id="headingDisponibles">
                                    <h5 class="tw:text-base tw:font-medium tw:text-gray-800" role="button" data-toggle="collapse" class="btn_collapse_factor" data-parent="#accordion" href="#collapseDisponibles"  aria-expanded="true" aria-controls="collapseDisponibles">
                                        Procesos para asignar
                                    </h5>
                                </div>
                                <div id="collapseDisponibles" class="collapse" role="tabpanel" aria-labelledby="headingDisponibles">
                                    <div class="tw:p-5 tw:sm:p-6">
                                        <p><label for="" class="tw:bg-green-100 tw:text-green-600">Procesos asignados en otros planes</label></p>
                                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-bordes">
                                            <tbody>
                                            <tr>
                                                @foreach($procesos as $proceso)
                                                    <td class="tw:lg:w-4/12">
                                                        <label class="{{in_array($proceso->id_proceso,$procesosEnAgenda)?'bg-success text-success':''}} tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="seleccionable" type="checkbox" data-id="{{$proceso->id_proceso}}"><strong>{{$proceso->clave.' '}}</strong>{{\App\audParseCase::parseProceso($proceso->des_proceso)}}</label>
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
                            </div>
                        </div>
                        <button class="guardar tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Guardar</button>
                    </div>
                    <form id="form_edit_procesos" action="{{url('auditorias/procesos_plan')}}/{{$auditoria->id_auditoria}}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" value="" hidden id="eliminar" name="eliminar">
                        <input type="text" value="" hidden id="agregar" name="agregar">
                    </form>
                @endforeach
            </div>
        </div>
    </main>



    <form  method="POST" role="form" id="form_delete_plan">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
    </form>

    <script>
        $(document).ready(function () {
            $('.guardar').click(function () {
                var eliminar=[];
                var agregar=[];
                $('.existentes:checkbox').each(function () {
                    if ($(this).prop('checked')==false){
                        eliminar.push($(this).data('id'));
                    }
                });
                $('.seleccionable:checkbox:checked').each(function () {
                    agregar.push($(this).data('id'));
                });
                if (eliminar.length>0 || agregar.length>0) {
                    swal({
                        title: "¿Seguro que desea realizar las modificaciones?",
                        allowOutsideClick: false,
                        showCancelButton: true,
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Aceptar',
                    })
                    .then((result) => {
                        if (result.value) { //Si presionas boton aceptar
                            $('#eliminar').val(JSON.stringify(eliminar));
                            $('#agregar').val(JSON.stringify(agregar));
                            $('#form_edit_procesos').submit();
                        }
                        else if (result.dismiss === Swal.DismissReason.cancel) { //Si presionas boton cancelar
                            swal.close()
                        }
                    })
                }
                else{
                    swal({
                        title: "No se han realizado modificaciones",
                        buttons: true,
                        dangerMode: true,
                    });
                }
            });


            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
@endsection