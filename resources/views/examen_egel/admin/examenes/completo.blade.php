@extends('layouts.panel')
@section('title', 'Crear Examen Completo')
@include('partials.panel.recursos_app')
@section('content')

@php
    // Clases del campo de la plantilla (las usa también el script que agrega secciones, módulos y preguntas).
    $campo = 'tw:h-11 tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-white/90';
@endphp

<main class="tw-pantalla">
    <x-panel.encabezado titulo="Crear Examen Completo" :migas="['Examen EGEL' => route('admin.dashboard'), 'Exámenes' => route('admin.examenes.index')]" />

    <form action="{{ route('admin.examen.guardarCompleto') }}" method="POST">
        @csrf

        <!-- EXAMEN -->
        <x-panel.tarjeta titulo="Datos del Examen" class="tw:mb-4">
            <div class="tw:grid tw:gap-4 tw:sm:grid-cols-2">

                <select name="id_carrera" class="{{ $campo }}" aria-label="Carrera">
                    @foreach($carreras as $c)
                        <option value="{{ $c->id_carrera }}">{{ $c->nombre }}</option>
                    @endforeach
                </select>

                <input type="text" name="nombre_examen" class="{{ $campo }}" placeholder="Nombre del examen" aria-label="Nombre del examen">

            </div>
        </x-panel.tarjeta>

        <!-- SECCIONES -->
        <div id="secciones" class="tw:space-y-4"></div>

        <x-panel.boton variante="contorno-primario" class="tw:mt-4" onclick="agregarSeccion()">+ Sección</x-panel.boton>

        <div class="tw:mt-6 tw:flex tw:justify-end tw:border-t tw:border-gray-200 tw:pt-5 tw:dark:border-gray-800">
            <x-panel.boton type="submit" variante="exito">Guardar TODO</x-panel.boton>
        </div>

    </form>
</main>

@push('scripts')
<script>

const campo = @json($campo);
const boton = 'tw:inline-flex tw:items-center tw:justify-center tw:gap-1.5 tw:rounded-lg tw:px-3 tw:py-2 tw:text-sm tw:font-medium tw:transition';

let indexSeccion = 0;

function agregarSeccion() {

    let html = `
    <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-4 tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
        <input type="text" name="secciones[${indexSeccion}][nombre]"
        placeholder="Nombre sección" class="${campo} tw:mb-3">

        <div id="modulos_${indexSeccion}" class="tw:space-y-3"></div>

        <button type="button" onclick="agregarModulo(${indexSeccion})"
        class="${boton} tw:mt-3 tw:bg-sky-500 tw:text-white tw:hover:bg-sky-600">+ Módulo</button>
    </div>
    `;

    document.getElementById('secciones').insertAdjacentHTML('beforeend', html);

    indexSeccion++;
}

function agregarModulo(sec) {

    let indexModulo = document.querySelectorAll(`#modulos_${sec} .modulo`).length;

    let html = `
    <div class="modulo tw:rounded-xl tw:border tw:border-gray-200 tw:bg-gray-50 tw:p-3 tw:dark:border-gray-800 tw:dark:bg-white/[0.02]">

        <input type="text" name="secciones[${sec}][modulos][${indexModulo}][nombre]"
        placeholder="Nombre módulo" class="${campo} tw:mb-3">

        <div id="preguntas_${sec}_${indexModulo}" class="tw:space-y-3"></div>

        <button type="button" onclick="agregarPregunta(${sec},${indexModulo})"
        class="${boton} tw:mt-3 tw:bg-amber-500 tw:text-white tw:hover:bg-amber-600">+ Pregunta</button>

    </div>
    `;

    document.getElementById(`modulos_${sec}`).insertAdjacentHTML('beforeend', html);
}

function agregarPregunta(sec, mod) {

    let indexPregunta = document.querySelectorAll(`#preguntas_${sec}_${mod} .pregunta`).length;

    let html = `
    <div class="pregunta tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white tw:p-3 tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">

        <input type="text"
        name="secciones[${sec}][modulos][${mod}][preguntas][${indexPregunta}][pregunta]"
        placeholder="Pregunta" class="${campo} tw:mb-3">

        <div id="respuestas_${sec}_${mod}_${indexPregunta}" class="tw:space-y-2"></div>

        <button type="button"
        onclick="agregarRespuesta(${sec},${mod},${indexPregunta})"
        class="${boton} tw:mt-3 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700">
        + Respuesta
        </button>

    </div>
    `;

    document.getElementById(`preguntas_${sec}_${mod}`)
    .insertAdjacentHTML('beforeend', html);
}

function agregarRespuesta(sec, mod, pre) {

    let indexResp = document.querySelectorAll(`#respuestas_${sec}_${mod}_${pre} .respuesta`).length;

    let html = `
    <div class="respuesta tw:flex tw:items-center tw:gap-3">

        <input type="text"
        name="secciones[${sec}][modulos][${mod}][preguntas][${pre}][respuestas][${indexResp}][texto]"
        placeholder="Respuesta" class="${campo}">

        <label class="tw:inline-flex tw:shrink-0 tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-400">
            Correcta
            <input type="checkbox" class="tw:size-5 tw:cursor-pointer tw:rounded-md tw:accent-brand-500"
            name="secciones[${sec}][modulos][${mod}][preguntas][${pre}][respuestas][${indexResp}][correcta]">
        </label>

    </div>
    `;

    document.getElementById(`respuestas_${sec}_${mod}_${pre}`)
    .insertAdjacentHTML('beforeend', html);
}

</script>
@endpush

@endsection
