@extends('layouts.panel')
@section('title', 'Partes interesadas de la unidad')
@include('partials.panel.recursos_app', ['validacion' => true])
@section('content')
<div class="tw-pantalla">

    {{--
        <a href="{{ url("riesgos/proceso")}}"  class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-5 tw:py-3.5 tw:text-base tw:text-center" >
            <span class="fa fa-arrow-circle-left"  aria-hidden="true" data-toggle="tooltip" title="Regresar"></span>
        </a>
        --}}
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <p>
                    <span class="fa fa-arrow-right"></span>
                    <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/riesgos/proceso")}}">Registro Procesos </a>
                    <span class="fa fa-chevron-right"></span>
                    <span>Partes interesadas</span>
                </p>
            </div>
            <div class="tw:w-full tw:px-2">
                @if (session()->has('flash_notification.message'))
                    <x-panel.alerta :tipo="['success' => 'exito', 'danger' => 'error', 'warning' => 'advertencia'][session('flash_notification.level')] ?? 'info'" class="tw:mb-4">{!! session('flash_notification.message') !!}</x-panel.alerta>
                @endif
                <x-panel.encabezado titulo="Partes Interesadas del proceso, procedimiento o control de actividad" :migas="['Riesgos y oportunidades' => null]" />
            </div>
            <div class="tw:w-full tw:px-2">
                <div id="accordion" class="">
                    @foreach($partes_unidad as $parte_unidad)
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                                {{--<h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">--}}
                                <a data-toggle="collapse" data-parent="#accordion"
                                   href="#collapse{{$parte_unidad->id_uni_p}}" data-id="{{$parte_unidad->id_uni_p}}"
                                   class="btn_open_panel">{{$parte_unidad->parte[0]->des_parte}}</a>
                                {{--Nuevo icono eliminar --}}
                                <a href="#!" class="btn_delete_unidad_partes tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base"
                                   data-id="{{$parte_unidad->id_uni_p}}"><span class="fa fa-trash"
                                                                               data-toggle="tooltip"
                                                                               title="Eliminar parte interesada "></span></a>
                                {{--</h3>--}}
                            </div>
                            <div id="collapse{{$parte_unidad->id_uni_p}}"
                                 class="collapse {{ Session::get('collapseStatepartes')==$parte_unidad->id_uni_p?'in':'' }}">
                                <div class="tw:p-5 tw:sm:p-6">
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:text-center">
                                        <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Requisitos
                                                    <a href="#!" data-toggle="modal"
                                                       data-id="{{$parte_unidad->id_uni_p}}"
                                                       data-target="#modal_crear_requisito"
                                                       class="btn_crear_requisito tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><span class="fa fa-plus" aria-hidden="true"
                                                              data-toggle="tooltip" title="Agregar"></span></a></h3>
                                    </div>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw-tabla-contenedor tw:mx-2 tw:w-full tw:flex-1 tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw:w-full tw-tabla tw-tabla-bordes">
                                            <thead>
                                            <tr>
                                                <th>Requisitos</th>
                                                <th>Riesgos</th>
                                                <th>Oportunidades</th>
                                                {{-- <th>Información sobre el riesgo</th>--}}
                                                <th>Opciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($parte_unidad->requisitos as $requisito)
                                                <tr>
                                                    <td>{{$requisito->des_requisito}}</td>
                                                    <td>
                                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                            <div class="tw:w-full tw:lg:w-10/12 tw:px-2">
                                                                <a href="#!" data-toggle="modal"
                                                                   data-id="{{$requisito->id_requisito}}"
                                                                   data-target="#modal_crear_requisito_riesgo"
                                                                   class="btn_crear_requisito_riesgo tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><span class="fa fa-plus"
                                                                          aria-hidden="true" data-toggle="tooltip"
                                                                          title="Agregar riesgo"></span></a>
                                                            </div>
                                                        </div>
                                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                            <div class="tw:w-full tw:px-2">
                                                                <ul class="tw:divide-y tw:divide-gray-100 tw:rounded-lg tw:border tw:border-gray-200 tw:dark:border-gray-800">
                                                                    @foreach($requisito->riesgos as $riesgo_requisito)
                                                                        <li class="tw:block tw:px-4 tw:py-3">
                                                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                                                <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                                                                    <a class="tw:text-brand-500 tw:hover:underline" href="{{url('riesgos/registroriesgos')."/".$riesgo_requisito->id_riesgo}}"> {{$riesgo_requisito->des_riesgo}}</a>
                                                                                </div>
                                                                                <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                                                                    <a href="#!"
                                                                                       class="btn_delete_riesgo_requisito tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base"
                                                                                       data-id="{{$riesgo_requisito->id_riesgo}}"><span
                                                                                                aria-hidden="true"
                                                                                                class="fa fa-trash"
                                                                                                data-toggle="tooltip"
                                                                                                title="Eliminar riesgo"></span></a>
                                                                                </div>
                                                                                <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                                                                    <a href="#!"
                                                                                       class="btn_edit_info tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"
                                                                                       data-toggle="modal"
                                                                                       data-target="#modal_modificar_datos"
                                                                                       data-url="riesgos/riesgo/{{$riesgo_requisito->id_riesgo}}"
                                                                                       data-info_edit="{{$riesgo_requisito->des_riesgo}}"><span
                                                                                                aria-hidden="true"
                                                                                                class="fa fa-cog"
                                                                                                data-toggle="tooltip"
                                                                                                title="Editar riesgo"></span></a>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                            <div class="tw:w-full tw:lg:w-10/12 tw:px-2">
                                                                <a data-toggle="modal"
                                                                   data-id="{{$requisito->id_requisito}}"
                                                                   data-target="#modal_crear_requisito_oportunidad"
                                                                   class="btn_crear_requisito_oportunidad tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><span class="fa fa-plus"
                                                                          aria-hidden="true" data-toggle="tooltip"
                                                                          title="Agregar oportunidad"></span></a>
                                                            </div>
                                                        </div>
                                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                            <div class="tw:w-full tw:px-2">
                                                                <ul class="tw:divide-y tw:divide-gray-100 tw:rounded-lg tw:border tw:border-gray-200 tw:dark:border-gray-800">
                                                                    @foreach($requisito->oportunidades as $riesgo_oportunidad)
                                                                        <li class="tw:block tw:px-4 tw:py-3">
                                                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                                                <div class="tw:w-full tw:lg:w-9/12 tw:px-2">
                                                                                    <a href="{{url('riesgos/regoportunidad')."/".$riesgo_oportunidad->id_oportunidad}}"
                                                                                       class="">{{$riesgo_oportunidad->des_oportunidad}}</a>
                                                                                </div>
                                                                                <div class="tw:w-full tw:lg:w-1/12 tw:px-2"></div>
                                                                                <div class="tw:w-full tw:lg:w-1/12 tw:px-2">
                                                                                    <a class="btn_delete_oportunidad_requisito tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base"
                                                                                       data-id="{{$riesgo_oportunidad->id_oportunidad}}"><span
                                                                                                aria-hidden="true"
                                                                                                class="fa fa-trash"
                                                                                                data-toggle="tooltip"
                                                                                                title="Eliminar oportunidad"></span></a>
                                                                                </div>
                                                                                <div class="tw:w-full tw:lg:w-1/12 tw:px-2">
                                                                                    <a class="btn_edit_info tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"
                                                                                       data-toggle="modal"
                                                                                       data-target="#modal_modificar_datos"
                                                                                       data-url="riesgos/regoportunidad/{{$riesgo_oportunidad->id_oportunidad}}"
                                                                                       data-info_edit="{{$riesgo_oportunidad->des_oportunidad}}"><span
                                                                                                aria-hidden="true"
                                                                                                class="fa fa-cog"
                                                                                                data-toggle="tooltip"
                                                                                                title="Editar oportunidad"></span></a>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    {{-- <td>{{$requisito->riesgos[0]->des_riesgo}}</td>--}}
                                                    {{-- <td>
                                                         <a href="{{url('riesgos/registroriesgos')."/".$requisito->id_riesgo}}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm"><span aria-hidden="true" class="fa fa-fire"></span></a>

                                                     </td>--}}
                                                    <td>
                                                        <a class="btn_delete_requisito_riesgo tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base"
                                                           data-id="{{$requisito->id_requisito}}"><span
                                                                    aria-hidden="true" class="fa fa-trash"
                                                                    data-toggle="tooltip"
                                                                    title="Eliminar requisito"></span></a>
                                                        <a class="btn_edit_info tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="modal"
                                                           data-target="#modal_modificar_datos"
                                                           data-url="riesgos/requisitos/{{$requisito->id_requisito}}"
                                                           data-info_edit="{{$requisito->des_requisito}}"><span
                                                                    aria-hidden="true" class="fa fa-cog"
                                                                    data-toggle="tooltip"
                                                                    title="Editar requisito"></span></a>
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
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <div>
        <button data-toggle="modal" data-tooltip="true" data-placement="left" title="Agregar nueva parte interesada"
                data-target="#modal_crear" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
            <span class="fa fa-plus" aria-hidden="true"></span>
        </button>
    </div>

    <form id="form_parte_crea" class="" role="form" method="POST">
        <x-panel.modal id="modal_crear" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar Parte Interesada</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        {{ csrf_field() }}
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="parte_interesada">Parte Interesada</label>
                                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="parte_interesada" id="parte_interesada">
                                        <option disabled selected>Seleccione una opción</option>
                                        @foreach($partes as $parte)
                                            <option value="{{$parte->id_parte}}">{{$parte->des_parte}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input id="save_unidad" type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Guardar"/>
                    </div>
                </x-panel.modal>
    </form>

    <form id="form_requisito" class="" role="form" method="POST" action="{{url('riesgos/requisitos')}}">
        <x-panel.modal id="modal_crear_requisito" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar Requisito</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_uni_p" id="id_uni_p">
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="des_parte">Requisito</label>
                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="requisito" placeholder="Requisito">
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

    <form id="form_requisito_riesgo" class="" role="form" method="POST" action="{{url('riesgos/riesgo')}}">
        <x-panel.modal id="modal_crear_requisito_riesgo" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar Riesgo</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_requisito_riesgo" id="id_requisito_riesgo">
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="riesgo">Riesgo</label>
                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="riesgo" placeholder="Riesgo">
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

    <form id="form_requisito_oportunidad" class="" role="form" method="POST"
          action="{{url('riesgos/regoportunidad')}}">
        <x-panel.modal id="modal_crear_requisito_oportunidad" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar Oportunidad</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_requisito_oportunidad" id="id_requisito_oportunidad">
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="riesgo">Oportunidad</label>
                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="oportunidad"
                                           placeholder="Oportunidad">
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

    <form id="form_modificar_datos" class="" role="form" method="POST">
        <x-panel.modal id="modal_modificar_datos" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Modificar Registro</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="riesgo">Descripción </label>
                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="des_dato_modificar"
                                           id="des_dato_modificar">
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


    <form method="POST" role="form" id="form_delete">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
    </form>

    <script>
        $(document).ready(function () {
            $(".btn_delete_unidad_partes").click(function () {
                var id = $(this).data('id');


                Swal.fire({
                    type: 'error',
                    title: '¿Seguro que desea eliminar?',
                    showCancelButton: true,
                    confirmButtonText: `Aceptar`,
                    cancelButtonText: `Cancelar`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.value) {
                        $("#form_delete").attr("action", "{{url('riesgos/add_partes')}}/" + id)
                        $("#form_delete").submit();
                    }
                });
            });
            $(".btn_delete_requisito_riesgo").click(function () {
                var id = $(this).data('id');


                Swal.fire({
                    title: '¿Seguro que desea eliminar?',
                    type: 'error',
                    showCancelButton: true,
                    confirmButtonText: `Aceptar`,
                    cancelButtonText: `Cancelar`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.value) {
                        $("#form_delete").attr("action", "{{url('riesgos/requisitos')}}/" + id)
                        // TNotify.alert($("#form_delete_requisito_riesgo").attr("action"))
                        $("#form_delete").submit();
                    }
                });
            });
            $(".btn_delete_oportunidad_requisito").click(function () {
                var id = $(this).data('id');


                Swal.fire({
                    title: '¿Seguro que desea eliminar?',
                    type: 'error',
                    showCancelButton: true,
                    confirmButtonText: `Aceptar`,
                    cancelButtonText: `Cancelar`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.value) {
                        $("#form_delete").attr("action", "{{url('riesgos/regoportunidad')}}/" + id)
                        // TNotify.alert($("#form_delete_requisito_riesgo").attr("action"))
                        $("#form_delete").submit();
                    }
                });
            });
            $(".btn_delete_riesgo_requisito").click(function () {
                var id = $(this).data('id');


                Swal.fire({
                    title: '¿Seguro que desea eliminar?',
                    type: 'error',
                    showCancelButton: true,
                    confirmButtonText: `Aceptar`,
                    cancelButtonText: `Cancelar`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.value) {
                        $("#form_delete").attr("action", "{{url('riesgos/riesgo')}}/" + id)
                        // TNotify.alert($("#form_delete_requisito_riesgo").attr("action"))
                        $("#form_delete").submit();
                    }
                });
            });
            $(".btn_edit_info").click(function () {
                var elemnent = $(this);
                $("#form_modificar_datos").attr("action", "{{url("")}}/" + elemnent.data("url"));
                $("#des_dato_modificar").val(elemnent.data("info_edit"));
            });
            $("#form_parte_crea").validate({
                rules: {
                    parte_interesada: {
                        required: true,
                    },
                },
            });
            $("#form_requisito").validate({
                rules: {
                    requisito: {
                        required: true,
                    },
                    /*riesgo: {
                        required: true,
                    },*/
                },
            });
            $("#form_modificar_datos").validate({
                rules: {
                    requisito: {
                        required: true,
                    },
                    /*riesgo: {
                        required: true,
                    },*/
                },
            });
            $(".btn_crear_requisito").click(function () {
                //TNotify.alert("ok")
                $("#id_uni_p").val($(this).data('id'));
            })
            $(".btn_crear_requisito_riesgo").click(function () {
                //TNotify.alert("ok")
                $("#id_requisito_riesgo").val($(this).data('id'));
            })

            $(".btn_crear_requisito_oportunidad").click(function () {
                //TNotify.alert("ok")
                $("#id_requisito_oportunidad").val($(this).data('id'));
            })
            $(".btn_open_panel").click(function () {
                $.get("{{url('riesgos/add_partes/collapse')}}/" + $(this).data("id"));
            });

            $('[data-toggle="tooltip"]').tooltip();

        });
    </script>

</div>
@endsection