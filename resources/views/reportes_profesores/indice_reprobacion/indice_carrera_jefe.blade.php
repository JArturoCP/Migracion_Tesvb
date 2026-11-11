@extends('layouts.app')
@section('title', 'Indice de reprobación')
@section('content')
    <?php
    $jefe_division = session()->has('jefe_division') ? session()->has('jefe_division') : false;
    ?>

    @if($estado == 1)
        <div class="row">
            <div class="col-md-8  col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Indices de Reprobación<br><b>@foreach($carreras as $carrera) {{ $carrera->nombre }} @endforeach</b></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-md-offset-2" style="display: none" >
                <div class="dropdown-center">
                    <label for="selectCargo"></label>
                    <select name="id_carrera" id="id_carrera" class="form-control ">
                        @foreach($carreras as $carrera)
                            <option value="{{$carrera->id_carrera}}" selected="selected" >{{$carrera->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-md-offset-5" >
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
    @else
        @if($jefe_division != true)
        <div class="row">
            <div class="col-md-10 col-xs-10 col-md-offset-1">
                <p>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="{{url("/indices_repro_prof/")}}">Planes de Estudios</a>
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span>Indice Reprobación docentes</span>

                </p>
                <br>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-2 col-md-offset-8">
                @foreach($carreras as $carrera)
                    <a href="/indices_repro_prof/excel_indice_rep_prof/{{$carrera->id_carrera}}/{{$id_categoria}}" class="btn btn-success">Exportar concentrado <span class="oi oi-document p-1"></span></a>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-md-8  col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Indices de Reprobación<br><b>@foreach($carreras as $carrera) {{ $carrera->nombre }} @endforeach</b></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-md-offset-2" style="display: none" >
                <div class="dropdown-center">
                    <label for="selectCargo">Carrera</label>
                    <select name="id_carrera" id="id_carrera" class="form-control ">
                        @foreach($carreras as $carrera)
                            <option value="{{$carrera->id_carrera}}" selected="selected" >{{$carrera->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-md-offset-4" >
                <div class="dropdown-center">
                    <label for="selectCargo">Categoria</label>
                    <select name="id_categoria" id="id_categoria" class="form-control ">
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
            <p><br></p>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <?php $i=1; ?>
                        <table class="table table-bordered table-resposive">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Docente</th>
                                <th>Asignatura</th>
                                <th>Grupo</th>
                                <th>Unidades</th>
                                <th>No. estudiantes inscritos</th>
                                <th>Unidad 1</th>
                                <th>Unidad 2</th>
                                <th>Unidad 3</th>
                                <th>Unidad 4</th>
                                <th>Unidad 5</th>
                                <th>Unidad 6</th>
                                <th>Unidad 7</th>
                                <th>Unidad 8</th>
                                <th>Unidad 9</th>
                                <th>Unidad 10</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($array_materias as $materia)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{$materia['profesor'] }}</td>
                                    <td>{{$materia['materia'] }}</td>
                                    <td>{{$materia['id_semestre'].'0'.$materia['grupo'] }}</td>
                                    <td>{{$materia['unidades_mat'] }}</td>
                                    <td>{{$materia['total_estudiantes'] }}</td>
                                    @if($materia['max_unidad'] == 1)
                                        @foreach($materia['unidades'] as $unidades)
                                            <td style="background: lightblue">{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                                        @endforeach
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @elseif($materia['max_unidad'] == 2)
                                        @foreach($materia['unidades'] as $unidades)
                                            <td style="background: lightblue">{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                                        @endforeach
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @elseif($materia['max_unidad'] == 3)
                                        @foreach($materia['unidades'] as $unidades)
                                            <td style="background: lightblue">{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                                        @endforeach
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @elseif($materia['max_unidad'] == 4)
                                        @foreach($materia['unidades'] as $unidades)
                                            <td style="background: lightblue">{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                                        @endforeach
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @elseif($materia['max_unidad'] == 5)
                                        @foreach($materia['unidades'] as $unidades)
                                            <td style="background: lightblue">{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                                        @endforeach
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @elseif($materia['max_unidad'] == 6)
                                        @foreach($materia['unidades'] as $unidades)
                                            <td style="background: lightblue">{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                                        @endforeach
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @elseif($materia['max_unidad'] == 7)
                                        @foreach($materia['unidades'] as $unidades)
                                            <td style="background: lightblue">{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                                        @endforeach
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @elseif($materia['max_unidad'] == 8)
                                        @foreach($materia['unidades'] as $unidades)
                                            <td style="background: lightblue">{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                                        @endforeach
                                        <td></td>
                                        <td></td>
                                    @elseif($materia['max_unidad'] == 9)
                                        @foreach($materia['unidades'] as $unidades)
                                            <td style="background: lightblue">{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                                        @endforeach
                                        <td></td>
                                    @elseif($materia['max_unidad'] == 10)
                                        @foreach($materia['unidades'] as $unidades)
                                            <td style="background: lightblue">{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                                        @endforeach

                                    @else
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @endif

                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    @endif
    <div class="row">
        <p><br></p>
    </div>

    <script type="text/javascript">

        $(document).ready(function() {
            $("#id_carrera").change(function(e){
                var id_carrera= e.target.value;
                window.location.href='/indices_repro_prof/carrera_categoria/'+id_carrera ;

            });

            $("#id_categoria").change(function(e){
                var id_categoria= e.target.value;
                var id_carrera= $("#id_carrera").val();
                window.location.href='/indices_repro_prof/carrera_cat_docente/'+id_carrera+'/'+id_categoria ;

            });

        });
    </script>


@endsection