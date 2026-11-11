@extends('layouts.app')

@section('content')

<div class="container" style="margin-top:30px;">

    <!-- Encabezado -->
    <div class="row">
        <div class="col-md-6">
            <h3 class="text-primary">
                <span class="glyphicon glyphicon-book"></span>
                Exámenes EGEL
            </h3>
        </div>

        <div class="col-md-6 text-right">
            <a href="{{ route('admin.examen.create') }}" 
               class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Nuevo Examen
            </a>
        </div>

        <div class="col-md-6 text-right">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-default pull-right">
                <span class="glyphicon glyphicon-arrow-left"></span> Regresar
            </a>
        </div>    

    </div>

    <hr>

    <!-- Panel -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>Listado de exámenes</strong>
        </div>

        <div class="panel-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped text-center">

                    <thead style="background-color:#2c3e50; color:white;">
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Carrera</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center" width="280">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($examenes as $e)
                        <tr>

                            <td><strong>{{ $e->id_examen_egel }}</strong></td>

                            <td>
                                <span class="label label-info">
                                    {{ $e->carrera }}
                                </span>
                            </td>

                            <td>{{ $e->nombre }}</td>

                            <td>
                                <div class="btn-group">

                                    <a href="{{ route('admin.examen.edit',$e->id_examen_egel) }}" 
                                       class="btn btn-warning btn-sm">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>

                                    <a href="{{ route('admin.examen.delete',$e->id_examen_egel) }}" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('¿Seguro que deseas eliminar este examen?')">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>

                                    <a href="{{ route('admin.examen.rapido', $e->id_examen_egel) }}" 
                                       class="btn btn-success btn-sm">
                                        <span class="glyphicon glyphicon-flash"></span>
                                    </a>

                                    <!-- NUEVO BOTÓN -->
                                    <a href="{{ route('admin.examen.preguntas', $e->id_examen_egel) }}" 
                                    class="btn btn-info btn-sm" title="Ver preguntas">
                                        <span class="glyphicon glyphicon-list-alt"></span>
                                    </a>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

@endsection