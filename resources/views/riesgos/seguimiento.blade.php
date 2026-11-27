@extends('layouts.panel')
@section('title', 'Seguimiento')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado titulo="Seguimiento del sistema de riesgos y oportunidades" :migas="['Riesgos y oportunidades' => null]" />
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            {{--<div class=" tw:w-10/12 tw:px-2">--}}
            {{--<p>--}}
            {{--<span class="fa fa-arrow-right"></span>--}}
            {{--<a href="{{url("/home")}}">Home</a>--}}
            {{--<span class="fa fa-chevron-right"></span>--}}
            {{--<span>Registro Procesos</span>--}}
            {{--</p>--}}
            {{--<br>--}}
            {{--</div>--}}
            
        </div>

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div id="accordion" class="">
                    @foreach($unidades as $unidad)
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:bg-green-100">
                                <a data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseunidades{{$unidad->id_unidad_admin}}"
                                   class="btn_open_panel">{{$unidad->nom_departamento}}</a>
                            </div>
                            <div id="collapseunidades{{$unidad->id_unidad_admin}}" class="collapse">
                                <div class="tw:p-5 tw:sm:p-6">
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div id="accordion2" class="tw:w-full">
                                            @foreach($unidad->proceso_unidad as $unidad_proceso)

                                                @if(isset($unidad_proceso->proceso[0]))
                                                    @if($unidad_proceso->proceso[0]->id_sistema!=3)
                                                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                                                        <a data-toggle="collapse" data-parent="#accordion2"
                                                           href="#collapse2{{$unidad_proceso->id_proceso_unidad}}"
                                                           class="btn_open_panel">{{isset($unidad_proceso->proceso[0]->des_proceso)?$unidad_proceso->proceso[0]->des_proceso:"Sin datos"}}</a>
                                                    </div>
                                                    <div id="collapse2{{$unidad_proceso->id_proceso_unidad}}"
                                                         class="collapse">
                                                        <div class="tw:p-5 tw:sm:p-6">
                                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                                <div class="tw:w-full tw:lg:w-full tw:px-2">
                                                                    <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800 tw:mb-4" id="pills-tab"
                                                                        role="tablist">
                                                                        <li class="">
                                                                        </li>
                                                                        <li class="">
                                                                            <a class="tw-pestana" id="pills-profile-tab"
                                                                               data-toggle="pill"
                                                                               href="#riesgos{{$unidad_proceso->id_proceso_unidad}}"
                                                                               role="tab" aria-controls="pills-profile"
                                                                               aria-selected="false">Riesgos</a>
                                                                        </li>
                                                                        <li class="">
                                                                            <a class="tw-pestana" id="pills-contact-tab"
                                                                               data-toggle="pill"
                                                                               href="#oportunidades{{$unidad_proceso->id_proceso_unidad}}"
                                                                               role="tab" aria-controls="pills-contact"
                                                                               aria-selected="false">Oportunidades</a>
                                                                        </li>
                                                                    </ul>


                                                                    <div class="tab-content" id="pills-tabContent">
                                                                        <div class="tab-pane fade"
                                                                             id="riesgos{{$unidad_proceso->id_proceso_unidad}}"
                                                                             role="tabpanel"
                                                                             aria-labelledby="pills-profile-tab">

                                                                            @foreach($unidad_proceso->procesoParte as $parte)
                                                                                @if($parte->id_proceso==$unidad_proceso->id_proceso)
                                                                                    @foreach ($parte->requisitos as $requisito)
                                                                                        @foreach ($requisito->riesgosunidad($unidad->id_unidad_admin) as $riesgo)
                                                                                            {{--riesgo mostrar--}}

                                                                                            <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Riesgo: {{$riesgo->des_riesgo}}</h3>
                                                                                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla">
                                                                                                <thead>
                                                                                                <tr>
                                                                                                    <th scope="col">
                                                                                                        Acciones
                                                                                                    </th>
                                                                                                    <th scope="col">
                                                                                                        Fecha
                                                                                                    </th>
                                                                                                    <th>Modificar</th>
                                                                                                </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                @foreach ($riesgo->registro_riesgo as $registro_riesgo)
                                                                                                    @foreach ($registro_riesgo->factorRiesgo as $factor_riesgo)
                                                                                                        @foreach ($factor_riesgo->riAcciones as $acciones)

                                                                                                            <tr>
                                                                                                                <td>{{$acciones->accion}}</td>
                                                                                                                <td id="date_riesgo{{$acciones->id_estrategia_a}}">{{$acciones->fecha}}</td>
                                                                                                                <td>
                                                                                                                    <a class="btn_edit_date_accion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="modal" data-target="#modal_edit_date_accion" data-url="" data-id="{{$acciones->id_estrategia_a}}" data-value="{{$acciones->fecha}}"><span aria-hidden="true" class="fa fa-cog" data-toggle="tooltip" title="Editar accion"></span></a>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        @endforeach
                                                                                                    @endforeach
                                                                                                @endforeach
                                                                                                </tbody>
                                                                                            </table>
</div>
                                                                                        @endforeach
                                                                                    @endforeach
                                                                                @endif
                                                                            @endforeach

                                                                        </div>
                                                                        <div class="tab-pane fade"
                                                                             id="oportunidades{{$unidad_proceso->id_proceso_unidad}}"
                                                                             role="tabpanel"
                                                                             aria-labelledby="pills-contact-tab">
                                                                            @foreach($unidad_proceso->procesoParte  as $parte)
                                                                                @if($parte->id_proceso==$unidad_proceso->id_proceso)
                                                                                    @foreach ($parte->requisitos as $requisito)
                                                                                        @foreach ($requisito->oportunidadesunidad($unidad->id_unidad_admin) as $oportunidad)
                                                                                            {{--riesgo mostrar--}}
                                                                                            <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Oporunidad: {{$oportunidad->des_oportunidad}}</h3>
                                                                                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla">
                                                                                                <thead>
                                                                                                <tr>
                                                                                                    <th scope="col">
                                                                                                        Acciones
                                                                                                    </th>
                                                                                                    <th scope="col">
                                                                                                        Fecha
                                                                                                    </th>
                                                                                                    <th>Modificar</th>
                                                                                                </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                @foreach ($oportunidad->ri_o_planseguimiento as $plan_seguimiento)

                                                                                                            <tr>
                                                                                                                <td>{{$plan_seguimiento->des_planseguimiento}}</td>
                                                                                                                <td id="date_oportunidad{{$plan_seguimiento->id_planseguimiento}}">{{$plan_seguimiento->fecha}}</td>
                                                                                                                <td>
                                                                                                                <a class="btn_edit_date_accion_oportunidad tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="modal" data-target="#modal_edit_date_accion" data-url="" data-id="{{$plan_seguimiento->id_planseguimiento}}" data-value="{{$plan_seguimiento->fecha}}"><span aria-hidden="true" class="fa fa-cog" data-toggle="tooltip" title="Editar accion"></span></a>
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                @endforeach
                                                                                                </tbody>
                                                                                            </table>
</div>
                                                                                        @endforeach
                                                                                    @endforeach
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                    @endif
                                                @endif
                                            @endforeach
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

@section('cont_modals_edit_dates')
    @include('riesgos.partials.edit_dates')
@show

<script type="text/javascript">
    $(document).ready(function(){
        var ban=false;
       $(".btn_edit_date_accion_oportunidad").click(function(){
           ban=false;
           $("#form_edit_date_riesgo").attr("action","{{url("riesgos/seguimiento/date_oportunidad")}}/"+$(this).data("id"));
           $("#fecha_final_edit_ri").val($(this).data("value"));
           $("#id_date_riesgo").val($(this).data("id"));
       });
        $(".btn_edit_date_accion").click(function(){
            ban=true;
            $("#form_edit_date_riesgo").attr("action","{{url("riesgos/seguimiento/date_riesgo")}}/"+$(this).data("id"));
            $("#fecha_final_edit_ri").val($(this).data("value"));
            $("#id_date_riesgo").val($(this).data("id"));
        });
       $("#update_date_riesgo").click(function(){
           $("#form_edit_date_riesgo").serialize();
           $.post($("#form_edit_date_riesgo").attr("action"), $("#form_edit_date_riesgo").serialize(),function(res){
               if(ban)
                    $("#date_riesgo"+ $("#id_date_riesgo").val()).html($("#fecha_final_edit_ri").val());
               else
                   $("#date_oportunidad"+ $("#id_date_riesgo").val()).html($("#fecha_final_edit_ri").val());

               $("#modal_edit_date_accion").modal("hide");
           })
       });

    });
</script>
</div>
@endsection