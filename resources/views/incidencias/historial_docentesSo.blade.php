@extends('layouts.panel')
@section('title','Incidencias')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

<main class="tw:w-full tw:lg:w-full tw:px-2">
    <x-panel.encabezado titulo="Historial de oficios" :migas="['Incidencias' => null]" />
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
                
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_enviado2" class="tw-tabla tw-tabla-bordes">
                  <thead>
                    <tr>
                                    <th class="tw:text-center">No.</th> 
                                    <th class="tw:text-center">Artículo aplicado</th>
                                    <th class="tw:text-center">Motivo de oficio</th>
                                    <th class="tw:text-center">Fecha de la solicitud del oficio</th>
                                    <th class="tw:text-center">Fecha de la incidencia</th>
                                    <th class="tw:text-center">Ver oficio completo</th>
                                    <th class="tw:text-center">Jefe(a) a autorizar</th>
                                    <th class="tw:text-center">Estado de oficio</th>
                                    <th class="tw:text-center">Agregar oficio firmado, formato de incidencia y evidencia en un pdf</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; ?>
                            @foreach ($histSol as $hist)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$hist->nombre_articulo}}</td>
                                        <td>{{$hist->motivo_oficio}}</td>
                                        <?php  $fecha_solicitud=date_format(new DateTime($hist->fecha_solicitud), 'd-m-Y H:i:s');?>
                                        <td>{{$fecha_solicitud}}</td>
                                        @if($hist->id_articulo == 2  || $hist->id_articulo == 11 || $hist->id_articulo == 8)
                                            <td>
                                                <?php
                                               $fecha_inicial= date('d-m-Y', strtotime($hist->fecha_invac));
                                                $fecha_final= date('d-m-Y', strtotime($hist->fecha_tervac));
                                                ?>
                                                <b>

                                                {{ $fecha_inicial }} al  {{ $fecha_final }}
                                                </b>
                                            </td>
                                            @else
                                           <?php
                                            $fecha_req= date('d-m-Y', strtotime($hist->fecha_req));
                                            ?>
                                                <td>
                                                    <b>{{ $fecha_req }}</b>
                                                </td>
                                        @endif
                                        <th>
                                            <button class="edita2 tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{ $hist->id_solicitud }}"><i class="fa fa-list"></i></button>
                                        </th>
                                        @if($hist->id_articulo == 7)
                                            <td>{{ $jefe_a_d->titulo }} {{ $jefe_a_d->nombre }}</td>
                                            @elseif($hist->id_articulo == 4 &&  $hist->id_solicitud ==1  )
                                            <td>{{ $hist->titulo }} {{ $hist->nombre }}</td>
                                            @elseif($hist->id_articulo == 4 &&  $hist->id_solicitud !=1 )
                                            <td>{{ $director->titulo }} {{ $director->nombre }}</td>
                                            @else
                                        <td>{{ $hist->titulo }} {{ $hist->nombre }}</td>
                                        @endif
                                        @if($hist->id_estado_solicitud==1)
                                            <td>Enviado</td>
                                            <td>En proceso</td>
                                        @endif
                                        
                                             
                                            @if($hist->id_estado_solicitud==2 && $hist->id_articulo != 4)
                                            <td>Autorizado <br>
                                            @elseif($hist->id_estado_solicitud==2 && $hist->id_articulo == 4 )
                                                <td>Autorizado por direccion<br>

                                            </td>
                                            @elseif($hist->id_estado_solicitud==4)
                                            <td>Enviado a dirección</td>
                                            <td>En proceso</td>
                                            @endif
                                            
                                        @if($hist->id_estado_solicitud==2)
                                            <td>
                                                @if($hist->arch_solicitud=="")
                                                    <a class="agregar_oficio tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-id="{{ $hist->id_solicitud }}">Agregar</a>
                                               {{--
                                               <a class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" href="{{url('incidencias/cargar_oficio',$hist->id_solicitud)}}">Agregar oficio</a>
                                                --}}
                                                @else
                                                <a  target="_blank" href="/incidencias_oficios/{{$hist->arch_solicitud}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Ver PDF </a>
                                                @endif
                                                {{--
                                                    @if($hist->arch_evidencia == null)
                                                        <a class="agregar_evidencia tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"   data-id="{{ $hist->id_solicitud }}" >Agregar evidencia</a>
                                                    @else
                                                        <a  target="_blank" href="/incidencias/{{ $hist->arch_evidencia }}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Ver evidencia </a>

                                                    @endif
                                                    --}}
                                            </td>
                                        @endif
                                        @if($hist->id_estado_solicitud==3)
                                            <td class="tw:text-red-800 tw:dark:text-red-400" >Rechazado</td>
                                            <td class="tw:text-red-800 tw:dark:text-red-400" >Rechazado</td>
                                        @endif 
                                        @if(!in_array($hist->id_estado_solicitud, [1, 2, 3, 4]))
                                            {{-- Estado no contemplado: mantener las 9 columnas para que DataTables no falle --}}
                                            <td>Sin estado</td>
                                            <td></td>
                                        @endif
                                    </tr>

                                @endforeach
                  </tbody>
                </table>
</div>
        </div>
    </div>
    {{--Modal agregar  evidencia--}}
    <x-panel.modal id="modal_agregar_evidencia" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Evidencia</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_agregar_evidencia">

                    </div>
                </div>


            </x-panel.modal>

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


    {{--Modal agregar  oficio firmado--}}
    <x-panel.modal id="modal_agregar_oficio_firmado" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar oficio firmado, formato de incidencia y evidencia en un pdf</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_agregar_oficio_firmado">

                    </div>
                </div>


            </x-panel.modal>
    <script type="text/javascript">
  $(document).ready(function() { 
    $('#table_enviado2').DataTable( {
        order: [[3, 'desc']]
    } );

      $("#table_enviado2").on('click','.agregar_evidencia',function(){
          var id_solicitud=$(this).data("id");

          $.get("/incidencias/ver_solicitud_incidencia/"+id_solicitud,function(request){
              $("#contenedor_agregar_evidencia").html(request);
              $("#modal_agregar_evidencia").modal('show');
          });
      });
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
      $("#table_enviado2").on('click','.agregar_oficio',function (){
          var id_solicitud=$(this).data("id");
          $.get("/incidencias/agregar_oficio_firmado/"+id_solicitud,function(request){
              $("#contenedor_agregar_oficio_firmado").html(request);
              $("#modal_agregar_oficio_firmado").modal('show');
          });


      });
});
</script>
</main>


</div>
@endsection
