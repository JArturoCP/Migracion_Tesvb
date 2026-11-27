@use('App\View\EncuestaServicioSocialResidencia')

<div class="tw:mx-auto tw:max-w-4xl">
    <x-panel.encabezado titulo="Encuesta contestada" :migas="$migas" />
    <x-panel.tarjeta :titulo="$nombre" :subtitulo="$subtitulo">
        <dl class="tw:divide-y tw:divide-gray-100 tw:dark:divide-gray-800">
            @foreach (EncuestaServicioSocialResidencia::PREGUNTAS as $numero => $pregunta)
                <div class="tw:grid tw:gap-2 tw:py-4 tw:first:pt-0 tw:sm:grid-cols-[minmax(0,1fr)_auto] tw:sm:gap-x-4">
                    <dt class="tw:text-sm tw:leading-relaxed tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">{{ $numero }}. {{ $pregunta }}</dt>
                    <dd class="tw:sm:text-right">
                        <x-panel.badge>{{ EncuestaServicioSocialResidencia::OPCIONES[$respuestas->{'cal_preg_'.$numero}] ?? 'Sin respuesta' }}</x-panel.badge>
                    </dd>
                </div>
            @endforeach
            <div class="tw:space-y-2 tw:pt-4">
                <dt class="tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Comentarios</dt>
                <dd class="tw:whitespace-pre-wrap tw:break-words tw:text-sm tw:text-gray-600 tw:dark:text-gray-300">{{ filled($respuestas->comentario) ? $respuestas->comentario : 'Sin comentarios' }}</dd>
            </div>
        </dl>
    </x-panel.tarjeta>
</div>
