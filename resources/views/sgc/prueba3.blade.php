@extends('layouts.panel')
@section('title','Agendar auditorias')
@include('partials.panel.recursos_app', ['ordenable' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Agendar auditorías" :migas="['Sistema de gestión de calidad' => null]" />

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
            <input type="button" id="ver_elementos" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Ver"/>
        </div>
    @endforeach


    <script>
        $( function() {
            $( "div.droptrue" ).sortable({
                connectWith: "div",
                cursor: 'grabbing'
            });

            $("#ver_elementos").click(function () {
                $arreglo=[];
                $(".elementos").each(function () {
                    var agenda=$(this).data('agenda');
                    $(this).children().each(function () {
                        $arreglo.push({
                            'agenda': agenda,
                            'proceso': $(this).attr('id')
                        });
                    })
                });
            });

            $( "#sortable1, #sortable2, #sortable3" ).disableSelection();
        } );
    </script>
</div>
@endsection