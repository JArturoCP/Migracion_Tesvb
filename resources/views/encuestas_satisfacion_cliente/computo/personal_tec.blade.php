@extends('layouts.app')
@section('title', 'Encuestas de Satisfacción de Cliente')
@section('content')

    <?php
    $historial = Session::get('historial_enc_c');
    ?>
    <main class="col-md-12">
        @if($historial == 1)
        <div class="row">
            <div class="col-md-10 col-xs-10 col-md-offset-1">
                <p>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="{{url("/encuestas_satisfaccion/menu_historial_mantenimiento")}}">Historial de encuestas de satisfacción del cliente</a>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="{{url("/encuestas_satisfaccion/menu_historial_mantenimiento_year/".$year)}}">Periodos de las encuestas</a>
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span>Encuestas</span>
                </p>
                <br>
            </div>
        </div>
        @else
            <div class="row">
                <div class="col-md-10 col-xs-10 col-md-offset-1">
                    <p>
                        <span class="glyphicon glyphicon-arrow-right"></span>
                        <a href="{{url("/encuestas_satisfaccion/periodo_mantenimiento")}}">Periodos de las encuestas</a>
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span>Encuestas</span>
                    </p>
                    <br>
                </div>
            </div>

        @endif
        <div class="row">
            <div class="col-md-5 col-md-offset-3">

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h2 class="panel-title text-center">Encuestas de Satisfacción de Cliente interno<br>(Centro de computo)<br>@if($mes == 1)Enero  @else Julio @endif del {{ $year }}</h2>
                    </div>
                </div>
            </div>
        </div>
        @if($estado_periodo->contar == 0)
        <div class="row">
            <div class="col-md-2 col-md-offset-5">
                <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar nueva encuesta" data-target="#modal_agregar" type="button" class="btn btn-success btn-lg flotante">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
            </div>
        </div>
        @endif
        <div class="row">
            <p><br></p>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table id="table_enviado" class="table table-bordered table-resposive">
                    <thead>
                    <tr>
                        <th>Fecha de la solicitud</th>
                        <th>Nombre de quien lo solicita</th>
                        <th>Servicio que solicita</th>
                        <th>Enviar encuesta</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($mantenimientos as $servicio)

                        <tr>
                            <?php  $fecha_solicita=date("d-m-Y",strtotime($servicio->fecha_solicita)) ?>

                            <td>{{ $fecha_solicita }}</td>
                            <td>{{ $servicio->nombre }}</td>
                            <td>{{ $servicio->servicio_solicita }}</td>
                            @if($servicio->id_estado == 0)
                                <td style="text-align: center;"><button type="button" class="btn btn-primary enviar_encuesta" data-id="{{ $servicio->id_servicio_mantenimiento }}">Enviar encuesta</button><br><br>
                                    <a class="elimina" id="{{ $servicio->id_servicio_mantenimiento}}"><span class="glyphicon glyphicon-trash em6" aria-hidden="true" ></span></a></td>
                            @elseif($servicio->id_estado == 1)
                                <td>Encuesta enviada</td>
                                @elseif($servicio->id_estado == 2)
                                    <td style="background: #b8daff; text-align: center">
                                        <button type="button" class="btn btn-success ver_encuesta" data-id="{{ $servicio->id_servicio_mantenimiento }}">ver_encuesta</button><br>
                                        Encuesta contestada</td>
                                @elseif($servicio->id_estado == 3)
                                    <td style="background: #8c8c8c">Encuesta rechazada</td>
                            @endif
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <br>
            </div>
        </div>




    </main>
    <div class="modal fade" id="modal_agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Nueva encuesta  de satisfacción al cliente interno</h4>
                </div>
                <div class="modal-body">
                    <form id="form_agregar" class="form" action="{{url("/encuestas_satisfaccion/guardar_registro_mantemiento_computo/".$mes."/".$year)}}" role="form" method="POST" >
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="dropdown">
                                    <label for="selectPersonal">Personal del Tecnológico</label>
                                    <select class="form-control" id="selectPersonal" name="selectPersonal" >
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($personales as $personal)
                                            <option value="{{$personal->id_personal}}"> {{$personal->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="form-group">
                                    <label for="dependencia">Servicio que solicita</label>
                                    <textarea class="form-control" id="servicio" name="servicio" rows="3"  placeholder="Ingresa el servicio que solicita" style=""></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="form-group">
                                    <label for="dependencia">Fecha que solicita el servicio</label>
                                    <input class="form-control datepicker fecha_s"   type="text"  id="fecha_s" name="fecha_s" data-date-format="yyyy/mm/dd" placeholder="yyyy/mm/dd" >
                                </div>
                            </div>
                        </div>


                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id="guardar_agregado"  class="btn btn-primary" >Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_enviar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Enviar encuesta  de satisfacción al cliente interno</h4>
                </div>
                <div class="modal-body">
                    <form id="form_enviar_encuesta" class="form" action="{{url("/encuestas_satisfaccion/guardar_envio_enc_mante/")}}" role="form" method="POST" >
                        {{ csrf_field() }}
                        <div id="contenedor_enviar">

                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id="enviar"  class="btn btn-primary" >Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_ver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Ver encuesta  de satisfacción al cliente interno</h4>
                </div>
                <div class="modal-body">
                        <div id="contenedor_ver">

                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Eliminar encuesta  de satisfacción al cliente interno</h4>
                </div>
                <div class="modal-body">
                    <form id="form_eliminar_encuesta" class="form" action="{{url("/encuestas_satisfaccion/guardar_eliminacion_enc_mante/")}}" role="form" method="POST" >
                        {{ csrf_field() }}
                        <div id="contenedor_eliminar">

                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id="eliminar_encuesta"  class="btn btn-primary" >Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_enviado').DataTable( {

            } );
            $("#table_enviado").on('click','.elimina',function(){
                var id=$(this).attr('id');

                $.get("/encuestas_satisfaccion/eliminar_enc_mantenimiento/"+id,function (request) {
                    $("#contenedor_eliminar").html(request);
                    $("#modal_eliminar").modal('show');
                });
            });


            $('#fecha_s').datepicker({

                autoclose: true,
                //startDate: '+0d',
                language: 'es'
            });

            $("#table_enviado").on('click','.enviar_encuesta',function(){
                var id=$(this).data('id');
                $.get("/encuestas_satisfaccion/notificacion_enviar_enc_mantenimiento/"+id,function (request) {
                    $("#contenedor_enviar").html(request);
                    $("#modal_enviar").modal('show');
                });
            });
            $("#enviar").click(function (){
                $("#enviar").attr("disabled", true);
                $("#form_enviar_encuesta").submit();
                swal({
                    position: "top",
                    type: "success",
                    title: "Se envio correctamente su encuesta.",
                    showConfirmButton: false,
                    timer: 3500
                });
            });
            $("#guardar_agregado").click(function (){
                var id_personal = $("#selectPersonal").val();
                if(id_personal != null){
                    var servicio = $("#servicio").val();
                    if(servicio != ""){
                        var fecha_s = $("#fecha_s").val();
                        if(fecha_s !=""){
                            $("#guardar_agregado").attr("disabled", true);
                            $("#form_agregar").submit();
                            swal({
                                position: "top",
                                type: "success",
                                title: "Se envio correctamente su encuesta.",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }else{
                            swal({
                                position: "top",
                                type: "warning",
                                title: "Selecciona fecha que solicita el servicio",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }

                    }else{
                        swal({
                            position: "top",
                            type: "warning",
                            title: "Ingresa el servicio que solicita",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }

                }else{
                    swal({
                        position: "top",
                        type: "warning",
                        title: "Selecciona el nombre del personal",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
            $("#eliminar_encuesta").click(function (){
                $("#eliminar_encuesta").attr("disabled", true);
                $("#form_eliminar_encuesta").submit();
                swal({
                    position: "top",
                    type: "success",
                    title: "Eliminar encuesta.",
                    showConfirmButton: false,
                    timer: 3500
                });
            });
            $("#table_enviado").on('click','.ver_encuesta',function(){
                var id=$(this).data('id');
                $.get("/encuestas_satisfaccion/ver_enc_mantenimiento/"+id,function (request) {
                    $("#contenedor_ver").html(request);
                    $("#modal_ver").modal('show');
                });
              //  alert(id);
                //  alert("hola");

            });


        });
    </script>
@endsection