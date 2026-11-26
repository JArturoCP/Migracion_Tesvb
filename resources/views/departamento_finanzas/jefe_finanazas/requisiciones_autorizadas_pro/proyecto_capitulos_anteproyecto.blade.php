@extends('layouts.panel')
@section('title', 'Requisiciones del proyecto')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <p>
                <span class="fa fa-arrow-right"></span>
                <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/presupuesto_anteproyecto/requisiciones_autorizadas_proyecto")}}">proyectos del anteproyecto de presupuesto {{ $proyecto->year  }} </a>
                <span class="fa fa-chevron-right"></span>

                <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/presupuesto_anteproyecto/proyecto_inicio_anteproyecto/".$id_presupuesto)}}">Menu del proyecto seleccionado</a>
                <span class="fa fa-chevron-right"></span>
                <span>Requisiciones autorizadas por capitulo</span>
            </p>
        </div>
    </div>
    <x-panel.encabezado :titulo="'Requisiciones autorizadas por capitulo del presupuesto del anteproyecto '.$proyecto->year.' (Nombre del proyecto: '.$proyecto->nombre_proyecto.')'" :migas="['Finanzas' => null]" />

    <?php setlocale(LC_MONETARY, 'es_MX');

    ?>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                <thead>
                <tr>
                    <th class="tw:bg-gray-500 tw:text-white" colspan="5">FUENTE DE FINANCIAMIENTO</th>
                    <th class="tw:bg-gray-500 tw:text-white" colspan="4">FUENTE DE FINANCIAMIENTO %</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><b>ESTATAL</b></td>
                    <td><b>FEDERAL</b></td>
                    <td><b>PROPIOS</b></td>
                    <td><b>TOTAL</b></td>
                    <td class="tw:bg-gray-500 tw:text-white"><b>CAPITULO</b></td>
                    <td><b>ESTATAL</b></td>
                    <td><b>FEDERAL</b></td>
                    <td><b>PROPIOS</b></td>
                    <td><b>TOTAL</b></td>
                </tr>
                <?php
                $total_presupuesto_estatal=0;
                $total_presupuesto_federal=0;
                $total_presupuesto_propios=0;
                $total_total_presupuesto=0;
                ?>
                @foreach($presupuesto_ante_proy as $presupuesto)
                    <tr>
                        <?php
                        $total_presupuesto_estatal=$total_presupuesto_estatal+$presupuesto->presupuesto_estatal;
                        $total_presupuesto_federal=$total_presupuesto_federal+$presupuesto->presupuesto_federal;
                        $total_presupuesto_propios=$total_presupuesto_propios+$presupuesto->presupuesto_propios;

                        ?>

                        @if($presupuesto->presupuesto_estatal == 0)
                            <td class="tw:text-right">-</td>
                        @else
                            <td class="tw:text-right">{{  number_format($presupuesto->presupuesto_estatal, 2, '.', ',') }}</td>
                        @endif
                        @if($presupuesto->presupuesto_federal == 0)
                            <td class="tw:text-right">-</td>
                        @else
                            <td class="tw:text-right">{{  number_format($presupuesto->presupuesto_federal, 2, '.', ',') }}</td>
                        @endif
                        @if($presupuesto->presupuesto_propios == 0)
                            <td class="tw:text-right">-</td>
                        @else
                            <td class="tw:text-right">{{ number_format($presupuesto->presupuesto_propios, 2, '.', ',') }}</td>
                        @endif
                        @if($presupuesto->total_presupuesto == 0)
                            <td class="tw:text-right"><b>-</b></td>
                        @else
                            <td class="tw:text-right"><b>{{ number_format($presupuesto->total_presupuesto, 2, '.', ',') }}</b></td>
                        @endif
                        <td class="tw:bg-gray-500 tw:text-white tw:text-right"><b>{{ $presupuesto->capitulo }}</b></td>
                        @if($presupuesto->financiamiento_estatal == 0)
                            <td class="tw:text-right"><b>-</b></td>
                        @else
                            <td class="tw:text-right"><b>{{ round($presupuesto->financiamiento_estatal,4) }}</b></td>
                        @endif
                        @if($presupuesto->financiamiento_federal == 0)
                            <td class="tw:text-right"><b>-</b></td>
                        @else
                            <td class="tw:text-right"><b>{{ round($presupuesto->financiamiento_federal,4) }}</b></td>
                        @endif
                        @if($presupuesto->financiamiento_propios == 0)
                            <td class="tw:text-right"><b>-</b></td>
                        @else
                            <td class="tw:text-right"><b>{{ round($presupuesto->financiamiento_propios,4) }}</b></td>
                        @endif
                        @if($presupuesto->total_financiamiento == 0)
                            <td class="tw:text-right"><b>-</b></td>
                        @else
                            <td class="tw:text-right"><b>{{ round($presupuesto->total_financiamiento,4) }}</b></td>
                        @endif

                    </tr>

                @endforeach
                <?php
                $total_total_presupuesto=$total_presupuesto_estatal+$total_presupuesto_federal+$total_presupuesto_propios
                ?>
                <tr>
                    @if($total_presupuesto_estatal == 0)
                        <td class="tw:text-right">-</td>
                    @else
                        <td class="tw:text-right"><b>{{  number_format($total_presupuesto_estatal, 2, '.', ',') }}</b></td>
                    @endif
                    @if($total_presupuesto_federal == 0)
                        <td class="tw:text-right">-</td>
                    @else
                        <td class="tw:text-right"><b>{{  number_format($total_presupuesto_federal, 2, '.', ',') }}</b></td>
                    @endif
                    @if($total_presupuesto_propios == 0)
                        <td class="tw:text-right">-</td>
                    @else
                        <td class="tw:text-right"><b>{{  number_format($total_presupuesto_propios, 2, '.', ',') }}</b></td>
                    @endif
                    @if($total_total_presupuesto == 0)
                        <td class="tw:text-right">-</td>
                    @else
                        <td class="tw:text-right"><b>{{  number_format($total_total_presupuesto, 2, '.', ',') }}</b></td>
                    @endif
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>


                </tr>
                </tbody>
            </table>
</div>

        </div>
    </div>
    @if($mostrar == 0)
        <x-panel.alerta tipo="exito" class="tw:mb-4"><label for="id_capitulo">Seleccionar capitulo del proyecto</label>
                        <select name="id_fuente_financiamiento" id="id_fuente_financiamiento" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                            @foreach($presupuesto_proyecto as $capitulo)
                                <option disabled selected hidden>Selecciona una opción</option>
                                <option value="{{$capitulo->id_fuente_financiamiento}}" >{{$capitulo->capitulo}} </option>
                            @endforeach

                        </select></x-panel.alerta>
    @endif
       @if($mostrar == 1)
           <x-panel.alerta tipo="exito" class="tw:mb-4"><label for="id_capitulo">Seleccionar capitulo del proyecto</label>
                           <select name="id_fuente_financiamiento" id="id_fuente_financiamiento" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                               @foreach($presupuesto_proyecto as $capitulo)
                                   @if($capitulo->id_fuente_financiamiento==$id_fuente_financiamiento)
                                       <option value="{{$capitulo->id_fuente_financiamiento}}" selected="selected">{{$capitulo->capitulo}}</option>
                                   @else
                                       <option value="{{$capitulo->id_fuente_financiamiento}}" >{{$capitulo->capitulo}} </option>
                                   @endif
                               @endforeach

                           </select></x-panel.alerta>
           <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
               <div class="tw:w-full tw:px-2">
                   <a href="/presupuesto_anteproyecto/presupuesto_capitulo_ant_excel/{{ $id_fuente_financiamiento }}/" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" target="_blank"><span class="fa fa-external-link"  aria-hidden="true"></span>Exportar Excel</a>
               </div>
           </div>
           <style type="text/css">
               #tablita thead tr th {
                   position: sticky;
                   top: 0;
                   z-index: 10;



               }


           </style>

           <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" id="tablita">

               <thead>
               <tr>
                   <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90">CLAVE PRESUPUESTAL</th>
                   <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90">DENOMINACIÓN</th>
                   <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90" ><b>ENERO</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>ESTATAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>FEDERAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>PROPIOS</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>TOTAL</b></th>
                   <th ><b></b></th>
                   <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90" ><b>FEBRERO</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>ESTATAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>FEDERAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>PROPIOS</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>TOTAL</b></th>
                   <th ><b></b></th>
                   <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90" ><b>MARZO</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>ESTATAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>FEDERAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>PROPIOS</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>TOTAL</b></th>
                   <th ><b></b></th>
                   <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90" ><b>ABRIL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>ESTATAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>FEDERAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>PROPIOS</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>TOTAL</b></th>
                   <th ><b></b></th>
                   <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90" ><b>MAYO</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>ESTATAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>FEDERAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>PROPIOS</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>TOTAL</b></th>
                   <th ><b></b></th>
                   <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90" ><b>JUNIO</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>ESTATAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>FEDERAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>PROPIOS</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>TOTAL</b></th>
                   <th ><b></b></th>
                   <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90" ><b>JULIO</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>ESTATAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>FEDERAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>PROPIOS</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>TOTAL</b></th>
                   <th ><b></b></th>
                   <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90" ><b>AGOSTO</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>ESTATAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>FEDERAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>PROPIOS</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>TOTAL</b></th>
                   <th ><b></b></th>
                   <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90" ><b>SEPTIEMBRE</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>ESTATAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>FEDERAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>PROPIOS</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>TOTAL</b></th>
                   <th ><b></b></th>
                   <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90" ><b>OCTUBRE</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>ESTATAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>FEDERAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>PROPIOS</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>TOTAL</b></th>
                   <th ><b></b></th>
                   <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90" ><b>NOVIEMBRE</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>ESTATAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>FEDERAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>PROPIOS</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>TOTAL</b></th>
                   <th ><b></b></th>
                   <th class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90" ><b>DICIEMBRE</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>ESTATAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>FEDERAL</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>PROPIOS</b></th>
                   <th class="tw:bg-green-100 tw:dark:bg-green-500/15 tw:text-green-800 tw:dark:text-green-300"><b>TOTAL</b></th>
                   <th ><b></b></th>
                   <th class="tw:bg-gray-200 tw:dark:bg-gray-700 tw:text-gray-800 tw:dark:text-white/90"><b>TOTAL</b></th>
                   <th class="tw:bg-gray-200 tw:dark:bg-gray-700 tw:text-gray-800 tw:dark:text-white/90"><b>ESTATAL</b></th>
                   <th class="tw:bg-gray-200 tw:dark:bg-gray-700 tw:text-gray-800 tw:dark:text-white/90"><b>FEDERAL</b></th>
                   <th class="tw:bg-gray-200 tw:dark:bg-gray-700 tw:text-gray-800 tw:dark:text-white/90"><b>PROPIOS</b></th>
                   <th class="tw:bg-gray-200 tw:dark:bg-gray-700 tw:text-gray-800 tw:dark:text-white/90"><b>TOTAL</b></th>
               </tr>
               </thead>
               <tbody>
               <?php
               $suma_total_enero1=0;
               $suma_estatal_enero1=0;
               $suma_federal_enero1=0;
               $suma_propios_enero1=0;
               $total_suma_total_enero1=0;

               $suma_total_febrero1=0;
               $suma_estatal_febrero1=0;
               $suma_federal_febrero1=0;
               $suma_propios_febrero1=0;
               $total_suma_total_febrero1=0;

               $suma_total_marzo1=0;
               $suma_estatal_marzo1=0;
               $suma_federal_marzo1=0;
               $suma_propios_marzo1=0;
               $total_suma_total_marzo1=0;

               $suma_total_abril1=0;
               $suma_estatal_abril1=0;
               $suma_federal_abril1=0;
               $suma_propios_abril1=0;
               $total_suma_total_abril1=0;

               $suma_total_mayo1=0;
               $suma_estatal_mayo1=0;
               $suma_federal_mayo1=0;
               $suma_propios_mayo1=0;
               $total_suma_total_mayo1=0;

               $suma_total_junio1=0;
               $suma_estatal_junio1=0;
               $suma_federal_junio1=0;
               $suma_propios_junio1=0;
               $total_suma_total_junio1=0;

               $suma_total_julio1=0;
               $suma_estatal_julio1=0;
               $suma_federal_julio1=0;
               $suma_propios_julio1=0;
               $total_suma_total_julio1=0;

               $suma_total_agosto1=0;
               $suma_estatal_agosto1=0;
               $suma_federal_agosto1=0;
               $suma_propios_agosto1=0;
               $total_suma_total_agosto1=0;

               $suma_total_sep1=0;
               $suma_estatal_sep1=0;
               $suma_federal_sep1=0;
               $suma_propios_sep1=0;
               $total_suma_total_sep1=0;

               $suma_total_octubre1=0;
               $suma_estatal_octubre1=0;
               $suma_federal_octubre1=0;
               $suma_propios_octubre1=0;
               $total_suma_total_octubre1=0;

               $suma_total_nov1=0;
               $suma_estatal_nov1=0;
               $suma_federal_nov1=0;
               $suma_propios_nov1=0;
               $total_suma_total_nov1=0;

               $suma_total_dic1=0;
               $suma_estatal_dic1=0;
               $suma_federal_dic1=0;
               $suma_propios_dic1=0;
               $total_suma_total_dic1=0;
               $total_partida_total_porcentaje1=0;
               $total_estatal_total_porcentaje1=0;
               $total_federal_total_porcentaje1=0;
               $total_propios_total_porcentaje1=0;
               $total_porcentaje_total_partida1=0;
               ?>
               @foreach($array_capitulos as $capitu)
                   <?php
                   $suma_total_enero=0;
                   $suma_estatal_enero=0;
                   $suma_federal_enero=0;
                   $suma_propios_enero=0;
                   $total_suma_total_enero=0;

                   $suma_total_febrero=0;
                   $suma_estatal_febrero=0;
                   $suma_federal_febrero=0;
                   $suma_propios_febrero=0;
                   $total_suma_total_febrero=0;

                   $suma_total_marzo=0;
                   $suma_estatal_marzo=0;
                   $suma_federal_marzo=0;
                   $suma_propios_marzo=0;
                   $total_suma_total_marzo=0;

                   $suma_total_abril=0;
                   $suma_estatal_abril=0;
                   $suma_federal_abril=0;
                   $suma_propios_abril=0;
                   $total_suma_total_abril=0;

                   $suma_total_mayo=0;
                   $suma_estatal_mayo=0;
                   $suma_federal_mayo=0;
                   $suma_propios_mayo=0;
                   $total_suma_total_mayo=0;

                   $suma_total_junio=0;
                   $suma_estatal_junio=0;
                   $suma_federal_junio=0;
                   $suma_propios_junio=0;
                   $total_suma_total_junio=0;

                   $suma_total_julio=0;
                   $suma_estatal_julio=0;
                   $suma_federal_julio=0;
                   $suma_propios_julio=0;
                   $total_suma_total_julio=0;

                   $suma_total_agosto=0;
                   $suma_estatal_agosto=0;
                   $suma_federal_agosto=0;
                   $suma_propios_agosto=0;
                   $total_suma_total_agosto=0;

                   $suma_total_sep=0;
                   $suma_estatal_sep=0;
                   $suma_federal_sep=0;
                   $suma_propios_sep=0;
                   $total_suma_total_sep=0;

                   $suma_total_octubre=0;
                   $suma_estatal_octubre=0;
                   $suma_federal_octubre=0;
                   $suma_propios_octubre=0;
                   $total_suma_total_octubre=0;

                   $suma_total_nov=0;
                   $suma_estatal_nov=0;
                   $suma_federal_nov=0;
                   $suma_propios_nov=0;
                   $total_suma_total_nov=0;

                   $suma_total_dic=0;
                   $suma_estatal_dic=0;
                   $suma_federal_dic=0;
                   $suma_propios_dic=0;
                   $total_suma_total_dic=0;


                   $suma_total_partidas=0;
                   $total_partida_estatal=0;
                   $total_partida_federal=0;
                   $total_partida_propios=0;
                   $total_total_porcentaje=0;
                   $total_partida_total_porcentaje=0;
                   $total_estatal_total_porcentaje=0;
                   $total_federal_total_porcentaje=0;
                   $total_propios_total_porcentaje=0;
                   $total_porcentaje_total_partida=0;


                   ?>
                   @foreach($capitu['array_partidas'] as $partidas)
                       @if($partidas['suma_presupuestal_year'] == 0)
                           <tr>
                               <td>{{ $partidas['clave_presupuestal'] }}</td>
                               <td>{{ $partidas['nombre_partida'] }}</td>
                               @foreach($partidas['array_meses'] as $meses)
                                   <td class="tw:text-right">-</td>
                                   <td class="tw:text-right">-</td>
                                   <td class="tw:text-right">-</td>
                                   <td class="tw:text-right">-</td>
                                   <td class="tw:text-right">-</td>
                                   <td class="tw:text-right">-</td>
                               @endforeach
                               <td class="tw:text-right">-</td>
                               <td class="tw:text-right">-</td>
                               <td class="tw:text-right">-</td>
                               <td class="tw:text-right">-</td>
                               <td class="tw:text-right">-</td>
                           </tr>
                       @else
                           <tr class="tw:text-white tw:bg-blue-500 tw:text-right">
                               <td class="tw:text-justify">{{ $partidas['clave_presupuestal'] }}</td>
                               <td class="tw:text-justify">{{ $partidas['nombre_partida'] }}</td>

                               @foreach($partidas['array_meses'] as $meses)
                                   @if($meses['suma_req_mes'] == 0)
                                       <td >-</td>
                                       <td >-</td>
                                       <td >-</td>
                                       <td >-</td>
                                       <td >-</td>
                                       <td >-</td>
                                   @else

                                       <?php
                                       $suma_req_mes= $meses['suma_req_mes'];
                                       $suma_req_mes1=number_format($suma_req_mes, 2, '.', ',');
                                       $financiamiento_estatal= $capitu['financiamiento_estatal']*$meses['suma_req_mes'];
                                       $financiamiento_estatal=$financiamiento_estatal;
                                       $financiamiento_estatal1= number_format($financiamiento_estatal, 2, '.', ',');
                                       $financiamiento_federal= $capitu['financiamiento_federal']*$meses['suma_req_mes'];
                                       $financiamiento_federal=$financiamiento_federal;
                                       $financiamiento_federal1= number_format($financiamiento_federal, 2, '.', ',');
                                       $financiamiento_propios= $capitu['financiamiento_propios']*$meses['suma_req_mes'];
                                       $financiamiento_propios=$financiamiento_propios;
                                       $financiamiento_propios1= number_format($financiamiento_propios, 2, '.', ',');
                                       $suma_financiamiento= $financiamiento_estatal+$financiamiento_federal+$financiamiento_propios;
                                       $suma_financiamiento=$suma_financiamiento;
                                       $suma_financiamiento1= number_format($suma_financiamiento, 2, '.', ',');

                                       /*suma  */
                                       if($meses['id_mes'] == 1){
                                           $suma_total_enero=$suma_total_enero+$suma_req_mes;
                                           $suma_estatal_enero=$suma_estatal_enero+$financiamiento_estatal;
                                           $suma_federal_enero=$suma_federal_enero+$financiamiento_federal;
                                           $suma_propios_enero=$suma_propios_enero+$financiamiento_propios;
                                           $total_suma_total_enero=$total_suma_total_enero+$suma_financiamiento;
                                       }

                                       if($meses['id_mes'] == 2){

                                           $suma_total_febrero=$suma_total_febrero+$suma_req_mes;
                                           $suma_estatal_febrero= $suma_estatal_febrero+$financiamiento_estatal;
                                           $suma_federal_febrero= $suma_federal_febrero+$financiamiento_federal;
                                           $suma_propios_febrero= $suma_propios_febrero+$financiamiento_propios;
                                           $total_suma_total_febrero= $total_suma_total_febrero+$suma_financiamiento;
                                       }
                                       if($meses['id_mes'] == 3){
                                           $suma_total_marzo=$suma_total_marzo+$suma_req_mes;
                                           $suma_estatal_marzo=$suma_estatal_marzo+$financiamiento_estatal;
                                           $suma_federal_marzo=$suma_federal_marzo+$financiamiento_federal;
                                           $suma_propios_marzo=$suma_propios_marzo+$financiamiento_propios;
                                           $total_suma_total_marzo=$total_suma_total_marzo+$suma_financiamiento;
                                       }
                                       if($meses['id_mes'] == 4){
                                           $suma_total_abril=$suma_total_abril+$suma_req_mes;
                                           $suma_estatal_abril=$suma_estatal_abril+$financiamiento_estatal;
                                           $suma_federal_abril=$suma_federal_abril+$financiamiento_federal;
                                           $suma_propios_abril=$suma_propios_abril+$financiamiento_propios;
                                           $total_suma_total_abril=$total_suma_total_abril+$suma_financiamiento;
                                       }
                                       if($meses['id_mes'] == 5){
                                           $suma_total_mayo=$suma_total_mayo+$suma_req_mes;
                                           $suma_estatal_mayo=$suma_estatal_mayo+$financiamiento_estatal;
                                           $suma_federal_mayo=$suma_federal_mayo+$financiamiento_federal;
                                           $suma_propios_mayo=$suma_propios_mayo+$financiamiento_propios;
                                           $total_suma_total_mayo=$total_suma_total_mayo+$suma_financiamiento;
                                       }
                                       if($meses['id_mes'] == 6){
                                           $suma_total_junio=$suma_total_junio+$suma_req_mes;
                                           $suma_estatal_junio=$suma_estatal_junio+$financiamiento_estatal;
                                           $suma_federal_junio=$suma_federal_junio+$financiamiento_federal;
                                           $suma_propios_junio=$suma_propios_junio+$financiamiento_propios;
                                           $total_suma_total_junio=$total_suma_total_junio+$suma_financiamiento;
                                       }
                                       if($meses['id_mes'] == 7){
                                           $suma_total_julio=$suma_total_julio+$suma_req_mes;
                                           $suma_estatal_julio=$suma_estatal_julio+$financiamiento_estatal;
                                           $suma_federal_julio=$suma_federal_julio+$financiamiento_federal;
                                           $suma_propios_julio=$suma_propios_julio+$financiamiento_propios;
                                           $total_suma_total_julio=$total_suma_total_julio+$suma_financiamiento;
                                       }
                                       if($meses['id_mes'] == 8){
                                           $suma_total_agosto=$suma_total_agosto+$suma_req_mes;
                                           $suma_estatal_agosto=$suma_estatal_agosto+$financiamiento_estatal;
                                           $suma_federal_agosto=$suma_federal_agosto+$financiamiento_federal;
                                           $suma_propios_agosto=$suma_propios_agosto+$financiamiento_propios;
                                           $total_suma_total_agosto=$total_suma_total_agosto+$suma_financiamiento;
                                       }
                                       if($meses['id_mes'] == 9){
                                           $suma_total_sep=$suma_total_sep+$suma_req_mes;
                                           $suma_estatal_sep=$suma_estatal_sep+$financiamiento_estatal;
                                           $suma_federal_sep=$suma_federal_sep+$financiamiento_federal;
                                           $suma_propios_sep=$suma_propios_sep+$financiamiento_propios;
                                           $total_suma_total_sep=$total_suma_total_sep+$suma_financiamiento;
                                       }
                                       if($meses['id_mes'] == 10){
                                           $suma_total_octubre=$suma_total_octubre+$suma_req_mes;
                                           $suma_estatal_octubre=$suma_estatal_octubre+$financiamiento_estatal;
                                           $suma_federal_octubre=$suma_federal_octubre+$financiamiento_federal;
                                           $suma_propios_octubre=$suma_propios_octubre+$financiamiento_propios;
                                           $total_suma_total_octubre=$total_suma_total_octubre+$suma_financiamiento;
                                       }
                                       if($meses['id_mes'] == 11){
                                           $suma_total_nov=$suma_total_nov+$suma_req_mes;
                                           $suma_estatal_nov=$suma_estatal_nov+$financiamiento_estatal;
                                           $suma_federal_nov=$suma_federal_nov+$financiamiento_federal;
                                           $suma_propios_nov=$suma_propios_nov+$financiamiento_propios;
                                           $total_suma_total_nov=$total_suma_total_nov+$suma_financiamiento;
                                       }
                                       if($meses['id_mes'] == 12){

                                           $suma_total_dic=$suma_total_dic+$suma_req_mes;
                                           $suma_estatal_dic=$suma_estatal_dic+$financiamiento_estatal;
                                           $suma_federal_dic=$suma_federal_dic+$financiamiento_federal;
                                           $suma_propios_dic=$suma_propios_dic+$financiamiento_propios;
                                           $total_suma_total_dic=$total_suma_total_dic+$suma_financiamiento;
                                       }
                                       $total_partida_total_porcentaje=$total_suma_total_enero+$total_suma_total_febrero+$total_suma_total_marzo+$total_suma_total_abril+$total_suma_total_mayo+$total_suma_total_junio+$total_suma_total_julio+$total_suma_total_agosto+$total_suma_total_sep+$total_suma_total_octubre+$total_suma_total_nov+$total_suma_total_dic;
                                       $total_estatal_total_porcentaje=$total_partida_total_porcentaje*$capitu['financiamiento_estatal'];
                                       $total_federal_total_porcentaje=$total_partida_total_porcentaje*$capitu['financiamiento_federal'];
                                       $total_propios_total_porcentaje=$total_partida_total_porcentaje*$capitu['financiamiento_propios'];
                                       $total_porcentaje_total_partida=$total_estatal_total_porcentaje+$total_federal_total_porcentaje+$total_propios_total_porcentaje;

                                       $total_estatal_total_porcentaje1=$total_estatal_total_porcentaje1+$total_estatal_total_porcentaje;
                                       $total_federal_total_porcentaje1=$total_federal_total_porcentaje1+$total_federal_total_porcentaje;
                                       $total_propios_total_porcentaje1=$total_propios_total_porcentaje1+$total_propios_total_porcentaje;
                                       ?>
                                       @if($suma_req_mes == 0)
                                           <td>-</td>
                                       @else
                                           <td>{{ $suma_req_mes1}}</td>
                                       @endif
                                       @if($financiamiento_estatal == 0)
                                           <td>-</td>
                                       @else
                                           <td>{{ $financiamiento_estatal1 }}</td>
                                       @endif
                                       @if($financiamiento_federal == 0)
                                           <td>-</td>
                                       @else
                                           <td>{{ $financiamiento_federal1 }}</td>
                                       @endif
                                       @if($financiamiento_propios == 0)
                                           <td>-</td>
                                       @else
                                           <td>{{ $financiamiento_propios1 }}</td>
                                       @endif
                                       @if($suma_financiamiento == 0)
                                           <td>-</td>
                                       @else
                                           <td>{{ $suma_financiamiento1 }}</td>
                                       @endif
                                       <td></td>
                                   @endif

                               @endforeach
                               <?php
                               $suma_total_partidas=$suma_total_partidas+$partidas['suma_presupuestal_year'];
                               $total_partida_estatal=$partidas['suma_presupuestal_year']*$capitu['financiamiento_estatal'];
                               $total_partida_estatal=$total_partida_estatal;

                               $total_partida_federal=$partidas['suma_presupuestal_year']*$capitu['financiamiento_federal'];
                               $total_partida_federal=$total_partida_federal;

                               $total_partida_propios=$partidas['suma_presupuestal_year']*$capitu['financiamiento_propios'];
                               $total_partida_propios=$total_partida_propios;

                               $total_total_porcentaje=$total_partida_estatal+$total_partida_federal+$total_partida_propios;
                               ?>


                               <td >{{ number_format($partidas['suma_presupuestal_year'], 2, '.', ',') }}</td>
                               @if($total_partida_estatal== 0)
                                   <td class="tw:text-gray-800 tw:dark:text-white/90">-</td>
                               @else
                                   <td class="tw:text-gray-800 tw:dark:text-white/90">{{ number_format($total_partida_estatal, 2, '.', ',') }}</td>
                               @endif
                               @if($total_partida_federal== 0)
                                   <td class="tw:text-gray-800 tw:dark:text-white/90">-</td>
                               @else
                                   <td class="tw:text-gray-800 tw:dark:text-white/90">{{ number_format($total_partida_federal, 2, '.', ',') }}</td>
                               @endif
                               @if($total_partida_propios== 0)
                                   <td class="tw:text-gray-800 tw:dark:text-white/90">-</td>
                               @else
                                   <td class="tw:text-gray-800 tw:dark:text-white/90">{{ number_format($total_partida_propios, 2, '.', ',') }}</td>
                               @endif
                               <td class="tw:text-gray-800 tw:dark:text-white/90">{{ number_format($total_total_porcentaje, 2, '.', ',') }}</td>


                           </tr>

                       @endif

                   @endforeach
                   <?php
                   $suma_total_enero1=$suma_total_enero1+$suma_total_enero;
                   $suma_estatal_enero1=$suma_estatal_enero1+$suma_estatal_enero;
                   $suma_federal_enero1=$suma_federal_enero1+$suma_federal_enero;
                   $suma_propios_enero1=$suma_propios_enero1+$suma_propios_enero;
                   $total_suma_total_enero1=$total_suma_total_enero1+$total_suma_total_enero;

                   $suma_total_febrero1=$suma_total_febrero1+$suma_total_febrero;
                   $suma_estatal_febrero1=$suma_estatal_febrero1+$suma_estatal_febrero;
                   $suma_federal_febrero1=$suma_federal_febrero1+$suma_federal_febrero;
                   $suma_propios_febrero1=$suma_propios_febrero1+$suma_propios_febrero;
                   $total_suma_total_febrero1=$total_suma_total_febrero1+$total_suma_total_febrero;

                   $suma_total_marzo1=$suma_total_marzo1+$suma_total_marzo;
                   $suma_estatal_marzo1=$suma_estatal_marzo1+$suma_estatal_marzo;
                   $suma_federal_marzo1=$suma_federal_marzo1+$suma_federal_marzo;
                   $suma_propios_marzo1=$suma_propios_marzo1+$suma_propios_marzo;
                   $total_suma_total_marzo1=$total_suma_total_marzo1+$total_suma_total_marzo;

                   $suma_total_abril1=$suma_total_abril1+$suma_total_abril;
                   $suma_estatal_abril1=$suma_estatal_abril1+$suma_estatal_abril;
                   $suma_federal_abril1=$suma_federal_abril1+$suma_federal_abril;
                   $suma_propios_abril1=$suma_propios_abril1+$suma_propios_abril;
                   $total_suma_total_abril1=$total_suma_total_abril1+$total_suma_total_abril1;

                   $suma_total_mayo1=$suma_total_mayo1+$suma_total_mayo;
                   $suma_estatal_mayo1=$suma_estatal_mayo1+$suma_estatal_mayo;
                   $suma_federal_mayo1=$suma_federal_mayo1+$suma_federal_mayo;
                   $suma_propios_mayo1=$suma_propios_mayo1+$suma_propios_mayo;
                   $total_suma_total_mayo1=$total_suma_total_mayo1+$total_suma_total_mayo;

                   $suma_total_junio1=$suma_total_junio1+$suma_total_junio;
                   $suma_estatal_junio1=$suma_estatal_junio1+$suma_estatal_junio;
                   $suma_federal_junio1=$suma_federal_junio1+$suma_federal_junio;
                   $suma_propios_junio1=$suma_propios_junio1+$suma_propios_junio;
                   $total_suma_total_junio1=$total_suma_total_junio1+$total_suma_total_junio;

                   $suma_total_julio1=$suma_total_julio1+$suma_total_julio;
                   $suma_estatal_julio1=$suma_estatal_julio1+$suma_estatal_julio;
                   $suma_federal_julio1=$suma_federal_julio1+$suma_federal_julio;
                   $suma_propios_julio1=$suma_propios_julio1+$suma_propios_julio;
                   $total_suma_total_julio1=$total_suma_total_julio1+$total_suma_total_julio;

                   $suma_total_agosto1=$suma_total_agosto1+$suma_total_agosto;
                   $suma_estatal_agosto1=$suma_estatal_agosto1+$suma_estatal_agosto;
                   $suma_federal_agosto1=$suma_federal_agosto1+$suma_federal_agosto;
                   $suma_propios_agosto1=$suma_propios_agosto1+$suma_propios_agosto;
                   $total_suma_total_agosto1=$total_suma_total_agosto1+$total_suma_total_agosto;

                   $suma_total_sep1=$suma_total_sep1+$suma_total_sep;
                   $suma_estatal_sep1=$suma_estatal_sep1+$suma_estatal_sep;
                   $suma_federal_sep1=$suma_federal_sep1+$suma_federal_sep;
                   $suma_propios_sep1=$suma_propios_sep1+$suma_propios_sep;
                   $total_suma_total_sep1=$total_suma_total_sep1+$total_suma_total_sep;

                   $suma_total_octubre1=$suma_total_octubre1+$suma_total_octubre;
                   $suma_estatal_octubre1=$suma_estatal_octubre1+$suma_estatal_octubre;
                   $suma_federal_octubre1=$suma_federal_octubre1+$suma_federal_octubre;
                   $suma_propios_octubre1=$suma_propios_octubre1+$suma_propios_octubre;
                   $total_suma_total_octubre1=$total_suma_total_octubre1+$total_suma_total_octubre;

                   $suma_total_nov1=$suma_total_nov1+$suma_total_nov;
                   $suma_estatal_nov1=$suma_estatal_nov1+$suma_estatal_nov;
                   $suma_federal_nov1=$suma_federal_nov1+$suma_federal_nov;
                   $suma_propios_nov1=$suma_propios_nov1+$suma_propios_nov;
                   $total_suma_total_nov1=$total_suma_total_nov1+$total_suma_total_nov;

                   $suma_total_dic1=$suma_total_dic1+$suma_total_dic;
                   $suma_estatal_dic1=$suma_estatal_dic1+$suma_estatal_dic;
                   $suma_federal_dic1=$suma_federal_dic1+$suma_federal_dic;
                   $suma_propios_dic1=$suma_propios_dic1+$suma_propios_dic;
                   $total_suma_total_dic1=$total_suma_total_dic1+$total_suma_total_dic;


                   ?>
                   <tr>
                       <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right" ></td>
                       <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right" >TOTAL</td>
                       @if($suma_total_enero == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_total_enero, 2, '.', ',')}}</b></td>
                       @endif
                       @if($suma_estatal_enero == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_estatal_enero, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_federal_enero == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_federal_enero, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_propios_enero == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_propios_enero, 2, '.', ',') }}</b></td>
                       @endif
                       @if($total_suma_total_enero == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($total_suma_total_enero, 2, '.', ',') }}</b></td>
                       @endif
                       <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @if($suma_total_febrero == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_total_febrero, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_estatal_febrero == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_estatal_febrero, 2, '.', ',') }} </b></td>
                       @endif
                       @if($suma_federal_febrero == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_federal_febrero, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_propios_febrero == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_propios_febrero, 2, '.', ',') }}</b></td>
                       @endif
                       @if($total_suma_total_febrero == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($total_suma_total_febrero, 2, '.', ',') }}</b></td>
                       @endif
                       <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @if($suma_total_marzo == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_total_marzo, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_estatal_marzo == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_estatal_marzo, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_federal_marzo == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_federal_marzo, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_propios_marzo == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_propios_marzo, 2, '.', ',') }}</b></td>
                       @endif
                       @if($total_suma_total_marzo == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($total_suma_total_marzo, 2, '.', ',') }}</b></td>
                       @endif
                       <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>

                       @if($suma_total_abril == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_total_abril, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_estatal_abril == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_estatal_abril, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_federal_abril == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_federal_abril, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_propios_abril == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_propios_abril, 2, '.', ',') }}</b></td>
                       @endif
                       @if($total_suma_total_abril == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($total_suma_total_abril, 2, '.', ',') }}</b></td>
                       @endif
                       <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>

                       @if($suma_total_mayo == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_total_mayo, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_estatal_mayo == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_estatal_mayo, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_federal_mayo == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_federal_mayo, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_propios_mayo == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_propios_mayo, 2, '.', ',') }}</b></td>
                       @endif
                       @if($total_suma_total_mayo == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($total_suma_total_mayo, 2, '.', ',') }}</b></td>
                       @endif
                       <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>

                       @if($suma_total_junio == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_total_junio, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_estatal_junio == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_estatal_junio, 2, '.', ',') }}</b> </td>
                       @endif
                       @if($suma_federal_junio == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_federal_junio, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_propios_junio == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_propios_junio, 2, '.', ',') }}</b></td>
                       @endif
                       @if($total_suma_total_junio == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($total_suma_total_junio, 2, '.', ',') }}</b></td>
                       @endif
                       <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>

                       @if($suma_total_julio == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{number_format($suma_total_julio, 2, '.', ',')}}</b></td>
                       @endif
                       @if($suma_estatal_julio == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_estatal_julio, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_federal_julio == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_federal_julio, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_propios_julio == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_propios_julio, 2, '.', ',') }}</b></td>
                       @endif
                       @if($total_suma_total_julio == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($total_suma_total_julio, 2, '.', ',') }}</b></td>
                       @endif
                       <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>

                       @if($suma_total_agosto == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_total_agosto, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_estatal_agosto == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_estatal_agosto, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_federal_agosto == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_federal_agosto, 2, '.', ',') }}</b> </td>
                       @endif
                       @if($suma_propios_agosto == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_propios_agosto, 2, '.', ',') }}</b></td>
                       @endif
                       @if($total_suma_total_agosto == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($total_suma_total_agosto, 2, '.', ',') }}</b></td>
                       @endif
                       <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>

                       @if($suma_total_sep == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_total_sep, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_estatal_sep == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_estatal_sep, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_federal_sep == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_federal_sep, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_propios_sep == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_propios_sep, 2, '.', ',') }}</b></td>
                       @endif
                       @if($total_suma_total_sep == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($total_suma_total_sep, 2, '.', ',') }}</b></td>
                       @endif
                       <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>

                       @if($suma_total_octubre == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_total_octubre, 2, '.', ',') }} </b></td>
                       @endif
                       @if($suma_estatal_octubre == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_estatal_octubre, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_federal_octubre == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_federal_octubre, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_propios_octubre == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{number_format($suma_propios_octubre, 2, '.', ',') }}</b></td>
                       @endif
                       @if($total_suma_total_octubre == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($total_suma_total_octubre, 2, '.', ',') }}</b></td>
                       @endif
                       <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>

                       @if($suma_total_nov == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_total_nov, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_estatal_nov == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_estatal_nov, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_federal_nov == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_federal_nov, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_propios_nov == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_propios_nov, 2, '.', ',') }}</b></td>
                       @endif
                       @if($total_suma_total_nov == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($total_suma_total_nov, 2, '.', ',') }}</b></td>
                       @endif
                       <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>

                       @if($suma_total_dic == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_total_dic, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_estatal_dic == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_estatal_dic, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_federal_dic == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_federal_dic, 2, '.', ',') }}</b></td>
                       @endif
                       @if($suma_propios_dic == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($suma_propios_dic, 2, '.', ',') }}</b></td>
                       @endif
                       @if($total_suma_total_dic == 0)
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($total_suma_total_dic, 2, '.', ',') }}</b></td>
                       @endif
                       <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>


                       @if($total_partida_total_porcentaje == 0)
                           <td class="tw:bg-yellow-200 tw:dark:bg-yellow-500/20 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:bg-yellow-200 tw:dark:bg-yellow-500/20 tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($total_partida_total_porcentaje, 2, '.', ',') }}</b></td>
                       @endif
                       @if($total_estatal_total_porcentaje == 0)
                           <td class="tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($total_estatal_total_porcentaje, 2, '.', ',') }}</b></td>
                       @endif
                       @if($total_federal_total_porcentaje == 0)
                           <td class="tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($total_federal_total_porcentaje, 2, '.', ',') }}</b></td>
                       @endif
                       @if($total_propios_total_porcentaje == 0)
                           <td class="tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($total_propios_total_porcentaje, 2, '.', ',') }}</b></td>
                       @endif
                       @if($total_porcentaje_total_partida == 0)
                           <td class="tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>-</b></td>
                       @else
                           <td class="tw:text-gray-800 tw:dark:text-white/90 tw:text-right"><b>{{ number_format($total_porcentaje_total_partida, 2, '.', ',') }}</b></td>
                       @endif



                   </tr>


               @endforeach
               <?php
               $total_partida_total_porcentaje1=$total_suma_total_enero1+$total_suma_total_febrero1+$total_suma_total_marzo1+$total_suma_total_abril1+$total_suma_total_mayo1+$total_suma_total_junio1+$total_suma_total_julio1+$total_suma_total_agosto1+$total_suma_total_sep1+$total_suma_total_octubre1+$total_suma_total_nov1+$total_suma_total_dic1;

               $total_porcentaje_total_partida1=$total_estatal_total_porcentaje1+$total_federal_total_porcentaje1+$total_propios_total_porcentaje1;

               ?>

           </table>
</div>


        @endif
    <script type="text/javascript">
        $(document).ready(function() {


            $("#id_fuente_financiamiento").on('change',function(e) {
                // TNotify.alert($("#grupos").val());
                var id_fuente_financiamiento = $("#id_fuente_financiamiento").val();

               window.location.href='/presupuesto_anteproyecto/ver_proyecto_capitulo_anteproyecto/'+id_fuente_financiamiento;



            });

        });

    </script>
</div>
@endsection