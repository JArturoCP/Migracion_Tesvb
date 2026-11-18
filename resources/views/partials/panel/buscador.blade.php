{{-- Buscador del header (TailAdmin header/index.html). Ctrl+K / ⌘K lo enfoca; Esc lo limpia.
     Filtra en el navegador los enlaces del sidebar (resources/js/panel/buscador.js). --}}
<form @submit.prevent>
    <div class="tw:xl:w-107.5">
        <div
            data-slot="input-group"
            role="group"
            class="tw:group/input-group tw:relative tw:flex tw:h-11 tw:w-full tw:min-w-0 tw:items-center tw:rounded-[10px] tw:border tw:border-gray-200 tw:bg-transparent tw:shadow-theme-xs tw:outline-hidden tw:transition-colors tw:has-[[data-slot=input-group-control]:focus]:border-brand-300 tw:has-[[data-slot=input-group-control]:focus]:ring-3 tw:has-[[data-slot=input-group-control]:focus]:ring-brand-500/20 tw:dark:border-gray-800 tw:dark:bg-white/3 tw:dark:has-[[data-slot=input-group-control]:focus]:border-brand-500/40"
        >
            <div class="tw:flex tw:h-auto tw:cursor-text tw:items-center tw:justify-center tw:gap-2 tw:py-1.5 tw:ps-3.5 tw:text-sm tw:font-medium tw:text-gray-500 tw:select-none tw:dark:text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" class="tw:size-5 tw:text-gray-500 tw:dark:text-gray-400">
                    <path d="M14.382 14.383l3.325 3.326m-1.249-8.334a7.082 7.082 0 01-7.083 7.081 7.082 7.082 0 110-14.163 7.082 7.082 0 017.083 7.082z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>

            <input
                x-ref="searchInput"
                x-model="$store.buscador.texto"
                @keydown.escape="$store.buscador.limpiar(); $el.blur()"
                data-slot="input-group-control"
                type="search"
                placeholder="Buscar en el menú…"
                aria-label="Buscar en el menú"
                autocomplete="off"
                class="tw:h-full tw:flex-1 tw:rounded-none tw:border-0 tw:bg-transparent tw:px-2 tw:text-sm tw:text-gray-800 tw:shadow-none tw:ring-0 tw:outline-hidden tw:placeholder:text-gray-400 tw:focus:border-transparent tw:focus:ring-0 tw:focus:outline-hidden tw:dark:text-white/90 tw:dark:placeholder:text-white/30"
            />

            <div class="tw:flex tw:h-auto tw:cursor-text tw:items-center tw:justify-center tw:gap-2 tw:py-1.5 tw:pe-3.5 tw:text-sm tw:font-medium tw:text-gray-500 tw:select-none tw:dark:text-gray-400">
                <span
                    @click="$refs.searchInput.focus()"
                    class="tw:inline-flex tw:h-5.5 tw:w-fit tw:shrink-0 tw:cursor-pointer tw:items-center tw:justify-center tw:gap-0.5 tw:rounded-lg tw:border tw:border-gray-200 tw:bg-gray-50 tw:px-1.75 tw:py-[4.5px] tw:text-xs tw:font-medium tw:whitespace-nowrap tw:text-gray-500 tw:select-none tw:dark:border-gray-800 tw:dark:bg-white/3 tw:dark:text-gray-400"
                >
                    <span>Ctrl</span><span>K</span>
                </span>
            </div>
        </div>
    </div>
</form>
