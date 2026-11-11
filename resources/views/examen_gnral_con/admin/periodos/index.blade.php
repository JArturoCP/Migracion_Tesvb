@extends('layouts.app')

@section('content')

<style>
    body {
        background: #f4f6f9;
    }

    .panel {
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        border: none;
    }

    .panel-heading {
        font-size: 16px;
        font-weight: 600;
        border-radius: 12px 12px 0 0;
    }

    .panel-primary .panel-heading {
        background: linear-gradient(45deg, #337ab7, #5bc0de);
        color: #fff;
    }

    .panel-success .panel-heading {
        background: linear-gradient(45deg, #5cb85c, #4cae4c);
        color: #fff;
    }

    .form-control {
        border-radius: 8px;
        box-shadow: none;
        border: 1px solid #ddd;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        border-color: #337ab7;
        box-shadow: 0 0 6px rgba(51,122,183,0.3);
    }

    .btn-lg {
        border-radius: 30px;
        padding: 10px 22px;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background: linear-gradient(45deg, #337ab7, #286090);
        border: none;
        color: #fff;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    }

    .btn-warning {
        background: linear-gradient(45deg, #f0ad4e, #ec971f);
        border: none;
        color: #fff;
    }

    .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    }

    .btn-danger {
        background: linear-gradient(45deg, #d9534f, #c9302c);
        border: none;
        color: #fff;
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    }

    .btn-icon {
        width: 42px;
        height: 42px;
        padding: 0;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin: 0 5px;
    }

    .btn-icon:hover {
        opacity: 0.85;
    }

    form.inline-form {
        display: inline-block;
        margin: 0;
    }
</style>

<div class="container" style="margin-top:30px;">

    <!-- Encabezado -->
    <div class="row">
        <div class="col-md-6">
            <h3 class="text-primary">
                <span class="glyphicon glyphicon-calendar"></span>
                Configuración de Periodos Examen de Conocimientos Generales
            </h3>
        </div>

        <div class="col-md-6 text-right">
            <a href="{{ url()->previous() }}"  class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-arrow-left"></span> Regresar
            </a>
        </div>
    </div>

    <hr>

    <!-- Mensajes -->
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul style="margin-bottom:0;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORMULARIO -->
    <div class="panel panel-default">
        <div class="panel-heading text-center"><strong>Definir nuevo periodo</strong></div>
        <div class="panel-body">
            <form action="{{ route('admin.examen_general.periodos.guardar') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nombre del periodo</label>
                    <input type="text" name="periodo" class="form-control" required>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading text-center"><strong>Periodo de Aplicación</strong></div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Inicio</label>
                                    <input type="date" name="periodo_examen_inicio" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Fin</label>
                                    <input type="date" name="periodo_examen_fin" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="panel panel-success">
                            <div class="panel-heading text-center"><strong>Publicación de Resultados</strong></div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Inicio</label>
                                    <input type="date" name="periodo_resultado_inicio" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Fin</label>
                                    <input type="date" name="periodo_resultado_fin" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="text-center" style="margin-bottom:15px;">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-floppy-disk"></span> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <hr>

    <!-- HISTORIAL -->
    <div class="row">

        <!-- Periodos de aplicación -->
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">Historial - Periodos de Aplicación</div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover text-center">
                        <thead>
                            <tr>
                                <th class="text-center">Periodo</th>
                                <th class="text-center">Inicio</th>
                                <th class="text-center">Fin</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($examen_gnral_periodo as $p)
                                <tr>
                                    <td>{{ $p->periodo }}</td>
                                    <td>{{ $p->fecha_inicio }}</td>
                                    <td>{{ $p->fecha_fin }}</td>
                                    <td style="display:flex; justify-content:center; gap:10px;">
                                        <a href="{{ route('admin.examen_general.periodos.edit', $p->id_periodo_examen) }}"
                                           class="btn btn-warning btn-lg" title="Editar"> <span class="glyphicon glyphicon-edit"></span></a>

                                        <form action="{{ route('admin.examen_general.periodos.destroy', $p->id_periodo_examen) }}"
                                              method="POST" class="inline-form">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-lg" title="Eliminar"
                                                    onclick="return confirm('¿Deseas eliminar este periodo?')">
                                                 <span class="glyphicon glyphicon-trash"></span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Periodos de resultados -->
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading text-center">Historial - Resultados</div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover text-center">
                        <thead>
                            <tr>
                                <th class="text-center">Periodo</th>
                                <th class="text-center">Inicio</th>
                                <th class="text-center">Fin</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($examen_periodo_resultados as $p)
                                <tr>
                                    <td>{{ $p->periodo }}</td>
                                    <td>{{ $p->fecha_inicio }}</td>
                                    <td>{{ $p->fecha_fin }}</td>
                                    <td style="display:flex; justify-content:center; gap:10px;">
                                        <a href="{{ route('admin.examen_general.periodos.edit', $p->id_periodo_examen) }}"
                                           class="btn btn-warning btn-lg" title="Editar"> <span class="glyphicon glyphicon-edit"></span></a>

                                        <form action="{{ route('admin.examen_general.periodos.destroy', $p->id_periodo_examen) }}"
                                              method="POST" class="inline-form">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-lg" title="Eliminar"
                                                    onclick="return confirm('¿Deseas eliminar este periodo?')">
                                                 <span class="glyphicon glyphicon-trash"></span>
                                            </button>
                                        </form>
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

@endsection