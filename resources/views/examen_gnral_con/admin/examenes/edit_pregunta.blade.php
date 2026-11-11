@extends('layouts.app')

@section('content')

<div class="container" style="margin-top:30px;">

  <h3 class="text-primary">
    <span class="glyphicon glyphicon-edit"></span> Editar Pregunta
  </h3>

  <a href="{{ route('admin.examen_general.preguntas', $pregunta->id_examen_egel) }}" class="btn btn-default">
    <span class="glyphicon glyphicon-arrow-left"></span> Regresar
  </a>

  <hr>

  <div class="panel panel-primary">
    <div class="panel-heading">
      <strong>Formulario de edición</strong>
    </div>

    <div class="panel-body">
      <form action="{{ route('admin.examen_general.pregunta.update', $pregunta->id_pregunta) }}" method="POST" class="form-horizontal">
        @csrf

        <!-- Input hidden con el id del examen -->
        <input type="hidden" name="id_examen_egel" value="{{ $pregunta->id_examen_egel }}">

        <!-- Pregunta -->
        <div class="form-group">
  <label class="col-sm-2 control-label">Pregunta</label>
  <div class="col-sm-10">
    <textarea 
      name="pregunta" 
      class="form-control" 
      rows="4"
      placeholder="Escribe la pregunta aquí"
    >{{ $pregunta->pregunta }}</textarea>
  </div>
</div>

        <!-- Módulo -->
        <div class="form-group">
          <label class="col-sm-2 control-label">Módulo</label>
          <div class="col-sm-10">
            <select name="id_modulo" class="form-control">
              @foreach($modulos as $m)
                <option value="{{ $m->id_modulo }}" {{ $m->id_modulo == $pregunta->id_modulo ? 'selected' : '' }}>
                  {{ $m->nombre }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <!-- Número de pregunta -->
        <div class="form-group">
          <label class="col-sm-2 control-label">Número</label>
          <div class="col-sm-10">
            <input type="number" name="numero_pregunta" class="form-control" value="{{ $pregunta->numero_pregunta }}">
          </div>
        </div>

        <!-- Botón -->
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10 text-center">
            <button type="submit" class="btn btn-success btn-lg">
              <span class="glyphicon glyphicon-floppy-disk"></span> Actualizar Pregunta
            </button>
          </div>
        </div>

      </form>
    </div>
  </div>

</div>

@endsection