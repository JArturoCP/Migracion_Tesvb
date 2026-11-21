<span class="tw:flex tw:size-10 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-lg tw:bg-gray-100 tw:dark:bg-gray-700">
    @include('partials.panel.iconos.'.$acceso['icono'])
</span>
<span class="tw:min-w-0">
    <span class="tw:block tw:text-sm tw:font-semibold tw:wrap-anywhere tw:text-gray-900 tw:dark:text-white">{{ $acceso['titulo'] }}</span>
    <span class="tw:mt-1 tw:block tw:text-sm tw:text-gray-600 tw:dark:text-gray-300">{{ $detalle }}</span>
</span>
