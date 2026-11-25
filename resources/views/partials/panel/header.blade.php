{{-- Header del nuevo diseño (TailAdmin header/index.html): botón del menú, buscador, modo oscuro y usuario. --}}
<header
    x-data="{ isApplicationMenuOpen: false }"
    @keydown.window="(e) => { if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k') { e.preventDefault(); $refs.searchInput?.focus(); } }"
    class="tw-marco tw:sticky tw:top-0 tw:z-50 tw:flex tw:w-full tw:shrink-0 tw:border-gray-200 tw:bg-white tw:xl:border-b tw:dark:border-gray-800 tw:dark:bg-gray-900"
>
    <div class="tw:flex tw:grow tw:flex-col tw:items-center tw:justify-between tw:xl:flex-row tw:xl:px-6">
        {{-- Lado izquierdo --}}
        <div class="tw:flex tw:w-full tw:items-center tw:justify-between tw:gap-2 tw:border-b tw:border-gray-200 tw:px-3 tw:py-3 tw:sm:gap-4 tw:xl:justify-normal tw:xl:border-b-0 tw:xl:px-0 tw:xl:py-4 tw:dark:border-gray-800">
            {{-- Botón para mostrar u ocultar el sidebar --}}
            <button
                type="button"
                @click.stop="sidebarToggle = !sidebarToggle"
                aria-label="Mostrar u ocultar el menú"
                class="tw:group/button tw:relative tw:inline-flex tw:size-10 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-[10px] tw:border tw:border-gray-300 tw:bg-transparent tw:text-gray-500 tw:shadow-theme-xs tw:transition-all tw:select-none tw:hover:bg-gray-50 tw:hover:text-gray-800 tw:focus-visible:ring-3 tw:focus-visible:ring-gray-300/50 tw:focus-visible:outline-hidden tw:active:translate-y-px tw:lg:size-11 tw:dark:border-gray-700 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:hover:bg-gray-700/50 tw:dark:hover:text-white"
            >
                <svg x-show.important="sidebarToggle && window.innerWidth < 1280" class="tw:size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18M6 6l12 12" />
                </svg>
                <svg x-show.important="!sidebarToggle || window.innerWidth >= 1280" class="tw:size-auto!" width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" d="M0.583252 1C0.583252 0.585788 0.919038 0.25 1.33325 0.25H14.6666C15.0808 0.25 15.4166 0.585786 15.4166 1C15.4166 1.41421 15.0808 1.75 14.6666 1.75L1.33325 1.75C0.919038 1.75 0.583252 1.41422 0.583252 1ZM0.583252 11C0.583252 10.5858 0.919038 10.25 1.33325 10.25L14.6666 10.25C15.0808 10.25 15.4166 10.5858 15.4166 11C15.4166 11.4142 15.0808 11.75 14.6666 11.75L1.33325 11.75C0.919038 11.75 0.583252 11.4142 0.583252 11ZM1.33325 5.25C0.919038 5.25 0.583252 5.58579 0.583252 6C0.583252 6.41421 0.919038 6.75 1.33325 6.75L7.99992 6.75C8.41413 6.75 8.74992 6.41421 8.74992 6C8.74992 5.58579 8.41413 5.25 7.99992 5.25L1.33325 5.25Z" />
                </svg>
            </button>

            {{-- Logo en móvil --}}
            <a href="{{ !empty($vistaPreviaDashboard) ? '#main-content' : url('/inicio') }}" class="tw:xl:hidden">
                <span class="tw:inline-block tw:rounded-md tw:dark:bg-white tw:dark:p-1">
                    <img class="tw:h-8 tw:w-auto" src="{{ asset(config('tesvb.logo')) }}" alt="TESVB">
                </span>
            </a>

            {{-- Botón de acciones en móvil --}}
            <button
                type="button"
                @click="isApplicationMenuOpen = !isApplicationMenuOpen"
                aria-label="Mostrar acciones"
                class="tw:inline-flex tw:size-10 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-[10px] tw:border-none tw:bg-transparent tw:text-gray-700 tw:transition-all tw:select-none tw:hover:bg-gray-50 tw:hover:text-gray-800 tw:focus-visible:ring-3 tw:focus-visible:ring-gray-300/50 tw:focus-visible:outline-hidden tw:xl:hidden tw:dark:border-gray-700 tw:dark:text-gray-400 tw:dark:hover:bg-gray-700/50 tw:dark:hover:text-white"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="1" /><circle cx="19" cy="12" r="1" /><circle cx="5" cy="12" r="1" />
                </svg>
            </button>

            @if(empty($vistaPreviaDashboard) && !empty($estudiante))
                @include('partials.panel.notificaciones_estudiante')
            @endif

            {{-- Buscador (escritorio): filtra los enlaces del sidebar en el navegador --}}
            <div class="tw:hidden tw:xl:block">
                @empty($vistaPreviaDashboard)
                    @include('partials.panel.buscador')
                @endempty
            </div>
        </div>

        {{-- Lado derecho --}}
        <div
            class="tw:w-full tw:items-center tw:justify-between tw:gap-4 tw:px-5 tw:py-4 tw:shadow-theme-md tw:xl:flex tw:xl:justify-end tw:xl:px-0 tw:xl:shadow-none"
            :class="isApplicationMenuOpen ? 'tw:flex' : 'tw:hidden'"
        >
            <div class="tw:flex tw:items-center tw:gap-2 tw:2xsm:gap-3">
                @empty($vistaPreviaDashboard)
                    @include('partials.panel.periodo_ingles_header')
                    @include('partials.panel.periodo_header')
                @endempty
                {{-- Modo oscuro: siempre, en el mismo lugar (en el marco solo cambia el sidebar y el header). --}}
                @include('partials.panel.tema')
            </div>

            @empty($vistaPreviaDashboard)
                @include('partials.panel.usuario')
            @else
                <span class="tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">Cuenta de muestra</span>
            @endempty
        </div>
    </div>
</header>
