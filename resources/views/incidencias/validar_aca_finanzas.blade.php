@extends('layouts.app')
@section('title', 'Incidencias')
@section('content')

    <main class="col-md-12">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <ul class="nav nav-tabs">
                    <li>
                        <a href="{{url('/incidencias/validar_oficios_departamentos/historial')}}">Historial de oficios recibidos por los departamentos</a>
                    </li>
                    <li class="active" ><a href="#">Oficios recibidos para validación de los departamentos</a></li>
                </ul>

            </div>
        </div>
        <div class="row">
            <p><br></p>
        </div>
        <div class="row">
            <div class="col-md-5 col-md-offset-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">VALIDAR OFICIOS DE INCIDENCIAS DE LOS DEPARTAMENTOS</h3>
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
                        <th class="text-center">Nombre del solicitante</th>
                        <th class="text-center">Fecha de la solicitud del oficio</th>
                        <th class="text-center">Fecha de la incidencia</th>
                        <th class="text-center">Artículo</th>
                        <th class="text-center">Ver oficio</th>
                        <th class="text-center">Evaluar oficio</th>
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
                                @if($solicitud->id_articulo == 2 || $solicitud->id_articulo == 2)
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
                                    <button class="btn btn-primary edita2" id="{{ $solicitud->id_solicitud }}"><i class="glyphicon glyphicon-list"></i></button>
                                </th>

                                <th>
                                    @if($solicitud->id_articulo != 4 )
                                        <button type="button" class="btn btn-info btn-circle" onclick="window.location='{{ url('/incidencias/validacion_acad_finanzas/aceptado/'.$solicitud->id_solicitud) }}'" title="Autorizar"><i class="glyphicon glyphicon-ok"></i></button>
                                        <button type="button" class="btn btn-warning btn-circle" onclick="window.location='{{ url('/incidencias/validacion_acad_finanzas/rechazado/'. $solicitud->id_solicitud ) }}'" title="Rechazar"><i class="glyphicon glyphicon-remove"></i></button>
                                    @else
                                        <button type="button" class="btn btn-info btn-circle" onclick="window.location='{{ url('/incidencias/historial_docentesSo/oficio/enviar', $solicitud->id_solicitud ) }}'" title="Enviar a directora">Realizar solicitud</button>
                                    @endif
                                </th>
                            </tr>
                    @endif
                    @endforeach
                    <tbody>
                </table>


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
    </main>
    <script type="text/javascript">
        $(document).ready(function() {
            //id de la tabla                 //class de boton
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
            $('#table_enviado2').DataTable( {

            } );
        });
    </script>

@endsection