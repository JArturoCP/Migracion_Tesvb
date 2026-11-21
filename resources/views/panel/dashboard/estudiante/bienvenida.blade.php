<section class="tw:flex tw:min-w-0 tw:items-center tw:justify-between tw:gap-5 tw:rounded-2xl tw:border tw:border-gray-200 tw:border-t-4 tw:bg-white tw:p-5 tw:sm:p-7 tw:dark:border-gray-700 tw:dark:bg-gray-800"
    style="border-top-color: {{ $estudiante['acento'] }}">
    <div class="tw:min-w-0">
        <p class="tw:text-sm tw:font-semibold tw:text-gray-600 tw:dark:text-gray-300">Portal estudiantil TESVB</p>
        <h1 class="tw:mt-2 tw:text-2xl tw:font-semibold tw:wrap-anywhere tw:text-gray-900 tw:sm:text-3xl tw:dark:text-white">
            {{ $estudiante['nombre'] ? 'Hola, '.$estudiante['nombre'] : 'Te damos la bienvenida' }}
        </h1>
        @include('panel.dashboard.estudiante.identidad')
        <p class="tw:mt-4 tw:inline-block tw:rounded-lg tw:bg-gray-100 tw:px-3 tw:py-2 tw:text-sm tw:text-gray-700 tw:dark:bg-gray-700 tw:dark:text-gray-100">
            {{ $estudiante['periodo'] ? 'Período escolar · '.$estudiante['periodo'] : 'Período escolar no disponible' }}
        </p>
    </div>
    @if($estudiante['mascota'])
        <img src="{{ $estudiante['mascota'] }}" alt="" width="160" height="160"
            class="tw:hidden tw:size-28 tw:shrink-0 tw:object-contain tw:sm:block tw:lg:size-40">
    @endif
</section>
