@extends('layouts.app2')

@section('content')

<div class="container">
<h3>Crear Examen Completo</h3>

<form action="{{ route('admin.examen.guardarCompleto') }}" method="POST">
@csrf

<!-- EXAMEN -->
<div class="card mb-3">
<div class="card-header">Datos del Examen</div>
<div class="card-body">

<select name="id_carrera" class="form-control mb-2">
@foreach($carreras as $c)
<option value="{{ $c->id_carrera }}">{{ $c->nombre }}</option>
@endforeach
</select>

<input type="text" name="nombre_examen" class="form-control" placeholder="Nombre del examen">

</div>
</div>

<!-- SECCIONES -->
<div id="secciones"></div>

<button type="button" class="btn btn-primary" onclick="agregarSeccion()">+ Sección</button>

<hr>

<button class="btn btn-success">Guardar TODO</button>

</form>
</div>

@endsection

@section('scripts')

<script>

let indexSeccion = 0;

function agregarSeccion() {

    let html = `
    <div class="card mt-3 p-3">
        <input type="text" name="secciones[${indexSeccion}][nombre]" 
        placeholder="Nombre sección" class="form-control mb-2">

        <div id="modulos_${indexSeccion}"></div>

        <button type="button" onclick="agregarModulo(${indexSeccion})" 
        class="btn btn-info btn-sm">+ Módulo</button>
    </div>
    `;

    document.getElementById('secciones').insertAdjacentHTML('beforeend', html);

    indexSeccion++;
}

function agregarModulo(sec) {

    let indexModulo = document.querySelectorAll(`#modulos_${sec} .modulo`).length;

    let html = `
    <div class="card mt-2 p-2 modulo">

        <input type="text" name="secciones[${sec}][modulos][${indexModulo}][nombre]" 
        placeholder="Nombre módulo" class="form-control mb-2">

        <div id="preguntas_${sec}_${indexModulo}"></div>

        <button type="button" onclick="agregarPregunta(${sec},${indexModulo})"
        class="btn btn-warning btn-sm">+ Pregunta</button>

    </div>
    `;

    document.getElementById(`modulos_${sec}`).insertAdjacentHTML('beforeend', html);
}

function agregarPregunta(sec, mod) {

    let indexPregunta = document.querySelectorAll(`#preguntas_${sec}_${mod} .pregunta`).length;

    let html = `
    <div class="card mt-2 p-2 pregunta">

        <input type="text" 
        name="secciones[${sec}][modulos][${mod}][preguntas][${indexPregunta}][pregunta]" 
        placeholder="Pregunta" class="form-control mb-2">

        <div id="respuestas_${sec}_${mod}_${indexPregunta}"></div>

        <button type="button" 
        onclick="agregarRespuesta(${sec},${mod},${indexPregunta})"
        class="btn btn-secondary btn-sm">
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
    <div class="respuesta mt-1">

        <input type="text" 
        name="secciones[${sec}][modulos][${mod}][preguntas][${pre}][respuestas][${indexResp}][texto]" 
        placeholder="Respuesta" class="form-control">

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

@endsection