@use('App\View\EncuestaMantenimiento')

<dl class="tw:space-y-3 tw:text-sm">
    <div><dt class="tw:font-semibold">Nombre</dt><dd>{{ $mantenimiento->nombre }}</dd></div>
    <div><dt class="tw:font-semibold">Fecha de la solicitud</dt><dd>{{ $mantenimiento->fecha_solicita }}</dd></div>
    <div><dt class="tw:font-semibold">Servicio solicitado</dt><dd>{{ $mantenimiento->servicio_solicita }}</dd></div>
</dl>

<dl class="tw:mt-4 tw:divide-y tw:divide-gray-100 tw:dark:divide-gray-800">
    @foreach (EncuestaMantenimiento::PREGUNTAS as $numero => $pregunta)
        <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-between tw:gap-2 tw:py-3 tw:text-sm">
            <dt>{{ $numero }}. {{ $pregunta }}</dt>
            <dd><x-panel.badge>{{ EncuestaMantenimiento::OPCIONES[$mantenimiento->{'cal_preg_'.$numero}] ?? 'Sin respuesta' }}</x-panel.badge></dd>
        </div>
    @endforeach
    @if (filled($mantenimiento->sugerencias))
        <div class="tw:space-y-1 tw:py-3 tw:text-sm">
            <dt class="tw:font-semibold">5. Sugerencias</dt>
            <dd class="tw:whitespace-pre-wrap tw:break-words">{{ $mantenimiento->sugerencias }}</dd>
        </div>
    @endif
</dl>
