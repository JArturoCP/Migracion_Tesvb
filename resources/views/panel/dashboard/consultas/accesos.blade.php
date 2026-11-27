{{--
    Accesos rápidos del dashboard de Planeación y Consultas (misma tarjeta que los demás bloques del dashboard).
    $subtituloAccesos (opcional; por defecto el de Planeación y Consultas). También lo usa el dashboard de Finanzas.
    $accesos: lista de ['titulo', 'detalle', 'icono' (partials/panel/iconos), 'url' (módulo que el rol ya tiene en el sidebar)].
--}}
<div class="tw:h-full tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:sm:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3" data-panel-bloque="accesos">
    <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Accesos rápidos</h3>
    <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $subtituloAccesos ?? 'Módulos principales de Planeación y Consultas' }}</p>
    <ul class="tw:mt-5 tw:grid tw:grid-cols-1 tw:gap-3 tw:sm:grid-cols-2">
        @foreach($accesos as $acceso)
            <li>
                <a href="{{ $acceso['url'] }}" class="tw:flex tw:h-full tw:items-center tw:gap-3 tw:rounded-xl tw:border tw:border-gray-200 tw:p-3 tw:transition tw:hover:border-brand-300 tw:hover:bg-brand-50 tw:dark:border-gray-800 tw:dark:hover:border-brand-500/40 tw:dark:hover:bg-brand-500/10" data-panel-acceso>
                    <span class="tw:flex tw:size-10 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-lg tw:bg-brand-50 tw:text-brand-500 tw:dark:bg-brand-500/15 tw:dark:text-brand-400 tw:[&>svg]:size-5" aria-hidden="true">
                        @include('partials.panel.iconos.' . $acceso['icono'])
                    </span>
                    <span class="tw:min-w-0">
                        <span class="tw:block tw:text-sm tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $acceso['titulo'] }}</span>
                        <span class="tw:block tw:text-xs tw:text-gray-500 tw:dark:text-gray-400">{{ $acceso['detalle'] }}</span>
                    </span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
