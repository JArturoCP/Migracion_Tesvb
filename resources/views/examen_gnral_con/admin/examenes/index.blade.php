@extends('layouts.app')

@section('content')

<style>
.shadow-panel{
    border:0;
    box-shadow:0 2px 8px rgba(0,0,0,.1);
}

.table-header{
    background:#34495e;
    color:#fff;
}

.table-header th{
    font-weight:600;
    font-size:13px;
}

.btn-group .btn{
    margin-right:2px;
    border-radius:3px !important;
}

.label-primary{
    background:#3498db;
}
</style>

<div class="container" style="margin-top:30px;">

    <!-- ENCABEZADO -->
    <div class="row" style="margin-bottom:15px;">

        <div class="col-md-6">
            <h3 class="text-primary" style="margin-top:5px;">
                <span class="glyphicon glyphicon-book"></span>
                Exámenes de Conocimientos Generales
            </h3>
        </div>

        <div class="col-md-6 text-right">

        <a href="{{ url()->previous() }}" class="btn btn-default">
            <span class="glyphicon glyphicon-arrow-left"></span>Regresar 
        </a>
            <a href="{{ route('admin.examen_general.create') }}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Nuevo Examen
            </a>

        </div>

    </div>

    <!-- PANEL -->
    <div class="panel panel-default shadow-panel">

        <div class="panel-heading">
            <strong>Listado de exámenes</strong>
        </div>

        <div class="panel-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover table-striped text-center table-condensed">

                    <thead class="table-header">
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
                                <span class="label label-primary">
                                    {{ $e->carrera }}
                                </span>
                            </td>

                            <td>{{ $e->nombre }}</td>

                            <td>
                                <div class="btn-group btn-group-sm">

                                    <a href="{{ route('admin.examen_general.edit',$e->id_examen_egel) }}" 
                                       class="btn btn-warning" title="Editar">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>

                                    <a href="{{ route('admin.examen_general.delete',$e->id_examen_egel) }}" 
                                       class="btn btn-danger"
                                       onclick="return confirm('¿Seguro que deseas eliminar este examen?')"
                                       title="Eliminar">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>

                                    <a href="{{ route('admin.examen_general.rapido', $e->id_examen_egel) }}" 
                                       class="btn btn-success" title="Carga rápida">
                                        <span class="glyphicon glyphicon-flash"></span>
                                    </a>

                                    <a href="{{ route('admin.examen_general.preguntas', $e->id_examen_egel) }}" 
                                       class="btn btn-info" title="Ver preguntas">
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