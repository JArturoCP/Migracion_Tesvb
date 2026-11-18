{{--
    Modal de cambio de periodo del nuevo diseño. COPIA de partials/periodos.blade.php:
    el bloque PHP (L3-44) es idéntico y los enlaces son los mismos (GET /periodo/{id}).
    Solo cambia el marcado: Alpine (resources/js/panel/periodos.js) en lugar de jQuery y del modal de Bootstrap.
    Se abre con el evento "abrir-periodos" (botón de partials/panel/periodo_boton.blade.php).
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
            x-data="selectorPeriodo({{ $periodo_actual }})"
            @abrir-periodos.window="abrir()"
            @keydown.escape.window="cerrar()"
        >
            <div
                x-cloak
                x-show="abierto"
                x-transition.opacity
                class="fixed inset-0 z-99999 flex items-center justify-center overflow-y-auto p-5"
                role="dialog"
                aria-modal="true"
                aria-labelledby="panel-periodos-titulo"
            >
                <div class="fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]" @click="cerrar()"></div>

                <div class="relative w-full max-w-md rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-8" @click.outside="cerrar()">
                    <div class="mb-5 flex items-center justify-between gap-3">
                        <h4 id="panel-periodos-titulo" class="text-lg font-semibold text-gray-800 dark:text-white/90">Selecciona Periodo</h4>
                        <div class="flex items-center gap-1">
                            <button type="button" @click="arriba()" aria-label="Periodos anteriores"
                                class="inline-flex size-9 items-center justify-center rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/5">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" class="rotate-180" aria-hidden="true"><path d="M4.792 7.396L10 12.604l5.208-5.208" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg>
                            </button>
                            <button type="button" @click="abajo()" aria-label="Periodos siguientes"
                                class="inline-flex size-9 items-center justify-center rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/5">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M4.792 7.396L10 12.604l5.208-5.208" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg>
                            </button>
                        </div>
                    </div>

                    <ul class="flex flex-col gap-2">
                        @foreach($arre_periodos as $per)
                            @if(is_object($per) && isset($per->id_periodo) && isset($per->periodo))
                                @if((int) $per->id_periodo === (int) $periodo_actual)
                                    <li x-show="visible({{ (int) $per->id_periodo }})" id="tr{{ $per->id_periodo }}">
                                        <a href="/periodo/{{ $per->id_periodo }}"
                                           class="flex items-center justify-between rounded-lg bg-brand-500 px-4 py-3 text-sm font-semibold text-white">
                                            {{ $per->periodo }}
                                            <span class="text-xs font-normal opacity-80">Actual</span>
                                        </a>
                                    </li>
                                @else
                                    <li x-show="visible({{ (int) $per->id_periodo }})" id="tr{{ $per->id_periodo }}">
                                        <a href="/periodo/{{ $per->id_periodo }}"
                                           class="flex items-center rounded-lg border border-gray-200 px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:border-gray-800 dark:text-gray-300 dark:hover:bg-white/5">
                                            {{ $per->periodo }}
                                        </a>
                                    </li>
                                @endif
                            @endif
                        @endforeach
                    </ul>

                    <div class="mt-6 flex justify-end">
                        <button type="button" @click="cerrar()"
                            class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/3">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
