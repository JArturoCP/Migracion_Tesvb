{{--
    Dashboard de FINANZAS (sesión "finanzas"). Mismo acomodo y parciales que el de Planeación y Consultas.
    Datos: App\Services\Panel\DatosFinanzas (vía App\View\Composers\PanelInicioComposer), en $tablero.
    Base temporal: el EJERCICIO FISCAL ($tablero['anio'] = date('Y'); anteproyecto = año + 1), igual que las pantallas
    de presupuesto; no depende del periodo escolar. Montos en pesos (MXN) con 2 decimales.
    El encabezado (x-panel.hero) va arriba, en panel/inicio.blade.php (panel/dashboard/finanzas/encabezado).
    Ver docs/DASHBOARD_FINANZAS.md.
--}}
@if($tablero === null)
    <div class="tw:col-span-12" data-panel-dashboard="finanzas">
        <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:md:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3">
            <x-panel.vacio titulo="Sin datos" mensaje="No fue posible obtener los indicadores del ejercicio." />
        </div>
    </div>
@else
    <?php
        $ejercicio = 'Ejercicio fiscal ' . $tablero['anio'];
        $pesos = fn ($valor) => '$' . number_format($valor, 2);
        $solicitudes = $tablero['solicitudes'];
        $tarjetaVacia = 'tw:h-full tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:sm:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3';
    ?>

    {{-- Indicadores --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full" data-panel-dashboard="finanzas">
        @include('panel.dashboard.metricas', ['metricas' => [
            ['clave' => 'autorizado', 'etiqueta' => 'Presupuesto autorizado ' . $tablero['anio'] . ' (MXN)', 'icono' => 'moneda', 'formato' => 'moneda',
             'valor' => $tablero['autorizado'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'ejercido', 'etiqueta' => 'Presupuesto ejercido (MXN)', 'icono' => 'recibo', 'formato' => 'moneda',
             'valor' => $tablero['ejercido'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'disponible', 'etiqueta' => 'Presupuesto disponible (MXN)', 'icono' => 'billetera', 'formato' => 'moneda',
             'valor' => $tablero['disponible'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'por_revisar', 'etiqueta' => 'Solicitudes por revisar', 'icono' => 'tareas',
             'valor' => $solicitudes['por_revisar'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'autorizadas', 'etiqueta' => 'Solicitudes autorizadas', 'icono' => 'aprobado',
             'valor' => $solicitudes['autorizadas'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'requisiciones', 'etiqueta' => 'Requisiciones del anteproyecto ' . $tablero['anio_anteproyecto'] . ' por revisar', 'icono' => 'documento',
             'valor' => $tablero['requisiciones_por_revisar'], 'anterior' => null, 'periodo_anterior' => null],
        ]])
    </div>

    {{-- Medidor radial: porcentaje ejercido --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if($tablero['porcentaje_ejercido'] !== null)
            @include('panel.dashboard.radial', [
                'titulo' => 'Ejercido del presupuesto',
                'subtitulo' => $ejercicio,
                'porcentaje' => $tablero['porcentaje_ejercido'],
                'texto' => $pesos($tablero['ejercido']) . ' ejercidos de ' . $pesos($tablero['vigente']) . ' del presupuesto vigente.',
                'detalle' => [
                    ['etiqueta' => 'Vigente', 'valor' => $tablero['vigente'], 'formato' => 'moneda'],
                    ['etiqueta' => 'Ejercido', 'valor' => $tablero['ejercido'], 'formato' => 'moneda'],
                    ['etiqueta' => 'Disponible', 'valor' => $tablero['disponible'], 'formato' => 'moneda'],
                ],
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="radial">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Ejercido del presupuesto</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $ejercicio }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay presupuesto autorizado registrado para este ejercicio." />
            </div>
        @endif
    </div>

    {{-- Línea: vigente y ejercido por mes --}}
    <div class="tw:col-span-12">
        @if(array_sum(array_column($tablero['meses'], 'vigente')) + array_sum(array_column($tablero['meses'], 'ejercido')) > 0)
            @include('panel.dashboard.linea', [
                'titulo' => 'Presupuesto por mes',
                'subtitulo' => $ejercicio . ' · vigente y ejercido (MXN)',
                'categorias' => array_column($tablero['meses'], 'mes'),
                'series' => [
                    ['clave' => 'vigente', 'nombre' => 'Vigente', 'valores' => array_column($tablero['meses'], 'vigente')],
                    ['clave' => 'ejercido', 'nombre' => 'Ejercido', 'valores' => array_column($tablero['meses'], 'ejercido')],
                ],
                'moneda' => true,
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="linea">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Presupuesto por mes</h3>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay presupuesto registrado por mes en este ejercicio." />
            </div>
        @endif
    </div>

    {{-- Barras: ejercido por partida --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if(count($tablero['partidas']) > 0)
            @include('panel.dashboard.barras', [
                'titulo' => 'Ejercido por partida presupuestal',
                'subtitulo' => $ejercicio . ' · las ' . count($tablero['partidas']) . ' partidas con más gasto (MXN)',
                'serie' => 'Ejercido',
                'categorias' => array_map(fn ($p) => 'Partida ' . $p['clave'], $tablero['partidas']),
                'valores' => array_column($tablero['partidas'], 'ejercido'),
                'moneda' => true,
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="barras">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Ejercido por partida presupuestal</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $ejercicio }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay presupuesto ejercido en este ejercicio." />
            </div>
        @endif
    </div>

    {{-- Dona: solicitudes por estado --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @include('panel.dashboard.dona', [
            'titulo' => 'Solicitudes de requisición por estado',
            'subtitulo' => $ejercicio,
            'segmentos' => [
                ['etiqueta' => 'En captura', 'valor' => $solicitudes['captura']],
                ['etiqueta' => 'Por revisar', 'valor' => $solicitudes['por_revisar']],
                ['etiqueta' => 'Devueltas', 'valor' => $solicitudes['devueltas']],
                ['etiqueta' => 'Autorizadas', 'valor' => $solicitudes['autorizadas']],
            ],
            'vacio' => 'No hay solicitudes de requisición en este ejercicio.',
        ])
    </div>

    {{-- Tabla: solicitudes por revisar (sin nombres de personas) --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full tw:*:px-5 tw:*:pt-5 tw:*:pb-5 tw:sm:*:px-6 tw:sm:*:pt-6">
        @if(count($tablero['por_revisar']) > 0)
            @include('panel.dashboard.tabla', [
                'titulo' => 'Solicitudes por revisar',
                'subtitulo' => 'Las más recientes enviadas a Finanzas · ' . $ejercicio,
                'columnas' => ['Departamento o jefatura', 'Mes', 'Importe'],
                'filas' => array_map(fn ($s) => [
                    [$s['departamento'], $s['proyecto']],
                    $s['mes'],
                    $pesos($s['importe']),
                ], $tablero['por_revisar']),
                'enlace' => ['texto' => 'Revisar solicitudes', 'url' => url('/presupuesto_autorizado/revisar_solicitudes')],
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="tabla">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Solicitudes por revisar</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $ejercicio }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay solicitudes pendientes de revisión." />
            </div>
        @endif
    </div>

    {{-- Accesos rápidos (solo módulos que el rol ya tiene en el sidebar) --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @include('panel.dashboard.consultas.accesos', [
            'subtituloAccesos' => 'Módulos principales de Finanzas',
            'accesos' => [
                ['titulo' => 'Revisión de solicitudes', 'detalle' => 'Solicitudes de requisición de los departamentos', 'icono' => 'formularios', 'url' => url('/presupuesto_autorizado/revisar_solicitudes')],
                ['titulo' => 'Presupuesto para modificar', 'detalle' => 'Vigente, ejercido y sobrante por mes', 'icono' => 'tablas', 'url' => url('/presupuesto_autorizado/presupesto_partida_copia')],
                ['titulo' => 'Presupuesto autorizado', 'detalle' => 'Registro por partida y mes', 'icono' => 'graficas', 'url' => url('/presupuesto_autorizado/agregar_presupesto_partida')],
                ['titulo' => 'Revisión de requisiciones', 'detalle' => 'Anteproyecto ' . $tablero['anio_anteproyecto'], 'icono' => 'paginas', 'url' => url('/presupuesto_anteproyecto/revicion_requisiciones_anteproyecto')],
                ['titulo' => 'Techo presupuestal', 'detalle' => 'Fuentes de financiamiento por proyecto', 'icono' => 'caja', 'url' => url('/presupuesto_anteproyecto/techo_presupuestal')],
                ['titulo' => 'Periodos de anteproyectos', 'detalle' => 'Abrir y cerrar la captura', 'icono' => 'calendario', 'url' => url('/presupuesto_anteproyecto/periodos_anteproyecto')],
            ],
        ])
    </div>
@endif
