@extends('layouts.panel')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('title','Incidencias')
@section('content')

<main class="tw:w-full tw:lg:w-full tw:px-2">
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                    <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">HISTORIAL DE OFICIOS</h3>
                </div>
            </div>  
        </div>
    </div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                
                <div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
<table id="table_enviado2" class="table-responsive tw-tabla tw-tabla-bordes">
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
                                            <button class="edita2 tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" id="{{ $hist->id_solicitud }}"><i class="fa fa-list"></i></button>
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
                                            <td style="">Autorizado <br>
                                            @elseif($hist->id_estado_solicitud==2 && $hist->id_articulo == 4 )
                                                <td style="">Autorizado por direccion<br>

                                            </td>
                                            @elseif($hist->id_estado_solicitud==4)
                                            <td>Enviado a dirección</td>
                                            <td>En proceso</td>
                                            @endif
                                            
                                        @if($hist->id_estado_solicitud==2)
                                            <td style="">
                                                @if($hist->arch_solicitud=="")
                                                    <a class="agregar_oficio tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-id="{{ $hist->id_solicitud }}">Agregar</a>
                                               {{--
                                               <a class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" href="{{url('incidencias/cargar_oficio',$hist->id_solicitud)}}">Agregar oficio</a>
                                                --}}
                                                @else
                                                <a  target="_blank" href="/incidencias_oficios/{{$hist->arch_solicitud}}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Ver PDF </a>
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
                                            <td style="color: #942a25">Rechazado</td>
                                            <td style="color: #942a25">Rechazado</td>
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
    <div class="modal fade tw-modal-compat" id="modal_agregar_evidencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-panel-modal hidden>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Evidencia</h4>
                </div>
                <div class="modal-body">
                    <div id="contenedor_agregar_evidencia">

                    </div>
                </div>


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


    {{--Modal agregar  oficio firmado--}}
    <div class="modal fade tw-modal-compat" id="modal_agregar_oficio_firmado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-panel-modal hidden>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Agregar oficio firmado, formato de incidencia y evidencia en un pdf</h4>
                </div>
                <div class="modal-body">
                    <div id="contenedor_agregar_oficio_firmado">

                    </div>
                </div>


            </div>
        </div>
    </div>
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


@endsection
