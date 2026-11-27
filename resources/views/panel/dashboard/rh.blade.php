{{--
    Dashboard de RECURSOS HUMANOS (sesión "personal"; perfil "rh"). Mismo acomodo y parciales que los de Planeación y
    Consultas, Finanzas, Titulación, Residencias y Centro de Cómputo. Datos: App\Services\Panel\DatosRecursosHumanos (vía
    PanelInicioComposer), en $tablero. Oficios, incidencias y evidencias son del AÑO en curso (las bandejas por validar,
    de todo lo pendiente); personal y plantilla, del estado actual. Solo conteos y agregados por catálogo: sin nombres,
    RFC, domicilios ni otros datos personales. El encabezado (x-panel.hero) va arriba, en panel/inicio.blade.php
    (panel/dashboard/rh/encabezado). Ver docs/DASHBOARD_RH.md.
--}}
@if($tablero === null)
    <div class="tw:col-span-12" data-panel-dashboard="rh">
        <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:md:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3">
            <x-panel.vacio titulo="Sin datos" mensaje="No fue posible obtener los indicadores de Recursos Humanos." />
        </div>
    </div>
@else
    <?php
        $anioTexto = 'Año ' . $tablero['anio'];
        $oficiosAnio = $tablero['oficios']['anio'];
        $tarjetaVacia = 'tw:h-full tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:sm:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3';
    ?>

    {{-- Indicadores --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full" data-panel-dashboard="rh">
        @include('panel.dashboard.metricas', ['metricas' => [
            ['clave' => 'personal', 'etiqueta' => 'Personal registrado', 'icono' => 'docentes',
             'valor' => $tablero['personal'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'sin_adscripcion', 'etiqueta' => 'Personal sin adscripción a una unidad', 'icono' => 'grupos',
             'valor' => $tablero['sin_adscripcion'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'oficios_por_validar', 'etiqueta' => 'Oficios de comisión por validar', 'icono' => 'documento',
             'valor' => $tablero['oficios']['por_validar'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'evidencias_por_validar', 'etiqueta' => 'Evidencias de conocimiento por validar', 'icono' => 'tareas',
             'valor' => $tablero['evidencias_por_validar'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'oficios_aceptados', 'etiqueta' => 'Oficios de comisión aceptados en ' . $tablero['anio'] . ' (' . number_format($oficiosAnio['rechazados']) . ' rechazados)', 'icono' => 'aprobado',
             'valor' => $oficiosAnio['aceptados'], 'anterior' => null, 'periodo_anterior' => null],
            ['clave' => 'incidencias', 'etiqueta' => 'Oficios de incidencia autorizados en ' . $tablero['anio'], 'icono' => 'recibo',
             'valor' => $tablero['incidencias_autorizadas'], 'anterior' => null, 'periodo_anterior' => null],
        ]])
    </div>

    {{-- Dona: oficios de comisión del año por estado --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @include('panel.dashboard.dona', [
            'titulo' => 'Oficios de comisión por estado',
            'subtitulo' => $anioTexto,
            'segmentos' => [
                ['etiqueta' => 'Por validar', 'valor' => $oficiosAnio['por_validar']],
                ['etiqueta' => 'Aceptados', 'valor' => $oficiosAnio['aceptados']],
                ['etiqueta' => 'Rechazados', 'valor' => $oficiosAnio['rechazados']],
                ['etiqueta' => 'Devueltos para editar', 'valor' => $oficiosAnio['devueltos']],
            ],
            'vacio' => 'No hay oficios de comisión este año.',
        ])
    </div>

    {{-- Barras: personal por perfil --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if(count($tablero['perfiles']) > 0)
            @include('panel.dashboard.barras', [
                'titulo' => 'Personal por perfil',
                'subtitulo' => 'Actual',
                'serie' => 'Personas',
                'categorias' => array_column($tablero['perfiles'], 'nombre'),
                'valores' => array_column($tablero['perfiles'], 'total'),
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="barras">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Personal por perfil</h3>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay personal registrado." />
            </div>
        @endif
    </div>

    {{-- Barras: personal por categoría --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @if(count($tablero['categorias']) > 0)
            @include('panel.dashboard.barras', [
                'titulo' => 'Personal por categoría',
                'subtitulo' => 'Actual',
                'serie' => 'Personas',
                'categorias' => array_column($tablero['categorias'], 'nombre'),
                'valores' => array_column($tablero['categorias'], 'total'),
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="barras">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Personal por categoría</h3>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay personal registrado." />
            </div>
        @endif
    </div>

    {{-- Línea: oficios de comisión, oficios de incidencia y evidencias por mes --}}
    <div class="tw:col-span-12">
        @if(array_sum(array_map(fn ($m) => $m['oficios'] + $m['incidencias'] + $m['evidencias'], $tablero['meses'])) > 0)
            @include('panel.dashboard.linea', [
                'titulo' => 'Oficios y evidencias por mes',
                'subtitulo' => $anioTexto,
                'categorias' => array_column($tablero['meses'], 'mes'),
                'series' => [
                    ['clave' => 'oficios', 'nombre' => 'Oficios de comisión', 'valores' => array_column($tablero['meses'], 'oficios')],
                    ['clave' => 'incidencias', 'nombre' => 'Incidencias autorizadas', 'valores' => array_column($tablero['meses'], 'incidencias')],
                    ['clave' => 'evidencias', 'nombre' => 'Evidencias de conocimiento', 'valores' => array_column($tablero['meses'], 'evidencias')],
                ],
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="linea">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Oficios y evidencias por mes</h3>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay oficios ni evidencias este año." />
            </div>
        @endif
    </div>

    {{-- Tabla: plantilla por unidad administrativa (sin nombres) --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full tw:*:px-5 tw:*:pt-5 tw:*:pb-5 tw:sm:*:px-6 tw:sm:*:pt-6">
        @if(count($tablero['unidades']) > 0)
            @include('panel.dashboard.tabla', [
                'titulo' => 'Plantilla por unidad administrativa',
                'subtitulo' => 'Personas adscritas (actual)',
                'columnas' => ['Unidad administrativa', 'Personas'],
                'filas' => array_map(fn ($u) => [$u['unidad'], number_format($u['total'])], $tablero['unidades']),
                'enlace' => ['texto' => 'Ver plantilla', 'url' => url('/departamentoplantilla/ver')],
            ])
        @else
            <div class="{{ $tarjetaVacia }}" data-panel-bloque="tabla">
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Plantilla por unidad administrativa</h3>
                <x-panel.vacio class="tw:mt-6" mensaje="No hay personal adscrito." />
            </div>
        @endif
    </div>

    {{-- Accesos rápidos (solo módulos visibles que el rol ya tiene en el sidebar) --}}
    <div class="tw:col-span-12 tw:xl:col-span-6 tw:*:h-full">
        @include('panel.dashboard.consultas.accesos', [
            'subtituloAccesos' => 'Módulos principales de Recursos Humanos',
            'accesos' => [
                ['titulo' => 'Personal del TESVB', 'detalle' => 'Expedientes del personal', 'icono' => 'usuario', 'url' => url('/docente')],
                ['titulo' => 'Validar oficios', 'detalle' => 'Oficios de comisión', 'icono' => 'paginas', 'url' => url('/oficios/evaluacion')],
                ['titulo' => 'Agregar plantilla', 'detalle' => 'Adscribir a una unidad', 'icono' => 'formularios', 'url' => url('/departamento/plantilla')],
                ['titulo' => 'Ver plantilla', 'detalle' => 'Personal por unidad', 'icono' => 'grupo', 'url' => url('/departamentoplantilla/ver')],
                ['titulo' => 'Validar evidencias', 'detalle' => 'Evidencias de conocimiento', 'icono' => 'tablas', 'url' => url('/incidencias/validar_evidencia_departamentos')],
                ['titulo' => 'Reportes de incidencias', 'detalle' => 'Por artículo y fechas', 'icono' => 'graficas', 'url' => url('/incidencias/reportes_incidencias')],
            ],
        ])
    </div>
@endif
