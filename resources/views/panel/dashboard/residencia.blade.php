{{--
    Dashboard de RESIDENCIAS PROFESIONALES (sesión "residencia"). Mismo acomodo y parciales que los de Planeación y
    Consultas, Finanzas y Titulación. Datos: App\Services\Panel\DatosResidencia (vía PanelInicioComposer), en $tablero.
    Todo es del PERIODO seleccionado. Sin datos personales de alumnos, asesores ni empresas: solo conteos y agregados.
    El encabezado (x-panel.hero) va arriba, en panel/inicio.blade.php (panel/dashboard/residencia/encabezado).
    Ver docs/DASHBOARD_RESIDENCIA.md.
--}}
@if($tablero === null)
    <div class="tw:col-span-12" data-panel-dashboard="residencia">
        <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:md:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3">
            <x-panel.vacio titulo="Sin datos" mensaje="No fue posible obtener los indicadores de residencias." />
        </div>
    </div>
@else
    <?php
        $periodoTexto = $tablero['periodo'] ?? 'Periodo actual';
        $anteproyectos = $tablero['anteproyectos'];
        $carreras = $tablero['carreras'];
        $tarjetaVacia = 'tw:h-full tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:sm:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3';
    ?>

    {{-- Indicadores --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full" data-panel-dashboard="residencia">
        @include('panel.dashboard.metricas', ['metricas' => [
            ['clave' => 'en_revision', 'etiqueta' => 'Anteproyectos en revisión', 'icono' => 'documento',
             'valor' => $anteproyectos['en_revision'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'altas', 'etiqueta' => 'Documentación de alta por autorizar', 'icono' => 'tareas',
             'valor' => $tablero['altas_por_autorizar'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'residentes', 'etiqueta' => 'Residentes del periodo', 'icono' => 'estudiantes',
             'valor' => $tablero['residentes'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'actas', 'etiqueta' => 'Actas por autorizar (' . number_format($tablero['actas']['autorizadas']) . ' autorizadas)', 'icono' => 'aprobado',
             'valor' => $tablero['actas']['por_autorizar'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'asesores', 'etiqueta' => 'Asesores asignados (' . number_format($tablero['revisores']) . ' revisores)', 'icono' => 'docentes',
             'valor' => $tablero['asesores'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'empresas', 'etiqueta' => 'Empresas con residentes', 'icono' => 'empresa',
             'valor' => $tablero['empresas'], 'anterior' => null, 'periodo_anterior' => null],
        ]])
    </div>

    {{-- Dona: anteproyectos por estado --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @include('panel.dashboard.dona', [
            'titulo' => 'Anteproyectos por estado',
            'subtitulo' => $periodoTexto,
            'segmentos' => [
                ['etiqueta' => 'En revisión', 'valor' => $anteproyectos['en_revision']],
                ['etiqueta' => 'En modificación', 'valor' => $anteproyectos['en_modificacion']],
                ['etiqueta' => 'Autorizados', 'valor' => $anteproyectos['autorizados']],
            ],
            'vacio' => 'No hay anteproyectos registrados en este periodo.',
        ])
    </div>

    {{-- Barras: residentes por carrera --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if(array_sum(array_column($carreras, 'residentes')) > 0)
            @include('panel.dashboard.barras', [
                'titulo' => 'Residentes por carrera',
                'subtitulo' => $periodoTexto,
                'serie' => 'Residentes',
                'categorias' => array_column($carreras, 'siglas'),
                'valores' => array_column($carreras, 'residentes'),
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="barras">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Residentes por carrera</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $periodoTexto }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay residentes con alta autorizada en este periodo." />
            </div>
        @endif
    </div>

    {{-- Barras: residentes por giro de empresa --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if(count($tablero['giros']) > 0)
            @include('panel.dashboard.barras', [
                'titulo' => 'Residentes por giro de empresa',
                'subtitulo' => $periodoTexto,
                'serie' => 'Residentes',
                'categorias' => array_column($tablero['giros'], 'giro'),
                'valores' => array_column($tablero['giros'], 'total'),
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="barras">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Residentes por giro de empresa</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $periodoTexto }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay empresas con residentes en este periodo." />
            </div>
        @endif
    </div>

    {{-- Línea: anteproyectos y residentes por periodo --}}
    <div class="tw:col-span-12">
        @if(array_sum(array_column($tablero['historico'], 'anteproyectos')) + array_sum(array_column($tablero['historico'], 'residentes')) > 0)
            @include('panel.dashboard.linea', [
                'titulo' => 'Anteproyectos y residentes por periodo',
                'subtitulo' => 'El periodo seleccionado y los 5 anteriores',
                'categorias' => array_column($tablero['historico'], 'periodo'),
                'series' => [
                    ['clave' => 'anteproyectos', 'nombre' => 'Anteproyectos', 'valores' => array_column($tablero['historico'], 'anteproyectos')],
                    ['clave' => 'residentes', 'nombre' => 'Residentes', 'valores' => array_column($tablero['historico'], 'residentes')],
                ],
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="linea">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Anteproyectos y residentes por periodo</h3>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay anteproyectos ni residentes en los últimos periodos." />
            </div>
        @endif
    </div>

    {{-- Tabla: resumen por carrera (sin nombres) --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full tw:*:px-5 tw:*:pt-5 tw:*:pb-5 tw:sm:*:px-6 tw:sm:*:pt-6">
        @if(array_sum(array_map(fn ($c) => $c['anteproyectos'] + $c['altas_por_autorizar'] + $c['residentes'] + $c['actas_autorizadas'], $carreras)) > 0)
            @include('panel.dashboard.tabla', [
                'titulo' => 'Resumen por carrera',
                'subtitulo' => $periodoTexto,
                'columnas' => ['Carrera', 'Anteproyectos', 'En revisión', 'Altas por autorizar', 'Residentes', 'Actas autorizadas'],
                'filas' => array_map(fn ($c) => [
                    [$c['siglas'], $c['nombre']],
                    number_format($c['anteproyectos']),
                    number_format($c['en_revision']),
                    number_format($c['altas_por_autorizar']),
                    number_format($c['residentes']),
                    number_format($c['actas_autorizadas']),
                ], $carreras),
                'enlace' => ['texto' => 'Ver estadísticas', 'url' => url('/residencia/estadisticas_residencia')],
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="tabla">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Resumen por carrera</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $periodoTexto }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay registros de residencias en este periodo." />
            </div>
        @endif
    </div>

    {{-- Accesos rápidos (solo módulos visibles que el rol ya tiene en el sidebar) --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @include('panel.dashboard.consultas.accesos', [
            'subtituloAccesos' => 'Módulos principales de Residencias Profesionales',
            'accesos' => [
                ['titulo' => 'Anteproyectos', 'detalle' => 'Estado y permisos de modificación', 'icono' => 'paginas', 'url' => url('/residencia/ver_anteproyectos_revisores')],
                ['titulo' => 'Alta de residencia', 'detalle' => 'Autorizar documentación', 'icono' => 'formularios', 'url' => url('/residencia/autorizar_documentacion_anteproyecto')],
                ['titulo' => 'Periodos de revisión', 'detalle' => 'Evaluación de anteproyectos', 'icono' => 'calendario', 'url' => url('/residencia/evalucion_anteproyecto')],
                ['titulo' => 'Empresas', 'detalle' => 'Registro y asesor externo', 'icono' => 'caja', 'url' => url('/residencia/empresa')],
                ['titulo' => 'Estadísticas', 'detalle' => 'Por carrera, giro y sector', 'icono' => 'graficas', 'url' => url('/residencia/estadisticas_residencia')],
                ['titulo' => 'Actas de residencia', 'detalle' => 'Autorizar impresión', 'icono' => 'tablas', 'url' => url('/residencia/autorizar_imprimir_acta')],
            ],
        ])
    </div>
@endif
