@extends('layouts.panel')
@section('title', 'Requisicion de materiales')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado :titulo="'Requisiciones de materiales '.$year" :migas="['Finanzas' => null]" />
    @if($estado_periodo == 0)
        <x-panel.alerta tipo="error" class="tw:mb-4">No se ha registrado el periodo de envio de requisiciones de materiales.</x-panel.alerta>
    @else
        @if($estado_fecha == 1)
            @if($registros == null)
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:text-center tw:px-2">
                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                <div class="tw:p-5 tw:sm:p-6">
                                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-toggle="modal" data-target="#modal_envia_requisicion">Iniciar envió de requisiciones de materiales </button>
                                   </div>
                            </div>
                        </div>
                    </div>
            @else
                    @if($registros->id_estado_requisicion == 0 )
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:text-center tw:px-2">
                                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                    <div class="tw:p-5 tw:sm:p-6">
                                        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Año de las requisiciones de materiales del anteproyecto: {{ $registros->year_requisicion }}</h4>
                                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" onclick="window.location=('{{url('/presupuesto_anteproyecto/registro_inicio_req_ant/'.$registros->id_req_mat_ante)}}')">Registrar requisiciones de materiales</button>   </div>
                                </div>
                            </div>
                        </div>

                    @endif

                    @if($registros->id_estado_requisicion == 1 )
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <x-panel.alerta tipo="exito" class="tw:mb-4"><h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Se enviaron correctamente tus requisiciones de materiales del anteproyecto: {{ $registros->year_requisicion }}</h4></x-panel.alerta>

                    @endif
                            @if($registros->id_estado_requisicion == 2 )
                                <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:text-center tw:px-2">
                                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                            <div class="tw:p-5 tw:sm:p-6">
                                                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Año de requisiciones de materiales de anteproyecto: {{ $registros->year_requisicion }}</h4>
                                                <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">Hacer las modificaciones correspondientes que aparecen en los comentarios al ingresar</h5>
                                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" onclick="window.location=('{{url('/presupuesto_anteproyecto/modificar_requisicones/'.$registros->id_req_mat_ante)}}')">Modificaciones de requisiciones de materiales</button>   </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                                   @if($registros->id_estado_requisicion == 3 )
                                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <x-panel.alerta tipo="exito" class="tw:mb-4"><h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Se enviaron correctamente tus modificaciones de tus requisiciones de materiales del anteproyecto: {{ $registros->year_requisicion }}</h4></x-panel.alerta>

                                    @endif
                                        @if($registros->id_estado_requisicion == 4 )
                                            <x-panel.alerta tipo="exito" class="tw:mb-4"><h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Tus requisiciones ya fueron revisadas.</h4></x-panel.alerta>
                                            <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                <div class="tw:w-full tw:text-center tw:px-2">
                                                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                                        <div class="tw:p-5 tw:sm:p-6">
                                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Año de requisiciones de materiales de anteproyecto: {{ $registros->year_requisicion }}</h4>
                                                            <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">Ver las requisiciones autorizadas</h5>
                                                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" onclick="window.location=('{{url('/presupuesto_anteproyecto/ver_requisiciones_autorizadas/'.$registros->id_req_mat_ante)}}')">Requisiciones de materiales</button>   </div>
                                                    </div>
                                                </div>
                                            </div>

                                                @endif


            @endif

        @elseif($estado_fecha == 2)
            <x-panel.alerta tipo="error" class="tw:mb-4"><?php
                            $fecha_inicio= date('d-m-Y', strtotime($periodo->fecha_inicio));
                            $fecha_final= date('d-m-Y', strtotime($periodo->fecha_final));
                            ?>
                            El periodo todavía no empieza o ya termino, las fechas establecidas para el envió de requisiciones  de materiales son las siguientes : {{ $fecha_inicio }} al  {{ $fecha_final }}</x-panel.alerta>
        @elseif($estado_fecha == 3)
            <x-panel.alerta tipo="error" class="tw:mb-4">El periodo ya fue finalizado por la Dirección de Administración y Finanzas.</x-panel.alerta>
        @endif
    @endif
    <x-panel.modal id="modal_envia_requisicion" tamano="md" sin-relleno clase-cerrar="close">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Notificación de inicio de envió</h4>
                </div>
                <form id="form_envio" class="" action="{{url("/presupuesto_anteproyecto/registrar_inicio_req_ant/")}}" role="form" method="POST" >
                    {{ csrf_field() }}
                <div class="tw-modal-cuerpo">
                    <p>Iniciar envió de requisiciones de materiales  </p>
                </div>
                </form>
                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                    <button id="guardar_envio"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                </div>
            </x-panel.modal>
    <script type="text/javascript">
        $(document).ready( function() {
            $("#guardar_envio").click(function (){
                $("#form_envio").submit();
                $("#guardar_envio").attr("disabled", true);
            });
        });
    </script>


</div>
@endsection