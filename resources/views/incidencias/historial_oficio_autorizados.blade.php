@extends('layouts.app')
@section('title', 'Historial oficios autorizados')
@section('content')

        <div class="row">
            <div class="col-md-5 col-md-offset-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h1 class="panel-title text-center">HISTORIAL  DE OFICIOS AUTORIZADOS</h1>
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
                        <th class="text-center">Fecha de la solicitud del oficio</th>
                        <th class="text-center">Fecha de la incidencia</th>
                        <th class="text-center">Artículo</th>
                        <th class="text-center">Ver oficio completo </th>

                        <th class="text-center">Oficio firmado, formato de incidencia y evidencia en un pdf</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i=1;
                    ?>
                    @foreach($historial_oficios as $oficio)
                        <tr>
                            <td>{{ $i++}}</td>
                            <td>{{ $oficio->nombre }}</td>
                            <?php  $fecha_solicitud=date_format(new DateTime($oficio->fecha_solicitud), 'd-m-Y H:i:s');?>
                            <td>{{$fecha_solicitud}}</td>
                            @if($oficio->id_articulo == 2  || $oficio->id_articulo == 11 || $oficio->id_articulo == 8)
                                <td>
                                    <?php
                                    $fecha_inicial= date('d-m-Y', strtotime($oficio->fecha_invac));
                                    $fecha_final= date('d-m-Y', strtotime($oficio->fecha_tervac));
                                    ?>
                                    <b>

                                        {{ $fecha_inicial }} al  {{ $fecha_final }}
                                    </b>
                                </td>
                            @else
                                <?php
                                $fecha_req= date('d-m-Y', strtotime($oficio->fecha_req));
                                ?>
                                <td>
                                    <b>{{ $fecha_req }}</b>
                                </td>
                            @endif
                            <td>{{ $oficio->nombre_articulo }}</td>
                            <th>
                                <button class="btn btn-primary edita2" id="{{ $oficio->id_solicitud }}"><i class="glyphicon glyphicon-list"></i></button>
                            </th>

                            @if($oficio->arch_solicitud == "")
                                <td>No ha subido oficio</td>
                            @else
                                <td>
                                    <a  target="_blank" href="/incidencias_oficios/{{$oficio->arch_solicitud}}" class="btn btn-success"> <i class=" glyphicon glyphicon-book em128" title="Ver PDF"> </i> Ver PDF</a>
                                </td>
                            @endif

                        </tr>


                    @endforeach
                    </tbody>
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

    <script type="text/javascript">
        $(document).ready(function() {
            //id de la tabla                 //class de boton

            $('#table_enviado1').DataTable( {

            } );
            $("#table_enviado1").on('click','.edita2',function(){
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