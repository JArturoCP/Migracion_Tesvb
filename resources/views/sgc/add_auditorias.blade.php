<?php
/**
 * Created by PhpStorm.
 * User: Juan Carlos
 * Date: 09/07/2019
 * Time: 08:16 PM
 */
?>
@extends('layouts.panel')
@include('partials.panel.recursos_app', ['datepicker' => true, 'ordenable' => true])
@section('title','Agendar auditorias')
@section('content')
    <style>
        .elementos > div {
            width: 100% !important;
        }
    </style>
    @if(Session::get('errors'))
        <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" role="alert">
            @foreach(Session::get('errors')->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>
        @if(Session::forget('errors'))@endif
    @endif
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-6/12 tw:lg:ml-[25%] tw:px-2">
                @if (session()->has('flash_notification.message'))
                    <div class="alert alert-{{ session('flash_notification.level') }} tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm">
                        <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {!! session('flash_notification.message') !!}
                    </div>
                @endif
            </div>
        </div>
        <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
{{--                @foreach($programas as $programa)--}}
{{--                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">--}}
{{--                        <a href="#" class="btn_add_aud"><span class="fa fa-plus tw:float-right" data-toggle="tooltip" title="Agregar auditoria"></span></a>--}}
{{--                        <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">Auditorias del programa--}}
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
{{--                                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">--}}
{{--                                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">--}}
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
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                        <a href="#" class="btn_add_aud"><span class="fa fa-plus tw:float-right" data-toggle="tooltip" title="Agregar auditoria"></span></a>
                        <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">Auditorias del programa
                            <strong>
                                {{\Carbon\Carbon::parse($programa->fecha_i)->locale('es')->translatedFormat('F')}} - {{\Carbon\Carbon::parse($programa->fecha_f)->locale('es')->translatedFormat('F Y')}}
                            </strong>
                        </h3>
                    </div>
                    <div class="tw:p-5 tw:sm:p-6">
                        <div class="droptrue tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="sortable1">
                            <br>
                            @foreach($procesos as $proceso)
                                <div id="{{$proceso->id_proceso}}" class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                    <div  class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" >{{$proceso->des_proceso}}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            @foreach($auditorias as $data_auditoria)
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                                            <a href="#" class="btn_delete_plan" data-id="{{$data_auditoria->id_auditoria}}"><span class="fa fa-trash tw:float-right" data-toggle="tooltip" title="Eliminar Plan de Auditoria"></span></a>
                                            <a href="{{url('sgc/ver_plan_auditoria/')}}/{{$data_auditoria->id_auditoria}}">{{date('Y',strtotime($data_auditoria->fecha_i)).'-'.$loop->iteration}}</a>
                                            {{--<p>{{$data_auditoria->fecha_i}}  al  {{$data_auditoria->fecha_f}}</p>--}}
                                        </div>
                                        <div id="sortable2" class="elementos droptrue tw:p-5 tw:sm:p-6 tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" data-agenda="{{$data_auditoria->id_auditoria}}" ondrop="drop(event)" ondragover="allowDrop(event)">

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <input type="button" id="ver_elementos" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <form action="{{url("/sgc/auditorias")}}" method="POST" id="form_ag_aud" class="" role="form">
        <div class="modal fade tw-modal-compat" id="modal_add_aud" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-panel-modal hidden>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Agregar auditoria al programa</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <label for="">Periodo</label>
                                <div class="input-daterange tw:flex tw:w-full tw:items-stretch">
                                    <input type="text" class="periodo tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Fecha de inicio" name="fecha_i">
                                    <div class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:bg-gray-50 tw:px-3 tw:text-sm tw:text-gray-600">a</div>
                                    <input type="text" class="periodo tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Fecha de termino" name="fecha_f">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
                    </div>
                </div>
            </div>
        </div>
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
@endsection