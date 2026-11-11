@extends('layouts.app')
@section('title', 'Encuesta de satifacción periodos reinscripción')
@section('content')
    <main class="col-md-12">

        <div class="row">
            <div class="col-md-6 col-md-offset-3 ">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Encuesta de satifacción del cliente de reinscripción <br> Periodo {{ $periodo_nom->periodo }}</h3>
                    </div>
                </div>
            </div>
        </div>
        @if($estado_periodo_periodo == 0)
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">

                                    <p style="text-align: center">Terminar el periodo de enviar encuestas<br><button type="button" class="btn btn-primary terminar" >Terminar el periodo de enviar encuestas</button></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Tipo de encuesta</th>
                                            <th>Total de estudiantes</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Encuestas contestadas</td>
                                            <td>{{ $encuestas_enviadas->contar }}<br>
                                                <button type="button" class="btn btn-warning" onclick="window.location='{{ url('/encuestas_satisfaccion/carrera_enc_reincripcion' ) }}'">Ver encuestas</button>

                                            </td>


                                        </tr>
                                        <tr>
                                            <td>Encuestas no contestadas</td>
                                            <td>{{$encuesta_no_enviadas->contar}}</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">

                                    <h4 style="text-align: center">Periodo terminado.</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Tipo de encuesta</th>
                                            <th>Total de estudiantes</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Encuestas contestadas</td>
                                            <td>{{ $encuestas_enviadas->contar }}  <br>
                                                <button type="button" class="btn btn-warning" onclick="window.location='{{ url('/encuestas_satisfaccion/carrera_enc_reincripcion' ) }}'">Ver encuestas</button>

                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Encuestas rechazadas</td>
                                            <td>{{$encuestas_rechazadas->contar}}</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-md-offset-5">
                                    <button type="button" class="btn btn-success" onclick="window.location='{{ url('/encuestas_satisfaccion/ver_resultados_enc_reincripcion' ) }}'">Ver resultados</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>



        @endif
        <div class="modal fade" id="modal_enviar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Notificación de termino de periodo</h4>
                    </div>
                    <form id="form_envio_encuesta" class="form" action="{{url("/encuestas_satisfaccion/envio_periodo_terminado_reins/")}}" role="form" method="POST" >
                        {{ csrf_field() }}
                        <div class="modal-body">
                            Estas seguro(a) de dar por terminado el envió de encuestas de satisfacción.

                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button  id="envio_encuesta" type="button" style="" class="btn btn-primary">Aceptar</button>
                    </div>

                </div>
            </div>
        </div>


        <script type="text/javascript">
            $(document).ready( function() {
                $(".terminar").click(function (){
                    $("#modal_enviar").modal('show');
                });
                $("#envio_encuesta").click(function (){
                    $("#envio_encuesta").attr("disabled", true);
                    $("#form_envio_encuesta").submit();

                    swal({
                        type: "success",
                        title: "Registro exitoso.",
                        showConfirmButton: false,
                        timer: 1500
                    });
                });

            });




        </script>


    </main>

@endsection