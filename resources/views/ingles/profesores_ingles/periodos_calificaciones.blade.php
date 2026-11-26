{{--
    Periodos para evaluar habilidades de un grupo (/ingles/Calificaciones/periodos_ingles/{nivel}/{grupo},
    In_inicioController@periodos_ingles). Diseño del panel; mismas condiciones ($cuenta_periodos, evaluada,
    unidad 19), mismos botones .agregar / .modificar con su id (unidad 1 o 2), mismos modales
    (#modal_registro con #form_agregar_periodo_ingles → POST /ingles/calificaciones/crear_periodos y
    #modal_modificar_per con #form_mod_periodo_ingles → POST /ingles/modificacion_per/) y mismo script.
    Versión anterior: tests/Fixtures/vistas_antes.
--}}
@extends('layouts.panel')
@section('title', 'Periodos de calificaciones')
@include('partials.panel.recursos_app')
@section('content')
    <?php
    $moduloIngles = true;
    $unidad = Session::get('id_unidad_admin');
    // estilos de las tarjetas de cada habilidad y de los indicadores (solo diseño)
    $caja = 'tw:flex tw:flex-col tw:items-center tw:gap-3 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-6 tw:text-center tw:dark:border-gray-800 tw:dark:bg-white/3';
    $tituloCaja = 'tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90';
    $fecha = 'tw:text-sm tw:font-medium tw:text-gray-600 tw:dark:text-gray-300';
    $sinFecha = 'tw:text-sm tw:font-medium tw:text-red-500';
    $realizada = 'tw:inline-flex tw:items-center tw:gap-1.5 tw:rounded-full tw:bg-green-50 tw:px-3 tw:py-1 tw:text-sm tw:font-medium tw:text-green-700 tw:dark:bg-green-500/15 tw:dark:text-green-500';
    $pendiente = 'tw:inline-flex tw:items-center tw:gap-1.5 tw:rounded-full tw:bg-red-50 tw:px-3 tw:py-1 tw:text-sm tw:font-medium tw:text-red-600 tw:dark:bg-red-500/15 tw:dark:text-red-500';
    ?>
    <main>
        <x-panel.encabezado titulo="Periodos para evaluar habilidades" :migas="['Inglés' => url('/ingles/'), 'Calificaciones de ingles' => url('/ingles/Calificaciones')]" />

        <x-panel.tarjeta class="tw:mb-6">
            <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">PERIODOS PARA EVALUAR HABILIDADES</h3>
            <p class="tw:mt-1 tw:text-sm tw:text-gray-600 tw:dark:text-gray-300">NIVEL:{{$nivel}} GRUPO:{{$id_grupo}}</p>
            <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $profesor->nombre }} {{ $profesor->apellido_paterno }} {{ $profesor->apellido_materno }}</p>
        </x-panel.tarjeta>

        <div class="tw:grid tw:grid-cols-1 tw:gap-4 tw:md:grid-cols-2 tw:md:gap-6">
    @if($cuenta_periodos == 0)
            <div class="{{ $caja }}">
                <h2 class="{{ $tituloCaja }}">SPEAKING</h2>
                <h6 class="{{ $sinFecha }}">No asignado</h6>
                <x-panel.boton data-toggle="tooltip" data-placement="top" id="1" title="Modificar fecha" class="agregar">Asignar fecha</x-panel.boton>
            </div>
            <div class="{{ $caja }}">
                <h2 class="{{ $tituloCaja }}">WRITING,READING, LISTENING</h2>
                <h6 class="{{ $sinFecha }}">No asignado</h6>
                <x-panel.boton data-toggle="tooltip" data-placement="top" title="Modificar fecha" disabled>Asignar fecha</x-panel.boton>
            </div>
    @elseif($cuenta_periodos == 1)
            <div class="{{ $caja }}">
                <h2 class="{{ $tituloCaja }}">SPEAKING</h2>
                <?php  $fecha_periodo=date("d-m-Y ",strtotime($periodo1[0]->fecha)) ?>
                <h6 class="{{ $fecha }}">{{$fecha_periodo }}</h6>
                @if($periodo1[0]->evaluada==1)
                    <a href="#!" class="tooltip-options link {{ $realizada }}" data-toggle="tooltip" data-placement="top" title="Evaluación realizada"><i class="fa fa-check" aria-hidden="true"></i> Evaluación realizada</a>
                @elseif($periodo1[0]->evaluada==0)
                    <a href="#!" class="tooltip-options link {{ $pendiente }}" data-toggle="tooltip" data-placement="top" title="Evaluación pendiente"><i class="fa fa-clock-o" aria-hidden="true"></i> Evaluación pendiente</a>
                   @if($unidad == 19)
                        <x-panel.boton tamano="sm" data-toggle="tooltip" data-placement="top" id="1" title="Modificar fecha" class="modificar"><i class="fa fa-pencil" aria-hidden="true"></i> Modificar fecha</x-panel.boton>
                    @endif
                @endif
            </div>
            <div class="{{ $caja }}">
                <h2 class="{{ $tituloCaja }}">WRITING,READING, LISTENING</h2>
                <h6 class="{{ $sinFecha }}">No asignado</h6>
                <x-panel.boton data-toggle="tooltip" data-placement="top" id="2" title="Modificar fecha" class="agregar">Asignar fecha</x-panel.boton>
            </div>
    @else
            <div class="{{ $caja }}">
                <h2 class="{{ $tituloCaja }}">SPEAKING</h2>
                <?php  $fecha_periodo1=date("d-m-Y ",strtotime($periodo1[0]->fecha)) ?>
                <h6 class="{{ $fecha }}">{{$fecha_periodo1 }}</h6>
                @if($periodo1[0]->evaluada==1)
                    <a href="#!" class="tooltip-options link {{ $realizada }}" data-toggle="tooltip" data-placement="top" title="Evaluación realizada"><i class="fa fa-check" aria-hidden="true"></i> Evaluación realizada</a>
                @elseif($periodo1[0]->evaluada==0)
                    <a href="#!" class="tooltip-options link {{ $pendiente }}" data-toggle="tooltip" data-placement="top" title="Evaluación pendiente"><i class="fa fa-clock-o" aria-hidden="true"></i> Evaluación pendiente</a>
                    @if($unidad == 19)
                        <x-panel.boton tamano="sm" data-toggle="tooltip" data-placement="top" id="1" title="Modificar fecha" class="modificar"><i class="fa fa-pencil" aria-hidden="true"></i> Modificar fecha</x-panel.boton>
                    @endif
                @endif
            </div>
            <div class="{{ $caja }}">
                <h2 class="{{ $tituloCaja }}">WRITING,READING, LISTENING</h2>
                <?php  $fecha_periodo2=date("d-m-Y ",strtotime($periodo2[0]->fecha)) ?>
                <h6 class="{{ $fecha }}">{{$fecha_periodo2 }}</h6>
                @if($periodo2[0]->evaluada==1)
                    <a href="#!" class="tooltip-options link {{ $realizada }}" data-toggle="tooltip" data-placement="top" title="Evaluación realizada"><i class="fa fa-check" aria-hidden="true"></i> Evaluación realizada</a>
                @elseif($periodo2[0]->evaluada==0)
                    <a href="#!" class="tooltip-options link {{ $pendiente }}" data-toggle="tooltip" data-placement="top" title="Evaluación pendiente"><i class="fa fa-clock-o" aria-hidden="true"></i> Evaluación pendiente</a>
                    @if($unidad == 19)
                        <x-panel.boton tamano="sm" data-toggle="tooltip" data-placement="top" id="2" title="Modificar fecha" class="modificar"><i class="fa fa-pencil" aria-hidden="true"></i> Modificar fecha</x-panel.boton>
                    @endif
                @endif
            </div>
    @endif
        </div>

        <x-panel.modal id="modal_registro" sin-relleno aria-labelledby="myModalLabel">
            <form id="form_agregar_periodo_ingles" class="form" action="{{url("/ingles/calificaciones/crear_periodos")}}" role="form" method="POST" >
                {{ csrf_field() }}
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Generar Fecha de Evaluación</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_registro">
                    </div>
                </div>
                <x-panel.modal-pie>
                    <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
                    <x-panel.boton id="guardar_periodo">Guardar</x-panel.boton>
                </x-panel.modal-pie>
            </form>
        </x-panel.modal>

        <x-panel.modal id="modal_modificar_per" sin-relleno aria-labelledby="myModalLabel">
            <form id="form_mod_periodo_ingles" class="form" action="{{url("/ingles/modificacion_per/")}}" role="form" method="POST" >
                {{ csrf_field() }}
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar Fecha de Evaluación</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_modificar_per">
                    </div>
                </div>
                <x-panel.modal-pie>
                    <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
                    <x-panel.boton id="modif_periodo">Guardar</x-panel.boton>
                </x-panel.modal-pie>
            </form>
        </x-panel.modal>
    </main>
    <script type="text/javascript">

        $(document).ready( function() {
            $(".modificar").click(function (event) {
                var id_unidad=$(this).attr('id');

                var id_nivel = "<?php  echo $id_nivel;?>";
                var id_grupo = "<?php  echo $id_grupo;?>";
                $.get("/ingles/modificar_per/"+id_unidad+"/"+id_nivel+"/"+id_grupo,function (request) {
                    $("#contenedor_modificar_per").html(request);
                    $("#modal_modificar_per").modal('show');
                });

            });
            $("#modif_periodo").click(function(event) {
                var fech = $("#fecha_periodo").val();
                if (fech != "") {


                    $("#form_mod_periodo_ingles").submit();
                    $("#modif_periodo").attr("disabled", true);

                } else {
                    swal({
                        position: "top",
                        type: "error",
                        title: "La fecha no debe ser vacia",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $(".agregar").click(function (event) {
                var id_unidad=$(this).attr('id');

                var id_nivel = "<?php  echo $id_nivel;?>";
                var id_grupo = "<?php  echo $id_grupo;?>";

                $.get("/ingles/registro_periodo_ingles/"+id_unidad+"/"+id_nivel+"/"+id_grupo,function (request) {
                    $("#contenedor_registro").html(request);
                    $("#modal_registro").modal('show');
                });
            });
            $("#guardar_periodo").click(function(event) {
                var fech = $("#fecha_periodo").val();
                if (fech != "") {


                    $("#form_agregar_periodo_ingles").submit();
                    $("#guardar_periodo").attr("disabled", true);

                } else {
                    swal({
                        position: "top",
                        type: "error",
                        title: "La fecha no debe ser vacia",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
        });
    </script>
@endsection
