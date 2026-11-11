@extends('layouts.app')
@section('title', 'Titulacion')
@section('content')
    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <p>
                <span class="glyphicon glyphicon-arrow-right"></span>
                <a href="{{url("/encuestas_satisfaccion/historial_encuesta_estudiante_titulacion")}}">Historial de  encuestas (TITULACIÓN)</a>
                <span class="glyphicon glyphicon-arrow-right"></span>
                <a href="{{url("/encuestas_satisfaccion/menu_historial_titulacion_year/")}}">Periodos de las encuestas</a>
                <span class="glyphicon glyphicon-arrow-right"></span>
                <a href="{{url("/encuestas_satisfaccion/enc_contestadas_carreras_ti/".$mes."/".$year)}}">Programas de Estudios</a>
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span>Estudiantes de la carrera titulados</span>
            </p>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Encuestas de satifacción del cliente contestadas (TITULACIÓN)<br> (CARRERA: {{$carrera->nombre}})  </h3>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table id="tabla_alumnos" class="table table-bordered " Style="background: white;" >
                <thead>
                <tr>
                    <th>NO. CUENTA</th>
                    <th>NOMBRE DEL ESTUDIANTE</th>
                    <th>ACCIÓN</th>
                </tr>
                </thead>
                <tbody>

                @foreach($encuestas as $encuesta)
                    <tr>
                        <td>{{  $encuesta->no_cuenta }} </td>
                        <td>{{ $encuesta->nombre_al }} {{ $encuesta->apaterno }} {{ $encuesta->amaterno }} </td>

                        <td><button type="button" class="btn btn-success" onclick="window.location='{{ url('/encuestas_satisfaccion/enc_est_ti_alumno_termino/'.$encuesta->id_titulacion ) }}'">Ver encuesta</button></td>

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
                <form id="form_envio_encuesta" class="form" action="{{url("/encuestas_satisfaccion/envio_encuesta_estudiante_titulacion/")}}" role="form" method="POST" >
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input class="form-control" type="hidden"  id="mes" name="mes"  value="{{$mes }}">
                        <input class="form-control" type="hidden"  id="year" name="year"  value="{{$year }}">

                        <div id="contenedor_enviar">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button  id="envio_encuesta" type="button" style="" class="btn btn-primary">Enviar</button>
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
            $.get("/encuestas_satisfaccion/enviar_encuesta_titulacion/"+id_alumno,function (request) {
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