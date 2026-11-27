@extends('layouts.panel')
@section('title', 'Riesgos')
@include('partials.panel.recursos_app', ['validacion' => true, 'datepicker' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Detalle del riesgo" :migas="['Riesgos y oportunidades' => null]" />

    @include("riesgos.partials.msg_ok")

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:w-full tw:px-2">
            <p class="tw:w-full">
                <span class="fa fa-arrow-right"></span>
                <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/riesgos/proceso")}}">Registro Procesos</a>
                <span class="fa fa-chevron-right"></span>
                <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/riesgos/add_partes")."/".(isset($datos_registro_riesgo[0]->riesgos[0]->getRequisito[0])?$datos_registro_riesgo[0]->riesgos[0]->getRequisito[0]->partes[0]->id_proceso:"")}}">Partes interesadas</a>
                <span class="fa fa-chevron-right"></span>
                <span>Riesgos del requisito</span>
            </p>
            <div class="tw:w-full tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:lg:w-full tw:px-2">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <h3 class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:px-2">Riesgo del requisito {{isset($datos_registro_riesgo[0]->riesgos[0]->getRequisito[0])?$datos_registro_riesgo[0]->riesgos[0]->getRequisito[0]->des_requisito:""}} </h3>
                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                            Numero de riesgo
                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><strong>{{isset($datos_registro_riesgo[0]->numero)?$datos_registro_riesgo[0]->numero:""}}</strong></h4>
                        </div>
                        <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                            Unidad administrativa
                            <h5 class="tw:pl-4 tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300"><strong>{{isset($datos_registro_riesgo[0]->unidadAdmin[0])?$datos_registro_riesgo[0]->unidadAdmin[0]->nom_departamento:""}}</strong></h5>
                        </div>
                        <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                            Nombre del riesgo
                            <h5 class="tw:pl-4 tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300"><strong>{{(isset($datos_registro_riesgo[0]->riesgos[0])?$datos_registro_riesgo[0]->riesgos[0]->des_riesgo:"")}}</strong></h5>
                        </div>
                    </div>
                    <div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                Posibles efectos del riesgo
                                <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">
                                   <strong>{{isset($datos_registro_riesgo[0]->valEfectos[0])?$datos_registro_riesgo[0]->valEfectos[0]->efecto:""}}</strong>
                                </h5>
                                {{--<span data-toggle="modal" data-target="#modal_efectos" class=""><a href="#!" class="h-primary_m tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:px-12 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Modificar</a></span>--}}
                                <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300"><a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" href="#!" data-toggle="modal" data-target="#modal_efectos"><span class="fa fa-cog"></span></a></h5>
                            </div>
                            <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                Descripcion del riesgo
                                <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">
                                    <strong>{{$datos_registro_riesgo[0]->descip_riesgo}}</strong>
                                </h5>
                                <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">
                                    <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" href="#!" data-toggle="modal" data-target="#modal_modi_descRiesgo"><span class="fa fa-cog"></span></a>
                                </h5>
                                {{---
                                @section('modal_modi_descRiesgo')
                                    @include('riesgos.partials.modal_modi_desRiesgo')
                                @show
                                --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <h3 class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:px-2">Valoracion inicial y estrategia</h3>
                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:lg:w-full tw:px-2">
                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada border-table tw-tabla">
                                <thead class="tw:text-center">
                                <tr class="table-active">
                                    <th class="tw:w-full tw:text-center tw:lg:w-5/12 tw:px-2">Grado de impacto</th>
                                    <th class="tw:w-full tw:text-center tw:lg:w-5/12 tw:px-2">Probabilidad ocurrencia</th>
                                    <th class="tw:w-full tw:text-center tw:lg:w-2/12 tw:px-2">Cuadrante</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="tw:w-full tw:lg:w-4/12 tw:px-2">{{isset($datos_registro_riesgo[0]->valEfectos[0])?$datos_registro_riesgo[0]->valEfectos[0]->grado_impacto:""}}</td>
                                    <td class="tw:w-full tw:lg:w-5/12 tw:px-2">{{isset($datos_registro_riesgo[0]->valEfectos[0])?$datos_registro_riesgo[0]->valEfectos[0]->probabilidad:""}}</td>
                                    @if($datos_registro_riesgo[0]->valEfectos[0]->getCuadrantei()==1)
                                        <td class="cuad_ini tw:w-full tw:lg:w-2/12 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:px-2">I</td>
                                    @elseif($datos_registro_riesgo[0]->valEfectos[0]->getCuadrantei()==2)
                                        <td class="cuad_ini tw:w-full tw:lg:w-2/12 tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:px-2">II</td>
                                    @elseif($datos_registro_riesgo[0]->valEfectos[0]->getCuadrantei()==3)
                                        <td class="cuad_ini tw:w-full tw:lg:w-2/12 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:px-2">III</td>
                                    @elseif($datos_registro_riesgo[0]->valEfectos[0]->getCuadrantei()==4)
                                        <td class="cuad_ini tw:w-full tw:lg:w-2/12 tw:bg-sky-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-sky-600 tw:px-2">IV</td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
</div>
                            <strong>Estrategia</strong>
                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                                @foreach($datos_registro_riesgo[0]->estrategiaRiesgo as $estrategia)
                                <li class="tw:block tw:px-4 tw:py-3">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-10/12 tw:px-2">
                                <h5 class="estrategia_r tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">{{$estrategia->getEstrategia[0]->descripcion}}</h5>
                                </div>
                                </div>
                                </li>
                                @endforeach
                            </h4>
                        </div>
                    </div>
                </div>
            </div>



            @if(isset($datos_registro_riesgo[0]->estrategiaRiesgo[0]))

            @if(((strtolower($datos_registro_riesgo[0]->estrategiaRiesgo[0]->getEstrategia[0]->descripcion)!="asumir el riesgo")&&(strtoupper($datos_registro_riesgo[0]->riesgos[0]->getRequisito[0]->partes[0]->proceso[0]->sistema[0]->desc_sistema)=="SGOE"))||(strtoupper($datos_registro_riesgo[0]->riesgos[0]->getRequisito[0]->partes[0]->proceso[0]->sistema[0]->desc_sistema)=="COCODI"))

                    <div class="adicionales tw:w-full tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:lg:w-full tw:px-2">
                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <h3 class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:px-2">Factores</h3>
                        </div>
                        <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800">
                            <div class="tab-content">
                                <div class="tab-pane fade active in tw:text-center" id="factores">
                                    <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300"><a href="#" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="modal" data-target="#modal_riesgos"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar factor"></span></a></h5>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="col-12 col-auto tw:w-full">
                                            <div>
                                                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla">
                                                    <thead class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                    <th class="tw:w-full tw:lg:w-1/12 tw:xl:w-1/12 tw:text-center tw:px-2">No. de factor</th>
                                                    <th class="tw:w-full tw:lg:w-4/12 tw:xl:w-4/12 tw:text-center tw:px-2">Descripción</th>
                                                    <th class="tw:w-full tw:lg:w-3/12 tw:xl:w-3/12 tw:text-center tw:px-2">Clasificación</th>
                                                    <th class="tw:w-full tw:lg:w-1/12 tw:xl:w-1/12 tw:text-center tw:px-2">Tipo</th>
                                                    <th class="tw:w-full tw:lg:w-2/12 tw:xl:w-2/12 tw:text-center tw:px-2">¿Tiene controles?</th>
                                                    <th class="tw:w-full tw:lg:w-1/12 tw:xl:w-1/12 tw:text-center tw:px-2">Acciones</th>
                                                    </thead>
                                                </table>
</div>

                                                <div id="accordion" role="tablist" aria-multiselectable="true">
                                                    {{Session::put('controlado','SI')}}
                                                    @foreach($datos_registro_riesgo[0]->factorRiesgo as $ri_factor)
                                                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                                            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4" role="tab" id="heading{{$ri_factor->id_factor}}">
                                                                <h5 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">
                                                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                                        <div class="tw:w-full tw:lg:w-1/12 tw:xl:w-1/12 tw:text-center tw:px-2">{{(explode("-",$datos_registro_riesgo[0]->numero)[1]).".".$ri_factor->no_factor}}</div>
                                                                        <div class="tw:w-full tw:lg:w-4/12 tw:xl:w-4/12 tw:text-center tw:px-2">

                                                                                <a role="button" data-toggle="collapse" data-id="{{$ri_factor->id_factor}}" class="btn_collapse_factor" data-parent="#accordion" href="#collapse{{$ri_factor->id_factor}}" aria-expanded="true" aria-controls="collapse{{$ri_factor->id_factor}}">
                                                                                    {{$ri_factor->descripcion_f}}
                                                                                </a>

                                                                        </div>

                                                                        <div class="tw:w-full tw:lg:w-3/12 tw:xl:w-3/12 tw:text-center tw:px-2">{{$ri_factor->ri_clasi_f[0]->des_cl_f}}</div>
                                                                        <div class="tw:w-full tw:lg:w-1/12 tw:xl:w-1/12 tw:text-center tw:px-2">{{$ri_factor->ri_tipof[0]->des_tf}}</div>
                                                                        <div class="tw:w-full tw:lg:w-2/12 tw:xl:w-2/12 tw:text-center tw:px-2">{{$ri_factor->tiene_controles}}</div>
                                                                        @if($ri_factor->tiene_controles=="NO")
                                                                            {{Session::put('controlado','NO')}}
                                                                        @endif
                                                                        <div class="tw:w-full tw:lg:w-1/12 tw:xl:w-1/12 tw:text-center tw:px-2">
                                                                            <a href="#!" class="btn_delete_element_riesgo tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" data-toggle="tooltip" data-id="{{$ri_factor->id_factor}}" data-url="{{url("riesgos/reg_factor")}}" data-placement="top" title="Eliminar"><span class="fa fa-trash"></span></a>
                                                                            <a href="#!" class="btn_edit_factor tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="modal" data-target="#modal_edit_factor" data-id="{{$ri_factor->id_factor}}" data-url="{{url('riesgos/reg_factor')}}" data-descripcion="{{$ri_factor->descripcion_f}}" data-clasificacion="{{$ri_factor->id_cl_f}}" data-tipo="{{$ri_factor->id_tipo_f}}" data-controles="{{$ri_factor->tiene_controles}}" data-toggle="tooltip" data-placement="top" title="modificar"><span class="fa fa-cog"></span></a>
                                                                        </div>
                                                                    </div>
                                                                </h5>
                                                            </div>


                                                            <div id="collapse{{$ri_factor->id_factor}}" class="collapse {{ Session::get('collapseStatefactor')==$ri_factor->id_factor?'in':'' }}" role="tabpanel" aria-labelledby="heading{{$ri_factor->id_factor}}">

                                                                <div class="tw:p-5 tw:sm:p-6">
                                                                    @section('cont_evaluacion_control'.$ri_factor->id_factor)
                                                                        @include('riesgos.partials.evaluacion_control',['id_factor'=>$ri_factor->id_factor])
                                                                    @show

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                @endif
            @endif


        <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <h3 class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:px-2">Valoracion final</h3>
                        </div>
                        <div class="tw:p-5 tw:sm:p-6">
                            <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300"><a href="#!" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="modal" data-target="#modal_efectos_final"><span class="fa fa-cog"></span></a></h5>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                @if($datos_registro_riesgo[0]->valEfectos[0]->impacto_final!=0 && $datos_registro_riesgo[0]->valEfectos[0]->ocurrencia_final!=0)
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada border-table tw-tabla">
                                            <thead class="tw:text-center">
                                            <tr class="table-active">
                                                <th class="tw:w-full tw:text-center tw:lg:w-5/12 tw:px-2">Grado impacto</th>
                                                <th class="tw:w-full tw:text-center tw:lg:w-5/12 tw:px-2">Probabilidad de ocurrencia</th>
                                                <th class="tw:w-full tw:text-center tw:lg:w-2/12 tw:px-2">Cuadrante</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>

                                                <td class="tw:w-full tw:lg:w-5/12 tw:px-2">{{$datos_registro_riesgo[0]->valEfectos[0]->impacto_final}}</td>
                                                <td class="tw:w-full tw:lg:w-5/12 tw:px-2">{{$datos_registro_riesgo[0]->valEfectos[0]->ocurrencia_final}}</td>
                                                @if($datos_registro_riesgo[0]->valEfectos[0]->getCuadrantef()==1)
                                                    <td class="tw:w-full tw:lg:w-2/12 tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:px-2 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">I</td>
                                                @elseif($datos_registro_riesgo[0]->valEfectos[0]->getCuadrantef()==2)
                                                    <td class="tw:w-full tw:lg:w-2/12 tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:px-2">II</td>
                                                @elseif($datos_registro_riesgo[0]->valEfectos[0]->getCuadrantef()==3)
                                                    <td class="tw:w-full tw:lg:w-2/12 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:px-2">III</td>
                                                @elseif($datos_registro_riesgo[0]->valEfectos[0]->getCuadrantef()==4)
                                                    <td class="tw:w-full tw:lg:w-2/12 tw:bg-sky-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-sky-600 tw:px-2">IV</td>
                                                @endif
                                            </tr>
                                            </tbody>
                                        </table>
</div>
                                    </div>
                                @else
                                    <strong>No se ha asignado la valoracion final</strong>

                                @endif
                            </div>
                        </div>
                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <h3 class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:px-2">Riesgo Controlado Suficientemente</h3>
                        </div>
                        <div class="tw:p-5 tw:sm:p-6">
                            @if(Session::get('controlado')=="NO")
                                <h4 class="tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:text-center tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:px-2">{{Session::get('controlado')}}</div>
                                    </div>
                                </h4>
                            @else
                                <h4 class="tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:text-center tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:px-2">SI</div>
                                    </div>
                                </h4>
                            @endif
                        </div>

                        <form  method="POST" role="form" id="form_delete">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        
    

    <form  method="POST" role="form" id="form_delete_factor">
        @csrf
        @method('DELETE')
    </form>
    <!-- Modal -->
    <!-- Modal efectos-->
   @section('modal_valoracion_efectos')
        @include('riesgos.partials.modal_valoracion_efectos')
   @show

    @section('modal_modiriesgo')
        @include('riesgos.partials.modal_modi_desRiesgo')
    @show
    @section('cont_factores')
        @include('riesgos.partials.factores')
    @show
    @section('cont_modals_control')
        @include('riesgos.partials.modals_control')
    @show
    @section('cont_modals_acciones')
        @include('riesgos.partials.modals_acciones')
    @show

    <x-panel.modal id="modal_estrategias_riesgo" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar estrategias</h5>
                    
                </div>
                <form id="form_estrategias" class="" role="form" method="POST" action="{{url('riesgos/riest_riesgo')}}">
                    <div class="tw-modal-cuerpo">
                        <div class="tw:mb-4">
                            <input hidden type="text" id="id_reg_riesgo" name="id_reg_riesgo" value="{{$datos_registro_riesgo[0]->id_reg_riesgo}}">
                        </div>

                        <div class="tw:mb-4">
                            {{ csrf_field() }}
                            <label for="id_estrategia" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Estrategias</label>
                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="id_estrategia" id="id_estrategia">
                                <option value="" disabled="true" selected="true">Seleccione una opción</option>
                                @foreach($ri_estrategia as $estrategias)
                                    <option value="{{$estrategias->id_estrategia}}">{{$estrategias->descripcion}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="h-secondary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="h-primary_m tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Aceptar</button>
                    </div>
                </form>
            </x-panel.modal>

<script>
    $(document).ready(function () {
        $(".btn_delete_estrategia_ri").click(function(){
            var id=$(this).data('id');




Swal.fire({
                    title: '¿Seguro que desea eliminar?',
            type:'error',
                    showCancelButton: true,
                    confirmButtonText: `Aceptar`,
                    cancelButtonText: `Cancelar`,
                }).then((result) => {
  /* Read more about isConfirmed, isDenied below */
                    if (result.value) {
                        $("#form_delete").attr("action","{{url('riesgos/riest_riesgo')}}/"+id)
                        $("#form_delete").submit();
                    }
                });
        });
        $(".btn_delete_element_riesgo").click(function(){
            var id=$(this).data('id');
            var url=$(this).data("url");




Swal.fire({
                    title: '¿Seguro que desea eliminar?',
            type:'error',
                    showCancelButton: true,
                    confirmButtonText: `Aceptar`,
                    cancelButtonText: `Cancelar`,
                }).then((result) => {
  /* Read more about isConfirmed, isDenied below */
                    if (result.value) {
                        $("#form_delete_factor").attr("action",(url+"/"+id));
                        $("#form_delete_factor").submit();
                    }
                });
        });
        $(".btn_edit_factor").click(function(){
            $("#descripcion_factor_edit").val($(this).data("descripcion"));
            $("#clasi_factor_edit").val($(this).data("clasificacion"));
            $("#tipo_factor_edit").val($(this).data("tipo"));
            $("#have_controls_edit").val($(this).data("controles"));
            $("#form_edit_factor_riesgo").attr("action",($(this).data("url")+"/"+$(this).data("id")));
        });


        $(".btn_collapse_factor").click(function(){
            $.get("{{url('riesgos/registroriesgos/collapse')}}/"+$(this).data("id"));
        });

        $('[data-toggle="tooltip"]').tooltip();

    })
</script>

</div>
@endsection