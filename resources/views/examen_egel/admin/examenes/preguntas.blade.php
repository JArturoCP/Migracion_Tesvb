@extends('layouts.panel')
@section('title', 'Preguntas del examen')
@include('partials.panel.recursos_app')
@section('content')

<main class="tw-pantalla">
    <x-panel.encabezado titulo="Preguntas del examen: {{ $examen->nombre }}" :migas="['Examen EGEL' => route('admin.dashboard'), 'Exámenes' => route('admin.examenes.index')]">
        <x-slot:extra>
            <x-panel.boton variante="secundario" tamano="sm" href="{{ route('admin.examenes.index') }}">
                <span class="fa fa-arrow-left" aria-hidden="true"></span>
                Regresar
            </x-panel.boton>
        </x-slot:extra>
    </x-panel.encabezado>

    @foreach($secciones as $s)

    <!-- SECCIÓN -->
    <x-panel.tarjeta class="tw:mb-6">

        <h3 class="tw:-mt-1 tw:mb-4 tw:flex tw:items-center tw:gap-2 tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">
            <span class="fa fa-folder-open tw:text-brand-500" aria-hidden="true"></span>
            {{ $s->nombre }}
        </h3>

        {{-- MÓDULOS: acordeón nativo; name="" hace que solo uno quede abierto por sección --}}
        <div id="accordion-{{ $s->id_seccion }}" class="tw:space-y-3">

            @foreach($modulos->where('id_seccion', $s->id_seccion) as $m)

            <details name="accordion-{{ $s->id_seccion }}" id="modulo-{{ $m->id_modulo }}"
                     class="tw:group tw:overflow-hidden tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">

                <summary class="tw:flex tw:cursor-pointer tw:list-none tw:items-center tw:gap-2 tw:bg-gray-50 tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:text-gray-800 tw:hover:bg-gray-100 tw:focus-visible:outline-hidden tw:focus-visible:ring-3 tw:focus-visible:ring-inset tw:focus-visible:ring-brand-500/20 tw:dark:bg-white/[0.03] tw:dark:text-white/90 tw:dark:hover:bg-white/[0.05] tw:[&::-webkit-details-marker]:hidden">
                    <span class="fa fa-book tw:text-brand-500" aria-hidden="true"></span>
                    <span class="tw:flex-1">{{ $m->nombre }}</span>
                    <span class="fa fa-chevron-down tw:text-gray-400 tw:transition-transform tw:group-open:rotate-180" aria-hidden="true"></span>
                </summary>

                <div class="tw:space-y-4 tw:p-4">

                    @foreach($preguntas->where('id_modulo', $m->id_modulo) as $p)

                    <!-- PREGUNTA -->
                    <div class="tw:rounded-lg tw:border-l-4 tw:border-brand-500 tw:bg-gray-50 tw:p-4 tw:dark:bg-white/[0.02]">

                        <div class="tw:flex tw:items-start tw:gap-3">
                            <div class="math-content tw:flex-1 tw:text-[15px] tw:text-gray-800 tw:dark:text-white/90">
                                <strong>{{ $p->numero_pregunta }}.</strong>
                                {!! $p->pregunta !!}
                            </div>

                            <!-- BOTONES PREGUNTA -->
                            <div class="tw:flex tw:shrink-0 tw:gap-1">
                                <a href="{{ route('admin.pregunta.edit', $p->id_pregunta) }}"
                                   class="tw:inline-flex tw:size-8 tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50 tw:dark:hover:bg-brand-500/15" title="Editar pregunta" aria-label="Editar pregunta">
                                    <span class="fa fa-pencil" aria-hidden="true"></span>
                                </a>

                                <a href="{{ route('admin.pregunta.delete', $p->id_pregunta) }}"
                                   class="tw:inline-flex tw:size-8 tw:items-center tw:justify-center tw:rounded-lg tw:text-red-500 tw:hover:bg-red-50 tw:dark:hover:bg-red-500/15" title="Eliminar pregunta" aria-label="Eliminar pregunta"
                                   onclick="return TNotify.confirmAction(event, this, '¿Eliminar pregunta?')">
                                    <span class="fa fa-trash" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>

                        <!-- RESPUESTAS -->
                        <div class="tw:mt-3 tw:divide-y tw:divide-gray-100 tw:dark:divide-gray-800">

                            @foreach($p->respuestas as $r)

                            <div class="tw:flex tw:items-center tw:justify-between tw:gap-3 tw:py-1.5">

                                <label class="tw:flex tw:items-center tw:gap-2.5 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">
                                    <input type="radio"
                                           class="tw:size-4 tw:shrink-0 tw:accent-green-600"
                                           name="pregunta_{{ $p->id_pregunta }}"
                                           disabled
                                           {{ $r->es_correcta ? 'checked' : '' }}>

                                    <span>
                                        {{ $r->respuesta }}

                                        @if($r->es_correcta)
                                            <x-panel.badge tono="exito" class="tw:ml-1 tw:text-xs">(Correcta)</x-panel.badge>
                                        @endif
                                    </span>
                                </label>

                                <!-- BOTONES RESPUESTA -->
                                <div class="tw:flex tw:shrink-0 tw:gap-1">
                                    <a href="{{ route('admin.respuesta.edit', $r->id_respuesta) }}"
                                       class="tw:inline-flex tw:size-8 tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50 tw:dark:hover:bg-brand-500/15" title="Editar respuesta" aria-label="Editar respuesta">
                                        <span class="fa fa-pencil" aria-hidden="true"></span>
                                    </a>

                                    <a href="{{ route('admin.respuesta.delete', ['id_respuesta'=>$r->id_respuesta,'id_examen_egel'=>$p->id_examen_egel]) }}"
                                       class="tw:inline-flex tw:size-8 tw:items-center tw:justify-center tw:rounded-lg tw:text-red-500 tw:hover:bg-red-50 tw:dark:hover:bg-red-500/15" title="Eliminar respuesta" aria-label="Eliminar respuesta"
                                       onclick="return TNotify.confirmAction(event, this, '¿Eliminar respuesta?')">
                                        <span class="fa fa-trash" aria-hidden="true"></span>
                                    </a>
                                </div>

                            </div>

                            @endforeach

                        </div>

                    </div>

                    @endforeach

                </div>

            </details>

            @endforeach

        </div>
    </x-panel.tarjeta>

    @endforeach
</main>

<!-- MATHJAX -->
<script>
window.MathJax = {
    tex: {
        inlineMath: [['$', '$'], ['\\(', '\\)']],
        displayMath: [['\\[', '\\]']]
    }
};
</script>

<script async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    setTimeout(() => {
        if (window.MathJax) {
            MathJax.typesetPromise();
        }
    }, 300);
});
</script>

@if(($ver ?? null) === 'pregunta')
    @include('examen_egel.admin.examenes.edit_pregunta')
@endif
@if(($ver ?? null) === 'respuesta')
    @include('examen_egel.admin.examenes.edit_respuesta')
@endif

@include('partials.panel.validacion_envio')
@endsection
