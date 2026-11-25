{{-- Encabezado del sidebar (TailAdmin sidebar-header). Logos configurables en config/tesvb.php. --}}
<div class="tw:sidebar-header tw:flex tw:items-center tw:justify-center tw:gap-2 tw:pt-8 tw:pb-8">
    <a href="{{ url('/inicio') }}" class="tw:flex tw:items-center tw:justify-center" data-panel-propio>
        <span class="tw:sr-only">Inicio</span>
        {{-- Logo completo: la superficie neutra conserva el contraste de la leyenda negra en modo oscuro. --}}
        <span class="tw:logo" :class="sidebarToggle ? 'tw:xl:hidden' : ''">
            <span class="tw:inline-block tw:rounded-lg tw:dark:p-1" :style="darkMode ? { backgroundColor: 'var(--tw-color-gray-300)' } : {}">
                <img class="tw:block tw:h-auto tw:w-44" src="{{ asset(config('tesvb.logo')) }}" alt="TESVB">
            </span>
        </span>

        {{-- Ícono para el sidebar colapsado. --}}
        <span class="tw:logo-icon" :class="sidebarToggle ? 'tw:xl:block tw:hidden' : 'tw:hidden'">
            <img class="tw:block tw:h-8 tw:w-auto" src="{{ asset(config('tesvb.logo_icono')) }}" alt="TESVB">
        </span>
    </a>
</div>
