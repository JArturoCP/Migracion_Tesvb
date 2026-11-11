@extends('layouts.app')
@section('title','Incidencias')
@section('content')

<main class="col-md-12">
            <div class="row"> 
                <div class="col-md-5 col-md-offset-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">Evidencia a subir</h3>
                        </div>
                    </div>  
                </div>
            </div>
    <div class="row">
        <div class="col-md-2 col-md-offset-2">
            <div class="alert alert-success">
                <strong>Nota: </strong> Puedes agregar otro tipo de evidencia si así se requiere.
            </div>
        </div>

        <div class="col-md-1 ">
            <a class="btn btn-success" href="{{url('incidencias/cargar_otra_evidencia')}}">Agregar</a>
        </div>
    </div>

    <div class="row">
            <div class="col-md-8 col-md-offset-2">       
                <table id="tabla_envio" class="table table-bordered table-resposive">
                    <thead>
                     <tr>
                         <th class="text-center"> Artículo que requiere evidencia</th>
                         <th class="text-center">Motivo de oficio</th>
                         <th class="text-center">Fecha requerida</th>
                         <th class="text-center">Fecha ultima para subir la evidencia</th>
                         <th class="text-center">Agregar evidencia</th>
                     </tr>
                    </thead>
                    <tbody>
                        @foreach($eviden as $evidArt)

                     <tr>
                                        @if($evidArt->arch_evidencia == null)

                                                                            @if($evidArt->id_estado_solicitud==2)
                                                                              <?php
                                        $date_now = $evidArt->fecha_req;
                                        $date_future = strtotime('+5 days', strtotime($date_now));
                                        $date_future = date('Y-m-d', $date_future);
                                                                              ?>
                                        <th>{{$evidArt->nombre_articulo}}</th>
                                                                                  <th>{{ $evidArt->motivo_oficio }}</th>
                                        <th>{{$evidArt->fecha_req}}</th>
                                        <th> {{$date_future}}</th>
                                        <th>
                                            @if($evidArt->arch_evidencia==null)
                                                @if( $fechaact>=$evidArt->fecha_req  && $fechaact<= $date_future)
                                                    <button class="btn btn-success agregar" id="{{ $evidArt->id_evid }}">Agregar</button>
                                                  {{--  <a class="btn btn-success" href="{{url('incidencias/cargar_evidencia',$evidArt->id_evid)}}">Agregar</a>--}}
                                                @elseif($fechaact> $date_future)
                                                        <p>Has olvidado subir tu evidencia</p>
                                                    @else
                                                    <p>Podras subir tu evidencia el dia requerido hasta 5 dias habiles despues</p>
                                                @endif

                                            @else
                                            <a  target="_blank" href="/incidencias/{{$evidArt->arch_evidencia}}" class="btn btn-primary">Ver evidencia </a>
                                            @endif
                                        </th>
                                    @endif
                                
                                @endif
                     </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


  </main>

<form id="form_registrar" action="{{url("/incidencias/cargando_evidencia_oficio")}}" role="form" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal fade bs-example-modal-lg" id="modal_agregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Agregar evidencia</h4>
                </div>
                <div class="modal-body">
                    <div id="contenedor_agregar">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info" >Aceptar</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">

    $(document).ready( function() {
        $(".agregar").click(function (){
            var id_evid=$(this).attr('id');

            $.get("/incidencias/ver_datos_oficio_evidencia/"+id_evid,function (request) {
                $("#contenedor_agregar").html(request);
                $("#modal_agregar").modal('show');
            });

        });

    });
</script>

@endsection