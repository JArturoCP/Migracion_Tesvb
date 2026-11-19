{{--
    Entrada "Inglés" del sidebar (M026 unidad 19, M227 alumno y M252 profesor de inglés).

    La primera vez que se muestra en la página es un módulo con submenú: "Inicio de Inglés" (el mismo
    enlace /ingles/ que tenía la entrada) y TODAS las opciones del menú propio del módulo de inglés
    (ingles/inicio_ingles/menu_ingles.blade.php), con sus mismas condiciones, en el mismo orden y con
    los mismos href. Si el usuario tiene más de una entrada "Inglés", las siguientes quedan como el
    enlace directo de siempre (así ninguna opción se repite).

    Del menú de inglés NO se copian aquí, porque ya están en el panel:
      - "Salir" (POST /logout)                → "Cerrar sesión" del header.
      - Insignia "Periodo de Ingles"           → botón "Periodo de Inglés" del header (partials/panel/periodo_ingles_header).
      - "Regresar" (/, si no es profesor)      → "Inicio" del sidebar.
      - Modal #modal_modificar_periodo         → ya está al final de partials/panel/sidebar.
--}}
@if(! $__env->hasRenderedOnce('panel-menu-ingles'))
@php $__env->markAsRenderedOnce('panel-menu-ingles'); @endphp
<?php
    // ingles/inicio_ingles/menu_ingles L5-8 y L58
    $unidad_ingles = Session::get('id_unidad_admin');
    $palumno_ingles = session()->has('palumno') ? session()->has('palumno') : false;
    $profesor_ingles_menu = session()->has('profesor_ingles') ? session()->has('profesor_ingles') : false;
?>
                        <li>
                            <a href="#" @click.prevent="selected = (selected === 'ingles' ? '' : 'ingles')" class="tw:group tw:menu-item" :class="selected === 'ingles' ? 'tw:menu-item-active' : 'tw:menu-item-inactive'" data-panel-modulo>
@include('partials.panel.iconos.paginas', ['clave' => 'ingles'])
<span class="tw:menu-item-text" :class="sidebarToggle ? 'tw:xl:hidden' : ''">Inglés</span>
@include('partials.panel.iconos.flecha', ['clave' => 'ingles'])
</a>
                            <div x-cloak x-show.important="$store.buscador.activo || selected === 'ingles'" x-collapse>
<ul :class="sidebarToggle ? 'tw:xl:hidden' : 'tw:flex'" class="tw:menu-dropdown tw:mt-2 tw:flex tw:animate-in tw:flex-col tw:gap-1 tw:pl-9 tw:duration-200 tw:fade-in-0 tw:slide-in-from-top-1">
                                <li><a href="{{url('/ingles/')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Inicio de Inglés</a></li>
                                {{-- menu_ingles L57-71 --}}
                                @if($profesor_ingles_menu==true)
                                <?php $id_usuario = Session::get('id_usuario');?>
                                <li x-data="{ abierto: false }">
                                    <a href="#" @click.prevent="abierto = !abierto" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-modulo>
<span>Datos P.</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                    <div x-cloak x-show.important="$store.buscador.activo || abierto" x-collapse>
<ul class="tw:mt-1 tw:flex tw:flex-col tw:gap-1 tw:border-l tw:border-gray-200 tw:pl-3 tw:dark:border-gray-800">
                                        <li><a href="/profesores_ingles/modificar/{{ $id_usuario }}/" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Editar</a></li>
                                    </ul>
</div>
                                </li>
                                @endif
                                {{-- menu_ingles L72-167 --}}
                                @if($unidad_ingles==19 )
                                <li><a href="{{url('/armar_plantilla/profesore_ingles')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Facilitadores de ingles</a></li>
                                <li x-data="{ abierto: false }">
                                    <a href="#" @click.prevent="abierto = !abierto" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-modulo>
<span>Horarios</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                    <div x-cloak x-show.important="$store.buscador.activo || abierto" x-collapse>
<ul class="tw:mt-1 tw:flex tw:flex-col tw:gap-1 tw:border-l tw:border-gray-200 tw:pl-3 tw:dark:border-gray-800">
                                        <li><a href="{{url('/agregar_profesor/ingles_periodo/')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Agregar plantilla al periodo</a></li>
                                        <li><a href="{{url('/ingles_horarios/agregar')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Armar horarios</a></li>
                                        <li><a href="{{url('/ingles/mostrar_horarios_profesores')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Horarios de los Facilitadores</a></li>
                                        <li><a href="{{url('/ingles/mostrar_horario_profesor_grupo/')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Horarios por grupo</a></li>
                                    </ul>
</div>
                                </li>
                                <li><a href="{{url('/ingles/mostrar_niveles')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Niveles</a></li>
                                <li><a href="{{url('/ingles_horarios/mostrar_grupo')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Grupos</a></li>
                                <li><a href="{{url('/ingles/mostrar_periodos')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Periodos intersemestrales</a></li>
                                <li><a href="{{url('/ingles/autorizacion_cargas/')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Cargas academicas</a></li>
                                <li x-data="{ abierto: false }">
                                    <a href="#" @click.prevent="abierto = !abierto" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-modulo>
<span>Calificaciones</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                    <div x-cloak x-show.important="$store.buscador.activo || abierto" x-collapse>
<ul class="tw:mt-1 tw:flex tw:flex-col tw:gap-1 tw:border-l tw:border-gray-200 tw:pl-3 tw:dark:border-gray-800">
                                        <li><a href="{{url('/ingles/profesores/calificaciones')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Calificaciones</a></li>
                                        <li><a href="{{url('/ingles/ver_cal_coordinador_ingles/')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Boleta de Calificaciones</a></li>
                                        <li><a href="{{url('/titulacion/ingles_carreras/')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Certificado de Acreditacion</a></li>
                                        <li><a href="{{url('/ingles/historial_academico_alumno/')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Historial de Calificaciones</a></li>
                                    </ul>
</div>
                                </li>
                                <li x-data="{ abierto: false }">
                                    <a href="#" @click.prevent="abierto = !abierto" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-modulo>
<span>Validación de Vouchers</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                    <div x-cloak x-show.important="$store.buscador.activo || abierto" x-collapse>
<ul class="tw:mt-1 tw:flex tw:flex-col tw:gap-1 tw:border-l tw:border-gray-200 tw:pl-3 tw:dark:border-gray-800">
                                        <li><a href="{{url('/ingles/vouchers_validacion')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Vouchers En Espera de validación</a></li>
                                        <li><a href="{{url('/ingles/vouchers_aceptados')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Vouchers Aceptados</a></li>
                                        <li><a href="{{url('/ingles/vouchers_rechazados')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Vouchers Rechazados</a></li>
                                        <li><a href="{{url('/ingles/maximo_grupo_alumnos')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Maximo de Estudiantes por Periodo</a></li>
                                        <li><a href="/ingles/control-escolar" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Examen Ubicacion</a></li>
                                    </ul>
</div>
                                </li>
                                <li x-data="{ abierto: false }">
                                    <a href="#" @click.prevent="abierto = !abierto" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-modulo>
<span>Desactivar grupos</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                    <div x-cloak x-show.important="$store.buscador.activo || abierto" x-collapse>
<ul class="tw:mt-1 tw:flex tw:flex-col tw:gap-1 tw:border-l tw:border-gray-200 tw:pl-3 tw:dark:border-gray-800">
                                        <li><a href="{{url('/ingles/desactivar_grupos/')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Desactivacion de grupos</a></li>
                                    </ul>
</div>
                                </li>
                                <li x-data="{ abierto: false }">
                                    <a href="#" @click.prevent="abierto = !abierto" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-modulo>
<span>Desempeño Academico</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                    <div x-cloak x-show.important="$store.buscador.activo || abierto" x-collapse>
<ul class="tw:mt-1 tw:flex tw:flex-col tw:gap-1 tw:border-l tw:border-gray-200 tw:pl-3 tw:dark:border-gray-800">
                                        <li><a href="{{ url('/ingles/desempeno_academico/niveles') }}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Programas Academicos</a></li>
                                        <li x-data="{ abierto: false }">
                                            <a href="#" @click.prevent="abierto = !abierto" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-modulo>
<span>Estadísticas</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                            <div x-cloak x-show.important="$store.buscador.activo || abierto" x-collapse>
<ul class="tw:mt-1 tw:flex tw:flex-col tw:gap-1 tw:border-l tw:border-gray-200 tw:pl-3 tw:dark:border-gray-800">
                                                <li><a href="{{url('/ingles/desempeno_academico/estadisticas_generales')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Estadisticas Trimestrales</a></li>
                                                <li><a href="{{ url('/ingles_estadistica/estadisticas_genero/') }}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Estadísticas Generales</a></li>
                                            </ul>
</div>
                                        </li>
                                    </ul>
</div>
                                </li>
                                @endif
                                {{-- menu_ingles L168-187 --}}
                                @if($palumno_ingles==true)
                                <li x-data="{ abierto: false }">
                                    <a href="#" @click.prevent="abierto = !abierto" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-modulo>
<span>Carga academica de ingles</span>
@include('partials.panel.iconos.flecha_subgrupo')
</a>
                                    <div x-cloak x-show.important="$store.buscador.activo || abierto" x-collapse>
<ul class="tw:mt-1 tw:flex tw:flex-col tw:gap-1 tw:border-l tw:border-gray-200 tw:pl-3 tw:dark:border-gray-800">
                                        <li><a href="{{url('/ingles_horarios/cargar_voucher_pago')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Cargar voucher de pago</a></li>
                                        <li><a href="{{url('/ingles_horarios/iniciar_carga_academica/')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Registrar carga academica de ingles</a></li>
                                        <li><a href="{{url('/ingles_horarios/revision_carga_academica/')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Ver carga academica de ingles</a></li>
                                        <li><a href="{{url('/ingles/ver_cal_alumno_ingles/')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Ver calificaciones de ingles</a></li>
                                    </ul>
</div>
                                </li>
                                @endif
                                {{-- menu_ingles L188-194 --}}
                                @if($profesor_ingles_menu==true)
                                <li><a href="{{url('/ingles/Calificaciones')}}" class="tw:group tw:menu-dropdown-item tw:menu-dropdown-item-inactive" data-panel-enlace>Calificaciones</a></li>
                                @endif
                            </ul>
</div>
                        </li>
@else
                        <li><a href="{{url('/ingles/')}}" class="tw:group tw:menu-item tw:menu-item-inactive" data-panel-enlace>
@include('partials.panel.iconos.paginas')
<span class="tw:menu-item-text" :class="sidebarToggle ? 'tw:xl:hidden' : ''">Inglés</span>
</a></li>
@endif
