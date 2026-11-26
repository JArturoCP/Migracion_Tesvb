@extends('layouts.panel')
@section('title', 'Registro de Oficios enviados')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800">
                    <li class="active">
                        <a href="#">Historial de oficios</a>
                    </li>
                    <li ><a href="{{url('/oficios/registrosoficio')}}">Oficios enviados</a></li>

                </ul>
            </div>
        </div>
        <x-panel.encabezado titulo="Historial de Oficios" :migas="['Oficios de comisión' => null]" />
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            
            <div class="tw:w-full tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="tabla_envio" class="tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>
                        <th>Numero</th>
                        <th>Nombre del comisionado</th>
                        <th>Descripcion del oficio</th>
                        <th>Fecha  oficio</th>
                        <th>Ver oficio</th>
                        <th>Estado de oficio</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($historiales as $historial)
                        <tr>
                            <td>{{$historial->id_oficio_personal}}</td>
                            <td>{{$historial->titulo}} {{$historial->nombre}}</td>
                            <td>{{$historial->desc_comision}}</td>
                            <?php  $fecha_hora=date("d-m-Y H:i",strtotime($historial->fecha_hora)) ?>
                            <td>{{$fecha_hora}}</td>
                            <td class="tw:text-center">
                                <button class="edita tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{ $historial->id_oficio_personal }}"><i class="fa fa-list"></i></button>
                            </td>

                            @if($historial->id_notificacion==1)
                                <td>Enviado</td>
                            @endif
                            @if($historial->id_notificacion==2)
                                @if ($historial->viaticos == 1 AND $historial->automovil == 1 )
                                    <td> <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{url('pdfregistro', ['id_oficio_personal' => $historial->id_oficio_personal])}}')">Imprimir</button></td>
                                @endif
                                @if ($historial->viaticos == 2 AND $historial->automovil == 1 )
                                    <td> <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{url('pdfregistroviaticos', ['id_oficio_personal' => $historial->id_oficio_personal])}}')">Imprimir</button></td>
                                @endif
                                @if ($historial->viaticos == 1 AND $historial->automovil == 2 )
                                    <td> <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{url('pdfregistroautos', ['id_oficio_personal' => $historial->id_oficio_personal])}}')">Imprimir</button></td>
                                @endif
                                @if ($historial->viaticos == 2 AND $historial->automovil == 2 )
                                    <td> <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{url('pdfregistroautosviaticos', ['id_oficio_personal' => $historial->id_oficio_personal])}}')">Imprimir</button></td>
                                @endif
                            @endif
                            @if($historial->id_notificacion==3)
                                <td>Rechazado</td>
                            @endif
                            @if($historial->id_notificacion==0)
                                <td>proceso</td>
                            @endif


                        </tr>

                    @endforeach
                    </tbody>
                </table>
</div>
            </div>
        </div>

        <x-panel.modal id="modal_mostrar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Oficio de Comision</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <div id="contenedor_mostrar">
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                    </div>
                </x-panel.modal>

        {{-- Modal para agragegar comicionados--}}
        <form id="form_registar_comisionados" action="{{url("/oficios/agregarcomicionado/agregado")}}" class="" role="form" method="POST">
            <x-panel.modal id="modal_agregar" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">AGREGAR COMISIONADO</h4>
                        </div>
                        <div class="tw-modal-cuerpo">
                            {{ csrf_field() }}
                            <input type="hidden" id="id_oficio" name="id_oficio" value="">
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full" id="contenedor_agregar">

                                </div>
                            </div>
                        </div>
                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="acepta tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="guardar">Agregar</button>
                        </div>
                    </x-panel.modal>
        </form>
    </main>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#tabla_envio").DataTable( {
                "order": [[ 3, "desc" ]]
            } );

            $("#tabla_envio").on('click','.edita',function(){
                var idof=$(this).attr('id');

                $.get("/oficios/mostrar/"+idof,function (request) {
                    $("#contenedor_mostrar").html(request);
                    $("#modal_mostrar").modal('show');
                });
            });


        });
    </script>
</div>
@endsection