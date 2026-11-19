{{-- Encabezado del sidebar (TailAdmin sidebar-header). Logos configurables en config/tesvb.php. --}}
<div class="tw:sidebar-header tw:flex tw:items-center tw:justify-center tw:gap-2 tw:pt-8 tw:pb-8">
    <a href="{{ url('/inicio') }}" class="tw:flex tw:items-center tw:justify-center" data-panel-propio>
        <span class="tw:sr-only">Inicio</span>
        {{-- Logo completo: en modo oscuro va sobre fondo blanco porque el texto del logo es negro. --}}
        <span class="tw:logo" :class="sidebarToggle ? 'tw:xl:hidden' : ''">
            <span class="tw:inline-block tw:rounded-lg tw:dark:bg-white tw:dark:p-1.5">
                <img class="tw:block tw:h-auto tw:w-44" src="{{ asset(config('tesvb.logo')) }}" alt="TESVB">
            </span>
        </span>

        {{-- Ícono para el sidebar colapsado. --}}
        <span class="tw:logo-icon tw:rounded-md tw:dark:bg-white tw:dark:p-0.5" :class="sidebarToggle ? 'tw:xl:block tw:hidden' : 'tw:hidden'">
            <img class="tw:block tw:h-8 tw:w-auto" src="{{ asset(config('tesvb.logo_icono')) }}" alt="TESVB">
        </span>
    </a>
</div>
