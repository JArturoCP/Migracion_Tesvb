@extends('layouts.panel')
@include('partials.panel.recursos_app')

@section('content')

<div class="tw:w-full" style="margin-top: 30px; max-width: 900px;">

    @if($moduloActual)
        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4 tw:text-center">
                <h4 style="margin: 0;">
                    <i class="fa fa-folder-open"></i>
                    <strong>Área: {{ $moduloActual->nombre }}</strong>
                </h4>
            </div>
        </div>  
    @endif

    <form method="POST" action="{{ route('examen_general.seccion.responder', $id_seccion) }}">
        @csrf

        {{-- 👇 IMPORTANTES --}}
        <input type="hidden" name="page" value="{{ $paginaActual }}">
        <input type="hidden" name="id_seccion" value="{{ $id_seccion }}">

        @foreach($preguntas as $pregunta)
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                <div class="tw:p-5 tw:sm:p-6">
                    <h5 class="tw:mb-6 tw:font-semibold">
                        {{ $pregunta->numero_pregunta }}.
                        {!! nl2br(e($pregunta->pregunta)) !!}
                    </h5>

                    <div class="tw:divide-y tw:divide-gray-100 tw:rounded-lg tw:border tw:border-gray-200">
                        @foreach($respuestas[$pregunta->id_pregunta] ?? [] as $r)
                            <label class="tw:block tw:px-4 tw:py-3">
                                <div class="tw:flex tw:items-center tw:gap-2" style="margin: 0;">
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
            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700 tw:text-center">
                <i class="fa fa-exclamation-triangle"></i>
                Debes responder todas las preguntas antes de continuar.
            </div>
        @endif

        <div class="tw:text-right" style="margin-top: 20px;">
            <button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-5 tw:py-3.5 tw:text-base">
                <i class="fa fa-arrow-right"></i>
                Guardar y continuar
            </button>
        </div>

    </form>

</div>

<br>

@endsection