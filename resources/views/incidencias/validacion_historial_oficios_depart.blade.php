@extends('layouts.panel')
@section('title', 'Historial de registro de oficios de departamentos')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Historial de registro de oficios de departamentos" :migas="['Incidencias' => null]" />

    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800">
                    <li class="active" ><a href="#">Historial de oficios recibidos por los departamentos</a>
                    </li>
                    <li  > <a href="{{url('/incidencias/validar_oficios_dep_acad_finanzas')}}">Oficios recibidos para validación de los departamentos</a></li>
                </ul>
            </div>
        </div>

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_enviado1" class="tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>
                        <th class="tw:text-center">No.</th>
                        <th class="tw:text-center">Nombre del solicitante</th>
                        <th class="tw:text-center">Fecha de la solicitud del oficio</th>
                        <th class="tw:text-center">Fecha de la incidencia</th>
                        <th class="tw:text-center">Artículo</th>
                        <th class="tw:text-center">Estatus</th>
                        <th class="tw:text-center">Oficio</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; ?>
                    @foreach($solicitudes as $solicitud)
                        <tr>
                            <th>{{$i++}}</th>
                            <th>{{$solicitud->nombre}}</th>
                            <?php  $fecha_solicitud=date_format(new DateTime($solicitud->fecha_solicitud), 'd-m-Y H:i:s');?>
                            <td>{{$fecha_solicitud}}</td>
                            @if($solicitud->id_articulo == 2  )
                                <td>
                                    <?php
                                    $fecha_inicial= date('d-m-Y', strtotime($solicitud->fecha_invac));
                                    $fecha_final= date('d-m-Y', strtotime($solicitud->fecha_tervac));
                                    ?>
                                    <b>

                                        {{ $fecha_inicial }} al  {{ $fecha_final }}
                                    </b>
                                </td>
                            @else
                                <?php
                                $fecha_req= date('d-m-Y', strtotime($solicitud->fecha_req));
                                ?>
                                <td>
                                    <b>{{ $fecha_req }}</b>
                                </td>
                            @endif
                            <th>{{$solicitud->nombre_articulo}}</th>
                            <th>
                                @if($solicitud->id_estado_solicitud == 4)
                                    <p>Enviado a dirección</p>
                                @else
                                    <p>Aceptado</p>
                                @endif
                            </th>
                            <th>
                                @if($solicitud->id_estado_solicitud == 2)
                                    @if( $solicitud->direc_finanzas !=0)
                                        <p>Imprime jefe de departamento o jefe de división</p>
                                    @else

                                        @if($solicitud->id_articulo==1 || $solicitud->id_articulo==9)
                                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{url('pdfregistroincidencia',['id_solicitud'=>$solicitud->id_solicitud])}}')">Imprimir oficio</button>
                                        @endif
                                        @if($solicitud->id_articulo==2 || $solicitud->id_articulo==4 || $solicitud->id_articulo==5 ||$solicitud->id_articulo==6  || $solicitud->id_articulo==7 || $solicitud->id_articulo==8 || $solicitud->id_articulo==10 || $solicitud->id_articulo==11)
                                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{url('pdfregistroincidencia1',['id_solicitud'=>$solicitud->id_solicitud])}}')">Imprimir oficios</button>
                                        @endif
                                        <p><br><button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{url('/incidencias/imprimir_aviso_justificacion/'.$solicitud->id_solicitud)}}')">Imprimir aviso</button>
                                        </p>

                                    @endif
                                @else
                                    <p>En proceso</p>
                                @endif
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
</div>
            </div>
        </div>
        <x-panel.modal id="modal_mostrar1" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Oficio de Incidencia</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <div id="contenedor_mostrar1">
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                    </div>
                </x-panel.modal>
    </main>
    <script type="text/javascript">
        $(document).ready(function() {
            //id de la tabla                 //class de boton
            $("#table_enviado1").on('click','.edita1',function(){
                //TNotify.alert("HOLA");
                var solicitud=$(this).attr('id');
                //TNotify.alert(solicitud);
                //url de web
                $.get("/oficios/ver/"+solicitud,function (request) {
                    //contenido del modal
                    $("#contenedor_mostrar1").html(request);
                    //id del modal
                    $("#modal_mostrar1").modal('show');
                });
            });
            $('#table_enviado1').DataTable( {

            } );
        });
    </script>
</div>
@endsection