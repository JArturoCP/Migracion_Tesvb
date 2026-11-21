<div class="tw:mt-3 tw:flex tw:min-w-0 tw:items-center tw:gap-3" data-identidad-carrera>
    @if($estudiante['logo'])
        <span class="tw:flex tw:size-12 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-md tw:bg-white tw:p-1">
            <img src="{{ $estudiante['logo'] }}" alt="" class="tw:size-full tw:object-contain">
        </span>
    @endif
    <p class="tw:min-w-0 tw:text-base tw:font-medium tw:wrap-anywhere tw:text-gray-700 tw:dark:text-gray-200">
        {{ $estudiante['carrera'] ?? 'Carrera no disponible' }}
    </p>
</div>
