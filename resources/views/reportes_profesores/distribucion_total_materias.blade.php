@extends('layouts.app')
@section('title', 'Distribución de hrs de los profesores')
@section('content')

    <main class="col-md-12">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading text-center">
                        <h3 >Distribución de horas de los docentes</h3>
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
                    <a href="/distribucion_horas_profesores/excel_totales_profesor/{{$id_categoria}}" class="btn btn-success">Exportar concentrado <span class="oi oi-document p-1"></span></a>

                </div>
            </div>
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
                <p><br></p>
            </div>

        <div class="row">
            <p><br></p>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php $i=1; ?>
                <table id="tabla_empresa" class="table table-bordered table-resposive">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Docente</th>
                        <th>Horas Asignatura</th>
                        <th>Horas de Actividades de apoyo a la docencia</th>
                        <th>Total de horas</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $suma=0; ?>
                    @foreach($array_materia as $materia)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{$materia['nombre'] }}</td>
                            @if($materia['horas_asignatura'] <= 19 )
                            <td>{{$materia['horas_asignatura']  }}</td>
                            @else
                                <td style="background: lightblue">{{$materia['horas_asignatura']  }}</td>
                            @endif
                            <td>{{$materia['horas_apoyo'] }}</td>
                            <td>{{$materia['totales_horas'] }}</td>
                         {{--    <td style="background: #b8daff">{{ $materia['horas_profesor'] }}</td> --}}
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
            $("#tabla_empresa").DataTable();
            $("#id_categoria").change(function(e){
                var id_categoria= e.target.value;
                window.location.href='/distribucion_horas_profesores/totales_profesor/'+id_categoria ;

            });

        });
    </script>
@endsection