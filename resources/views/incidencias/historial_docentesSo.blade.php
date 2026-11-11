@extends('layouts.app')
@section('title','Incidencias')
@section('content')

<main class="col-md-12">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">HISTORIAL DE OFICIOS</h3>
                </div>
            </div>  
        </div>
    </div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
                
                <table id="table_enviado2" class="table table-bordered table-resposive">
                  <thead>
                    <tr>
                                    <th class="text-center">No.</th> 
                                    <th class="text-center">Artículo aplicado</th>
                                    <th class="text-center">Motivo de oficio</th>
                                    <th class="text-center">Fecha de la solicitud del oficio</th>
                                    <th class="text-center">Fecha de la incidencia</th>
                                    <th class="text-center">Ver oficio completo</th>
                                    <th class="text-center">Jefe(a) a autorizar</th>
                                    <th class="text-center">Estado de oficio</th>
                                    <th class="text-center">Agregar oficio firmado, formato de incidencia y evidencia en un pdf</th>
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
                                            <button class="btn btn-primary edita2" id="{{ $hist->id_solicitud }}"><i class="glyphicon glyphicon-list"></i></button>
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
                                                    <a class="btn btn-primary agregar_oficio" data-id="{{ $hist->id_solicitud }}">Agregar</a>
                                               {{--
                                               <a class="btn btn-primary" href="{{url('incidencias/cargar_oficio',$hist->id_solicitud)}}">Agregar oficio</a>
                                                --}}
                                                @else
                                                <a  target="_blank" href="/incidencias_oficios/{{$hist->arch_solicitud}}" class="btn btn-success">Ver PDF </a>
                                                @endif
                                                {{--
                                                    @if($hist->arch_evidencia == null)
                                                        <a class="btn btn-primary agregar_evidencia"   data-id="{{ $hist->id_solicitud }}" >Agregar evidencia</a>
                                                    @else
                                                        <a  target="_blank" href="/incidencias/{{ $hist->arch_evidencia }}" class="btn btn-success">Ver evidencia </a>

                                                    @endif
                                                    --}}
                                            </td>
                                        @endif
                                        @if($hist->id_estado_solicitud==3)
                                            <td style="color: #942a25">Rechazado</td>
                                            <td style="color: #942a25">Rechazado</td>
                                        @endif 
                                    </tr>

                                @endforeach
                  <tbody>
                </table>
        </div>
    </div>
    {{--Modal agregar  evidencia--}}
    <div class="modal fade" id="modal_agregar_evidencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Evidencia</h4>
                </div>
                <div class="modal-body">
                    <div id="contenedor_agregar_evidencia">

                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_mostrar2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Oficio de Incidencia</h4>
                </div>
                <div class="modal-body">
                    <div id="contenedor_mostrar2">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    {{--Modal agregar  oficio firmado--}}
    <div class="modal fade" id="modal_agregar_oficio_firmado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
          //alert("HOLA");
          var soli=$(this).attr('id');
          // alert(soli);
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
