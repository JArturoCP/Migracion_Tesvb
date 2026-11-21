@extends('layouts.panel')
@section('title', 'Cargar Examen Rápido')
@include('partials.panel.recursos_app')
@section('content')

<main class="tw-pantalla tw:mx-auto tw:max-w-4xl">
  <x-panel.encabezado titulo="Cargar Examen Rápido" :migas="['Examen EGEL' => route('admin.dashboard'), 'Exámenes' => route('admin.examenes.index')]" />

  <x-panel.tarjeta>

    <form method="POST" action="{{ route('admin.examen.guardarRapido') }}" class="tw:space-y-5">
      @csrf

      {{-- ID EXAMEN OCULTO --}}
      <input type="hidden" name="id_examen_egel" value="{{ $examen->id_examen_egel }}">

      <div class="tw:grid tw:gap-5 tw:sm:grid-cols-2">
        {{-- CARRERA --}}
        <div>
          <x-panel.input etiqueta="Carrera" type="text" id="carrera" value="{{ $examen->carrera }}" readonly class="tw:bg-gray-50 tw:dark:bg-white/[0.03]" />
          <input type="hidden" name="id_carrera" value="{{ $examen->id_carrera }}">
        </div>

        {{-- NOMBRE --}}
        <x-panel.input etiqueta="Nombre del examen" type="text" name="nombre" id="nombre" value="{{ $examen->nombre }}" />

        {{-- SECCIÓN --}}
        <x-panel.input etiqueta="Sección" type="text" name="seccion" id="seccion" placeholder="Ej: Área 1" />

        {{-- MÓDULO --}}
        <x-panel.input etiqueta="Módulo" type="text" name="modulo" id="modulo" placeholder="Ej: Legislación" />
      </div>

      {{-- EJEMPLO --}}
      <div class="tw:whitespace-pre-line tw:rounded-xl tw:border-l-4 tw:border-brand-500 tw:bg-gray-50 tw:p-4 tw:text-[13px] tw:text-gray-700 tw:dark:bg-white/[0.03] tw:dark:text-gray-300">
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
      <x-panel.textarea etiqueta="Preguntas" name="contenido" id="contenido" rows="15" class="tw:resize-y"
        placeholder="Escribe preguntas usando fórmulas LaTeX..."></x-panel.textarea>

      {{-- VISTA PREVIA --}}
      <div>
        <x-panel.etiqueta>Vista previa</x-panel.etiqueta>

        <div id="preview" class="tw:min-h-[150px] tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:p-5 tw:text-sm tw:text-gray-800 tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-white/90" aria-live="polite"></div>
      </div>

      {{-- BOTÓN --}}
      <div class="tw:flex tw:justify-end tw:border-t tw:border-gray-100 tw:pt-5 tw:dark:border-gray-800">
        <x-panel.boton type="submit" variante="exito" tamano="lg">
          <span class="fa fa-floppy-o" aria-hidden="true"></span> Guardar
        </x-panel.boton>
      </div>

    </form>

  </x-panel.tarjeta>
</main>

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
