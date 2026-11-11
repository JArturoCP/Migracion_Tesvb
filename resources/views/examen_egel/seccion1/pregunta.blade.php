@extends('layouts.app')

@section('content')

<div class="container" style="margin-top: 30px; max-width: 900px;">

    @if($moduloActual)
        <div class="panel panel-primary">
            <div class="panel-heading text-center">
                <h4 style="margin: 0;">
                    <i class="glyphicon glyphicon-folder-open"></i>
                    <strong>Área: {{ $moduloActual->nombre }}</strong>
                </h4>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('egel.seccion.responder', $id_seccion) }}">
        @csrf

        {{-- 👇 IMPORTANTES --}}
        <input type="hidden" name="page" value="{{ $paginaActual }}">
        <input type="hidden" name="id_seccion" value="{{ $id_seccion }}">

        @foreach($preguntas as $pregunta)
            <div class="panel panel-default">
                <div class="panel-body">
                    <h5 class="mb-4 font-weight-bold">
                        {{ $pregunta->numero_pregunta }}.
                        {!! nl2br(e($pregunta->pregunta)) !!}
                    </h5>

                    <div class="list-group">
                        @foreach($respuestas[$pregunta->id_pregunta] ?? [] as $r)
                            <label class="list-group-item">
                                <div class="radio" style="margin: 0;">
                                    <label style="width: 100%; cursor: pointer;">
                                        <input type="radio"
                                               name="respuestas[{{ $pregunta->id_pregunta }}]"
                                               value="{{ $r->id_respuesta }}"
                                               required>
                                        {{ $r->respuesta }}
                                    </label>
                                </div>
                            </label>
                        @endforeach
                    </div>

                </div>
            </div>
        @endforeach

        @if ($errors->any())
            <div class="alert alert-danger text-center">
                <i class="glyphicon glyphicon-warning-sign"></i>
                Debes responder todas las preguntas antes de continuar.
            </div>
        @endif

        <div class="text-right" style="margin-top: 20px;">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="glyphicon glyphicon-arrow-right"></i>
                Guardar y continuar
            </button>
        </div>

    </form>

</div>

<br>

@endsection