@extends('layouts.panel')
@section('title', 'Registro de Oficios enviados')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
            <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800">
                <li>
                    <a href="{{url('/oficios/historialoficios')}}">Historial de oficios</a>
                </li>
                <li class="active"><a href="#">Oficios enviados</a></li>

            </ul>
            </div>
        </div>
        <x-panel.encabezado titulo="Registro de Oficios enviados" :migas="['Oficios de comisión' => null]" />
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
            <x-panel.alerta tipo="error" class="tw:mb-4">Atencion: Para cancelar un oficio de comisiòn ya aceptado llamar al Departamento de Administraciòn de Personal o para poder modificar un oficio ya autorizado</x-panel.alerta>
            </div>
        </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_enviado" class="tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Fecha solicitud</th>
                        <th>Motivo de la comisión</th>
                        <th>Modificar solicitud</th>
                        <th>Comisionados</th>
                        <th>Ver oficio</th>
                        <th>Imprimir</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($solicitudes as $oficio)

                        <tr>
                            <td rowspan="{{$oficio->comisionesvalidadas->count()+1}}">{{ $oficio->id_oficio }}</td>
                            <?php  $fecha_hora=date("d-m-Y H:i",strtotime($oficio->fecha_hora)) ?>
                            <td rowspan="{{$oficio->comisionesvalidadas->count()+1}}" >{{ $fecha_hora }}</td>
                            <td class="tw:text-xs" rowspan="{{$oficio->comisionesvalidadas->count()+1}}" >{{  $oficio->desc_comision }}</td>
                            <td rowspan="{{$oficio->comisionesvalidadas->count()+1}}" >
                                @if($oficio->id_notificacion_solicitud == 4)
                                <button class="modifica tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" onclick="window.location='{{ url('/oficios/modificar/'.$oficio->id_oficio ) }}'"><i class="fa fa-cog "></i></button>
                               @endif
                            </td>
                        </tr>
                        @foreach($oficio->comisionesvalidadas as $ofic)

                            @foreach($ofic->personal as $personal)
                                <tr >
                                    <td class="tw:h-12.5"> {{$personal->nombre}}</td>

                                    <td>
                                        <button class="edita tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{ $ofic->id_oficio_personal }}"><i class="fa fa-list"></i></button>
                                    </td>

                                    @if($ofic->id_notificacion==1)
                                        <td>Enviado al D. A. Personal</td>
                                    @endif
                                    @if($ofic->id_notificacion==2  and $ofic->estado_oficio==0)
                                        @if ($ofic->viaticos == 1 AND $ofic->automovil == 1 )
                                            <td> <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{url('pdfregistro', ['id_oficio_personal' => $ofic->id_oficio_personal])}}')">Imprimir</button></td>
                                        @endif
                                        @if ($ofic->viaticos == 2 AND $ofic->automovil == 1 )
                                            <td> <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{url('pdfregistroviaticos', ['id_oficio_personal' => $ofic->id_oficio_personal])}}')">Imprimir</button></td>
                                        @endif
                                        @if ($ofic->viaticos == 1 AND $ofic->automovil == 2 )
                                            <td> <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{url('pdfregistroautos', ['id_oficio_personal' => $ofic->id_oficio_personal])}}')">Imprimir</button></td>
                                        @endif
                                        @if ($ofic->viaticos == 2 AND $ofic->automovil == 2 )
                                            <td> <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{url('pdfregistroautosviaticos', ['id_oficio_personal' => $ofic->id_oficio_personal])}}')">Imprimir</button></td>
                                        @endif
                                    @endif
                                    @if($ofic->id_notificacion==2  and $ofic->estado_oficio==1)
                                       <td>Cancelado</td>

                                    @endif
                                    @if($ofic->id_notificacion==2  and $ofic->estado_oficio==2)

                                       <td class="tw:bg-sky-100 tw:dark:bg-sky-500/15"><button class="modifica_comisionado tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" onclick="window.location='{{ url('/oficios/modificar/oficio_aceptado/'.$ofic->id_oficio_personal ) }}'"><i class="fa fa-cog "></i></button>
                                       </td>


                                    @endif
                                    @if($ofic->id_notificacion==3)
                                        <td>Rechazado por D. A. Personal</td>
                                    @endif
                                    @if($ofic->id_notificacion==4)
                                        <td>Proceso modificación</td>
                                    @endif
                                    @if($ofic->id_notificacion==5)
                                        <td>Enviado a subdirección</td>
                                    @endif
                                    @if($ofic->id_notificacion==6)
                                        <td>Rechazado por subdirección</td>
                                    @endif


                                </tr>
                            @endforeach
                        @endforeach

                    @endforeach
                    </tbody>
                </table>
</div>
            </div>
        </div>

        <x-panel.modal id="modal_mostrar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Oficio de Comisión</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <div id="contenedor_mostrar">
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                    </div>
                </x-panel.modal>
</main>
<script type="text/javascript">
$(document).ready(function() {

    $("#table_enviado").on('click','.edita',function(){
        var idof=$(this).attr('id');

        $.get("/oficios/mostrar/"+idof,function (request) {
            $("#contenedor_mostrar").html(request);
            $("#modal_mostrar").modal('show');
        });
    });
    $('#table_enviado').DataTable( {

    } );
    $("#table_enviado").on('click','.modifica_comisionado',function(){
        var idof=$(this).attr('id');

    });

});
</script>
</div>
@endsection