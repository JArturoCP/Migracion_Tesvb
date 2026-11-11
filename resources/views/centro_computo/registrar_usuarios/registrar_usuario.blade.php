@extends('layouts.app')
@section('title', 'Centro de Computo')
@section('content')

    <main class="col-md-12">


        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Registrar  correo y contraseña de los estudiantes
                        </h3>
                    </div>
                </div>
            </div>
        </div>
            <form class="form"  action="{{url("/centro_computo/registro_datos_estudiante_excel/")}}" role="form" method="POST" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                            <input class="form-control"  id="excel_registro" name="excel_registro" type="file"   required/>
                            <p><br></p>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-1 col-md-offset-5">
                    <button  type="submit" class="btn btn-primary" >Guardar</button>
                </div>
                </div>
            </form>
        <div class="row">
            <p><br></p>
        </div>

    </main>
@endsection