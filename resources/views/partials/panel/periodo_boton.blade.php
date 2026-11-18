{{--
    Botón "Cambiar periodo" del sidebar. Sustituye a los íconos de calendario (#periodo) de
    partials/menu_admin.blade.php (L403, L1162, L1596 y L1931); cada uno se incluye con su misma condición.
    Abre el modal de partials/panel/periodos.blade.php mediante el evento "abrir-periodos".
--}}
<a
    href="#"
    @click.prevent="$dispatch('abrir-periodos')"
    class="group menu-item menu-item-inactive"
    title="{{ Session::get('nombre_periodo') }} — Cambia el periodo aquí"
    data-panel-periodo
>
    @include('partials.panel.iconos.calendario')
    <span class="menu-item-text flex flex-col" :class="sidebarToggle ? 'xl:hidden' : ''">
        <span>Cambiar periodo</span>
        <span class="text-xs font-normal text-gray-500 dark:text-gray-400">{{ Session::get('nombre_periodo') }}</span>
    </span>
</a>
