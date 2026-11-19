{{--
    Inicio del módulo de inglés (/ingles, In_inicioController@index, sin datos del controlador).
    Lo ven el profesor de inglés (M252), el alumno (M227) y la coordinación de inglés / unidad 19 (M026).

    Diseño del panel (layouts.panel):
      - Bienvenida: el "Bienvenido(a)" de antes, con el nombre y el periodo de inglés de la sesión
        (los mismos datos que mostraban las insignias del menú de inglés).
      - Aviso: el mensaje global "men" de la sesión, como en /inicio.
      - Solo profesor de inglés: métricas de solo lectura (App\Services\Panel\DatosProfesorIngles,
        vía App\View\Composers\InglesInicioComposer en $tableroIngles).
      - Accesos: las opciones del menú de inglés de cada rol, con las mismas condiciones y href
        que ingles/inicio_ingles/menu_ingles (y que el submenú "Inglés" del sidebar).
--}}
@extends('layouts.panel')
@section('title', 'Ingles')
@section('content')
    <?php
        // El header muestra el botón "Periodo de Inglés" en las pantallas de inglés.
        $moduloIngles = true;

        // ingles/inicio_ingles/menu_ingles L5-8
        $unidad = Session::get('id_unidad_admin');
        $palumno = session()->has('palumno') ? session()->has('palumno') : false;
        $profesor_ingles = session()->has('profesor_ingles') ? session()->has('profesor_ingles') : false;
        $nombre = Session::get('nombre');
        $nombre_periodo = Session::get('nombre_periodo_ingles');
        $men = Session::get('men');

        // Accesos: mismas opciones, condiciones y href que menu_ingles (L57-194).
        $accesos = [];
        if ($profesor_ingles == true) {
            $id_usuario = Session::get('id_usuario');
            $accesos[] = ['titulo' => 'Calificaciones', 'enlaces' => [
                ['Calificaciones', url('/ingles/Calificaciones')],
            ]];
            $accesos[] = ['titulo' => 'Datos P.', 'enlaces' => [
                ['Editar', '/profesores_ingles/modificar/' . $id_usuario . '/'],
            ]];
        }
        if ($unidad == 19) {
            $accesos[] = ['titulo' => 'Facilitadores y catálogos', 'enlaces' => [
                ['Facilitadores de ingles', url('/armar_plantilla/profesore_ingles')],
                ['Niveles', url('/ingles/mostrar_niveles')],
                ['Grupos', url('/ingles_horarios/mostrar_grupo')],
                ['Periodos intersemestrales', url('/ingles/mostrar_periodos')],
                ['Cargas academicas', url('/ingles/autorizacion_cargas/')],
            ]];
            $accesos[] = ['titulo' => 'Horarios', 'enlaces' => [
                ['Agregar plantilla al periodo', url('/agregar_profesor/ingles_periodo/')],
                ['Armar horarios', url('/ingles_horarios/agregar')],
                ['Horarios de los Facilitadores', url('/ingles/mostrar_horarios_profesores')],
                ['Horarios por grupo', url('/ingles/mostrar_horario_profesor_grupo/')],
            ]];
            $accesos[] = ['titulo' => 'Calificaciones', 'enlaces' => [
                ['Calificaciones', url('/ingles/profesores/calificaciones')],
                ['Boleta de Calificaciones', url('/ingles/ver_cal_coordinador_ingles/')],
                ['Certificado de Acreditacion', url('/titulacion/ingles_carreras/')],
                ['Historial de Calificaciones', url('/ingles/historial_academico_alumno/')],
            ]];
            $accesos[] = ['titulo' => 'Validación de Vouchers', 'enlaces' => [
                ['Vouchers En Espera de validación', url('/ingles/vouchers_validacion')],
                ['Vouchers Aceptados', url('/ingles/vouchers_aceptados')],
                ['Vouchers Rechazados', url('/ingles/vouchers_rechazados')],
                ['Maximo de Estudiantes por Periodo', url('/ingles/maximo_grupo_alumnos')],
                ['Examen Ubicacion', '/ingles/control-escolar'],
            ]];
            $accesos[] = ['titulo' => 'Desactivar grupos', 'enlaces' => [
                ['Desactivacion de grupos', url('/ingles/desactivar_grupos/')],
            ]];
            $accesos[] = ['titulo' => 'Desempeño Academico', 'enlaces' => [
                ['Programas Academicos', url('/ingles/desempeno_academico/niveles')],
                ['Estadisticas Trimestrales', url('/ingles/desempeno_academico/estadisticas_generales')],
                ['Estadísticas Generales', url('/ingles_estadistica/estadisticas_genero/')],
            ]];
        }
        if ($palumno == true) {
            $accesos[] = ['titulo' => 'Carga academica de ingles', 'enlaces' => [
                ['Cargar voucher de pago', url('/ingles_horarios/cargar_voucher_pago')],
                ['Registrar carga academica de ingles', url('/ingles_horarios/iniciar_carga_academica/')],
                ['Ver carga academica de ingles', url('/ingles_horarios/revision_carga_academica/')],
                ['Ver calificaciones de ingles', url('/ingles/ver_cal_alumno_ingles/')],
            ]];
        }
    ?>
    <div class="tw:grid tw:grid-cols-12 tw:gap-4 tw:md:gap-6">

        {{-- Bienvenida: el "!!!!!Bienvenido(a)!!!!!" de antes, con nombre y periodo de inglés de la sesión --}}
        <div class="tw:col-span-12" data-panel-bienvenida>
            <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:md:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3">
                <p class="tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">Bienvenido(a)</p>
                @if($profesor_ingles==true)
                    <h2 class="tw:mt-1 tw:text-xl tw:font-semibold tw:text-gray-800 tw:md:text-2xl tw:dark:text-white/90">{{ Session::get('nombre_ingles') }}</h2>
                @elseif($palumno==true || $unidad == 19)
                    <h2 class="tw:mt-1 tw:text-xl tw:font-semibold tw:text-gray-800 tw:md:text-2xl tw:dark:text-white/90">{{ $nombre }}</h2>
                @endif
                <p class="tw:mt-3 tw:inline-flex tw:items-center tw:gap-2 tw:rounded-full tw:bg-emerald-50 tw:px-3 tw:py-1 tw:text-sm tw:font-medium tw:text-emerald-700 tw:dark:bg-emerald-500/15 tw:dark:text-emerald-400" data-panel-periodo-texto>
                    @include('panel.dashboard.iconos.grupos')
                    Periodo de Inglés: {{ $nombre_periodo }}
                </p>
            </div>
        </div>

        {{-- Aviso general: mensaje global de la sesión (como /inicio) --}}
        <div class="tw:col-span-12 tw:flex tw:flex-col tw:gap-4" data-panel-avisos>
            <div class="tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white tw:p-4 tw:dark:border-gray-800 tw:dark:bg-white/3" data-panel-aviso="men">
                <p class="tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">{{$men}} </p>
            </div>
        </div>

        {{-- Métricas del profesor de inglés (solo lectura) --}}
        @if($esProfesorIngles ?? false)
            @if($tableroIngles === null)
                <div class="tw:col-span-12" data-panel-dashboard="ingles">
                    <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:md:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3">
                        @include('panel.dashboard.sin_datos', ['detalle' => 'No fue posible obtener los datos de tus grupos del periodo de inglés.'])
                    </div>
                </div>
            @else
                <div class="tw:col-span-12" data-panel-dashboard="ingles">
                    <div class="tw:grid tw:grid-cols-1 tw:gap-4 tw:sm:grid-cols-2 tw:xl:grid-cols-4 tw:md:gap-6">
                        @foreach([
                            ['clave' => 'mis_grupos', 'etiqueta' => 'Mis grupos del periodo', 'icono' => 'grupos'],
                            ['clave' => 'alumnos_inscritos', 'etiqueta' => 'Alumnos inscritos en mis grupos', 'icono' => 'estudiantes'],
                            ['clave' => 'por_capturar', 'etiqueta' => 'Evaluaciones por capturar', 'icono' => 'capturar'],
                            ['clave' => 'sin_fecha', 'etiqueta' => 'Evaluaciones sin fecha registrada', 'icono' => 'calendario'],
                        ] as $m)
                            <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:md:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3" data-panel-metrica="{{ $m['clave'] }}">
                                <div class="tw:flex tw:h-12 tw:w-12 tw:items-center tw:justify-center tw:rounded-xl tw:bg-gray-100 tw:text-gray-800 tw:dark:bg-gray-800 tw:dark:text-white/90 tw:[&>svg]:size-6">
                                    @include('panel.dashboard.iconos.' . $m['icono'])
                                </div>
                                <span class="tw:mt-5 tw:block tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $m['etiqueta'] }}</span>
                                <h4 class="tw:mt-2 tw:text-title-sm tw:font-bold tw:text-gray-800 tw:dark:text-white/90" data-panel-valor>{{ number_format($tableroIngles[$m['clave']]) }}</h4>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- M5: Mis grupos --}}
                <div class="tw:col-span-12" data-panel-bloque="mis-grupos">
                    <div class="tw:overflow-hidden tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:px-4 tw:pt-4 tw:pb-3 tw:sm:px-6 tw:dark:border-gray-800 tw:dark:bg-white/3">
                        <div class="tw:mb-4 tw:flex tw:flex-col tw:gap-2 tw:sm:flex-row tw:sm:items-center tw:sm:justify-between">
                            <div>
                                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Mis grupos</h3>
                                <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $nombre_periodo }}</p>
                            </div>
                            <a href="{{url('/ingles/Calificaciones')}}" class="tw:inline-flex tw:items-center tw:justify-center tw:gap-2 tw:rounded-[10px] tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:font-medium tw:text-gray-700 tw:shadow-theme-xs tw:transition-all tw:hover:bg-gray-50 tw:hover:text-gray-800 tw:dark:border-gray-700 tw:dark:bg-gray-800 tw:dark:text-gray-400">Ir a Calificaciones</a>
                        </div>
                        @if(count($tableroIngles['grupos']) > 0)
                            <div class="tw:max-w-full tw:overflow-x-auto">
                                <table class="tw:min-w-full">
                                    <thead class="tw:border-y tw:border-gray-100 tw:dark:border-gray-800">
                                        <tr>
                                            @foreach(['Nivel', 'Grupo', 'Inscritos', 'Evaluaciones capturadas', 'Por capturar', 'Sin fecha', ''] as $columna)
                                                <th class="tw:py-3 tw:pe-4 tw:text-start tw:text-xs tw:font-medium tw:text-gray-500 tw:dark:text-gray-400">{{ $columna }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="tw:divide-y tw:divide-gray-100 tw:dark:divide-gray-800">
                                        @foreach($tableroIngles['grupos'] as $g)
                                            <tr data-panel-fila>
                                                <td class="tw:py-3 tw:pe-4 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{ $g['nivel'] }}</td>
                                                <td class="tw:py-3 tw:pe-4 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $g['grupo'] }}</td>
                                                <td class="tw:py-3 tw:pe-4 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $g['inscritos'] }}</td>
                                                <td class="tw:py-3 tw:pe-4 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $g['capturadas'] }} de 2</td>
                                                <td class="tw:py-3 tw:pe-4 tw:text-sm">
                                                    <span class="tw:inline-flex tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium {{ $g['por_capturar'] > 0 ? 'tw:bg-amber-50 tw:text-amber-600 tw:dark:bg-amber-500/15 tw:dark:text-orange-400' : 'tw:bg-gray-100 tw:text-gray-500 tw:dark:bg-white/5 tw:dark:text-gray-400' }}">{{ $g['por_capturar'] }}</span>
                                                </td>
                                                <td class="tw:py-3 tw:pe-4 tw:text-sm">
                                                    <span class="tw:inline-flex tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium {{ $g['sin_fecha'] > 0 ? 'tw:bg-red-50 tw:text-red-600 tw:dark:bg-red-500/15 tw:dark:text-red-500' : 'tw:bg-gray-100 tw:text-gray-500 tw:dark:bg-white/5 tw:dark:text-gray-400' }}">{{ $g['sin_fecha'] }}</span>
                                                </td>
                                                <td class="tw:py-3 tw:text-end tw:text-sm">
                                                    <a href="/ingles/Calificaciones/periodos_ingles/{{ $g['id_nivel'] }}/{{ $g['id_grupo'] }}" class="tw:font-medium tw:text-brand-500 tw:hover:text-brand-600">Periodos</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="tw:pb-3">
                                @include('panel.dashboard.sin_datos', ['detalle' => 'No se le han asignado grupos en este periodo'])
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @endif

        {{-- Accesos: opciones del menú de inglés del rol (mismas condiciones y href) --}}
        @if(count($accesos) > 0)
            <div class="tw:col-span-12" data-panel-accesos>
                <h3 class="tw:mb-3 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Accesos</h3>
                <div class="tw:grid tw:grid-cols-1 tw:gap-4 tw:sm:grid-cols-2 tw:xl:grid-cols-3">
                    @foreach($accesos as $grupo)
                        <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:dark:border-gray-800 tw:dark:bg-white/3">
                            <p class="tw:mb-3 tw:text-sm tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $grupo['titulo'] }}</p>
                            <ul class="tw:flex tw:flex-col tw:gap-1">
                                @foreach($grupo['enlaces'] as [$texto, $href])
                                    <li><a href="{{ $href }}" class="tw:flex tw:items-center tw:justify-between tw:rounded-lg tw:px-3 tw:py-2 tw:text-sm tw:text-gray-700 tw:hover:bg-gray-100 tw:dark:text-gray-300 tw:dark:hover:bg-white/5">{{ $texto }}<span aria-hidden="true" class="tw:text-gray-400">›</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
