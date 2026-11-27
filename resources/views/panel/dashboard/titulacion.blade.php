{{--
    Dashboard de TITULACIÓN (sesión "titulacion"). Mismo acomodo y parciales que los de Planeación y Consultas y Finanzas.
    Datos: App\Services\Panel\DatosTitulacion (vía App\View\Composers\PanelInicioComposer), en $tablero.
    Los pendientes y las etapas son el estado actual del proceso (las tablas ti_* no tienen periodo escolar); las gráficas por
    mes usan el año calendario. Sin datos personales de los alumnos: solo conteos y agregados.
    El encabezado (x-panel.hero) va arriba, en panel/inicio.blade.php (panel/dashboard/titulacion/encabezado).
    Ver docs/DASHBOARD_TITULACION.md.
--}}
@if($tablero === null)
    <div class="tw:col-span-12" data-panel-dashboard="titulacion">
        <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:md:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3">
            <x-panel.vacio titulo="Sin datos" mensaje="No fue posible obtener los indicadores de titulación." />
        </div>
    </div>
@else
    <?php
        $pendientes = $tablero['pendientes'];
        $anioTexto = 'Año ' . $tablero['anio'];
        $tarjetaVacia = 'tw:h-full tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:sm:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3';
    ?>

    {{-- Indicadores --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full" data-panel-dashboard="titulacion">
        @include('panel.dashboard.metricas', ['metricas' => [
            ['clave' => 'requisitos', 'etiqueta' => 'Expedientes de requisitos por revisar', 'icono' => 'tareas',
             'valor' => $pendientes['requisitos'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'datos_personales', 'etiqueta' => 'Datos personales por autorizar', 'icono' => 'documento',
             'valor' => $pendientes['datos_personales'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'jurados', 'etiqueta' => 'Jurados por revisar', 'icono' => 'docentes',
             'valor' => $pendientes['jurados'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'titulaciones', 'etiqueta' => 'Titulaciones por autorizar (' . number_format($tablero['por_validar_jurado']) . ' por validar para agendar jurado)', 'icono' => 'aprobado',
             'valor' => $pendientes['titulaciones'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'proximas', 'etiqueta' => 'Titulaciones programadas en los próximos ' . $tablero['proximas']['dias'] . ' días', 'icono' => 'calendario',
             'valor' => $tablero['proximas']['total'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'liberados', 'etiqueta' => 'Titulados liberados en ' . $tablero['anio'] . ' (' . number_format($tablero['liberados']['total']) . ' en total)', 'icono' => 'estudiantes',
             'valor' => $tablero['liberados']['anio'], 'anterior' => null, 'periodo_anterior' => null],
        ]])
    </div>

    {{-- Dona: pendientes del departamento por etapa --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @include('panel.dashboard.dona', [
            'titulo' => 'Pendientes por etapa',
            'subtitulo' => 'Trámites esperando revisión del departamento',
            'segmentos' => [
                ['etiqueta' => 'Requisitos', 'valor' => $pendientes['requisitos']],
                ['etiqueta' => 'Datos personales', 'valor' => $pendientes['datos_personales']],
                ['etiqueta' => 'Jurados', 'valor' => $pendientes['jurados']],
                ['etiqueta' => 'Titulaciones', 'valor' => $pendientes['titulaciones']],
            ],
            'vacio' => 'No hay trámites pendientes de revisión.',
        ])
    </div>

    {{-- Barras: avance del proceso --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if(array_sum(array_column($tablero['etapas'], 'total')) > 0)
            @include('panel.dashboard.barras', [
                'titulo' => 'Avance del proceso de titulación',
                'subtitulo' => 'Alumnos que alcanzaron cada etapa (estado actual)',
                'serie' => 'Alumnos',
                'categorias' => array_column($tablero['etapas'], 'etapa'),
                'valores' => array_column($tablero['etapas'], 'total'),
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="barras">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Avance del proceso de titulación</h3>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay alumnos registrados en el proceso de titulación." />
            </div>
        @endif
    </div>

    {{-- Barras: alumnos en proceso por carrera --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if(array_sum(array_column($tablero['carreras'], 'total')) > 0)
            @include('panel.dashboard.barras', [
                'titulo' => 'Alumnos en proceso por carrera',
                'subtitulo' => 'Con datos de titulación y sin liberar',
                'serie' => 'Alumnos en proceso',
                'categorias' => array_column($tablero['carreras'], 'siglas'),
                'valores' => array_column($tablero['carreras'], 'total'),
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="barras">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Alumnos en proceso por carrera</h3>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay alumnos en proceso de titulación." />
            </div>
        @endif
    </div>

    {{-- Línea: titulaciones y liberaciones por mes --}}
    <div class="tw:col-span-12">
        @if(array_sum(array_column($tablero['meses'], 'titulaciones')) + array_sum(array_column($tablero['meses'], 'liberaciones')) > 0)
            @include('panel.dashboard.linea', [
                'titulo' => 'Titulaciones y liberaciones por mes',
                'subtitulo' => $anioTexto . ' · actos con jurado autorizado y titulados liberados',
                'categorias' => array_column($tablero['meses'], 'mes'),
                'series' => [
                    ['clave' => 'titulaciones', 'nombre' => 'Titulaciones', 'valores' => array_column($tablero['meses'], 'titulaciones')],
                    ['clave' => 'liberaciones', 'nombre' => 'Liberaciones', 'valores' => array_column($tablero['meses'], 'liberaciones')],
                ],
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="linea">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Titulaciones y liberaciones por mes</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $anioTexto }}</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay titulaciones ni liberaciones registradas en este año." />
            </div>
        @endif
    </div>

    {{-- Tabla: próximas titulaciones (sin nombres ni números de cuenta) --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full tw:*:px-5 tw:*:pt-5 tw:*:pb-5 tw:sm:*:px-6 tw:sm:*:pt-6">
        @if(count($tablero['proximas']['lista']) > 0)
            @include('panel.dashboard.tabla', [
                'titulo' => 'Próximas titulaciones',
                'subtitulo' => 'Actos con jurado autorizado en los próximos ' . $tablero['proximas']['dias'] . ' días',
                'columnas' => ['Fecha', 'Horario', 'Sala', 'Carrera'],
                'filas' => array_map(fn ($p) => [
                    [$p['fecha'], $p['opcion']],
                    $p['horario'],
                    $p['sala'],
                    [$p['carrera'], $p['carrera_nombre']],
                ], $tablero['proximas']['lista']),
                'enlace' => ['texto' => 'Consultar titulaciones por día', 'url' => url('/titulacion/calendario_estudiantes_autorizado')],
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="tabla">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Próximas titulaciones</h3>
                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">Próximos {{ $tablero['proximas']['dias'] }} días</p>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay titulaciones programadas en los próximos días." />
            </div>
        @endif
    </div>

    {{-- Accesos rápidos (solo módulos que el rol ya tiene en el sidebar) --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @include('panel.dashboard.consultas.accesos', [
            'subtituloAccesos' => 'Módulos principales de Titulación',
            'accesos' => [
                ['titulo' => 'Requisitos', 'detalle' => 'Autorizar documentación (1.ª etapa)', 'icono' => 'formularios', 'url' => url('/titulacion/autorizar_doc_requisitos')],
                ['titulo' => 'Datos personales', 'detalle' => 'Autorizar datos (2.ª etapa)', 'icono' => 'usuario', 'url' => url('/titulacion/autorizar_datos_personales')],
                ['titulo' => 'Jurado', 'detalle' => 'Autorizar jurado y fecha (3.ª etapa)', 'icono' => 'grupo', 'url' => url('/titulacion/autorizar_jurado_estudiantes')],
                ['titulo' => 'Titulaciones por día', 'detalle' => 'Calendario de actos', 'icono' => 'calendario', 'url' => url('/titulacion/calendario_estudiantes_autorizado')],
                ['titulo' => 'Autorizar titulaciones', 'detalle' => 'Título, acta y liberación', 'icono' => 'paginas', 'url' => url('/titulacion/formulario_datos_titulado/inicio/carrera')],
                ['titulo' => 'Titulados liberados', 'detalle' => 'Consulta y exportación por año', 'icono' => 'tablas', 'url' => url('/titulacion/liberacion_titulado_carrera')],
            ],
        ])
    </div>
@endif
