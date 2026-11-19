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
    class="tw:relative"
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
        class="tw:flex tw:items-center tw:text-gray-700 tw:dark:text-gray-400"
    >
        <span class="tw:me-3 tw:flex tw:size-11 tw:items-center tw:justify-center tw:overflow-hidden tw:rounded-lg tw:bg-brand-50 tw:text-brand-500 tw:dark:bg-brand-500/15 tw:dark:text-brand-400">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="tw:size-6">
                <path d="M12 3.5a4 4 0 1 0 0 8 4 4 0 0 0 0-8ZM4.5 20.25c0-3.59 3.36-6.5 7.5-6.5s7.5 2.91 7.5 6.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>

        <span class="tw:me-1 tw:hidden tw:max-w-48 tw:truncate tw:text-sm tw:font-medium tw:sm:block tw:xl:max-w-none">
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

        <svg class="tw:size-5 tw:text-gray-500 tw:transition-transform tw:duration-200 tw:dark:text-gray-400" :class="open ? 'tw:rotate-180' : 'tw:rotate-0'" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4.792 7.396L10 12.604l5.208-5.208" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </button>

    <div
        x-cloak
        x-show.important="open"
        x-ref="menu"
        id="panel-usuario-menu"
        role="menu"
        aria-labelledby="panel-usuario-boton"
        x-transition:enter="tw:animate-in tw:fade-in-0 tw:zoom-in-95 tw:duration-100"
        x-transition:leave="tw:animate-out tw:fade-out-0 tw:zoom-out-95 tw:fill-mode-forwards tw:duration-75"
        class="tw:fixed tw:z-50 tw:flex tw:w-65 tw:flex-col tw:gap-1 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-3 tw:shadow-theme-lg tw:outline-none tw:dark:border-gray-800 tw:dark:bg-[#1E2635]"
    >
        {{-- Misma información que la insignia del menú actual --}}
        <div class="tw:px-3 tw:py-2" data-panel-insignia>
            @if($jefe_division==true || $consultas==true)
                <?php
                    $nombre_carrera = Session::get('nombre_carrera');
                    $id_carrera = Session::get('id_carrera');
                ?>
                <span class="tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">{{$nombre}} . {{ $nombre_carrera }}</span>
                <span class="tw:mt-0.5 tw:block tw:text-xs tw:text-gray-500 tw:dark:text-gray-400">{{ $nperiodo }}</span>
            @else
                @if($profesor_ingles==true)
                    <?php
                        $nombre_ingles = Session::get('nombre_ingles');
                        $nombre_periodo_ingles = Session::get('nombre_periodo_ingles');
                    ?>
                    <span class="tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">{{$nombre_ingles}}</span>
                    <span class="tw:mt-0.5 tw:block tw:text-xs tw:text-gray-500 tw:dark:text-gray-400">{{ $nombre_periodo_ingles }}</span>
                @else
                    <span class="tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">{{$nombre}}</span>
                    <span class="tw:mt-0.5 tw:block tw:text-xs tw:text-gray-500 tw:dark:text-gray-400">{{ $nperiodo }}</span>
                @endif
            @endif
        </div>

        <div class="tw:-mx-3 tw:my-1.5 tw:h-px tw:bg-gray-100 tw:dark:bg-gray-700"></div>

        {{-- Cerrar sesión: mismo POST /logout con CSRF que el menú actual --}}
        <form action="{{ url('/logout') }}" method="POST">
            {{ csrf_field() }}
            <button
                type="submit"
                role="menuitem"
                class="tw:group/dropdown-menu-item tw:relative tw:flex tw:w-full tw:cursor-pointer tw:items-center tw:gap-3 tw:rounded-lg tw:px-3 tw:py-2.5 tw:text-sm tw:font-medium tw:text-red-500 tw:outline-hidden tw:transition-colors tw:duration-200 tw:select-none tw:hover:bg-red-50 tw:hover:text-red-600 tw:focus:bg-red-50 tw:focus:text-red-600 tw:dark:text-red-400 tw:dark:hover:bg-red-500/10 tw:dark:hover:text-red-400 tw:dark:focus:bg-red-500/10 tw:dark:focus:text-red-400"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="tw:size-5 tw:text-red-500 tw:dark:text-red-400">
                    <path d="M4 12h7.75M8 8l-3.998 4 3.997 4M9.75 4.996V4.25a1.5 1.5 0 011.5-1.5h6a1.5 1.5 0 011.5 1.5v15.5a1.5 1.5 0 01-1.5 1.5h-6a1.5 1.5 0 01-1.5-1.5V19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>Cerrar sesión</span>
            </button>
        </form>
    </div>
</div>
