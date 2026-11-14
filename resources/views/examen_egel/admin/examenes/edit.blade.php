@extends('layouts.app')

@section('content')

<div class="container" style="margin-top: 30px;">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-primary">
                
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="glyphicon glyphicon-pencil"></i> Editar Examen
                    </h3>
                </div>

                <div class="panel-body">

                    <form action="{{ route('admin.examen.update',$examen->id_examen_egel) }}" method="POST">
                        @csrf

                        <!-- Carrera -->
                        <div class="form-group">
                            <label><i class="glyphicon glyphicon-education"></i> Carrera</label>
                            <select name="id_carrera" class="form-control">
                                @foreach($carreras as $c)
                                    <option value="{{ $c->id_carrera }}"
                                        {{ $examen->id_carrera == $c->id_carrera ? 'selected' : '' }}>
                                        {{ $c->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Nombre -->
                        <div class="form-group">
                            <label><i class="glyphicon glyphicon-file"></i> Nombre del examen</label>
                            <input 
                                type="text" 
                                name="nombre" 
                                value="{{ $examen->nombre }}" 
                                class="form-control"
                                placeholder="Ingrese el nombre del examen"
                                required>
                        </div>

                        <hr>

                        <!-- Botones -->
                        <div class="text-right">
                            <a href="{{ route('admin.examenes.index') }}" 
                               class="btn btn-default">
                                <i class="glyphicon glyphicon-arrow-left"></i> Cancelar
                            </a>

                            <button class="btn btn-primary">
                                <i class="glyphicon glyphicon-floppy-disk"></i> Actualizar
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection