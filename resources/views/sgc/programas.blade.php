<?php
/**
 * Created by PhpStorm.
 * User: Juan Carlos
 * Date: 06/07/2019
 * Time: 03:05 PM
 */
?>
@extends('layouts.panel')
@section('title', 'Programa de Auditorias')
@include('partials.panel.recursos_app', ['datepicker' => true])
@section('content')
<div class="tw-pantalla">
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
        <x-panel.encabezado titulo="Programas de auditorías" :migas="['Sistema de gestión de calidad' => null]" />
    <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla">
                        <thead>
                            <tr>
                                <th class="tw:w-full tw:lg:w-4/12 tw:px-2">Periodo</th>
                                <th class="tw:w-full tw:lg:w-6/12 tw:px-2">Lugar</th>
                                <th class="tw:w-full tw:lg:w-2/12 tw:text-center tw:px-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($programas as $programa)
                            <tr>
                                <td>
                                    <a class="tw:text-brand-500 tw:hover:underline" href="{{url('sgc/programa/')}}/{{$programa->id_programa}}">{{\Carbon\Carbon::parse($programa->fecha_i)->locale('es')->translatedFormat('F')}} - {{\Carbon\Carbon::parse($programa->fecha_f)->locale('es')->translatedFormat('F Y')}}</a>
                                </td>
                                <td>
                                    {{$programa->lugar}}
                                </td>
                                <td class="tw:text-center">
                                    <a href="{{url('sgc/reporte_programa')}}/{{$programa->id_programa}}/edit" class="pull-leftbtn_informe_programa tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><span class="fa fa-pencil-square-o" data-toggle="tooltip" title="Ver Reporte del Programa de Auditoría"></span></a>
                                    <a href="#" class="btn_delete_programa tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" data-id="{{$programa->id_programa}}"><span class="fa fa-trash tw:float-right" data-toggle="tooltip" title="Eliminar Programa de Auditoría"></span></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
</div>
                </div>
            </div>
        </div>
    </main>
    <div>
        <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar nueva auditoria" data-target="#modal_crea_aud" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
            <span class="fa fa-plus" aria-hidden="true"></span>
        </button>
    </div>

    <form  method="POST" role="form" id="form_delete_programa">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
    </form>

    <form id="form_add_programa" class="" role="form" method="POST" action="{{url("/sgc/programa")}}">
        <x-panel.modal id="modal_crea_aud" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Registro de programa de auditorías</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        {{ csrf_field() }}
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="">Periodo</label>
                                    <div class="input-daterange tw:flex tw:w-full tw:items-stretch">
                                        <input type="text" class="periodo tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Fecha de inicio" name="inicio">
                                        <div class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-3 tw:text-sm tw:text-gray-600 tw:dark:text-gray-400">a</div>
                                        <input type="text" class="periodo tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Fecha de termino" name="fin">
                                    </div>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="objetivo">Lugar</label>
                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"name="lugar" placeholder="Lugar de las auditorías" value="Tecnológico de Estudios Superiores de Valle de Bravo">
                                    </input>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="alcance">Alcance</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"name="alcance" placeholder="Alcance del programa de auditorías">Serán auditados también aquellos cambios que afecten al Tecnológico y los resultados de auditorías anteriores.</textarea>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="metodos">Metodos</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"name="metodos" placeholder="Metodos a usar">Para el presente programa de auditoría serán utilizados los métodos de:
        1.	Entrevista;
        2.	Muestreo; y
        3.	Revisión documental.</textarea>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="alcance">Responsabilidades</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"name="responsabilidades" placeholder="Responsabilidades del programa de auditorías">El Director General, el Coordinador del SGC, Auditor Líder y áreas del Tecnológico, intervienen en el proceso de auditorías. Las responsabilidades de cada uno de ellos, respecto del programa de auditoría se encuentran descritas en el Anexo 3, Matriz de responsabilidad y autoridad.</textarea>
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
            $('.input-daterange').datepicker({
                autoclose: true,
                format: "dd-mm-yyyy",
                language: 'es'
            });
            $('#p_inicio').datepicker({
                startDate: 0
            });

            $(".btn_delete_programa").click(function(){
                var id=$(this).data('id');
                swal({
                    title: "Seguro que desea eliminar?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $("#form_delete_programa").attr("action","/sgc/programa/"+id)
                            $("#form_delete_programa").submit();
                        }
                    });
            });

        });
    </script>

</div>
@endsection
