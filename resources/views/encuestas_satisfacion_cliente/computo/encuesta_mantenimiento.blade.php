@use('App\View\EncuestaMantenimiento')

<dl class="tw:mb-4 tw:grid tw:gap-3 tw:text-sm tw:sm:grid-cols-2">
    <div><dt class="tw:font-semibold">Fecha de solicitud</dt><dd>{{ $mantenimiento->fecha_solicita }}</dd></div>
    <div><dt class="tw:font-semibold">Servicio solicitado</dt><dd>{{ $mantenimiento->servicio_solicita }}</dd></div>
</dl>

<form id="form_enviar_encuesta" action="{{ url('/encuestas_satisfaccion/enviar_encuesta_mantenimiento/'.$mantenimiento->id_servicio_mantenimiento) }}"
    method="POST" class="tw:space-y-4" novalidate>
    @csrf
    @foreach (EncuestaMantenimiento::PREGUNTAS as $numero => $pregunta)
        <fieldset class="tw:min-w-0 tw:rounded-xl tw:border tw:border-gray-200 tw:px-4 tw:pb-4 tw:dark:border-gray-700">
            <legend class="tw:max-w-full tw:px-2 tw:text-sm tw:font-medium">{{ $numero }}. {{ $pregunta }}</legend>
            <div class="tw-campo tw:mt-2 tw:flex tw:flex-wrap tw:gap-3">
                @foreach (EncuestaMantenimiento::OPCIONES as $valor => $opcion)
                    <x-panel.radio :id="'pregunta'.$numero.'-'.$valor" :name="'pregunta'.$numero" :value="$valor"
                        :data-panel-etiqueta="'la pregunta '.$numero" required>{{ $opcion }}</x-panel.radio>
                @endforeach
            </div>
        </fieldset>
    @endforeach
    <x-panel.textarea id="sugerencias" name="sugerencias" etiqueta="5. Sugerencias (opcional)" rows="2" />
</form>
