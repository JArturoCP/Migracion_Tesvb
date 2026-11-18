{{--
    Campo de la plantilla (TailAdmin "Input"). name, id, value, type, required, accept, v-model… pasan sin cambios.
    <x-panel.input etiqueta="Correo" name="email" id="email" type="email" required />
    ayuda: texto bajo el campo. error: mensaje en rojo (p. ej. $errors->first('email')).
    type="file" usa el estilo de archivo de la plantilla.
--}}
@props(['etiqueta' => null, 'ayuda' => null, 'error' => null])
@php
    $archivo = $attributes->get('type') === 'file';
    $base = $archivo
        ? 'tw-control tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:bg-transparent tw:text-sm tw:text-gray-500 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden'
        : 'tw-control tw:h-11 tw:w-full tw:rounded-lg tw:border tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:ring-3 tw:focus:outline-hidden tw:dark:bg-gray-900 tw:dark:text-white/90';
@endphp
<div class="tw-campo">
    @if ($etiqueta)
        <x-panel.etiqueta :for="$attributes->get('id')">{{ $etiqueta }}</x-panel.etiqueta>
    @endif
    <input {{ $attributes->merge(['type' => 'text'])->class([
        $base,
        'tw:border-gray-300 tw:focus:border-brand-300 tw:focus:ring-brand-500/10 tw:dark:border-gray-700' => ! $error,
        'tw:border-red-300 tw:focus:border-red-300 tw:focus:ring-red-500/10' => $error,
    ]) }}>
    @if ($error)
        <p class="tw:mt-1.5 tw:text-xs tw:text-red-600">{{ $error }}</p>
    @elseif ($ayuda)
        <p class="tw:mt-1.5 tw:text-xs tw:text-gray-500">{{ $ayuda }}</p>
    @endif
</div>
