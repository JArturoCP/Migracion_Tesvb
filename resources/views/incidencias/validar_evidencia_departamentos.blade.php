@extends('layouts.panel')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('title', 'Incidencias')
@section('content')

    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-5/12 tw:lg:ml-[33.3333%] tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                        <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">VALIDACIÓN DE EVIDENCIAS DE CONOCIMIENTO</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
<table id="tabla_historial_docentes" class="table-responsive tw-tabla tw-tabla-bordes" align="center">
                    <thead >
                    <th class="tw:text-center">No.</th>
                    <th>Nombre del solicitante</th>
                    <th class="tw:text-center">Evidencia aplicada</th>
                    <th class="tw:text-center">Fecha de la incidencia</th>
                    <th class="tw:text-center">Fecha y hora de envio</th>
                    <th class="tw:text-center">Ver evidencia</th>
                    <th class="tw:text-center">Validación</th>

                    </thead>
                    <tbody>
                    <?php $i=1; ?>
                    @foreach ($histEvi as $evidhist)
                        <tr>
                            <td>{{ $i++ }} </td>
                            <td>{{$evidhist->nombre}}</td>
                            <td>{{$evidhist->nombre_evidencia}} <br>
                                @if($evidhist->id_tipo_evid == 1 || $evidhist->id_tipo_evid == 3 ||  $evidhist->id_tipo_evid == 5  ||  $evidhist->id_tipo_evid == 6)
                                 <b>Folio: {{ $evidhist->no_folio }} </b>
                                @endif

                            </td>
                            @if($evidhist->no_fecha == 1)
                            <?php
                            $fecha_solicita= date('d-m-Y', strtotime($evidhist->fecha_solicita));
                            ?>
                            <td>
                                {{$fecha_solicita}}
                            </td>
                            @else
                                <?php
                                $fecha_solicita= date('d-m-Y', strtotime($evidhist->fecha_solicita));
                                $fecha_solicita_2= date('d-m-Y', strtotime($evidhist->fecha_solicita_2));
                                ?>
                                <td>
                                    {{$fecha_solicita}} al {{ $fecha_solicita_2 }}
                                </td>

                            @endif
                            <?php  $fecha_envio=date_format(new DateTime($evidhist->fecha_envio), 'd-m-Y H:i:s');?>
                            <td>{{$fecha_envio}}</td>
                            <th>
                                <a  target="_blank" href="/incidencias/{{$evidhist->arch_evidencia}}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"> <i class="fa em128 fa-book" title="Ver PDF"> </i> Ver evidencia </a>
                            </th>
                            <th>
                                <button type="button" class="btn-circle tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-sky-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-sky-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" onclick="window.location='{{ url('/incidencias/validar_evid_autorizar/'. $evidhist->id_evid) }}'" title="Autorizar"><i class="fa fa-check"></i></button>
                                <button type="button" class="btn-circle tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" onclick="window.location='{{ url('/incidencias/validar_evid_rechazar/'.$evidhist->id_evid ) }}'" title="Rechazar"><i class="fa fa-times"></i></button>

                            </th>

                        </tr>
                    @endforeach
                    <tbody>
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
    </main>
    <script type="text/javascript">
        $(document).ready(function() {
            //id de la tabla                 //class de boton
            $("#table_enviado2").on('click','.edita2',function(){
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