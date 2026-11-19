{{--
    Dashboard del PROFESOR DE INGLÉS en /ingles (mismo acomodo que panel/dashboard/directivo).
    Datos: App\Services\Panel\DatosIngles (vía App\View\Composers\InglesInicioComposer), en $tablero.
    Las celdas van directo dentro del grid de ingles/inicio_ingles/inicio_ingles.blade.php.
--}}
@if($tablero === null)
    <div class="tw:col-span-12" data-panel-dashboard="profesor_ingles">
        <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:md:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3">
            @include('panel.dashboard.sin_datos', ['detalle' => 'No fue posible obtener los datos de tus grupos del periodo de inglés.'])
        </div>
    </div>
@else
    <?php
        $periodoTexto = $tablero['periodo'] ?? 'Periodo de inglés actual';
        $grupos = $tablero['grupos'];
        $captura = $tablero['captura'];
        $nombreGrupo = fn ($g) => $g['nivel'] . ' · ' . $g['grupo'];
    ?>

    {{-- Métricas + barras --}}
    <div class="tw:col-span-12 tw:space-y-6 tw:xl:col-span-7" data-panel-dashboard="profesor_ingles">
        @include('panel.dashboard.metricas', ['metricas' => [
            ['clave' => 'mis_grupos', 'etiqueta' => 'Mis grupos del periodo', 'icono' => 'grupos',
             'valor' => $tablero['mis_grupos']['valor'], 'anterior' => $tablero['mis_grupos']['anterior'], 'periodo_anterior' => $tablero['periodo_anterior']],
            ['clave' => 'alumnos_inscritos', 'etiqueta' => 'Alumnos inscritos en mis grupos', 'icono' => 'estudiantes',
             'valor' => $tablero['alumnos_inscritos']['valor'], 'anterior' => $tablero['alumnos_inscritos']['anterior'], 'periodo_anterior' => $tablero['periodo_anterior']],
        ]])

        @include('panel.dashboard.barras', [
            'titulo' => 'Alumnos inscritos por grupo',
            'subtitulo' => $periodoTexto,
            'serie' => 'Alumnos inscritos',
            'categorias' => array_map($nombreGrupo, $grupos),
            'valores' => array_column($grupos, 'inscritos'),
        ])
    </div>

    {{-- Medidor radial: avance de captura --}}
    <div class="tw:col-span-12 tw:xl:col-span-5">
        @include('panel.dashboard.radial', [
            'titulo' => 'Avance de captura de calificaciones',
            'subtitulo' => $periodoTexto,
            'porcentaje' => $captura['porcentaje'],
            'texto' => $captura['porcentaje'] !== null
                ? number_format($captura['capturadas']) . ' de ' . number_format($captura['esperadas']) . ' evaluaciones capturadas (2 por grupo).'
                : 'No tienes grupos asignados en este periodo de inglés.',
            'detalle' => [
                ['etiqueta' => 'Capturadas', 'valor' => $captura['capturadas']],
                ['etiqueta' => 'Por capturar', 'valor' => $captura['por_capturar']],
                ['etiqueta' => 'Sin fecha', 'valor' => $captura['sin_fecha']],
            ],
        ])
    </div>

    {{-- Línea: últimos periodos de inglés --}}
    <div class="tw:col-span-12">
        @include('panel.dashboard.linea', [
            'titulo' => 'Alumnos en mis grupos por periodo',
            'subtitulo' => 'Alumnos inscritos y grupos en los últimos periodos de inglés',
            'categorias' => array_column($tablero['historico'], 'periodo'),
            'series' => [
                ['clave' => 'inscritos', 'nombre' => 'Alumnos', 'valores' => array_column($tablero['historico'], 'inscritos')],
                ['clave' => 'grupos', 'nombre' => 'Grupos', 'valores' => array_column($tablero['historico'], 'grupos')],
            ],
        ])
    </div>

    {{-- Lista con porcentajes: alumnos por nivel --}}
    <div class="tw:col-span-12 tw:xl:col-span-5">
        @include('panel.dashboard.lista', [
            'titulo' => 'Alumnos por nivel',
            'subtitulo' => 'Alumnos inscritos en ' . $periodoTexto,
            'unidad' => 'alumnos',
            'elementos' => array_map(fn ($n) => [
                'nombre' => $n['nombre'], 'detalle' => $n['grupos'] . ($n['grupos'] === 1 ? ' grupo' : ' grupos'), 'color' => $n['color'], 'valor' => $n['inscritos'],
            ], $tablero['niveles']),
        ])
    </div>

    {{-- Tabla: Mis grupos --}}
    <div class="tw:col-span-12 tw:xl:col-span-7">
        @include('panel.dashboard.tabla', [
            'titulo' => 'Mis grupos',
            'subtitulo' => $periodoTexto,
            'columnas' => ['Grupo', 'Inscritos', 'Capturadas', 'Por capturar', 'Sin fecha', ''],
            'filas' => array_map(fn ($g) => [
                [$g['nivel'], 'Grupo ' . $g['grupo']],
                number_format($g['inscritos']),
                $g['capturadas'] . ' de 2',
                ['insignia' => (string) $g['por_capturar'], 'tono' => $g['por_capturar'] > 0 ? 'ambar' : 'verde'],
                ['insignia' => (string) $g['sin_fecha'], 'tono' => $g['sin_fecha'] > 0 ? 'rojo' : 'verde'],
                ['enlace' => 'Periodos', 'url' => '/ingles/Calificaciones/periodos_ingles/' . $g['id_nivel'] . '/' . $g['id_grupo']],
            ], $grupos),
            'enlace' => ['texto' => 'Ir a Calificaciones', 'url' => url('/ingles/Calificaciones')],
        ])
    </div>
@endif
