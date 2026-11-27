{{--
    Dashboard del JEFE DE DIVISIÓN (sesión "jefe_division" sin "desa"; perfil "jefe_division"). Mismo acomodo y parciales
    que los demás dashboards del personal. Datos: App\Services\Panel\DatosJefeDivision (vía PanelInicioComposer), en
    $tablero: SOLO de su carrera (session('carrera'), validada contra gnral_jefes_periodos) y del PERIODO seleccionado.
    Solo conteos y porcentajes: sin nombres, calificaciones individuales ni resultados de la evaluación de un docente.
    El encabezado (x-panel.hero) va arriba, en panel/inicio.blade.php (panel/dashboard/jefe_division/encabezado); el aviso
    de retícula y el aviso general siguen en el bloque de avisos. Ver docs/DASHBOARD_JEFE_DIVISION.md.
--}}
@if($tablero === null)
    <div class="tw:col-span-12" data-panel-dashboard="jefe_division">
        <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:md:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3">
            <x-panel.vacio titulo="Sin datos" mensaje="No hay una carrera asignada a tu jefatura o no fue posible obtener sus indicadores." />
        </div>
    </div>
@else
    <?php
        $periodoTexto = $tablero['periodo'] ?? 'Periodo actual';
        $carreraTexto = $tablero['carrera']['siglas'] ?: $tablero['carrera']['nombre'];
        $subtitulo = trim($carreraTexto . ' · ' . $periodoTexto, ' ·');
        $aprobacion = $tablero['aprobacion'];
        $revisores = $tablero['revisores'];
        $solicitudes = $tablero['solicitudes'];
        $tarjetaVacia = 'tw:h-full tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:sm:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3';
        $insignia = fn (int $n) => ['insignia' => number_format($n), 'tono' => $n > 0 ? 'ambar' : 'verde'];
    ?>

    {{-- Indicadores --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full" data-panel-dashboard="jefe_division" data-panel-carrera="{{ $tablero['carrera']['id'] }}">
        @include('panel.dashboard.metricas', ['metricas' => [
            ['clave' => 'inscritos', 'etiqueta' => 'Estudiantes inscritos', 'icono' => 'estudiantes',
             'valor' => $tablero['inscritos'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'docentes', 'etiqueta' => 'Docentes con horario (' . number_format($tablero['horas']) . ' horas)', 'icono' => 'docentes',
             'valor' => $tablero['docentes'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'aprobacion', 'etiqueta' => 'Cargas aprobadas (de ' . number_format($aprobacion['cargas']) . ')', 'icono' => 'aprobado',
             'valor' => $aprobacion['cargas'] > 0 ? $aprobacion['aprobadas'] : null, 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'revisores', 'etiqueta' => 'Revisores de residencia (de ' . $revisores['requeridos'] . ' requeridos)', 'icono' => 'documento',
             'valor' => $revisores['asignados'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'solicitudes', 'etiqueta' => 'Solicitudes de complementarias por liberar (' . number_format($solicitudes['liberadas']) . ' liberadas)', 'icono' => 'tareas',
             'valor' => $solicitudes['por_liberar'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'tutores', 'etiqueta' => 'Tutores asignados (' . number_format($tablero['tutorias']['grupos']) . ' grupos)', 'icono' => 'grupos',
             'valor' => $tablero['tutorias']['tutores'], 'anterior' => null, 'periodo_anterior' => null],
        ]])
    </div>

    {{-- Radial: aprobación del periodo --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if($aprobacion['porcentaje'] !== null)
            @include('panel.dashboard.radial', [
                'titulo' => 'Aprobación del periodo',
                'subtitulo' => $subtitulo,
                'porcentaje' => $aprobacion['porcentaje'],
                'texto' => number_format($aprobacion['aprobadas']) . ' de ' . number_format($aprobacion['cargas']) . ' cargas sin unidades reprobadas.',
                'detalle' => [
                    ['etiqueta' => 'Cargas', 'valor' => $aprobacion['cargas']],
                    ['etiqueta' => 'Aprobadas', 'valor' => $aprobacion['aprobadas']],
                    ['etiqueta' => 'Reprobadas', 'valor' => $aprobacion['reprobadas']],
                ],
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="radial">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Aprobación del periodo</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $subtitulo }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay cargas académicas calificadas en este periodo." />
            </div>
        @endif
    </div>

    {{-- Barras: inscritos por semestre --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if(count($tablero['semestres']) > 0)
            @include('panel.dashboard.barras', [
                'titulo' => 'Inscritos por semestre',
                'subtitulo' => $subtitulo,
                'serie' => 'Inscritos',
                'categorias' => array_column($tablero['semestres'], 'semestre'),
                'valores' => array_column($tablero['semestres'], 'total'),
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="barras">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Inscritos por semestre</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $subtitulo }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay estudiantes inscritos en este periodo." />
            </div>
        @endif
    </div>

    {{-- Dona: solicitudes de actividades complementarias --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @include('panel.dashboard.dona', [
            'titulo' => 'Solicitudes de complementarias',
            'subtitulo' => $carreraTexto,
            'segmentos' => [
                ['etiqueta' => 'Por liberar', 'valor' => $solicitudes['por_liberar']],
                ['etiqueta' => 'Liberadas', 'valor' => $solicitudes['liberadas']],
            ],
            'vacio' => 'No hay solicitudes de actividades complementarias.',
        ])
    </div>

    {{-- Línea: inscritos y docentes por periodo --}}
    <div class="tw:col-span-12">
        @if(array_sum(array_column($tablero['historico'], 'inscritos')) + array_sum(array_column($tablero['historico'], 'docentes')) > 0)
            @include('panel.dashboard.linea', [
                'titulo' => 'Inscritos y docentes por periodo',
                'subtitulo' => $carreraTexto . ' · el periodo seleccionado y los 5 anteriores',
                'categorias' => array_column($tablero['historico'], 'periodo'),
                'series' => [
                    ['clave' => 'inscritos', 'nombre' => 'Inscritos', 'valores' => array_column($tablero['historico'], 'inscritos')],
                    ['clave' => 'docentes', 'nombre' => 'Docentes', 'valores' => array_column($tablero['historico'], 'docentes')],
                ],
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="linea">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Inscritos y docentes por periodo</h3>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay inscritos ni docentes en los últimos periodos." />
            </div>
        @endif
    </div>

    {{-- Tabla: pendientes de la jefatura (conteos, con enlace a su módulo) --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full tw:*:px-5 tw:*:pt-5 tw:*:pb-5 tw:sm:*:px-6 tw:sm:*:pt-6">
        @include('panel.dashboard.tabla', [
            'titulo' => 'Pendientes de la jefatura',
            'subtitulo' => $subtitulo,
            'columnas' => ['Pendiente', 'Cantidad', 'Módulo'],
            'filas' => [
                ['Revisores de residencia por asignar', $insignia(max(0, $revisores['requeridos'] - $revisores['asignados'])),
                    ['enlace' => 'Asignar revisores', 'url' => url('/residencia/asignar_revisores')]],
                ['Solicitudes de alumnos por liberar', $insignia($solicitudes['por_liberar']),
                    ['enlace' => 'Liberar solicitudes', 'url' => url('/alumnos_actividades')]],
                ['Planeaciones docentes por liberar', $insignia($tablero['planeaciones']['por_liberar']),
                    ['enlace' => 'Liberar planeaciones', 'url' => url('/libera_planeacion')]],
                ['Residentes de la carrera', number_format($tablero['residentes']),
                    ['enlace' => 'Ver residentes', 'url' => url('/residentes/carrera')]],
            ],
        ])
    </div>

    {{-- Accesos rápidos (solo módulos visibles que el rol ya tiene en el sidebar) --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @include('panel.dashboard.consultas.accesos', [
            'subtituloAccesos' => 'Módulos principales de la Jefatura de División',
            'accesos' => [
                ['titulo' => 'Calificaciones', 'detalle' => 'Docentes y materias de la carrera', 'icono' => 'tablas', 'url' => url(Session::get('id_carrera') . '/docentes')],
                ['titulo' => 'Plantilla docente', 'detalle' => 'Ver plantilla del periodo', 'icono' => 'grupo', 'url' => url('/plantilla/ver')],
                ['titulo' => 'Liberar solicitudes', 'detalle' => 'Actividades complementarias', 'icono' => 'formularios', 'url' => url('/alumnos_actividades')],
                ['titulo' => 'Asignar revisores', 'detalle' => 'Residencia profesional', 'icono' => 'paginas', 'url' => url('/residencia/asignar_revisores')],
                ['titulo' => 'Análisis de reprobación', 'detalle' => 'Por materia y grupo', 'icono' => 'graficas', 'url' => url('/analisis-reprobacion')],
                ['titulo' => 'Tutorías', 'detalle' => 'Coordinador, tutores y estudiantes', 'icono' => 'usuario', 'url' => url('/tutorias')],
            ],
        ])
    </div>
@endif
