{{--
    Dashboard de SERVICIOS ESCOLARES (sesión "escolar"). Mismo acomodo y parciales que los de Planeación y Consultas,
    Finanzas, Titulación, Residencias, Centro de Cómputo y Recursos Humanos. Datos: App\Services\Panel\DatosEscolares
    (vía PanelInicioComposer), en $tablero. Todo es del PERIODO seleccionado. Solo conteos y agregados por estado,
    carrera, semestre y periodo: sin nombres, cuentas, CURP ni otros datos de los alumnos.
    El encabezado (x-panel.hero) va arriba, en panel/inicio.blade.php (panel/dashboard/escolar/encabezado).
    Ver docs/DASHBOARD_ESCOLARES.md.
--}}
@if($tablero === null)
    <div class="tw:col-span-12" data-panel-dashboard="escolar">
        <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:md:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3">
            <x-panel.vacio titulo="Sin datos" mensaje="No fue posible obtener los indicadores de Servicios Escolares." />
        </div>
    </div>
@else
    <?php
        $periodoTexto = $tablero['periodo'] ?? 'Periodo actual';
        $carreras = $tablero['carreras'];
        $cargas = $tablero['cargas'];
        $tarjetaVacia = 'tw:h-full tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:sm:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3';
    ?>

    {{-- Indicadores --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full" data-panel-dashboard="escolar">
        @include('panel.dashboard.metricas', ['metricas' => [
            ['clave' => 'inscritos', 'etiqueta' => 'Estudiantes inscritos', 'icono' => 'estudiantes',
             'valor' => $tablero['inscritos'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'por_revisar', 'etiqueta' => 'Cargas académicas por revisar', 'icono' => 'tareas',
             'valor' => $tablero['por_revisar'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'bajas', 'etiqueta' => 'Bajas temporales (' . number_format($tablero['bajas']['definitivas']) . ' definitivas)', 'icono' => 'documento',
             'valor' => $tablero['bajas']['temporales'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'sin_semestre', 'etiqueta' => 'Inscritos sin semestre registrado', 'icono' => 'calendario',
             'valor' => $tablero['sin_semestre'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'becas', 'etiqueta' => 'Solicitudes de beca por revisar (' . number_format($tablero['becas']['autorizadas']) . ' autorizadas)', 'icono' => 'aprobado',
             'valor' => $tablero['becas']['por_revisar'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'encuestas', 'etiqueta' => 'Encuestas de inscripción enviadas (' . number_format($tablero['encuestas']['sin_enviar']) . ' sin enviar)', 'icono' => 'recibo',
             'valor' => $tablero['encuestas']['enviadas'], 'anterior' => null, 'periodo_anterior' => null],
        ]])
    </div>

    {{-- Dona: cargas académicas por estado --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @include('panel.dashboard.dona', [
            'titulo' => 'Cargas académicas por estado',
            'subtitulo' => $periodoTexto,
            'segmentos' => [
                ['etiqueta' => 'Por revisar', 'valor' => $cargas['por_revisar']],
                ['etiqueta' => 'Aceptadas', 'valor' => $cargas['aceptadas']],
                ['etiqueta' => 'Rechazadas', 'valor' => $cargas['rechazadas']],
                ['etiqueta' => 'Bajas', 'valor' => $cargas['bajas']],
            ],
            'vacio' => 'No hay cargas académicas en este periodo.',
        ])
    </div>

    {{-- Barras: inscritos por carrera --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if(array_sum(array_column($carreras, 'inscritos')) > 0)
            @include('panel.dashboard.barras', [
                'titulo' => 'Inscritos por carrera',
                'subtitulo' => $periodoTexto,
                'serie' => 'Inscritos',
                'categorias' => array_column($carreras, 'siglas'),
                'valores' => array_column($carreras, 'inscritos'),
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="barras">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Inscritos por carrera</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $periodoTexto }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay estudiantes inscritos en este periodo." />
            </div>
        @endif
    </div>

    {{-- Barras: inscritos por semestre --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if(count($tablero['semestres']) > 0)
            @include('panel.dashboard.barras', [
                'titulo' => 'Inscritos por semestre',
                'subtitulo' => $periodoTexto,
                'serie' => 'Inscritos',
                'categorias' => array_column($tablero['semestres'], 'semestre'),
                'valores' => array_column($tablero['semestres'], 'total'),
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="barras">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Inscritos por semestre</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $periodoTexto }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay estudiantes inscritos en este periodo." />
            </div>
        @endif
    </div>

    {{-- Línea: inscritos y bajas por periodo --}}
    <div class="tw:col-span-12">
        @if(array_sum(array_column($tablero['historico'], 'inscritos')) + array_sum(array_column($tablero['historico'], 'bajas')) > 0)
            @include('panel.dashboard.linea', [
                'titulo' => 'Inscritos y bajas por periodo',
                'subtitulo' => 'El periodo seleccionado y los 5 anteriores',
                'categorias' => array_column($tablero['historico'], 'periodo'),
                'series' => [
                    ['clave' => 'inscritos', 'nombre' => 'Inscritos', 'valores' => array_column($tablero['historico'], 'inscritos')],
                    ['clave' => 'bajas', 'nombre' => 'Bajas', 'valores' => array_column($tablero['historico'], 'bajas')],
                ],
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="linea">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Inscritos y bajas por periodo</h3>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay inscritos ni bajas en los últimos periodos." />
            </div>
        @endif
    </div>

    {{-- Tabla: resumen por carrera (sin datos de alumnos) --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full tw:*:px-5 tw:*:pt-5 tw:*:pb-5 tw:sm:*:px-6 tw:sm:*:pt-6">
        @if(array_sum(array_map(fn ($c) => $c['inscritos'] + $c['temporales'] + $c['definitivas'] + $c['becas'], $carreras)) > 0)
            @include('panel.dashboard.tabla', [
                'titulo' => 'Resumen por carrera',
                'subtitulo' => $periodoTexto,
                'columnas' => ['Carrera', 'Inscritos', 'Bajas temporales', 'Bajas definitivas', 'Becas por revisar'],
                'filas' => array_map(fn ($c) => [
                    [$c['siglas'], $c['nombre']],
                    number_format($c['inscritos']),
                    number_format($c['temporales']),
                    number_format($c['definitivas']),
                    number_format($c['becas']),
                ], $carreras),
                'enlace' => ['texto' => 'Ver estadísticas', 'url' => url('/servicios_escolares/estadisticas')],
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="tabla">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Resumen por carrera</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $periodoTexto }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay registros escolares en este periodo." />
            </div>
        @endif
    </div>

    {{-- Accesos rápidos (solo módulos visibles que el rol ya tiene en el sidebar) --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @include('panel.dashboard.consultas.accesos', [
            'subtituloAccesos' => 'Módulos principales de Servicios Escolares',
            'accesos' => [
                ['titulo' => 'Revisión de cargas', 'detalle' => 'Validar cargas académicas', 'icono' => 'formularios', 'url' => url('/validacion_de_carga')],
                ['titulo' => 'Evaluaciones', 'detalle' => 'Calificaciones y actas', 'icono' => 'tablas', 'url' => url('/servicios_escolares/carreras_calificaciones')],
                ['titulo' => 'Historial académico', 'detalle' => 'Kárdex por estudiante', 'icono' => 'paginas', 'url' => url('/servicios_escolares/historial_academico')],
                ['titulo' => 'Registrar semestre', 'detalle' => 'Estudiantes de nuevo registro', 'icono' => 'calendario', 'url' => url('/servicios_escolares/registrar_semestre_alumnos/carrera')],
                ['titulo' => 'Solicitudes de beca', 'detalle' => 'Primera revisión', 'icono' => 'usuario', 'url' => url('/beca_estimulo/escolares/autorizar')],
                ['titulo' => 'Estadísticas', 'detalle' => 'Datos del TESVB', 'icono' => 'graficas', 'url' => url('/servicios_escolares/estadisticas')],
            ],
        ])
    </div>
@endif
