{{--
    Dashboard de DESARROLLO ACADÉMICO (sesión "desa"; perfil "desarrollo"). Mismo acomodo y parciales que los demás
    dashboards del personal. Datos: App\Services\Panel\DatosDesarrollo (vía PanelInicioComposer), en $tablero. Todo es
    del PERIODO seleccionado. Solo conteos y agregados: el AVANCE de la evaluación docente (cuántos alumnos evaluaron),
    nunca resultados ni comentarios de un docente; sin nombres de alumnos ni detalle de los casos de PIASE.
    El encabezado (x-panel.hero) va arriba, en panel/inicio.blade.php (panel/dashboard/desarrollo/encabezado); el aviso
    de retícula de $jefe_division sigue en el bloque de avisos. Ver docs/DASHBOARD_DESARROLLO.md.
--}}
@if($tablero === null)
    <div class="tw:col-span-12" data-panel-dashboard="desarrollo">
        <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:md:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3">
            <x-panel.vacio titulo="Sin datos" mensaje="No fue posible obtener los indicadores de Desarrollo Académico." />
        </div>
    </div>
@else
    <?php
        $periodoTexto = $tablero['periodo'] ?? 'Periodo actual';
        $evaluacion = $tablero['evaluacion'];
        $carreras = $tablero['carreras'];
        $tutorias = $tablero['tutorias'];
        $tarjetaVacia = 'tw:h-full tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:sm:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3';
        $pendientesCarrera = array_map(fn ($c) => max(0, $c['total'] - $c['terminaron']), $carreras);
    ?>

    {{-- Indicadores --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full" data-panel-dashboard="desarrollo">
        @include('panel.dashboard.metricas', ['metricas' => [
            ['clave' => 'evaluacion', 'etiqueta' => $evaluacion === null ? 'Alumnos que terminaron la evaluación docente'
                : 'Alumnos que terminaron la evaluación docente (de ' . number_format($evaluacion['total']) . ')', 'icono' => 'aprobado',
             'valor' => $evaluacion['terminaron'] ?? null, 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'docentes', 'etiqueta' => $tablero['horas'] === null ? 'Docentes con horario'
                : 'Docentes con horario (' . number_format($tablero['horas']) . ' horas)', 'icono' => 'docentes',
             'valor' => $tablero['docentes'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'tutores', 'etiqueta' => 'Tutores asignados (' . number_format($tutorias['grupos']) . ' grupos)', 'icono' => 'grupos',
             'valor' => $tutorias['tutores'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'tutorados', 'etiqueta' => 'Alumnos en tutoría', 'icono' => 'estudiantes',
             'valor' => $tutorias['alumnos'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'casos', 'etiqueta' => 'Casos PIASE (' . number_format($tablero['casos']['cerrados']) . ' cerrados)', 'icono' => 'tareas',
             'valor' => $tablero['casos']['total'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'areas', 'etiqueta' => 'Áreas de atención con responsable (de ' . number_format($tablero['areas']['activas']) . ' activas)', 'icono' => 'aula',
             'valor' => $tablero['areas']['con_responsable'], 'anterior' => null, 'periodo_anterior' => null],
        ]])
    </div>

    {{-- Radial: avance de la evaluación docente (mismo bloque que Planeación y Consultas) --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if($evaluacion !== null && $evaluacion['porcentaje'] !== null)
            @include('panel.dashboard.radial', [
                'titulo' => 'Avance de la evaluación docente',
                'subtitulo' => $periodoTexto . ' · ' . ($evaluacion['activa'] ? 'Evaluación activa' : 'Evaluación desactivada'),
                'porcentaje' => $evaluacion['porcentaje'],
                'texto' => number_format($evaluacion['terminaron']) . ' de ' . number_format($evaluacion['total']) . ' alumnos con carga validada terminaron la evaluación.',
                'detalle' => [
                    ['etiqueta' => 'Por evaluar', 'valor' => $evaluacion['total']],
                    ['etiqueta' => 'Terminaron', 'valor' => $evaluacion['terminaron']],
                    ['etiqueta' => 'Pendientes', 'valor' => $evaluacion['pendientes']],
                ],
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="radial">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Avance de la evaluación docente</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $periodoTexto }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay alumnos por evaluar en este periodo." />
            </div>
        @endif
    </div>

    {{-- Barras: alumnos pendientes de evaluar por carrera (conteos, nunca resultados de un docente) --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if(array_sum($pendientesCarrera) > 0)
            @include('panel.dashboard.barras', [
                'titulo' => 'Alumnos pendientes de evaluar por carrera',
                'subtitulo' => $periodoTexto,
                'serie' => 'Pendientes',
                'categorias' => array_column($carreras, 'siglas'),
                'valores' => $pendientesCarrera,
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="barras">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Alumnos pendientes de evaluar por carrera</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $periodoTexto }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay alumnos pendientes de evaluar en este periodo." />
            </div>
        @endif
    </div>

    {{-- Barras: canalizaciones PIASE por área de atención --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if(count($tablero['canalizaciones']) > 0)
            @include('panel.dashboard.barras', [
                'titulo' => 'Canalizaciones PIASE por área de atención',
                'subtitulo' => $periodoTexto,
                'serie' => 'Canalizaciones',
                'categorias' => array_column($tablero['canalizaciones'], 'area'),
                'valores' => array_column($tablero['canalizaciones'], 'total'),
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="barras">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Canalizaciones PIASE por área de atención</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $periodoTexto }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay canalizaciones en este periodo." />
            </div>
        @endif
    </div>

    {{-- Línea: casos y canalizaciones PIASE por periodo --}}
    <div class="tw:col-span-12">
        @if(array_sum(array_column($tablero['historico'], 'casos')) + array_sum(array_column($tablero['historico'], 'canalizaciones')) > 0)
            @include('panel.dashboard.linea', [
                'titulo' => 'Casos y canalizaciones PIASE por periodo',
                'subtitulo' => 'El periodo seleccionado y los 5 anteriores',
                'categorias' => array_column($tablero['historico'], 'periodo'),
                'series' => [
                    ['clave' => 'casos', 'nombre' => 'Casos', 'valores' => array_column($tablero['historico'], 'casos')],
                    ['clave' => 'canalizaciones', 'nombre' => 'Canalizaciones', 'valores' => array_column($tablero['historico'], 'canalizaciones')],
                ],
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="linea">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Casos y canalizaciones PIASE por periodo</h3>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay casos de PIASE en los últimos periodos." />
            </div>
        @endif
    </div>

    {{-- Tabla: evaluación y PIASE por carrera (sin nombres de alumnos ni de docentes) --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full tw:*:px-5 tw:*:pt-5 tw:*:pb-5 tw:sm:*:px-6 tw:sm:*:pt-6">
        @if(array_sum(array_map(fn ($c) => $c['total'] + $c['casos'], $carreras)) > 0)
            @include('panel.dashboard.tabla', [
                'titulo' => 'Evaluación docente y PIASE por carrera',
                'subtitulo' => $periodoTexto,
                'columnas' => ['Carrera', 'Por evaluar', 'Terminaron', 'Avance', 'Casos PIASE'],
                'filas' => array_map(fn ($c) => [
                    [$c['siglas'], $c['nombre']],
                    number_format($c['total']),
                    number_format($c['terminaron']),
                    $c['total'] > 0 ? number_format($c['terminaron'] * 100 / $c['total'], 1) . ' %' : '—',
                    number_format($c['casos']),
                ], $carreras),
                'enlace' => ['texto' => 'Ver avance', 'url' => url('/buscar_alumnos')],
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="tabla">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Evaluación docente y PIASE por carrera</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $periodoTexto }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay registros en este periodo." />
            </div>
        @endif
    </div>

    {{-- Accesos rápidos (solo módulos visibles que el rol ya tiene en el sidebar) --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @include('panel.dashboard.consultas.accesos', [
            'subtituloAccesos' => 'Módulos principales de Desarrollo Académico',
            'accesos' => [
                ['titulo' => 'Avance de la evaluación', 'detalle' => 'Alumnos por carrera', 'icono' => 'graficas', 'url' => url('/buscar_alumnos')],
                ['titulo' => 'Evaluación por docente', 'detalle' => 'Reportes de evaluación', 'icono' => 'tablas', 'url' => url('/buscar_profesores')],
                ['titulo' => 'Horarios de grupos', 'detalle' => 'Por carrera y grupo', 'icono' => 'calendario', 'url' => url('/horarios/hrs_grupos')],
                ['titulo' => 'Horas por carrera', 'detalle' => 'Por categoría', 'icono' => 'cuadricula', 'url' => url('/hrs_carrera')],
                ['titulo' => 'Áreas de atención', 'detalle' => 'PIASE: responsables y horarios', 'icono' => 'grupo', 'url' => url('/desarrollo-academico/areas-atencion')],
                ['titulo' => 'Tutorías', 'detalle' => 'Grupos, tutores y alumnos', 'icono' => 'usuario', 'url' => url('/tutorias')],
            ],
        ])
    </div>
@endif
