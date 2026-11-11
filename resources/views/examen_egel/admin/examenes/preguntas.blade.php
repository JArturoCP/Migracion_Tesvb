@extends('layouts.app')

@section('content')

<div class="container" style="margin-top:30px;">

    <!-- HEADER -->
    <div style="
        background: linear-gradient(135deg,#2c3e50,#337ab7);
        color:white;
        padding:15px 18px;
        border-radius:6px;
        margin-bottom:15px;
        box-shadow:0 2px 6px rgba(0,0,0,0.15);
    ">
        <div style="font-size:18px; font-weight:600;">
            <span class="glyphicon glyphicon-list-alt"></span>
            Preguntas del examen: {{ $examen->nombre }}
        </div>
    </div>

    <a href="{{ route('admin.examenes.index') }}"
       class="btn btn-default"
       style="margin-bottom:15px;">
        <span class="glyphicon glyphicon-arrow-left"></span>
        Regresar
    </a>

    @foreach($secciones as $s)

    <!-- SECCIÓN -->
    <div class="panel panel-primary" style="margin-bottom:20px; border-radius:6px; overflow:hidden;">

        <div class="panel-heading" style="background:#34495e; border-color:#34495e;">
            <strong>
                <span class="glyphicon glyphicon-folder-open"></span>
                {{ $s->nombre }}
            </strong>
        </div>

        <div class="panel-body" style="background:#f8f9fa;">

            <div class="panel-group" id="accordion-{{ $s->id_seccion }}">

                @foreach($modulos->where('id_seccion', $s->id_seccion) as $m)

                <!-- MÓDULO -->
                <div class="panel panel-default" style="border-radius:6px; overflow:hidden; margin-bottom:10px;">

                    <div class="panel-heading" style="background:#ecf0f1;">

                        <h4 class="panel-title" style="margin:0;">

                            <a data-toggle="collapse"
                               data-parent="#accordion-{{ $s->id_seccion }}"
                               data-target="#modulo-{{ $m->id_modulo }}"
                               style="display:block; text-decoration:none; font-weight:600; color:#2c3e50;">

                                <span class="glyphicon glyphicon-book"></span>
                                {{ $m->nombre }}

                                <span class="pull-right glyphicon glyphicon-chevron-down"></span>

                            </a>

                        </h4>

                    </div>

                    <div id="modulo-{{ $m->id_modulo }}"
                         class="panel-collapse collapse">

                        <div class="panel-body" style="background:#ffffff;">

                            @foreach($preguntas->where('id_modulo', $m->id_modulo) as $p)

                            <!-- PREGUNTA -->
                            <div style="
                                margin-bottom:15px;
                                padding:12px;
                                border-left:4px solid #337ab7;
                                background:#fafafa;
                                border-radius:4px;
                            ">

                                <div class="math-content" style="font-size:15px; color:#2c3e50;">
                                    <strong>{{ $p->numero_pregunta }}.</strong>
                                    {!! $p->pregunta !!}
                                </div>

                                <!-- BOTONES PREGUNTA -->
                                <div class="text-right" style="margin-top:6px;">
                                    <a href="{{ route('admin.pregunta.edit', $p->id_pregunta) }}"
                                       class="btn btn-success btn-xs">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>

                                    <a href="{{ route('admin.pregunta.delete', $p->id_pregunta) }}"
                                       class="btn btn-danger btn-xs"
                                       onclick="return confirm('¿Eliminar pregunta?')">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </div>

                                <!-- RESPUESTAS -->
                                <div style="margin-top:10px;">

                                    @foreach($p->respuestas as $r)

                                    <div style="padding:6px 0; border-bottom:1px solid #eee;">

                                        <label style="font-weight:normal; margin:0;">

                                            <input type="radio"
                                                   name="pregunta_{{ $p->id_pregunta }}"
                                                   disabled
                                                   {{ $r->es_correcta ? 'checked' : '' }}>

                                            {{ $r->respuesta }}

                                            @if($r->es_correcta)
                                                <span style="color:#27ae60;">(Correcta)</span>
                                            @endif

                                        </label>

                                        <!-- BOTONES RESPUESTA -->
                                        <div class="pull-right">

                                            <a href="{{ route('admin.respuesta.edit', $r->id_respuesta) }}"
                                               class="btn btn-success btn-xs">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </a>

                                            <a href="{{ route('admin.respuesta.delete', ['id_respuesta'=>$r->id_respuesta,'id_examen_egel'=>$p->id_examen_egel]) }}"
                                               class="btn btn-danger btn-xs"
                                               onclick="return confirm('¿Eliminar respuesta?')">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>

                                        </div>

                                        <div style="clear:both;"></div>

                                    </div>

                                    @endforeach

                                </div>

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

@endsection