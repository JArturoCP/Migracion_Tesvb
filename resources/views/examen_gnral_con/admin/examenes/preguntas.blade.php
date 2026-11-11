@extends('layouts.app')

@section('content')

<div class="container" style="margin-top:30px;">

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
            <span class="glyphicon glyphicon-list-alt"></span>
            Preguntas del examen: {{ $examen->nombre }}
        </div>

    </div>

    <a href="{{ route('admin.examenes_generales.index') }}" class="btn btn-default">
        <span class="glyphicon glyphicon-arrow-left"></span>
        Regresar
    </a>

    <hr>

    @foreach($secciones as $s)

    <!-- ========================= -->
    <!-- SECCIÓN -->
    <!-- ========================= -->
    <div class="panel panel-primary" style="margin-bottom:25px;">

        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-folder-open"></span>
                {{ $s->nombre }}
            </strong>
        </div>

        <div class="panel-body">

            <div class="row">

                @foreach($modulos->where('id_seccion', $s->id_seccion) as $m)

                <!-- ========================= -->
                <!-- MÓDULO -->
                <!-- ========================= -->
                <div class="col-md-6" style="margin-bottom:20px;">

                    <div class="panel panel-info">

                        <div class="panel-heading">
                            <strong>
                                <span class="glyphicon glyphicon-book"></span>
                                {{ $m->nombre }}
                            </strong>
                        </div>

                        <div class="panel-body">

                            @foreach($preguntas->where('id_modulo', $m->id_modulo) as $p)

                            <!-- ========================= -->
                            <!-- PREGUNTA -->
                            <!-- ========================= -->
                            <div class="well well-sm" style="margin-bottom:15px;">

                                <div class="math-content" style="font-size:16px;">
                                    <strong>{{ $p->numero_pregunta }}.</strong>
                                    {!! $p->pregunta !!}
                                </div>

                                <!-- BOTONES PREGUNTA -->
                                <div class="text-right" style="margin:8px 0;">
                                    <a href="{{ route('admin.examen_general.pregunta.edit', $p->id_pregunta) }}"
                                       class="btn btn-success btn-xs">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>

                                    <a href="{{ route('admin.examen_general.pregunta.delete', $p->id_pregunta) }}"
                                       class="btn btn-danger btn-xs"
                                       onclick="return confirm('¿Eliminar pregunta?')">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </div>

                                <!-- ========================= -->
                                <!-- RESPUESTAS -->
                                <!-- ========================= -->
                                @foreach($p->respuestas as $r)

                                    <div class="radio" style="margin-left:10px;">
                                        <label>
                                            <input type="radio"
                                                   name="pregunta_{{ $p->id_pregunta }}"
                                                   value="{{ $r->id_respuesta }}"
                                                   {{ $r->es_correcta ? 'checked' : '' }}
                                                   disabled>

                                            {{ $r->respuesta }}

                                            @if($r->es_correcta)
                                                <span class="text-success">(Correcta)</span>
                                            @endif
                                        </label>

                                        <div class="text-right">
                                            <a href="{{ route('admin.examen_general.respuesta.edit', $r->id_respuesta) }}"
                                               class="btn btn-success btn-xs">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </a>

                                            <a href="{{ route('admin.examen_general.respuesta.delete', ['id_respuesta' => $r->id_respuesta,'id_examen_egel' => $p->id_examen_egel]) }}"
                                               class="btn btn-danger btn-xs"
                                               onclick="return confirm('¿Estás seguro de eliminar esta respuesta?')">
                                                <span class="glyphicon glyphicon-trash"></span>
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

@endsection