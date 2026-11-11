@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:30px;">

    <div class="row">
        <div class="col-md-12 text-center">
            <h2 style="font-weight:600; color:#2c3e50;">
                Lista de Alumnos - Licenciatura en Turismo e Ingeniería en Forestal
            </h2>
            <hr style="border-top:2px solid #eee;">
        </div>

        <div class="col-md-6 text-right">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-default pull-left">
                <span class="glyphicon glyphicon-arrow-left"></span> Regresar
            </a>
        </div>    

    </div>
    <br>

    <div class="row">

        <!-- SIN EXAMEN -->
        <div class="col-md-6">
            <div class="panel panel-warning shadow-sm">
                <div class="panel-heading text-center" style="font-size:16px;">
                    <i class="glyphicon glyphicon-time"></i>
                    <strong> Alumnos sin Examen EGEL</strong>
                    <span class="badge pull-right">{{ $alumnos_sin_examen->total() }}</span>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead style="background:#f5f5f5;">
                                <tr>
                                    <th>Nombre</th>
                                    <th>No. Control</th>
                                    <th>Correo</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($alumnos_sin_examen as $alumno)
                                <tr>
                                    <td>{{ $alumno->nombre }} {{ $alumno->apaterno }} {{ $alumno->amaterno }}</td>
                                    <td><span class="label label-default">{{ $alumno->cuenta }}</span></td>
                                    <td style="max-width:150px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                                        {{ $alumno->correo_al ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        Sin registros
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center">
                        {!! $alumnos_sin_examen->appends(request()->query())->links() !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- CON EXAMEN -->
        <div class="col-md-6">
            <div class="panel panel-success shadow-sm">
                <div class="panel-heading text-center" style="font-size:16px;">
                    <i class="glyphicon glyphicon-ok"></i>
                    <strong> Alumnos con Examen EGEL</strong>
                    <span class="badge pull-right">{{ $alumnos_con_examen->total() }}</span>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead style="background:#f5f5f5;">
                                <tr>
                                    <th>Nombre</th>
                                    <th>No. Control</th>
                                    <th>Correo</th>
                                    <th class="text-center">Calificación</th>
                                    <th class="text-center">Nivel</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($alumnos_con_examen as $alumno)
                                <tr>
                                    <td>{{ $alumno->nombre }} {{ $alumno->apaterno }} {{ $alumno->amaterno }}</td>

                                    <td>
                                        <span class="label label-primary">
                                            {{ $alumno->cuenta }}
                                        </span>
                                    </td>

                                    <td style="max-width:150px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                                        {{ $alumno->correo_al ?? '-' }}
                                    </td>

                                    <td class="text-center">
                                        <strong>{{ $alumno->calificacion_general }}</strong>
                                    </td>

                                    <td class="text-center">
                                        @if($alumno->nivel == 'Sobresaliente')
                                            <span class="label label-success">{{ $alumno->nivel }}</span>
                                        @elseif($alumno->nivel == 'Satisfactorio')
                                            <span class="label label-warning">{{ $alumno->nivel }}</span>
                                        @else
                                            <span class="label label-danger">{{ $alumno->nivel }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        Sin registros
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center">
                        {!! $alumnos_con_examen->appends(request()->query())->links() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- ESTILOS EXTRA -->
<style>
.shadow-sm {
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    border-radius: 4px;
}

.panel-heading {
    font-weight: bold;
}

.table th {
    text-align: center;
    font-size: 13px;
}

.table td {
    vertical-align: middle !important;
    font-size: 13px;
}
</style>

@endsection