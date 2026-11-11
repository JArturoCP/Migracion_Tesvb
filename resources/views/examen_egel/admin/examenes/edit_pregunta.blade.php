@extends('layouts.app')
@section('title', 'Editar Preguntas')
@section('content')

<div class="container" style="margin-top:30px;">

    <!-- HEADER -->
    <div style="
        background: linear-gradient(135deg,#2c3e50,#337ab7);
        color:white;
        padding:15px 18px;
        border-radius:6px;
        margin-bottom:15px;
        box-shadow:0 2px 6px rgba(0,0,0,0.15);
    ">
        <h4 style="margin:0;">
            <span class="glyphicon glyphicon-edit"></span>
            Editar Pregunta
        </h4>
    </div>

    <a href="{{ route('admin.examen.preguntas', $pregunta->id_examen_egel) }}"
       class="btn btn-default"
       style="margin-bottom:15px;">
        <span class="glyphicon glyphicon-arrow-left"></span>
        Regresar
    </a>

    <!-- PANEL -->
    <div class="panel panel-primary" style="border-radius:6px; overflow:hidden;">

        <div class="panel-heading" style="background:#34495e; border-color:#34495e;">
            <strong>Formulario de edición</strong>
        </div>

        <div class="panel-body" style="background:#f8f9fa;">

            <form action="{{ route('admin.pregunta.update', $pregunta->id_pregunta) }}"
                  method="POST"
                  class="form-horizontal">

                @csrf

                <!-- ID EXAMEN -->
                <input type="hidden" name="id_examen_egel" value="{{ $pregunta->id_examen_egel }}">

                <!-- PREGUNTA -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        <span class="glyphicon glyphicon-pencil"></span> Pregunta
                    </label>
                    <div class="col-sm-10">
                        <textarea name="pregunta"
                                  class="form-control"
                                  rows="4"
                                  placeholder="Escribe la pregunta aquí"
                                  style="resize:none;">{{ $pregunta->pregunta }}</textarea>
                    </div>
                </div>

                <!-- MÓDULO -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        <span class="glyphicon glyphicon-book"></span> Módulo
                    </label>
                    <div class="col-sm-10">
                        <select name="id_modulo" class="form-control">
                            @foreach($modulos as $m)
                                <option value="{{ $m->id_modulo }}"
                                    {{ $m->id_modulo == $pregunta->id_modulo ? 'selected' : '' }}>
                                    {{ $m->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- NÚMERO -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        <span class="glyphicon glyphicon-sort-by-order"></span> Número
                    </label>
                    <div class="col-sm-10">
                        <input type="number"
                               name="numero_pregunta"
                               class="form-control"
                               value="{{ $pregunta->numero_pregunta }}">
                    </div>
                </div>

                <!-- BOTÓN -->
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10 text-center">

                        <button type="submit"
                                class="btn btn-success btn-lg"
                                style="border-radius:6px; padding:10px 25px;">

                            <span class="glyphicon glyphicon-floppy-disk"></span>
                            Actualizar Pregunta

                        </button>

                    </div>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection