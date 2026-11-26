@extends('layouts.panel')
@section('title', 'Techo presupuestal')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <p>
                <span class="fa fa-arrow-right"></span>
                <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/presupuesto_anteproyecto/techo_presupuestal")}}">Registro de proyectos </a>
                <span class="fa fa-chevron-right"></span>
                <span>Registrar capitulos</span>
            </p>
        </div>
    </div>
    <x-panel.encabezado :titulo="'Techo presupuestal del Anteproyecto '.$year" :migas="['Finanzas' => null]" />
    @if($contar_f !== 0)
        <?php setlocale(LC_MONETARY, 'es_MX');
        ?>

    @endif


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
                                 <button type="button" class="agregar_capitulos tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{$presupuesto['id_presupuesto'] }}" title="Agregar capitulos" ><span class="fa fa-plus" aria-hidden="true"></span></button>
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
                                            <th class="tw:text-center">EDITAR</th>
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
                                                <td class="tw:text-right">
                                                    <button class="modificar_capitulo tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{ $fuentes['id_fuente_financiamiento'] }}" ><i class="fa fa-cog "></i></button>

                                                </td>
                                                <td class="tw:bg-gray-100 tw:dark:bg-gray-800 tw:text-gray-800 tw:dark:text-white/90 tw:text-center">{{ $fuentes['nombre_capitulo'] }}</td>
                                                <?php
                                                $presupuesto_estatal=$fuentes['presupuesto_estatal'];
                                                $presupuesto_estatal= number_format($presupuesto_estatal, 2, '.', ',');
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
                                                <td class="tw:text-right">{{ round($fuentes['total_financiamiento'],4) }}</td>

                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td></td>
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