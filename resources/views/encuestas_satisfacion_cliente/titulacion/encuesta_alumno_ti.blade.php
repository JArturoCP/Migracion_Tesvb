@extends('layouts.panel')
@section('title', 'Encuesta de satisfacción de Titulación')
@include('partials.panel.recursos_app')
@include('partials.panel.formularios')
@use('App\View\EncuestaTitulacion')

@section('content')
    <div class="tw:mx-auto tw:max-w-4xl">
        <x-panel.encabezado titulo="Encuesta de satisfacción de Titulación"
            :migas="['Registro de jurado' => url('/titulacion/registro_jurado')]" />

        <div class="tw:space-y-5">
            <x-panel.tarjeta>
                <div class="tw:space-y-3 tw:text-sm tw:leading-relaxed tw:text-gray-700 tw:dark:text-gray-300">
                    <p>Gracias por responder esta encuesta. Tus respuestas se tratarán de forma anónima y ayudarán a mejorar los servicios del Departamento de Titulación.</p>
                    <p>El aviso de privacidad se te dio a conocer en el Departamento de Titulación antes de esta encuesta y se agregó a tu expediente.</p>
                </div>
            </x-panel.tarjeta>

            <x-panel.tarjeta titulo="Cuestionario" subtitulo="Responde las 15 preguntas e ingresa tus comentarios o sugerencias.">
                <form id="form_enviar_encuesta" action="{{ url('/encuestas_satisfaccion/guardar_encuesta_titulacion/'.$id_alumno) }}"
                    method="POST" class="tw:space-y-6" data-panel-envio>
                    @csrf
                    @foreach (EncuestaTitulacion::PREGUNTAS as $campo => $pregunta)
                        @php
                            $numero = $loop->iteration;
                            $nombre = 'pregunta'.$numero;
                            $opciones = EncuestaTitulacion::ESCALAS[$campo] ?? EncuestaTitulacion::SI_NO;
                        @endphp
                        <fieldset class="tw:min-w-0 tw:rounded-xl tw:border tw:border-gray-200 tw:px-4 tw:pb-4 tw:dark:border-gray-700 tw:has-[[aria-invalid=true]]:border-red-300">
                            <legend class="tw:max-w-full tw:px-2 tw:text-sm tw:leading-relaxed tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                                {{ $numero }}. {{ $pregunta }}
                            </legend>
                            <div class="tw-campo tw:mt-2 tw:grid tw:grid-cols-2 tw:gap-3 tw:sm:flex tw:sm:flex-wrap tw:sm:gap-x-6">
                                @foreach ($opciones as $valor => $respuesta)
                                    <x-panel.radio :name="$nombre" :id="$nombre.'-'.$valor" :value="$valor"
                                        :data-panel-etiqueta="'la pregunta '.$numero"
                                        :checked="(string) old($nombre) === (string) $valor" required>{{ $respuesta }}</x-panel.radio>
                                @endforeach
                            </div>
                        </fieldset>
                    @endforeach

                    <x-panel.textarea id="comentario" name="comentario" etiqueta="Comentarios adicionales o sugerencias"
                        rows="3" required>{{ old('comentario') }}</x-panel.textarea>

                    <div class="tw:flex tw:justify-end tw:border-t tw:border-gray-100 tw:pt-5 tw:dark:border-gray-800">
                        <x-panel.boton id="enviar_encuesta" type="submit" class="tw:w-full tw:sm:w-auto">Enviar encuesta</x-panel.boton>
                    </div>
                </form>
            </x-panel.tarjeta>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('form_enviar_encuesta').addEventListener('change', ({target}) => {
            if (target.type !== 'radio') { return; }
            const marcado = target.closest('.tw-campo').querySelector('[data-panel-error]');
            if (marcado) { PanelFormularios.limpiarCampo(marcado); }
        });
    </script>
@endpush
