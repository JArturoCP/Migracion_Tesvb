@php
    $cerrado = (int) $estado_periodo_periodo !== 0;
    $pendientes = $cerrado ? $encuestas_rechazadas->contar : $encuesta_no_enviadas->contar;
@endphp

<div class="tw:mx-auto tw:max-w-4xl">
    <x-panel.encabezado :titulo="$titulo" />

    <x-panel.tarjeta titulo="Resumen del periodo" :subtitulo="$periodo_nom?->periodo">
        <x-slot:acciones>
            <x-panel.badge :tono="$cerrado ? 'gris' : 'exito'">{{ $cerrado ? 'Periodo terminado' : 'Periodo abierto' }}</x-panel.badge>
        </x-slot:acciones>

        <dl class="tw:grid tw:gap-4 tw:sm:grid-cols-2">
            <div class="tw:rounded-xl tw:border tw:border-gray-200 tw:bg-gray-50 tw:p-4 tw:dark:border-gray-700 tw:dark:bg-white/5">
                <dt class="tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">Encuestas contestadas</dt>
                <dd class="tw:mt-2 tw:text-2xl tw:font-semibold tw:text-gray-900 tw:dark:text-white">{{ $encuestas_enviadas->contar }}</dd>
            </div>
            <div class="tw:rounded-xl tw:border tw:border-gray-200 tw:bg-gray-50 tw:p-4 tw:dark:border-gray-700 tw:dark:bg-white/5">
                <dt class="tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">{{ $cerrado ? 'Encuestas rechazadas' : 'Encuestas no contestadas' }}</dt>
                <dd class="tw:mt-2 tw:text-2xl tw:font-semibold tw:text-gray-900 tw:dark:text-white">{{ $pendientes }}</dd>
            </div>
        </dl>

        <div class="tw:mt-5 tw:grid tw:gap-3 tw:sm:flex tw:sm:flex-wrap tw:sm:justify-end">
            <x-panel.boton :href="$urlCarreras" variante="secundario">Ver encuestas</x-panel.boton>
            @if ($cerrado)
                <x-panel.boton :href="$urlResultados">Ver resultados</x-panel.boton>
            @else
                <x-panel.boton variante="peligro" data-toggle="modal" data-target="#modal_enviar">Terminar el periodo</x-panel.boton>
            @endif
        </div>
    </x-panel.tarjeta>
</div>

@unless ($cerrado)
    <x-panel.modal id="modal_enviar" aria-labelledby="terminar-periodo-titulo" aria-describedby="terminar-periodo-descripcion" sin-relleno>
        <x-slot:encabezado>
            <h4 id="terminar-periodo-titulo" class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Terminar el periodo</h4>
        </x-slot:encabezado>

        <form id="form_envio_encuesta" method="POST" action="{{ $urlCierre }}" data-panel-envio>
            @csrf
            <div class="tw-modal-cuerpo">
                <p id="terminar-periodo-descripcion" class="tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">
                    Las encuestas sin contestar de este periodo se marcarán como rechazadas.
                </p>
            </div>
            <x-panel.modal-pie>
                <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
                <x-panel.boton id="envio_encuesta" type="submit" variante="peligro">Confirmar cierre</x-panel.boton>
            </x-panel.modal-pie>
        </form>
    </x-panel.modal>
@endunless
