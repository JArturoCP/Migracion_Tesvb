@extends('layouts.app')
@section('title', 'Encuestas servicio social')
@section('content')
    <?php
    $historial = Session::get('historial_enc_s');

    ?>
    @if($historial == 1)
        <div class="row">
            <div class="col-md-10 col-xs-10 col-md-offset-1">
                <p>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="{{url("/encuestas_satisfaccion/historial_periodo_year/")}}">Historial de  encuestas de satisfacción del cliente</a>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="{{url("/encuestas_satisfaccion/menu_historial_servicio_s_year/".$year)}}">Periodos</a>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="{{url("/encuestas_satisfaccion/ver_carreras_encuesta_servicio/".$mes."/".$year)}}">Programas de Estudios</a>
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span>Encuesta del estudiante</span>
                </p>
                <br>
            </div>
        </div>
    @else
    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <p>
                <span class="glyphicon glyphicon-arrow-right"></span>
                <a href="{{url("/encuestas_satisfaccion/agregar_periodo_year/")}}">Periodos</a>
                <span class="glyphicon glyphicon-arrow-right"></span>
                <a href="{{url("/encuestas_satisfaccion/ver_carreras_encuesta_servicio/".$mes."/".$year)}}">Programas de Estudios</a>
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span>Encuesta del estudiante</span>

            </p>
            <br>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Encuestas de satifacción del cliente contestadas<br> (Servicio Social) <br> CARRERA: {{$carrera->nombre}} <br> @if($mes == 1)Enero  @else  Julio @endif del {{ $year }}</h3>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table id="tabla_alumnos" class="table table-bordered " Style="background: white;" >
                <thead>
                <tr>
                    <th>NO. CUENTA</th>
                    <th>NOMBRE DEL ESTUDIANTE</th>
                    <th>ACCIÓN</th>
                </tr>
                </thead>
                <tbody>

                @foreach($encuestas as $alumno)
                    <tr>
                        <td>{{$alumno->cuenta}} </td>
                        <td>{{$alumno->apaterno }}{{$alumno->amaterno }}{{$alumno->nombre }} </td>
                        <td><button type="button" class="btn btn-success"   onclick="window.location='{{ url('/encuestas_satisfaccion/ver_enc_terminada/'.$alumno->id_servicio ) }}'">Ver encuesta</button></td>
                    </tr>
                @endforeach



                </tbody>
            </table>
        </div>

    </div>
    {{--Modal de agregar--}}
    <div class="modal fade" id="modal_enviar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Enviar encuesta</h4>
                </div>
                <form id="form_envio_encuesta" class="form" action="{{url("/encuestas_satisfaccion/envio_encuesta_estudiante_servicio/".$mes."/".$year)}}" role="form" method="POST" >
                    {{ csrf_field() }}
                    <div class="modal-body">

                        <div id="contenedor_enviar">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button  id="envio_encuesta" type="button" style="" class="btn btn-primary">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tabla_alumnos').DataTable();


        } );
        $("#tabla_alumnos").on('click','.enviar_encuesta',function(){
            var id_alumno=$(this).data('id');
            $.get("/encuestas_satisfaccion/enc_servicio_datos_alumn/"+id_alumno,function (request) {
                $("#contenedor_enviar").html(request);
                $("#modal_enviar").modal('show');
            });
            $("#envio_encuesta").click(function (){
                $("#form_envio_encuesta").submit();
                $("#envio_encuesta").attr("disabled", true);
                swal({
                    type: "success",
                    title: "Se envio correctamente la encuesta",
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });

    </script>
@endsection