{{--
    Tarjeta de bienvenida del dashboard (/inicio y /ingles).
    $nombre (puede ser null: entonces no se muestra), $periodo (texto completo de la insignia, p. ej. "Periodo actual: …").
--}}
<div class="tw:col-span-12" data-panel-bienvenida>
	<div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:md:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3">
		<p class="tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">Bienvenido(a)</p>
		@if($nombre !== null)
		<h2 class="tw:mt-1 tw:text-xl tw:font-semibold tw:text-gray-800 tw:md:text-2xl tw:dark:text-white/90">{{ $nombre }}</h2>
		@endif
		<p class="tw:mt-3 tw:inline-flex tw:items-center tw:gap-2 tw:rounded-full tw:bg-brand-50 tw:px-3 tw:py-1 tw:text-sm tw:font-medium tw:text-brand-600 tw:dark:bg-brand-500/15 tw:dark:text-brand-400">
			<svg class="tw:size-4" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M8 2.75v2m8-2v2M3.75 9.25h16.5M5.25 4.75h13.5a1.5 1.5 0 011.5 1.5v12.5a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V6.25a1.5 1.5 0 011.5-1.5z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg>
			{{ $periodo }}
		</p>
	</div>
</div>
