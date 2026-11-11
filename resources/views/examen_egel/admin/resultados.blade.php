@extends('layouts.app')

@section('content')

<div class="container" style="margin-top:30px;">

    <!-- Encabezado -->
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-primary">
                <span class="glyphicon glyphicon-stats"></span>
                Resultados EGEL
            </h3>
        </div>
    </div>

    <hr>

    <div class="row">

        <!-- COLUMNA TURISMO -->
        <div class="col-md-6">

            <div class="panel panel-primary">
                <div class="panel-heading clearfix">
                    <strong>Turismo</strong>

                    <a href="{{ route('admin.egel.pdf', ['carrera' => 'turismo']) }}" 
                       class="btn btn-warning btn-xs pull-right">
                        <span class="glyphicon glyphicon-download"></span>
                        PDF
                    </a>
                </div>

                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped text-center">

                            <thead style="background-color:#2c3e50; color:white;">
                                <tr>
                                    <th>No Control</th>
                                    <th>Alumno</th>
                                    <th>Calificación</th>
                                    <th>Nivel</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($alumnos->where('id_carrera', '8') as $a)
                                <tr>
                                    <td><strong>{{ $a->cuenta }}</strong></td>
                                    <td>{{ $a->nombre }} {{ $a->apaterno }} {{ $a->amaterno }}</td>
                                    <td>
                                        <span class="label label-primary">
                                            {{ $a->calificacion_general }}%
                                        </span>
                                    </td>
                                    <td>
                                        @if($a->nivel == 'Sobresaliente')
                                            <span class="label label-success">Sobresaliente</span>
                                        @elseif($a->nivel == 'Satisfactorio')
                                            <span class="label label-info">Satisfactorio</span>
                                        @else
                                            <span class="label label-default">{{ $a->nivel }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

        </div>

        <!-- COLUMNA FORESTAL -->
        <div class="col-md-6">

            <div class="panel panel-success">
                <div class="panel-heading clearfix">
                    <strong>Forestal</strong>

                    <a href="{{ route('admin.egel.pdf', ['carrera' => 'forestal']) }}" 
                       class="btn btn-warning btn-xs pull-right">
                        <span class="glyphicon glyphicon-download"></span>
                        PDF
                    </a>
                </div>

                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped text-center">

                            <thead style="background-color:#2c3e50; color:white;">
                                <tr>
                                    <th>No Control</th>
                                    <th>Alumno</th>
                                    <th>Calificación</th>
                                    <th>Nivel</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($alumnos->where('id_carrera', '6') as $a)
                                <tr>
                                    <td><strong>{{ $a->cuenta }}</strong></td>
                                    <td>{{ $a->nombre }} {{ $a->apaterno }} {{ $a->amaterno }}</td>
                                    <td>
                                        <span class="label label-primary">
                                            {{ $a->calificacion_general }}%
                                        </span>
                                    </td>
                                    <td>
                                        @if($a->nivel == 'Sobresaliente')
                                            <span class="label label-success">Sobresaliente</span>
                                        @elseif($a->nivel == 'Satisfactorio')
                                            <span class="label label-info">Satisfactorio</span>
                                        @else
                                            <span class="label label-default">{{ $a->nivel }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <!-- Botón regresar -->
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-arrow-left"></span>
                Regresar
            </a>
        </div>
    </div>

<br>
<br>

</div>

@endsection