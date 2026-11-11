@extends('layouts.app')

@section('content')

<style>
  body {
    background-color: #f4f6f9;
  }

  .panel-custom {
    border-radius: 8px;
    border: none;
  }

  .panel-custom>.panel-heading {
    background: #2c3e50;
    color: #fff;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    font-size: 18px;
    padding: 15px;
  }

  .panel-custom>.panel-body {
    padding: 25px;
    background: #fff;
  }

  .form-control {
    border-radius: 6px;
    box-shadow: none;
    border: 1px solid #d2d6de;
  }

  .form-control:focus {
    border-color: #3c8dbc;
    box-shadow: none;
  }

  .btn-success {
    background-color: #27ae60;
    border-color: #27ae60;
    border-radius: 6px;
    padding: 10px 40px;
    font-size: 16px;
  }

  .btn-success:hover {
    background-color: #219150;
    border-color: #1e8449;
  }

  label {
    color: #555;
  }

  textarea {
    resize: vertical;
  }

  #preview {
    padding: 20px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 6px;
    min-height: 150px;
  }

  .ejemplo {
    background: #f8f9fa;
    border-left: 4px solid #3c8dbc;
    padding: 15px;
    margin-bottom: 20px;
    font-size: 13px;
    white-space: pre-line;
  }
</style>

<div class="container" style="margin-top: 40px;">

  <div class="row">
    <div class="col-md-8 col-md-offset-2">

      <div class="panel panel-custom">

        <div class="panel-heading">
          <i class="glyphicon glyphicon-edit"></i> Cargar Examen Rápido
        </div>

        <div class="panel-body">

          <form method="POST" action="{{ route('admin.examen_general.guardarRapido') }}">
            @csrf

            {{-- ID EXAMEN OCULTO --}}
            <input type="hidden" name="id_examen_egel" value="{{ $examen->id_examen_egel }}">

            {{-- CARRERA --}}
            <div class="form-group">
              <label><strong>Carrera</strong></label>
              <input type="text" class="form-control" value="{{ $examen->carrera }}" readonly>
              <input type="hidden" name="id_carrera" value="{{ $examen->id_carrera }}">
            </div>

            {{-- NOMBRE --}}
            <div class="form-group">
              <label><strong>Nombre del examen</strong></label>
              <input type="text" name="nombre" class="form-control" value="{{ $examen->nombre }}">
            </div>

            {{-- SECCIÓN --}}
            <div class="form-group">
              <label><strong>Sección</strong></label>
              <input type="text" name="seccion" class="form-control" placeholder="Ej: Área 1">
            </div>

            {{-- MÓDULO --}}
            <div class="form-group">
              <label><strong>Módulo</strong></label>
              <input type="text" name="modulo" class="form-control" placeholder="Ej: Legislación">
            </div>

            {{-- EJEMPLO --}}
            <div class="ejemplo">
Ejemplo con fórmula matemática:

39.- Lee el caso y responde. Un hotel tiene 50 habitaciones y 35 están ocupadas.

$$
\frac{35}{50}\times100
$$

A) 60%
B) 65%
C) 70% *
D) 75%
            </div>

            {{-- PREGUNTAS --}}
            <div class="form-group">
              <label><strong>Preguntas</strong></label>

              <textarea 
                name="contenido" 
                id="contenido"
                rows="15" 
                class="form-control"
                placeholder="Escribe preguntas usando fórmulas LaTeX..."
              ></textarea>
            </div>

            {{-- VISTA PREVIA --}}
            <div class="form-group">
              <label><strong>Vista previa</strong></label>

              <div id="preview"></div>
            </div>

            {{-- BOTÓN --}}
            <div class="text-center">
              <button class="btn btn-success btn-lg">
                <i class="glyphicon glyphicon-floppy-disk"></i> Guardar
              </button>
            </div>

          </form>

        </div>

      </div>

    </div>
  </div>

</div>

{{-- MATHJAX --}}
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

{{-- PREVIEW EN VIVO --}}
<script>

const textarea = document.getElementById('contenido');
const preview = document.getElementById('preview');

textarea.addEventListener('input', function () {

    preview.innerHTML = this.value.replace(/\n/g, '<br>');

    if (window.MathJax) {
        MathJax.typesetPromise([preview]);
    }

});

</script>

@endsection