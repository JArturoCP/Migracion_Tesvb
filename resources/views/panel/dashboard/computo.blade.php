{{--
    Dashboard del CENTRO DE CÓMPUTO (sesión "computo"). Mismo acomodo y parciales que los de Planeación y Consultas,
    Finanzas, Titulación y Residencias. Datos: App\Services\Panel\DatosComputo (vía PanelInicioComposer), en $tablero.
    Calificar y laboratorios son del PERIODO seleccionado; apartados y mantenimiento, del AÑO en curso; las cuentas, del
    total. Sin datos personales (ni correos ni nombres): solo conteos y agregados.
    El encabezado (x-panel.hero) va arriba, en panel/inicio.blade.php (panel/dashboard/computo/encabezado).
    Ver docs/DASHBOARD_COMPUTO.md.
--}}
@if($tablero === null)
    <div class="tw:col-span-12" data-panel-dashboard="computo">
        <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:md:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3">
            <x-panel.vacio titulo="Sin datos" mensaje="No fue posible obtener los indicadores del Centro de Cómputo." />
        </div>
    </div>
@else
    <?php
        $periodoTexto = $tablero['periodo'] ?? 'Periodo actual';
        $anioTexto = 'Año ' . $tablero['anio'];
        $labs = $tablero['laboratorios'];
        $cuentas = $tablero['cuentas'];
        $tarjetaVacia = 'tw:h-full tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:sm:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3';
    ?>

    {{-- Indicadores --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full" data-panel-dashboard="computo">
        @include('panel.dashboard.metricas', ['metricas' => [
            ['clave' => 'por_calificar', 'etiqueta' => 'Alumnos por calificar', 'icono' => 'estudiantes',
             'valor' => $tablero['por_calificar'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'laboratorios', 'etiqueta' => 'Laboratorios en uso (de ' . number_format($labs['total']) . ' registrados)', 'icono' => 'monitor',
             'valor' => $labs['en_uso'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'horas', 'etiqueta' => 'Horas fijas de laboratorio por semana', 'icono' => 'reloj',
             'valor' => $labs['horas'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'apartados', 'etiqueta' => 'Apartados de laboratorio en ' . $tablero['anio'], 'icono' => 'calendario',
             'valor' => $labs['apartados'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'encuestas', 'etiqueta' => 'Encuestas de mantenimiento por contestar (' . number_format($tablero['encuestas']['contestadas']) . ' contestadas)', 'icono' => 'tareas',
             'valor' => $tablero['encuestas']['por_contestar'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'sin_registro', 'etiqueta' => 'Cuentas sin registro (de ' . number_format($cuentas['total']) . ' cuentas)', 'icono' => 'docentes',
             'valor' => $cuentas['sin_registro'], 'anterior' => null, 'periodo_anterior' => null],
        ]])
    </div>

    {{-- Dona: cuentas por tipo --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @include('panel.dashboard.dona', [
            'titulo' => 'Cuentas por tipo',
            'subtitulo' => 'Usuarios del sistema',
            'segmentos' => array_map(fn ($t) => ['etiqueta' => $t['tipo'], 'valor' => $t['cuentas']], $cuentas['tipos']),
            'vacio' => 'No hay cuentas registradas.',
        ])
    </div>

    {{-- Barras: horas fijas de laboratorio por día --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if(array_sum(array_column($tablero['dias'], 'total')) > 0)
            @include('panel.dashboard.barras', [
                'titulo' => 'Horas fijas de laboratorio por día',
                'subtitulo' => $periodoTexto,
                'serie' => 'Horas',
                'categorias' => array_column($tablero['dias'], 'dia'),
                'valores' => array_column($tablero['dias'], 'total'),
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="barras">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Horas fijas de laboratorio por día</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $periodoTexto }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay horarios de laboratorio en este periodo." />
            </div>
        @endif
    </div>

    {{-- Barras: alumnos por calificar por carrera --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if(count($tablero['carreras']) > 0)
            @include('panel.dashboard.barras', [
                'titulo' => 'Alumnos por calificar por carrera',
                'subtitulo' => $periodoTexto,
                'serie' => 'Alumnos',
                'categorias' => array_column($tablero['carreras'], 'siglas'),
                'valores' => array_column($tablero['carreras'], 'total'),
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="barras">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Alumnos por calificar por carrera</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $periodoTexto }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay alumnos con carga validada en este periodo." />
            </div>
        @endif
    </div>

    {{-- Línea: apartados de laboratorio y servicios de mantenimiento por mes --}}
    <div class="tw:col-span-12">
        @if(array_sum(array_column($tablero['meses'], 'apartados')) + array_sum(array_column($tablero['meses'], 'servicios')) > 0)
            @include('panel.dashboard.linea', [
                'titulo' => 'Apartados de laboratorio y servicios de mantenimiento',
                'subtitulo' => $anioTexto . ', por mes',
                'categorias' => array_column($tablero['meses'], 'mes'),
                'series' => [
                    ['clave' => 'apartados', 'nombre' => 'Apartados', 'valores' => array_column($tablero['meses'], 'apartados')],
                    ['clave' => 'servicios', 'nombre' => 'Servicios de mantenimiento', 'valores' => array_column($tablero['meses'], 'servicios')],
                ],
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="linea">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Apartados de laboratorio y servicios de mantenimiento</h3>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay apartados ni servicios de mantenimiento este año." />
            </div>
        @endif
    </div>

    {{-- Tabla: laboratorios (catálogo; sin profesores ni descripciones de uso) --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full tw:*:px-5 tw:*:pt-5 tw:*:pb-5 tw:sm:*:px-6 tw:sm:*:pt-6">
        @if(count($tablero['lista_laboratorios']) > 0)
            @include('panel.dashboard.tabla', [
                'titulo' => 'Laboratorios',
                'subtitulo' => 'Horas fijas del periodo y apartados de ' . $tablero['anio'],
                'columnas' => ['Laboratorio', 'Horas fijas', 'Apartados'],
                'filas' => array_map(fn ($l) => [
                    $l['laboratorio'],
                    number_format($l['horas']),
                    number_format($l['apartados']),
                ], $tablero['lista_laboratorios']),
                'enlace' => ['texto' => 'Ver laboratorios', 'url' => url('/laboratorios/laboratorios')],
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="tabla">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Laboratorios</h3>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay laboratorios registrados." />
            </div>
        @endif
    </div>

    {{-- Accesos rápidos (solo módulos visibles que el rol ya tiene en el sidebar) --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @include('panel.dashboard.consultas.accesos', [
            'subtituloAccesos' => 'Módulos principales del Centro de Cómputo',
            'accesos' => [
                ['titulo' => 'Calificar estudiantes', 'detalle' => 'Alumnos con carga validada', 'icono' => 'formularios', 'url' => url('/computo/calificar')],
                ['titulo' => 'Laboratorios', 'detalle' => 'Ocupación y apartados', 'icono' => 'cuadricula', 'url' => url('/laboratorios/laboratorios')],
                ['titulo' => 'Encuesta de mantenimiento', 'detalle' => 'Servicios y envío de encuestas', 'icono' => 'paginas', 'url' => url('/encuestas_satisfaccion/periodo_mantenimiento')],
                ['titulo' => 'Historial de encuestas', 'detalle' => 'Resultados por año y mes', 'icono' => 'graficas', 'url' => url('/encuestas_satisfaccion/menu_historial_mantenimiento')],
                ['titulo' => 'Usuarios estudiantes', 'detalle' => 'Cuentas con y sin registro', 'icono' => 'usuario', 'url' => url('/centro_computo/ver_usuario_estudiante')],
                ['titulo' => 'Promedios ≥ 90', 'detalle' => 'Por carrera', 'icono' => 'tablas', 'url' => url('/computo/ver_cal/promedios')],
            ],
        ])
    </div>
@endif
