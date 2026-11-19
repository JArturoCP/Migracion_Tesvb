{{--
    Inicio del módulo de inglés (/ingles, In_inicioController@index, sin datos del controlador).
    Lo ven el profesor de inglés (M252), el alumno (M227) y la coordinación de inglés / unidad 19 (M026).

    Diseño del panel (layouts.panel):
      - Bienvenida: el "Bienvenido(a)" de antes, con el nombre y el periodo de inglés de la sesión
        (los mismos datos que mostraban las insignias del menú de inglés).
      - Aviso: el mensaje global "men" de la sesión, como en /inicio.
      - Profesor de inglés: el dashboard de /inicio (mismos parciales panel.dashboard.*) con sus datos de
        inglés (App\Services\Panel\DatosIngles vía App\View\Composers\InglesInicioComposer: $tablero, $perfilTablero).
      - Alumno y unidad 19: accesos con las opciones del menú de inglés de su rol, con las mismas condiciones
        y href que ingles/inicio_ingles/menu_ingles (y que el submenú "Inglés" del sidebar).
--}}
@extends('layouts.panel')
@section('title', 'Ingles')
@section('sin_pie', '1')
@section('modo_oscuro', '1')
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

        {{-- Bienvenida (mismo parcial que /inicio): el "!!!!!Bienvenido(a)!!!!!" de antes, con el nombre de las
             insignias del menú de inglés (nombre_ingles del profesor; nombre del alumno y de la unidad 19) --}}
        @include('panel.dashboard.bienvenida', [
            'nombre' => $profesor_ingles == true ? Session::get('nombre_ingles') : (($palumno == true || $unidad == 19) ? $nombre : null),
            'periodo' => 'Periodo de Inglés: ' . $nombre_periodo,
        ])

        {{-- Avisos generales: mensaje global de la sesión (como /inicio) --}}
        <div class="tw:col-span-12 tw:flex tw:flex-col tw:gap-4" data-panel-avisos>
            <div class="tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white tw:p-4 tw:dark:border-gray-800 tw:dark:bg-white/3" data-panel-aviso="men">
                <p class="tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">{{$men}} </p>
            </div>
        </div>

        {{-- Dashboard del perfil (como /inicio): datos de App\Services\Panel\DatosIngles vía App\View\Composers\InglesInicioComposer --}}
        @if($perfilTablero)
            @include('panel.dashboard.' . $perfilTablero)
        @endif

        {{-- Accesos: opciones del menú de inglés del rol (mismas condiciones y href) --}}
        @if(count($accesos) > 0 && ! $perfilTablero)
            <div class="tw:col-span-12" data-panel-accesos>
                <h3 class="tw:mb-3 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Accesos</h3>
                <div class="tw:grid tw:grid-cols-1 tw:gap-4 tw:sm:grid-cols-2 tw:xl:grid-cols-3">
                    @foreach($accesos as $grupo)
                        <x-panel.tarjeta :titulo="$grupo['titulo']">
                            <ul class="tw:flex tw:flex-col tw:gap-1">
                                @foreach($grupo['enlaces'] as [$texto, $href])
                                    <li><a href="{{ $href }}" class="tw:flex tw:items-center tw:justify-between tw:rounded-lg tw:px-3 tw:py-2 tw:text-sm tw:text-gray-700 tw:hover:bg-gray-100 tw:dark:text-gray-300 tw:dark:hover:bg-white/5">{{ $texto }}<span aria-hidden="true" class="tw:text-gray-400 tw:dark:text-gray-500">›</span></a></li>
                                @endforeach
                            </ul>
                        </x-panel.tarjeta>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
