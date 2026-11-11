@extends('layouts.app')
@section('title', 'Encuestas de Satisfacción de Cliente')
@section('content')

    <main class="col-md-12">
        <div class="row">
            <div class="col-md-5 col-md-offset-3">

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h2 class="panel-title text-center">Encuesta de Satisfacción de Cliente interno Centro de Computo</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h2 class="panel-title text-center">Por favor contestar las siguientes encuestas  de satisfacción de Cliente interno de la solicitud de servicio preventivo y correctivo al equipo de computo.</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <p><br></p>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table id="table_enviado" class="table table-bordered table-resposive">
                    <thead>
                    <tr>
                        <th>Fecha de la solicitud</th>
                        <th>Servicio que solicita</th>
                        <th>Contestar encuesta</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($encuestas_mantenimiento as $mantenimiento)

                        <tr>
                            <?php  $fecha_solicita=date("d-m-Y",strtotime($mantenimiento->fecha_solicita)) ?>

                                <td>{{ $fecha_solicita }}</td>
                                <td>{{ $mantenimiento->servicio_solicita }}</td>
                                <td><button type="button" class="btn btn-primary contestar" data-id="{{ $mantenimiento->id_servicio_mantenimiento }}">Contestar encuesta</button></td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <br>
            </div>
        </div>




    </main>
    <div class="modal fade btn-lg" id="modal_agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Nueva encuesta  de satisfacción al cliente interno</h4>
                </div>
                <div class="modal-body">


                        <div id="contenedor_agregar">
                        </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id="enviar_encuesta"  class="btn btn-primary" >Enviar encuesta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_enviado').DataTable( {

            } );

            $('#fecha_s').datepicker({

                autoclose: true,
                //startDate: '+0d',
                language: 'es'
            });

            $("#table_enviado").on('click','.contestar',function(){
                var id=$(this).data('id');

                $.get("/encuestas_satisfaccion/contestar_encuesta_mantenimiento/"+id,function (request) {
                    $("#contenedor_agregar").html(request);
                    $("#modal_agregar").modal('show');
                });
            });

            $("#enviar_encuesta").click(function (){
               // alert("hola");
                var pregunta1 = $("input[type='radio'][name='pregunta1']:checked").val();
                if(pregunta1 != undefined){
                    var pregunta2 = $("input[type='radio'][name='pregunta2']:checked").val();
                    if(pregunta2 != undefined){
                        var pregunta3 = $("input[type='radio'][name='pregunta3']:checked").val();
                        if(pregunta3 != undefined){
                            var pregunta4 = $("input[type='radio'][name='pregunta4']:checked").val();
                            if(pregunta4 != undefined){
                                $("#enviar_encuesta").attr("disabled", true);
                                $("#form_enviar_encuesta").submit();
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
                                    title: "Te falta responder la pregunta 4",
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                            }

                        }else{
                            swal({
                                position: "top",
                                type: "warning",
                                title: "Te falta responder la pregunta 3",
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }

                    }else{
                        swal({
                            position: "top",
                            type: "warning",
                            title: "Te falta responder la pregunta 2",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }

                }else{
                    swal({
                        position: "top",
                        type: "warning",
                        title: "Te falta responder la pregunta 1",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });


        });
    </script>
@endsection