<?php
/**
 * Created by PhpStorm.
 * User: Juan Carlos
 * Date: 09/07/2019
 * Time: 08:16 PM
 */
?>
@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('title','Ver programa')
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
                @foreach($programas as $programa)
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                    <a href="{{url('sgc/programa')}}/{{$programa->id_programa}}/edit" ><span class="fa tw:float-right fa-calendar" data-toggle="tooltip" title="Agendar auditorias"></span></a>
                    <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">Programa de auditorías
                        <strong>
                            {{\Carbon\Carbon::parse($programa->fecha_i)->locale('es')->translatedFormat('F')}} - {{\Carbon\Carbon::parse($programa->fecha_f)->locale('es')->translatedFormat('F Y')}}
                        </strong>
                    </h3>
                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                            <label>Lugar: </label>
                            <p>{{$programa->lugar}}</p>
                        </div>
                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                            <label>Alcance:</label>
                            <p>{{$programa->alcance}}</p>
                        </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                            <label>Objetivos</label>
                            <a href="#" class="btn_add_obj"><span class="fa fa-plus"></span></a>
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Objetivo del programa">
                        </div>
                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                            <label>Métodos</label>
                            <p>{{$programa->metodos}}</p>
{{--                            <a href="#" class="btn_add_metodo"><span class="fa fa-plus"></span></a>--}}
{{--                            <p>Para el presente programa de auditoría serán utilizados los métodos de:</p>--}}
                        </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                            <label>Responsabilidades:</label>
                            <p>{{$programa->responsabilidades}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>

    <form id="form_add_obj" class="" role="form" method="POST" action="{{url("/sgc/programa")}}">
        <div class="modal fade tw-modal-compat" id="modal_add_obj" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-panel-modal hidden>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Agregar objetivo al programa</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="alcance">Objetivo</label>
                                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="objetivo">
                                        <option value="" disabled selected>Selecciona...</option>
                                        @foreach($objetivos as $objetivo)
                                            <option value="{{$objetivo->id_objetivo}}">{{$objetivo->descripcion}}</option>
                                        @endforeach
                                    </select>
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

    <form id="form_add_metodo" class="" role="form" method="POST" action="{{url("/sgc/programa")}}">
        <div class="modal fade tw-modal-compat" id="modal_add_metodo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-panel-modal hidden>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Agregar método al programa</h4>
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
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"name="lugar" placeholder="Lugar de las auditorías"></textarea>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="alcance">Alcance</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"name="alcance" placeholder="Alcance del programa de auditorías"></textarea>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="alcance">Responsabilidades</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"name="responsabilidades" placeholder="Responsabilidades del programa de auditorías"></textarea>
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

            $('.btn_add_obj').click(function () {
                $('#modal_add_obj').modal('show');
            });
            $('.btn_add_metodo').click(function () {
                $('#modal_add_metodo').modal('show');
            });


            $('[data-toggle="tooltip"]').tooltip();

        });
    </script>

@endsection
