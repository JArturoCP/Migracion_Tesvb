@extends('layouts.panel')
@include('partials.panel.recursos_app')

@section('content')

<div class="tw:w-full" style="margin-top:30px;">

    <!-- ========================= -->
    <!-- TÍTULO ESTILIZADO -->
    <!-- ========================= -->
    <div style="
        background: #337ab7;
        color: white;
        padding: 12px 18px;
        border-radius: 6px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    ">

        <div style="font-size:18px; font-weight:600;">
            <span class="fa fa-list-alt"></span>
            Preguntas del examen: {{ $examen->nombre }}
        </div>

    </div>

    <a href="{{ route('admin.examenes_generales.index') }}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">
        <span class="fa fa-arrow-left"></span>
        Regresar
    </a>

    <hr>

    @foreach($secciones as $s)

    <!-- ========================= -->
    <!-- SECCIÓN -->
    <!-- ========================= -->
    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white" style="margin-bottom:25px;">

        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
            <strong>
                <span class="fa fa-folder-open"></span>
                {{ $s->nombre }}
            </strong>
        </div>

        <div class="tw:p-5 tw:sm:p-6">

            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                @foreach($modulos->where('id_seccion', $s->id_seccion) as $m)

                <!-- ========================= -->
                <!-- MÓDULO -->
                <!-- ========================= -->
                <div class="tw:w-full tw:lg:w-6/12 tw:px-2" style="margin-bottom:20px;">

                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">

                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
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
                            <div class="well-sm tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-gray-50 tw:p-5" style="margin-bottom:15px;">

                                <div class="math-content" style="font-size:16px;">
                                    <strong>{{ $p->numero_pregunta }}.</strong>
                                    {!! $p->pregunta !!}
                                </div>

                                <!-- BOTONES PREGUNTA -->
                                <div class="tw:text-right" style="margin:8px 0;">
                                    <a href="{{ route('admin.examen_general.pregunta.edit', $p->id_pregunta) }}"
                                       class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-1 tw:px-2 tw:py-1 tw:text-xs">
                                        <span class="fa fa-pencil"></span>
                                    </a>

                                    <a href="{{ route('admin.examen_general.pregunta.delete', $p->id_pregunta) }}"
                                       class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-1 tw:px-2 tw:py-1 tw:text-xs"
                                       onclick="return TNotify.confirmAction(event, this, '¿Eliminar pregunta?')">
                                        <span class="fa fa-trash"></span>
                                    </a>
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
                                               class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-1 tw:px-2 tw:py-1 tw:text-xs">
                                                <span class="fa fa-pencil"></span>
                                            </a>

                                            <a href="{{ route('admin.examen_general.respuesta.delete', ['id_respuesta' => $r->id_respuesta,'id_examen_egel' => $p->id_examen_egel]) }}"
                                               class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-1 tw:px-2 tw:py-1 tw:text-xs"
                                               onclick="return TNotify.confirmAction(event, this, '¿Estás seguro de eliminar esta respuesta?')">
                                                <span class="fa fa-trash"></span>
                                            </a>
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
@endsection