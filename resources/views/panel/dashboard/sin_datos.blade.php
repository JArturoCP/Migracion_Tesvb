{{-- Mensaje cuando un dato no está disponible. Nunca se muestran números inventados.
     $alto: clase de altura mínima escrita completa (p. ej. 'tw:min-h-48'), para que Tailwind la genere. --}}
<div class="tw:flex {{ $alto ?? 'tw:min-h-32' }} tw:flex-col tw:items-center tw:justify-center tw:gap-1 tw:rounded-xl tw:border tw:border-dashed tw:border-gray-200 tw:px-4 tw:py-6 tw:text-center tw:dark:border-gray-800" data-panel-sin-datos>
    <p class="tw:text-sm tw:font-medium tw:text-gray-500 tw:dark:text-gray-400">Sin datos</p>
    @isset($detalle)
        <p class="tw:text-xs tw:text-gray-400 tw:dark:text-gray-500">{{ $detalle }}</p>
    @endisset
</div>
