@extends('layouts.panel')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('title', 'Historial oficios autorizados')
@section('content')

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-5/12 tw:lg:ml-[33.3333%] tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                        <h1 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">HISTORIAL  DE OFICIOS AUTORIZADOS</h1>
                    </div>
                </div>
            </div>
        </div>


        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
<table id="table_enviado1" class="table-responsive tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>
                        <th class="tw:text-center">No.</th>
                        <th class="tw:text-center">Nombre del solicitante</th>
                        <th class="tw:text-center">Fecha de la solicitud del oficio</th>
                        <th class="tw:text-center">Fecha de la incidencia</th>
                        <th class="tw:text-center">Artículo</th>
                        <th class="tw:text-center">Ver oficio completo </th>

                        <th class="tw:text-center">Oficio firmado, formato de incidencia y evidencia en un pdf</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i=1;
                    ?>
                    @foreach($historial_oficios as $oficio)
                        <tr>
                            <td>{{ $i++}}</td>
                            <td>{{ $oficio->nombre }}</td>
                            <?php  $fecha_solicitud=date_format(new DateTime($oficio->fecha_solicitud), 'd-m-Y H:i:s');?>
                            <td>{{$fecha_solicitud}}</td>
                            @if($oficio->id_articulo == 2  || $oficio->id_articulo == 11 || $oficio->id_articulo == 8)
                                <td>
                                    <?php
                                    $fecha_inicial= date('d-m-Y', strtotime($oficio->fecha_invac));
                                    $fecha_final= date('d-m-Y', strtotime($oficio->fecha_tervac));
                                    ?>
                                    <b>

                                        {{ $fecha_inicial }} al  {{ $fecha_final }}
                                    </b>
                                </td>
                            @else
                                <?php
                                $fecha_req= date('d-m-Y', strtotime($oficio->fecha_req));
                                ?>
                                <td>
                                    <b>{{ $fecha_req }}</b>
                                </td>
                            @endif
                            <td>{{ $oficio->nombre_articulo }}</td>
                            <th>
                                <button class="edita2 tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" id="{{ $oficio->id_solicitud }}"><i class="fa fa-list"></i></button>
                            </th>

                            @if($oficio->arch_solicitud == "")
                                <td>No ha subido oficio</td>
                            @else
                                <td>
                                    <a  target="_blank" href="/incidencias_oficios/{{$oficio->arch_solicitud}}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"> <i class="fa em128 fa-book" title="Ver PDF"> </i> Ver PDF</a>
                                </td>
                            @endif

                        </tr>


                    @endforeach
                    </tbody>
                </table>
</div>
            </div>
        </div>
        <div class="modal fade tw-modal-compat" id="modal_mostrar2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header tw:bg-sky-100">
                        <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title tw:text-center" id="myModalLabel">Oficio de Incidencia</h4>
                    </div>
                    <div class="modal-body">
                        <div id="contenedor_mostrar2">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

    <script type="text/javascript">
        $(document).ready(function() {
            //id de la tabla                 //class de boton

            $('#table_enviado1').DataTable( {

            } );
            $("#table_enviado1").on('click','.edita2',function(){
                //TNotify.alert("HOLA");
                var soli=$(this).attr('id');
                // TNotify.alert(soli);
                //url de web
                $.get("/oficios/ver/"+soli,function (request) {
                    //contenido del modal
                    $("#contenedor_mostrar2").html(request);
                    //id del modal
                    $("#modal_mostrar2").modal('show');
                });
            });
            $('#table_enviado2').DataTable( {

            } );
        });
    </script>

@endsection