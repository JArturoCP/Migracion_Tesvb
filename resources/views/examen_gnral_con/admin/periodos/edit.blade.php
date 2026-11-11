@extends('layouts.app')
@section('content')

<div class="main">
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
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    }

    .btn-danger {
        background: linear-gradient(45deg, #d9534f, #c9302c);
        border: none;
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    }


</style>

<div class="container" style="margin-top:30px;">

    <!-- Encabezado -->
    <div class="row">
        <div class="row">
        <div class="col-md-6">
            <div class="title-box">
                <h3 class="text-primary" style="margin:0;">
                    <span class="glyphicon glyphicon-calendar"></span>
                    Editar Periodo Examen de Conocimientos Generales
                </h3>
            </div>
        </div>

        <div class="col-md-6 text-right">
            <a href="{{ route('admin.examen_general.periodos.index') }}" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-arrow-left"></span>
                Regresar
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

    <!-- PANEL -->
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Actualizar periodo
        </div>

        <div class="panel-body">

            <form action="{{ route('admin.examen_general.periodos.update', $examen_gnral_periodo->id_periodo_examen) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nombre del periodo</label>
                    <input type="text" name="periodo" class="form-control"
                           value="{{ $examen_gnral_periodo->periodo }}" required>
                </div>

                <div class="row">

                    <!-- Aplicación -->
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading text-center">
                                Periodo de Aplicación
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Inicio</label>
                                    <input type="date" name="periodo_examen_inicio"
                                           class="form-control"
                                           value="{{ \Carbon\Carbon::parse($examen_gnral_periodo->fecha_inicio)->format('Y-m-d') }}"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label>Fin</label>
                                    <input type="date" name="periodo_examen_fin"
                                           class="form-control"
                                           value="{{ \Carbon\Carbon::parse($examen_gnral_periodo->fecha_fin)->format('Y-m-d') }}"
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Resultados -->
                    <div class="col-md-6">
                        <div class="panel panel-success">
                            <div class="panel-heading text-center">
                                Publicación de Resultados
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Inicio</label>
                                    <input type="date" name="periodo_resultado_inicio"
                                           class="form-control"
                                           value="{{ \Carbon\Carbon::parse($examen_periodo_resultados->fecha_inicio)->format('Y-m-d') }}"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label>Fin</label>
                                    <input type="date" name="periodo_resultado_fin"
                                           class="form-control"
                                           value="{{ \Carbon\Carbon::parse($examen_periodo_resultados->fecha_fin)->format('Y-m-d') }}"
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- BOTONES -->
                <div style="margin-top:25px; display:flex; justify-content:center; gap:15px;">

                    <!-- GUARDAR -->
                    <button type="submit" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-save"></span>
                    </button>

            </form>

                    <!-- ELIMINAR -->
                    <form action="{{ route('admin.examen_general.periodos.destroy', $examen_gnral_periodo->id_periodo_examen) }}"
                          method="POST"
                          onsubmit="return confirm('¿Deseas eliminar este periodo?')">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-lg">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </form>

                </div>

        </div>
    </div>

</div>

</div>

@endsection 