@extends('layouts.app')
@section('title', 'Estudiante')
@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 style="text-align: center;">CARGA ACADÉMICA DEL ESTUDIANTE: {{ $nombre_estudiante }}<br>Numero de cuenta: {{ $no_cuenta }}<br>{{ $grup_sem }}</h3>
                </div>
            </div>
        </div>
    </div>
    @if($correcciones != "")
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-danger">
                Comentario de correcion: <b>{{ $correcciones }}</b>
            </div>
        </div>
    </div>
    @endif
        <div class="row">

            <div  class=" col-md-4  col-md-offset-4 alert alert-success" >
                <form class="form-horizontal" role="form" method="POST" action="/validacion_de_jefe_estudiante/{{ $id }}" novalidate id="formupdate">
                    <input type="hidden" name="_method" value="PUT" />
                    {{ csrf_field() }}
                <p style="text-align: center"><label class="radio-inline"><input type="radio" id="optradio1" name="optradio" value="1" >Autorizar</label>
                    <label class="radio-inline"><input type="radio" id="optradio2" name="optradio" value="2">No autorizar</label>
                </p>
                <p id="observacion" style="display: none">
                    <label for="exampleFormControlTextarea2">Observaciones:</label>
                    <textarea class="form-control rounded-0" id="obser" rows="2"  name="obser" ></textarea>
                    <br>
                </p>
             </form>
                <p style="text-align: center">
                    <button  class="btn btn-primary" id="aceptar">Aceptar</button>
                </p>
            </div>
        </div>

    <div class="row">
        <div class=" col-md-10 col-md-offset-1">
            <table class="table table-bordered " Style="background: white;">
                <thead>
                <tr>
                    <th>NOMBRE DEL PROFESOR</th>
                    <th>CLAVE DE LA MATERIA</th>
                    <th>NOMBRE DE LA MATERIA</th>
                    <th>CREDITOS</th>
                    <th>STATUS</th>
                    <th>TIPO CURSA</th>
                    <th>GRUPO</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datos_carga as $consulta)
                    @if($consulta['id_materia'] == 2258)
                        <tr>
                            <th></th>
                            <th>{{$consulta['clave']}}</th>
                            <td>{{$consulta['nombre']}}</td>
                            <td></td>
                            <td>ALTA</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @else
                        <tr>
                            <th>
                                @foreach($consulta['profesores'] as $profesor)
                                    <p>{{ $profesor['titulo'] }}  {{ $profesor['nombre_profesor'] }}</p>
                                @endforeach
                            </th>
                            <th>{{$consulta['clave']}}</th>
                            <td>{{$consulta['nombre']}}</td>
                            <td>{{$consulta['creditos']}}</td>
                            <td>{{$consulta['nombre_status']}}</td>
                            <td>{{$consulta['nombre_curso']}}</td>
                            <td>{{$consulta['id_semestre']}}0{{$consulta['grupo']}}</td>

                        </tr>
                    @endif
                @endforeach
                <tr>
                    <th></th>
                    <th></th>
                    <td>Total de creditos:</td>
                    <td>{{$suma}}</td>
                    <td></td>
                </tr>

                </tbody>
            </table>


        </div>
    </div>
    <script>
        $(document).ready(function(){

            $("#optradio2").change(function() {
                var validez=$(this).val();
                $("#observacion").css("display", "inline");
                $("#status").css("display", "none");
            });
            $("#aceptar").click(function (){
                var radioSeleccionado = document.querySelector('input[name="optradio"]:checked');

                if(radioSeleccionado == null){
                    swal({
                        position:"top",
                        type: "error",
                        title: "Selecciona una opción",
                        showConfirmButton: false,
                        timer: 3000
                    });
                }else{
                    var boton=radioSeleccionado.value;
                     if(boton == 1){
                         $("#aceptar").attr("disabled", true);
                         $("#formupdate").submit();
                         swal({
                             position: "top",
                             type: "success",
                             title: "Autorización exitosa.",
                             showConfirmButton: false,
                             timer: 3500
                         });

                     }else{
                         var obser = $("#obser").val();
                         if(obser == ""){
                             swal({
                                 position:"top",
                                 type: "error",
                                 title: "Ingresa una observación",
                                 showConfirmButton: false,
                                 timer: 3000
                             });
                         }else{
                             $("#aceptar").attr("disabled", true);
                             $("#formupdate").submit();
                             swal({
                                 position: "top",
                                 type: "success",
                                 title: "Observación enviada exitosamente.",
                                 showConfirmButton: false,
                                 timer: 3500
                             });
                         }
                     }
                }

            });
        });
    </script>

@endsection