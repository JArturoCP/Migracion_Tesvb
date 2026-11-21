<?php
/**
 * Created by PhpStorm.
 * User: Juan Carlos
 * Date: 09/07/2019
 * Time: 08:16 PM
 */
?>
@extends('layouts.panel')
@section('title','Detalles del programa')
@include('partials.panel.recursos_app', ['datepicker' => true])
@section('content')
    @if(\Illuminate\Support\Facades\Session::get('errors'))
        <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" role="alert">
            @foreach(\Illuminate\Support\Facades\Session::get('errors')->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>
        @if(\Illuminate\Support\Facades\Session::forget('errors'))@endif
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
                <span class="tw:text-gray-800 tw:dark:text-white/90">Detalles del programa</span>
            </nav>
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                    @foreach($programas as $programa)
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                        @if($programa->requisitos && $programa->recursos && $programa->criterios)
                            <a href="{{url('auditorias/programas')}}/{{$programa->id_programa}}/edit" ><span class="fa fa-th tw:float-right" data-toggle="tooltip" title="Agendar procesos"></span></a>
                        @endif
                        <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Programa de auditorías
                            <strong>
                                {{\Carbon\Carbon::parse($programa->fecha_i)->locale('es')->translatedFormat('F')}} - {{\Carbon\Carbon::parse($programa->fecha_f)->locale('es')->translatedFormat('F Y')}}
                            </strong>
                        </h3>
                    </div>
                    <div class="tw:p-5 tw:sm:p-6">
                        @if($esLider)
                        <a href="#" class="btn_edit_programa tw:float-right" data-all="{{$programa}}" data-toggle="tooltip" title="Editar Programa"><span class="fa fa-cog"></span></a>
                        @endif
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <label>Lugar: </label>
                                <p>{{$programa->lugar}}</p>
                            </div>
                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <label>Alcance: </label>
                                <p>{{$programa->alcance}}</p>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <label>Objetivos</label>
{{--                                <p>{{$programa->objetivo}}</p>--}}
                                @if($numeros=array("1.","2.","3.","4.","5.","6.","7.","8.","9.","10."))
                                    <p>
                                        <?php echo $programa->objetivo=\Illuminate\Support\Str::replaceArray('--',$numeros,str_replace($numeros,'<br>--',$programa->objetivo,$count)); ?>
                                    </p>
                                @endif
                            </div>
                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <label>Métodos</label>
{{--                                <p>{{$programa->metodos}}</p>--}}
                                @if($numeros=array("1.","2.","3.","4.","5.","6.","7.","8.","9.","10."))
                                    <p>
                                        <?php echo $programa->metodos=\Illuminate\Support\Str::replaceArray('--',$numeros,str_replace($numeros,'<br>--',$programa->metodos,$count)); ?>
                                    </p>
                                @endif

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
                        <hr>
                        @if($esLider)
                            <a href="#" class="btn_edit_programacion tw:float-right" data-all="{{$programa}}" data-toggle="tooltip" title="Editar planeación del programa"><span class="fa fa-cog"></span></a>
                        @endif
                        <label>Planeación: </label>
                        @if($programa->requisitos && $programa->recursos && $programa->criterios)
                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-bordes">
                                <tr>
                                    <td class="tw:lg:w-3/12">
                                        <p class="tw:text-center"><label>Recursos:</label></p>
                                        @if($numeros=array("2.","3.","4.","5.","6.","7.","8.","9.","10."))
                                            <?php echo $programa->recursos=\Illuminate\Support\Str::replaceArray('--',$numeros,str_replace($numeros,'<br>--',$programa->recursos,$count)); ?>
                                        @endif
                                        {{--                                    {{$programa->recursos}}--}}
                                    </td>
                                    <td class="tw:lg:w-3/12">
                                        <p class="tw:text-center"><label>Requisitos:</label></p>
                                        {{$programa->requisitos}}
                                    </td>
                                    <td class="tw:lg:w-3/12">
                                        <p class="tw:text-center"><label>Criterios de aceptacioón:</label></p>
                                        {{$programa->criterios}}
                                    </td>
                                </tr>
                            </table>
</div>
                        @else
                            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" role="alert">No se han definido los datos</div>
                        @endif


                    </div>
                @endforeach
            </div>
        </div>
    </main>


    <x-panel.modal id="modal_edit_program" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <form id="form_edit_programa" class="" role="form" method="POST" action="">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Editar programa de auditorías</h4>
                </div>

                <div class="tw-modal-cuerpo">
                        @csrf
                        @method('PUT')
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="">Periodo</label>
                                    <div class="input-daterange tw:flex tw:w-full tw:items-stretch">
                                        <input type="text" class="periodo tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="inicio">
                                        <div class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:bg-gray-50 tw:px-3 tw:text-sm tw:text-gray-600">a</div>
                                        <input type="text" class="periodo tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="fin">
                                    </div>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="lugar">Lugar</label>
                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"name="lugar" value="" />
                                </div>
                                <div class="tw:mb-4">
                                    <label for="alcance">Alcance</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"name="alcance"></textarea>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="objetivo">Objetivo</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"name="objetivo"></textarea>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="metodos">Metodos</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"name="metodos"></textarea>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="responsabilidades">Responsabilidades</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"name="responsabilidades"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
                    </div>
                </form>
            
        
    </x-panel.modal>


    <x-panel.modal id="modal_edit_programacion" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <form id="form_edit_programacion" class="" role="form" method="POST" action="">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Editar planeación</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        @csrf
                        @method('PUT')
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="recursos">Recursos:</label>
                                        @if($programa->recursos)
                                        <textarea name="recursos" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="" cols="30" rows="3">{{str_replace('<br>','',$programa->recursos)}}</textarea>
                                        @else
                                        <textarea name="recursos" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="" cols="30" rows="3">1. Equipo de cómputo;
2. Equipo auditor;
3. Papelería.</textarea>
                                        @endif
                                </div>
                                <div class="tw:mb-4">
                                    <label for="requisitos">Requisitos:</label>
                                    <textarea name="requisitos" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="" cols="30" rows="3">{{$programa->requisitos!=''?$programa->requisitos:'1. Presentar al auditor la información requerida en la auditoría;'}}</textarea>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="criterios">Criterios de aceptación:</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="criterios" cols="30" rows="3">{{$programa->criterios!=''?$programa->criterios:'1. Se determinará cumplimiento cuando la información presentada sea conforme con los criterios de la auditoría.'}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
                    </div>
                </form>
            
        
    </x-panel.modal>

    <script>
        $(document).ready(function () {

            $('.btn_add_obj').click(function () {
                $('#modal_add_obj').modal('show');
            });
            $('.btn_add_metodo').click(function () {
                $('#modal_add_metodo').modal('show');
            });

            $('.btn_edit_programa').click(function () {
                var datos=$(this).data('all');
                $('#form_edit_programa').attr('action','{{url('auditorias/programas')}}/'+datos['id_programa'])
                $('[name=inicio]').val(datos['fecha_i']);
                $('[name=fin]').val(datos['fecha_f']);
                $('[name=lugar]').val(datos['lugar']);
                $('[name=alcance]').val(datos['alcance']);
                $('[name=objetivo]').val(datos['objetivo']);
                $('[name=metodos]').val(datos['metodos']);
                $('[name=responsabilidades]').val(datos['responsabilidades']);
                $('#modal_edit_program').modal('show');
            });

            $(".btn_edit_programacion").click(function () {
                var datos=$(this).data('all');
                $('#form_edit_programacion').attr('action','{{url('auditorias/programas')}}/'+datos['id_programa'])
                $("#modal_edit_programacion").modal('show');
            });


            $('.input-daterange').datepicker({
                autoclose: true,
                format: "dd-mm-yyyy",
                language: 'es'
            });


            $('[data-toggle="tooltip"]').tooltip();

        });
    </script>

@endsection
