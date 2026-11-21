<div class="tw:shrink-0 tw:xl:relative" x-data="{ abierto: false }"
    @click.outside="abierto = false" @keydown.escape.stop="if (abierto) { abierto = false; $refs.campana.focus() }">
    <button type="button" x-ref="campana" @click="abierto = !abierto; isApplicationMenuOpen = false"
        :aria-expanded="abierto.toString()" aria-expanded="false" aria-controls="panel-notificaciones-estudiante" aria-label="Notificaciones"
        class="tw:inline-flex tw:size-11 tw:items-center tw:justify-center tw:rounded-[10px] tw:border tw:border-gray-300 tw:text-gray-700 tw:hover:bg-gray-50 tw:focus-visible:outline-2 tw:focus-visible:outline-offset-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:text-gray-200 tw:dark:hover:bg-gray-800">
        <svg aria-hidden="true" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4"/>
        </svg>
        {{-- El contador se habilitará cuando haya una fuente de notificaciones. --}}
    </button>
    <section id="panel-notificaciones-estudiante" aria-labelledby="panel-notificaciones-titulo"
        x-cloak x-show.important="abierto"
        class="tw:absolute tw:inset-x-3 tw:top-full tw:z-50 tw:mt-2 tw:xl:w-72 tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white tw:p-4 tw:shadow-lg tw:xl:right-auto tw:xl:left-0 tw:dark:border-gray-700 tw:dark:bg-gray-800">
        <h2 id="panel-notificaciones-titulo" class="tw:text-sm tw:font-semibold tw:text-gray-900 tw:dark:text-white">Notificaciones recientes</h2>
        <p class="tw:mt-2 tw:text-sm tw:text-gray-600 tw:dark:text-gray-300">No hay notificaciones para mostrar.</p>
        <p class="tw:mt-3 tw:border-t tw:border-gray-200 tw:pt-3 tw:text-xs tw:text-gray-600 tw:dark:border-gray-700 tw:dark:text-gray-300">Historial no disponible</p>
    </section>
</div>
