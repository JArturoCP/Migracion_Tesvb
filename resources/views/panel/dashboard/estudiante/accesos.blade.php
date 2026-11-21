<section aria-labelledby="estudiante-accesos">
    <h2 id="estudiante-accesos" class="tw:mb-3 tw:text-lg tw:font-semibold tw:text-gray-900 tw:dark:text-white">Accesos rápidos</h2>
    <ul class="tw:grid tw:grid-cols-[repeat(auto-fit,minmax(min(100%,12rem),1fr))] tw:gap-3">
        @foreach($estudiante['accesos'] as $acceso)
            <li class="tw:min-w-0">
                @if($acceso['url'])
                    <a href="{{ $acceso['url'] }}" class="tw:flex tw:h-full tw:min-h-20 tw:items-center tw:gap-3 tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white tw:p-4 tw:hover:border-brand-500 tw:focus-visible:outline-2 tw:focus-visible:outline-offset-2 tw:focus-visible:outline-brand-500 tw:dark:border-gray-700 tw:dark:bg-gray-800 tw:dark:hover:border-brand-400">
                        @include('panel.dashboard.estudiante.acceso', ['detalle' => $acceso['detalle']])
                    </a>
                @else
                    <div class="tw:flex tw:h-full tw:min-h-20 tw:items-center tw:gap-3 tw:rounded-xl tw:border tw:border-gray-200 tw:bg-gray-50 tw:p-4 tw:dark:border-gray-700 tw:dark:bg-gray-900">
                        @include('panel.dashboard.estudiante.acceso', ['detalle' => 'Acceso no disponible'])
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
</section>
