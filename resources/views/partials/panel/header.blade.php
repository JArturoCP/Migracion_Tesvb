{{-- Header del nuevo diseño (TailAdmin header/index.html): botón del menú, buscador, modo oscuro y usuario. --}}
<header
    x-data="{ isApplicationMenuOpen: false }"
    @keydown.window="(e) => { if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k') { e.preventDefault(); $refs.searchInput?.focus(); } }"
    class="sticky top-0 z-50 flex w-full shrink-0 border-gray-200 bg-white xl:border-b dark:border-gray-800 dark:bg-gray-900"
>
    <div class="flex grow flex-col items-center justify-between xl:flex-row xl:px-6">
        {{-- Lado izquierdo --}}
        <div class="flex w-full items-center justify-between gap-2 border-b border-gray-200 px-3 py-3 sm:gap-4 xl:justify-normal xl:border-b-0 xl:px-0 xl:py-4 dark:border-gray-800">
            {{-- Botón para mostrar u ocultar el sidebar --}}
            <button
                type="button"
                @click.stop="sidebarToggle = !sidebarToggle"
                aria-label="Mostrar u ocultar el menú"
                class="group/button relative inline-flex size-10 shrink-0 items-center justify-center rounded-[10px] border border-gray-300 bg-transparent text-gray-500 shadow-theme-xs transition-all select-none hover:bg-gray-50 hover:text-gray-800 focus-visible:ring-3 focus-visible:ring-gray-300/50 focus-visible:outline-hidden active:translate-y-px lg:size-11 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700/50 dark:hover:text-white"
            >
                <svg x-show="sidebarToggle && window.innerWidth < 1280" class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18M6 6l12 12" />
                </svg>
                <svg x-show="!sidebarToggle || window.innerWidth >= 1280" class="size-auto!" width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" d="M0.583252 1C0.583252 0.585788 0.919038 0.25 1.33325 0.25H14.6666C15.0808 0.25 15.4166 0.585786 15.4166 1C15.4166 1.41421 15.0808 1.75 14.6666 1.75L1.33325 1.75C0.919038 1.75 0.583252 1.41422 0.583252 1ZM0.583252 11C0.583252 10.5858 0.919038 10.25 1.33325 10.25L14.6666 10.25C15.0808 10.25 15.4166 10.5858 15.4166 11C15.4166 11.4142 15.0808 11.75 14.6666 11.75L1.33325 11.75C0.919038 11.75 0.583252 11.4142 0.583252 11ZM1.33325 5.25C0.919038 5.25 0.583252 5.58579 0.583252 6C0.583252 6.41421 0.919038 6.75 1.33325 6.75L7.99992 6.75C8.41413 6.75 8.74992 6.41421 8.74992 6C8.74992 5.58579 8.41413 5.25 7.99992 5.25L1.33325 5.25Z" />
                </svg>
            </button>

            {{-- Logo en móvil --}}
            <a href="{{ url('/inicio') }}" class="xl:hidden">
                <span class="inline-block rounded-md dark:bg-white dark:p-1">
                    <img class="h-8 w-auto" src="{{ asset(config('tesvb.logo')) }}" alt="TESVB">
                </span>
            </a>

            {{-- Botón de acciones en móvil --}}
            <button
                type="button"
                @click="isApplicationMenuOpen = !isApplicationMenuOpen"
                aria-label="Mostrar acciones"
                class="inline-flex size-10 shrink-0 items-center justify-center rounded-[10px] border-none bg-transparent text-gray-700 transition-all select-none hover:bg-gray-50 hover:text-gray-800 focus-visible:ring-3 focus-visible:ring-gray-300/50 focus-visible:outline-hidden xl:hidden dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700/50 dark:hover:text-white"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="1" /><circle cx="19" cy="12" r="1" /><circle cx="5" cy="12" r="1" />
                </svg>
            </button>

            {{-- Buscador (escritorio): filtra los enlaces del sidebar en el navegador --}}
            <div class="hidden xl:block">
                @include('partials.panel.buscador')
            </div>
        </div>

        {{-- Lado derecho --}}
        <div
            class="w-full items-center justify-between gap-4 px-5 py-4 shadow-theme-md xl:flex xl:justify-end xl:px-0 xl:shadow-none"
            :class="isApplicationMenuOpen ? 'flex' : 'hidden'"
        >
            <div class="flex items-center gap-2 2xsm:gap-3">
                @include('partials.panel.periodo_header')
                @include('partials.panel.tema')
            </div>

            @include('partials.panel.usuario')
        </div>
    </div>
</header>
