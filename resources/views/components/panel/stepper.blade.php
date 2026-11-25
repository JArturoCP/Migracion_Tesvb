@props(['id', 'pasos', 'secciones' => null, 'externo' => false])

<div data-panel-stepper-controls hidden class="tw:space-y-3 tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white tw:p-4 tw:dark:border-gray-800 tw:dark:bg-gray-900">
    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-between tw:gap-2 tw:text-sm">
        <span class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">Secciones del formulario</span>
        <span data-stepper-posicion class="tw:font-medium tw:text-brand-600 tw:dark:text-brand-400" aria-live="polite"></span>
    </div>
    <progress data-stepper-progreso value="1" max="{{ count($pasos) }}" aria-label="Posición en el formulario"
        class="tw:block tw:h-2 tw:w-full tw:appearance-none tw:overflow-hidden tw:rounded-full tw:bg-gray-100 tw:dark:bg-gray-800 tw:[&::-webkit-progress-bar]:bg-transparent tw:[&::-webkit-progress-value]:bg-brand-500 tw:[&::-webkit-progress-value]:transition-all tw:[&::-webkit-progress-value]:duration-300 tw:motion-reduce:[&::-webkit-progress-value]:transition-none tw:[&::-moz-progress-bar]:bg-brand-500"></progress>
    <nav aria-label="Secciones del formulario" class="tw:flex tw:flex-wrap tw:gap-2">
        @foreach ($pasos as $paso)
            <button type="button" data-stepper-ir style="min-width: min(100%, 11rem)" aria-controls="{{ $secciones[$loop->index] ?? $id.'-paso-'.$loop->index }}"
                class="tw:group tw:flex tw:min-w-32 tw:flex-1 tw:items-center tw:gap-2 tw:rounded-lg tw:px-3 tw:py-2 tw:text-left tw:text-sm tw:text-gray-700 tw:transition-colors tw:hover:bg-gray-50 tw:focus-visible:outline-2 tw:focus-visible:outline-brand-500 tw:dark:text-gray-300 tw:dark:hover:bg-white/5 tw:aria-[current=step]:bg-brand-50 tw:aria-[current=step]:text-brand-700 tw:dark:aria-[current=step]:bg-brand-500/15 tw:dark:aria-[current=step]:text-brand-300">
                <span aria-hidden="true" class="tw:inline-flex tw:size-6 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-full tw:bg-gray-100 tw:text-xs tw:font-semibold tw:text-gray-700 tw:dark:bg-gray-800 tw:dark:text-gray-300 tw:group-data-[estado=activo]:bg-brand-500 tw:group-data-[estado=activo]:text-white tw:group-data-[estado=completado]:bg-green-100 tw:group-data-[estado=completado]:text-green-800 tw:group-data-[estado=error]:bg-red-100 tw:group-data-[estado=error]:text-red-700">{{ $loop->iteration }}</span>
                <span style="min-width: 0; overflow-wrap: anywhere">{{ $paso }}</span>
                <span data-stepper-alerta hidden aria-hidden="true"><span class="tw:inline-flex tw:size-5 tw:items-center tw:justify-center tw:rounded-full tw:bg-red-100 tw:font-bold tw:text-red-700 tw:dark:bg-red-500/20 tw:dark:text-red-300">!</span></span>
                <span data-stepper-estado class="tw:sr-only"></span>
            </button>
        @endforeach
    </nav>
</div>

@unless ($externo)
@once
    @push('scripts')
        <script src="{{ asset('js/panel/stepper.js') }}?v={{ filemtime(public_path('js/panel/stepper.js')) }}"></script>
    @endpush
@endonce
@endunless
