@extends('layouts.panel')
@section('title', 'Periodos de anteproyecto')
@include('partials.panel.recursos_app', ['datepicker' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Periodos de requisiciones de materiales del anteproyecto" :migas="['Finanzas' => null]" />
            @if($reg_periodo->contar == 0)
                <x-panel.alerta tipo="error" class="tw:mb-4">Registrar el periodo de requisiciones de materiales del anteproyecto, ya debe estar registrado el presupuesto del anteproyecto {{ $year }}.</x-panel.alerta>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar periodo" data-target="#modal_crear_periodo" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
                            <span class="fa fa-plus" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            @else


                    @if($activo_periodo->contar == 1)
                        <x-panel.alerta tipo="exito" class="tw:mb-4"><?php   $fecha_i= date('d-m-Y', strtotime( $periodo_activo->fecha_inicio)); ?>
                                        <?php   $fecha_f= date('d-m-Y', strtotime( $periodo_activo->fecha_final)); ?>
                                         Periodo activo <br> {{ $fecha_i }} al {{ $fecha_f }} <br>Año de requisiciones de materiales del anteproyecto :  {{  $periodo_activo->year }}
                                           <p class="tw:text-center" ><button data-toggle="tooltip" data-placement="top" id="{{$periodo_activo->id_peri_anteproyecto }}" title="Modificar periodo" class="h-primary_m modificar_periodo_activo tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Modificar periodo</button></p>
                                            <p class="tw:text-center">          <button data-toggle="tooltip" data-placement="top" id="{{$periodo_activo->id_peri_anteproyecto }}" title="Finalizar periodo" class="h-primary_m finalizar_periodo tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Finalizar periodo</button>
                                           </p></x-panel.alerta>
                        {{-- modal finalizar periodo--}}

                        <x-panel.modal id="modal_finalizar_periodo" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                        
                                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Periodo de requisiciones de materiales del anteproyecto </h4>
                                    </div>
                                    <div class="tw-modal-cuerpo">
                                        <form action="{{url("/presupuesto_anteproyecto/guardar_finalizacion_periodos_anteproyecto/".$periodo_activo->id_peri_anteproyecto)}}" role="form" method="POST" >
                                            {{ csrf_field() }}
                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                <div class="tw:w-full tw:px-2">
                                                    <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Finalizar periodo</h3>
                                                </div>
                                            </div>
                                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                                            <button type="submit"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                                        </div>
                                        </form>
                                    </div>
                                </x-panel.modal>
                    @elseif($periodo_finalizado->contar == 1)
                        <x-panel.alerta tipo="exito" class="tw:mb-4">El periodo de este año ya se encuentra finalizado.</x-panel.alerta>
                        <x-panel.alerta tipo="advertencia" class="tw:mb-4"><?php   $fecha_i= date('d-m-Y', strtotime( $periodo_activo->fecha_inicio)); ?>
                                        <?php   $fecha_f= date('d-m-Y', strtotime( $periodo_activo->fecha_final)); ?>
                                         Periodo finalizado:  <br> {{ $fecha_i }} al {{ $fecha_f }} <br>Año:  {{  $periodo_activo->year }}</x-panel.alerta>

                    @else
                        <x-panel.alerta tipo="advertencia" class="tw:mb-4">El periodo  ya se encuentra registrado.</x-panel.alerta>
                    @endif
            @endif
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" id="registros_periodos">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Fecha inicial</th>
                    <th>Fecha final</th>
                    <th>Año</th>
                    <th>Modificar</th>
                    <th>Estado</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; ?>
                       @foreach($periodos as $periodo)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <?php   $fecha_i= date('d-m-Y', strtotime( $periodo->fecha_inicio)); ?>
                            <td>{{ $fecha_i }}</td>
                            <?php   $fecha_f= date('d-m-Y', strtotime( $periodo->fecha_final)); ?>
                            <td>{{ $fecha_f }}</td>
                            <td>{{ $periodo->year }}</td>
                                @if($activo_periodo->contar == 1 || $periodo_finalizado->contar == 1)
                                @if($periodo->id_activacion == 2)
                                <td>Finalizado</td>
                                <td>Finalizado</td>
                                @endif
                                    @if($periodo->id_activacion == 1)
                                        <td>Activo</td>
                                        <td>Activo</td>
                                    @endif
                                @else
                                @if($periodo->id_activacion == 0)
                                        <td>
                                            <button data-toggle="tooltip" data-placement="top" id="{{$periodo->id_peri_anteproyecto }}" title="Modificar periodo" class="h-primary_m modificar_periodo tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Modificar periodo</button>
                                        </td>
                                        <td>
                                            <button data-toggle="tooltip" data-placement="top" id="{{$periodo->id_peri_anteproyecto }}" title="Activar periodo" class="h-primary_m activar_periodo tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Activar periodo</button>
                                        </td>
                                    @elseif($periodo->id_activacion == 2)
                                    <td>Finalizado</td>
                                    <td>Finalizado</td>
                                @else
                                    <td></td>
                                    <td></td>
                                @endif
                            @endif

                        </tr>
                        @endforeach



                </tbody>
            </table>
</div>
        </div>
    </div>

    {{-- modal crear periodo--}}

    <x-panel.modal id="modal_crear_periodo" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar periodo de requisiciones de materiales del anteproyecto </h4>
                </div>
                <div class="tw-modal-cuerpo">

                    <form id="form_agregar" class="" action="{{url("/presupuesto_anteproyecto/guardar_periodos_anteproyecto/")}}" role="form" method="POST" >
                        {{ csrf_field() }}
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label>Seleccionar fecha inicial del periodo</label>
                                    <input class="datepicker fecha_inicio tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"   type="text"  id="fecha_i" name="fecha_i" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" >
                                </div>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label>Seleccionar fecha final del periodo</label>
                                    <input class="datepicker fecha_final tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="text" id="fecha_f" name="fecha_f" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy">

                                </div>
                            </div>
                        </div>
                        <?php $year_actual = date("Y");
                        $year_actual =$year_actual+1;?>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label>Año de  requesiciones</label>
                                    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="text" id="year_actual" name="year_actual" value="{{ $year_actual }}" readonly>

                                </div>
                            </div>
                        </div>

                    </form>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_periodo"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>

    {{-- modal modificar periodo--}}

    <x-panel.modal id="modal_modificacion" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Modificar periodo de requisiciones de materiales del anteproyecto </h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_modificacion">

                    </div>

                     <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_modificacion_periodo"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                    </div>
                </div>
            </x-panel.modal>

    {{-- modal activar periodo--}}

    <x-panel.modal id="modal_activar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Activar periodo de requisiciones de materiales del anteproyecto </h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_activar">

                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_activacion_periodo"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </div>
            </x-panel.modal>

    <script type="text/javascript">
        $(document).ready( function() {
            $( '.fecha_inicio').datepicker({
                pickTime: false,
                autoclose: true,
                language: 'es',
                startDate: '+0d',

            });
            $( '.fecha_final' ).datepicker({
                pickTime: false,
                autoclose: true,
                language: 'es',
                startDate: '+0d',
            });
            $("#guardar_periodo").click(function (){
                var fecha_i = $('#fecha_i').val();
               if(fecha_i != ''){
                   var fecha_f = $('#fecha_f').val();
                   if(fecha_f != ''){
                       $("#form_agregar").submit();
                       $("#guardar_periodo").attr("disabled", true);
                   }else{
                       swal({
                           position: "top",
                           type: "error",
                           title: "La fecha final no debe ser vacia",
                           showConfirmButton: false,
                           timer: 3500
                       });
                   }
               }else{
                   swal({
                       position: "top",
                       type: "error",
                       title: "La fecha inicial no debe ser vacia",
                       showConfirmButton: false,
                       timer: 3500
                   });
               }
            });
            $("#registros_periodos").on('click','.modificar_periodo',function(){
                var id_periodo =$(this).attr('id');

                $.get("/presupuesto_anteproyecto/modificar_periodos_anteproyecto/"+id_periodo,function (request) {
                    $("#contenedor_modificacion").html(request);
                    $("#modal_modificacion").modal('show');
                });
            });
            $("#guardar_modificacion_periodo").click(function (){
                $("#form_modificar_periodo").submit();
                $("#guardar_modificacion_periodo").attr("disabled", true);
            });
            $("#registros_periodos").on('click','.activar_periodo',function (){
                var id_periodo =$(this).attr('id');
                $.get("/presupuesto_anteproyecto/activar_periodo_anteproyecto/"+id_periodo,function (request) {
                    $("#contenedor_activar").html(request);
                    $("#modal_activar").modal('show');
                });
            });
            $("#guardar_activacion_periodo").click(function (){
                $("#form_activar_periodo").submit();
                $("#guardar_activacion_periodo").attr("disabled", true);
            });
            $(".finalizar_periodo").click(function (){
                $("#modal_finalizar_periodo").modal('show');
            });
            $(".modificar_periodo_activo").click(function (){
                var id_periodo =$(this).attr('id');
                $.get("/presupuesto_anteproyecto/modificar_periodos_anteproyecto/"+id_periodo,function (request) {
                    $("#contenedor_modificacion").html(request);
                    $("#modal_modificacion").modal('show');
                });
            });

        });
    </script>
</div>
@endsection