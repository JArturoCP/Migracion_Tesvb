{{--
    Dashboard del DOCENTE (sesión "profesor_sinact" o "profesor_conact"; perfil "docente"). Mismo acomodo y parciales que
    los demás dashboards del personal. Datos: App\Services\Panel\DatosDocente (vía PanelInicioComposer), en $tablero: SOLO
    del docente de la sesión y del PERIODO seleccionado. Solo conteos y promedios por materia-grupo, el horario
    (catálogos) y el AVANCE de su evaluación: sin nombres, cuentas ni calificaciones por alumno.
    Los accesos rápidos siguen las MISMAS condiciones del sidebar (p. ej. con id_unidad_admin no aparecen Calificaciones,
    Resultados de evaluación ni Tutorías). La sección de tutor solo se dibuja si es tutor en el periodo.
    El encabezado (x-panel.hero) va arriba, en panel/inicio.blade.php (panel/dashboard/docente/encabezado); los avisos
    (men, fecha de complementarias, PIASE) siguen en el bloque de avisos. Ver docs/DASHBOARD_DOCENTE.md.
--}}
@if($tablero === null)
    <div class="tw:col-span-12" data-panel-dashboard="docente">
        <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:md:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3">
            <x-panel.vacio titulo="Sin datos" mensaje="No fue posible obtener tus indicadores." />
        </div>
    </div>
@else
    <?php
        $periodoTexto = $tablero['periodo'] ?? 'Periodo actual';
        $grupos = $tablero['grupos'];
        $captura = $tablero['captura'];
        $evaluacion = $tablero['evaluacion'];
        $tutoria = $tablero['tutoria'];
        $hoy = $tablero['hoy'];
        $etiquetaGrupo = fn ($g) => $g['materia'] . ' · ' . trim($g['carrera'] . ' ' . $g['grupo']);
        $tarjetaVacia = 'tw:h-full tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:sm:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3';

        // Mismas condiciones que el sidebar (partials/panel/sidebar.blade.php, M005–M020).
        $idPerso = Session::get('id_perso');
        $conActividad = session()->has('profesor_conact');
        $sinUnidad = ! session()->has('id_unidad_admin');
        $accesos = [];
        if ($conActividad || $sinUnidad) {
            $accesos[] = ['titulo' => 'Calificaciones', 'detalle' => 'Captura por unidad y listas', 'icono' => 'tablas', 'url' => url('/docente/' . $idPerso . '/carreras')];
        }
        if ($sinUnidad) {
            $accesos[] = ['titulo' => 'Resultados de evaluación', 'detalle' => 'Tu evaluación docente', 'icono' => 'graficas', 'url' => url('/reportes2/' . $idPerso . '/1/0')];
            if ((int) Session::get('tipo_persona') === 2) {
                $accesos[] = ['titulo' => 'Tutorías', 'detalle' => 'Tu grupo de tutoría', 'icono' => 'grupo', 'url' => url('/tutorias')];
            }
        }
        if ($conActividad) {
            $accesos[] = ['titulo' => 'Planeación de complementarias', 'detalle' => 'Tu actividad complementaria', 'icono' => 'formularios', 'url' => url('/planeacion_actividad')];
        }
        if (session()->has('seguimiento_asesor')) {
            $accesos[] = ['titulo' => 'Seguimiento de Residencia', 'detalle' => 'Residentes que asesoras', 'icono' => 'paginas', 'url' => url('/residencia/seguimiento_asesor')];
        }
        $accesos[] = ['titulo' => 'Datos personales', 'detalle' => 'Editar tus datos', 'icono' => 'usuario', 'url' => url('/docentes/modificar')];
    ?>

    {{-- Indicadores --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full" data-panel-dashboard="docente">
        @include('panel.dashboard.metricas', ['metricas' => [
            ['clave' => 'grupos', 'etiqueta' => 'Grupos a tu cargo (' . number_format($tablero['materias']) . ' materias)', 'icono' => 'grupos',
             'valor' => count($grupos), 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'alumnos', 'etiqueta' => 'Alumnos (' . number_format($tablero['inscripciones']) . ' inscripciones)', 'icono' => 'estudiantes',
             'valor' => $tablero['alumnos'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'capturadas', 'etiqueta' => 'Calificaciones capturadas (de ' . number_format($captura['esperadas']) . ')', 'icono' => 'tareas',
             'valor' => $captura['capturadas'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'aprobadas', 'etiqueta' => 'Unidades aprobadas (de ' . number_format($captura['capturadas']) . ' capturadas)', 'icono' => 'aprobado',
             'valor' => $captura['capturadas'] > 0 ? $captura['aprobadas'] : null, 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'hoy', 'etiqueta' => 'Clases hoy (' . $hoy['dia'] . '; ' . number_format(count($tablero['horario'])) . ' por semana)', 'icono' => 'reloj',
             'valor' => count($hoy['clases']), 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'evaluacion', 'etiqueta' => 'Alumnos que ya te evaluaron (de ' . number_format($evaluacion['deben']) . ')', 'icono' => 'documento',
             'valor' => $evaluacion['terminaron'], 'anterior' => null, 'periodo_anterior' => null],
        ]])
    </div>

    {{-- Radial: avance de captura de calificaciones --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if($captura['porcentaje'] !== null)
            @include('panel.dashboard.radial', [
                'titulo' => 'Avance de captura de calificaciones',
                'subtitulo' => $periodoTexto,
                'porcentaje' => $captura['porcentaje'],
                'texto' => number_format($captura['capturadas']) . ' de ' . number_format($captura['esperadas']) . ' calificaciones por unidad capturadas.',
                'detalle' => [
                    ['etiqueta' => 'Esperadas', 'valor' => $captura['esperadas']],
                    ['etiqueta' => 'Capturadas', 'valor' => $captura['capturadas']],
                    ['etiqueta' => 'Aprobadas', 'valor' => $captura['aprobadas']],
                ],
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="radial">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Avance de captura de calificaciones</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $periodoTexto }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay alumnos en tus grupos en este periodo." />
            </div>
        @endif
    </div>

    {{-- Barras: avance de captura por materia-grupo (%) --}}
    <?php $conAlumnos = array_values(array_filter($grupos, fn ($g) => $g['esperadas'] > 0)); ?>
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if(count($conAlumnos) > 0)
            @include('panel.dashboard.barras', [
                'titulo' => 'Avance de captura por materia (%)',
                'subtitulo' => $periodoTexto,
                'serie' => 'Capturado (%)',
                'categorias' => array_map($etiquetaGrupo, $conAlumnos),
                'valores' => array_map(fn ($g) => round(min($g['capturadas'], $g['esperadas']) * 100 / $g['esperadas'], 1), $conAlumnos),
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="barras">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Avance de captura por materia (%)</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $periodoTexto }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay alumnos en tus grupos en este periodo." />
            </div>
        @endif
    </div>

    {{-- Barras: promedio de lo capturado por materia-grupo --}}
    <?php $conPromedio = array_values(array_filter($grupos, fn ($g) => $g['promedio'] !== null)); ?>
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if(count($conPromedio) > 0)
            @include('panel.dashboard.barras', [
                'titulo' => 'Promedio de lo capturado por materia',
                'subtitulo' => $periodoTexto,
                'serie' => 'Promedio',
                'categorias' => array_map($etiquetaGrupo, $conPromedio),
                'valores' => array_column($conPromedio, 'promedio'),
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="barras">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Promedio de lo capturado por materia</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $periodoTexto }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="Aún no hay calificaciones capturadas." />
            </div>
        @endif
    </div>

    {{-- Barras: clases por día de la semana --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if(count($tablero['horario']) > 0)
            @include('panel.dashboard.barras', [
                'titulo' => 'Clases por día',
                'subtitulo' => $periodoTexto,
                'serie' => 'Clases',
                'categorias' => array_column($tablero['por_dia'], 'dia'),
                'valores' => array_column($tablero['por_dia'], 'total'),
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="barras">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Clases por día</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $periodoTexto }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No tienes horario en este periodo." />
            </div>
        @endif
    </div>

    {{-- Tabla: tu horario de hoy --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full tw:*:px-5 tw:*:pt-5 tw:*:pb-5 tw:sm:*:px-6 tw:sm:*:pt-6">
        @if(count($hoy['clases']) > 0)
            @include('panel.dashboard.tabla', [
                'titulo' => 'Tu horario de hoy',
                'subtitulo' => $hoy['dia'] . ' · ' . $periodoTexto,
                'columnas' => ['Hora', 'Materia', 'Grupo', 'Aula'],
                'filas' => array_map(fn ($c) => [$c['hora'], $c['materia'], $c['grupo'], $c['aula'] ?: '—'], $hoy['clases']),
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="tabla">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Tu horario de hoy</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $hoy['dia'] }} · {{ $periodoTexto }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="Hoy no tienes clases." />
            </div>
        @endif
    </div>

    {{-- Sección de tutor: solo si es tutor en el periodo --}}
    @if($tutoria !== null)
        <div class="tw:col-span-12 tw:xl:*:grid-cols-3" data-panel-tutoria>
            <h2 class="tw:mb-3 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Tutoría</h2>
            @include('panel.dashboard.metricas', ['metricas' => [
                ['clave' => 'tutorados', 'etiqueta' => 'Tutorados (' . number_format($tutoria['grupos']) . ' grupos de tutoría)', 'icono' => 'estudiantes',
                 'valor' => $tutoria['tutorados'], 'anterior' => null, 'periodo_anterior' => null],
                ['clave' => 'tutorados_carga', 'etiqueta' => 'Tutorados con carga aceptada', 'icono' => 'aprobado',
                 'valor' => $tutoria['con_carga'], 'anterior' => null, 'periodo_anterior' => null],
                ['clave' => 'casos_piase', 'etiqueta' => 'Casos PIASE de tus tutorados (' . number_format($tutoria['casos_cerrados']) . ' cerrados)', 'icono' => 'tareas',
                 'valor' => $tutoria['casos'], 'anterior' => null, 'periodo_anterior' => null],
            ]])
        </div>
    @endif

    {{-- Accesos rápidos (solo los que el sidebar le muestra a este docente) --}}
    <div class="tw:col-span-12">
        @include('panel.dashboard.consultas.accesos', [
            'subtituloAccesos' => 'Tus módulos principales',
            'accesos' => $accesos,
        ])
    </div>
@endif
