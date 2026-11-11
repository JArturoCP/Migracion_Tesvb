@extends('layouts.app')

@section('content')

<div class="container" style="margin-top: 50px;">

    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-primary" style="border-radius: 6px; overflow: hidden;">

                <div class="panel-heading text-center" style="background: #337ab7; color: #fff;">
                    <h4 style="margin: 5px 0;">
                        <i class="glyphicon glyphicon-education"></i>
                        Nuevo Examen
                    </h4>
                    <small style="opacity: 0.9;">Registro de examen académico</small>
                </div>

                <div class="panel-body" style="background: #f9f9f9;">

                    <form action="{{ route('admin.examen_general.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label style="color:#333;">
                                <i class="glyphicon glyphicon-list-alt"></i> Nombre de la Carrera
                            </label>

                            <select name="id_carrera" class="form-control" required>
                                <option value="">-- Selecciona una carrera --</option>

                                @foreach($carreras as $c)
                                    <option value="{{ $c->id_carrera }}">
                                        {{ $c->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label style="color:#333;">
                                <i class="glyphicon glyphicon-pencil"></i> Nombre del examen
                            </label>

                            <input type="text"
                                   name="nombre"
                                   class="form-control"
                                   placeholder="Ej. Examen Final Matemáticas"
                                   required>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-xs-6">
                                <a href="{{ url()->previous() }}" class="btn btn-default btn-block">
                                    <i class="glyphicon glyphicon-arrow-left"></i> Cancelar
                                </a>
                            </div>

                            <div class="col-xs-6">
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="glyphicon glyphicon-floppy-disk"></i> Guardar
                                </button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection