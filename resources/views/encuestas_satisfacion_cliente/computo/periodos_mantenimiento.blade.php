@extends('layouts.app')
@section('title', 'Periodos de encuestas de mantenimiento')
@section('content')

    <?php
    $historial = Session::get('historial_enc_c');

    ?>
    @if($historial == 1)
    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <p>
                <span class="glyphicon glyphicon-arrow-right"></span>
                <a href="{{url("/encuestas_satisfaccion/menu_historial_mantenimiento")}}">Historial de  encuestas de satisfacción del cliente</a>
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span>Periodos de las encuestas</span>
            </p>
            <br>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Encuestas de satisfacción del cliente interno<br>(Centro de computo)<br>(PERIODOS DEL AÑO {{ $year }}) </h3>
                </div>
                <div class="panel-body " >
                    @if($total_periodos < 2)
                        <div class="row">
                            <div class="col-md-2">
                                <p style="text-align: center">Agregar periodo<br><button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar periodo" data-target="#modal_agregar" type="button" class="btn btn-success" >
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    </button></p>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <table class="table table-bordered table-resposive">
                                <thead>
                                <tr>
                                    <th>Nombre del periodo</th>
                                    <th>Enviar encuesta</th>
                                    <th>Estado</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($periodos as $periodo)
                                    <tr>
                                        @if($periodo->mes == 1)
                                            <td>Enero</td>
                                            <td> <button type="button" class="btn btn-success" onclick="window.location='{{ url('/encuestas_satisfaccion/ver_encuestas_mant/'.$periodo->mes.'/'.$year ) }}'">Ver encuestas</button></td>
                                            @if($periodo->id_estado == 0)
                                                <td><button type="button" class="btn btn-primary terminar_periodo"  id="{{ $periodo->id_periodo_mantenimiento  }}" >Terminar el periodo</button></td>
                                            @else
                                                <td>Periodo terminado<br>
                                                    <button type="button" class="btn btn-warning" onclick="window.location='{{ url('/encuestas_satisfaccion/ver_resultado_mantenimiento/'.$periodo->mes.'/'.$year ) }}'">Ver resultados</button>
                                                </td>
                                            @endif
                                        @elseif($periodo->mes == 2)
                                            <td>Julio</td>
                                            <td> <button type="button" class="btn btn-success" onclick="window.location='{{ url('/encuestas_satisfaccion/ver_encuestas_mant/'.$periodo->mes.'/'.$year ) }}'">Ver encuestas</button></td>
                                            @if($periodo->id_estado == 0)
                                                <td><button type="button" class="btn btn-primary terminar_periodo" id="{{ $periodo->id_periodo_mantenimiento  }}" >Terminar el periodo</button></td>
                                            @else
                                                <td>Periodo terminado<br>
                                                    <button type="button" class="btn btn-warning" onclick="window.location='{{ url('/encuestas_satisfaccion/ver_resultado_mantenimiento/'.$periodo->mes.'/'.$year ) }}'">Ver resultados</button>
                                                </td>
                                            @endif
                                        @endif

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
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

                    <form id="form_agregar" class="form" action="{{url("/encuestas_satisfaccion/registrar_periodo_mantenimiento_year/")}}" role="form" method="POST" >
                        {{ csrf_field() }}
                        <input type="hidden" id="year" name="year" value="{{$year}}">

                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="dropdown">
                                    <label for="selectAutomovil">Selecciona mes</label>
                                    <select name="mes" id="mes" class="form-control ">
                                        <option disabled selected>Selecciona...</option>
                                        <option value="1">Enero</option>
                                        <option value="2">Julio</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_agregar"  class="btn btn-primary" >Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_termino" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form_terminar" class="form" action="{{url("/encuestas_satisfaccion/guardar_termino_encuesta_mantenimiento")}}" role="form" method="POST" >
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
                    <button  id="guardar_termino" type="button" style="" class="btn btn-primary"  >Guardar</button>
                </div>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#guardar_agregar").click(function (event) {
                var mes = $('#mes').val();
                if(mes == null){
                    swal({
                        position: "top",
                        type: "error",
                        title: "Selecciona mes",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }else{
                    $("#form_agregar").submit();
                    swal({
                        type: "success",
                        title: "Registro exitoso.",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }

            });
            $(".terminar_periodo").click(function (event){
                var id_periodo_mantenimiento=$(this).attr('id');
                $.get("/encuestas_satisfaccion/termino_encuesta_mantenimiento/"+id_periodo_mantenimiento,function (request) {
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