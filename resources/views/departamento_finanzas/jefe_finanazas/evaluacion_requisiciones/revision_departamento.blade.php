@extends('layouts.panel')
@section('title', 'Revisión de requisiciones')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <p>
                <span class="fa fa-arrow-right"></span>
                <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/presupuesto_anteproyecto/revicion_requisiciones_anteproyecto")}}">Revisión de requisiciones de los departamentos </a>
                <span class="fa fa-arrow-right"></span>
                <span >Requisiciones del departamento </span>

            </p>
        </div>
    </div>
    <x-panel.encabezado :titulo="'Revisión de requisiciones del anteproyecto de presupuesto '.$datos_jefe->year_requisicion.' (nombre del jefe(a) del departamento o jefatura: '.$datos_jefe->titulo.' '.$datos_jefe->nombre.') (nombre del departamento o jefatura: '.$datos_jefe->nom_departamento" :migas="['Finanzas' => null]" />





    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <p></p>
        </div>
    </div>

    @foreach($requisiciones2 as $requisicion)
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">

                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center tw:text-gray-800 tw:dark:text-white/90">PARTIDA PRESUPUESTAL: <b>{{ $requisicion['nombre_partida'] }}</b></h4>
                                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center tw:text-gray-800 tw:dark:text-white/90">MES: <b>{{ $requisicion['mes'] }}</b></h4>
                                <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300 tw:text-center tw:text-gray-800 tw:dark:text-white/90">JUSTIFICACIÓN: <b>{{ $requisicion['justificacion'] }}</b></h5>
                                <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center tw:text-gray-800 tw:dark:text-white/90">PROYECTO: <b>{{ $requisicion['nombre_proyecto'] }}</b></h4>
                                <h5 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300 tw:text-center tw:text-gray-800 tw:dark:text-white/90">META: <b>{{ $requisicion['meta'] }}</b></h5>
                            </div>
                        </div>
                        @if( $requisicion['id_autorizacion']  == 0)
                                @if($requisicion['comentario']  != '' )
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:px-2">
                                        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-800 tw:dark:text-red-400">COMENTARIO MODIFICACIÓN: <b>{{ $requisicion['comentario']  }}</b></h4>
                                    </div>

                                </div>
                                @endif
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <button class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" onclick="window.location='{{ url('/presupuesto_anteproyecto/revisicion_bienes_servicios_departamento/'.$requisicion['id_actividades_req_ante'].'/'.$id_req_mat_ante ) }}'">Revisar requisición</button>
                                </div>

                            </div>
                        @else
                                @if( $requisicion['id_autorizacion']  == 2)
                                <h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Permiso de modificar.<br>
                                                COMENTARIO:  <b>{{ $requisicion['comentario']  }}</b></h3>

                                @endif
                                    @if( $requisicion['id_autorizacion']  == 4)
                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                            <div class="tw:w-full tw:px-2">
                                                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">
                                                        Requisición autorizada
                                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                            <div class="tw:w-full tw:px-2">
                                                                <button class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" onclick="window.location='{{ url('/presupuesto_anteproyecto/ver_autorizacion_bienes_servicios_departamento/'.$requisicion['id_actividades_req_ante'].'/'.$id_req_mat_ante ) }}'">Ver requisición autorizada</button>
                                                            </div>

                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>

                                    @endif
                                    @if( $requisicion['id_autorizacion']  == 3)
                                        <x-panel.alerta tipo="error" class="tw:mb-4">Requisión rechazada<br>
                                                        COMENTARIO DE PORQUE SE RECHAZÓ :  <b>{{ $requisicion['comentario']  }}</b></x-panel.alerta>

                                    @endif

                        @endif
                    </div>
                </div>

            </div>

            @endforeach
    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
        </div>
    </div>
            @if($numero_requisicion == $total_req_cal )
                @if($total_mod == 0)
                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <button  id="{{ $id_req_mat_ante }}"  class="autorizar_requisiciones tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Enviar notificación
                            </button>
                        </div>
                    </div>

               @else
                    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <button  id="{{ $id_req_mat_ante }}"  class="mod_requisiciones tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Enviar notificación
                            </button>
                        </div>
                    </div>
                @endif
           @endif
            <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                </div>
            </div>

            {{-- modal enviar modificaciones --}}

            <x-panel.modal id="modal_enviar_modificacion" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Enviar modificaciones</h4>
                        </div>
                        <div class="tw-modal-cuerpo">
                            <form id="form_enviar_modificaciones" action="{{url("/presupuesto_anteproyecto/enviar_modificaciones_depart/")}}" method="POST" role="form" >
                                {{ csrf_field() }}
                                <input type="hidden" id="id_req_mat_ante" name="id_req_mat_ante" value="">
                                <h2 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">¿ Seguro(a) que quiere enviar las modificaciones al jefe(a) de departamento o jefatura</h2>
                            </form>
                            <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                                <button id="guardar_enviar_modificaciones"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                            </div>
                        </div>
                    </x-panel.modal>

            {{-- modal enviar autorizacion --}}

            <x-panel.modal id="modal_enviar_autorizacion" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Enviar notificación</h4>
                        </div>
                        <div class="tw-modal-cuerpo">
                            <form id="form_enviar_autorizacion" action="{{url("/presupuesto_anteproyecto/enviar_autorizacion_depart/")}}" method="POST" role="form" >
                                {{ csrf_field() }}
                                <input type="hidden" id="id_req_mat_antep" name="id_req_mat_antep" value="">
                                <h2 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">¿Seguro(a) que quiere enviar notificación de que ya se revisaron toda las requisiciones ?</h2>
                            </form>
                            <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                                <button id="guardar_enviar_autorizacion"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                            </div>
                        </div>
                    </x-panel.modal>

            <script>
                $(document).ready(function() {
                    $(".mod_requisiciones").click(function (){
                        var id_req_mat_ante = $(this).attr('id');
                        $('#id_req_mat_ante').val(id_req_mat_ante);
                        $("#modal_enviar_modificacion").modal('show');
                    });
                    $("#guardar_enviar_modificaciones").click(function (){
                        $("#form_enviar_modificaciones").submit();
                        $("#guardar_enviar_modificaciones").attr("disabled", true);
                    });
                    $(".autorizar_requisiciones").click(function (){
                        var id_req_mat_ante = $(this).attr('id');
                        $('#id_req_mat_antep').val(id_req_mat_ante);
                        $("#modal_enviar_autorizacion").modal('show');
                    });
                    $("#guardar_enviar_autorizacion").click(function (){
                        $("#form_enviar_autorizacion").submit();
                        $("#guardar_enviar_autorizacion").attr("disabled", true);
                    });

                });
            </script>
</div>
@endsection