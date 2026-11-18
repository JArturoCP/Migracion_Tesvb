{{--
    Dashboard del DIRECTIVO (mismo acomodo que src/pages/index.html de TailAdmin).
    Datos: App\Services\Panel\DatosDirectivo (vía App\View\Composers\PanelInicioComposer), en $tablero.
    Las celdas van directo dentro del grid de panel/inicio.blade.php.
--}}
@if($tablero === null)
    <div class="tw:col-span-12" data-panel-dashboard="directivo">
        <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:md:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3">
            @include('panel.dashboard.sin_datos', ['detalle' => 'No fue posible obtener los indicadores del periodo.'])
        </div>
    </div>
@else
    <?php
        $periodoTexto = $tablero['periodo'] ?? 'Periodo actual';
        $carreras = $tablero['carreras'];
        $aprobacion = $tablero['aprobacion'];
        $tono = function ($porcentaje) {
            if ($porcentaje === null) return 'gris';
            return $porcentaje >= 80 ? 'verde' : ($porcentaje >= 60 ? 'ambar' : 'rojo');
        };
    ?>

    {{-- Métricas + barras --}}
    <div class="tw:col-span-12 tw:space-y-6 tw:xl:col-span-7" data-panel-dashboard="directivo">
        @include('panel.dashboard.metricas', ['metricas' => [
            ['clave' => 'inscritos', 'etiqueta' => 'Estudiantes inscritos', 'icono' => 'estudiantes',
             'valor' => $tablero['inscritos']['valor'], 'anterior' => $tablero['inscritos']['anterior'], 'periodo_anterior' => $tablero['periodo_anterior']],
            ['clave' => 'docentes', 'etiqueta' => 'Docentes con horario', 'icono' => 'docentes',
             'valor' => $tablero['docentes']['valor'], 'anterior' => $tablero['docentes']['anterior'], 'periodo_anterior' => $tablero['periodo_anterior']],
        ]])

        @include('panel.dashboard.barras', [
            'titulo' => 'Estudiantes inscritos por carrera',
            'subtitulo' => $periodoTexto,
            'serie' => 'Estudiantes inscritos',
            'categorias' => array_column($carreras, 'siglas'),
            'valores' => array_column($carreras, 'inscritos'),
        ])
    </div>

    {{-- Medidor radial --}}
    <div class="tw:col-span-12 tw:xl:col-span-5">
        @include('panel.dashboard.radial', [
            'titulo' => 'Índice de aprobación',
            'subtitulo' => $periodoTexto,
            'porcentaje' => $aprobacion['porcentaje'],
            'texto' => $aprobacion['porcentaje'] !== null
                ? number_format($aprobacion['aprobadas']) . ' de ' . number_format($aprobacion['cargas']) . ' materias cursadas sin unidades reprobadas.'
                : 'No hay calificaciones registradas de cargas validadas en este periodo.',
            'detalle' => [
                ['etiqueta' => 'Materias cursadas', 'valor' => $aprobacion['cargas']],
                ['etiqueta' => 'Aprobadas', 'valor' => $aprobacion['aprobadas']],
                ['etiqueta' => 'Reprobadas', 'valor' => $aprobacion['reprobadas']],
            ],
        ])
    </div>

    {{-- Línea: últimos 6 periodos --}}
    <div class="tw:col-span-12">
        @include('panel.dashboard.linea', [
            'titulo' => 'Matrícula de los últimos periodos',
            'subtitulo' => 'Estudiantes inscritos y docentes con horario por periodo',
            'categorias' => array_column($tablero['historico'], 'periodo'),
            'series' => [
                ['clave' => 'inscritos', 'nombre' => 'Estudiantes', 'valores' => array_column($tablero['historico'], 'inscritos')],
                ['clave' => 'docentes', 'nombre' => 'Docentes', 'valores' => array_column($tablero['historico'], 'docentes')],
            ],
        ])
    </div>

    {{-- Lista con porcentajes --}}
    <div class="tw:col-span-12 tw:xl:col-span-5">
        @include('panel.dashboard.lista', [
            'titulo' => 'Distribución por carrera',
            'subtitulo' => 'Estudiantes inscritos en ' . $periodoTexto,
            'unidad' => 'estudiantes',
            'elementos' => array_map(fn ($c) => [
                'nombre' => $c['siglas'], 'detalle' => $c['nombre'], 'color' => $c['color'], 'valor' => $c['inscritos'],
            ], $carreras),
        ])
    </div>

    {{-- Tabla --}}
    <div class="tw:col-span-12 tw:xl:col-span-7">
        @include('panel.dashboard.tabla', [
            'titulo' => 'Resumen por carrera',
            'subtitulo' => $periodoTexto,
            'columnas' => ['Carrera', 'Estudiantes', 'Docentes', 'Aprobación'],
            'filas' => array_map(fn ($c) => [
                [$c['siglas'], $c['nombre']],
                number_format($c['inscritos']),
                number_format($c['docentes']),
                ['insignia' => $c['aprobacion'] !== null ? number_format($c['aprobacion'], 2) . '%' : null, 'tono' => $tono($c['aprobacion'])],
            ], $carreras),
            'enlace' => ['texto' => 'Ver estadísticas', 'url' => url('/servicios_escolares/estadisticas')],
        ])
    </div>
@endif
