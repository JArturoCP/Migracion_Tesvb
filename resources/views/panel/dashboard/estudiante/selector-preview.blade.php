<form method="get" class="tw:mb-4 tw:flex tw:flex-wrap tw:items-end tw:gap-2 tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white tw:p-3 tw:text-sm tw:text-gray-800 tw:dark:border-gray-700 tw:dark:bg-gray-800 tw:dark:text-white">
    <p class="tw:w-full tw:font-semibold">Vista previa local · Datos ficticios</p>
    <label class="tw:min-w-0 tw:max-w-full">
        <span class="tw:block">Carrera</span>
        <select name="carrera" class="tw:max-w-full tw:rounded-md tw:border tw:border-gray-300 tw:bg-white tw:p-2 tw:dark:border-gray-600 tw:dark:bg-gray-900">
            @foreach($catalogoVistaPrevia as $clave => $tema)
                <option value="{{ $clave }}" @selected($clave === $claveVistaPrevia)>{{ $tema['name'] }}</option>
            @endforeach
        </select>
    </label>
    <button type="submit" class="tw:rounded-md tw:border tw:border-gray-300 tw:px-3 tw:py-2">Ver carrera</button>
    <span class="tw:flex tw:items-center tw:gap-1 tw:py-2">
        <span aria-hidden="true" class="tw:inline-block tw:size-3 tw:rounded-full" style="background: {{ $colorVistaPrevia }}"></span>
        {{ $colorVistaPrevia }}
    </span>
</form>
