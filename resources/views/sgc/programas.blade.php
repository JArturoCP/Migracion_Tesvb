<?php
/**
 * Created by PhpStorm.
 * User: Juan Carlos
 * Date: 06/07/2019
 * Time: 03:05 PM
 */
?>
@extends('layouts.panel')
@include('partials.panel.recursos_app', ['datepicker' => true])
@section('title', 'Programa de Auditorias')
@section('content')
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
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                    <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">Programas de auditorías</h3>
                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
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
                                    <a href="{{url('sgc/programa/')}}/{{$programa->id_programa}}">{{\Carbon\Carbon::parse($programa->fecha_i)->locale('es')->translatedFormat('F')}} - {{\Carbon\Carbon::parse($programa->fecha_f)->locale('es')->translatedFormat('F Y')}}</a>
                                </td>
                                <td>
                                    {{$programa->lugar}}
                                </td>
                                <td class="tw:text-center">
                                    <a href="{{url('sgc/reporte_programa')}}/{{$programa->id_programa}}/edit" class="pull-leftbtn_informe_programa"><span class="fa fa-pencil-square-o" data-toggle="tooltip" title="Ver Reporte del Programa de Auditoría"></span></a>
                                    <a href="#" class="btn_delete_programa" data-id="{{$programa->id_programa}}"><span class="fa fa-trash tw:float-right" data-toggle="tooltip" title="Eliminar Programa de Auditoría"></span></a>
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
        <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar nueva auditoria" data-target="#modal_crea_aud" type="button" class="flotante tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-5 tw:py-3.5 tw:text-base">
            <span class="fa fa-plus" aria-hidden="true"></span>
        </button>
    </div>

    <form  method="POST" role="form" id="form_delete_programa">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
    </form>

    <form id="form_add_programa" class="" role="form" method="POST" action="{{url("/sgc/programa")}}">
        <div class="modal fade tw-modal-compat" id="modal_crea_aud" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-panel-modal hidden>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Registro de programa de auditorías</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="">Periodo</label>
                                    <div class="input-daterange tw:flex tw:w-full tw:items-stretch">
                                        <input type="text" class="periodo tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Fecha de inicio" name="inicio">
                                        <div class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:bg-gray-50 tw:px-3 tw:text-sm tw:text-gray-600">a</div>
                                        <input type="text" class="periodo tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Fecha de termino" name="fin">
                                    </div>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="objetivo">Lugar</label>
                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"name="lugar" placeholder="Lugar de las auditorías" value="Tecnológico de Estudios Superiores de Valle de Bravo">
                                    </input>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="alcance">Alcance</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"name="alcance" placeholder="Alcance del programa de auditorías">Serán auditados también aquellos cambios que afecten al Tecnológico y los resultados de auditorías anteriores.</textarea>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="metodos">Metodos</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"name="metodos" placeholder="Metodos a usar">Para el presente programa de auditoría serán utilizados los métodos de:
        1.	Entrevista;
        2.	Muestreo; y
        3.	Revisión documental.</textarea>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="alcance">Responsabilidades</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"name="responsabilidades" placeholder="Responsabilidades del programa de auditorías">El Director General, el Coordinador del SGC, Auditor Líder y áreas del Tecnológico, intervienen en el proceso de auditorías. Las responsabilidades de cada uno de ellos, respecto del programa de auditoría se encuentran descritas en el Anexo 3, Matriz de responsabilidad y autoridad.</textarea>
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

@endsection
