{{--
    Dashboard de PLANEACIÓN Y CONSULTAS (sesión "consultas"). Mismo acomodo y parciales que el del directivo.
    Datos: App\Services\Panel\DatosConsultas (vía App\View\Composers\PanelInicioComposer), en $tablero.
    El encabezado (x-panel.hero) va arriba, en panel/inicio.blade.php (panel/dashboard/consultas/encabezado).
    Las celdas van directo dentro del grid de panel/inicio.blade.php. Ver docs/DASHBOARD_CONSULTAS.md.
--}}
@if($tablero === null)
    <div class="tw:col-span-12" data-panel-dashboard="consultas">
        <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:md:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3">
            <x-panel.vacio titulo="Sin datos" mensaje="No fue posible obtener los indicadores del periodo." />
        </div>
    </div>
@else
    <?php
        $periodoTexto = $tablero['periodo'] ?? 'Periodo actual';
        $carreras = $tablero['carreras'];
        $evaluacion = $tablero['evaluacion'];
        $complementarias = $tablero['complementarias'];
        $tono = function ($porcentaje) {
            if ($porcentaje === null) return 'gris';
            return $porcentaje >= 80 ? 'verde' : ($porcentaje >= 50 ? 'ambar' : 'rojo');
        };
        $tarjetaVacia = 'tw:h-full tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:sm:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3';
    ?>

    {{-- Indicadores --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full" data-panel-dashboard="consultas">
        @include('panel.dashboard.metricas', ['metricas' => [
            ['clave' => 'docentes', 'etiqueta' => 'Docentes con horario', 'icono' => 'docentes',
             'valor' => $tablero['docentes']['valor'], 'anterior' => $tablero['docentes']['anterior'], 'periodo_anterior' => $tablero['periodo_anterior']],
            ['clave' => 'horas', 'etiqueta' => 'Horas frente a grupo', 'icono' => 'reloj',
             'valor' => $tablero['horas']['valor'], 'anterior' => $tablero['horas']['anterior'], 'periodo_anterior' => $tablero['periodo_anterior']],
            ['clave' => 'aulas', 'etiqueta' => 'Aulas en uso (de ' . number_format($tablero['aulas']['total']) . ')', 'icono' => 'aula',
             'valor' => $tablero['aulas']['en_uso'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'evaluacion', 'etiqueta' => 'Alumnos que terminaron la evaluación docente', 'icono' => 'estudiantes',
             'valor' => $evaluacion['terminaron'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'por_liberar', 'etiqueta' => 'Solicitudes de complementarias por liberar', 'icono' => 'tareas',
             'valor' => $complementarias['por_liberar'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'actividades', 'etiqueta' => 'Actividades complementarias vigentes', 'icono' => 'grupos',
             'valor' => $complementarias['vigentes'], 'anterior' => null, 'periodo_anterior' => null],
        ]])
    </div>

    {{-- Medidor radial: avance de la evaluación docente --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if($evaluacion['porcentaje'] !== null)
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
                <x-panel.vacio class="tw:mt-6" mensaje="No hay alumnos con carga validada para evaluar en este periodo." />
            </div>
        @endif
    </div>

    {{-- Barras: horas frente a grupo por carrera --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if(array_sum(array_column($carreras, 'horas')) > 0)
            @include('panel.dashboard.barras', [
                'titulo' => 'Horas frente a grupo por carrera',
                'subtitulo' => $periodoTexto,
                'serie' => 'Horas frente a grupo',
                'categorias' => array_column($carreras, 'siglas'),
                'valores' => array_column($carreras, 'horas'),
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="barras">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Horas frente a grupo por carrera</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $periodoTexto }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay horarios registrados en este periodo." />
            </div>
        @endif
    </div>

    {{-- Dona: solicitudes de complementarias --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @include('panel.dashboard.dona', [
            'titulo' => 'Solicitudes de complementarias',
            'subtitulo' => $periodoTexto,
            'segmentos' => [
                ['etiqueta' => 'Liberadas', 'valor' => $complementarias['liberadas']],
                ['etiqueta' => 'Por liberar', 'valor' => $complementarias['por_liberar']],
            ],
            'vacio' => 'No hay solicitudes de actividades complementarias en este periodo.',
        ])
    </div>

    {{-- Línea: carga docente de los últimos periodos --}}
    <div class="tw:col-span-12">
        @if(array_sum(array_column($tablero['historico'], 'horas')) + array_sum(array_column($tablero['historico'], 'docentes')) > 0)
            @include('panel.dashboard.linea', [
                'titulo' => 'Carga docente de los últimos periodos',
                'subtitulo' => 'Docentes con horario y horas frente a grupo por periodo',
                'categorias' => array_column($tablero['historico'], 'periodo'),
                'series' => [
                    ['clave' => 'docentes', 'nombre' => 'Docentes', 'valores' => array_column($tablero['historico'], 'docentes')],
                    ['clave' => 'horas', 'nombre' => 'Horas frente a grupo', 'valores' => array_column($tablero['historico'], 'horas')],
                ],
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="linea">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Carga docente de los últimos periodos</h3>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay horarios registrados en los últimos periodos." />
            </div>
        @endif
    </div>

    {{-- Tabla resumen por carrera --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full tw:*:px-5 tw:*:pt-5 tw:*:pb-5 tw:sm:*:px-6 tw:sm:*:pt-6">
        @include('panel.dashboard.tabla', [
            'titulo' => 'Resumen por carrera',
            'subtitulo' => $periodoTexto,
            'columnas' => ['Carrera', 'Docentes', 'Horas', 'Evaluación docente'],
            'filas' => array_map(fn ($c) => [
                [$c['siglas'], $c['nombre']],
                number_format($c['docentes']),
                number_format($c['horas']),
                ['insignia' => $c['evaluacion'] !== null ? number_format($c['evaluacion'], 1) . '%' : null, 'tono' => $tono($c['evaluacion'])],
            ], $carreras),
            'enlace' => ['texto' => 'Ver horarios por grupo', 'url' => url('/horarios/hrs_grupos')],
        ])
    </div>

    {{-- Accesos rápidos (solo módulos que el rol ya tiene en el sidebar) --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @include('panel.dashboard.consultas.accesos', ['accesos' => [
            ['titulo' => 'Solicitud de alumnos', 'detalle' => 'Liberar actividades complementarias', 'icono' => 'formularios', 'url' => url('/solicitud_alumnos')],
            ['titulo' => 'Evaluación docente', 'detalle' => 'Avance de los alumnos por carrera', 'icono' => 'graficas', 'url' => url('/buscar_alumnos')],
            ['titulo' => 'Horarios docentes', 'detalle' => 'Consultar e imprimir horarios', 'icono' => 'calendario', 'url' => url('/horarios/horarios_docentes')],
            ['titulo' => 'Estructura educativa', 'detalle' => 'Concentrado por carrera y semestre', 'icono' => 'tablas', 'url' => url('/formatos/con_edu')],
            ['titulo' => 'Plantilla educativa', 'detalle' => 'Plantilla docente por carrera', 'icono' => 'grupo', 'url' => url('/plantilla/educativa')],
            ['titulo' => 'Retículas', 'detalle' => 'Planes de estudio y materias', 'icono' => 'paginas', 'url' => url('/reticulass')],
        ]])
    </div>
@endif
