{{--
    Opción (radio) de la plantilla, para encuestas y preguntas de opción múltiple.
    name, id, value, checked, required, onclick… pasan sin cambios al <input>.
    <x-panel.radio name="pregunta_1" value="5" required>Excelente</x-panel.radio>
--}}
<label class="tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2.5 tw:text-sm tw:text-gray-700 tw:select-none tw:dark:text-gray-400">
    <input type="radio" {{ $attributes->class(['tw:size-5 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500']) }}>
    <span>{{ $slot }}</span>
</label>
