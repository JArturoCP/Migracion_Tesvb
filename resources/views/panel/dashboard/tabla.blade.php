{{--
    Tabla (TailAdmin: recent-orders).
    $titulo, $subtitulo, $columnas (encabezados), $filas: lista de celdas; cada celda es un string o
    ['principal', 'secundario'] o ['insignia' => texto|null, 'tono' => verde|ambar|rojo|gris].
    $enlace: ['texto', 'url'] opcional (botón "ver todo" hacia una pantalla existente).
--}}
<div class="tw:overflow-hidden tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:px-4 tw:pt-4 tw:pb-3 tw:sm:px-6 tw:dark:border-gray-800 tw:dark:bg-white/3" data-panel-bloque="tabla">
    <div class="tw:mb-4 tw:flex tw:flex-col tw:gap-2 tw:sm:flex-row tw:sm:items-center tw:sm:justify-between">
        <div>
            <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $titulo }}</h3>
            <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $subtitulo }}</p>
        </div>
        @isset($enlace)
            <div class="tw:flex tw:items-center tw:gap-3">
                <a href="{{ $enlace['url'] }}" class="tw:inline-flex tw:items-center tw:justify-center tw:gap-2 tw:rounded-[10px] tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:font-medium tw:text-gray-700 tw:shadow-theme-xs tw:transition-all tw:select-none tw:hover:bg-gray-50 tw:hover:text-gray-800 tw:dark:border-gray-700 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:hover:bg-white/3 tw:dark:hover:text-gray-200">
                    {{ $enlace['texto'] }}
                </a>
            </div>
        @endisset
    </div>

    @if(count($filas) > 0)
        <div class="tw:max-w-full tw:overflow-x-auto">
            <table class="tw:min-w-full">
                <thead class="tw:border-y tw:border-gray-100 tw:dark:border-gray-800">
                    <tr>
                        @foreach($columnas as $columna)
                            <th class="tw:py-3 tw:pe-4 tw:text-start tw:text-xs tw:font-medium tw:text-gray-500 tw:dark:text-gray-400">{{ $columna }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="tw:divide-y tw:divide-gray-100 tw:dark:divide-gray-800">
                    @foreach($filas as $fila)
                        <tr data-panel-fila>
                            @foreach($fila as $celda)
                                <td class="tw:py-3 tw:pe-4 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">
                                    @if(is_array($celda) && array_key_exists('insignia', $celda))
                                        <?php
                                            $tonos = [
                                                'verde' => 'tw:bg-green-50 tw:text-green-600 tw:dark:bg-green-500/15 tw:dark:text-green-500',
                                                'ambar' => 'tw:bg-amber-50 tw:text-amber-600 tw:dark:bg-amber-500/15 tw:dark:text-orange-400',
                                                'rojo' => 'tw:bg-red-50 tw:text-red-600 tw:dark:bg-red-500/15 tw:dark:text-red-500',
                                                'gris' => 'tw:bg-gray-100 tw:text-gray-500 tw:dark:bg-white/5 tw:dark:text-gray-400',
                                            ];
                                        ?>
                                        <span class="tw:inline-flex tw:items-center tw:justify-center tw:gap-1 tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium {{ $tonos[$celda['tono']] ?? $tonos['gris'] }}">{{ $celda['insignia'] ?? 'Sin datos' }}</span>
                                    @elseif(is_array($celda))
                                        <p class="tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{ $celda[0] }}</p>
                                        <span class="tw:text-xs tw:text-gray-500 tw:dark:text-gray-400">{{ $celda[1] }}</span>
                                    @else
                                        {{ $celda }}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        @include('panel.dashboard.sin_datos')
    @endif
</div>
