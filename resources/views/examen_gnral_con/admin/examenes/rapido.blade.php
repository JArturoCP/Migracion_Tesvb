@extends('layouts.panel')

@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

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

<x-panel.encabezado titulo="Cargar Examen Rápido" :migas="['Examen general de conocimientos' => null]" />
    <div class="tw:w-full" style="margin-top: 40px;">

  <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">

      <div class="panel-custom tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

        

        <div class="tw:p-5 tw:sm:p-6">

          <form method="POST" action="{{ route('admin.examen_general.guardarRapido') }}">
            @csrf

            {{-- ID EXAMEN OCULTO --}}
            <input type="hidden" name="id_examen_egel" value="{{ $examen->id_examen_egel }}">

            {{-- CARRERA --}}
            <div class="tw:mb-4">
              <label><strong>Carrera</strong></label>
              <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" value="{{ $examen->carrera }}" readonly>
              <input type="hidden" name="id_carrera" value="{{ $examen->id_carrera }}">
            </div>

            {{-- NOMBRE --}}
            <div class="tw:mb-4">
              <label><strong>Nombre del examen</strong></label>
              <input type="text" name="nombre" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" value="{{ $examen->nombre }}">
            </div>

            {{-- SECCIÓN --}}
            <div class="tw:mb-4">
              <label><strong>Sección</strong></label>
              <input type="text" name="seccion" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Ej: Área 1">
            </div>

            {{-- MÓDULO --}}
            <div class="tw:mb-4">
              <label><strong>Módulo</strong></label>
              <input type="text" name="modulo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Ej: Legislación">
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
            <div class="tw:mb-4">
              <label><strong>Preguntas</strong></label>

              <textarea 
                name="contenido" 
                id="contenido"
                rows="15" 
                class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"
                placeholder="Escribe preguntas usando fórmulas LaTeX..."
              ></textarea>
            </div>

            {{-- VISTA PREVIA --}}
            <div class="tw:mb-4">
              <label><strong>Vista previa</strong></label>

              <div id="preview"></div>
            </div>

            {{-- BOTÓN --}}
            <div class="tw:text-center">
              <button class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
                <i class="fa fa-floppy-o"></i> Guardar
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

</div>
@endsection