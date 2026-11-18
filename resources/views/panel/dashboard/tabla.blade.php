{{--
    Tabla (TailAdmin: recent-orders).
    $titulo, $subtitulo, $columnas (encabezados), $filas: lista de celdas; cada celda es un string o
    ['principal', 'secundario'] o ['insignia' => texto|null, 'tono' => verde|ambar|rojo|gris].
    $enlace: ['texto', 'url'] opcional (botón "ver todo" hacia una pantalla existente).
--}}
<div class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pt-4 pb-3 sm:px-6 dark:border-gray-800 dark:bg-white/3" data-panel-bloque="tabla">
    <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">{{ $titulo }}</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $subtitulo }}</p>
        </div>
        @isset($enlace)
            <div class="flex items-center gap-3">
                <a href="{{ $enlace['url'] }}" class="inline-flex items-center justify-center gap-2 rounded-[10px] border border-gray-300 bg-transparent px-4 py-2.5 text-sm font-medium text-gray-700 shadow-theme-xs transition-all select-none hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/3 dark:hover:text-gray-200">
                    {{ $enlace['texto'] }}
                </a>
            </div>
        @endisset
    </div>

    @if(count($filas) > 0)
        <div class="max-w-full overflow-x-auto">
            <table class="min-w-full">
                <thead class="border-y border-gray-100 dark:border-gray-800">
                    <tr>
                        @foreach($columnas as $columna)
                            <th class="py-3 pe-4 text-start text-xs font-medium text-gray-500 dark:text-gray-400">{{ $columna }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach($filas as $fila)
                        <tr data-panel-fila>
                            @foreach($fila as $celda)
                                <td class="py-3 pe-4 text-sm text-gray-500 dark:text-gray-400">
                                    @if(is_array($celda) && array_key_exists('insignia', $celda))
                                        <?php
                                            $tonos = [
                                                'verde' => 'bg-green-50 text-green-600 dark:bg-green-500/15 dark:text-green-500',
                                                'ambar' => 'bg-amber-50 text-amber-600 dark:bg-amber-500/15 dark:text-orange-400',
                                                'rojo' => 'bg-red-50 text-red-600 dark:bg-red-500/15 dark:text-red-500',
                                                'gris' => 'bg-gray-100 text-gray-500 dark:bg-white/5 dark:text-gray-400',
                                            ];
                                        ?>
                                        <span class="inline-flex items-center justify-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium {{ $tonos[$celda['tono']] ?? $tonos['gris'] }}">{{ $celda['insignia'] ?? 'Sin datos' }}</span>
                                    @elseif(is_array($celda))
                                        <p class="text-sm font-medium text-gray-800 dark:text-white/90">{{ $celda[0] }}</p>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $celda[1] }}</span>
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
