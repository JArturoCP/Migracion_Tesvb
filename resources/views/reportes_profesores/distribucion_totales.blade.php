@extends('layouts.app')
@section('title', 'Distribución de hrs del profesor')
@section('content')

    <main class="col-md-12">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading text-center">
                        <h3 >Distribución de horas de los docentes por categoria</h3>
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
            <div class="row">
                <div class="col-md-2 col-md-offset-8">
                    <a href="/distribucion_horas_profesores/excel_profesores_categorias/{{$id_categoria}}" class="btn btn-success">Exportar concentrado <span class="oi oi-document p-1"></span></a>

                </div>
            </div>
            <div class="row">
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
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <?php $i=1; ?>
                    <table id="tabla_empresa" class="table table-bordered table-resposive">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Programa de Estudios</th>
                            <th>Categoría Docente</th>
                            <th>Asignatura</th>
                            <th>Periodo</th>
                            <th>Perfil</th>
                            <th>Docente</th>
                            <th>Horas por grupo</th>
                            <th>Número de grupos</th>
                            <th>Horas por Asignatura</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $suma=0; ?>
                        @foreach($array_materia as $materia)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{$materia['carrera'] }}</td>
                                <td>{{$materia['cargo'] }}</td>
                                <td>{{$materia['materia'] }}</td>
                                <td>{{ $periodo->periodo }}</td>
                                <td>{{ $materia['perfil'] }}</td>
                                <td>{{$materia['nombre'] }}</td>
                                <td>{{$materia['horas_totales']  }}</td>
                                <td>{{$materia['total_grupos']  }}</td>
                                <td>{{$materia['total_horas_grupos']  }}</td>
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
                window.location.href='/distribucion_horas_profesores/profesores_categorias/'+id_categoria ;

            });
            $("#tabla_empresa").DataTable();
            $("#tabla_empresa").on('click','.ver_materia',function(){
                var id_personal=$(this).data("id");
                window.location.href='/distribucion_horas_profesores/materias/'+id_personal ;
            });
        });
    </script>
@endsection