{{-- Botón de modo oscuro (TailAdmin header/theme-toggler.html). Guarda la preferencia en localStorage.darkMode. --}}
<button
    type="button"
    @click.prevent="darkMode = !darkMode; document.documentElement.classList.toggle('dark', darkMode)"
    class="tw:relative tw:inline-flex tw:size-11 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-[10px] tw:border tw:border-gray-300 tw:bg-transparent tw:text-gray-700 tw:shadow-theme-xs tw:transition-all tw:select-none tw:hover:bg-gray-50 tw:hover:text-gray-800 tw:focus-visible:ring-3 tw:focus-visible:ring-gray-300/50 tw:focus-visible:outline-hidden tw:active:translate-y-px tw:dark:border-gray-700 tw:dark:bg-gray-800 tw:dark:text-gray-300 tw:dark:hover:bg-gray-700/50 tw:dark:hover:text-white"
    aria-label="Cambiar entre modo claro y oscuro"
>
    {{-- Sol (visible en modo oscuro) --}}
    <svg x-cloak x-show.important="darkMode" class="tw:size-auto!" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
        <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.5" />
        <path d="M12 2v2m0 16v2M4.22 4.22l1.42 1.42m12.72 12.72l1.42 1.42M2 12h2m16 0h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
    </svg>

    {{-- Luna (visible en modo claro) --}}
    <svg x-cloak x-show.important="!darkMode" class="tw:size-auto!" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
        <path d="M6.247 6.668a6.668 6.668 0 0011.207 4.885A7.708 7.708 0 118.03 2.129a6.645 6.645 0 00-1.783 4.54z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</button>
