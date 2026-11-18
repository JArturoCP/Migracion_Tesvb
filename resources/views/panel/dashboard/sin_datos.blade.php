{{-- Mensaje cuando un dato no está disponible. Nunca se muestran números inventados.
     $alto: clase de altura mínima escrita completa (p. ej. 'min-h-48'), para que Tailwind la genere. --}}
<div class="flex {{ $alto ?? 'min-h-32' }} flex-col items-center justify-center gap-1 rounded-xl border border-dashed border-gray-200 px-4 py-6 text-center dark:border-gray-800" data-panel-sin-datos>
    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Sin datos</p>
    @isset($detalle)
        <p class="text-xs text-gray-400 dark:text-gray-500">{{ $detalle }}</p>
    @endisset
</div>
