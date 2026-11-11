@extends('layouts.app')
@section('title', 'Distribución de hrs del profesor')
@section('content')

    <main class="col-md-12">
        <div class="row">
            <div class="col-md-10 col-xs-10 col-md-offset-1">
                <p>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="{{url("/distribucion_horas_profesores/profesores_categoria/".$id_categoria)}}">Docentes</a>
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span>Distribución de horas del docente</span>

                </p>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading text-center">
                        <h3 >Distribución de horas del docente<br><br>Perfil: {{ $profesor->perfil }} <br>Nombre del docente: {{ $profesor->titulo }} {{ $profesor->nombre }}<br>Categoria: {{ $profesor->cargo }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php $i=1; ?>
                <table class="table table-bordered table-resposive">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Programa de Estudios</th>
                        <th>Asignatura</th>
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
                            <td>{{$materia['materia'] }}</td>
                            <td>{{$materia['horas_totales']  }}</td>
                            <td>{{$materia['total_grupos']  }}</td>
                            <td>{{$materia['total_horas_grupos']  }}</td>
                            <?php $suma+=$materia['total_horas_grupos']; ?>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>Total de horas de asignaturas</b></td>
                        @if($suma <=19)
                        <td>{{ $suma }}</td>
                        @else
                            <td style="background: lightblue; color: #0c0c0c"><h4>{{ $suma }}</h4><br></td>
                        @endif
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </main>


    <script type="text/javascript">

        $(document).ready(function() {
            $("#tabla_empresa").DataTable();
            $("#tabla_empresa").on('click','.ver_materia',function(){
                var id_personal=$(this).data("id");
                window.location.href='/distribucion_horas_profesores/materias/'+id_personal ;
            });
        });
    </script>
@endsection