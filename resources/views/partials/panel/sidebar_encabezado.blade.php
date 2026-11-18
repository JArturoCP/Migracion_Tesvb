{{-- Encabezado del sidebar (TailAdmin sidebar-header). Logos configurables en config/tesvb.php. --}}
<div
    :class="sidebarToggle ? 'xl:justify-center' : 'justify-between'"
    class="sidebar-header flex items-center gap-2 pt-5 pb-8"
>
    <a href="{{ url('/inicio') }}" data-panel-propio>
        <span class="sr-only">Inicio</span>
        {{-- Logo completo: en modo oscuro va sobre fondo blanco porque el texto del logo es negro. --}}
        <span class="logo" :class="sidebarToggle ? 'xl:hidden' : ''">
            <span class="inline-block rounded-lg dark:bg-white dark:p-1.5">
                <img class="h-12 w-auto" src="{{ asset(config('tesvb.logo')) }}" alt="TESVB">
            </span>
        </span>

        {{-- Ícono para el sidebar colapsado. --}}
        <span class="logo-icon rounded-md dark:bg-white dark:p-0.5" :class="sidebarToggle ? 'xl:block hidden' : 'hidden'">
            <img class="h-8 w-auto" src="{{ asset(config('tesvb.logo_icono')) }}" alt="TESVB">
        </span>
    </a>
</div>
