@extends('layouts.app')
@section('title', 'Registro de Oficios enviados')
@section('content')
    <style type="text/css">

        .btn-circle {

            width: 25px;
            height: 25px;
            text-align: center;
            padding: 3px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px ;
        }
    </style>
    <main class="col-md-12">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <ul class="nav nav-tabs">
                    <li class="active" ><a href="#">Historial de oficios recibidos</a>
                    </li>
                    <li  > <a href="{{url('/incidencias/validar_oficios_departamentos')}}">Oficios recibidos para validación</a></li>
                </ul>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 col-md-offset-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">HISTORIAL DE OFICIOS DE INCIDENCIAS DE LOS DEPARTAMENTOS DEL TESVB</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table id="table_enviado1" class="table table-bordered table-resposive">
                    <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Nombre del solicitante</th>
                        <th class="text-center">Fecha de oficio</th>
                        <th class="text-center">Artículo</th>
                        <th class="text-center">Estatus</th>
                        <th class="text-center">Oficio</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; ?>
                    @foreach($solicitudes as $solicitud)
                                <tr>
                                    <th>{{$i++}}</th>
                                    <th>{{$solicitud->nombre}}</th>
                                    <th>{{$solicitud->fecha_req}}</th>
                                    <th>{{$solicitud->nombre_articulo}}</th>
                                <!-- <button class="btn btn-primary edita1" id="{{ $solicitud->id_solicitud }}"><i class="glyphicon glyphicon-list"></i></button>-->
                                    <th>
                                        @if($solicitud->id_estado_solicitud == 4)
                                            <p>Enviado a direccion</p>
                                        @else
                                            <p>Aceptado</p>
                                        @endif
                                    </th>
                                    <th>
                                        @if($solicitud->id_estado_solicitud == 2)
                                            <p>Imprime jefe de departamento o jefe de división</p>
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
        <div class="modal fade" id="modal_mostrar1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Oficio de Incidencia</h4>
                    </div>
                    <div class="modal-body">
                        <div id="contenedor_mostrar1">
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
            $("#table_enviado1").on('click','.edita1',function(){
                //alert("HOLA");
                var solicitud=$(this).attr('id');
                //alert(solicitud);
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
@endsection