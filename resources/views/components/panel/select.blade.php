{{--
    Lista desplegable de la plantilla (TailAdmin "Select"). Las <option> van en el slot sin cambios.
    <x-panel.select etiqueta="Carrera" name="id_carrera" id="id_carrera">
        @foreach ($carreras as $c)<option value="{{ $c->id }}">{{ $c->nombre }}</option>@endforeach
    </x-panel.select>
--}}
@props(['etiqueta' => null, 'ayuda' => null, 'error' => null])
<div class="tw-campo">
    @if ($etiqueta)
        <x-panel.etiqueta :for="$attributes->get('id')">{{ $etiqueta }}</x-panel.etiqueta>
    @endif
    <div class="tw:relative">
        <select {{ $attributes->class([
            'tw-control tw:h-11 tw:w-full tw:appearance-none tw:rounded-lg tw:border tw:bg-transparent tw:py-2.5 tw:pr-11 tw:pl-4 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:focus:ring-3 tw:focus:outline-hidden tw:dark:bg-gray-900 tw:dark:text-white/90',
            'tw:border-gray-300 tw:focus:border-brand-300 tw:focus:ring-brand-500/10 tw:dark:border-gray-700' => ! $error,
            'tw:border-red-300 tw:focus:ring-red-500/10' => $error,
        ]) }}>{{ $slot }}</select>
        <span class="tw:pointer-events-none tw:absolute tw:top-1/2 tw:right-4 tw:-translate-y-1/2 tw:text-gray-500 tw:dark:text-gray-400" aria-hidden="true">
            <svg class="tw:stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg>
        </span>
    </div>
    @if ($error)
        <p class="tw:mt-1.5 tw:text-xs tw:text-red-600">{{ $error }}</p>
    @elseif ($ayuda)
        <p class="tw:mt-1.5 tw:text-xs tw:text-gray-500 tw:dark:text-gray-400">{{ $ayuda }}</p>
    @endif
</div>
