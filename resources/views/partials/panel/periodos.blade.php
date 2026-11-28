{{-- Selector del periodo escolar. Conserva los periodos de sesión y los enlaces GET /periodo/{id}. --}}
@php
    $periodosEscolares = collect(session('arre_periodos', []))
        ->filter(fn ($periodo) => is_object($periodo) && isset($periodo->id_periodo, $periodo->periodo))
        ->sortBy(fn ($periodo) => (int) $periodo->id_periodo)
        ->values();
    $periodoEscolarActual = (int) (session('periodo_actual') ?: ($periodosEscolares->first()->id_periodo ?? 0));
    $indiceActual = $periodosEscolares->search(fn ($periodo) => (int) $periodo->id_periodo === $periodoEscolarActual);
    $ultimoInicio = max(0, $periodosEscolares->count() - 3);
    $inicioPeriodos = min($ultimoInicio, max(0, $indiceActual - 1));
@endphp

@if($periodosEscolares->isNotEmpty() && $periodoEscolarActual > 0)
    <div
        x-data="dropdown({ placement: 'bottom-start', offset: 8, inicio: {{ $inicioPeriodos }} })"
        x-init="$watch('open', (visible) => { if (!visible) inicio = {{ $inicioPeriodos }} })"
        @click.outside="close()"
        @keydown.escape.window="if (open) { close(); $refs.trigger.focus(); }"
    >
        @include('partials.panel.boton_periodo')

        <div
            id="panel-periodos-menu"
            x-ref="menu"
            x-cloak
            x-show.important="open"
            aria-labelledby="panel-periodos-titulo"
            class="tw:fixed tw:z-50 tw:overflow-y-auto tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-4 tw:shadow-theme-lg tw:dark:border-gray-800 tw:dark:bg-[#1E2635]"
            style="box-sizing: border-box; width: min(315px, calc(100vw - 1rem)); max-height: min(21rem, 65vh)"
        >
            <div class="tw:mb-4 tw:flex tw:items-center tw:justify-between tw:gap-3">
                <h4 id="panel-periodos-titulo" class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Selecciona Periodo</h4>
                <div class="tw:flex tw:shrink-0 tw:items-center tw:gap-1">
                    @foreach([-1 => 'Periodos anteriores', 1 => 'Periodos siguientes'] as $paso => $etiqueta)
                        <button
                            type="button"
                            aria-label="{{ $etiqueta }}"
                            aria-controls="panel-periodos-lista"
                            :disabled="inicio {{ $paso < 0 ? '<=' : '>=' }} {{ $paso < 0 ? 0 : $ultimoInicio }}"
                            @click="inicio += {{ $paso }}"
                            class="tw:inline-flex tw:size-9 tw:items-center tw:justify-center tw:rounded-lg tw:border tw:border-gray-300 tw:text-gray-600 tw:hover:bg-gray-50 tw:disabled:cursor-not-allowed tw:disabled:opacity-50 tw:dark:border-gray-700 tw:dark:text-gray-400 tw:dark:hover:bg-white/5"
                        >
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" @class(['tw:rotate-180' => $paso < 0]) aria-hidden="true">
                                <path d="M4.792 7.396L10 12.604l5.208-5.208" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    @endforeach
                </div>
            </div>

            <ul id="panel-periodos-lista" class="tw:flex tw:flex-col tw:gap-2">
                @foreach($periodosEscolares as $indice => $periodo)
                    @php($actual = (int) $periodo->id_periodo === $periodoEscolarActual)
                    <li x-show.important="{{ $indice }} >= inicio && {{ $indice }} < inicio + 3">
                        <a
                            href="/periodo/{{ $periodo->id_periodo }}"
                            @click="close()"
                            @if($actual) aria-current="true" @endif
                            @class([
                                'tw:flex tw:items-center tw:justify-between tw:gap-2 tw:rounded-lg tw:px-4 tw:py-3 tw:text-sm',
                                'tw:bg-brand-500 tw:font-semibold tw:text-white' => $actual,
                                'tw:border tw:border-gray-200 tw:font-medium tw:text-gray-700 tw:hover:bg-gray-100 tw:dark:border-gray-800 tw:dark:text-gray-300 tw:dark:hover:bg-white/5' => !$actual,
                            ])
                        >
                            <span class="tw:min-w-0 tw:wrap-break-word">{{ $periodo->periodo }}</span>
                            @if($actual)
                                <span class="tw:shrink-0 tw:text-xs tw:font-normal tw:opacity-80">Actual</span>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
