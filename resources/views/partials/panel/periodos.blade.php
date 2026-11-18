{{--
    Modal de cambio de periodo del nuevo diseño. COPIA de partials/periodos.blade.php:
    el bloque PHP (L3-44) es idéntico y los enlaces son los mismos (GET /periodo/{id}).
    Solo cambia el marcado: Alpine (resources/js/panel/periodos.js) en lugar de jQuery y del modal de Bootstrap.
    Se abre con el evento "abrir-periodos" (botón del header: partials/panel/periodo_header.blade.php).
--}}
    <?php
    $arre_periodos = Session::get('arre_periodos');

    if ($arre_periodos instanceof \Illuminate\Support\Collection) {
        $arre_periodos = $arre_periodos;
    } elseif (is_array($arre_periodos)) {
        $arre_periodos = collect($arre_periodos);
    } else {
        $arre_periodos = collect();
    }

    $periodo_anterior = Session::get('periodo_anterior');
    $periodo_actual = Session::get('periodo_actual');

    $p1Session = Session::get('p1');
    $p2Session = Session::get('p2');

    $p1 = '';
    $p2 = '';

    if (is_object($p1Session) && isset($p1Session->periodo)) {
        $p1 = $p1Session->periodo;
    } elseif (is_array($p1Session) && isset($p1Session['periodo'])) {
        $p1 = $p1Session['periodo'];
    }

    if (is_object($p2Session) && isset($p2Session->periodo)) {
        $p2 = $p2Session->periodo;
    } elseif (is_array($p2Session) && isset($p2Session['periodo'])) {
        $p2 = $p2Session['periodo'];
    }

    if (!$periodo_actual && $arre_periodos->count() > 0) {
        $primerPeriodo = $arre_periodos->first();

        if (is_object($primerPeriodo) && isset($primerPeriodo->id_periodo)) {
            $periodo_actual = $primerPeriodo->id_periodo;
        }
    }

    $periodo_actual = (int) $periodo_actual;
    ?>
    @if($arre_periodos->count() > 0 && $periodo_actual > 0)
        <div
            class="tw-marco"
            x-data="selectorPeriodo({{ $periodo_actual }})"
            @abrir-periodos.window="abrir()"
            @keydown.escape.window="cerrar()"
        >
            <div
                x-cloak
                x-show.important="abierto"
                x-transition.opacity
                class="tw:fixed tw:inset-0 tw:z-99999 tw:flex tw:items-center tw:justify-center tw:overflow-y-auto tw:p-5"
                role="dialog"
                aria-modal="true"
                aria-labelledby="panel-periodos-titulo"
            >
                <div class="tw:fixed tw:inset-0 tw:h-full tw:w-full tw:bg-gray-400/50 tw:backdrop-blur-[32px]" @click="cerrar()"></div>

                <div class="tw:relative tw:w-full tw:max-w-md tw:rounded-3xl tw:bg-white tw:p-6 tw:dark:bg-gray-900 tw:lg:p-8" @click.outside="cerrar()">
                    <div class="tw:mb-5 tw:flex tw:items-center tw:justify-between tw:gap-3">
                        <h4 id="panel-periodos-titulo" class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Selecciona Periodo</h4>
                        <div class="tw:flex tw:items-center tw:gap-1">
                            <button type="button" @click="arriba()" aria-label="Periodos anteriores"
                                class="tw:inline-flex tw:size-9 tw:items-center tw:justify-center tw:rounded-lg tw:border tw:border-gray-300 tw:text-gray-600 tw:hover:bg-gray-50 tw:dark:border-gray-700 tw:dark:text-gray-400 tw:dark:hover:bg-white/5">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" class="tw:rotate-180" aria-hidden="true"><path d="M4.792 7.396L10 12.604l5.208-5.208" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg>
                            </button>
                            <button type="button" @click="abajo()" aria-label="Periodos siguientes"
                                class="tw:inline-flex tw:size-9 tw:items-center tw:justify-center tw:rounded-lg tw:border tw:border-gray-300 tw:text-gray-600 tw:hover:bg-gray-50 tw:dark:border-gray-700 tw:dark:text-gray-400 tw:dark:hover:bg-white/5">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M4.792 7.396L10 12.604l5.208-5.208" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg>
                            </button>
                        </div>
                    </div>

                    <ul class="tw:flex tw:flex-col tw:gap-2">
                        @foreach($arre_periodos as $per)
                            @if(is_object($per) && isset($per->id_periodo) && isset($per->periodo))
                                @if((int) $per->id_periodo === (int) $periodo_actual)
                                    <li x-show.important="visible({{ (int) $per->id_periodo }})" id="tr{{ $per->id_periodo }}">
                                        <a href="/periodo/{{ $per->id_periodo }}"
                                           class="tw:flex tw:items-center tw:justify-between tw:rounded-lg tw:bg-brand-500 tw:px-4 tw:py-3 tw:text-sm tw:font-semibold tw:text-white">
                                            {{ $per->periodo }}
                                            <span class="tw:text-xs tw:font-normal tw:opacity-80">Actual</span>
                                        </a>
                                    </li>
                                @else
                                    <li x-show.important="visible({{ (int) $per->id_periodo }})" id="tr{{ $per->id_periodo }}">
                                        <a href="/periodo/{{ $per->id_periodo }}"
                                           class="tw:flex tw:items-center tw:rounded-lg tw:border tw:border-gray-200 tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:text-gray-700 tw:hover:bg-gray-100 tw:dark:border-gray-800 tw:dark:text-gray-300 tw:dark:hover:bg-white/5">
                                            {{ $per->periodo }}
                                        </a>
                                    </li>
                                @endif
                            @endif
                        @endforeach
                    </ul>

                    <div class="tw:mt-6 tw:flex tw:justify-end">
                        <button type="button" @click="cerrar()"
                            class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:border tw:border-gray-300 tw:bg-white tw:px-4 tw:py-2.5 tw:text-sm tw:font-medium tw:text-gray-700 tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:border-gray-700 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:hover:bg-white/3">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
