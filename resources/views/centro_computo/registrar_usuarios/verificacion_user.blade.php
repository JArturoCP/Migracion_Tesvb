@extends('layouts.app')
@section('title', 'Centro de Computo')
@section('content')

    <main class="col-md-12">


        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Verificación de usuario
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <form class="form"  action="{{url("/centro_computo/verificar_usuario")}}" role="form" method="POST" enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="row">
                <p><br></p>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">ingresa contraseña</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                            <p><br></p>
                            <div class="row">
                                <div class="col-md-1 col-md-offset-5">
                                    <button  type="submit" class="btn btn-primary" >Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <p><br></p>
        </div>

    </main>
@endsection