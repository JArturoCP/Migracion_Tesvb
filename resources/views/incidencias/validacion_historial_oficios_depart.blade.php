@extends('layouts.app')
@section('title', 'Historial de registro de oficios de departamentos')
@section('content')

    <main class="col-md-12">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <ul class="nav nav-tabs">
                    <li class="active" ><a href="#">Historial de oficios recibidos por los departamentos</a>
                    </li>
                    <li  > <a href="{{url('/incidencias/validar_oficios_dep_acad_finanzas')}}">Oficios recibidos para validación de los departamentos</a></li>
                </ul>
                <br>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table id="table_enviado1" class="table table-bordered table-resposive">
                    <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Nombre del solicitante</th>
                        <th class="text-center">Fecha de la solicitud del oficio</th>
                        <th class="text-center">Fecha de la incidencia</th>
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
                            <?php  $fecha_solicitud=date_format(new DateTime($solicitud->fecha_solicitud), 'd-m-Y H:i:s');?>
                            <td>{{$fecha_solicitud}}</td>
                            @if($solicitud->id_articulo == 2  )
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
                                @if($solicitud->id_estado_solicitud == 4)
                                    <p>Enviado a dirección</p>
                                @else
                                    <p>Aceptado</p>
                                @endif
                            </th>
                            <th>
                                @if($solicitud->id_estado_solicitud == 2)
                                    @if( $solicitud->direc_finanzas !=0)
                                        <p>Imprime jefe de departamento o jefe de división</p>
                                    @else

                                        @if($solicitud->id_articulo==1 || $solicitud->id_articulo==9)
                                            <button type="button" class="btn btn-primary center" onclick="window.open('{{url('pdfregistroincidencia',['id_solicitud'=>$solicitud->id_solicitud])}}')">Imprimir oficio</button>
                                        @endif
                                        @if($solicitud->id_articulo==2 || $solicitud->id_articulo==4 || $solicitud->id_articulo==5 ||$solicitud->id_articulo==6  || $solicitud->id_articulo==7 || $solicitud->id_articulo==8 || $solicitud->id_articulo==10 || $solicitud->id_articulo==11)
                                            <button type="button" class="btn btn-primary center" onclick="window.open('{{url('pdfregistroincidencia1',['id_solicitud'=>$solicitud->id_solicitud])}}')">Imprimir oficios</button>
                                        @endif
                                        <p><br><button type="button" class="btn btn-primary center" onclick="window.open('{{url('/incidencias/imprimir_aviso_justificacion/'.$solicitud->id_solicitud)}}')">Imprimir aviso</button>
                                        </p>

                                    @endif
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