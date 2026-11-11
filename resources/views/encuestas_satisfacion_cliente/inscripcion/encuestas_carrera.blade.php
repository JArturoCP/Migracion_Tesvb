@extends('layouts.app')
@section('title', 'Encuestas de inscripción')
@section('content')

        <div class="row">
            <div class="col-md-10 col-xs-10 col-md-offset-1">
                <p>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="{{url("/encuestas_satisfaccion/encuesta_incripcion_periodo")}}">Periodos de las encuestas</a>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="{{url("/encuestas_satisfaccion/carrera_enc_incripcion")}}">Programas de Estudios</a>
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span>Encuestas contestadas</span>
                </p>
                <br>
            </div>
        </div>

    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Encuestas de satifacción del cliente (Incripción)<br> Periodo {{ $periodo_nom->periodo }}<br> (CARRERA: {{$carrera->nombre}})  </h3>
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

                @foreach($estudiantes as $alumno)

                    <tr>
                        <td>{{$alumno->cuenta }} </td>
                        <td>{{$alumno->nombre.' '.$alumno->apaterno.' '.$alumno->amaterno}} </td>
                        <td><button type="button" class="btn btn-success" onclick="window.location='{{ url('/encuestas_satisfaccion/enc_est_inscripcion/'.$alumno->id_incripcion ) }}'">Ver encuesta</button></td>
                    </tr>
                @endforeach



                </tbody>
            </table>
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