@extends('layouts.panel')

@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

<div class="tw:w-full" style="margin-top:30px;">

    <!-- ========================= -->
    <!-- TÍTULO ESTILIZADO -->
    <!-- ========================= -->
    <div class="tw:text-white tw:mb-4" style="background: #337ab7; padding: 12px 18px; border-radius: 6px; display: flex; align-items: center">

        <div class="tw:text-lg tw:font-semibold">
            <span class="fa fa-list-alt"></span>
            Preguntas del examen: {{ $examen->nombre }}
        </div>

    </div>

    <a href="{{ route('admin.examenes_generales.index') }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
        <span class="fa fa-arrow-left"></span>
        Regresar
    </a>

    <hr>

    @foreach($secciones as $s)

    <!-- ========================= -->
    <!-- SECCIÓN -->
    <!-- ========================= -->
    <x-panel.encabezado :titulo="$s->nombre" :migas="['Examen general de conocimientos' => null]" />
    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

        

        <div class="tw:p-5 tw:sm:p-6">

            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                @foreach($modulos->where('id_seccion', $s->id_seccion) as $m)

                <!-- ========================= -->
                <!-- MÓDULO -->
                <!-- ========================= -->
                <div class="tw:w-full tw:lg:w-6/12 tw:px-2 tw:mb-5" >

                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                            <strong>
                                <span class="fa fa-book"></span>
                                {{ $m->nombre }}
                            </strong>
                        </div>

                        <div class="tw:p-5 tw:sm:p-6">

                            @foreach($preguntas->where('id_modulo', $m->id_modulo) as $p)

                            <!-- ========================= -->
                            <!-- PREGUNTA -->
                            <!-- ========================= -->
                            <div class="well-sm tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:p-5">

                                <div class="math-content tw:text-base" >
                                    <strong>{{ $p->numero_pregunta }}.</strong>
                                    {!! $p->pregunta !!}
                                </div>

                                <!-- BOTONES PREGUNTA -->
                                <div class="tw:text-right" style="margin:8px 0;">
                                    <a href="{{ route('admin.examen_general.pregunta.edit', $p->id_pregunta) }}"
                                       class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><span class="fa fa-pencil"></span></a>

                                    <a href="{{ route('admin.examen_general.pregunta.delete', $p->id_pregunta) }}"
                                       class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base"
                                       onclick="return TNotify.confirmAction(event, this, '¿Eliminar pregunta?')"><span class="fa fa-trash"></span></a>
                                </div>

                                <!-- ========================= -->
                                <!-- RESPUESTAS -->
                                <!-- ========================= -->
                                @foreach($p->respuestas as $r)

                                    <div class="tw:flex tw:items-center tw:gap-2" style="margin-left:10px;">
                                        <label>
                                            <input type="radio"
                                                   name="pregunta_{{ $p->id_pregunta }}"
                                                   value="{{ $r->id_respuesta }}"
                                                   {{ $r->es_correcta ? 'checked' : '' }}
                                                   disabled>

                                            {{ $r->respuesta }}

                                            @if($r->es_correcta)
                                                <span class="tw:text-green-600">(Correcta)</span>
                                            @endif
                                        </label>

                                        <div class="tw:text-right">
                                            <a href="{{ route('admin.examen_general.respuesta.edit', $r->id_respuesta) }}"
                                               class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><span class="fa fa-pencil"></span></a>

                                            <a href="{{ route('admin.examen_general.respuesta.delete', ['id_respuesta' => $r->id_respuesta,'id_examen_egel' => $p->id_examen_egel]) }}"
                                               class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base"
                                               onclick="return TNotify.confirmAction(event, this, '¿Estás seguro de eliminar esta respuesta?')"><span class="fa fa-trash"></span></a>
                                        </div>
                                    </div>

                                @endforeach

                            </div>

                            @endforeach

                        </div>
                    </div>

                </div>

                @endforeach

            </div>

        </div>
    </div>

    @endforeach

</div>

<!-- ========================= -->
<!-- MATHJAX -->
<!-- ========================= -->

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
        MathJax.typesetPromise();
    }, 300);
});
</script>

@if(isset($ver) && $ver == 'pregunta')
      @section('modal_editar_pregunta')
      @include('examen_gnral_con.admin.examenes.edit_pregunta')
      @show
@endif

@if(isset($ver) && $ver == 'respuesta')
      @section('modal_editar_respuesta')
      @include('examen_gnral_con.admin.examenes.edit_respuesta')
      @show
@endif

@include('partials.panel.validacion_envio')
</div>
@endsection