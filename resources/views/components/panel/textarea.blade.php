{{--
    Área de texto de la plantilla (TailAdmin "TextArea"). El valor va en el slot.
    <x-panel.textarea etiqueta="Comentario" name="comentario" id="comentario" rows="4">{{ old('comentario') }}</x-panel.textarea>
--}}
@props(['etiqueta' => null, 'ayuda' => null, 'error' => null])
<div class="tw-campo">
    @if ($etiqueta)
        <x-panel.etiqueta :for="$attributes->get('id')">{{ $etiqueta }}</x-panel.etiqueta>
    @endif
    <textarea {{ $attributes->merge(['rows' => 4])->class([
        'tw-control tw:w-full tw:rounded-lg tw:border tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:ring-3 tw:focus:outline-hidden tw:dark:bg-gray-900 tw:dark:text-white/90',
        'tw:border-gray-300 tw:focus:border-brand-300 tw:focus:ring-brand-500/10 tw:dark:border-gray-700' => ! $error,
        'tw:border-red-300 tw:focus:ring-red-500/10' => $error,
    ]) }}>{{ $slot }}</textarea>
    @if ($error)
        <p class="tw:mt-1.5 tw:text-xs tw:text-red-600">{{ $error }}</p>
    @elseif ($ayuda)
        <p class="tw:mt-1.5 tw:text-xs tw:text-gray-500">{{ $ayuda }}</p>
    @endif
</div>
