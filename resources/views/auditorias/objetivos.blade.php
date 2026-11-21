<?php
/**
 * Created by PhpStorm.
 * User: Juan Carlos
 * Date: 21/06/2019
 * Time: 11:08 AM
 */
?>
@extends('layouts.panel')
@section('title', 'Objetivos')
@include('partials.panel.recursos_app')
@section('content')

    <main class="tw-pantalla tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                @if (session()->has('flash_notification.message'))
                    <x-panel.alerta class="tw:mb-4" :tipo="['success' => 'exito', 'danger' => 'error', 'warning' => 'advertencia'][session('flash_notification.level')] ?? 'info'">{!! session('flash_notification.message') !!}</x-panel.alerta>
                @endif
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                        <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Objetivos</h3>
                    </div>
                    <div class="tw:p-5 tw:sm:p-6">
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-bordes">
                            <thead>
                            <tr class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <th class="tw:lg:w-11/12">Descripción del Objetivo</th>
                                <th class="tw:lg:w-1/12 tw:text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($objetivos as $objetivo)
                                <tr class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <td class="tw:lg:w-11/12">
                                        {{$objetivo->descripcion}}
                                    </td>
                                    <td class="tw:lg:w-1/12 tw:text-center">
                                        <a href="#!" class="btn_mod_objetivo" data-all="{{$objetivo}}"><span class="fa fa-cog tw:float-left" data-toggle="tooltip" title="Configurar objetivo"></span></a>
                                        <a href="#!" class="btn_delete_objetivo" data-id="{{$objetivo->id_objetivo}}"><span class="fa fa-trash tw:float-right" data-toggle="tooltip" title="Eliminar objetivo"></span></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
</div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <form  method="POST" role="form" id="form_delete_objetivo">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
    </form>


    <div>
        <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar objetivo" data-target="#modal_crear" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
            <span class="fa fa-plus" aria-hidden="true"></span>
        </button>
    </div>
    <form id="form_objetivo_crea" class="" role="form" method="POST" action="{{url('auditorias/objetivos')}}">
        <x-panel.modal id="modal_crear" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Agregar Objetivo</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        {{ csrf_field() }}
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="descripcion">Objetivo</label>
                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"name="descripcion" placeholder="Descripción">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input id="save_unidad" type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
                    </div>
                
            
        </x-panel.modal>
    </form>

    <form id="form_mod_objetivo" class="" role="form" method="POST"  action="">
        <x-panel.modal id="modal_modi" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Modificar Objetivo</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        @csrf
                        @method('PUT')
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="descripcion_modi">Objetivo</label>
                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="descripcion_modi" name="descripcion_modi" placeholder="Descripcion">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input id="save_unidad" type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
                    </div>
                
            
        </x-panel.modal>
    </form>

    <form action="" method="POST" role="form" id="form_delete_objetivo">
        {{method_field('DELETE') }}
        {{ csrf_field() }}
    </form>
    <script>

        $(document).ready(function() {

            $(".btn_delete_objetivo").click(function(){
                var id=$(this).data('id');
                swal({
                    title: "Seguro que desea eliminar?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $("#form_delete_objetivo").attr("action","/auditorias/objetivos/"+id)
                            $("#form_delete_objetivo").submit();
                        }
                    });
            });

            $(".btn_mod_objetivo").click(function(){
                var data=$(this).data("all");
                $("#form_mod_objetivo").attr("action","/auditorias/objetivos/"+data['id_objetivo']);
                $("#descripcion_modi").val(data['descripcion']);
                $("#modal_modi").modal("show");
            });

            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection