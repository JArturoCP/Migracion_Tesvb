{{-- Etiqueta de campo de la plantilla. La usan input, select y textarea; también suelta: <x-panel.etiqueta for="foto">Foto</x-panel.etiqueta> --}}
<label {{ $attributes->class(['tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-400']) }}>{{ $slot }}</label>
