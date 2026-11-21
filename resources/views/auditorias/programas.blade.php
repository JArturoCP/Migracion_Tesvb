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

    <main class="tw-pantalla tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-6/12 tw:lg:ml-[25%] tw:px-2">
                @if (session()->has('flash_notification.message'))
                    <x-panel.alerta class="tw:mb-4" :tipo="['success' => 'exito', 'danger' => 'error', 'warning' => 'advertencia'][session('flash_notification.level')] ?? 'info'">{!! session('flash_notification.message') !!}</x-panel.alerta>
                @endif
            </div>
        </div>
        <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                    @if($esLider)
                    <a href="#!" class="tw:float-right" data-toggle="modal" data-target="#modal_crea_aud"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar nuevo programa"></span></a>
                    @endif
                    <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Programas de auditorías</h3>
                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-bordes">
                        .
                        <thead>
                        <tr>
                            <th class="tw:lg:w-4/12">Periodo</th>
                            <th class="tw:lg:w-7/12">Lugar</th>
                            @if($esLider)<th class="tw:lg:w-1/12 tw:text-center">Acciones</th>@endif
                        </tr>
                        </thead>
                        <tbody>


                        @foreach($programas as $programa)
                            <tr class="bg-{{$programa->active==1?'warning':($programa->active==2?'danger':($programa->active==3?'success':''))}}">
                                <td>
                                    <a href="{{url('auditorias/programas/')}}/{{$programa->id_programa}}">{{\Carbon\Carbon::parse($programa->fecha_i)->locale('es')->translatedFormat('F')}} - {{\Carbon\Carbon::parse($programa->fecha_f)->locale('es')->translatedFormat('F Y')}}</a>
                                </td>
                                <td>
                                    {{$programa->lugar}}
                                </td>
                                @if($esLider)
                                <td class="tw:text-center">

                                    @if($programa->active==0||$programa->active==2)
                                    <a href="#" class="btn_send_programa" data-id="{{$programa->id_programa}}"><span class="fa fa-paper-plane" data-toggle="tooltip" title="Enviar programa"></span></a>
                                    @endif
                                    {{--                                    <a href="{{url('auditorias/reporte_programa')}}/{{$programa->id_programa}}/edit" class="btn_informe_programa tw:float-left"><span class="fa fa-pencil-square-o" data-toggle="tooltip" title="Ver Reporte del Programa de Auditoría"></span></a>--}}
                                    <a href="#" class="btn_delete_programa" data-id="{{$programa->id_programa}}"><span class="fa fa-trash" data-toggle="tooltip" title="Eliminar Programa de Auditoría"></span></a>

                                    @if($programa->observaciones && $programa->active==2)
                                            <a href="#" class="btn_observacion_programa" data-id="{{$programa->id_programa}}" data-value="{{$programa->observaciones}}"><span class="fa fa-search-plus" data-toggle="tooltip" title="Observaciones"></span></a>
                                        @endif
                                </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
</div>
                </div>
            </div>
        </div>
    </main>
{{--    <div>--}}
{{--        <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar nueva auditoria" data-target="#modal_crea_aud" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">--}}
{{--            <span class="fa fa-plus" aria-hidden="true"></span>--}}
{{--        </button>--}}
{{--    </div>--}}

    <form  method="POST" role="form" id="form_delete_programa">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
    </form>

    <form  method="POST" role="form" id="form_send_programa">
        <input type="hidden" value="{{isset($programa)?$programa->observaciones:''}}" id="observacion_programa" name="observaciones">
        <input type="hidden" value="{{isset($programa)?$programa->justificacion:''}}" id="justificacion_programa" name="justificacion">
        <input type="hidden" value="1" name="statePrograma">
        {{ csrf_field() }}
    </form>
    <form id="form_add_programa" class="" role="form" method="POST" action="{{url("/auditorias/programas")}}">
        <x-panel.modal id="modal_crea_aud" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Registro de programa de auditorías</h4>
                    </div>
                    <div class="tw-modal-cuerpo">

                        {{ csrf_field() }}
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:ml-[8.3333%] tw:lg:w-10/12 tw:px-2" id="errors">
                                @if(Session::get('errors'))
                                    <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" role="alert">
                                        @foreach(\Illuminate\Support\Facades\Session::get('errors')->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="">Periodo</label>
                                    <div class="input-daterange tw:flex tw:w-full tw:items-stretch">
                                        <input type="text" class="periodo tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Fecha de inicio" name="inicio" value="{{old('inicio')}}" required>
                                        <div class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:bg-gray-50 tw:px-3 tw:text-sm tw:text-gray-600">a</div>
                                        <input type="text" class="periodo tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Fecha de término" name="fin" id="f_fin" value="{{old('fin')}}" required>
                                    </div>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="lugar">Lugar</label>
                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"name="lugar" placeholder="Lugar de las auditorías" value="{{old('lugar')?old('lugar'):'Tecnológico de Estudios Superiores de Valle de Bravo'}}" required>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="alcance">Alcance</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"name="alcance" placeholder="Alcance del programa de auditorías" required>{{old('alcance')?old('alcance'):'Serán auditados también aquellos cambios que afecten al Tecnológico y los resultados de auditorías anteriores.'}}</textarea>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="objetivo">Objetivo</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"name="objetivo" placeholder="Objetivo del programa de auditorías " required>{{old("objetivo")}}</textarea>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="metodos">Metodos</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"name="metodos" placeholder="Métodos a usar">{{old('metodos')?old('metodos'):'Para el presente programa de auditoría serán utilizados los métodos de:
                                        1.	Entrevista;
                                        2.	Muestreo; y
                                        3.	Revisión documental.'}}
                                    </textarea>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="alcance">Responsabilidades</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"name="responsabilidades" placeholder="Responsabilidades del programa de auditorías">{{old('responsabilidades')?old('responsabilidades'):'El Director General, el Coordinador del SGOE, Auditor Líder y áreas del Tecnológico, intervienen en el proceso de auditorías. Las responsabilidades de cada uno de ellos, respecto del programa de auditoría se encuentran descritas en el Anexo 3, Matriz de responsabilidad y autoridad.'}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input type="submit" id="guardar_aud" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
                    </div>
                
            
        </x-panel.modal>
    </form>
    <script>
        $(document).ready(function () {
            $('#modal_crea_aud').submit(function(event) {
                var objetivoValue = $('#objetivo').val().trim();

                if (objetivoValue === '') {
                    event.preventDefault();
7
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Debe llenar el objetivo de programa de auditorias',
                    });
                }
            });
        });
    </script>


    <script>
        $(document).ready(function () {
            $('.input-daterange').datepicker({
                autoclose: true,
                format: "dd-mm-yyyy",
                language: 'es',
                startView: 1,
                maxViewMode: 2,
                minViewMode: 1
            });
            $('#p_inicio').datepicker({
                startDate: 0,
            });

            $(".btn_delete_programa").click(function(){
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
                        $("#form_delete_programa").attr("action","/auditorias/programas/"+id)
                        $("#form_delete_programa").submit();
                    }
                    else if (result.dismiss === Swal.DismissReason.cancel) { //Si presionas boton cancelar
                        swal.close()
                    }
                });
            });
            $(".btn_send_programa").click(function(){
                var id=$(this).data('id');
                swal({
                    title: "¿Seguro que desea enviar el programa?",
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Aceptar',
                })
                    .then((result) => {
                        if (result.value) { //Si presionas boton aceptar
                            $("#form_send_programa").attr("action","/auditorias/validar_programa/"+id)
                            $("#form_send_programa").submit();
                        }
                        else if (result.dismiss === Swal.DismissReason.cancel) { //Si presionas boton cancelar
                            swal.close()
                        }
                    });
            });
            $(".btn_observacion_programa").click(function(){
                var id=$(this).data('id');

                var value=$(this).data('value');
                swal({
                    title: 'Observaciones',
                    text: value,
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: 'Cerrar',
                    confirmButtonText: 'Enviar justificación',
                    input: 'textarea',
                    inputLabel: 'Justificación',
                    inputPlaceholder: 'Escriba aquí su justificación...',
                    inputAttributes: {
                        'aria-label': 'Escriba aquí su justificación'
                    },
                    inputValue: '{{$programa->justificacion??""}}',

                    inputValidator: (value) => {
                        if (!value) {
                            return 'Necesitas escribir una justificación!'
                        }
                    }
                })
                    .then((result) => {
                        if (result.value) { //Si presionas boton aceptar

                            $("#justificacion_programa").val(result.value)
                            $("#form_send_programa").attr("action","/auditorias/validar_programa/"+id)
                            $("#form_send_programa").submit();
                        }
                        else if (result.dismiss === Swal.DismissReason.cancel) { //Si presionas boton cancelar
                            swal.close()
                        }


                    });
            });
            @if($errors->any())
            TNotify.alert('ok');
            $('#modal_crea_aud').modal('show');
            setTimeout(function () {
                $('#errors').fadeOut(500);
            },5000);
            @endif
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    @if(Session::forget('errors'))@endif

@endsection
