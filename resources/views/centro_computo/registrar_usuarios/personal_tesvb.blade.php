@extends('layouts.app')
@section('title', 'Centro de Computo')
@section('content')

    <main class="col-md-12">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Correos electronicos del personal TESVB
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <p><br></p>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-2">
                <button class="btn btn btn-danger eliminar_usuarios" >Eliminacion de usuarios sin datos</button>
            </div>
        </div>
        <div class="row">
            <p><br></p>
        </div>
        <div class="row">
            <div class="col-md-5 col-md-offset-1">
                <table class="table table-bordered"  id="tabla">
                    <thead>
                    <tr>
                        <th>Correo</th>
                        <th>Estado de registro terminado</th>
                        <th>Eliminar</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($usuario_no_reg as $usuario)
                        <tr>
                            <td>{{ $usuario['email'] }}</td>
                            @if($usuario['info_ok'] == 0)
                                <td>Sin datos</td>
                            @else
                                <td>Con datos</td>
                            @endif

                            <td><button class="btn btn btn-danger iduser" id="{{ $usuario['id'] }}">Eliminar</button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-5 ">
                <table class="table table-bordered"  id="tabla_reg">
                    <thead>
                    <tr>
                        <th>Correo</th>
                        <th>Estado de registro terminado</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($usuario_reg as $usuar)
                        <tr>
                            <td>{{ $usuar['email'] }}</td>
                            @if($usuar['info_ok'] == 0)
                                <td>Sin datos</td>
                            @else
                                <td>Con datos</td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <p><br></p>
        </div>
    </main>
    <div class="modal fade bs-example-modal-lg" id="modal_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">ELIMINAR USUARIO</h4>
                </div>
                <form  action="{{url("/centro_computo/eliminacion_user_sin_reg")}}" class="form" role="form" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div id="contenedor_user">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">ELIMINAR USUARIOS</h4>
                </div>
                <form  action="{{url("/centro_computo/eliminacion_user_per_sin_reg")}}" class="form" role="form" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>¿Seguro que quieres eliminar los correos electronicos sin datos?</p>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#tabla').DataTable();
            $('#tabla_reg').DataTable();
            $("#tabla").on('click','.iduser',function() {
                var id = $(this).attr('id');
                $.get("/centro_computo/eliminar_user_sin_reg/"+id,function (request) {
                    $("#contenedor_user").html(request);
                    $("#modal_user").modal('show');
                });
            });
            $(".eliminar_usuarios").click(function (){
                $("#modal_eliminar").modal('show');
            });
        });
    </script>

@endsection