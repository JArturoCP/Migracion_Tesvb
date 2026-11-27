<?php
/**
 * Created by PhpStorm.
 * User: Juan Carlos
 * Date: 09/07/2019
 * Time: 08:16 PM
 */
?>
@extends('layouts.panel')
@section('title','Agendar auditorias')
@include('partials.panel.recursos_app', ['datepicker' => true, 'ordenable' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Agendar auditorías" :migas="['Sistema de gestión de calidad' => null]" />
    <style>
        .elementos > div {
            width: 100% !important;
        }
    </style>
    @if(Session::get('errors'))
        <x-panel.alerta tipo="error" class="tw:mb-4">
            @foreach(Session::get('errors')->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </x-panel.alerta>
        @if(Session::forget('errors'))@endif
    @endif
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                @if (session()->has('flash_notification.message'))
                    <x-panel.alerta :tipo="['success' => 'exito', 'danger' => 'error', 'warning' => 'advertencia'][session('flash_notification.level')] ?? 'info'" class="tw:mb-4">{!! session('flash_notification.message') !!}</x-panel.alerta>
                @endif
            </div>
        </div>
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
{{--                @foreach($programas as $programa)--}}
{{--                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">--}}
{{--                        <a href="#" class="btn_add_aud"><span class="fa fa-plus tw:float-right" data-toggle="tooltip" title="Agregar auditoria"></span></a>--}}
{{--                        <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Auditorias del programa--}}
{{--                            <strong>--}}
{{--                                {{\Carbon\Carbon::parse($programa->fecha_i)->locale('es')->translatedFormat('F')}} - {{\Carbon\Carbon::parse($programa->fecha_f)->locale('es')->translatedFormat('F Y')}}--}}
{{--                            </strong>--}}
{{--                        </h3>--}}
{{--                    </div>--}}
{{--                    <div class="tw:p-5 tw:sm:p-6">--}}

{{--                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" ondrop="drop(event)" ondragover="allowDrop(event)">--}}
{{--                            <br>--}}
{{--                            @foreach($procesos as $proceso)--}}
{{--                                <div id="{{$proceso->id_proceso}}" class="tw:w-full tw:lg:w-3/12 tw:px-2" draggable="true" ondragstart="drag(event)">--}}
{{--                                    <div  class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" >{{$proceso->des_proceso}}</div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}




{{--                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">--}}
{{--                            @foreach($auditorias as $data_auditoria)--}}
{{--                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">--}}
{{--                                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">--}}
{{--                                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">--}}
{{--                                            <a href="#" class="btn_delete_plan" data-id="{{$data_auditoria->id_auditoria}}"><span class="fa fa-trash tw:float-right" data-toggle="tooltip" title="Eliminar Plan de Auditoria"></span></a>--}}
{{--                                            <a href="{{url('sgc/ver_plan_auditoria/')}}/{{$data_auditoria->id_auditoria}}">{{date('Y',strtotime($data_auditoria->fecha_i)).'-'.$loop->iteration}}</a>--}}
{{--                                            --}}{{--<p>{{$data_auditoria->fecha_i}}  al  {{$data_auditoria->fecha_f}}</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="elementos tw:p-5 tw:sm:p-6 tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" data-agenda="{{$data_auditoria->id_auditoria}}" ondrop="drop(event)" ondragover="allowDrop(event)">--}}

{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                        <input type="button" id="ver_elementos" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Ver"/>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
                @foreach($programas as $programa)
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                        <a href="#" class="btn_add_aud tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><span class="fa fa-plus tw:float-right" data-toggle="tooltip" title="Agregar auditoria"></span></a>
                        <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Auditorias del programa
                            <strong>
                                {{\Carbon\Carbon::parse($programa->fecha_i)->locale('es')->translatedFormat('F')}} - {{\Carbon\Carbon::parse($programa->fecha_f)->locale('es')->translatedFormat('F Y')}}
                            </strong>
                        </h3>
                    </div>
                    <div class="tw:p-5 tw:sm:p-6">
                        <div class="droptrue tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="sortable1">
                            @foreach($procesos as $proceso)
                                <div id="{{$proceso->id_proceso}}" class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                    <div  class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" >{{$proceso->des_proceso}}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            @foreach($auditorias as $data_auditoria)
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                                            <a href="#" class="btn_delete_plan tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" data-id="{{$data_auditoria->id_auditoria}}"><span class="fa fa-trash tw:float-right" data-toggle="tooltip" title="Eliminar Plan de Auditoria"></span></a>
                                            <a class="tw:text-brand-500 tw:hover:underline" href="{{url('sgc/ver_plan_auditoria/')}}/{{$data_auditoria->id_auditoria}}">{{date('Y',strtotime($data_auditoria->fecha_i)).'-'.$loop->iteration}}</a>
                                            {{--<p>{{$data_auditoria->fecha_i}}  al  {{$data_auditoria->fecha_f}}</p>--}}
                                        </div>
                                        <div id="sortable2" class="elementos droptrue tw:p-5 tw:sm:p-6 tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" data-agenda="{{$data_auditoria->id_auditoria}}" ondrop="drop(event)" ondragover="allowDrop(event)">

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <input type="button" id="ver_elementos" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Guardar"/>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <form action="{{url("/sgc/auditorias")}}" method="POST" id="form_ag_aud" class="" role="form">
        <x-panel.modal id="modal_add_aud" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar auditoria al programa</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        {{ csrf_field() }}
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <label for="">Periodo</label>
                                <div class="input-daterange tw:flex tw:w-full tw:items-stretch">
                                    <input type="text" class="periodo tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Fecha de inicio" name="fecha_i">
                                    <div class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-3 tw:text-sm tw:text-gray-600 tw:dark:text-gray-400">a</div>
                                    <input type="text" class="periodo tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Fecha de termino" name="fecha_f">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Guardar"/>
                    </div>
                </x-panel.modal>
    </form>



    <script>
        $(document).ready(function () {
            $(".btn_add_aud").click(function () {
                $("#modal_add_aud").modal('show');
            });


            @foreach($programas as $programa)
            $('.input-daterange').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                language : 'es',
                startDate : '{{$programa->fecha_i}}',
                startView: 1,
                maxViewMode: 1
            });

            @endforeach

            $('[data-toggle="tooltip"]').tooltip();

            $("#ver_elementos").click(function () {
                arreglo=[];
                $(".elementos").each(function () {
                    var agenda=$(this).data('agenda');
                    $(this).children().each(function () {
                        arreglo.push({
                            'agenda': agenda,
                            'proceso': $(this).attr('id')
                        });
                    })
                });
                console.log(arreglo)
                var t_proceso ="{{sizeof($procesos)}}";
                if(arreglo.length<t_proceso){
                    swal({
                        title: "Faltan procesos por asignar",
                        icon: 'error',
                        cancelButton: false,
                        dangerMode: true,
                    })
                }
                else{
                    swal({
                        title: "Guardando",
                        icon: 'success',
                        cancelButton: false,
                    }).then(function () {
                        $.ajax({
                            type: "GET",
                            url: "{{url('sgc/procesoAgenda/create')}}",
                            data: {arreglo:arreglo},
                            success: function(response) {
                                swal(
                                    "Sccess!",
                                    "Your note has been saved!",
                                    "success"
                                )
                            },
                            failure: function (response) {
                                swal(
                                    "Internal Error",
                                    "Oops, your note was not saved.", // had a missing comma
                                    "error"
                                )
                            }
                        });
                    })
                }
            });
        })

        $( function() {
            $( "div.droptrue" ).sortable({
                connectWith: "div",
                cursor: 'grabbing',
                placeholder: "alert alert-success",
                forcePlaceholderSize: true
            });

            $( "#sortable1, #sortable2, #sortable3" ).disableSelection();
        } );
    </script>
</div>
@endsection