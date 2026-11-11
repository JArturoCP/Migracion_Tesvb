@extends('layouts.app')
@section('title', 'Centro de Computo')
@section('content')

    <main class="col-md-12">


        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Usuarios
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <p><br></p>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <table class="table table-bordered" id="tabla">
                    <thead>
                    <tr>
                        <th>Correo</th>
                        <th>Fecha de creacion</th>
                        <th>Fecha de modificación</th>
                        <th>modificar</th>
                    </thead>
                    <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->email }}</td>
                            <td>{{  $usuario->created_at}}</td>
                            <td>{{$usuario->updated_at}}</td>
                            <td class="text-center">
                                <button class="btn btn btn-primary iduser" id="{{ $usuario->id }}">Modificar</button>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </main>
    <div class="modal fade bs-example-modal-lg" id="modal_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">USUARIO</h4>
                </div>
                <form  action="{{url("/centro_computo/modificar_usuario_per/")}}" class="form" role="form" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div id="contenedor_user">
                        </div>
                    </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary " >Agregar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#tabla').DataTable();
            $("#tabla").on('click','.iduser',function() {
                var id = $(this).attr('id');
                $.get("/centro_computo/ver_usuario_per/"+id,function (request) {
                    $("#contenedor_user").html(request);
                    $("#modal_user").modal('show');
                });
            });
        });
    </script>
@endsection