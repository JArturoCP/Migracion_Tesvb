@extends('layouts.panel')
@section('title', 'Examen EGEL')
@include('partials.panel.recursos_app')
@section('content')

<main class="tw-pantalla tw:mx-auto tw:max-w-4xl">
    <x-panel.encabezado titulo="Examen EGEL" :migas="['Examen EGEL' => url('/examen_egel/dashboard')]">
        @if($moduloActual)
            <x-slot:extra>
                <x-panel.badge><span class="fa fa-folder-open" aria-hidden="true"></span> Área: {{ $moduloActual->nombre }}</x-panel.badge>
            </x-slot:extra>
        @endif
    </x-panel.encabezado>

    <form method="POST" action="{{ route('egel.seccion.responder', $id_seccion) }}" class="tw:space-y-4">
        @csrf

        {{-- 👇 IMPORTANTES --}}
        <input type="hidden" name="page" value="{{ $paginaActual }}">
        <input type="hidden" name="id_seccion" value="{{ $id_seccion }}">

        @foreach($preguntas as $pregunta)
            <fieldset class="tw:min-w-0 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:sm:p-6 tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
                <legend class="tw:float-left tw:mb-4 tw:w-full tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                    {{ $pregunta->numero_pregunta }}.
                    {!! nl2br(e($pregunta->pregunta)) !!}
                </legend>

                <div class="tw:clear-both tw:divide-y tw:divide-gray-100 tw:overflow-hidden tw:rounded-xl tw:border tw:border-gray-200 tw:dark:divide-gray-800 tw:dark:border-gray-800">
                    @foreach($respuestas[$pregunta->id_pregunta] ?? [] as $r)
                        <label class="tw:flex tw:w-full tw:cursor-pointer tw:items-center tw:gap-3 tw:px-4 tw:py-3 tw:text-sm tw:text-gray-700 tw:hover:bg-gray-50 tw:has-checked:bg-brand-50 tw:dark:text-gray-300 tw:dark:hover:bg-white/[0.03] tw:dark:has-checked:bg-brand-500/15">
                            <input type="radio"
                                   class="tw:size-5 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500"
                                   name="respuestas[{{ $pregunta->id_pregunta }}]"
                                   value="{{ $r->id_respuesta }}"
                                   required>
                            <span>{{ $r->respuesta }}</span>
                        </label>
                    @endforeach
                </div>
            </fieldset>
        @endforeach

        @if ($errors->any())
            <x-panel.alerta tipo="error">
                Debes responder todas las preguntas antes de continuar.
            </x-panel.alerta>
        @endif

        <div class="tw:pt-2 tw:text-right">
            <x-panel.boton type="submit" tamano="lg">
                <span class="fa fa-arrow-right" aria-hidden="true"></span>
                Guardar y continuar
            </x-panel.boton>
        </div>

    </form>
</main>

@endsection
