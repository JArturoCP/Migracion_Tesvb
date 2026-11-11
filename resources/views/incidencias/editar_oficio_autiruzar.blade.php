@extends('layouts.app')
@section('title', 'Incidencias')
@section('content')
    <main class="col-md-12">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h1 class="panel-title text-center">EDITAR OFICIO FIRMADO</h1>
                    </div>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-primary">
                        <div class="panel-body text-center">
                    <b>Articulo: </b><p>{{$solicitud->nombre_articulo}}</p>
                    <b>Motivo de oficio: </b><p>{{$solicitud->motivo_oficio}}</p>
                            <?php  $fecha_solicitud=date_format(new DateTime($solicitud->fecha_solicitud), 'd-m-Y H:i:s');?>
                            <b>Fecha de la solicitud del oficio: </b><p>{{$fecha_solicitud}}</p>
                            @if($solicitud->id_articulo==2 || $solicitud->id_articulo==8 || $solicitud->id_articulo==11)

                            @else
                                <?php
                                $fecha_req= date('d-m-Y', strtotime($solicitud->fecha_req));
                                ?>
                                <b>Fecha de la incidencia: </b><p>{{$fecha_req}}</p>
                            @endif

                            @if($solicitud->id_articulo==5)
                                <b>Hora entrada:</b><p>{{$solicitud->hora_e}}</p>
                                <b>Hora llegada tarde:</b><p>{{$solicitud->hora_st}}</p>
                            @endif
                            @if($solicitud->id_articulo==8 || $solicitud->id_articulo==2 || $solicitud->id_articulo==11)
                                <?php
                                $fecha_inicial= date('d-m-Y', strtotime($solicitud->fecha_invac));
                                $fecha_final= date('d-m-Y', strtotime($solicitud->fecha_tervac));
                                ?>
                                <b>Inician:</b><p>{{$fecha_inicial}}</p>
                                <b>Finalizan:</b><p>{{$fecha_final}}</p>
                            @endif
                            @if($solicitud->id_articulo==9 || $solicitud->id_articulo==10)
                                @if($solicitud->hora_e2 != "")

                                    <b>Hora entrada:</b><p>{{$solicitud->hora_e2}}</p>
                                    <b>Hora salida:</b><p>{{$solicitud->hora_s2}}</p>
                                @endif
                            @endif
                            @if($solicitud->id_articulo==9 || $solicitud->id_articulo==10)
                                @if($solicitud->hora_e1 != "")
                                    <b>Hora entrada:</b><p>{{$solicitud->hora_e1}}</p>
                                    <b>Hora salida:</b><p>{{$solicitud->hora_s1}}</p>
                                @endif
                            @endif
                            <br>
                            <div class="row">

                                    <a  target="_blank" href="/incidencias_oficios/{{$solicitud->arch_solicitud}}" class="btn btn-primary"> <i class=" glyphicon glyphicon-book em128" title="Ver PDF"> </i> Ver evidencia </a>
                                    <button id="{{$solicitud->id_solicitud}}" class="btn btn-primary editar_oficio"> Editar </button>
                                    <a href="{{url('/incidencias/historial_docentesSo')}}" class="btn btn-success ">Enviar</a>

                            </div>
                        </div>
                </div>
            </div>
            </div>




            <div class="modal fade bs-example-modal-lg" id="modal_editar_oficio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Editar oficio firmado</h4>
                        </div>
                        <div class="modal-body">
                            <form id="form_enviar_oficio" action="{{url('/incidencias/guardar_oficio/'.$solicitud->id_solicitud)}}" role="form" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1 ">
                                        <label>Instrucciones: </label><br>
                                        <label> Para poder subir la evidencia correspondiente es necesario que su archivo, que desea subir este en formato PDF y que este legible.</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <label for="archivo_subir">Archivo a subir:</label>
                                        <input  class="form-control" id="arch_solicitud" name="arch_solicitud" type="file" accept="application/pdf"    required/>
                                    </div>
                                </div>
                                <div class="row">
                                    <p><br></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button  type="submit"  class="btn btn-primary" >Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    $(".editar_oficio").click(function () {
                        //alert("HOLA")
                            $("#modal_editar_oficio").modal('show');
                    });
                });

///////seecion de evidencia////

            </script>
    </main>
@endsection