@extends('layouts.panel')
@section('title', 'Incidencias')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    
<main class="tw:w-full tw:lg:w-full tw:px-2">
          <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800">
                    <li>
                        <a href="{{url('/incidencias/validar_oficios/historial')}}">Historial de oficios recibidos</a>
                    </li>
                    <li class="active" ><a href="#">Oficios recibidos para validación</a></li>
               </ul>
                
            </div>
        </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <p class="tw:w-full"><br></p>
    </div>
<x-panel.encabezado titulo="Validar oficios de incidencias de los departamentos" :migas="['Incidencias' => null]" />
  <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
                
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_enviado2" class="tw-tabla tw-tabla-bordes">
                  <thead>
                    <tr>
                        <th class="tw:text-center">No.</th>
                        <th class="tw:text-center">Nombre del solicitante</th>
                        <th class="tw:text-center">Fecha de la solicitud del oficio</th>
                        <th class="tw:text-center">Fecha de la incidencia</th>
                        <th class="tw:text-center">Artículo</th>
                        <th class="tw:text-center">Ver oficio</th>
                        <th class="tw:text-center">Evaluar oficio</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; ?>
                    @foreach($solicitudes as $solicitud)

                        @if($solicitud->id_estado_solicitud==1 && $solicitud->directora == null)
                        <tr>
                          <th>{{$i++}} </th>
                          <th>{{$solicitud->nombre}}</th>
                            <?php  $fecha_solicitud=date_format(new DateTime($solicitud->fecha_solicitud), 'd-m-Y H:i:s');?>
                            <td>{{$fecha_solicitud}}</td>
                            @if($solicitud->id_articulo == 2 || $solicitud->id_articulo == 11 || $solicitud->id_articulo == 8)
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
                            <button class="edita2 tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{ $solicitud->id_solicitud }}"><i class="fa fa-list"></i></button>
                          </th>
                            
                          <th>
                              @if($solicitud->id_articulo != 4 )
                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" onclick="window.location='{{ url('/incidencias/historial_docentesSo/oficio/aceptado', $solicitud->id_solicitud) }}'" title="Autorizar"><i class="fa fa-check"></i></button>
                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:size-9 tw:text-base" onclick="window.location='{{ url('/incidencias/historial_docentesSo/oficio/rechazado', $solicitud->id_solicitud ) }}'" title="Rechazar"><i class="fa fa-times"></i></button>
                              @else 
                                  <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-sky-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-sky-600 tw:gap-1 tw:px-2 tw:py-1 tw:text-xs" onclick="window.location='{{ url('/incidencias/historial_docentesSo/oficio/enviar', $solicitud->id_solicitud ) }}'" title="Enviar a directora">Realizar solicitud</button> 
                              @endif
                            </th>
                        </tr>
                        @endif
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