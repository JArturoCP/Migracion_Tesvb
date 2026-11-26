@use('App\View\EncuestaServicioSocialResidencia')

<div class="tw:mx-auto tw:max-w-4xl">
    <x-panel.encabezado :titulo="$titulo" />

    @if ($estado_encuesta == 0)
        <div class="tw:space-y-5">
            <x-panel.tarjeta>
                <p class="tw:text-sm tw:leading-relaxed tw:text-gray-700 tw:dark:text-gray-300">
                    Gracias por responder esta encuesta. Tu opinión nos ayuda a mejorar los servicios del Departamento de Servicio Social y Residencia Profesional.
                </p>
            </x-panel.tarjeta>

            <x-panel.tarjeta titulo="Cuestionario" subtitulo="Responde las 10 preguntas. El comentario es opcional.">
                <form id="form_enviar_encuesta" data-panel-envio method="POST"
                    action="{{ $accion }}" class="tw:space-y-6">
                    @csrf
                    @foreach (EncuestaServicioSocialResidencia::PREGUNTAS as $numero => $pregunta)
                        @php($nombre = 'pregunta'.$numero)
                        <fieldset class="tw:min-w-0 tw:rounded-xl tw:border tw:border-gray-200 tw:px-4 tw:pb-4 tw:dark:border-gray-700 tw:has-[[aria-invalid=true]]:border-red-300">
                            <legend class="tw:max-w-full tw:px-2 tw:text-sm tw:leading-relaxed tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                                {{ $numero }}. {{ $pregunta }}
                            </legend>
                            <div class="tw-campo tw:mt-2 tw:grid tw:grid-cols-2 tw:gap-3 tw:sm:flex tw:sm:flex-wrap tw:sm:gap-x-6">
                                @foreach (EncuestaServicioSocialResidencia::OPCIONES as $valor => $respuesta)
                                    <x-panel.radio :name="$nombre" :id="$nombre.'-'.$valor" :value="$valor"
                                        :data-panel-etiqueta="'la pregunta '.$numero" :checked="(string) old($nombre) === (string) $valor"
                                        required>{{ $respuesta }}</x-panel.radio>
                                @endforeach
                            </div>
                        </fieldset>
                    @endforeach

                    <x-panel.textarea id="comentario" name="comentario" etiqueta="Comentario (opcional)" rows="3">{{ old('comentario') }}</x-panel.textarea>
                    <div class="tw:flex tw:justify-end tw:border-t tw:border-gray-100 tw:pt-5 tw:dark:border-gray-800">
                        <x-panel.boton id="enviar_encuesta" type="submit" class="tw:w-full tw:sm:w-auto">Enviar encuesta</x-panel.boton>
                    </div>
                </form>
            </x-panel.tarjeta>
        </div>
    @elseif ($estado_encuesta == 1)
        <x-panel.alerta tipo="exito">Encuesta enviada correctamente.</x-panel.alerta>
    @else
        <x-panel.vacio titulo="Encuesta no disponible" />
    @endif
</div>

@push('scripts')
<script>
    document.getElementById('form_enviar_encuesta')?.addEventListener('change', ({target}) => {
        if (target.type !== 'radio') { return; }
        const marcado = target.closest('.tw-campo').querySelector('[data-panel-error]');
        if (marcado) { PanelFormularios.limpiarCampo(marcado); }
    });
</script>
@endpush
