@extends('layouts.app')
@section('title', 'Incidencias')
@section('content')

    <main class="col-md-12">
        <div class="row">
            <div class="col-md-5 col-md-offset-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">VALIDACIÓN DE EVIDENCIAS DE CONOCIMIENTO</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table id="tabla_historial_docentes" class="table table-bordered table-resposive" align="center">
                    <thead >
                    <th class="text-center">No.</th>
                    <th>Nombre del solicitante</th>
                    <th class="text-center">Evidencia aplicada</th>
                    <th class="text-center">Fecha de la incidencia</th>
                    <th class="text-center">Fecha y hora de envio</th>
                    <th class="text-center">Ver evidencia</th>
                    <th class="text-center">Validación</th>

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
                                <a  target="_blank" href="/incidencias/{{$evidhist->arch_evidencia}}" class="btn btn-primary"> <i class=" glyphicon glyphicon-book em128" title="Ver PDF"> </i> Ver evidencia </a>
                            </th>
                            <th>
                                <button type="button" class="btn btn-info btn-circle" onclick="window.location='{{ url('/incidencias/validar_evid_autorizar/'. $evidhist->id_evid) }}'" title="Autorizar"><i class="glyphicon glyphicon-ok"></i></button>
                                <button type="button" class="btn btn-warning btn-circle" onclick="window.location='{{ url('/incidencias/validar_evid_rechazar/'.$evidhist->id_evid ) }}'" title="Rechazar"><i class="glyphicon glyphicon-remove"></i></button>

                            </th>

                        </tr>
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