@extends('layouts.app')

@section('content')

<div class="container" style="margin-top: 40px; max-width: 600px;">

    <div class="panel panel-primary">
        <div class="panel-heading text-center">
            <h4><strong>Nuevo Examen</strong></h4>
        </div>

        <div class="panel-body">

            <form action="{{ route('admin.examen.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label><i class="glyphicon glyphicon-education"></i> Carrera</label>
                    <select name="id_carrera" class="form-control">
                        @foreach($carreras as $c)
                            <option value="{{ $c->id_carrera }}">{{ $c->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label><i class="glyphicon glyphicon-pencil"></i> Nombre del examen</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Ej. Examen Final Matemáticas" required>
                </div>

                <hr>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">
                        <i class="glyphicon glyphicon-floppy-disk"></i> Guardar
                    </button>
                    <a href="{{ url()->previous() }}" class="btn btn-default">
                        <i class="glyphicon glyphicon-arrow-left"></i> Cancelar
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection