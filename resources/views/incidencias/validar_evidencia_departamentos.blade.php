@extends('layouts.panel')
@section('title', 'Incidencias')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado titulo="Validación de evidencias de conocimiento" :migas="['Incidencias' => null]" />
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="tabla_historial_docentes" class="tw-tabla tw-tabla-bordes" align="center">
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
                                <a  target="_blank" href="/incidencias/{{$evidhist->arch_evidencia}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap"> <i class="fa fa-book em128" title="Ver PDF"> </i> Ver evidencia </a>
                            </th>
                            <th>
                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" onclick="window.location='{{ url('/incidencias/validar_evid_autorizar/'. $evidhist->id_evid) }}'" title="Autorizar"><i class="fa fa-check"></i></button>
                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:size-9 tw:text-base" onclick="window.location='{{ url('/incidencias/validar_evid_rechazar/'.$evidhist->id_evid ) }}'" title="Rechazar"><i class="fa fa-times"></i></button>

                            </th>

                        </tr>
                    @endforeach
                    <tbody>
                </table>
</div>
            </div>
        </div>
        <x-panel.modal id="modal_mostrar2" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Oficio de Incidencia</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <div id="contenedor_mostrar2">
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

</div>
@endsection