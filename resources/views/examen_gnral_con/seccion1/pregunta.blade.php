@extends('layouts.panel')

@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

<div class="tw:w-full" style="margin-top: 30px; max-width: 900px;">

    @if($moduloActual)
        <x-panel.encabezado :titulo="'Área: '.$moduloActual->nombre" :migas="['Examen general de conocimientos' => null]" />  
    @endif

    <form method="POST" action="{{ route('examen_general.seccion.responder', $id_seccion) }}">
        @csrf

        {{-- 👇 IMPORTANTES --}}
        <input type="hidden" name="page" value="{{ $paginaActual }}">
        <input type="hidden" name="id_seccion" value="{{ $id_seccion }}">

        @foreach($preguntas as $pregunta)
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:p-5 tw:sm:p-6">
                    <h5 class="tw:mb-6 tw:font-semibold tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300">
                        {{ $pregunta->numero_pregunta }}.
                        {!! nl2br(e($pregunta->pregunta)) !!}
                    </h5>

                    <div class="tw:divide-y tw:divide-gray-100 tw:rounded-lg tw:border tw:border-gray-200 tw:dark:border-gray-800">
                        @foreach($respuestas[$pregunta->id_pregunta] ?? [] as $r)
                            <label class="tw:block tw:px-4 tw:py-3">
                                <div class="tw:flex tw:items-center tw:gap-2 tw:m-0" >
                                    <label class="tw:cursor-pointer tw:w-full">
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
            <x-panel.alerta tipo="error" class="tw:mb-4">
                <i class="fa fa-exclamation-triangle"></i>
                Debes responder todas las preguntas antes de continuar.
            </x-panel.alerta>
        @endif

        <div class="tw:text-right tw:mt-5">
            <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
                <i class="fa fa-arrow-right"></i>
                Guardar y continuar
            </button>
        </div>

    </form>

</div>

</div>
@endsection