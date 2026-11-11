@extends('layouts.app')
@section('title', 'Periodos de encuestas de Residencia Profesional')
@section('content')

    <div class="row">
        <div class="col-md-4 col-xs-10 col-md-offset-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Encuestas de satisfacción del cliente (Residencia Profesional)<br>(PERIODOS {{ $nombre_periodo->periodo }}) </h3>
                </div>
                <div class="panel-body " >
                    @if($estado_periodo == 0)
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <p style="text-align: center">Agregar periodo<br><button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar periodo" data-target="#modal_agregar" type="button" class="btn btn-success" >
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    </button></p>
                            </div>
                        </div>
                    @else
                        @if($nom_periodo_resi->id_estado == 0)
                            <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <button type="button" class="btn btn-success" onclick="window.location='{{ url('/encuestas_satisfaccion/ver_carreras_encuesta_residencia/'.$nom_periodo_resi->id_periodo ) }}'">Enviar encuestas</button>
                            </div>
                                <div class="col-md-5 col-md-offset-1">
                                    <button type="button" class="btn btn-primary terminar_periodo" id="{{ $nom_periodo_resi->id_periodo_residencia  }}" >Terminar el periodo</button>
                                </div>
                            </div>
                            <div class="row">
                                <p><br></p>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <table class="table table-bordered table-resposive">
                                        <thead>
                                        <tr>
                                            <th>Nombre de la encuesta</th>
                                            <th>Número de estudiantes</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                               <td>Encuestas enviadas</td>
                                                <td>{{ $contar_enc_enviadas->contar }}</td>
                                            </tr>
                                            <tr>
                                                <td>Encuestas contestadas</td>
                                                <td>{{ $contar_enc_contestadas->contar }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-5 col-md-offset-1">
                                    <button type="button" class="btn btn-success" onclick="window.location='{{ url('/encuestas_satisfaccion/ver_enc_contestadas_residencia/'.$nom_periodo_resi->id_periodo_residencia ) }}'">Ver encuestas contestadas</button>
                                </div>
                                <div class="col-md-5 col-md-offset-1">
                                    <button type="button" class="btn btn-warning" onclick="window.location='{{ url('/encuestas_satisfaccion/ver_enc_carreras_res_residencia/'.$nom_periodo_resi->id_periodo_residencia ) }}'">Ver resultados</button>
                                </div>
                            </div>
                            <div class="row">
                                <p><br></p>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <table class="table table-bordered table-resposive">
                                        <thead>
                                        <tr>
                                            <th>Nombre de la encuesta</th>
                                            <th>Número de estudiantes</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Encuestas contestadas</td>
                                            <td>{{ $contar_enc_contestadas->contar }}</td>
                                        </tr>
                                        <tr>
                                            <td>Encuestas rechazadas</td>
                                            <td>{{ $contar_enc_rechazadas->contar }}</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Agregar periodo</h4>
                </div>
                <div class="modal-body">

                    <form id="form_agregar" class="form" action="{{url("/encuestas_satisfaccion/guardar_periodo_year_residencia/")}}" role="form" method="POST" >
                        {{ csrf_field() }}
                        <input type="hidden" id="id_periodo" name="id_periodo" value="{{$nombre_periodo->id_periodo}}">
                      <h2 style="text-align: center">  Deseas agregar periodo.</h2>

                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_agregar"  class="btn btn-primary" >Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_termino" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form_terminar" class="form" action="{{url("/encuestas_satisfaccion/guardar_termino_encuesta_residencia")}}" role="form" method="POST" >
                    {{ csrf_field() }}
                    <div class="modal-header bg-info">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Terminar periodo</h4>
                    </div>
                    <div class="modal-body">
                        <div id="contenedor_termino">
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button  id="guardar_termino" type="button" style="" class="btn btn-primary"  >Aceptar</button>
                </div>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#guardar_agregar").click(function (event) {
                $("#guardar_agregar").attr("disabled", true);
                    $("#form_agregar").submit();
                    swal({
                        type: "success",
                        title: "Registro exitoso.",
                        showConfirmButton: false,
                        timer: 1500
                    });


            });
            $(".terminar_periodo").click(function (event){
                var id_periodo_residencia=$(this).attr('id');
                $.get("/encuestas_satisfaccion/termino_encuesta_residencia/"+id_periodo_residencia,function (request) {
                    $("#contenedor_termino").html(request);
                    $("#modal_termino").modal('show');
                });

            });
            $("#guardar_termino").click(function (){
                $("#form_terminar").submit();
                swal({
                    type: "success",
                    title: "Registro exitoso.",
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });
    </script>
@endsection