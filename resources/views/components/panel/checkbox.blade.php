{{--
    Casilla de la plantilla. name, id, value, checked, v-model… pasan sin cambios al <input>.
    <x-panel.checkbox name="acepto" id="acepto" value="1">Acepto los términos</x-panel.checkbox>
--}}
<label class="tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2.5 tw:text-sm tw:text-gray-700 tw:select-none tw:dark:text-gray-400">
    <input type="checkbox" {{ $attributes->class(['tw:size-5 tw:shrink-0 tw:cursor-pointer tw:rounded-md tw:accent-brand-500']) }}>
    <span>{{ $slot }}</span>
</label>
