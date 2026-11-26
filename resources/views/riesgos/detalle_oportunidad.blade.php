@extends('layouts.panel')
@section('title', 'Oportunidad')
@include('partials.panel.recursos_app', ['datepicker' => true, 'validacion' => true])
@section('content')
<div class="tw-pantalla">

 @include("riesgos.partials.msg_ok")
{{--   <a href="{{ redirect()->back()->getTargetUrl()}}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-5 tw:py-3.5 tw:text-base tw:text-center">
    <span class="fa fa-arrow-circle-left"  aria-hidden="true" data-toggle="tooltip" title="Regresar"></span>
</a>--}}


    <x-panel.encabezado titulo="Detalle de la oportunidad" :migas="['Riesgos y oportunidades' => null]" />
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:w-full tw:px-2">
            <p class="tw:w-full">
                <span class="fa fa-arrow-right"></span>
                <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/riesgos/proceso")}}">Registro Procesos</a>
                <span class="fa fa-chevron-right"></span>
                <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/riesgos/add_partes")."/".$oportunidades[0]->ri_requisitos[0]->partes[0]->id_proceso}}">Partes interesadas</a>
                <span class="fa fa-chevron-right"></span>
                <span>Oportunidad</span>
            </p>

            <h2 class="tw:w-full tw:text-brand-500 tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Oportunidad: {{$oportunidades[0]->des_oportunidad or ""}}</h2>
            <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                      <h3 class="tw:text-red-600 tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"> Factor de la oportunidad: {{$oportunidades[0]->calificacion * $oportunidades[0]->calif_beneficio}}</h3>
                </div>
                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                   <h3 class="tw:text-brand-500 tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"> Calificación limite/umbral: {{$umbral[0]->numero}}</h3>
                </div>
            </div>


            
    <div class="tw:w-full tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:lg:w-full tw:px-2">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <h3 class="tw:flex tw:w-full tw:items-center tw:justify-between tw:gap-3 tw:px-2 tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">Probabilidad de lograr la oportunidad
                        <span data-toggle="modal" data-target="#modal_modificar_oportunidad"><a href="#!" class="tw:text-brand-500 tw:hover:text-brand-600"><span aria-hidden="true" class="fa fa-cog" data-toggle="tooltip" title="Modificar oportunidad"></span></a></span>
                    </h3>
                </div>
                <div class="tw:p-5 tw:sm:p-6">

                    {{--$oportunidades--}}
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                        <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                           Probabilidad
                            <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300"><strong>{{isset($oportunidades[0]->ri_o_probabilidad[0])?$oportunidades[0]->ri_o_probabilidad[0]->des_probabilidad:"Sin datos"}}</strong></h5>

                        </div>
                        <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                            Calificacion de la probabilidad
                            <h5 class="tw:pl-4 tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300"><strong>{{$oportunidades[0]->calificacion}}</strong></h5>

                        </div>
                    </div>

                    <div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                Potencial para la apertura de nuevos programas de estudio
                                <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">
                                   <strong>{{isset($oportunidades[0]->ri_o_potencialapertura[0])?$oportunidades[0]->ri_o_potencialapertura[0]->des_potencialapertura:"Sin datos"}}</strong>


                                </h5>

                            </div>
                            <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                               Potencial del crecimiento de la matricula actual
                                <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">
                                    <strong>{{isset($oportunidades[0]->ri_o_potencialcrecimiento[0])?$oportunidades[0]->ri_o_potencialcrecimiento[0]->des_potencialcrecimiento:"Sin Datos"}}</strong>

                                </h5>
                               {{--
                                @section('modal_modi_descRiesgo')
                                    @include('riesgos.partials.modal_modi_desRiesgo')
                                @show
                                --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tw:w-full tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:lg:w-full tw:px-2">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <h3 class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:px-2">Beneficio Potencial de la oportunidad</h3>
                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                        <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                            Mejora potencial en la satisfaccion del cliente
                            <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300"><strong>{{isset($oportunidades[0]->ri_o_mejoracliente[0])?$oportunidades[0]->ri_o_mejoracliente[0]->des_mejoracliente:"Sin Datos"}}</strong></h5>
                        </div>
                        <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                            Mejora potencial de los procesos internos del SGC
                            <h5 class="tw:pl-4 tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300"><strong>{{isset($oportunidades[0]->ri_o_mejorasgc[0])?$oportunidades[0]->ri_o_mejorasgc[0]->des_mejorasgc:"Sin Datos"}}</strong></h5>
                        </div>
                        <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                            Calificación del Beneficio
                            <h5 class="tw:pl-4 tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300"><strong>{{$oportunidades[0]->calif_beneficio}}</strong></h5>
                        </div>
                    </div>
                    <div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                Mejora de la reputación de la Institución
                                <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">
                                    <strong>{{isset($oportunidades[0]->ri_o_mejorareputacion[0])?$oportunidades[0]->ri_o_mejorareputacion[0]->des_mejorareputacion:"Sin Datos"}}</strong>
                                </h5>
                            </div>
                            <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                Potencial costo de implementación
                                <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">
                                    <strong>{{isset($oportunidades[0]->ri_o_potencialcosto[0])?$oportunidades[0]->ri_o_potencialcosto[0]->des_potencialcosto:"Sin Datos"}}</strong>
                                </h5>
                                {{--
                                 @section('modal_modi_descRiesgo')
                                     @include('riesgos.partials.modal_modi_desRiesgo')
                                 @show
                                 --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tw:w-full tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:lg:w-full tw:px-2">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <h3 class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:px-2">Plan de Seguimiento de Oportunidades <button data-toggle="modal"  data-tooltip="true"  title="Agregar" data-target="#modal_crear_plan" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><span class="fa fa-plus" aria-hidden="true"></span></button></h3>
                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                        <div class="tw:w-full tw:px-2">
                            <ul class="tw:divide-y tw:divide-gray-100 tw:rounded-lg tw:border tw:border-gray-200 tw:dark:border-gray-800">
                                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                                    <thead>
                                        <tr>
                                            <th class="tw:w-full tw:text-center tw:lg:w-2/12 tw:px-2">
                                                Fecha inicial
                                            </th>
                                            <th class="tw:w-full tw:text-center tw:lg:w-2/12 tw:px-2">
                                                Fecha propuesta
                                            </th>
                                            <th class="tw:w-full tw:lg:w-8/12 tw:text-center tw:px-2">
                                                Accion del plan de seguimiento
                                            </th>
                                            <th class="tw:w-full tw:lg:w-1/12 tw:text-center tw:px-2">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    {{--$oportunidades[0]->ri_o_planseguimiento--}}
                                    @foreach($oportunidades[0]->ri_o_planseguimiento as $plan_seguimiento)

                                        <tr>
                                            <td class="tw:w-full tw:lg:w-2/12 tw:text-center tw:px-2">
                                                {{$plan_seguimiento->fecha_inicial}}
                                            </td>
                                            <td class="tw:w-full tw:lg:w-2/12 tw:text-center tw:px-2">
                                                {{$plan_seguimiento->fecha}}
                                            </td>
                                            <td class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                                <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300"><strong>{{$plan_seguimiento->des_planseguimiento}}</strong></h5>
                                            </td>
                                            <td class="tw:w-full tw:lg:w-1/12 tw:px-2">
                                                <a class="btn_delete_plan_seguimiento tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" data-id="{{$plan_seguimiento->id_planseguimiento}}"><span aria-hidden="true"  class="fa fa-trash" data-toggle="tooltip" title="Eliminar accion"></span></a>
                                                <a class="btn_edit_plan_seguimiento tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="modal" data-target="#modal_edit_accion" data-url="" data-id="{{$plan_seguimiento->id_planseguimiento}}"><span aria-hidden="true" class="fa fa-cog" data-toggle="tooltip" title="Editar accion"></span></a>

                                                <br>
                                                <a href="#!" class="btn_add_evidencia_oportunidad tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-id="{{$plan_seguimiento->id_planseguimiento}}" data-toggle="modal" data-target="#modal_add_evidencia" ><span class="fa fa-file" data-toggle="tooltip" data-placement="top" title="Adjuntar evidencia"></span></a>

                                                @if($plan_seguimiento->file!=null)
                                                    <a href="{{asset("storage/".$plan_seguimiento->file)}}" target="_blank" class="btn_add_evidencia_oportunidad tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><span class="fa fa-camera" data-toggle="tooltip" data-placement="top" title="Ver evidencia"></span></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
</div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- Modal -->
    <x-panel.modal id="modal_crear_plan" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Accion para plan de oportunidades
                        
                    </h5>

                </div>
                <form id="form_plan_oportunidad" class="" role="form" method="POST" action="{{url("riesgos/planseguimiento")}}">
                    <div class="tw-modal-cuerpo">
                        {{ csrf_field() }}

                        <input type="hidden" value="{{$oportunidades[0]->id_oportunidad}}" name="id_oportunidad_plan">
                        <div class="tw:mb-4">
                            <label for="des_plan_oportunidad" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Descripcion</label>
                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="des_plan_oportunidad" id="des_plan_oportunidad" cols="3" rows="3"></textarea>
                        </div>
                        <h3 class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700">Después de establecer las fechas no podrá realizar ningún cambio, asegúrese de verificar que sean correctas.</h3>

                        <div class="tw:mb-4">
                            <label for="fecha_inicial" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Fecha inicial</label>
                            <div class="date tw:flex tw:w-full tw:items-stretch" id="date_picker_fecha" data-provide="datepicker">
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="fecha_inicial" name="fecha_inicial" />
                                <div class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-3 tw:text-sm tw:text-gray-600 tw:dark:text-gray-400">
                                    <span class="fa fa-th"></span>
                                </div>
                            </div>
                        </div>
                        <div class="tw:mb-4">
                            <label for="fecha_entrega" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Fecha entrega</label>
                            <div class="date tw:flex tw:w-full tw:items-stretch" id="date_picker_group" data-provide="datepicker">
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="fecha_entrega" name="fecha_entrega" />
                                <div class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-3 tw:text-sm tw:text-gray-600 tw:dark:text-gray-400">
                                    <span class="fa fa-th"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="h-secondary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="h-primary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Aceptar</button>
                    </div>
                </form>
            </x-panel.modal>
    <x-panel.modal id="modal_modificar_oportunidad" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Accion para plan de oportunidades
                        
                    </h5>

                </div>
                <form id="form_modificar_oportunidad" class="" role="form" method="POST" action="{{url("riesgos/regoportunidad")."/".$oportunidades[0]->id_oportunidad}}">
                    <div class="tw-modal-cuerpo">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <h3 class="tw:w-full tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Probabilidad de lograr la oportunidad</h3>
                            <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2">
                                <label for="id_probabilidad" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Probabilidad</label>
                                <select name="id_probabilidad" id="id_probabilidad" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                    <option value="" selected disabled>Seleccione un valor</option>
                                    @foreach( $probabilidades as $probabilidad)
                                        <option value="{{$probabilidad->id_probabilidad}}" {{$probabilidad->id_probabilidad==$oportunidades[0]->id_probabilidad?"selected":""}}>{{$probabilidad->des_probabilidad}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2">
                                <label for="id_ocurrenciap" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Ocurrecias previas</label>
                                <select name="id_ocurrenciap" id="id_ocurrenciap" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                    <option value="" selected disabled>Seleccione un valor</option>
                                    @foreach( $ocurrenciaps as $ocurrenciap)
                                        <option value="{{$ocurrenciap->id_ocurrenciap}}" {{$ocurrenciap->id_ocurrenciap==$oportunidades[0]->id_ocurrenciap?"selected":""}}>{{$ocurrenciap->des_ocurrenciasp}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2">
                                <label for="id_potencialapertura" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Potencial de apertura de nuevos programas de estudio</label>
                                <select name="id_potencialapertura" id="id_potencialapertura" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                    <option value="" selected disabled>Seleccione un valor</option>
                                    @foreach( $potencialaperturas as $potencialapertura)
                                        <option value="{{$potencialapertura->id_potencialapertura}}" {{$potencialapertura->id_potencialapertura==$oportunidades[0]->id_potencialapertura?"selected":""}}>{{$potencialapertura->des_potencialapertura}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2">
                                <label for="id_potencialcreciminto" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Potencial de crecimiento de la matrícula actual</label>
                                <select name="id_potencialcrecimiento" id="id_potencialcrecimiento" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                    <option value="" selected disabled>Seleccione un valor</option>
                                    @foreach( $potencialcrecimientos as $potencialcrecimiento)
                                        <option value="{{$potencialcrecimiento->id_potencialcrecimiento}}" {{$potencialcrecimiento->id_potencialcrecimiento==$oportunidades[0]->id_potencialcrecimiento?"selected":""}}>{{$potencialcrecimiento->des_potencialcrecimiento}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <h3 class="tw:w-full tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Beneficio potencial de la oportunidad</h3>
                            <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2">
                                <label for="id_mejoracliente" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Mejora potencial en la satisfaccion del cliente</label>
                                <select name="id_mejoracliente" id="id_mejoracliente" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                    <option value="" selected disabled>Seleccione un valor</option>
                                    @foreach( $mejoraclientes as $mejoracliente)
                                        <option value="{{$mejoracliente->id_mejoracliente}}" {{$mejoracliente->id_mejoracliente==$oportunidades[0]->id_mejoracliente?"selected":""}}>{{$mejoracliente->des_mejoracliente}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2">
                                <label for="id_mejorasgc" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Mejora potencial de los procesos internos del SGC</label>
                                <select name="id_mejorasgc" id="id_mejorasgc" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                    <option value="" selected disabled>Seleccione un valor</option>
                                    @foreach( $mejorasgcs as $mejorasgc)
                                        <option value="{{$mejorasgc->id_mejorasgc}}" {{$mejorasgc->id_mejorasgc==$oportunidades[0]->id_mejorasgc?"selected":""}}>{{$mejorasgc->des_mejorasgc}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2">
                                <label for="id_mejorareputacion" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Mejora de la reputación de la Institución</label>
                                <select name="id_mejorareputacion" id="id_mejorareputacion" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                    <option value="" selected disabled>Seleccione un valor</option>
                                    @foreach( $mejorareputacions as $mejorareputacion)
                                        <option value="{{$mejorareputacion->id_mejorareputacion}}" {{$mejorareputacion->id_mejorareputacion==$oportunidades[0]->id_mejorareputacion?"selected":""}}>{{$mejorareputacion->des_mejorareputacion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2">
                                <label for="id_potencialcosto" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Potencial costo de implementación</label>
                                <select name="id_potencialcosto" id="id_potencialccosto" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                    <option value="" selected disabled>Seleccione un valor</option>
                                    @foreach( $potencialcostos as $potencialcosto)
                                        <option value="{{$potencialcosto->id_potencialcosto}}" {{$potencialcosto->id_potencialcosto==$oportunidades[0]->id_potencialcosto?"selected":""}}>{{$potencialcosto->des_potencialcosto}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="h-secondary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="h-primary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Aceptar</button>
                    </div>
                </form>
            </x-panel.modal>


{{--Modal form edit accion--}}
    <form id="form_edit_accion" class="" role="form" method="POST" action="">
        <x-panel.modal id="modal_edit_accion" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Editar accion</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        {{ csrf_field() }}
                        @csrf
                        @method('PUT')
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="des_planseguimiento">Accion para plan de oportunidades </label>
                                    <input id="des_planseguimiento" name="des_planseguimiento" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"/>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="fecha_inicial" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Fecha inicial</label>
                                    <div class="date tw:flex tw:w-full tw:items-stretch" id="date_picker_fecha_inicial" data-provide="datepicker">
                                        <input  class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="f_inicial" name="f_inicial" disabled="true"/>
                                        <div class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-3 tw:text-sm tw:text-gray-600 tw:dark:text-gray-400">
                                            <span class="fa fa-th"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="fecha_entrega" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Fecha entrega</label>
                                    <div class="date tw:flex tw:w-full tw:items-stretch" id="date_picker_fecha_final" data-provide="datepicker">
                                        <input  class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="f_entrega" name="f_entrega" disabled="true"/>
                                        <div class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-3 tw:text-sm tw:text-gray-600 tw:dark:text-gray-400">
                                            <span class="fa fa-th"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input id="save_accion" type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Guardar"/>
                    </div>
                </x-panel.modal>
    </form>

    {{--form delete accion--}}
    <form action="" method="POST" role="form" id="form_delete">
        {{method_field('DELETE') }}
        {{ csrf_field() }}
    </form>

<x-panel.modal id="modal_add_evidencia" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Editar control de riesgo</h5>
                
            </div>
            <form id="form_add_evidencia" class="" role="form" method="POST" action="" enctype="multipart/form-data" />
            @csrf
            @method("PUT")
            <div class="tw-modal-cuerpo">

                <div class="tw:mb-4">
                    <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Evidencia</label>
                    <input name="evidencia" id="evidencia"  class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden" type="file" accept="application/pdf">
                </div>
            </div>
            <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                <button type="button" class="h-secondary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="h-primary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Aceptar</button>
            </div>
            </form>
        </x-panel.modal>

    <script type="text/javascript">
    $(document).ready(function() {

        $(".btn_add_evidencia_oportunidad").click(function(){
            $("#form_add_evidencia").attr("action","{{url("riesgos/seguimiento/file_oportunidad/")}}/"+$(this).data("id"));
        });

        $(".btn_edit_plan_seguimiento").click(function(){
            var id=$(this).data("id");
            $.get("/riesgos/planseguimiento/"+id+"/edit",function(res){
                $("#form_edit_accion").attr("action","/riesgos/planseguimiento/"+id);
                $("#des_planseguimiento").val(res.des_planseguimiento);
                $("#f_inicial").val(res.fecha_inicial);
                $("#f_entrega").val(res.fecha);
                $("#modal_edit_accion").modal("show");
            });
        });
        $(".btn_delete_plan_seguimiento").click(function(){
            var id=$(this).data('id');
           // TNotify.alert(id)




Swal.fire({
                    title: '¿Seguro que desea eliminar?',
            type:'error',
                    showCancelButton: true,
                    confirmButtonText: `Aceptar`,
                    cancelButtonText: `Cancelar`,
                }).then((result) => {
  /* Read more about isConfirmed, isDenied below */
                    if (result.value) {
                        $("#form_delete").attr("action","/riesgos/planseguimiento/"+id)
                        $("#form_delete").submit();
                    }
                });
        });
        $("#form_plan_oportunidad").validate({
            rules: {
                des_plan_oportunidad: {
                    required: true,
                },
                fecha_entrega:{
                    required: true,
                },

            },
        });
        $("#form_modificar_oportunidad").validate({
            rules: {
                id_probabilidad: {
                    required: true,
                },
                id_ocurrenciap:{
                    required: true,
                },

                id_potencialapertura:{
                    required: true,
                },
                id_potencialcrecimiento:{
                    required: true,
                },
                id_mejoracliente:{
                    required: true,
                },
                id_mejorasgc:{
                    required: true,
                },
                id_mejorareputacion:{
                    required: true,
                },
                id_potencialcosto:{
                    required: true,
                },


            },
        });
        $('#date_picker_group').datepicker({
            format: 'yyyy/mm/dd',
            language: 'es',
            autoclose: true,
            startDate: '+1d',

        });
        $('#date_picker_fecha').datepicker({
            format: 'yyyy/mm/dd',
            language: 'es',
            autoclose: true,
            startDate: '+1d',

        });
        $('#date_picker_fecha_inicial').datepicker({
            format: 'yyyy/mm/dd',
            language: 'es',
            autoclose: true,
            startDate: '+1d',

        });
        $('#date_picker_fecha_final').datepicker({
            format: 'yyyy/mm/dd',
            language: 'es',
            autoclose: true,
            startDate: '+1d',

        });

    });
    //var $j = jQuery.noConflict();


    </script>
</div>
@endsection