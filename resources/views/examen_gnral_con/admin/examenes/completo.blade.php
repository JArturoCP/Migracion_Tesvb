@extends('layouts.panel')

@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Crear examen completo" :migas="['Examen general de conocimientos' => null]" />

<div class="tw:w-full">

<form action="{{ route('admin.examen.guardarCompleto') }}" method="POST">
@csrf

<!-- EXAMEN -->
<div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:mb-4">
<div class="tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:px-5 tw:py-4">Datos del Examen</div>
<div class="tw:p-5 tw:sm:p-6">

<select name="id_carrera" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:mb-2">
@foreach($carreras as $c)
<option value="{{ $c->id_carrera }}">{{ $c->nombre }}</option>
@endforeach
</select>

<input type="text" name="nombre_examen" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Nombre del examen">

</div>
</div>

<!-- SECCIONES -->
<div id="secciones"></div>

<button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" onclick="agregarSeccion()">+ Sección</button>

<hr>

<button class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Guardar TODO</button>

</form>
</div>

@endsection

@section('scripts')

<script>

let indexSeccion = 0;

function agregarSeccion() {

    let html = `
    <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:mt-4 tw:p-4">
        <input type="text" name="secciones[${indexSeccion}][nombre]" 
        placeholder="Nombre sección" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:mb-2">

        <div id="modulos_${indexSeccion}"></div>

        <button type="button" onclick="agregarModulo(${indexSeccion})" 
        class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-sky-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-sky-600 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm">+ Módulo</button>
    </div>
    `;

    document.getElementById('secciones').insertAdjacentHTML('beforeend', html);

    indexSeccion++;
}

function agregarModulo(sec) {

    let indexModulo = document.querySelectorAll(`#modulos_${sec} .modulo`).length;

    let html = `
    <div class="modulo tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:mt-2 tw:p-2">

        <input type="text" name="secciones[${sec}][modulos][${indexModulo}][nombre]" 
        placeholder="Nombre módulo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:mb-2">

        <div id="preguntas_${sec}_${indexModulo}"></div>

        <button type="button" onclick="agregarPregunta(${sec},${indexModulo})"
        class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm">+ Pregunta</button>

    </div>
    `;

    document.getElementById(`modulos_${sec}`).insertAdjacentHTML('beforeend', html);
}

function agregarPregunta(sec, mod) {

    let indexPregunta = document.querySelectorAll(`#preguntas_${sec}_${mod} .pregunta`).length;

    let html = `
    <div class="pregunta tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:mt-2 tw:p-2">

        <input type="text" 
        name="secciones[${sec}][modulos][${mod}][preguntas][${indexPregunta}][pregunta]" 
        placeholder="Pregunta" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:mb-2">

        <div id="respuestas_${sec}_${mod}_${indexPregunta}"></div>

        <button type="button" 
        onclick="agregarRespuesta(${sec},${mod},${indexPregunta})"
        class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm">
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
    <div class="respuesta tw:mt-1">

        <input type="text" 
        name="secciones[${sec}][modulos][${mod}][preguntas][${pre}][respuestas][${indexResp}][texto]" 
        placeholder="Respuesta" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">

        <label>
            Correcta
            <input type="checkbox" 
            name="secciones[${sec}][modulos][${mod}][preguntas][${pre}][respuestas][${indexResp}][correcta]">
        </label>

    </div>
    `;

    document.getElementById(`respuestas_${sec}_${mod}_${pre}`)
    .insertAdjacentHTML('beforeend', html);
}

</script>

</div>
@endsection