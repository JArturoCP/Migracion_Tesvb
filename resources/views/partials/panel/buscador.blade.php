{{-- Buscador del header (TailAdmin header/index.html). Ctrl+K / ⌘K lo enfoca; Esc lo limpia.
     Filtra en el navegador los enlaces del sidebar (resources/js/panel/buscador.js). --}}
<form @submit.prevent>
    <div class="xl:w-107.5">
        <div
            data-slot="input-group"
            role="group"
            class="group/input-group relative flex h-11 w-full min-w-0 items-center rounded-[10px] border border-gray-200 bg-transparent shadow-theme-xs outline-hidden transition-colors has-[[data-slot=input-group-control]:focus]:border-brand-300 has-[[data-slot=input-group-control]:focus]:ring-3 has-[[data-slot=input-group-control]:focus]:ring-brand-500/20 dark:border-gray-800 dark:bg-white/3 dark:has-[[data-slot=input-group-control]:focus]:border-brand-500/40"
        >
            <div class="flex h-auto cursor-text items-center justify-center gap-2 py-1.5 ps-3.5 text-sm font-medium text-gray-500 select-none dark:text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" class="size-5 text-gray-500 dark:text-gray-400">
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
                class="h-full flex-1 rounded-none border-0 bg-transparent px-2 text-sm text-gray-800 shadow-none ring-0 outline-hidden placeholder:text-gray-400 focus:border-transparent focus:ring-0 focus:outline-hidden dark:text-white/90 dark:placeholder:text-white/30"
            />

            <div class="flex h-auto cursor-text items-center justify-center gap-2 py-1.5 pe-3.5 text-sm font-medium text-gray-500 select-none dark:text-gray-400">
                <span
                    @click="$refs.searchInput.focus()"
                    class="inline-flex h-5.5 w-fit shrink-0 cursor-pointer items-center justify-center gap-0.5 rounded-lg border border-gray-200 bg-gray-50 px-1.75 py-[4.5px] text-xs font-medium whitespace-nowrap text-gray-500 select-none dark:border-gray-800 dark:bg-white/3 dark:text-gray-400"
                >
                    <span>Ctrl</span><span>K</span>
                </span>
            </div>
        </div>
    </div>
</form>
