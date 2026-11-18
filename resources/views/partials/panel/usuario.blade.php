{{--
    Menú de usuario (TailAdmin header/user-dropdown.html).
    El texto del usuario reproduce la insignia de partials/menu_admin.blade.php L340-370 con la misma lógica:
    jefe de división o consultas → nombre . carrera periodo; profesor de inglés → nombre y periodo de inglés;
    resto → nombre y periodo.
--}}
<?php
    // Copiado de partials/menu_admin.blade.php (L11, L13, L24 y L340-346).
    $jefe_division = session()->has('jefe_division') ? session()->has('jefe_division') : false;
    $consultas = session()->has('consultas') ? session()->has('consultas') : false;
    $profesor_ingles = session()->has('profesor_ingles') ? session()->has('profesor_ingles') : false;
    $nombre = Session::get('nombre');
    $nperiodo = Session::get('nombre_periodo');
?>
<div
    class="relative"
    x-data="dropdown({ placement: 'bottom-end', offset: 8 })"
    @click.outside="open = false"
    @keydown.escape.window="open = false"
>
    <button
        type="button"
        x-ref="trigger"
        id="panel-usuario-boton"
        aria-haspopup="menu"
        :aria-expanded="open.toString()"
        aria-controls="panel-usuario-menu"
        @click="toggle()"
        class="flex items-center text-gray-700 dark:text-gray-400"
    >
        <span class="me-3 flex size-11 items-center justify-center overflow-hidden rounded-lg bg-brand-50 text-brand-500 dark:bg-brand-500/15 dark:text-brand-400">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="size-6">
                <path d="M12 3.5a4 4 0 1 0 0 8 4 4 0 0 0 0-8ZM4.5 20.25c0-3.59 3.36-6.5 7.5-6.5s7.5 2.91 7.5 6.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>

        <span class="me-1 hidden max-w-56 truncate text-sm font-medium sm:block">
            @if($jefe_division==true || $consultas==true)
                {{ $nombre }}
            @else
                @if($profesor_ingles==true)
                    {{ Session::get('nombre_ingles') }}
                @else
                    {{ $nombre }}
                @endif
            @endif
        </span>

        <svg class="size-5 text-gray-500 transition-transform duration-200 dark:text-gray-400" :class="open ? 'rotate-180' : 'rotate-0'" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4.792 7.396L10 12.604l5.208-5.208" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </button>

    <div
        x-cloak
        x-show="open"
        x-ref="menu"
        id="panel-usuario-menu"
        role="menu"
        aria-labelledby="panel-usuario-boton"
        x-transition:enter="animate-in fade-in-0 zoom-in-95 duration-100"
        x-transition:leave="animate-out fade-out-0 zoom-out-95 fill-mode-forwards duration-75"
        class="fixed z-50 flex w-65 flex-col gap-1 rounded-2xl border border-gray-200 bg-white p-3 shadow-theme-lg outline-none dark:border-gray-800 dark:bg-[#1E2635]"
    >
        {{-- Misma información que la insignia del menú actual --}}
        <div class="px-3 py-2" data-panel-insignia>
            @if($jefe_division==true || $consultas==true)
                <?php
                    $nombre_carrera = Session::get('nombre_carrera');
                    $id_carrera = Session::get('id_carrera');
                ?>
                <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{$nombre}} . {{ $nombre_carrera }}</span>
                <span class="mt-0.5 block text-xs text-gray-500 dark:text-gray-400">{{ $nperiodo }}</span>
            @else
                @if($profesor_ingles==true)
                    <?php
                        $nombre_ingles = Session::get('nombre_ingles');
                        $nombre_periodo_ingles = Session::get('nombre_periodo_ingles');
                    ?>
                    <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{$nombre_ingles}}</span>
                    <span class="mt-0.5 block text-xs text-gray-500 dark:text-gray-400">{{ $nombre_periodo_ingles }}</span>
                @else
                    <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{$nombre}}</span>
                    <span class="mt-0.5 block text-xs text-gray-500 dark:text-gray-400">{{ $nperiodo }}</span>
                @endif
            @endif
        </div>

        <div class="-mx-3 my-1.5 h-px bg-gray-100 dark:bg-gray-700"></div>

        {{-- Cerrar sesión: mismo POST /logout con CSRF que el menú actual --}}
        <form action="{{ url('/logout') }}" method="POST">
            {{ csrf_field() }}
            <button
                type="submit"
                role="menuitem"
                class="group/dropdown-menu-item relative flex w-full cursor-pointer items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-red-500 outline-hidden transition-colors duration-200 select-none hover:bg-red-50 hover:text-red-600 focus:bg-red-50 focus:text-red-600 dark:text-red-400 dark:hover:bg-red-500/10 dark:hover:text-red-400 dark:focus:bg-red-500/10 dark:focus:text-red-400"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="size-5 text-red-500 dark:text-red-400">
                    <path d="M4 12h7.75M8 8l-3.998 4 3.997 4M9.75 4.996V4.25a1.5 1.5 0 011.5-1.5h6a1.5 1.5 0 011.5 1.5v15.5a1.5 1.5 0 01-1.5 1.5h-6a1.5 1.5 0 01-1.5-1.5V19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>Cerrar sesión</span>
            </button>
        </form>
    </div>
</div>
