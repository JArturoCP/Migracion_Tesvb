{{-- Lista de periodos de inglés (fragmento que carga GET /profesores_ingles/periodos/{id} dentro del modal de periodos
     de inglés). Mismos datos y enlaces: el actual con href="#", los demás /recargar/periodos_ingles/{id}.
     Mismo diseño que la lista del periodo escolar (partials/panel/periodos): del más antiguo al más reciente,
     el actual resaltado y, dentro del modal del panel (selectorPeriodo), solo el anterior, el actual y el siguiente. --}}
<?php $ventana = is_numeric($id_periodo_ingles) && (int) $id_periodo_ingles > 0; ?>
<ul class="tw:flex tw:flex-col tw:gap-2">
    @foreach(array_reverse($periodos_ingles) as $periodo_ingles)
        @if($periodo_ingles->id_periodo_ingles==$id_periodo_ingles)
            <li @if($ventana) x-show.important="visible({{ (int) $periodo_ingles->id_periodo_ingles }})" @endif>
                <a href="#"
                   class="tw:flex tw:items-center tw:justify-between tw:rounded-lg tw:bg-brand-500 tw:px-4 tw:py-3 tw:text-sm tw:font-semibold tw:text-white">
                    {{ $periodo_ingles->periodo_ingles }}
                    <span class="tw:text-xs tw:font-normal tw:opacity-80">Actual</span>
                </a>
            </li>
        @else
            <li @if($ventana) x-show.important="visible({{ (int) $periodo_ingles->id_periodo_ingles }})" @endif>
                <a href="/recargar/periodos_ingles/{{$periodo_ingles->id_periodo_ingles}}"
                   class="tw:flex tw:items-center tw:rounded-lg tw:border tw:border-gray-200 tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:text-gray-700 tw:hover:bg-gray-100 tw:dark:border-gray-800 tw:dark:text-gray-300 tw:dark:hover:bg-white/5">
                    {{ $periodo_ingles->periodo_ingles }}
                </a>
            </li>
        @endif
    @endforeach
</ul>
