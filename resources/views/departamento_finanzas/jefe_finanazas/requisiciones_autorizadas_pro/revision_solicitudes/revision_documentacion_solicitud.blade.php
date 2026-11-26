@extends('layouts.panel')
@section('title', 'Revisión de solicitudes')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Revisión de documentos de la solicitud" :migas="['Finanzas' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    <p><span class="fa fa-file"></span> Solicitud: <b>{{ $solicitud->descripcion_solicitud }}</b></p>
                    <p>Proyecto: <b>{{ $solicitud->nombre_proyecto }}</b></p>
                    <p>Meta: <b>{{ $solicitud->meta }}</b></p>
                    <p>Mes: <b>{{ $solicitud->mes }}</b></p>

                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:lg:w-full tw:px-2">

                                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                                    <thead>
                                    <tr>
                                        <th class="tw:text-center tw:bg-sky-50 tw:dark:bg-sky-500/10" colspan="7">
                                            <b>PARTIDAS PRESUPUESTALES</b>
                                        </th>
                                    </tr>
                                    @foreach($partidas as $partida)
                                    <tr>

                                        <th class="tw:text-center" colspan="7">
                                            {{ $partida->clave_presupuestal }} {{ $partida->nombre_partida }}..............................................................
                                            <b class="tw:text-red-600 tw:dark:text-red-400">PRESUPUESTO DADO: {{ "$".number_format($partida->presupuesto_dado, 2, '.', ',') }}</b>
                                        </th>
                                    </tr>
                                    @endforeach
                                    </thead>
                                </table>
</div>


                        </div>
                    </div>
     <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
            <thead>
            <tr>
                <th class="tw:text-center tw:bg-sky-50 tw:dark:bg-sky-500/10" colspan="5">Documentación en pdf</th>
            </tr>
            <tr>
                <th>Requisición </th>
                <th>Anexo 1</th>
                <th>Oficio de suficiencia presupuestal</th>
                <th>Justificación para dictamen</th>
                <th>Cotización</th>

            </tr>
            </thead>
            <tbody>
            <tr>
                @if($documentos->requisicion_pdf == '')
                    <td class="tw:text-center">
                       No hay documento
                    </td>
                @else
                    <td class="tw:text-center">
                        <a  target="_blank" href="/finanzas/requisicion_pres_aut/{{ $documentos->requisicion_pdf }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                    </td>
                @endif
                @if($documentos->anexo_1_pdf == '')
                    <td class="tw:text-center">
                        No hay documento
                    </td>
                @else
                    <td class="tw:text-center">
                        <a  target="_blank" href="/finanzas/anexo1_pres_aut/{{ $documentos->anexo_1_pdf }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>

                    </td>
                @endif
                @if($documentos->oficio_suficiencia_presupuestal_pdf == '')
                    <td class="tw:text-center">
                        No hay documento
                    </td>
                @else
                    <td class="tw:text-center">
                        <a  target="_blank" href="/finanzas/suficiencia_pres_aut/{{ $documentos->oficio_suficiencia_presupuestal_pdf }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                    </td>
                @endif
                @if($documentos->id_estado_justificacion == 0)
                    <td class="tw:text-center">
                        Sin justificacion de dictamen
                     </td>
                @else
                    <td class="tw:text-center">
                        @if($documentos->id_estado_justificacion == 1)
                            Sin justificacion de dictamen
                        @else
                            <a  target="_blank" href="/finanzas/justificacion_pres_aut/{{ $documentos->oficio_justificacion }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                        @endif

                    </td>
                @endif
                @if($documentos->cotizacion_pdf == '')
                    <td class="tw:text-center">
                        No hay documento
                    </td>
                @else
                    <td class="tw:text-center">
                        <a  target="_blank" href="/finanzas/cotizacion_pres_aut/{{ $documentos->cotizacion_pdf }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-book em56" title="Ver PDF"></i></a>
                    </td>

                @endif
            </tr>


            </tbody>
        </table>
</div>
    </div>
</div>

</div>
</div>
</div>
</div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-6/12 tw:px-2 tw:text-center">
            <button  id="{{ $id_solicitud }}"  class="enviar_modificaciones_solicitud tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Enviar modificaciones
            </button>
        </div>
        <div class="tw:w-full tw:lg:w-6/12 tw:px-2 tw:text-center">
            <button  id="{{ $id_solicitud }}"  class="enviar_autorizacion_solicitud tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Enviar autorizacion
            </button>
        </div>
    </div>
    {{-- modal enviar solicitud --}}

    <x-panel.modal id="modal_enviar_modificaciones" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Enviar modificaciones</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <form id="form_enviar_modificaciones" class="" action="{{url("/presupuesto_autorizado/enviar_modificaciones_departamento/".$id_solicitud)}}" role="form" method="POST" >
                        {{ csrf_field() }}
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label>Comentarios de modificaciones</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="comentario" name="comentario" rows="3" onkeyup="javascript:this.value=this.value.toUpperCase();" required></textarea>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_enviar_modoificaciones"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Enviar</button>
                    </div>
                </div>
            </x-panel.modal>
    {{-- modal enviar autorizacion de la solicitud --}}

    <x-panel.modal id="modal_enviar_autorizacion" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Enviar autorización</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <form id="form_enviar_autorizacion" class="" action="{{url("/presupuesto_autorizado/enviar_autorizacion_departamento/".$id_solicitud)}}" role="form" method="POST" >
                        {{ csrf_field() }}
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                               <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">¿Seguro que quiere autorizar la solicitud?</h4>
                            </div>
                        </div>
                    </form>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_enviar_autorizacion"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                    </div>
                </div>
            </x-panel.modal>
    <script>
        $(document).ready(function (){
            $("#guardar_enviar_autorizacion").click(function (){
                $("#form_enviar_autorizacion").submit();
                $("#guardar_enviar_autorizacion").attr("disabled", true);
            });
            $(".enviar_autorizacion_solicitud").click(function (){
                $("#modal_enviar_autorizacion").modal('show');
            });
            $(".enviar_modificaciones_solicitud").click(function (){
                $("#modal_enviar_modificaciones").modal('show');
            });

            $("#guardar_enviar_modoificaciones").click(function (){
                var comentario = $("#comentario").val();
                if(comentario != ''){
                    $("#form_enviar_modificaciones").submit();
                    $("#guardar_enviar_modoificaciones").attr("disabled", true);
                    swal({
                        position: "top",
                        type: "success",
                        title: "Envío exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }else{
                    swal({
                        position: "top",
                        type: "error",
                        title: "Ingresa comentario de modificación",
                        showConfirmButton: false,
                        timer: 3500
                    });

                }
            });
        });
    </script>

</div>
@endsection