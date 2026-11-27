@use('App\View\EncuestaEscolar')
@php($solicitaMotivo = (string) old('pregunta10') === '1')

<div class="tw:mx-auto tw:max-w-4xl">
    <x-panel.encabezado :titulo="$titulo" />

    <div class="tw:space-y-5">
        <x-panel.tarjeta>
            <div class="tw:space-y-3 tw:text-sm tw:leading-relaxed tw:text-gray-600 tw:dark:text-gray-300">
                <p class="tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Estimado estudiante:</p>
                <p>En nuestro Tecnológico tenemos el firme compromiso de satisfacer plenamente tus necesidades y requerimientos en los servicios que ofrecemos, buscando mejorar permanentemente nuestro desempeño y serviste mejor.</p>
                <p>Para lograr esto, lo más valioso es tu opinión, por lo que se solicita responder con sinceridad un breve cuestionario anexo, cuya respuesta será la mejor ayuda para superamos.</p>
                <p>Se agradece tu atención a la presente y me reitero a tu disposición.</p>
                <p class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">ATENTAMENTE<br>SUBDIRECCIÓN DE SERVICIO ESCOLARES</p>
            </div>
        </x-panel.tarjeta>

        <x-panel.tarjeta titulo="Cuestionario" subtitulo="Responde las 11 preguntas. Los comentarios son opcionales.">
            <form id="form_enviar_encuesta" data-panel-envio method="POST" action="{{ $accion }}" class="tw:space-y-6">
                @csrf

                @foreach (EncuestaEscolar::PREGUNTAS as $numero => $pregunta)
                    @php($nombre = 'pregunta'.$numero)
                    <fieldset class="tw:min-w-0 tw:rounded-xl tw:border tw:border-gray-200 tw:px-4 tw:pb-4 tw:dark:border-gray-700 tw:has-[[aria-invalid=true]]:border-red-300">
                        <legend class="tw:max-w-full tw:px-2 tw:text-sm tw:leading-relaxed tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                            {{ $numero }}. {{ $pregunta }}
                        </legend>

                        <div class="tw-campo tw:mt-2 tw:grid tw:grid-cols-2 tw:gap-x-3 tw:gap-y-3 tw:sm:flex tw:sm:flex-wrap tw:sm:gap-x-8">
                            @foreach ($numero === 10 ? EncuestaEscolar::RECHAZADO : EncuestaEscolar::ESCALA as $valor => $respuesta)
                                <x-panel.radio :name="$nombre" :id="$nombre.'-'.$valor" :value="$valor"
                                    :data-panel-etiqueta="'la pregunta '.$numero" :checked="(string) old($nombre) === (string) $valor" required>
                                    {{ $respuesta }}
                                </x-panel.radio>
                            @endforeach
                        </div>

                        @if ($numero === 10)
                            <div id="encuesta-motivo" class="tw:mt-4" @if (! $solicitaMotivo) hidden @endif>
                                <x-panel.textarea etiqueta="Menciona el motivo o requisito que te hizo falta" id="motivo" name="motivo" rows="2"
                                    :required="$solicitaMotivo" :disabled="! $solicitaMotivo">{{ old('motivo') }}</x-panel.textarea>
                            </div>
                        @endif
                    </fieldset>
                @endforeach

                <x-panel.textarea etiqueta="Comentarios (opcional)" id="comentario" name="comentario" rows="3">{{ old('comentario') }}</x-panel.textarea>

                <div class="tw:flex tw:justify-end tw:border-t tw:border-gray-100 tw:pt-5 tw:dark:border-gray-800">
                    <x-panel.boton id="enviar_encuesta" type="submit" class="tw:w-full tw:sm:w-auto">Enviar encuesta</x-panel.boton>
                </div>
            </form>
        </x-panel.tarjeta>
    </div>
</div>

@push('scripts')
    <script>
        (() => {
            const form = document.getElementById('form_enviar_encuesta');
            const contenedor = document.getElementById('encuesta-motivo');
            const motivo = form.elements.motivo;

            function actualizarMotivo() {
                const aplica = form.elements.pregunta10.value === '1';
                contenedor.hidden = !aplica;
                motivo.disabled = !aplica;
                motivo.required = aplica;
                if (!aplica) { window.PanelFormularios.limpiarCampo(motivo); }
            }

            form.addEventListener('change', ({target}) => {
                if (target.type !== 'radio') { return; }
                // La alerta del grupo se asocia a su primera opción, aunque se elija otra.
                const marcado = target.closest('.tw-campo').querySelector('[data-panel-error]');
                if (marcado) { window.PanelFormularios.limpiarCampo(marcado); }
                if (target.name === 'pregunta10') { actualizarMotivo(); }
            });

            window.addEventListener('pageshow', actualizarMotivo);
            actualizarMotivo();
        })();
    </script>
@endpush
