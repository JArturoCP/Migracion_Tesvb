@extends('layouts.app')

@section('content')

<div class="container" style="margin-top:30px;">

  <h3 class="text-primary">
    <span class="glyphicon glyphicon-edit"></span> Editar Respuesta
  </h3>

  <a href="{{ route('admin.examen.preguntas', $respuesta->id_examen_egel) }}" class="btn btn-default">
    <span class="glyphicon glyphicon-arrow-left"></span> Regresar
  </a>

  <hr>

  <div class="panel panel-primary">
    <div class="panel-heading">
      <strong>Editar Respuesta de la Pregunta: {{ $respuesta->numero_pregunta }}</strong>
    </div>

    <div class="panel-body">
      <form action="{{ route('admin.respuesta.update', $respuesta->id_respuesta) }}" method="POST" class="form-horizontal">
        @csrf

        <!-- Id del examen para redirección -->
        <input type="hidden" name="id_examen_egel" value="{{ $respuesta->id_examen_egel }}">

        <!-- Respuesta -->
        <div class="form-group">
          <label class="col-sm-2 control-label">Respuesta</label>
          <div class="col-sm-10">
            <input type="text" name="respuesta" class="form-control" value="{{ $respuesta->respuesta }}" placeholder="Escribe la respuesta aquí">
          </div>
        </div>

        <!-- Correcta -->
        <div class="form-group">
          <label class="col-sm-2 control-label">¿Es Correcta?</label>
          <div class="col-sm-10">
            <select name="es_correcta" class="form-control">
              <option value="1" {{ $respuesta->es_correcta == 1 ? 'selected' : '' }}>Sí</option>
              <option value="0" {{ $respuesta->es_correcta == 0 ? 'selected' : '' }}>No</option>
            </select>
          </div>
        </div>

        <!-- Botón de Actualizar -->
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10 text-center">
            <button type="submit" class="btn btn-success btn-lg">
              <span class="glyphicon glyphicon-floppy-disk"></span> Actualizar Respuesta
            </button>
          </div>
        </div>
      </form>

      <hr>

    </div>
  </div>

</div>

@endsection