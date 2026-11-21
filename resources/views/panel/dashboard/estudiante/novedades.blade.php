<section aria-labelledby="estudiante-novedades" class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:sm:p-6 tw:dark:border-gray-700 tw:dark:bg-gray-800">
    <h2 id="estudiante-novedades" class="tw:text-lg tw:font-semibold tw:text-gray-900 tw:dark:text-white">Novedades y pendientes</h2>

    @if(!$estudiante['contexto'])
        <p class="tw:mt-3 tw:text-sm tw:text-gray-600 tw:dark:text-gray-300" role="status">Los datos del período no están disponibles.</p>
    @elseif(!$novedades)
        <p class="tw:mt-3 tw:text-sm tw:text-gray-600 tw:dark:text-gray-300">No hay novedades ni pendientes para mostrar.</p>
    @else
        <ul class="tw:mt-3 tw:divide-y tw:divide-gray-200 tw:dark:divide-gray-700">
            @foreach($novedades as $novedad)
                <li class="tw:py-3">
                    <p class="tw:text-xs tw:font-semibold tw:text-gray-600 tw:dark:text-gray-300">{{ $novedad['tipo'] }}</p>
                    <p class="tw:mt-1 tw:text-sm tw:font-medium tw:wrap-anywhere tw:text-gray-900 tw:dark:text-white">{{ $novedad['titulo'] }}</p>
                    @if(isset($novedad['detalle']))
                        <p class="tw:mt-1 tw:text-sm tw:wrap-anywhere tw:text-gray-600 tw:dark:text-gray-300">{{ $novedad['detalle'] }}</p>
                    @endif
                    @if(isset($novedad['url']))
                        <a href="{{ $novedad['url'] }}" class="tw:mt-1 tw:inline-flex tw:min-h-11 tw:items-center tw:rounded-sm tw:text-sm tw:font-medium tw:text-brand-700 tw:underline tw:focus-visible:outline-2 tw:focus-visible:outline-offset-2 tw:dark:text-brand-300">
                            Abrir {{ $novedad['titulo'] }}
                        </a>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</section>
