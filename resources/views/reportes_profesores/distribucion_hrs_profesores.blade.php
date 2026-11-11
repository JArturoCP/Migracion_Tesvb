@extends('layouts.app')
@section('title', 'Distribución de hrs')
@section('content')

    <main class="col-md-12">
        <div class="row">
            <div class="col-md-5 col-md-offset-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Distribución de horas profesores</h3>
                    </div>
                </div>
            </div>
        </div>
        @if($estado == 0)
            <div class="row">
                <div class="col-md-4 col-md-offset-4" >
                    <div class="dropdown-center">
                        <label for="selectCargo">Categoria</label>
                        <select name="id_categoria" id="id_categoria" class="form-control ">
                            <option disabled selected>Selecciona cargo...</option>
                            @foreach($categorias as $categoria)
                                <option value="{{$categoria->id_cargo}}" >{{$categoria->cargo}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <p><br></p>
            </div>
            @else
            <div class="col-md-4 col-md-offset-4 " >
                <div class="dropdown-center">
                    <label for="selectCargo">Categoria</label>
                    <select name="id_categoria" id="id_categoria" class="form-control ">
                        <option disabled selected>Selecciona cargo...</option>
                        @foreach($categorias as $categoria)
                            @if($categoria->id_cargo==$id_categoria)
                                <option value="{{$categoria->id_cargo}}" selected="selected">{{$categoria->cargo}}</option>
                            @else
                                <option value="{{$categoria->id_cargo}}" >{{$categoria->cargo}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php $i=1; ?>
                <table id="tabla_empresa" class="table table-bordered table-resposive">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nombre</th>
                        <th>Clave</th>
                        <th>Categoria</th>
                        <th>Perfil</th>
                        <th>Mostrar materias</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($array_docentes as $docentes)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{$docentes['nombre'] }}</td>
                            <td>{{$docentes['clave'] }}</td>
                            <td>{{$docentes['cargo']  }}</td>
                            <td>{{$docentes['perfil']  }}</td>
                            <td>
                                <button class="btn btn-primary ver_materia" data-id="{{ $docentes['id_personal'] }}">Mostrar</button>

                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
            @endif
    </main>


    <script type="text/javascript">

        $(document).ready(function() {
            $("#id_categoria").change(function(e){
                var id_categoria= e.target.value;
                window.location.href='/distribucion_horas_profesores/profesores_categoria/'+id_categoria ;

            });
            $("#tabla_empresa").DataTable();
            $("#tabla_empresa").on('click','.ver_materia',function(){
                var id_personal=$(this).data("id");
                window.location.href='/distribucion_horas_profesores/materias/'+id_personal ;
            });
        });
    </script>
@endsection