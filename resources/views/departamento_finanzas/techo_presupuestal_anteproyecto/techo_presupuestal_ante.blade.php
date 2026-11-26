@extends('layouts.panel')
@section('title', 'Techo presupuestal')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado :titulo="'Techo presupuestal del Anteproyecto '.$year" :migas="['Finanzas' => null]" />


        <?php setlocale(LC_MONETARY, 'es_MX');
        ?>



    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="modal" data-target="#modal_agregar_proyecto" title="Agregar  proyecto"><span class="fa fa-plus" aria-hidden="true"></span></button>
        </div>
    </div>

        @foreach($presupuestos_anteproyectos as $presupuesto)
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-1/12 tw:px-2">
                                    {{--  <button type="button" class="modificar_proyecto tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" id="{{$presupuesto['id_presupuesto'] }}" title="Modificar proyecto" > <span class="fa fa-cog" aria-hidden="true"></span></button>
--}}
                                </div>

                                <div class="tw:w-full tw:lg:w-9/12 tw:px-2">
                                    <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">NOMBRE DEL PROYECTO: <b>{{ $presupuesto['nombre_proyecto'] }}</b></h5>
                                </div>
                                <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                    <button class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" onclick="window.location='{{ url('/presupuesto_anteproyecto/techo_presupuestal/agregar_fuentes_f_ante/'.$presupuesto['id_proyecto'] ) }}'">Agregar capitulos</button>
                              {{--      <button type="button" class="agregar_capitulos tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" id="{{$presupuesto['id_presupuesto'] }}" title="Agregar capitulos" > <span class="fa fa-plus" aria-hidden="true"></span></button> --}}
                                </div>
                            </div>
                        </div>

                        <div class="tw:p-5 tw:sm:p-6">
                            @if($contar_f !== 0)
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                         <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90"></th>
                                    <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90" COLSPAN="4"> FUENTE DE FINANCIAMIENTO $</th>
                                    <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90" colspan="4">FUENTE DE FINANCIAMIENTO %</th>
                                </tr>
                                <tr>

                                    <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90">CAPITULO</th>
                                    <th class="tw:text-center">ESTATAL</th>
                                    <th class="tw:text-center">FEDERAL</th>
                                    <th class="tw:text-center">PROPIOS</th>
                                    <th class="tw:text-center">TOTAL</th>
                                    <th class="tw:text-center">ESTATAL</th>
                                    <th class="tw:text-center">FEDERAL</th>
                                    <th class="tw:text-center">PROPIOS</th>
                                    <th class="tw:text-center">TOTAL</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($presupuesto['fuentes_f'] as $fuentes)

                                    <tr>

                                        <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-center">{{ $fuentes['nombre_capitulo'] }}</td>
                                        <?php
                                           $presupuesto_estatal=$fuentes['presupuesto_estatal'];
                                           $presupuesto_estatal= number_format($presupuesto_estatal, 0, ",", ".")
                                        ?>
                                        <td class="tw:text-right">{{ $presupuesto_estatal }}</td>
                                        <?php
                                        $presupuesto_federal=$fuentes['presupuesto_federal'];
                                        $presupuesto_federal= number_format($presupuesto_federal, 2, '.', ',');
                                        ?>
                                        <td class="tw:text-right">{{ $presupuesto_federal }}</td>
                                        <?php
                                        $presupuesto_propios=$fuentes['presupuesto_propios'];
                                         $presupuesto_propios= number_format($presupuesto_propios, 2, '.', ',');
                                        ?>
                                        <td class="tw:text-right">{{ $presupuesto_propios}}</td>
                                        <?php
                                        $total_presupuesto=$fuentes['total_presupuesto'];
                                         $total_presupuesto= number_format($total_presupuesto, 2, '.', ',');
                                        ?>
                                        <td class="tw:text-right">{{ $total_presupuesto }}</td>
                                        @if($fuentes['financiamiento_estatal'] == 0)
                                            <td class="tw:text-right">-</td>
                                        @else
                                        <td class="tw:text-right">{{ round($fuentes['financiamiento_estatal'],4) }}</td>
                                        @endif
                                        @if($fuentes['financiamiento_federal'] == 0)
                                            <td class="tw:text-right">-</td>
                                        @else
                                        <td class="tw:text-right">{{ round($fuentes['financiamiento_federal'],4) }}</td>
                                        @endif
                                        @if($fuentes['financiamiento_propios'] == 0)
                                            <td class="tw:text-right">-</td>
                                        @else
                                        <td class="tw:text-right">{{ round($fuentes['financiamiento_propios'],4) }}</td>
                                        @endif
                                        @if($fuentes['total_financiamiento'] == 0)
                                            <td class="tw:text-right">-</td>
                                        @else
                                        <td class="tw:text-right">{{ $fuentes['total_financiamiento'] }}</td>
                                        @endif

                                    </tr>
                                @endforeach
                                <tr>

                                    <td></td>
                                    <?php
                                    $total_presupuesto_estatal=$presupuesto['total_presupuesto_estatal'];
                                    $total_presupuesto_estatal= number_format($total_presupuesto_estatal, 2, '.', ',');
                                    ?>
                                    <td class="tw:text-right"><b>{{ $total_presupuesto_estatal }}</b></td>
                                    <?php
                                    $total_presupuesto_federal=$presupuesto['total_presupuesto_federal'];
                                    $total_presupuesto_federal= number_format($total_presupuesto_federal, 2, '.', ',');
                                    ?>
                                    <td class="tw:text-right" ><b>{{ $total_presupuesto_federal }}</b></td>
                                    <?php
                                    $total_presupuesto_propios=$presupuesto['total_presupuesto_propios'];
                                   $total_presupuesto_propios= number_format($total_presupuesto_propios, 2, '.', ',');
                                    ?>
                                    <td class="tw:text-right" ><b>{{ $total_presupuesto_propios }}</b></td>
                                    <?php
                                    $total_total_presupuesto=$presupuesto['total_total_presupuesto'];
                                    $total_total_presupuesto= number_format($total_total_presupuesto, 2, '.', ',');
                                    ?>
                                    <td class="tw:text-right" ><b>{{ $total_total_presupuesto }}</b></td>
                                    @if($presupuesto['total_financiamiento_estatal'] == 0)
                                        <td class="tw:text-right">-</td>
                                    @else
                                    <td class="tw:text-right" ><b>{{ round($presupuesto['total_financiamiento_estatal'],4) }}</b></td>
                                    @endif
                                    @if($presupuesto['total_financiamiento_federal'] == 0)
                                        <td class="tw:text-right">-</td>
                                    @else
                                    <td class="tw:text-right" ><b>{{ round($presupuesto['total_financiamiento_federal'],4) }}</b></td>
                                    @endif
                                    @if($presupuesto['total_financiamiento_propios'] == 0)
                                        <td class="tw:text-right">-</td>
                                    @else
                                    <td class="tw:text-right" ><b>{{ round($presupuesto['total_financiamiento_propios'],4) }}</b></td>
                                    @endif
                                    <td class="tw:text-right" ><b>{{ $presupuesto['total_total_financiamiento'] }}</b></td>
                                </tr>

                                </tbody>
                            </table>
</div>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <?php
                                        $total_gastos_operativos=$presupuesto['total_gastos_operativos'] ;
                                        $total_gastos_operativos= number_format($total_gastos_operativos, 2, '.', ',');
                                        ?>
                                        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:bg-yellow-200 tw:dark:bg-yellow-500/20 tw:text-gray-800 tw:dark:text-white/90">GASTO OPERATIVO (2000, 3000, 4000, 5000 Y 6000)     <b>{{$total_gastos_operativos }}</b> </h4>
                                    </div>
                                </div>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @if($contar_f !== 0)
        <?php

        $capitulo1_estatal=0;
        $capitulo1_federal=0;
        $capitulo1_propios=0;
        $total_capitulo1_total=0;
        $capitulo2_estatal=0;
        $capitulo2_federal=0;
        $capitulo2_propios=0;
        $total_capitulo2_total=0;
        $capitulo3_estatal=0;
        $capitulo3_federal=0;
        $capitulo3_propios=0;
        $total_capitulo3_total=0;
        $capitulo4_estatal=0;
        $capitulo4_federal=0;
        $capitulo4_propios=0;
        $total_capitulo4_total=0;
        $capitulo5_estatal=0;
        $capitulo5_federal=0;
        $capitulo5_propios=0;
        $total_capitulo5_total=0;
        $capitulo6_estatal=0;
        $capitulo6_federal=0;
        $capitulo6_propios=0;
        $total_capitulo6_total=0;
        $total_techo_estatal=0;
        $total_techo_federal=0;
        $total_techo_propios=0;
        $total_gasto_operativo=0;
        foreach ($presupuestos_anteproyectos as $pre){
            foreach ($pre['fuentes_f'] as $fuentes){
                if($fuentes['id_capitulo'] == 1){
                    $capitulo1_estatal=$capitulo1_estatal+$fuentes['presupuesto_estatal'];
                    $capitulo1_federal=$capitulo1_federal+$fuentes['presupuesto_federal'];
                    $capitulo1_propios=$capitulo1_propios+$fuentes['presupuesto_propios'];
                    $total_capitulo1_total=$total_capitulo1_total+$fuentes['total_presupuesto'];
                }
                if($fuentes['id_capitulo'] == 2){
                    $capitulo2_estatal=$capitulo2_estatal+$fuentes['presupuesto_estatal'];
                    $capitulo2_federal=$capitulo2_federal+$fuentes['presupuesto_federal'];
                    $capitulo2_propios=$capitulo2_propios+$fuentes['presupuesto_propios'];
                    $total_capitulo2_total=$total_capitulo2_total+$fuentes['total_presupuesto'];
                }
                if($fuentes['id_capitulo'] == 3){
                    $capitulo3_estatal=$capitulo3_estatal+$fuentes['presupuesto_estatal'];
                    $capitulo3_federal=$capitulo3_federal+$fuentes['presupuesto_federal'];
                    $capitulo3_propios=$capitulo3_propios+$fuentes['presupuesto_propios'];
                    $total_capitulo3_total=$total_capitulo3_total+$fuentes['total_presupuesto'];
                }
                if($fuentes['id_capitulo'] == 4){
                    $capitulo4_estatal=$capitulo4_estatal+$fuentes['presupuesto_estatal'];
                    $capitulo4_federal=$capitulo4_federal+$fuentes['presupuesto_federal'];
                    $capitulo4_propios=$capitulo4_propios+$fuentes['presupuesto_propios'];
                    $total_capitulo4_total=$total_capitulo4_total+$fuentes['total_presupuesto'];
                }
                if($fuentes['id_capitulo'] == 5){
                    $capitulo5_estatal=$capitulo5_estatal+$fuentes['presupuesto_estatal'];
                    $capitulo5_federal=$capitulo5_federal+$fuentes['presupuesto_federal'];
                    $capitulo5_propios=$capitulo5_propios+$fuentes['presupuesto_propios'];
                    $total_capitulo5_total=$total_capitulo5_total+$fuentes['total_presupuesto'];
                }
                if($fuentes['id_capitulo'] == 6){
                    $capitulo6_estatal=$capitulo6_estatal+$fuentes['presupuesto_estatal'];
                    $capitulo6_federal=$capitulo6_federal+$fuentes['presupuesto_federal'];
                    $capitulo6_propios=$capitulo6_propios+$fuentes['presupuesto_propios'];
                    $total_capitulo6_total=$total_capitulo6_total+$fuentes['total_presupuesto'];
                }
            }
            $total_techo_estatal=$total_techo_estatal+$pre['total_presupuesto_estatal'];
            $total_techo_federal=$total_techo_federal+$pre['total_presupuesto_federal'];
            $total_techo_propios=$total_techo_propios+$pre['total_presupuesto_propios'];

        }
        $total_presupuesto_total=$total_techo_estatal+$total_techo_federal+$total_techo_propios;
        $total_gasto_operativo=$total_capitulo2_total+$total_capitulo3_total+$total_capitulo4_total+$total_capitulo5_total+$total_capitulo6_total;
        $total_porcentaje_total_estatal=0;
        $total_porcentaje_total_federal=0;
        $total_porcentaje_total_propios=0;
        if($total_techo_estatal!= 0){
            $total_porcentaje_total_estatal=round($total_techo_estatal/$total_presupuesto_total,4);
        }
        if($total_techo_federal!= 0){
            $total_porcentaje_total_federal=round($total_techo_federal/$total_presupuesto_total,4);
        }
        if($total_techo_propios!= 0){
            $total_porcentaje_total_propios=round($total_techo_propios/$total_presupuesto_total,4);
        }
        $total_porcentaje_total=$total_porcentaje_total_estatal+$total_porcentaje_total_federal+$total_porcentaje_total_propios;
        $total_pocentaje_cap1=0;
        $total_pocentaje_cap2=0;
        $total_pocentaje_cap3=0;
        $total_pocentaje_cap4=0;
        $total_pocentaje_cap5=0;
        $total_pocentaje_cap6=0;
        if($capitulo1_estatal == 0){
            $porcentaje_cap1_estatal=0;

        }else{
            $porcentaje_cap1_estatal=round($capitulo1_estatal/$total_capitulo1_total,4);
            $total_pocentaje_cap1= round($total_pocentaje_cap1+$porcentaje_cap1_estatal,2);
        }
        if($capitulo1_federal == 0){
            $porcentaje_cap1_federal=0;
        }else{
            $porcentaje_cap1_federal=round($capitulo1_federal/$total_capitulo1_total,4);
            $total_pocentaje_cap1= round($total_pocentaje_cap1+$porcentaje_cap1_federal,2);
        }
        if($capitulo1_propios == 0){
            $porcentaje_cap1_propios=0;
        }else{
            $porcentaje_cap1_propios=round($capitulo1_propios/$total_capitulo1_total,4);
            $total_pocentaje_cap1= round($total_pocentaje_cap1+$porcentaje_cap1_propios,2);
        }
        ///2
        if($capitulo2_estatal == 0){
            $porcentaje_cap2_estatal=0;

        }else{
            $porcentaje_cap2_estatal=round($capitulo2_estatal/$total_capitulo2_total,4);

            $total_pocentaje_cap2= round($total_pocentaje_cap2+$porcentaje_cap2_estatal,2);
        }
        if($capitulo2_federal == 0){
            $porcentaje_cap2_federal=0;
        }else{
            $porcentaje_cap2_federal=round($capitulo2_federal/$total_capitulo2_total,4);
            $total_pocentaje_cap2= round($total_pocentaje_cap2+$porcentaje_cap2_federal,2);
        }
        if($capitulo2_propios == 0){
            $porcentaje_cap2_propios=0;
        }else{
            $porcentaje_cap2_propios=round($capitulo2_propios/$total_capitulo2_total,4);
            $total_pocentaje_cap2= round($total_pocentaje_cap2+$porcentaje_cap2_propios,2);
        }
        ///3
        if($capitulo3_estatal == 0){
            $porcentaje_cap3_estatal=0;
        }else{
            $porcentaje_cap3_estatal=round($capitulo3_estatal/$total_capitulo3_total,4);
            $total_pocentaje_cap3= round($total_pocentaje_cap3+$porcentaje_cap3_estatal,2);
        }
        if($capitulo3_federal == 0){
            $porcentaje_cap3_federal=0;
        }else{
            $porcentaje_cap3_federal=round($capitulo3_federal/$total_capitulo3_total,4);
            $total_pocentaje_cap3= round($total_pocentaje_cap3+$porcentaje_cap3_federal,2);
        }
        if($capitulo3_propios == 0){
            $porcentaje_cap3_propios=0;
        }else{
            $porcentaje_cap3_propios=round($capitulo3_propios/$total_capitulo3_total,4);
            $total_pocentaje_cap3= round($total_pocentaje_cap3+$porcentaje_cap3_propios,2);
        }
        ///4
        if($capitulo4_estatal == 0){
            $porcentaje_cap4_estatal=0;
        }else{
            $porcentaje_cap4_estatal=round($capitulo4_estatal/$total_capitulo4_total,4);
            $total_pocentaje_cap4= round($total_pocentaje_cap4+$porcentaje_cap4_estatal,2);
        }
        if($capitulo4_federal == 0){
            $porcentaje_cap4_federal=0;
        }else{
            $porcentaje_cap4_federal=round($capitulo4_federal/$total_capitulo4_total,4);
            $total_pocentaje_cap4= round($total_pocentaje_cap4+$porcentaje_cap4_federal,2);
        }
        if($capitulo4_propios == 0){
            $porcentaje_cap4_propios=0;
        }else{
            $porcentaje_cap4_propios=round($capitulo4_propios/$total_capitulo4_total,4);
            $total_pocentaje_cap4= round($total_pocentaje_cap4+$porcentaje_cap4_propios,2);
        }
        ///5
        if($capitulo5_estatal == 0){
            $porcentaje_cap5_estatal=0;
        }else{
            $porcentaje_cap5_estatal=round($capitulo5_estatal/$total_capitulo5_total,4);
            $total_pocentaje_cap5= round($total_pocentaje_cap5+$porcentaje_cap5_estatal,2);
        }
        if($capitulo5_federal == 0){
            $porcentaje_cap5_federal=0;
        }else{
            $porcentaje_cap5_federal=round($capitulo5_federal/$total_capitulo5_total,4);
            $total_pocentaje_cap5= round($total_pocentaje_cap5+$porcentaje_cap5_federal,2);
        }
        if($capitulo5_propios == 0){
            $porcentaje_cap5_propios=0;
        }else{
            $porcentaje_cap5_propios=round($capitulo5_propios/$total_capitulo5_total,4);
            $total_pocentaje_cap5= round($total_pocentaje_cap5+$porcentaje_cap5_propios,2);
        }
        ///6
        if($capitulo6_estatal == 0){
            $porcentaje_cap6_estatal=0;
        }else{
            $porcentaje_cap6_estatal=round($capitulo6_estatal/$total_capitulo6_total,4);
            $total_pocentaje_cap6= round($total_pocentaje_cap6+$porcentaje_cap6_estatal,2);
        }
        if($capitulo6_federal == 0){
            $porcentaje_cap6_federal=0;
        }else{
            $porcentaje_cap6_federal=round($capitulo6_federal/$total_capitulo6_total,4);
            $total_pocentaje_cap6= round($total_pocentaje_cap6+$porcentaje_cap6_federal,2);
        }
        if($capitulo6_propios == 0){
            $porcentaje_cap6_propios=0;
        }else{
            $porcentaje_cap6_propios=round($capitulo6_propios/$total_capitulo6_total,4);
            $total_pocentaje_cap6= round($total_pocentaje_cap6+$porcentaje_cap6_propios,2);
        }
        ?>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">

                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:p-5 tw:sm:p-6">
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <h2 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">TOTAL DE TECHO PRESUPUESTAL</h2>
                                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                                    <thead>
                                    <tr>

                                        <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90"></th>
                                        <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90" COLSPAN="4"> FUENTE DE FINANCIAMIENTO $</th>
                                        <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90" colspan="4">FUENTE DE FINANCIAMIENTO %</th>
                                    </tr>
                                    <tr>

                                        <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90">CAPITULO</th>
                                        <th class="tw:text-center">ESTATAL</th>
                                        <th class="tw:text-center">FEDERAL</th>
                                        <th class="tw:text-center">PROPIOS</th>
                                        <th class="tw:text-center">TOTAL</th>
                                        <th class="tw:text-center">ESTATAL</th>
                                        <th class="tw:text-center">FEDERAL</th>
                                        <th class="tw:text-center">PROPIOS</th>
                                        <th class="tw:text-center">TOTAL</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <?php

                                        $capitulo1_estatal= number_format($capitulo1_estatal, 2, '.', ',');
                                        $capitulo1_federal=number_format($capitulo1_federal, 2, '.', ',');
                                        $capitulo1_propios=number_format($capitulo1_propios, 2, '.', ',');
                                        $total_capitulo1_total=number_format($total_capitulo1_total, 2, '.', ',');

                                        ?>
                                        <td class="tw:text-gray-800 tw:dark:text-white/90">CAPITULO 1</td>
                                        <td class="tw:text-right">{{ $capitulo1_estatal }}</td>
                                        <td class="tw:text-right">{{ $capitulo1_federal }}</td>
                                        <td class="tw:text-right">{{ $capitulo1_propios }}</td>
                                        <td class="tw:text-right">{{ $total_capitulo1_total }}</td>
                                        <td class="tw:text-right">{{ $porcentaje_cap1_estatal }}</td>
                                        <td class="tw:text-right">{{ $porcentaje_cap1_federal }}</td>
                                        <td class="tw:text-right">{{ $porcentaje_cap1_propios }}</td>
                                        <td class="tw:text-right">{{ $total_pocentaje_cap1 }}</td>

                                    </tr>
                                    <tr>
                                        <?php

                                        $capitulo2_estatal= number_format($capitulo2_estatal, 2, '.', ',');
                                        $capitulo2_federal=number_format($capitulo2_federal, 2, '.', ',');
                                        $capitulo2_propios=number_format($capitulo2_propios, 2, '.', ',');
                                        $total_capitulo2_total=number_format($total_capitulo2_total, 2, '.', ',');

                                        ?>
                                        <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90">CAPITULO 2</td>
                                        <td class="tw:text-right">{{ $capitulo2_estatal }}</td>
                                        <td class="tw:text-right">{{ $capitulo2_federal }}</td>
                                        <td class="tw:text-right">{{ $capitulo2_propios }}</td>
                                        <td class="tw:text-right">{{ $total_capitulo2_total }}</td>
                                        <td class="tw:text-right">{{ $porcentaje_cap2_estatal }}</td>
                                        <td class="tw:text-right">{{ $porcentaje_cap2_federal }}</td>
                                        <td class="tw:text-right">{{ $porcentaje_cap2_propios }}</td>
                                        <td class="tw:text-right">{{ $total_pocentaje_cap2 }}</td>

                                    </tr>
                                    <tr>
                                        <?php

                                        $capitulo3_estatal= number_format($capitulo3_estatal, 2, '.', ',');
                                        $capitulo3_federal=number_format($capitulo3_federal, 2, '.', ',');
                                        $capitulo3_propios=number_format($capitulo3_propios, 2, '.', ',');
                                        $total_capitulo3_total=number_format($total_capitulo3_total, 2, '.', ',');

                                        ?>
                                        <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90">CAPITULO 3</td>
                                        <td class="tw:text-right">{{ $capitulo3_estatal }}</td>
                                        <td class="tw:text-right">{{ $capitulo3_federal }}</td>
                                        <td class="tw:text-right">{{ $capitulo3_propios }}</td>
                                        <td class="tw:text-right">{{ $total_capitulo3_total }}</td>
                                        <td class="tw:text-right">{{ $porcentaje_cap3_estatal }}</td>
                                        <td class="tw:text-right">{{ $porcentaje_cap3_federal }}</td>
                                        <td class="tw:text-right">{{ $porcentaje_cap3_propios }}</td>
                                        <td class="tw:text-right">{{ $total_pocentaje_cap3 }}</td>

                                    </tr>
                                    <tr>
                                        <?php

                                        $capitulo4_estatal= number_format($capitulo4_estatal, 2, '.', ',');
                                        $capitulo4_federal=number_format($capitulo4_federal, 2, '.', ',');
                                        $capitulo4_propios=number_format($capitulo4_propios, 2, '.', ',');
                                        $total_capitulo4_total=number_format($total_capitulo4_total, 2, '.', ',');

                                        ?>
                                        <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90">CAPITULO 4</td>
                                        <td class="tw:text-right">{{ $capitulo4_estatal }}</td>
                                        <td class="tw:text-right">{{ $capitulo4_federal }}</td>
                                        <td class="tw:text-right">{{ $capitulo4_propios }}</td>
                                        <td class="tw:text-right">{{ $total_capitulo4_total }}</td>
                                        <td class="tw:text-right">{{ $porcentaje_cap4_estatal }}</td>
                                        <td class="tw:text-right">{{ $porcentaje_cap4_federal }}</td>
                                        <td class="tw:text-right">{{ $porcentaje_cap4_propios }}</td>
                                        <td class="tw:text-right">{{ $total_pocentaje_cap4 }}</td>

                                    </tr>
                                    <tr>
                                        <?php

                                        $capitulo5_estatal= number_format($capitulo5_estatal, 2, '.', ',');
                                        $capitulo5_federal=number_format($capitulo5_federal, 2, '.', ',');
                                        $capitulo5_propios=number_format($capitulo5_propios, 2, '.', ',');
                                        $total_capitulo5_total=number_format($total_capitulo5_total, 2, '.', ',');

                                        ?>
                                        <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90">CAPITULO 5</td>
                                        <td class="tw:text-right">{{ $capitulo5_estatal }}</td>
                                        <td class="tw:text-right">{{ $capitulo5_federal }}</td>
                                        <td class="tw:text-right">{{ $capitulo5_propios }}</td>
                                        <td class="tw:text-right">{{ $total_capitulo5_total }}</td>
                                        <td class="tw:text-right">{{ $porcentaje_cap5_estatal }}</td>
                                        <td class="tw:text-right">{{ $porcentaje_cap5_federal }}</td>
                                        <td class="tw:text-right">{{ $porcentaje_cap5_propios }}</td>
                                        <td class="tw:text-right">{{ $total_pocentaje_cap5 }}</td>

                                    </tr>
                                    <tr>
                                        <?php
                                        $capitulo6_estatal= number_format($capitulo6_estatal, 2, '.', ',');
                                        $capitulo6_federal=number_format($capitulo6_federal, 2, '.', ',');
                                        $capitulo6_propios=number_format($capitulo6_propios, 2, '.', ',');
                                        $total_capitulo6_total=number_format($total_capitulo6_total, 2, '.', ',');

                                        ?>
                                        <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90">CAPITULO 6</td>
                                        <td class="tw:text-right">{{ $capitulo6_estatal }}</td>
                                        <td class="tw:text-right">{{ $capitulo6_federal }}</td>
                                        <td class="tw:text-right">{{ $capitulo6_propios }}</td>
                                        <td class="tw:text-right">{{ $total_capitulo6_total }}</td>
                                        <td class="tw:text-right">{{ $porcentaje_cap6_estatal }}</td>
                                        <td class="tw:text-right">{{ $porcentaje_cap6_federal }}</td>
                                        <td class="tw:text-right">{{ $porcentaje_cap6_propios }}</td>
                                        <td class="tw:text-right">{{ $total_pocentaje_cap6 }}</td>
                                    </tr>
                                    <tr>
                                        <?php
                                        $total_techo_estatal= number_format($total_techo_estatal, 2, '.', ',');
                                        $total_techo_federal=number_format($total_techo_federal, 2, '.', ',');
                                        $total_techo_propios=number_format($total_techo_propios, 2, '.', ',');
                                        $total_presupuesto_total=number_format($total_presupuesto_total, 2, '.', ',');
                                        ?>
                                        <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90"></td>
                                        <td class="tw:text-right">{{ $total_techo_estatal }}</td>
                                        <td class="tw:text-right">{{ $total_techo_federal }}</td>
                                        <td class="tw:text-right">{{ $total_techo_propios }}</td>
                                        <td class="tw:text-right">{{ $total_presupuesto_total }}</td>
                                        @if($total_porcentaje_total_estatal == 0)
                                            <td class="tw:text-right">-</td>
                                        @else
                                        <td class="tw:text-right">{{ $total_porcentaje_total_estatal }}</td>
                                        @endif
                                        @if($total_porcentaje_total_federal == 0)
                                            <td class="tw:text-right">-</td>
                                        @else
                                        <td class="tw:text-right">{{ $total_porcentaje_total_federal }}</td>
                                        @endif
                                        @if($total_porcentaje_total_propios == 0)
                                            <td class="tw:text-right">-</td>
                                        @else
                                        <td class="tw:text-right">{{ $total_porcentaje_total_propios }}</td>
                                        @endif
                                        @if($total_porcentaje_total == 0)
                                            <td class="tw:text-right">-</td>
                                        @else
                                        <td class="tw:text-right">{{ $total_porcentaje_total }}</td>
                                        @endif

                                    </tr>
                                    </tbody>
                                </table>
</div>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <?php

                                $total_gasto_operativo= number_format($total_gasto_operativo, 2, '.', ',');
                                ?>
                                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:bg-yellow-200 tw:dark:bg-yellow-500/20 tw:text-gray-800 tw:dark:text-white/90">GASTO OPERATIVO (2000, 3000, 4000, 5000 Y 6000)     <b>{{$total_gasto_operativo }}</b> </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <!-- Modal de agregar proyecto -->
    <x-panel.modal id="modal_agregar_proyecto" tamano="md" sin-relleno clase-cerrar="close">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Agregar proyecto</h4>
                </div>
                <div class="tw-modal-cuerpo">
                 <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                     <div class="tw:w-full tw:px-2">
                         <form id="form_agregar_proyecto" class="" action="{{url("/presupuesto_anteproyecto/techo_presupuestal/agregar_proyecto/")}}" role="form" method="POST" >
                             {{ csrf_field() }}
                             <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                 <div class="tw:w-full tw:px-2">
                                     <div class="tw:mb-4">
                                         <label for="exampleInputEmail1">Selecciona proyecto</label>
                                         <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="id_proyecto" name="id_proyecto" required>
                                             <option disabled selected hidden>Selecciona una opción</option>
                                             @foreach($proyectos as $proyecto)
                                                 <option value="{{$proyecto->id_proyecto}}" data-esta="{{$proyecto->nombre_proyecto }}">{{ $proyecto->nombre_proyecto }} </option>
                                             @endforeach
                                         </select>
                                     </div>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
                </div>
                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                    <button id="guardar_anteproyecto"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                </div>
            </x-panel.modal>
    {{-- modal agregar capitulo--}}

    <x-panel.modal id="modal_agregar_capitulo" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar capitulo </h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_agregar_capitulo">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_activacion_periodo"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal modificar capitulo--}}

    <x-panel.modal id="modal_mod_capitulo" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Modificar capitulo </h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_mod_capitulo">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_mod_capitulo"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </div>
            </x-panel.modal>
    <script>
    $(document).ready( function() {


    $("#guardar_anteproyecto").click(function (){
    var id_proyecto = $('#id_proyecto').val();
            if(id_proyecto != null){

                $("#form_agregar_proyecto").submit();
                $("#guardar_anteproyecto").attr("disabled", true);

            }
            else{
                swal({
                position: "top",
                type: "error",
                title: "Seleccionar proyecto",
                showConfirmButton: false,
                timer: 3500
                });
            }
    });

    $(".agregar_capitulos").click(function (){
        var id_presupuesto =$(this).attr('id');
        $.get("/presupuesto_anteproyecto/techo_presupuestal/agregar_fuentes_financiamiento/"+id_presupuesto,function (request) {
            $("#contenedor_agregar_capitulo").html(request);
            $("#modal_agregar_capitulo").modal('show');
        });

    });
    $(".modificar_capitulo").click(function (){
        var id_fuente_financiamiento =$(this).attr('id');
        $.get("/presupuesto_anteproyecto/techo_presupuestal/mod_fuentes_financiamiento/"+id_fuente_financiamiento,function (request) {
            $("#contenedor_mod_capitulo").html(request);
            $("#modal_mod_capitulo").modal('show');
        });
    });
    $("#guardar_activacion_periodo").click(function (){
        var id_capitulo = $('#id_capitulo').val();
        if(id_capitulo != null)
        {
            var presupuesto_estatal = $('#presupuesto_estatal').val();
            if( isNaN(presupuesto_estatal ) == false){
                var presupuesto_federal = $('#presupuesto_federal').val();
                if(isNaN(presupuesto_federal) == false){
                    var presupuesto_propios = $('#presupuesto_propios').val();
                    if(isNaN(presupuesto_propios) == false){
                        $("#form_agregar_capitulo").submit();
                        $("#guardar_activacion_periodo").attr("disabled", true);
                    }else{
                        swal({
                            position: "top",
                            type: "error",
                            title: "Ingresa cantidad de fuente de financiamiento propios en número",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }

                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Ingresa cantidad de fuente de financiamiento federal en número",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            }else{
                swal({
                    position: "top",
                    type: "error",
                    title: "Ingresa cantidad de fuente de financiamiento estatal en número",
                    showConfirmButton: false,
                    timer: 3500
                });
            }

        }else{
            swal({
                position: "top",
                type: "error",
                title: "Selecciona capitulo",
                showConfirmButton: false,
                timer: 3500
            });
        }
    });
    $("#guardar_mod_capitulo").click(function (){

            var presupuesto_estatal = $('#presupuesto_estatal_mod').val();
            if( isNaN(presupuesto_estatal ) == false){
                var presupuesto_federal = $('#presupuesto_federal_mod').val();
                if(isNaN(presupuesto_federal) == false){
                    var presupuesto_propios = $('#presupuesto_propios_mod').val();
                    if(isNaN(presupuesto_propios) == false){
                        $("#form_modificar_capitulo").submit();
                        $("#guardar_mod_capitulo").attr("disabled", true);
                    }else{
                        swal({
                            position: "top",
                            type: "error",
                            title: "Ingresa cantidad de fuente de financiamiento propios en número",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }

                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Ingresa cantidad de fuente de financiamiento federal en número",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            }else{
                swal({
                    position: "top",
                    type: "error",
                    title: "Ingresa cantidad de fuente de financiamiento estatal en número",
                    showConfirmButton: false,
                    timer: 3500
                });
            }


    });

    });
    </script>
</div>
@endsection