{{-- Lista de periodos de inglés (fragmento que carga GET /profesores_ingles/periodos/{id} dentro del modal
     "Modificar periodo"). Mismos datos y enlaces: el actual con href="#", los demás /recargar/periodos_ingles/{id}. --}}
<div class="tw-marco tw:pt-2">
    <p class="tw:mb-3 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">Periodo de Inglés</p>
    <ul class="tw:flex tw:max-h-[60vh] tw:flex-col tw:gap-2 tw:overflow-y-auto">
            @foreach($periodos_ingles as $periodo_ingles)
                @if($periodo_ingles->id_periodo_ingles==$id_periodo_ingles)
                    <li><a href="#" class="tw:flex tw:items-center tw:justify-between tw:rounded-lg tw:bg-emerald-600 tw:px-4 tw:py-3 tw:text-sm tw:font-semibold tw:text-white">{{ $periodo_ingles->periodo_ingles }}<span class="tw:text-xs tw:font-normal tw:opacity-80">Actual</span></a></li>
                @else
                    <li><a  href="/recargar/periodos_ingles/{{$periodo_ingles->id_periodo_ingles}}" class="tw:flex tw:items-center tw:rounded-lg tw:border tw:border-gray-200 tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:text-gray-700 tw:hover:bg-gray-100 tw:dark:border-gray-800 tw:dark:text-gray-300 tw:dark:hover:bg-white/5">{{ $periodo_ingles->periodo_ingles }}</a></li>
                @endif
           @endforeach
    </ul>
</div>
