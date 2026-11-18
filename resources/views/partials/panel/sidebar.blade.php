{{--
    Sidebar del nuevo diseño (TailAdmin) para /inicio.

    ES UNA COPIA DE partials/menu_admin.blade.php. Se conservan literalmente:
    las mismas condiciones @if, las mismas consultas (en el mismo lugar), las mismas variables,
    el mismo efecto en la sesión (bloque del docente con actividad) y los mismos enlaces.
    Solo cambian el HTML y las clases (Bootstrap 3 → TailAdmin) y los acentos de las etiquetas.

    MANTENIMIENTO DOBLE: cualquier cambio en menu_admin.blade.php debe repetirse aquí
    (ver docs/panel.md) y verificarse con: php artisan test --filter=ComparacionEnlaces
    Cada bloque indica entre corchetes las líneas de origen en menu_admin.blade.php.
--}}
<a class="sr-only" href="#main-content">Saltar al contenido</a>

{{-- Fondo oscuro al abrir el sidebar en móvil --}}
<div
    x-cloak
    x-show="sidebarToggle"
    class="fixed inset-0 z-99 bg-gray-900/50 backdrop-blur-xs xl:hidden"
    aria-hidden="true"
    @click="sidebarToggle = false"
    x-transition.opacity
></div>

<aside
    x-cloak
    :class="sidebarToggle ? 'translate-x-0 xl:w-22.5' : '-translate-x-full'"
    class="sidebar fixed top-0 left-0 z-9999 flex h-screen w-72.5 flex-col border-r border-gray-200 bg-white px-5 transition-all duration-300 xl:static xl:translate-x-0 dark:border-gray-800 dark:bg-black"
    @click.outside="if (window.innerWidth < 1280) sidebarToggle = false"
    aria-label="Menú lateral"
>
    @include('partials.panel.sidebar_encabezado')

    <div class="no-scrollbar flex flex-1 flex-col overflow-y-auto duration-300 ease-linear">
        <nav x-data="{ selected: $persist('').as('panel_menu_abierto') }" aria-label="Menú principal">
            <div>
                <h3 class="mb-4 text-xs leading-5 text-gray-400 uppercase">
                    <span class="menu-group-title" :class="sidebarToggle ? 'xl:hidden' : ''">MENÚ</span>
                </h3>

                <ul class="mb-6 flex flex-col gap-1" data-panel-menu>
{{-- [menu_admin L2-290] Banderas, variables y consultas: copia literal. --}}
<?php
    //   $permiso_noregis=Session::get('personal_noregis');

    //dd(session());
    $personal_noregis = session()->has('personal_noregis') ? session()->has('personal_noregis') : false;
    $palumno = session()->has('palumno') ? session()->has('palumno') : false;
    $alumno_act = session()->has('alumno_act') ? session()->has('alumno_act') : false;
    $profesor_conact = session()->has('profesor_conact') ? session()->has('profesor_conact') : false;
    $profesor_sinact = session()->has('profesor_sinact') ? session()->has('profesor_sinact') : false;
    $jefe_division = session()->has('jefe_division') ? session()->has('jefe_division') : false;
    $directivo = session()->has('directivo') ? session()->has('directivo') : false;
    $consultas = session()->has('consultas') ? session()->has('consultas') : false;
    $sin_permiso = session()->has('sin_permiso') ? session()->has('sin_permiso') : false;
    $desa = session()->has('desa') ? session()->has('desa') : false;
    $ver_eva = session()->has('ver_eva') ? session()->has('ver_eva') : false;
    $ver_carga = session()->has('ver_carga') ? session()->has('ver_carga') : false;
    $verrifica_carga = session()->has('verrifica_carga') ? session()->has('verrifica_carga') : false;
    $escolar = session()->has('escolar') ? session()->has('escolar') : false;
    $jefe_personal = session()->has('personal') ? session()->has('personal') : false;
    $id_unidad_admin = session()->has('id_unidad_admin') ? session()->has('id_unidad_admin') : false;
    $jefe_computo = session()->has('computo') ? session()->has('computo') : false;
    $jefe_residencia = session()->has('residencia') ? session()->has('residencia') : false;
    $profesor_ingles = session()->has('profesor_ingles') ? session()->has('profesor_ingles') : false;
    $personal_academia = session()->has('personal_academia') ? session()->has('personal_academia') : false;
    $revisor = session()->has('revisor') ? session()->has('revisor') : false;
    $seguimiento_alumno = session()->has('seguimiento_alumno') ? session()->has('seguimiento_alumno') : false;
    $seguimiento_asesor = session()->has('seguimiento_asesor') ? session()->has('seguimiento_asesor') : false;
    $departamento_titulacion = session()->has('titulacion') ? session()->has('titulacion') : false;
    $direccion_finanzas = session()->has('finanzas') ? session()->has('finanzas') : false;
    $equipo_auditor = session()->has('isAuditor') ? true : false; //variable para identificar a los auditores con la sesion
    //$id_carrera = session()->has('id_carrera') ? true : false;
    //dd($id_carrera);

    /*
    |--------------------------------------------------------------------------
    | Acceso a canalización por reprobación desde el menú principal
    |--------------------------------------------------------------------------
    | No depende del módulo de Tutorías. El botón aparece cuando el usuario
    | autenticado tiene relación lógica con gnral_personales y una asignación
    | activa como tutor EN EL PERIODO VIGENTE SEGÚN LA FECHA DEL SISTEMA.
    */
    $es_tutor_reprobacion_menu = false;
    $id_personal_reprobacion_menu = null;

    if (!\Illuminate\Support\Facades\Auth::guest()) {
        $usuario_reprobacion_menu = \Illuminate\Support\Facades\Auth::user();
        $id_usuario_reprobacion_menu = $usuario_reprobacion_menu ? $usuario_reprobacion_menu->id : null;
        $correo_reprobacion_menu = ($usuario_reprobacion_menu && isset($usuario_reprobacion_menu->email))
            ? trim(strtolower($usuario_reprobacion_menu->email))
            : '';

        $id_sesion_reprobacion_menu = Session::get('id_perso');

        if ($id_sesion_reprobacion_menu) {
            $personal_reprobacion_menu = \Illuminate\Support\Facades\DB::table('gnral_personales')
                ->where('id_personal', $id_sesion_reprobacion_menu)
                ->first();
        } else {
            $personal_reprobacion_menu = \Illuminate\Support\Facades\DB::table('gnral_personales')
                ->where(function ($q) use ($id_usuario_reprobacion_menu, $correo_reprobacion_menu) {
                    if ($id_usuario_reprobacion_menu) {
                        $q->where('tipo_usuario', $id_usuario_reprobacion_menu);
                    }

                    if ($correo_reprobacion_menu != '') {
                        $q->orWhereRaw('LOWER(TRIM(correo)) = ?', [$correo_reprobacion_menu]);
                    }
                })
                ->first();
        }

        if ($personal_reprobacion_menu) {
            $id_personal_reprobacion_menu = $personal_reprobacion_menu->id_personal;
            $fecha_actual_reprobacion_menu = \Carbon\Carbon::today(config('app.timezone'))->toDateString();

            $periodo_vigente_reprobacion_menu = \Illuminate\Support\Facades\DB::table('gnral_periodos')
                ->whereDate('fecha_inicio', '<=', $fecha_actual_reprobacion_menu)
                ->whereDate('fecha_termino', '>=', $fecha_actual_reprobacion_menu)
                ->orderBy('fecha_inicio', 'desc')
                ->orderBy('id_periodo', 'desc')
                ->first();

            if ($periodo_vigente_reprobacion_menu) {
                $es_tutor_reprobacion_menu = \Illuminate\Support\Facades\DB::table('exp_asigna_tutor as et')
                    ->join('exp_asigna_generacion as eg', 'eg.id_asigna_generacion', '=', 'et.id_asigna_generacion')
                    ->join('gnral_jefes_periodos as jp', 'jp.id_jefe_periodo', '=', 'eg.id_jefe_periodo')
                    ->where('et.id_personal', $id_personal_reprobacion_menu)
                    ->where('jp.id_periodo', $periodo_vigente_reprobacion_menu->id_periodo)
                    ->whereNull('et.deleted_at')
                    ->whereNull('eg.deleted_at')
                    ->exists();
            }
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Acceso a PIASE para responsables de área
    |--------------------------------------------------------------------------
    */
    $es_responsable_area_atencion_menu = false;

    try {
        if (!\Illuminate\Support\Facades\Auth::guest()) {
            $usuario_area_menu = \Illuminate\Support\Facades\Auth::user();
            $id_usuario_area_menu = $usuario_area_menu ? $usuario_area_menu->id : null;
            $correo_area_menu = ($usuario_area_menu && isset($usuario_area_menu->email))
                ? trim(strtolower($usuario_area_menu->email))
                : '';

            $id_sesion_area_menu = Session::get('id_perso');

            if ($id_sesion_area_menu) {
                $personal_area_menu = \Illuminate\Support\Facades\DB::table('gnral_personales')
                    ->where('id_personal', $id_sesion_area_menu)
                    ->first();
            } else {
                $personal_area_menu = \Illuminate\Support\Facades\DB::table('gnral_personales')
                    ->where(function ($q) use ($id_usuario_area_menu, $correo_area_menu) {
                        if ($id_usuario_area_menu) {
                            $q->where('tipo_usuario', $id_usuario_area_menu);
                        }

                        if ($correo_area_menu != '') {
                            $q->orWhereRaw('LOWER(TRIM(correo)) = ?', [$correo_area_menu]);
                        }
                    })
                    ->first();
            }

            if ($personal_area_menu) {
                $es_responsable_area_atencion_menu = \Illuminate\Support\Facades\DB::table('ar_area_responsables_periodo as arp')
                    ->join('ar_areas_atencion as aa', 'aa.id_area_atencion', '=', 'arp.id_area_atencion')
                    ->where('arp.id_personal', $personal_area_menu->id_personal)
                    ->where('arp.activo', 1)
                    ->where('aa.activo', 1)
                    ->exists();
            }
        }
    } catch (\Exception $e) {
        $es_responsable_area_atencion_menu = false;
    }



    /*
    |--------------------------------------------------------------------------
    | Acceso PIASE para estudiante
    |--------------------------------------------------------------------------
    | El estudiante ve el menú PIASE solo si tiene al menos una canalización
    | registrada en las tablas ar_*.
    */
    $es_alumno_piase_menu = false;

    try {
        if (!\Illuminate\Support\Facades\Auth::guest()) {
            $usuario_alumno_piase = \Illuminate\Support\Facades\Auth::user();
            $id_usuario_alumno_piase = $usuario_alumno_piase ? $usuario_alumno_piase->id : null;

            if ($id_usuario_alumno_piase) {
                $alumno_piase_menu = \Illuminate\Support\Facades\DB::table('gnral_alumnos')
                    ->where('id_usuario', $id_usuario_alumno_piase)
                    ->first();

                if ($alumno_piase_menu) {
                    $es_alumno_piase_menu = \Illuminate\Support\Facades\DB::table('ar_casos_estudiantes as ce')
                        ->join('ar_caso_canalizaciones as cc', 'cc.id_ar_caso', '=', 'ce.id_ar_caso')
                        ->where('ce.id_alumno', $alumno_piase_menu->id_alumno)
                        ->exists();
                }
            }
        }
    } catch (\Exception $e) {
        $es_alumno_piase_menu = false;
    }


    /*
    |--------------------------------------------------------------------------
    | Permisos específicos del menú SGOE
    |--------------------------------------------------------------------------
    | - Auditor líder (categoría 1): Auditorías y catálogos, Asignar líder y
    |   consulta completa de Seguimiento de auditorías.
    | - Auditor: únicamente Programa de auditorías dentro del submenú Auditorías.
    | - Líder de acciones: Ver Acciones.
    | - Responsable de seguimiento: únicamente las notas reasignadas.
    | - Auditor responsable: sus propias notas mientras no tengan una
    |   reasignación específica. El alcance se refuerza en el controlador.
    */
    $puede_ver_seguimiento_auditorias_menu = false;
    $es_auditor_lider_sgoe_menu = false;
    $es_auditor_responsable_sgoe_menu = false;
    $es_lider_acciones_sgoe_menu = false;
    $tiene_seguimiento_asignado_menu = false;

    try {
        /*
         * Se consideran todas las relaciones válidas del usuario autenticado.
         * En algunos perfiles id_perso existe, pero no coincide con el
         * id_personal usado al guardar la asignación de seguimiento.
         */
        $ids_personal_seguimiento_menu = collect();
        $id_personal_sesion_menu = Session::get('id_perso');

        if (is_numeric($id_personal_sesion_menu) && (int) $id_personal_sesion_menu > 0) {
            $ids_personal_seguimiento_menu->push((int) $id_personal_sesion_menu);
        }

        if (!\Illuminate\Support\Facades\Auth::guest()) {
            $usuario_seguimiento_menu = \Illuminate\Support\Facades\Auth::user();
            $id_usuario_seguimiento_menu = ($usuario_seguimiento_menu && isset($usuario_seguimiento_menu->id))
                ? $usuario_seguimiento_menu->id
                : null;
            $correo_seguimiento_menu = ($usuario_seguimiento_menu && isset($usuario_seguimiento_menu->email))
                ? trim(strtolower($usuario_seguimiento_menu->email))
                : '';

            if ($usuario_seguimiento_menu && isset($usuario_seguimiento_menu->id_personal)
                && is_numeric($usuario_seguimiento_menu->id_personal)) {
                $ids_personal_seguimiento_menu->push((int) $usuario_seguimiento_menu->id_personal);
            }

            if ($id_usuario_seguimiento_menu || $correo_seguimiento_menu !== '') {
                $ids_personal_bd_menu = \Illuminate\Support\Facades\DB::table('gnral_personales')
                    ->where(function ($q) use ($id_usuario_seguimiento_menu, $correo_seguimiento_menu) {
                        if ($id_usuario_seguimiento_menu) {
                            $q->where('tipo_usuario', $id_usuario_seguimiento_menu);
                        }

                        if ($correo_seguimiento_menu !== '') {
                            $q->orWhereRaw('LOWER(TRIM(correo)) = ?', [$correo_seguimiento_menu]);
                        }
                    })
                    ->pluck('id_personal');

                foreach ($ids_personal_bd_menu as $id_personal_bd_menu) {
                    if (is_numeric($id_personal_bd_menu)) {
                        $ids_personal_seguimiento_menu->push((int) $id_personal_bd_menu);
                    }
                }
            }
        }

        $ids_personal_seguimiento_menu = $ids_personal_seguimiento_menu
            ->filter(function ($id) {
                return is_numeric($id) && (int) $id > 0;
            })
            ->map(function ($id) {
                return (int) $id;
            })
            ->unique()
            ->values();

        if ($ids_personal_seguimiento_menu->isNotEmpty()) {
            $es_auditor_lider_sgoe_menu = \App\AudAuditores::whereIn('id_personal', $ids_personal_seguimiento_menu->all())
                ->where('id_categoria', 1)
                ->exists();

            $es_auditor_responsable_sgoe_menu = \App\AudAuditores::whereIn(
                'id_personal',
                $ids_personal_seguimiento_menu->all()
            )->exists();

            $es_lider_acciones_sgoe_menu = \Illuminate\Support\Facades\DB::table('aud_lider_acciones')
                ->whereIn('id_personal', $ids_personal_seguimiento_menu->all())
                ->whereNull('deleted_at')
                ->exists();

            $tiene_seguimiento_asignado_menu = \Illuminate\Support\Facades\DB::table('aud_seguimiento_auditorias')
                ->whereIn('id_personal_seguimiento', $ids_personal_seguimiento_menu->all())
                ->where('activo', 1)
                ->whereNull('deleted_at')
                ->exists();

            $puede_ver_seguimiento_auditorias_menu = $es_auditor_lider_sgoe_menu
                || $tiene_seguimiento_asignado_menu
                || $es_auditor_responsable_sgoe_menu;
        }
    } catch (\Exception $e) {
        $puede_ver_seguimiento_auditorias_menu = false;
        $es_auditor_lider_sgoe_menu = false;
        $es_auditor_responsable_sgoe_menu = false;
        $es_lider_acciones_sgoe_menu = false;
        $tiene_seguimiento_asignado_menu = false;
    }

    ?>


{{-- [menu_admin L295-336] Variable $unidad (copia literal). Los badges de oficios que contenía este bloque están comentados en el original y no se muestran. --}}
            <?php
                $unidad = Session::get('id_unidad_admin');


                ?>
            @if($id_unidad_admin == true)
            {{-- Solicitud de oficios: comentado en el original (L301-304). --}}
            @if($unidad==26)
            {{-- Validación de oficios: comentado en el original (L309-314). --}}
            @endif
            @if($unidad==23)
            {{-- Validación de oficios del personal: comentado en el original (L324-329). --}}
            @endif
            @endif

{{-- [menu_admin L340-347] Variables (copia literal). La insignia "nombre · periodo" (L348-369) se muestra en el menú de usuario del header (partials/panel/usuario.blade.php), con la misma lógica. --}}
            <?php
                $nombre = Session::get('nombre');
                $cambio_c = Session::get('cambio_carreras');
                $carreras = Session::get('carreras');
                $usuario = Session::get('usuario_alumno');
                //$periodos = DB::selectOne('SELECT periodo FROM gnral_periodos WHERE estado != 0');
                $nperiodo = Session::get('nombre_periodo');
                ?>

{{-- [menu_admin L348-370] Asignaciones de la insignia (copia literal): $nombre_carrera, $id_carrera, $nombre_ingles
     y $nombre_periodo_ingles se usan más abajo (p. ej. el bloque del jefe de división usa $id_carrera).
     El texto de la insignia se muestra en el menú de usuario del header. --}}
            @if($jefe_division==true || $consultas==true)
            <?php
                        $nombre_carrera = Session::get('nombre_carrera');
                        $id_carrera = Session::get('id_carrera');
                        ?>
            @else

            @if($profesor_ingles==true)
            <?php
                            $nombre_ingles = Session::get('nombre_ingles');
                            $nombre_periodo_ingles = Session::get('nombre_periodo_ingles');
                            ?>

            @else
            @endif
            @endif

{{-- [menu_admin L396-409] Cambio de periodo (misma condición). Abre el modal de periodos. --}}
                    @if($profesor_conact==true || $jefe_division==true || $directivo==true ||$desa==true ||
                    $profesor_sinact==true || $departamento_titulacion == true)
                        <li>
                            @include('partials.panel.periodo_boton')
                        </li>
                    @endif

{{-- [menu_admin L410-428] Cambio de carrera (misma condición y mismos enlaces). --}}
                    @if($cambio_c==1)
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'carrera' ? '' : 'carrera')" class="group menu-item" :class="selected === 'carrera' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.elementos', ['clave' => 'carrera'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Cambio de carrera</span>
@include('partials.panel.iconos.flecha', ['clave' => 'carrera'])
                            </a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'carrera'" x-collapse>
                                <ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                @foreach($carreras as $carrera)
                                <li>
                                    <a href="/recarga_personal/{{ $carrera->id_carrera }}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>{{ $carrera->nombre }}</a>
                                </li>
                                @endforeach
                                </ul>
                            </div>
                        </li>
                    @endif

{{-- [menu_admin L429-442] Salir: mismo POST /logout con CSRF. --}}
                        <li>
                            <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.candado')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Salir</span>
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>

{{-- [menu_admin L443-2502] Módulos: mismas condiciones y enlaces, con marcado de TailAdmin. --}}

                    <!--MENU PROFESOR CON ACT-->
                    @if($profesor_conact==true)
                    <?php
                                $id_perso = Session::get('id_perso');
                                $carrera = DB::table('gnral_horarios')
                                    ->join('gnral_periodo_carreras', 'gnral_horarios.id_periodo_carrera', '=', 'gnral_periodo_carreras.id_periodo_carrera')
                                    ->join('gnral_carreras', 'gnral_periodo_carreras.id_carrera', '=', 'gnral_carreras.id_carrera')
                                    ->where('gnral_horarios.id_personal', $id_perso)
                                    ->where('gnral_carreras.siglas', 'I.S.C.') // prioriza Sistemas
                                    ->select('gnral_carreras.id_carrera', 'gnral_carreras.nombre', 'gnral_carreras.siglas')
                                    ->first();

                                if ($carrera) {
                                    Session::put('id_carrera', $carrera->id_carrera);
                                }

                                $id_carrera = Session::get('id_carrera');
                                //dd($id_carrera);

                                ?>
                    
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm1' ? '' : 'm1')" class="group menu-item" :class="selected === 'm1' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.graficas', ['clave' => 'm1'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Complementarias</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm1'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm1'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/planeacion_actividad')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Planeación de Actividades</a>
                                </li>
                                <li><a href="{{url('/consulta_general')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Evaluación</a></li>
                            </ul>
</div>
                        </li>

                        <li><a href="{{url('/docentes/modificar/')}}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.usuario')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Datos P.</span>
</a></li>

                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm2' ? '' : 'm2')" class="group menu-item" :class="selected === 'm2' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.grupo', ['clave' => 'm2'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Duales</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm2'])
</a>
                                <div x-cloak x-show="$store.buscador.activo || selected === 'm2'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="{{url('/duales/mentor_calificar')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Calificar Alumnos Duales</a></li>
                                </ul>
</div>

                        </li>
                    
                    @if($id_carrera == 2)
                    
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm3' ? '' : 'm3')" class="group menu-item" :class="selected === 'm3' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.formularios', ['clave' => 'm3'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Solicitudes</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm3'])
</a>
                                <div x-cloak x-show="$store.buscador.activo || selected === 'm3'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="{{route('materialDocente')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Material</a></li>
                                </ul>
</div>

                        </li>
                    
                    @endif
                    @if($id_unidad_admin != true)
                    
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm4' ? '' : 'm4')" class="group menu-item" :class="selected === 'm4' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.graficas', ['clave' => 'm4'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Evaluación Docente</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm4'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm4'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="/reportes2/{{$id_perso}}/{{1}}/{{0}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Resultados de Evaluación</a>
                                </li>
                            </ul>
</div>
                        </li>
                    
                    @endif
                    
                        <li><a href="/docente/{{$id_perso}}/carreras" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.tablas')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Calificaciones</span>
</a></li>

                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm5' ? '' : 'm5')" class="group menu-item" :class="selected === 'm5' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.grupo', ['clave' => 'm5'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Residencia</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm5'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm5'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                @if($personal_academia==true)
                                <li><a href="{{url('/residencia/agregar_anteproyecto_asesores')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Agregar asesores</a></li>
                                @endif
                                @if($revisor==true)
                                <li><a href="{{url('/residencia/revisores_anteproyecto/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Revisar proyecto de residencia</a></li>
                                @endif
                            </ul>
</div>
                        </li>

                    @endif
                    @if($seguimiento_asesor==true)
                    
                        <li><a href="/residencia/seguimiento_asesor" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.grupo')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Seguimiento de Residencia</span>
</a></li>
                    
                    @endif

                    {{--<ul class="nav navbar-nav">
                                <li class="dropdown"><a href="{{ url('/auditorias/responsables_implementar') }}">Seguimiento
                    Implantar</a></li>
                    </ul>

                    <ul class="nav navbar-nav">
                        <li class="dropdown"><a href="{{ url('/auditorias/responsables_revisar') }}">Seguimiento
                                Revisar</a></li>
                    </ul>--}}

                    @php
                    $id_docente = Session::get('id_perso');
                    //dd($id_docente);
                    $docente = \DB::table('gnral_personales')
                    ->where('id_personal', $id_docente)
                    ->first();
                    @endphp

                    @if($docente && $docente->estado_docente_inv == 1)

                        <li>
                            <a href="{{ route('examen_conocimientos') }}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.graficas')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Examen Conocimientos Gral.</span>
</a>
                        </li>

                    @endif

                    <!--MENU DESARROLLO-->
                    <!--MENU PROFESOR SIN ACT-->
                    @if($profesor_sinact==true ||$desa==true)
                    <?php
                                $id_perso = Session::get('id_perso');
                                ?>
                    
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm6' ? '' : 'm6')" class="group menu-item" :class="selected === 'm6' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.usuario', ['clave' => 'm6'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Datos P.</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm6'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm6'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/docentes/modificar/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Editar</a></li>
                            </ul>
</div>
                        </li>
                    
                    @endif
                    @if($profesor_sinact==true)
                    @if($id_unidad_admin != true)
                    
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm7' ? '' : 'm7')" class="group menu-item" :class="selected === 'm7' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.graficas', ['clave' => 'm7'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Evaluación Docente</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm7'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm7'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="/reportes2/{{$id_perso}}/{{1}}/{{0}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Resultados de Evaluación</a>
                                </li>
                            </ul>
</div>
                        </li>
                    
                    @endif
                    @if($id_unidad_admin != true)
                    
                        <li><a href="/docente/{{$id_perso}}/carreras" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.tablas')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Calificaciones</span>
</a></li>
                    
                    @endif
                    @if($id_unidad_admin != true)
                    
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm8' ? '' : 'm8')" class="group menu-item" :class="selected === 'm8' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.grupo', ['clave' => 'm8'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Residencia</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm8'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm8'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                @if($personal_academia==true)
                                <li><a href="{{url('/residencia/agregar_anteproyecto_asesores')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Agregar asesores</a>
                                </li>
                                @endif
                                @if($revisor==true)
                                <li><a href="{{url('/residencia/revisores_anteproyecto/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Revisar proyecto de residencia</a></li>
                                @endif
                            </ul>
</div>
                        </li>
                    
                    @endif
                    @if($seguimiento_asesor==true)
                    
                        <li><a href="/residencia/seguimiento_asesor" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.grupo')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Seguimiento de Residencia</span>
</a></li>
                    
                    @endif
                    @endif
                    <?php $tipo_p = Session::get('tipo_persona'); ?>
                    @if($tipo_p== 2)
                    @if($id_unidad_admin != true)
                    
                        <li><a href="{{url('tutorias/')}}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.usuario')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Tutorías</span>
</a></li>
                    
                    @else
                    @if($desa==true || $jefe_division == true )
                    
                        <li><a href="{{url('tutorias/')}}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.usuario')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Tutorías</span>
</a></li>
                    
                    @endif
                    @endif
                    @endif

                    @if($es_tutor_reprobacion_menu == true || $desa == true || $es_responsable_area_atencion_menu ==
                    true || $es_alumno_piase_menu == true)
                    
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm9' ? '' : 'm9')" class="group menu-item" :class="selected === 'm9' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.grupo', ['clave' => 'm9'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">PIASE</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm9'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm9'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                @if($es_tutor_reprobacion_menu == true)
                                <li>
                                    <a href="{{ url('/canalizacion-reprobacion-principal') }}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Canalizar por reprobación</a>
                                </li>
                                @endif
                                @if($es_responsable_area_atencion_menu == true)
                                <li>
                                    <a href="{{ route('areas_atencion.mis_casos.index') }}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Atención y seguimiento</a>
                                </li>
                                @endif
                                @if($es_alumno_piase_menu == true)
                                <li>
                                    <a href="{{ route('piase.estudiante.index') }}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Mis citas y actividades</a>
                                </li>
                                @endif
                                @if($desa==true)
                                <li>
                                    <a href="{{ route('desarrollo_academico.areas_atencion.index') }}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Configurar áreas y horarios</a>
                                </li>
                                @endif
                            </ul>
</div>
                        </li>
                    
                    @endif
                    @if($id_unidad_admin ==true)
                    @if($unidad==19)
                    
                        <li>
                        <li><a href="{{url('/ingles/')}}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.paginas')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Inglés</span>
</a></li>
                        </li>

                    @endif
                    @endif
                    <!-- MENU JEFE de computo-->
                    @if($jefe_computo==true)

                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm10' ? '' : 'm10')" class="group menu-item" :class="selected === 'm10' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.usuario', ['clave' => 'm10'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Datos P.</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm10'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm10'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/docentes/modificar/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Editar</a></li>
                            </ul>
</div>
                        </li>

                        <li>
                        <li><a href="{{url('/laboratorios/laboratorios/')}}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.elementos')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Laboratorios</span>
</a></li>
                        </li>

                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm11' ? '' : 'm11')" class="group menu-item" :class="selected === 'm11' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.formularios', ['clave' => 'm11'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Servicios Escolares</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm11'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm11'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/computo/calificar')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Calificar</a></li>
                                <li><a href="{{url('/servicios_escolares/evaluaciones_cc_academico')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Cambio de Periodo</a></li>
                                <li><a href="{{url('/computo/ver_cal/promedios')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Promedios >= 90</a></li>
                            </ul>
</div>
                        </li>

                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm12' ? '' : 'm12')" class="group menu-item" :class="selected === 'm12' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.paginas', ['clave' => 'm12'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Envío Encuesta Sat.</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm12'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm12'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/encuestas_satisfaccion/periodo_mantenimiento/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Enviar Encuesta de Satisfacción de cliente interno</a></li>
                                <li><a href="{{url('/encuestas_satisfaccion/menu_historial_mantenimiento/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Historial Encuesta de Satisfacción de cliente</a></li>
                                {{--   <li><a href="{{url('/centro_computo/configuracion_dat/')}}">checar
                                configuracion</a>
                        </li> --}}
                    </ul>
</div>
                    </li>
                    
                    {{--
                                    <ul class="nav navbar-nav navbar-left">
                                        <li class="dropdown">
                                        <li><a href="{{url('/computo/registrar_imagen/')}}">Registrar imagen </a></li>
                    </li>
                    </ul>
                    --}}
                    
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm13' ? '' : 'm13')" class="group menu-item" :class="selected === 'm13' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.elementos', ['clave' => 'm13'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Herramientas</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm13'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm13'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/centro_computo/activar_armar_horarios/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Activar armar horarios</a></li>
                                <li><a href="{{url('/centro_computo/registro_estudiantes_correo/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Registro de usuarios en el sistema</a></li>
                                <li><a href="{{url('/centro_computo/usuario/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Permisos</a></li>
                                <li><a href="{{url('/centro_computo/ver_usuario_estudiante/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Usuarios Estudiantes</a></li>
                                <li><a href="{{url('/centro_computo/ver_usuario_personal_tesvb/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Usuarios Personal TESVB</a></li>
                                <li><a href="{{url('/centro_computo/ver_usuario_facilitadores/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Usuarios Facilitadores</a></li>
                                <li><a href="{{url('/centro_computo/informes_titulacion/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Modificar informe de titulación</a></li>

                            </ul>
</div>
                        </li>

                    @endif
                    <!-- MENU JEFE personal-->
                    @if($jefe_personal==true)

                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm14' ? '' : 'm14')" class="group menu-item" :class="selected === 'm14' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.usuario', ['clave' => 'm14'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Datos P.</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm14'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm14'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/docentes/modificar/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Editar</a></li>
                            </ul>
</div>
                        </li>

                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm15' ? '' : 'm15')" class="group menu-item" :class="selected === 'm15' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.usuario', ['clave' => 'm15'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Cargos del Personal</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm15'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm15'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/docente')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Personal del TESVB</a></li>
                                <li><a href="{{url('/generales/cargos')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Categoría Personal</a></li>
                            </ul>
</div>
                        </li>

                        <li>
                        <li><a href="{{url('/oficios/evaluacion')}}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.formularios')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Validar Oficios</span>
</a></li>
                        </li>

                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm16' ? '' : 'm16')" class="group menu-item" :class="selected === 'm16' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.tablas', ['clave' => 'm16'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Plantilla Personal</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm16'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm16'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/departamento/plantilla')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Agregar Plantilla</a></li>
                                <li><a href="{{url('/departamentoplantilla/ver')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver Plantilla</a></li>
                            </ul>
</div>
                        </li>

                    @endif
                    <!-- MENU JEFE division-->
                    @if($jefe_division==true)
                    
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm17' ? '' : 'm17')" class="group menu-item" :class="selected === 'm17' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.usuario', ['clave' => 'm17'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Datos P.</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm17'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm17'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/docentes/modificar/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Editar</a></li>
                            </ul>
</div>
                        </li>

                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm18' ? '' : 'm18')" class="group menu-item" :class="selected === 'm18' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.graficas', ['clave' => 'm18'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Complementarias</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm18'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm18'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/docente_actividad')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Asignar Docente a Actividad</a></li>
                                <li><a href="{{url('/alumnos_actividades')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Liberar Solicitud Alumnos</a></li>
                                <li><a href="{{url('/libera_planeacion')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Liberar Planeación Docente</a></li>
                                <li><a href="{{url('/constancias')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Constancia Individual</a></li>
                                <li><a href="{{url('/constancia_gen')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Constancia General</a></li>
                                {{--     <li><a href="{{url('/datos_historicos')}}">Datos Históricos</a>
                        </li> --}}
                    </ul>
</div>
                    </li>

                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm19' ? '' : 'm19')" class="group menu-item" :class="selected === 'm19' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.graficas', ['clave' => 'm19'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Evaluación</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm19'])
</a>

                            <div x-cloak x-show="$store.buscador.activo || selected === 'm19'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li>
                                    <a href="{{url('/buscar_profesores_carrera')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Profesores</a>
                                </li>
                                <!--<li>
                                        <a href="{{url('/buscar_alumnos')}}">
                                          Alumnos
                                        </a>
                                    </li>-->
                            </ul>
</div>
                        </li>

                        <!--<li class="dropdown bloqueo">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Horarios</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('/horarios/armar_horarios')}}">Armar Horarios</a></li>
                                <li><a href="{{url('/horarios/hrs_grupos/jefes')}}">Ver Horarios Grupos</a></li>
                                <li><a href="{{url('/horarios/hrs_aulas/jefes')}}">Ver Horarios Aulas</a></li>
                                <li><a href="{{url('/profesores/materias')}}">Profesores Materias</a></li>
                            </ul>
                        </li>-->

                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm20' ? '' : 'm20')" class="group menu-item" :class="selected === 'm20' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.tablas', ['clave' => 'm20'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Formatos</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm20'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm20'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/formatos/distribucion')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Distrib.de hrs. frente a grupo</a></li>
                                <li><a href="{{url('/formatos/relacion')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Relación de personal docente</a>
                                </li>
                            </ul>
</div>
                        </li>
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm21' ? '' : 'm21')" class="group menu-item" :class="selected === 'm21' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.tablas', ['clave' => 'm21'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Plantilla</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm21'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm21'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/plantilla/docentes')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Agregar Docentes</a></li>
                                <li><a href="{{url('/plantilla/ver')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver Plantilla</a></li>
                            </ul>
</div>
                        </li>
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm22' ? '' : 'm22')" class="group menu-item" :class="selected === 'm22' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.elementos', ['clave' => 'm22'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Generales</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm22'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm22'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li x-data="{ abierto: false }">
                                    <a href="#" @click.prevent="abierto = !abierto" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-modulo>
<span>Académico</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                    <div x-cloak x-show="$store.buscador.activo || abierto" x-collapse>
<ul class="mt-1 flex flex-col gap-1 border-l border-gray-200 pl-3 dark:border-gray-800">
                                        <li><a href="{{url('/reticulass')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Retículas</a></li>
                                        <li><a href="{{url('/docente')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Docentes</a></li>
                                    </ul>
</div>
                                </li>
                                <li><a href="{{url('/generales/situaciones')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Situación Profesional</a></li>
                                <li><a href="{{url('/generales/perfiles')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Perfil</a></li>
                                <li><a href="{{url('/generales/edificios')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Edificios</a></li>
                                <li><a href="{{url('/generales/aulas')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Aulas</a></li>
                            </ul>
</div>
                        </li>

                        <li>
                            <a href="{{ route('j_carrera.analisis_reprobacion.index') }}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.graficas')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Análisis de reprobación</span>
</a>
                        </li>
                        <!--<li class="dropdown bloqueo">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                Indice Reprobación 
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a
                                        href="{{ url('/servicios_escolares/estadisticas/indice_reprobacion/'.$id_carrera) }}">
                                        Indice Reprobación de los profesores por semestre
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ url('/indices_repro_prof/carrera_categoria_jefe/'.$id_carrera) }}">
                                        Indice Reprobación de los profesores por categoria
                                    </a>
                                </li>
                            </ul>
                        </li>
-->
                        <li>
                            <a href="{{ url($id_carrera.'/docentes') }}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.tablas')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Calificaciones</span>
</a>
                        </li>

                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm23' ? '' : 'm23')" class="group menu-item" :class="selected === 'm23' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.grupo', ['clave' => 'm23'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Residencia</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm23'])
</a>

                            <div x-cloak x-show="$store.buscador.activo || selected === 'm23'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li>
                                    <a href="{{ url('/residencia/asignar_revisores') }}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Asignar Revisores</a>
                                </li>

                                <li>
                                    <a href="{{ url('/residencia/asignar_academia') }}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Asignar Academia</a>
                                </li>

                                <li>
                                    <a href="{{ url('/residentes/carrera_oficio_aceptacion') }}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Oficio de aceptación</a>
                                </li>

                                <li>
                                    <a href="{{ url('/residentes/carrera') }}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Calificaciones de los residentes</a>
                                </li>
                            </ul>
</div>
                        </li>

                        @endif

                        <!--MENU DESARROLLO ACADEMICO-->
                        @if($desa==true )
                        
                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm24' ? '' : 'm24')" class="group menu-item" :class="selected === 'm24' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.graficas', ['clave' => 'm24'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Evaluación Docente</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm24'])
</a>

                                <div x-cloak x-show="$store.buscador.activo || selected === 'm24'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li>
                                        <a href="{{url('/buscar_profesores')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Profesores</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/buscar_alumnos')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Alumnos</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/comentarios_docentes')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver Comentarios</a>
                                    </li>

                                </ul>
</div>

                            </li>
                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm25' ? '' : 'm25')" class="group menu-item" :class="selected === 'm25' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.calendario', ['clave' => 'm25'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Horarios</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm25'])
</a>
                                <div x-cloak x-show="$store.buscador.activo || selected === 'm25'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="{{url('/horarios/hrs_grupos')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver Horarios Grupos</a></li>
                                    <li><a href="{{url('/horarios/hrs_aulas')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver Horarios Aulas</a></li>
                                    <li><a href="{{url('/hrs_carrera')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Horas por carrera</a></li>
                                </ul>
</div>
                            </li>
                            <li>
                                <a href="{{url('/servicios_escolares/evaluaciones_academicas')}}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.graficas')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Evaluaciones</span>
</a>
                            </li>

                            {{-- 🔥 BOTÓN NUEVO EGEL --}}
                            <li>
                                <a href="{{ route('admin.dashboard') }}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.graficas')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Administrar Examen EGEL</span>
</a>
                            </li>

                            <li>
                                <a href="{{ route('admin_examen_conocimientos') }}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.graficas')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Administrar Examen Conocimientos Gral.</span>
</a>
                            </li>

                        @endif

                        <!--CONTROL ESCOLAR-->
                        @if($escolar==true || $directivo==true)
                        
                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm26' ? '' : 'm26')" class="group menu-item" :class="selected === 'm26' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.formularios', ['clave' => 'm26'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Control Escolar</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm26'])
</a>

                                <div x-cloak x-show="$store.buscador.activo || selected === 'm26'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li>
                                        <a href="{{url('/validacion_de_carga')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Revisión de cargas</a>
                                    </li>
                                    @if($directivo==true)
                                    <li>
                                        <a href="/duales/gestion_academica" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Gestión de Académica de Alumnos Duales</a>
                                    </li>
                                    @endif
                                    <li><a href="/servicios_escolares/carreras_calificaciones" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Evaluaciones</a>
                                    </li>
                                    <li><a href="/servicios_escolares/estadisticas" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Estadísticas</a></li>
                                    <li><a href="/servicios_escolares/bitacora_periodos" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Modificaciones en periodos</a></li>
                                    <li><a href="/servicios_escolares/bitacora_evaluaciones" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Modificaciones en evaluaciones ordinarias</a></li>
                                    <li><a href="/servicios_escolares/bitacora_evaluaciones_sumativas"
                                            class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Modificaciones en evaluaciones sumativas</a></li>
                                    <li><a href="/servicios_escolares/alumnos/carrera" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Datos de los alumnos por carrera</a></li>
                                    @if($escolar==true)
                                    <li>
                                        <a href="{{url('/cct/registros/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Instituciones educativas</a>
                                        {{-- <a href="{{url('/agregar_escuelas_procedencia/')}}">Agregar escuelas de
                                        procedencias</a> --}}
                                    </li>
                                    <li>
                                        <a href="{{url('/servicios_escolares/promedio_semestre/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Promedios de los alumnos del periodo</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/servicios_escolare/concentrados_calificaciones/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Concentrado de Calificaciones</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/duales/concentrado_calificaciones_duales/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Concentrado de Calificaciones de Alumnos Duales</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/servicios_escolares/historial_academico/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Historial Académico de los estudiantes</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/servicios_escolares/bajas_temporales/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Bajas temporales de los estudiantes</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/servicios_escolares/bajas_definitivas/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Bajas definitivas de los estudiantes</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/servicios_escolares/bitacora_def_temp/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Bitácora de bajas temporales y definitivas</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/servicios_escolares/plan_estudio/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Agregar Plan de estudio</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/servicios_escolares/especialidades/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Agregar Especialidad</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/servicios_escolares/modificaciones_cargas_cademicas/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver historial de mod. cargas académicas</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/servicios_escolares/registrar_semestre_alumnos/carrera')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Registrar semestre al estudiante nuevo registro</a>
                                    </li>
                                    <li style="display: none">
                                        <a href="{{url('/servicios_escolares/carrera_estudiantes_desactivados/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver estudiantes inactivos</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/servicios_escolares/carrera_actualizar_semestre_periodo/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver periodos de actualizacion de semestre estudiantes</a>
                                    </li>
                                    <li><a href="{{url('/computo/calificar')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Calificar estudiantes (Curso intersemestral)</a></li>
                                    <li><a href="{{url('/encuestas_satisfaccion/encuesta_incripcion_periodo/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Encuestas de satisfacción al cliente (inscripción)</a></li>
                                    <li><a href="{{url('/encuestas_satisfaccion/encuesta_reincripcion_periodo')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Encuestas de satisfacción al cliente (reinscripción)</a></li>
                                    <li><a href="{{url('/servicios_escolares/duales/agregar_alumnos_dual')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Registrar Estudiantes (Historial Académico CON-REE)</a></li>
                                    <li><a href="{{url('servicios_escolares/duales/llenar_carga_academica_dual')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Llenar Cargas Académicas (Historial Académico CON-REE)</a></li>

                                    @endif
                                </ul>
</div>
                            </li>
                            @if($escolar==true)
                            
                                <li><a href="{{url('/beca_estimulo/escolares/autorizar')}}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.formularios')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Solicitudes de Beca</span>
</a></li>

                            <li>
                                @include('partials.panel.periodo_boton')
                            </li>
                            @endif
                            @if($unidad == 5 || $unidad == 26)
                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm28' ? '' : 'm28')" class="group menu-item" :class="selected === 'm28' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.tablas', ['clave' => 'm28'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Reporte de profesores</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm28'])
</a>

                                <div x-cloak x-show="$store.buscador.activo || selected === 'm28'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="/distribucion_horas_profesores/total/" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Distribución de total de horas de los profesores</a></li>
                                    <li><a href="/distribucion_horas_profesores/total_totales/" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Distribución de horas de todos los profesores</a></li>
                                    <li><a href="/distribucion_horas_profesores/" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Distribución de horas de los profesores</a></li>
                                    <!--<li style=""><a href="/indices_repro_prof/" >Indices de reprobación de los profesores</a></li>-->
                                </ul>
</div>
                            </li>
                            @endif
                        
                        @endif
                        <!--DEPARTAMENTO DE RECIDENCIA-->
                        @if($jefe_residencia == true)
                        
                            <li style="display: none">
                                <a href="#" @click.prevent="selected = (selected === 'm29' ? '' : 'm29')" class="group menu-item" :class="selected === 'm29' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.paginas', ['clave' => 'm29'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Servicio social</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm29'])
</a>

                                <div x-cloak x-show="$store.buscador.activo || selected === 'm29'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="/servicio_social/departamento_revision_primera_etapa/"
                                            class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Autorización de Documentación 1ra Etapa</a></li>
                                    <li><a href="/servicio_social/ingresar_contancia/departamento/" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Carta de Presentación-Aceptación</a></li>
                                    <li><a href="/servicio_social/asignar_tipo_servicio/" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Asignar Tipo de Servicio a Alumno</a></li>

                                </ul>
</div>
                            </li>
                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm30' ? '' : 'm30')" class="group menu-item" :class="selected === 'm30' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.grupo', ['clave' => 'm30'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Seg. Anteproyecto</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm30'])
</a>

                                <div x-cloak x-show="$store.buscador.activo || selected === 'm30'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="/residencia/ver_anteproyectos_revisores"
                                            class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Anteproyectos Autorizados por los Revisores</a></li>
                                    {{--  <li style=""><a href="/residencia/autorizar_anteproyecto" class="">Autorizar Documentación de Alta de Residencia </a></li> --}}
                                    <li><a href="/residencia/autorizar_documentacion_anteproyecto" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Autorizar Documentación de Alta de Residencia</a></li>
                                    {{--  <li><a href="/residencia/anteproyectos_autorizados/" class="">Anteproyectos Autorizados por el Departamento</a></li> --}}
                                    <li><a href="/residencia/evalucion_anteproyecto" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Periodos Revisión</a>
                                    </li>
                                    <li><a href="/residencia/empresa" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Empresa</a></li>
                                </ul>
</div>
                            </li>
                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm31' ? '' : 'm31')" class="group menu-item" :class="selected === 'm31' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.grupo', ['clave' => 'm31'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Seg. Residencia</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm31'])
</a>

                                <div x-cloak x-show="$store.buscador.activo || selected === 'm31'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="/residencia/departamento_residencia" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Proyectos</a></li>
                                    <li><a href="/residencia/estadisticas_residencia" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Estadísticas</a></li>
                                    <li><a href="/residencia/autorizar_imprimir_acta" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Autorizar impresión de acta de residencia</a></li>
                                    {{--     <li><a href="/residencia/revision_documentos_finales" class="">Autorizar Documentación de Liberación de Residencia</a></li> --}}
                                </ul>
</div>
                            </li>

                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm32' ? '' : 'm32')" class="group menu-item" :class="selected === 'm32' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.paginas', ['clave' => 'm32'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Seg. Servicio Social</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm32'])
</a>
                                <div x-cloak x-show="$store.buscador.activo || selected === 'm32'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="{{ url('/servicio_social/departamento_carreras') }}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Calificar Servicio Social</a></li>
                                </ul>
</div>
                            </li>

                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm33' ? '' : 'm33')" class="group menu-item" :class="selected === 'm33' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.paginas', ['clave' => 'm33'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Envío Encuestas Sat.</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm33'])
</a>

                                <div x-cloak x-show="$store.buscador.activo || selected === 'm33'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="/encuestas_satisfaccion/agregar_periodo_year/" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Encuestas de Satisfacción del Cliente (Servicio Social)</a></li>
                                    <li><a href="/encuestas_satisfaccion/historial_periodo_year/" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Historial Encuestas de Satisfacción del Cliente (Servicio Social)</a></li>
                                    <li><a href="/encuestas_satisfaccion/agregar_periodo_year_residencia/"
                                            class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Encuestas de Satisfacción del Cliente (Residencia Profesional)</a>
                                    </li>
                                </ul>
</div>
                            </li>

                        @endif
                        <!--departamento de titulacion-->
                        @if($departamento_titulacion==true)
                        
                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm34' ? '' : 'm34')" class="group menu-item" :class="selected === 'm34' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.usuario', ['clave' => 'm34'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Datos P.</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm34'])
</a>
                                <div x-cloak x-show="$store.buscador.activo || selected === 'm34'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="{{url('/docentes/modificar/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Editar</a></li>
                                </ul>
</div>
                            </li>

                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm35' ? '' : 'm35')" class="group menu-item" :class="selected === 'm35' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.paginas', ['clave' => 'm35'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Titulación</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm35'])
</a>
                                <div x-cloak x-show="$store.buscador.activo || selected === 'm35'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="{{url('/titulacion/registro_alumnos_titulacion/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Registrar alumnos para Titulación</a></li>
                                    <li><a href="{{url('/titulacion/autorizar_doc_requisitos/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Autorizar documentación de requisitos de Titulación</a></li>
                                    <li><a href="{{url('/titulacion/autorizar_datos_personales/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Autorizar datos personales de los estudiantes de Titulación</a></li>
                                    <li><a href="{{url('/titulacion/validacion_agregar_jurado/carreras/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Validación para agregar jurado</a></li>
                                    <li><a href="{{url('/titulacion/autorizar_jurado_estudiantes/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Autorizar jurado de los estudiantes de Titulación</a></li>
                                    <li><a href="{{url('/titulacion/calendario_estudiantes_autorizado/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Consultar Titulaciones por día</a></li>
                                    <li><a href="{{url('/titulacion/formulario_datos_titulado/inicio/carrera/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Autorizar titulaciones</a></li>
                                    <li><a href="{{url('/titulacion/relacion de documentos/inicio/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Relación de documentos</a></li>
                                    <li><a href="{{url('/titulacion/liberacion_titulado_carrera/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver alumnos titulados liberados</a></li>
                                    <li><a
                                            href="{{url('/encuestas_satisfaccion/enviar_encuesta_estudiante_titulacion/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Encuestas de satisfacción al cliente</a></li>
                                    <li><a
                                            href="{{url('/encuestas_satisfaccion/historial_encuesta_estudiante_titulacion/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Historial de Encuestas de satisfacción al cliente</a></li>
                                    <li><a href="{{url('/titulacion/ver_certificado_ingles_carrera/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver estado del certificado de ingles del estudiante</a></li>
                                    <li><a href="{{url('/centro_computo/informes_titulacion/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Modificar informe de titulación</a></li>

                                </ul>
</div>
                            </li>

                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm36' ? '' : 'm36')" class="group menu-item" :class="selected === 'm36' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.paginas', ['clave' => 'm36'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Catálogos Titulación</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm36'])
</a>
                                <div x-cloak x-show="$store.buscador.activo || selected === 'm36'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="{{url('/titulacion/reg_catalogo_tomos_titulo/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Registrar Tomos de titulos</a></li>
                                    <li><a href="{{url('/titulacion/agregar_escuelas_preparatorias/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Registrar escuelas preparatorias</a></li>

                                </ul>
</div>
                            </li>
                        
                        @endif
                        <!--MENU DIRECTIVO-->
                        @if($directivo==true || $consultas==true || $directivo==10)
                        
                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm37' ? '' : 'm37')" class="group menu-item" :class="selected === 'm37' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.usuario', ['clave' => 'm37'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Datos P.</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm37'])
</a>
                                <div x-cloak x-show="$store.buscador.activo || selected === 'm37'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="{{url('/docentes/modificar/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Editar</a></li>
                                </ul>
</div>
                            </li>

                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm38' ? '' : 'm38')" class="group menu-item" :class="selected === 'm38' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.graficas', ['clave' => 'm38'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Complementarias</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm38'])
</a>
                                <div x-cloak x-show="$store.buscador.activo || selected === 'm38'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="{{url('/nueva_actividad')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Registrar Nueva Actividad</a></li>
                                    <li><a href="{{url('/solicitud_alumnos')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Solicitud Alumnos</a></li>
                                    <li><a href="{{url('/datos_estadisticos')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Datos Estadísticos</a></li>
                                    <li><a href="{{url('/datos_historicos_graficos')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Datos Históricos</a></li>
                                </ul>
</div>
                            </li>
                        
                        <?php
                                        $id_perso = Session::get('id_perso');
                                        ?>
                        
                            <li><a href="/docente/{{$id_perso}}/carreras" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.tablas')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Calificaciones</span>
</a></li>

                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm39' ? '' : 'm39')" class="group menu-item" :class="selected === 'm39' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.graficas', ['clave' => 'm39'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Evaluación Doc.</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm39'])
</a>

                                <div x-cloak x-show="$store.buscador.activo || selected === 'm39'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li>
                                        <a href="{{url('/buscar_profesores')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Profesores</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/buscar_alumnos')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Alumnos</a>
                                    </li>
                                </ul>
</div>
                            </li>

                            {{--  --}}
                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm40' ? '' : 'm40')" class="group menu-item" :class="selected === 'm40' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.calendario', ['clave' => 'm40'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Horarios</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm40'])
</a>
                                <div x-cloak x-show="$store.buscador.activo || selected === 'm40'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="{{url('/horarios/horarios_docentes')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver Horarios Docentes</a>
                                    </li>
                                    <li><a href="{{url('/horarios/hrs_grupos')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver Horarios Grupos</a></li>
                                    <li><a href="{{url('/horarios/hrs_aulas')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver Horarios Aulas</a></li>
                                    <li><a href="{{url('/hrs_carrera')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Horas por carrera</a></li>
                                </ul>
</div>
                            </li>
                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm41' ? '' : 'm41')" class="group menu-item" :class="selected === 'm41' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.tablas', ['clave' => 'm41'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Formatos</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm41'])
</a>
                                <div x-cloak x-show="$store.buscador.activo || selected === 'm41'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="{{url('/formatos/con_edu')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Concentrado Estructura Educ.</a></li>
                                    <li><a href="{{url('/formatos/distribucion')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Distrib.de hrs. frente a grupo</a></li>
                                    <li><a href="{{url('/formatos/relacion')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Relación de personal docente</a>
                                    </li>
                                    <li><a href="{{url('/formatos/horas_docentes/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Horas por docentes</a></li>
                                </ul>
</div>
                            </li>
                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm42' ? '' : 'm42')" class="group menu-item" :class="selected === 'm42' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.tablas', ['clave' => 'm42'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Plantilla</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm42'])
</a>
                                <div x-cloak x-show="$store.buscador.activo || selected === 'm42'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="{{url('/plantilla/ver')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver Plantilla</a></li>
                                    <li><a href="{{url('/plantilla/educativa')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Plantilla Educativa</a></li>
                                </ul>
</div>
                            </li>
                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm43' ? '' : 'm43')" class="group menu-item" :class="selected === 'm43' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.elementos', ['clave' => 'm43'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Generales</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm43'])
</a>
                                <div x-cloak x-show="$store.buscador.activo || selected === 'm43'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li x-data="{ abierto: false }">
                                        <a href="#" @click.prevent="abierto = !abierto" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-modulo>
<span>Académico</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                        <div x-cloak x-show="$store.buscador.activo || abierto" x-collapse>
<ul class="mt-1 flex flex-col gap-1 border-l border-gray-200 pl-3 dark:border-gray-800">
                                            <li><a href="{{url('/reticulass')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Retículas</a></li>
                                            <li><a href="{{url('/docente')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Docentes</a></li>
                                        </ul>
</div>
                                    </li>
                                    <li><a href="{{url('/generales/edificios')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Edificios</a></li>
                                    <li><a href="{{url('/generales/aulas')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Aulas</a></li>
                                    @if($directivo==true)
                                    <li><a href="{{url('/generales/situaciones')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Situación Profesional</a>
                                    </li>
                                    <li><a href="{{url('/generales/perfiles')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Perfil</a></li>
                                    <li><a href="{{url('/generales/carreras')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Carreras</a></li>
                                    <li><a href="{{url('/generales/extra_clases')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Extra Clase</a></li>
                                    <li><a href="{{url('/generales/cargos')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Categoría Docente</a></li>
                                    <li><a href="{{url('/generales/jefaturas')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Jefaturas de División</a></li>
                                    <li><a href="{{url('/personales')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Asignación de Permisos</a></li>
                                    <li><a href="{{url('/generales/unidad_administrativa')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Unidades Administrativas</a></li>

                                    <li><a href="{{url('/generales/jefe_unidad_administrativa')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Jefes Unidades Administrativas</a></li>
                                    @endif
                                </ul>
</div>
                            </li>
                        
                        @endif
                        {{-- ///jefes de unidades--}}
                        @if($id_unidad_admin||$directivo)
                        
                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm44' ? '' : 'm44')" class="group menu-item" :class="selected === 'm44' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.paginas', ['clave' => 'm44'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Oficios Com.</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm44'])
</a>
                                <div x-cloak x-show="$store.buscador.activo || selected === 'm44'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    @if($unidad==26)
                                    <li><a href="{{url('/oficios/evaluacionsubdirecion')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Validar Oficios</a>
                                    </li>
                                    @endif
                                    <li><a href="{{url('/oficios/solicitud')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Solicitud Oficio</a></li>
                                    <li><a href="{{url('/oficios/registrosoficio')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver Oficios</a></li>

                                </ul>
</div>
                            </li>

                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm45' ? '' : 'm45')" class="group menu-item" :class="selected === 'm45' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.paginas', ['clave' => 'm45'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Seg. de Oficios</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm45'])
</a>
                                <div x-cloak x-show="$store.buscador.activo || selected === 'm45'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="{{url('/docentes/modificar/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Editar</a></li>
                                </ul>
</div>
                            </li>

                        @endif
                        {{-- centro de informacion ---}}
                        <?php $id_per = Session::get('usuario_alumno'); ?>
                        @if( $id_per == 2630 )

                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm46' ? '' : 'm46')" class="group menu-item" :class="selected === 'm46' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.paginas', ['clave' => 'm46'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Titulación</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm46'])
</a>
                                <div x-cloak x-show="$store.buscador.activo || selected === 'm46'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="{{url('/titulacion/autorizacion_entrega_cd')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Autorizar entrega de PDF</a></li>
                                    <li><a href="{{url('/titulacion/documento_titulacion_autorizado/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Documento de Titulación autorizado de los estudiantes</a></li>
                                </ul>
</div>
                            </li>
                        
                        @endif
                        {{--inicio encargados del procedimiento de ambiental --}}
                        <?php $encargado_ambiental = Session::get('encargado_ambiental'); ?>
                        @if($encargado_ambiental == true)

                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm47' ? '' : 'm47')" class="group menu-item" :class="selected === 'm47' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.paginas', ['clave' => 'm47'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Procedimiento Amb.</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm47'])
</a>
                                <div x-cloak x-show="$store.buscador.activo || selected === 'm47'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="{{url('/ambiental/enviar_documentacion/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Enviar evidencias del procedimiento</a></li>
                                    <li><a href="{{url('/ambiental/historial_documentacion/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Historial de las evidencias procedimiento</a></li>

                                </ul>
</div>
                            </li>
                        
                        @endif
                        {{--fin encargados del procedimiento de ambiental --}}

                        {{--Menú SGC--}}
                        {{--@if($id_unidad_admin || $equipo_auditor) {{--condicion para ver el menu auditorias si la sesion es de un auditor--}}

                        {{--<ul class="nav navbar-nav">
                                                <li class="dropdown bloq">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Auditorías<span
                                                                class="caret"></span></a>
                                                    <ul class="dropdown-menu">

                                                            <li><a href="{{url('/auditorias/actividades')}}">Actividades
                        para
                        la
                        agenda</a></li>
                        <li><a href="{{url('/auditorias/auditores')}}">Auditores</a></li>
                        <li><a href="{{url('/auditorias/generales')}}">Catalogo Generales</a></li>
                        <li><a href="{{url('/auditorias/procesos')}}">Procesos</a></li>
                        <li><a href="{{url('auditorias/responsables')}}">Seguimiento</a></li>

                        <li><a href="{{url('/auditorias/programas')}}">Programa de auditorías</a>
                        </li>
                    </ul>
                    </li>
                    </ul>
                    @endif--}}
                    {{--<ul class="nav navbar-nav">
                                                    <li class="dropdown blog">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">No conformidades<span
                                                                    class="caret"></span></a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="{{url('/auditorias/notas_auditorias')}}">Acciones
                    Correctivas</a>
                    </li>
                    </ul>
                    </li>
                    </ul>--}}

                    {{--inicio constancia de adeudo --}}
                    @if($id_unidad_admin == true || $id_per ===2630 || $id_per ===2662 || $escolar == true)

                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm48' ? '' : 'm48')" class="group menu-item" :class="selected === 'm48' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.formularios', ['clave' => 'm48'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Adeudos de Estudiantes</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm48'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm48'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/solicitud_adeudo/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Registrar alumnos con adeudo</a></li>
                                @if($unidad == 16 || $unidad == 28 || $escolar == true)
                                <li><a href="{{url('/constancia_adeudo/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Constancias de no adeudo</a></li>
                                @endif
                                @if($id_per ===2662)
                                <li><a href="{{url('/ver_carrera_encuestas_adeudo//')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Adeudo de Encuestas</a></li>
                                @endif
                            </ul>
</div>
                        </li>
                    
                    @if($unidad == 14 || $unidad == 20 )

                        <li>
                            @include('partials.panel.periodo_boton')
                        </li>
                    
                    @endif
                    @endif
                    {{-- direccion de administracion y finanzas---}}
                    @if($direccion_finanzas == true || $unidad == 24 || $unidad == 25 || $unidad == 1 || $unidad == 2 )
                    @if($direccion_finanzas == true || $unidad == 24 || $unidad == 25)
                    
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm50' ? '' : 'm50')" class="group menu-item" :class="selected === 'm50' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.caja', ['clave' => 'm50'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Req. Anteproyecto</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm50'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm50'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/presupuesto_anteproyecto/techo_presupuestal/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Techo presupuestal</a></li>
                                <li><a href="{{url('/presupuesto_anteproyecto/periodos_anteproyecto/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Periodos de anteproyectos</a></li>
                                <li><a href="{{url('/presupuesto_anteproyecto/revicion_requisiciones_anteproyecto/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Revisión de requisiciones</a></li>
                                <li><a href="{{url('/presupuesto_anteproyecto/requisiciones_autorizadas_proyecto/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Requisiciones autorizadas de los proyectos</a></li>
                                <li><a href="{{url('/presupuesto_anteproyecto/inicio_historial_anteproyecto/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Historiales de los anteproyectos del los presupuestos</a></li>

                            </ul>
</div>
                        </li>
                    
                    @endif
                    @if($direccion_finanzas == true || $unidad == 24 || $unidad == 25 || $unidad == 1 || $unidad == 2 )
                    
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm51' ? '' : 'm51')" class="group menu-item" :class="selected === 'm51' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.paginas', ['clave' => 'm51'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Catálogo de Requisiciones</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm51'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm51'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                @if($direccion_finanzas == true || $unidad == 24 || $unidad == 25 )
                                <li><a
                                        href="{{url('/presupuesto_anteproyecto/partida_presupuestal/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Partidas presupuestales</a></li>
                                @endif
                                <li><a href="{{url('/presupuesto_anteproyecto/proyectos_presupuestales/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Proyectos presupuestales</a></li>
                                <li><a href="{{url('/presupuesto_anteproyecto/proyectos_metas/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Metas de los proyectos presupuestales</a></li>
                            </ul>
</div>
                        </li>
                    
                    @endif
                    @if($direccion_finanzas == true || $unidad == 24 || $unidad == 25)
                    
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm52' ? '' : 'm52')" class="group menu-item" :class="selected === 'm52' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.graficas', ['clave' => 'm52'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Presupuesto autorizado</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm52'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm52'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/presupuesto_autorizado/agregar_presupesto_partida/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Agregar presupuesto autorizado</a></li>
                                <li><a href="{{url('/presupuesto_autorizado/presupesto_partida_copia/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Presupuesto autorizado para modificar</a></li>
                                <li><a href="{{url('/presupuesto_autorizado/departamentos_presupesto_partida/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Departamentos con presupuesto autorizado</a></li>
                                <li><a href="{{url('/presupuesto_autorizado/revisar_solicitudes/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Revisión de solicitudes</a></li>
                                <li><a href="{{url('/presupuesto_autorizado/solicitudes_autorizadas_departamentos')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Solicitudes autorizadas liberadas</a></li>
                                <li><a
                                        href="{{url('/presupuesto_autorizado/inicio_presupuesto_autorizado_historial/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Historial de presupuesto autorizado</a></li>
                            </ul>
</div>
                        </li>
                    
                    @endif
                    @endif
                    {{--fin constancia de adeudo --}}
                    @if($id_unidad_admin)

                    @if($unidad == 40 || $unidad == 1)
                    @if($unidad == 40 )
                    
                        <li><a href="{{url('/ipomex/mostrar_fracciones/contralor_ver_ipomex/')}}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.paginas')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Ipomex</span>
</a></li>
                    
                    @else
                    
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm53' ? '' : 'm53')" class="group menu-item" :class="selected === 'm53' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.paginas', ['clave' => 'm53'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Ipomex</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm53'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm53'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/ipomex/mostrar_fracciones/contralor_ver_ipomex/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver jefes con fracciones</a></li>
                                <li><a href="{{url('/ipomex/mostrar_fracciones')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver mis fracciones</a></li>

                            </ul>
</div>
                        </li>
                    
                    @endif
                    @else
                    
                        <li><a href="{{url('/ipomex/mostrar_fracciones')}}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.paginas')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Ipomex</span>
</a></li>
                    
                    @endif
                    <?php $id_per = Session::get('usuario_alumno'); ?>

                    @if($unidad == 5 )
                    
                        <li><a href="{{url('/beca_estimulo/academico/autorizar')}}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.formularios')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Solicitudes de beca</span>
</a></li>
                    
                    @endif
                    @if($unidad == 26)

                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm54' ? '' : 'm54')" class="group menu-item" :class="selected === 'm54' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.formularios', ['clave' => 'm54'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Solicitudes</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm54'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm54'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/beca_estimulo/academico/autorizar')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Solicitudes de beca</a></li>
                                <li><a href="{{url('/solicitud/prorroga_autorizar')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Solicitud de prórroga</a></li>
                            </ul>
</div>
                        </li>
                        <li><a href="{{url('/residencia/carreras_proyectos')}}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.grupo')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Residencia</span>
</a></li>

                    @endif
                    @if($unidad == 17)

                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm55' ? '' : 'm55')" class="group menu-item" :class="selected === 'm55' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.paginas', ['clave' => 'm55'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Evidencias Inf. Doc.</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm55'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm55'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/ambiental/ver_procedimientos/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Procedimientos</a></li>
                                <li><a href="{{url('/ambiental/ver_encargados/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Encargados de los Procedimientos</a>
                                </li>
                                <li><a href="{{url('/ambiental/ver_periodos/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Periodos de Envío de Documentación</a>
                                </li>
                                <li><a href="{{url('/ambiental/ver_documentacion_ambiental/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Autorizar Documentación</a></li>
                                <li><a href="{{url('/ambiental/historial_ambiental_departamento/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Historial Documentación Ambiental</a></li>

                            </ul>
</div>
                        </li>

                    @endif
                    {{--@if($unidad == 2 || $unidad == 5)
                                                            <ul class="nav navbar-nav navbar-left alumno" style="">

                                                                <li class="dropdown">
                                                                    <a class="dropdown-toogle" href="" data-toggle="dropdown"
                                                                       role="button" aria-haspopup="true" aria-expanded="false">Encuestas Satisfacción

                                                                        </a>
                                                                    <ul class="dropdown-menu">

                                                                        <li><a href="{{url('/encuestas_satisfaccion/encuesta_incripcion_periodo')}}">Inscripción</a>
                    </li>
                    <li><a href="{{url('/encuestas_satisfaccion/encuesta_reincripcion_periodo/')}}">Reinscripción</a>
                    </li>
                    <li><a href="{{url('/encuestas_satisfaccion/menu_historial_mantenimiento/')}}">Centro de computo</a>
                    </li>
                    <li><a href="{{url('/encuestas_satisfaccion/historial_periodo_year/')}}">Servicio social</a></li>
                    <li><a href="{{url('/encuestas_satisfaccion/agregar_periodo_year_residencia/')}}">Residencia
                            Profesional</a></li>
                    <li><a
                            href="{{url('/encuestas_satisfaccion/historial_encuesta_estudiante_titulacion')}}">Titulación</a>
                    </li>
                    </ul>
                    </li>

                    </ul>
                    @endif--}}

                    {{-- ul oculto (display:none) en el original --}}
                        <li style="display: none">
                            <a href="#" @click.prevent="selected = (selected === 'm56' ? '' : 'm56')" class="group menu-item" :class="selected === 'm56' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.paginas', ['clave' => 'm56'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">P.A.AC</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm56'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm56'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li x-data="{ abierto: false }">
                                    @if($unidad == 1)
                                    <a href="#" @click.prevent="abierto = !abierto" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-modulo>
<span>Catálogo</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                    <div x-cloak x-show="$store.buscador.activo || abierto" x-collapse>
<ul class="mt-1 flex flex-col gap-1 border-l border-gray-200 pl-3 dark:border-gray-800">
                                        <li><a href="{{url('/paa/programa_paa')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Programa</a></li>
                                        <li><a href="{{url('/paa/subprograma_paa')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Subprograma</a></li>
                                        <li><a href="{{url('/paa/acciones_paa')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Acción</a></li>
                                        <li><a href="{{url('/paa/unidad_medida_paa')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Unidad de medida</a>
                                        </li>

                                    </ul>
</div>
                                    @endif
                                </li>
                                <li x-data="{ abierto: false }">
                                    <a href="#" @click.prevent="abierto = !abierto" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-modulo>
<span>OPCIONES DE P.A.AC</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                    <div x-cloak x-show="$store.buscador.activo || abierto" x-collapse>
<ul class="mt-1 flex flex-col gap-1 border-l border-gray-200 pl-3 dark:border-gray-800">
                                        <li><a href="{{url('/paa/generarpaa')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Generar</a></li>
                                        <li><a href="{{url('/paa/subprograma_paa')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Modificar P.A.A</a></li>
                                        <li><a href="{{url('/paa/acciones_paa')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Cargar evidencia</a></li>
                                        <li><a href="{{url('/paa/unidad_medida_paa')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Modificar</a></li>

                                    </ul>
</div>
                                </li>
                            </ul>
</div>

                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm57' ? '' : 'm57')" class="group menu-item" :class="selected === 'm57' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.caja', ['clave' => 'm57'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Req. de Mat. Anteproyecto</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm57'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm57'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a
                                        href="{{url('/presupuesto_anteproyecto/registrar_requerimientos_anteproyecto/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Registrar requisición de materiales del anteproyecto</a>
                                </li>
                            </ul>
</div>
                        </li>

                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm58' ? '' : 'm58')" class="group menu-item" :class="selected === 'm58' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.graficas', ['clave' => 'm58'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Solicitudes de req. del presupuesto autorizado</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm58'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm58'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li>
                                    <a href="{{url('/presupuesto_autorizado/agregar_req_solicitud_autorizadas/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Registrar requisiciones a las solicitudes autorizadas</a>
                                </li>
                                <li>
                                    <a href="{{url('/presupuesto_autorizado/solicitudes_aut_departamento/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver solicitudes autorizadas liberadas</a>
                                </li>
                            </ul>
</div>
                        </li>

                    @endif

                    <!--MENU ALUMNO-->
                    @if($palumno==true)
                    <?php $tipo_p = Session::get('tipo_persona'); ?>

                    <?php $semestre = Session::get('semestre');?>

                        <li>

                            <a href="#" @click.prevent="selected = (selected === 'm59' ? '' : 'm59')" class="group menu-item" :class="selected === 'm59' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.graficas', ['clave' => 'm59'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Complementarias</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm59'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm59'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/consulta_actividades/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Registrar</a></li>
                                <li><a href="{{url('/evidencias_alumnos')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Evidencias</a></li>
                                <li><a href="{{url('/liberacion_alumno')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Liberación</a></li>
                                <li><a href="{{url('/creditos')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Créditos</a></li>
                            </ul>
</div>
                        </li>

                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm60' ? '' : 'm60')" class="group menu-item" :class="selected === 'm60' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.usuario', ['clave' => 'm60'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Datos Alumno(a)</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm60'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm60'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/datos_alumno')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Actualizar</a></li>
                                @if($ver_carga==false)
                                <li><a href="{{url('/carga_academica')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Llenar Carga Académica</a></li>
                                @endif
                                <li><a href="{{url('/checar_carga')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver Carga Académica</a>
                                </li>
                                {{--
                                                                    <li><a href="{{url('/alumno/academico/cal')}}">Promedio
                                Academico</a>
                        </li>
                        --}}

                    </ul>
</div>
                    </li>

                        <li>
                        <li><a href="{{url('/ingles/')}}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.paginas')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Inglés</span>
</a></li>
                        </li>

                        <li>
                        <li><a href="{{url('/tutorias/')}}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.usuario')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Tutorías</span>
</a></li>
                        </li>

                    @php
                    $id_carrera = DB::table('gnral_alumnos')
                    ->where('id_usuario', session('usuario_alumno'))
                    ->value('id_carrera');
                    @endphp

                    @if(in_array($id_carrera, [6, 8]))
                    
                        <li>
                            <a href="{{ url('/examen_egel/dashboard') }}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.graficas')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Examen EGEL</span>
</a>
                        </li>
                    
                    @endif

                    @if($ver_eva==true)

                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm61' ? '' : 'm61')" class="group menu-item" :class="selected === 'm61' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.graficas', ['clave' => 'm61'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Evaluación Docente</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm61'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm61'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/evaluacion_alumno')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Iniciar Evaluación</a></li>
                            </ul>
</div>
                        </li>
                    
                    @endif
                    
                        <li><a href="{{url('/calificaciones')}}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.tablas')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Calificaciones</span>
</a></li>
                        @if($escolar !=true)
                        <li>
                            @include('partials.panel.periodo_boton')
                        </li>
                        @endif

                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm63' ? '' : 'm63')" class="group menu-item" :class="selected === 'm63' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.formularios', ['clave' => 'm63'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Solicitudes</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm63'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm63'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/beca_estimulo/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Solicitud del Estimulo al D. E.</a></li>
                                <li><a href="{{url('/solicitud/prorroga')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Solicitud de prórroga</a></li>
                                <li><a href="{{url('/verificacion_adeudo_alumno/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Solicitud de constancia de no adeudo</a></li>

                                @php
                                $carrera = DB::select('SELECT id_carrera FROM gnral_alumnos WHERE id_usuario = ?' ,
                                [Auth::id()]);
                                @endphp
                                @if (!empty($carrera) && $carrera[0]->id_carrera == 2)
                                <li><a href="{{url('/prestamo/Alumnos_Prestamos_material')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Solicitud de material</a></li>
                                @endif

                            </ul>
</div>
                        </li>

                    <div style="">

                        @if($semestre >= 8)
                        <?php $registrar_residencia = Session::get('registrar_residencia');?>
                        <?php $anteproyecto_aceptado = Session::get('anteproyecto_aceptado');?>
                        <?php $registro_empresa = Session::get('registro_empresa');?>
                        <?php $estado_reg_anteproyecto = Session::get('estado_reg_anteproyecto');?>

                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm64' ? '' : 'm64')" class="group menu-item" :class="selected === 'm64' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.grupo', ['clave' => 'm64'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Datos Residencia Profesional</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm64'])
</a>
                                <div x-cloak x-show="$store.buscador.activo || selected === 'm64'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    @if($registrar_residencia == true)
                                    <li>
                                        <a href="{{url('/residencia/registrar_anteproyecto')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Registrar Anteproyecto</a>
                                    </li>

                                    @if($estado_reg_anteproyecto == true)
                                    <li>
                                        <a href="{{url('/residencia/correcciones_anteproyecto/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Correciones anteproyecto</a>
                                    </li>
                                    @endif
                                    @if($anteproyecto_aceptado == true)
                                    <li><a href="{{url('/residencia/agregar_empresa')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Agregar empresa</a></li>
                                    @endif
                                    @if($registro_empresa == true)

                                    <li><a href="#"
                                            onclick="window.open('{{url('/residencia/dictamen_anteproyecto')}}')" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Dictamen Anteproyecto</a></li>
                                    <li><a
                                            href="{{url('/residencia/registrar_solicitud_residencia')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Registrar datos de la solicitud de residencia</a></li>
                                    <li style="display: none"><a
                                            href="{{url('/residencia/documentos_alta_residencia')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Enviar documentos de alta de residencia</a></li>

                                    @endif
                                    @else
                                    @if($estado_reg_anteproyecto == true)
                                    <li>
                                        <a href="{{url('/residencia/correcciones_anteproyecto/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Correciones anteproyecto</a>
                                    </li>
                                    @endif
                                    @if($anteproyecto_aceptado == true)
                                    <li><a href="{{url('/residencia/agregar_empresa')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Agregar empresa</a></li>
                                    @endif
                                    @if($registro_empresa == true)
                                    <li> <a href="#"
                                            onclick="window.open('{{url('/residencia/dictamen_anteproyecto')}}')" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Dictamen Anteproyecto</a></li>
                                    <li><a
                                            href="{{url('/residencia/registrar_solicitud_residencia')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Registrar datos de la solicitud de residencia</a></li>

                                    <li style="display: none"><a
                                            href="{{url('/residencia/documentos_alta_residencia')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Enviar documentos de alta de residencia</a></li>

                                    @endif
                                    @endif
                                </ul>
</div>
                            </li>

                        @endif
                        @if($seguimiento_alumno == true)

                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm65' ? '' : 'm65')" class="group menu-item" :class="selected === 'm65' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.grupo', ['clave' => 'm65'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Seguimiento Residencia</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm65'])
</a>
                                <div x-cloak x-show="$store.buscador.activo || selected === 'm65'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="{{url('/residencia/seguimiento_residencia')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Mostrar Seguimiento de Residencia</a></li>
                                    <li style="display: none"><a
                                            href="{{url('/residencia/enviar_documentacion/alumno/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Enviar documentación de Liberación de Residencia</a></li>

                                </ul>
</div>
                            </li>

                        @endif
                        @if($semestre >= 5)
                        {{-- ul oculto (display:none) en el original --}}

                            <li style="display: none">
                                <a href="#" @click.prevent="selected = (selected === 'm66' ? '' : 'm66')" class="group menu-item" :class="selected === 'm66' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.paginas', ['clave' => 'm66'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Servicio Social</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm66'])
</a>
                                <div x-cloak x-show="$store.buscador.activo || selected === 'm66'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="{{url('/servicio_social/docuemtacion_priemra_etapa/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Documentación de la primera etapa S.S.</a></li>
                                    <li><a href="{{url('/servicio_social/enviocartapresentacionalumno/alumno/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Envío de Carta de Presentación-Aceptación</a></li>

                                </ul>
</div>
                            </li>
                        
                        @endif
                        <?php $reg_alum_ti = Session::get('reg_alum_ti');?>
                        <?php $ti_segunda_etapa = Session::get('ti_segunda_etapa');?>
                        <?php $ti_tercera_parte = Session::get('ti_tercera_parte');?>
                        <?php $estado_cuenta = Session::get('estado_cuenta');?>

                        @if($reg_alum_ti == true)

                            <li>
                                <a href="#" @click.prevent="selected = (selected === 'm67' ? '' : 'm67')" class="group menu-item" :class="selected === 'm67' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.paginas', ['clave' => 'm67'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Titulación</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm67'])
</a>
                                <div x-cloak x-show="$store.buscador.activo || selected === 'm67'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                    <li><a href="{{url('/titulacion/documentacion_requisitos_titulacion/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Documentación de los requisitos de Titulación (1ra Etapa)</a></li>
                                    @if($ti_segunda_etapa == true)
                                    <li><a
                                            href="{{url('/titulacion/reg_datos_personales/segunda_etapa/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Registro de Datos Personales (2da Etapa)</a></li>
                                    @endif
                                    @if($ti_tercera_parte == true)
                                    <li><a href="{{url('/titulacion/registro_jurado/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Registro de jurado (3ra etapa)</a></li>

                                    @endif
                                    {{--
                                                                    @if($estado_cuenta == true)
                                                                        <li style=""><a href="{{url('/encuestas_satisfaccion/contestar_encuesta_alumno/')}}">Encuesta
                                    de Satisfacción del Cliente</a>
                            </li>
                            @endif
                            --}}

                        </ul>
</div>
                        </li>
                        
                        @endif
                    </div>

                    @endif
                    <!--MENU    PROFESOR  DE INGLES-->
                    @if($profesor_ingles==true)
                    
                        <li>
                        <li><a href="{{url('/ingles/')}}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.paginas')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Inglés</span>
</a></li>
                        </li>
                    
                    @endif

                    <!--Incidencias-->
                    <?php   $personal_tesvb=Session::get('personal_tesvb');?>
                    @if(
                    $personal_tesvb == true
                    || $es_auditor_lider_sgoe_menu
                    || $es_lider_acciones_sgoe_menu
                    || $puede_ver_seguimiento_auditorias_menu
                    )
                    @if($personal_tesvb == true)
                    
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm68' ? '' : 'm68')" class="group menu-item" :class="selected === 'm68' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.formularios', ['clave' => 'm68'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Incidencias de Asistencia</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm68'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm68'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                @if($unidad == 3)
                                <li><a href="{{url('/incidencias/validar_oficios_departamentos')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Validar oficios de los departamentos</a></li>

                                @elseif($unidad == 5 || $unidad == 22)
                                <li><a href="{{url('/incidencias/validar_oficios_dep_acad_finanzas')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Validar oficios de los departamentos</a></li>
                                @endif
                                @if($jefe_division==true || $directivo==true || $direccion_finanzas==true ||
                                $jefe_personal==true ||$id_unidad_admin==true )
                                <li><a href="{{url('/incidencias/validar_oficios')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Validar oficios del departamento</a></li>
                                <li><a href="{{url('/incidencias/historial_oficios_autorizados')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Historial de oficios autorizados del departamento</a></li>
                                <li><a href="{{url('/incidencias/historial_evid_personal')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Historial de evidencias de conocimiento del departamento</a></li>

                                {{--
                                                                      <li><a href="{{url('/incidencias/historial_evid_conocimiento')}}">Historial
                                de Evidencias de conocimiento</a>
                        </li>
                        --}}
                        @endif
                        @if( !$id_unidad_admin)
                        <li><a href="{{url('/incidencias/solicitar_oficio')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Solicitar oficio</a></li>
                        <li><a href="{{url('/incidencias/cargar_otra_evidencia')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Subir evidencia de conocimiento</a>
                        </li>
                        {{--  <li><a href="{{url('/incidencias/articulos_evidencia')}}">Subir evidencia</a></li>
                        --}}
                        <li><a href="{{url('/incidencias/historial_docentesSo')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Historial oficios autorizados</a>
                        </li>
                        <li><a href="{{url('/incidencias/historial_docentesEv')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Historial evidencias de conocimiento</a></li>
                        @endif
                        @if($jefe_personal==true)
                        <li><a href="{{url('/incidencias/validar_evidencia_departamentos')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Validar evidencia de conocimiento de los departamentos</a></li>
                        <li><a href="{{url('/incidencias/historial_oficios')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Historial de oficios de los departamentos</a></li>
                        <li><a href="{{url('/incidencias/historial_evidencias')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Historial de evidencias de conocimiento de los departamentos</a></li>
                        <li><a href="{{url('/incidencias/reportes_incidencias')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Reportes</a></li>
                        @endif

                    </ul>
</div>
                    </li>
                    
                    @endif

                    {{--<ul class="nav navbar-nav ">
                                                <li class="dropdown">
                                                    <a class="dropdown-toogle" href="" data-toggle="dropdown"
                                                       role="button" aria-haspopup="true" aria-expanded="false" style="">Encuestas
                                                        </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="{{url('/encuestas_satisfaccion/registro_enc_mante_usuario/')}}">Encuesta
                    de satisfacción al cliente Centro de Computo</a></li>

                    </ul>
                    </li>
                    </ul>--}}
                    
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm69' ? '' : 'm69')" class="group menu-item" :class="selected === 'm69' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.graficas', ['clave' => 'm69'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">SGOE</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm69'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm69'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                {{-- Opción SGOE --}}
                                <li><a href="{{url('/sgoe/inicio')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>SGOE</a></li>

                                @if($personal_tesvb == true && ($id_unidad_admin||$directivo))
                                {{--OPCIÓN: Riesgos y Oportuni. --}}
                                <li x-data="{ abierto: false }">
                                    <a href="#" @click.prevent="abierto = !abierto" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-modulo>
<span>Riesgos y Oportuni.</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                    <div x-cloak x-show="$store.buscador.activo || abierto" x-collapse>
<ul class="mt-1 flex flex-col gap-1 border-l border-gray-200 pl-3 dark:border-gray-800">
                                        <li><a href="{{url('/riesgos/proceso')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Registro Procesos</a></li>

                                        <li x-data="{ abierto: false }">
                                            <a href="#" @click.prevent="abierto = !abierto" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-modulo>
<span>Registro Catálogos Riesgos</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                            <div x-cloak x-show="$store.buscador.activo || abierto" x-collapse>
<ul class="mt-1 flex flex-col gap-1 border-l border-gray-200 pl-3 dark:border-gray-800">
                                                <li><a href="{{url('/riesgos/riesgo')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Riesgos</a></li>
                                                <li><a href="{{url('/riesgos/seleccion')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Selecciones</a></li>
                                                <li><a href="{{url('/riesgos/tipoeva')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Tipo Evaluación</a></li>
                                                <li><a href="{{url('/riesgos/factor')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Factor</a></li>
                                                <li><a href="{{url('/riesgos/tipof')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Tipo Factor</a></li>
                                                <li><a href="{{url('/riesgos/estrategia')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Estrategias</a></li>
                                                <li><a href="{{url('/riesgos/decision')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Nivel Decisión</a></li>
                                                <li><a href="{{url('/riesgos/clasifica')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Clasificación Riesgo</a>
                                                </li>
                                                <li><a href="{{url('/riesgos/sistema')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Categoría del Proceso</a></li>
                                            </ul>
</div>
                                        </li>

                                        <li x-data="{ abierto: false }">
                                            <a href="#" @click.prevent="abierto = !abierto" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-modulo>
<span>Registro Catálogos Oportunidades</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                            <div x-cloak x-show="$store.buscador.activo || abierto" x-collapse>
<ul class="mt-1 flex flex-col gap-1 border-l border-gray-200 pl-3 dark:border-gray-800">
                                                <li><a href="{{url('/riesgos/mejoracliente')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Mejoras del Cliente</a>
                                                </li>
                                                <li><a href="{{url('/riesgos/mejorareputacion')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Reputación Institucional</a></li>
                                                <li><a href="{{url('/riesgos/mejorasgc')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Mejora SGC</a></li>
                                                <li><a href="{{url('/riesgos/potencialapertura')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Potencial Apertura Nuevos Programas de Estudio</a></li>
                                                <li><a href="{{url('/riesgos/potencialcosto')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Potencial Costo de Implementación</a></li>
                                                <li><a href="{{url('/riesgos/potencialcrecimiento')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Potencial de Crecimiento de la Matrícula Actual</a></li>
                                                <li><a href="{{url('/riesgos/probabilidad')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Registra Probabilidad</a>
                                                </li>
                                                <li><a href="{{url('/riesgos/ocurrenciasp')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Registra Ocurrencias Previas</a></li>
                                                <li><a href="{{url('/riesgos/calificacion')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Registra Calificación Máxima</a></li>
                                            </ul>
</div>
                                        </li>

                                        <li><a href="{{url('/riesgos/partes')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Partes Interesadas</a></li>

                                        @if($directivo || $unidad==10)
                                        <li><a href="{{url('/riesgos/seguimiento')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Seguimiento</a></li>
                                        <li><a href="{{url('riesgos/seguimiento/tabla')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Cronograma</a></li>
                                        @endif
                                    </ul>
</div>
                                </li>
                                @endif

                                {{-- 2. Auditorías: líder ve todo; auditor solo Programa de auditorías --}}
                                @if($es_auditor_lider_sgoe_menu || $es_auditor_responsable_sgoe_menu)
                                <li x-data="{ abierto: false }">
                                    <a href="#" @click.prevent="abierto = !abierto" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-modulo>
<span>Auditorías</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                    <div x-cloak x-show="$store.buscador.activo || abierto" x-collapse>
<ul class="mt-1 flex flex-col gap-1 border-l border-gray-200 pl-3 dark:border-gray-800">
                                        @if($es_auditor_lider_sgoe_menu)
                                        <li><a href="{{url('/auditorias/actividades')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Actividades para la agenda</a>
                                        </li>
                                        <li><a href="{{url('/auditorias/auditores')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Auditores</a></li>
                                        <li><a href="{{url('/auditorias/generales')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Catálogo Generales</a></li>
                                        <li><a href="{{url('/auditorias/procesos')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Procesos</a></li>
                                        <li><a href="{{url('/auditorias/responsables')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Seguimiento</a></li>
                                        @endif
                                        <li><a href="{{url('/auditorias/programas')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Programa de auditorías</a></li>
                                    </ul>
</div>
                                </li>
                                @endif

                                @if($personal_tesvb == true)
                                {{-- Opción No conformidades --}}
                                <li x-data="{ abierto: false }">
                                    <a href="#" @click.prevent="abierto = !abierto" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-modulo>
<span>No conformidades</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                    <div x-cloak x-show="$store.buscador.activo || abierto" x-collapse>
<ul class="mt-1 flex flex-col gap-1 border-l border-gray-200 pl-3 dark:border-gray-800">
                                        <li>
                                            <a href="{{url('/auditorias/notas_auditorias')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Acciones Correctivas</a>
                                        </li>
                                    </ul>
</div>
                                </li>
                                @endif

                                {{-- 4. Encuestas Satisfacción --}}
                                @if($personal_tesvb == true && ($unidad == 2 || $unidad == 5))
                                <li x-data="{ abierto: false }">
                                    <a href="#" @click.prevent="abierto = !abierto" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-modulo>
<span>Encuestas Satisfacción</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                    <div x-cloak x-show="$store.buscador.activo || abierto" x-collapse>
<ul class="mt-1 flex flex-col gap-1 border-l border-gray-200 pl-3 dark:border-gray-800">
                                        <li><a
                                                href="{{url('/encuestas_satisfaccion/encuesta_incripcion_periodo')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Inscripción</a>
                                        </li>
                                        <li><a
                                                href="{{url('/encuestas_satisfaccion/encuesta_reincripcion_periodo/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Reinscripción</a>
                                        </li>
                                        <li><a href="{{url('/encuestas_satisfaccion/menu_historial_mantenimiento/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Centro de cómputo</a></li>
                                        <li><a href="{{url('/encuestas_satisfaccion/historial_periodo_year/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Servicio social</a></li>
                                        <li><a
                                                href="{{url('/encuestas_satisfaccion/agregar_periodo_year_residencia/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Residencia Profesional</a></li>
                                        <li><a
                                                href="{{url('/encuestas_satisfaccion/historial_encuesta_estudiante_titulacion')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Titulación</a>
                                        </li>
                                    </ul>
</div>
                                </li>
                                @endif

                                @if($personal_tesvb == true)
                                {{-- 5. Encuestas --}}
                                <li x-data="{ abierto: false }">
                                    <a href="#" @click.prevent="abierto = !abierto" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-modulo>
<span>Encuestas</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                    <div x-cloak x-show="$store.buscador.activo || abierto" x-collapse>
<ul class="mt-1 flex flex-col gap-1 border-l border-gray-200 pl-3 dark:border-gray-800">
                                        <li><a href="{{url('/encuestas_satisfaccion/registro_enc_mante_usuario/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Encuesta de satisfacción al cliente Centro de Cómputo</a></li>
                                    </ul>
</div>
                                </li>
                                @endif

                                @if($personal_tesvb == true)
                                {{-- 6. Seguimiento Acciones --}}
                                <li x-data="{ abierto: false }">
                                    <a href="#" @click.prevent="abierto = !abierto" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-modulo>
<span>Seguimiento OM/NC/AC</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                    <div x-cloak x-show="$store.buscador.activo || abierto" x-collapse>
<ul class="mt-1 flex flex-col gap-1 border-l border-gray-200 pl-3 dark:border-gray-800">
                                        <li><a href="{{ url('/auditorias/responsables_implementar') }}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ejecutar</a>
                                        </li>
                                        <li><a href="{{ url('/auditorias/responsables_revisar') }}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Revisar</a></li>
                                    </ul>
</div>
                                </li>
                                @endif

                                {{-- 7. Seguimiento Notas--}}

                                @if($personal_tesvb == true && $equipo_auditor)
                                <li>
                                    <a href="{{url('/auditorias/notas_auditor')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Seguimiento Auditorías Anteriores</a>
                                </li>
                                @endif

                                {{-- 8. Crear Lider Acciones--}}
                                @if($es_auditor_lider_sgoe_menu)
                                <li>
                                    <a href="{{ route('auditorias.asignar_lider') }}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Asignar Líder</a>
                                </li>
                                @endif

                                {{-- 9. Ver Lider Acciones--}}
                                @if($es_lider_acciones_sgoe_menu)
                                <li>
                                    <a href="{{ route('auditorias.lider_acciones') }}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver Acciones</a>
                                </li>
                                @endif

                                {{-- 10. Seguimiento de auditorías --}}
                                @if($puede_ver_seguimiento_auditorias_menu)
                                <li>
                                    <a href="{{ route('auditorias.seguimiento_auditorias.index') }}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Seguimiento de auditorías</a>
                                </li>
                                @endif

                                {{-- 10. Asignar Revisor Acciones--}}
                                {{--if($id_unidad_admin||$directivo)
                                                        <li>
                                                            <a href="{{ route('auditorias.asignar_acciones') }}">Asignar
                                Revisor</a>
                        </li>
                        @endif--}}

                        {{--@if($revisor_accion)--}}
                        {{--<li>
                                                                    <a href="{{ route('auditorias.revisar_acciones') }}">Revisar
                        Acciones</a>
                        </li>--}}
                        {{--@endif--}}

                    </ul>
</div>
                    </li>

                    @endif
                    <?php
                                $unidad = Session::get('id_unidad_admin');
                                ?>
                    @if($unidad == 25)
                    
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm70' ? '' : 'm70')" class="group menu-item" :class="selected === 'm70' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.caja', ['clave' => 'm70'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Inventario TESVB</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm70'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm70'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/SectorAux')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Sector Auxiliar</a></li>
                                <li x-data="{ abierto: false }"><a href="#" @click.prevent="abierto = !abierto" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-modulo>
<span>Bienes</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                    <div x-cloak x-show="$store.buscador.activo || abierto" x-collapse>
<ul class="mt-1 flex flex-col gap-1 border-l border-gray-200 pl-3 dark:border-gray-800">
                                        <li x-data="{ abierto: false }"><a href="#" @click.prevent="abierto = !abierto" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-modulo>
<span>Gestionar atributos del Bien</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                            <div x-cloak x-show="$store.buscador.activo || abierto" x-collapse>
<ul class="mt-1 flex flex-col gap-1 border-l border-gray-200 pl-3 dark:border-gray-800">
                                                <li><a href="{{url('/Marcas')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Marcas</a></li>
                                                <li><a href="{{url('/Provedores')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Proveedores</a></li>
                                                <li><a href="{{url('/Modelos')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Modelos</a></li>
                                            </ul>
</div>
                                        </li>
                                        <li><a href="{{url('/Bienes')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Registro, Gestión y consulta de Bienes</a></li>
                                    </ul>
</div>
                                </li>
                                <li><a href="{{url('/Categorias')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Categorías</a></li>
                                <li x-data="{ abierto: false }"><a href="#" @click.prevent="abierto = !abierto" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-modulo>
<span>Resguardos</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                    <div x-cloak x-show="$store.buscador.activo || abierto" x-collapse>
<ul class="mt-1 flex flex-col gap-1 border-l border-gray-200 pl-3 dark:border-gray-800">
                                        <li><a href="{{'/Resguardos'}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Asignación y Consulta de Resguardos</a></li>
                                        <li><a href="{{'/Resguardos-Consulta'}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Tarjetas de Resguardo</a></li>
                                    </ul>
</div>
                                </li>
                                <li x-data="{ abierto: false }"><a href="#" @click.prevent="abierto = !abierto" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-modulo>
<span>Padrón de Bienes</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                    <div x-cloak x-show="$store.buscador.activo || abierto" x-collapse>
<ul class="mt-1 flex flex-col gap-1 border-l border-gray-200 pl-3 dark:border-gray-800">
                                        <li><a href="{{'/Resguardos-Padron'}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Padrón del TESVB</a></li>
                                    </ul>
</div>
                                </li>
                                <li><a href="{{url('/Areas')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Historial Departamentos</a></li>
                                <li x-data="{ abierto: false }"><a href="#" @click.prevent="abierto = !abierto" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-modulo>
<span>Reportes</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                    <div x-cloak x-show="$store.buscador.activo || abierto" x-collapse>
<ul class="mt-1 flex flex-col gap-1 border-l border-gray-200 pl-3 dark:border-gray-800">
                                        <li><a href="{{'/Reportes'}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Reportes en Excel</a></li>
                                    </ul>
</div>
                                </li>
                            </ul>
</div>
                        </li>
                    
                    @endif
                    <!-- ===== MENÚ JEFE DE DIVISION MODULO DUALES===== -->
                    @if($jefe_division==true)
                    
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm71' ? '' : 'm71')" class="group menu-item" :class="selected === 'm71' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.grupo', ['clave' => 'm71'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Duales</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm71'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm71'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/duales/agregar_alumnos_dual')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Agregar Alumnos Duales</a></li>
                                <li><a href="{{url('/duales/llenar_carga_academica_dual')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Llenar Cargas Académicas</a></li>
                                <li><a href="{{url('/duales/Agregar_docentes_duales')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Agregar Mentores Duales</a>
                                </li>
                            </ul>
</div>
                        </li>

                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm72' ? '' : 'm72')" class="group menu-item" :class="selected === 'm72' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.paginas', ['clave' => 'm72'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Seguimiento Inglés</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm72'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm72'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/jefe_division/seguimiento_ingles')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Estudiantes</a></li>
                            </ul>
</div>
                        </li>
                    
                    @endif
                    <!-- ===== MENÚ JEFE DE DIVISION MODULO DUALES===== -->

                    @if($unidad == 8)
                    
                        <li><a href="{{url('/revicion_carga_jefe/')}}" class="group menu-item menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.tablas')
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Validar Cargas</span>
</a></li>
                    
                    @endif
                    @if($unidad == 6)
                    
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'm73' ? '' : 'm73')" class="group menu-item" :class="selected === 'm73' ? 'menu-item-active' : 'menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.caja', ['clave' => 'm73'])
<span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Materiales y solicitudes</span>
@include('partials.panel.iconos.flecha', ['clave' => 'm73'])
</a>
                            <div x-cloak x-show="$store.buscador.activo || selected === 'm73'" x-collapse>
<ul :class="sidebarToggle ? 'xl:hidden' : 'flex'" class="menu-dropdown mt-2 flex animate-in flex-col gap-1 pl-9 duration-200 fade-in-0 slide-in-from-top-1">
                                <li><a href="{{url('/prestamo/Jefe_prestamos_materiales/')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver solicitudes</a></li>
                                <li><a href="{{url('/prestamo/materials')}}" class="group menu-dropdown-item menu-dropdown-item-inactive" data-panel-enlace>Ver materiales</a></li>
                            </ul>
</div>
                        </li>
                    
                    @endif

                </div>

{{-- [menu_admin L2532-2620] JS jQuery de submenús y tooltips: lo sustituye Alpine. Las funciones AJAX de oficios
     (cargar / cargarpersonal) no se copian porque en el original nunca se llaman (setInterval comentado). --}}
                </ul>
            </div>
        </nav>
    </div>
</aside>

{{-- [menu_admin L2507-2531] Modal "Modificar periodo" (perfil de inglés): mismo formulario POST con CSRF.
     El original lo abría con jQuery al hacer clic en .periodo_ingles (GET /profesores_ingles/periodos/{id});
     ahora lo hace resources/js/panel/modal_periodo_ingles.js. --}}
<div x-data="{ abierto: false }" @abrir-modal-periodo-ingles.window="abierto = true" @keydown.escape.window="abierto = false">
    <div x-cloak x-show="abierto" x-transition.opacity class="fixed inset-0 z-99999 flex items-center justify-center overflow-y-auto p-5" id="modal_modificar_periodo" role="dialog" aria-modal="true" aria-labelledby="myModalLabel">
        <div class="fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]" @click="abierto = false"></div>
        <div class="relative w-full max-w-lg rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-8">
            <form class="form" action="" role="form" method="POST">
                {{ csrf_field() }}
                <div class="mb-4 flex items-center justify-between">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90" id="myModalLabel">Modificar periodo</h4>
                    <button type="button" @click="abierto = false" aria-label="Cerrar" class="text-2xl leading-none text-gray-500 hover:text-gray-800 dark:text-gray-400">&times;</button>
                </div>
                <div id="contenedor_modificar_periodo">


                </div>
            </form>
        </div>
    </div>
</div>
