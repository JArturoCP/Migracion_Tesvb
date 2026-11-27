@extends('layouts.panel')
@section('title', 'Seguimiento del estudiante | PIASE')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="PIASE: seguimiento del estudiante" :migas="['PIASE' => null]" />
    <p class="tw:-mt-4 tw:mb-6 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">Consulta tus citas, actividades asignadas, evidencias y observaciones del responsable.</p>

    @if(session('success'))
        <x-panel.alerta tipo="exito" class="tw:mb-4">{{ session('success') }}</x-panel.alerta>
    @endif
    @if(session('error'))
        <x-panel.alerta tipo="error" class="tw:mb-4">{{ session('error') }}</x-panel.alerta>
    @endif
    @if($errors->any())
        <x-panel.alerta tipo="error" class="tw:mb-4">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </x-panel.alerta>
    @endif

    @if(!$permitido)
        <x-panel.alerta tipo="advertencia">{{ $mensaje }}</x-panel.alerta>
    @else
        @if($mensaje)
            <x-panel.alerta tipo="info" class="tw:mb-4">{{ $mensaje }}</x-panel.alerta>
        @endif

        <div class="tw:mb-6 tw:grid tw:grid-cols-1 tw:gap-4 tw:lg:grid-cols-3">
            <x-panel.tarjeta titulo="Datos del estudiante" class="tw:lg:col-span-2">
                <x-slot:acciones>
                    <x-panel.boton variante="contorno-primario" tamano="sm" data-toggle="modal" data-target="#modalRutaPiase">
                        <span class="fa fa-road" aria-hidden="true"></span> Ver ruta PIASE
                    </x-panel.boton>
                </x-slot:acciones>
                <p class="tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $alumno->nombre }} {{ $alumno->apaterno }} {{ $alumno->amaterno }}</p>
                <div class="tw:mt-2 tw:flex tw:flex-wrap tw:gap-x-6 tw:gap-y-1 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">
                    <span><span class="tw:text-gray-500 tw:dark:text-gray-400">Cuenta:</span> {{ $alumno->cuenta }}</span>
                    <span><span class="tw:text-gray-500 tw:dark:text-gray-400">Carrera:</span> {{ $alumno->carrera }}</span>
                    <span><span class="tw:text-gray-500 tw:dark:text-gray-400">Semestre:</span> {{ $alumno->id_semestre }}</span>
                </div>
            </x-panel.tarjeta>
            <x-panel.tarjeta titulo="Periodo académico vigente">
                <p class="tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $periodoSeleccionado ? $periodoSeleccionado->periodo : 'Sin periodo vigente' }}</p>
            </x-panel.tarjeta>
        </div>

        <x-panel.pestanas id="piaseStudentTabs" :items="[
            ['etiqueta' => 'Actividades asignadas', 'destino' => '#tab-actividades', 'activa' => $tabActivo == 'tab-actividades'],
            ['etiqueta' => 'Citas', 'destino' => '#tab-citas', 'activa' => $tabActivo == 'tab-citas'],
            ['etiqueta' => 'Ruta de atención', 'destino' => '#tab-ruta', 'activa' => $tabActivo == 'tab-ruta'],
        ]" />

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane {{ $tabActivo == 'tab-actividades' ? 'active' : '' }}" id="tab-actividades">
                <div class="tw:mx-auto tw:max-w-5xl">
                    <input type="text" class="piase-search tw:mb-4 tw:h-11 tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-white/90" data-filter-target=".piase-activity-card" placeholder="Buscar actividad, área, responsable, estado, fecha u observaciones...">

                    @php
                        $actividadesPorArea = $actividades->groupBy(function ($actividadItem) {
                            return trim((string) $actividadItem->area_atencion) !== '' ? trim((string) $actividadItem->area_atencion) : 'Área no especificada';
                        });
                    @endphp
                    @forelse($actividadesPorArea as $nombreArea => $actividadesArea)
                        <div class="piase-area-group">
                            <div class="tw:mt-5 tw:mb-3 tw:flex tw:flex-wrap tw:items-center tw:gap-2 tw:rounded-lg tw:border tw:border-l-4 tw:border-gray-200 tw:border-l-brand-500 tw:bg-brand-50 tw:px-4 tw:py-2.5 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:border-gray-800 tw:dark:border-l-brand-500 tw:dark:bg-brand-500/10 tw:dark:text-white/90">
                                <span class="fa fa-folder-open tw:text-brand-500" aria-hidden="true"></span> {{ $nombreArea }}
                                <span class="tw:text-xs tw:font-normal tw:text-gray-500 tw:dark:text-gray-400">{{ $actividadesArea->count() }} {{ $actividadesArea->count() == 1 ? 'actividad' : 'actividades' }}</span>
                            </div>
                            @foreach($actividadesArea as $actividad)
                                    <?php
                                    $estadoActividad = strtolower(trim($actividad->estado));
                                    $tieneEvidencia = !empty($actividad->id_ar_entrega);
                                    $tieneRevision = !empty($actividad->id_ar_revision);
                                    $evidenciaBloqueada = $tieneEvidencia || $tieneRevision;
                                    $tituloActividad = $actividad->titulo ? $actividad->titulo : $actividad->actividad_catalogo;
                                    $focusId = 'actividad-' . $actividad->id_ar_actividad;
                                    ?>
                                <div class="piase-activity-card tw:mb-4 tw:rounded-2xl tw:border tw:bg-white tw:dark:bg-white/[0.03] {{ $focusActivo == $focusId ? 'tw:border-brand-500 tw:ring-3 tw:ring-brand-500/20' : 'tw:border-gray-200 tw:dark:border-gray-800' }}" id="{{ $focusId }}" data-search="{{ strtolower($tituloActividad.' '.$actividad->categoria_actividad.' '.$actividad->area_atencion.' '.$actividad->responsable_asigna.' '.$actividad->estado.' '.$actividad->fecha_asignacion.' '.$actividad->fecha_limite.' '.$actividad->comentarios.' '.$actividad->recomendaciones) }}">
                                    <div class="tw:flex tw:items-center tw:gap-2 tw:border-b tw:border-gray-100 tw:px-5 tw:py-4 tw:text-base tw:font-medium tw:text-gray-800 tw:dark:border-gray-800 tw:dark:text-white/90">
                                        <span class="fa fa-tasks tw:text-brand-500" aria-hidden="true"></span> {{ $tituloActividad }}
                                    </div>
                                    <div class="tw:p-5">
                                        <div class="tw:flex tw:flex-wrap tw:gap-2">
                                            <x-panel.badge tono="marca">{{ $actividad->categoria_actividad ? $actividad->categoria_actividad : 'Sin categoría' }}</x-panel.badge>
                                            <x-panel.badge :tono="$tieneEvidencia ? 'exito' : 'advertencia'">
                                                {{ $tieneRevision ? 'Actividad calificada' : ($tieneEvidencia ? 'Evidencia enviada' : 'Evidencia pendiente') }}
                                            </x-panel.badge>
                                            <x-panel.badge tono="info">Estado: {{ ucfirst(str_replace('_', ' ', $actividad->estado)) }}</x-panel.badge>
                                        </div>
                                        <p class="tw:mt-3 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">{{ $actividad->descripcion }}</p>
                                        <dl class="tw:mt-3 tw:grid tw:grid-cols-1 tw:gap-x-6 tw:gap-y-1 tw:text-sm tw:text-gray-700 tw:sm:grid-cols-2 tw:dark:text-gray-300">
                                            <div><strong class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">Área:</strong> {{ $actividad->area_atencion ? $actividad->area_atencion : 'No especificada' }}</div>
                                            <div><strong class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">Responsable:</strong> {{ $actividad->responsable_asigna ? $actividad->responsable_asigna : 'No especificado' }}</div>
                                            <div><strong class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">Asignada:</strong> {{ $actividad->fecha_asignacion ? date('d/m/Y H:i', strtotime($actividad->fecha_asignacion)) : '-' }}</div>
                                            <div><strong class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">Fecha límite:</strong> {{ $actividad->fecha_limite ? date('d/m/Y', strtotime($actividad->fecha_limite)) : 'Sin fecha límite' }}</div>
                                            @if($actividad->id_ar_cita)
                                                <div><strong class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">Sesión:</strong> {{ $actividad->fecha_cita ? date('d/m/Y', strtotime($actividad->fecha_cita)) : '-' }} {{ $actividad->hora_inicio_cita ? substr($actividad->hora_inicio_cita, 0, 5) : '' }} - {{ $actividad->hora_fin_cita ? substr($actividad->hora_fin_cita, 0, 5) : '' }}</div>
                                            @endif
                                        </dl>

                                        <div class="tw:mt-4 tw:grid tw:grid-cols-1 tw:gap-3 tw:lg:grid-cols-2">
                                            <div class="tw:break-words tw:rounded-xl tw:border tw:border-sky-200 tw:bg-sky-50 tw:p-4 tw:text-sm tw:text-gray-700 tw:dark:border-sky-500/30 tw:dark:bg-sky-500/10 tw:dark:text-gray-300">
                                                <strong class="tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><span class="fa fa-paperclip" aria-hidden="true"></span> Evidencia de esta actividad</strong>
                                                @if($tieneEvidencia)
                                                    <div class="tw:mt-2 tw:space-y-1">
                                                        @if($actividad->ruta_archivo)
                                                            <div><a class="tw:font-medium tw:text-brand-500 tw:hover:text-brand-600 tw:dark:text-brand-400" href="{{ asset($actividad->ruta_archivo) }}" target="_blank" rel="noopener noreferrer">Ver archivo entregado</a></div>
                                                        @endif
                                                        @if($actividad->texto_evidencia)
                                                            <div><strong class="tw:font-medium">Descripción:</strong> {{ $actividad->texto_evidencia }}</div>
                                                        @endif
                                                        <small class="tw:text-xs tw:text-gray-500 tw:dark:text-gray-400">Entregada: {{ $actividad->fecha_entrega ? date('d/m/Y H:i', strtotime($actividad->fecha_entrega)) : '-' }}</small>
                                                    </div>
                                                @else
                                                    <p class="tw:mt-2 tw:text-gray-500 tw:dark:text-gray-400">Todavía no has enviado evidencia para esta actividad.</p>
                                                @endif
                                            </div>
                                            <div class="tw:rounded-xl tw:border tw:border-green-200 tw:bg-green-50 tw:p-4 tw:text-sm tw:text-gray-700 tw:dark:border-green-500/30 tw:dark:bg-green-500/10 tw:dark:text-gray-300">
                                                <strong class="tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><span class="fa fa-star" aria-hidden="true"></span> Calificación y observaciones de la actividad</strong>
                                                @if($tieneRevision)
                                                    <div class="tw:mt-2">
                                                        <strong class="tw:font-medium">Calificación:</strong>
                                                        @if($actividad->calificacion_estrellas)
                                                            <span class="tw:text-lg tw:tracking-wide tw:text-amber-400" aria-label="{{ (int)$actividad->calificacion_estrellas }} de 5 estrellas">@for($i=1; $i<=5; $i++){{ $i <= $actividad->calificacion_estrellas ? '★' : '☆' }}@endfor</span>
                                                            ({{ (int)$actividad->calificacion_estrellas }}/5)
                                                        @else
                                                            Pendiente
                                                        @endif
                                                    </div>
                                                    <div><strong class="tw:font-medium">Estado de revisión:</strong> {{ $actividad->estado_revision ? ucfirst(str_replace('_', ' ', $actividad->estado_revision)) : 'Sin estado' }}</div>
                                                    @if($actividad->comentarios)
                                                        <div class="tw:mt-2"><strong class="tw:font-medium">Observaciones del responsable:</strong> {{ $actividad->comentarios }}</div>
                                                    @endif
                                                    @if($actividad->recomendaciones)
                                                        <div class="tw:mt-2"><strong class="tw:font-medium">Recomendaciones:</strong> {{ $actividad->recomendaciones }}</div>
                                                    @endif
                                                    @if(!$actividad->comentarios && !$actividad->recomendaciones)
                                                        <div class="tw:mt-2 tw:text-gray-500 tw:dark:text-gray-400">No se han registrado observaciones para esta actividad.</div>
                                                    @endif
                                                @else
                                                    <p class="tw:mt-2 tw:text-gray-500 tw:dark:text-gray-400">La actividad aún no ha sido evaluada.</p>
                                                @endif
                                            </div>
                                        </div>

                                        @if($evidenciaBloqueada)
                                            <x-panel.alerta :tipo="$tieneRevision ? 'exito' : 'info'" role="status" class="tw:mt-4">
                                                <span class="fa {{ $tieneRevision ? 'fa-check-circle' : 'fa-paper-plane' }}" aria-hidden="true"></span>
                                                {{ $tieneRevision ? 'Actividad calificada. La evidencia ya no puede modificarse.' : 'Evidencia enviada. Está pendiente de revisión y ya no se permiten nuevas entregas.' }}
                                            </x-panel.alerta>
                                        @else
                                            <div class="tw:mt-4 tw:rounded-xl tw:border tw:border-dashed tw:border-brand-300 tw:bg-brand-50/50 tw:p-4 tw:dark:border-brand-500/40 tw:dark:bg-brand-500/5">
                                                <form method="POST" action="{{ route('piase.estudiante.evidencia.subir') }}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id_ar_actividad" value="{{ $actividad->id_ar_actividad }}">
                                                    <input type="hidden" name="id_periodo" value="{{ $periodoSeleccionado ? $periodoSeleccionado->id_periodo : '' }}">
                                                    <div class="tw:grid tw:grid-cols-1 tw:items-end tw:gap-4 tw:md:grid-cols-12">
                                                        <div class="tw:md:col-span-5">
                                                            <x-panel.input etiqueta="Archivo de evidencia" type="file" name="evidencia" />
                                                        </div>
                                                        <div class="tw:md:col-span-5">
                                                            <x-panel.textarea etiqueta="Descripción de la evidencia" name="texto_evidencia" rows="2" placeholder="Describe brevemente lo que entregas...">{{ $actividad->texto_evidencia }}</x-panel.textarea>
                                                        </div>
                                                        <div class="tw:md:col-span-2">
                                                            <x-panel.boton type="submit" class="tw:w-full">
                                                                <span class="fa fa-upload" aria-hidden="true"></span> Subir
                                                            </x-panel.boton>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @empty
                        <x-panel.vacio titulo="Sin actividades" mensaje="No tienes actividades asignadas en este periodo." />
                    @endforelse
                </div>
            </div>

            <div role="tabpanel" class="tab-pane {{ $tabActivo == 'tab-citas' ? 'active' : '' }}" id="tab-citas">
                <input type="text" class="piase-search tw:mb-4 tw:h-11 tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:dark:border-gray-700 tw:dark:bg-gray-900 tw:dark:text-white/90" data-filter-target=".piase-cita-card" placeholder="Buscar cita, área, responsable, estado, fecha u horario...">

                @forelse($citas as $cita)
                        <?php
                        $fecha = $cita->fecha_cita ? strtotime($cita->fecha_cita) : null;
                        $estadoCita = strtolower(trim($cita->estado));
                        $tonoCita = $estadoCita == 'cancelada' || $estadoCita == 'cancelado' ? 'error' : ($estadoCita == 'atendida' ? 'exito' : 'marca');
                        ?>
                    <div class="piase-cita-card tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-4 tw:dark:border-gray-800 tw:dark:bg-white/[0.03]" data-search="{{ strtolower($cita->area_atencion.' '.$cita->responsable.' '.$cita->estado.' '.$cita->fecha_cita.' '.$cita->hora_inicio_cita.' '.$cita->hora_fin_cita.' '.$cita->lugar) }}">
                        <div class="tw:flex tw:flex-wrap tw:items-stretch tw:gap-4">
                            <div class="tw:w-22 tw:min-w-22 tw:overflow-hidden tw:rounded-xl tw:bg-brand-500 tw:text-center tw:text-white">
                                <div class="tw:bg-black/15 tw:p-1 tw:text-xs tw:font-semibold tw:uppercase">{{ $fecha ? strtoupper(date('M', $fecha)) : 'SIN' }}</div>
                                <div class="tw:text-3xl tw:leading-10 tw:font-bold">{{ $fecha ? date('d', $fecha) : '--' }}</div>
                                <div class="tw:pb-1.5 tw:text-xs">{{ $fecha ? date('Y', $fecha) : 'FECHA' }}</div>
                            </div>
                            <div class="tw:min-w-55 tw:flex-1 tw:space-y-1 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">
                                <div class="tw:flex tw:flex-wrap tw:items-center tw:gap-2 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                                    {{ $cita->hora_inicio_cita ? substr($cita->hora_inicio_cita, 0, 5) : '--:--' }} - {{ $cita->hora_fin_cita ? substr($cita->hora_fin_cita, 0, 5) : '--:--' }}
                                    <x-panel.badge :tono="$tonoCita">{{ ucfirst(str_replace('_', ' ', $cita->estado)) }}</x-panel.badge>
                                </div>
                                <div><strong class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">Área:</strong> {{ $cita->area_atencion ? $cita->area_atencion : 'No especificada' }}</div>
                                <div><strong class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">Responsable:</strong> {{ $cita->responsable ? $cita->responsable : 'No especificado' }}</div>
                                <div><strong class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">Lugar:</strong> {{ $cita->lugar ? $cita->lugar : 'No especificado' }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <x-panel.vacio titulo="Sin citas" mensaje="No tienes citas registradas en este periodo." />
                @endforelse
            </div>

            <div role="tabpanel" class="tab-pane {{ $tabActivo == 'tab-ruta' ? 'active' : '' }}" id="tab-ruta">
                <x-panel.tarjeta titulo="Ruta de atención">
                    @if($ruta->count() == 0)
                        <x-panel.vacio titulo="Sin ruta" mensaje="No hay canalizaciones registradas para mostrar la ruta." />
                    @else
                        <ol class="tw:relative tw:ml-3 tw:border-l-2 tw:border-brand-200 tw:dark:border-brand-500/30">
                            @foreach($ruta as $index => $item)
                                <li class="tw:relative tw:pb-5 tw:pl-6 tw:last:pb-0">
                                    <span class="tw:absolute tw:top-0 tw:-left-[11px] tw:size-5 tw:rounded-full tw:border-4 tw:border-brand-100 tw:bg-brand-500 tw:dark:border-brand-500/20" aria-hidden="true"></span>
                                    <div class="tw:rounded-xl tw:border tw:border-gray-200 tw:bg-gray-50 tw:p-3 tw:text-sm tw:text-gray-700 tw:dark:border-gray-800 tw:dark:bg-gray-900 tw:dark:text-gray-300">
                                        <strong class="tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $index + 1 }}. {{ $item->area_destino ? $item->area_destino : 'Área de atención' }}</strong>
                                        <div><span class="tw:text-gray-500 tw:dark:text-gray-400">Fecha:</span> {{ $item->fecha_canalizacion ? date('d/m/Y H:i', strtotime($item->fecha_canalizacion)) : '-' }}</div>
                                        <div><span class="tw:text-gray-500 tw:dark:text-gray-400">Responsable:</span> {{ $item->responsable_destino ? $item->responsable_destino : 'No especificado' }}</div>
                                        <x-panel.badge tono="marca" class="tw:mt-2">{{ ucfirst(str_replace('_', ' ', $item->estado)) }}</x-panel.badge>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    @endif
                </x-panel.tarjeta>
            </div>
        </div>

        <x-panel.modal id="modalRutaPiase" tamano="lg" sin-relleno clase-cerrar="close" aria-label="Ruta PIASE del estudiante">
            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Ruta PIASE del estudiante</h4>
            </div>
            <div class="tw-modal-cuerpo">
                @if($ruta->count() == 0)
                    <x-panel.alerta tipo="info">No hay ruta registrada.</x-panel.alerta>
                @else
                    <ol class="tw:relative tw:ml-3 tw:border-l-2 tw:border-brand-200 tw:dark:border-brand-500/30">
                        @foreach($ruta as $index => $item)
                            <li class="tw:relative tw:pb-5 tw:pl-6 tw:last:pb-0">
                                <span class="tw:absolute tw:top-0 tw:-left-[11px] tw:size-5 tw:rounded-full tw:border-4 tw:border-brand-100 tw:bg-brand-500 tw:dark:border-brand-500/20" aria-hidden="true"></span>
                                <div class="tw:rounded-xl tw:border tw:border-gray-200 tw:bg-gray-50 tw:p-3 tw:text-sm tw:text-gray-700 tw:dark:border-gray-800 tw:dark:bg-gray-900 tw:dark:text-gray-300">
                                    <strong class="tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $index + 1 }}. {{ $item->area_destino ? $item->area_destino : 'Área de atención' }}</strong>
                                    <div class="tw:text-gray-500 tw:dark:text-gray-400">{{ $item->fecha_canalizacion ? date('d/m/Y H:i', strtotime($item->fecha_canalizacion)) : '-' }}</div>
                                    <div>Responsable: {{ $item->responsable_destino ? $item->responsable_destino : 'No especificado' }}</div>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                @endif
            </div>
            <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                <x-panel.boton variante="secundario" data-dismiss="modal">Cerrar</x-panel.boton>
            </div>
        </x-panel.modal>
    @endif
</div>

<script>
    $(document).ready(function () {
        var tabActivo = '{{ $tabActivo }}';
        if (tabActivo) {
            $('#piaseStudentTabs a[href="#' + tabActivo + '"]').tab('show');
        }

        $('.piase-search').on('keyup', function () {
            var texto = $(this).val().toLowerCase();
            var target = $(this).data('filter-target');
            $(target).each(function () {
                var contenido = ($(this).data('search') || $(this).text()).toString().toLowerCase();
                $(this).toggle(contenido.indexOf(texto) !== -1);
            });
        });

        @if($focusActivo)
        var foco = $('#{{ $focusActivo }}');
        if (foco.length) {
            $('html, body').animate({ scrollTop: foco.offset().top - 90 }, 600);
        }
        @endif
    });
</script>
@endsection
