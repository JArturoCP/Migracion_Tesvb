@extends('layouts.app')
@section('title', 'PIASE Estudiante')
@section('content')

    <style>
        .piase-student-wrap { padding: 15px; }
        .piase-title { margin-top: 0; font-weight: 700; color: #0f4c81; }
        .piase-subtitle { color: #666; margin-bottom: 15px; }
        .piase-card { border: 1px solid #d8e6f3; border-radius: 10px; background: #fff; margin-bottom: 15px; box-shadow: 0 2px 6px rgba(0,0,0,.04); }
        .piase-card-head { background: #eaf4ff; border-bottom: 1px solid #d8e6f3; border-radius: 10px 10px 0 0; padding: 10px 12px; color: #0f4c81; font-weight: 700; }
        .piase-card-body { padding: 12px; }
        .piase-badge { display: inline-block; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 700; margin: 2px; }
        .piase-badge-blue { background: #e1f0ff; color: #0f4c81; border: 1px solid #b8daf5; }
        .piase-badge-green { background: #e6f6ea; color: #287b3f; border: 1px solid #bfe8ca; }
        .piase-badge-orange { background: #fff3df; color: #9a5a00; border: 1px solid #ffdca3; }
        .piase-badge-red { background: #fde8e8; color: #a94442; border: 1px solid #f5bcbc; }
        .piase-search { margin-bottom: 12px; }
        .piase-agenda { display: flex; gap: 12px; align-items: stretch; flex-wrap: wrap; }
        .piase-date-box { width: 88px; min-width: 88px; background: #0f75bc; color: #fff; border-radius: 10px; text-align: center; overflow: hidden; }
        .piase-date-month { background: rgba(0,0,0,.18); padding: 4px; font-weight: 700; font-size: 12px; text-transform: uppercase; }
        .piase-date-day { font-size: 30px; font-weight: 800; line-height: 38px; }
        .piase-date-year { font-size: 12px; padding-bottom: 6px; }
        .piase-agenda-info { flex: 1; min-width: 220px; }
        .piase-hour { font-size: 16px; font-weight: 700; color: #0f4c81; }
        .piase-student-activities { max-width: 980px; margin: 0 auto; }
        .piase-student-activities .piase-activity-card { width: 100%; }
        .piase-student-activities .piase-upload { margin-top: 14px; }
        .piase-area-heading { background:#eaf4ff; border:1px solid #d8e6f3; border-left:5px solid #0f75bc; border-radius:8px; padding:10px 14px; margin:18px 0 12px; color:#0f4c81; font-size:16px; font-weight:700; }
        .piase-area-count { font-size:12px; color:#555; font-weight:400; margin-left:8px; }
        .piase-evidence-status { padding:11px 13px; margin-top:12px; border-radius:8px; font-weight:600; }
        .piase-student-feedback { border: 1px solid #cce5d3; background: #f3fbf5; border-radius: 8px; padding: 12px; margin-top: 10px; }
        .piase-student-evidence { border: 1px solid #cfe3f6; background: #f7fbff; border-radius: 8px; padding: 12px; margin-top: 12px; overflow-wrap: anywhere; }
        @media (max-width: 767px) { .piase-student-wrap { padding: 10px; } .piase-student-activities { max-width: 100%; } .piase-student-activities .piase-card-body { padding: 10px; } }
        .piase-activity { border-left: 5px solid #2f80c0; padding-left: 12px; }
        .piase-upload { background: #f8fbff; border: 1px dashed #a9cce8; border-radius: 8px; padding: 10px; margin-top: 10px; }
        .piase-stars { color: #f0ad4e; font-size: 18px; letter-spacing: 1px; }
        .piase-muted { color: #777; }
        .piase-route { position: relative; padding: 10px 0; }
        .piase-route-item { position: relative; margin-left: 28px; padding: 0 0 18px 22px; border-left: 3px solid #6bb6e8; }
        .piase-route-item:last-child { border-left-color: transparent; }
        .piase-route-dot { position: absolute; left: -11px; top: 0; width: 20px; height: 20px; background: #0f75bc; border-radius: 50%; border: 3px solid #d9efff; }
        .piase-route-box { background: #f3f9ff; border: 1px solid #d7ebfb; border-radius: 8px; padding: 10px; }
        .piase-table-compact > tbody > tr > td, .piase-table-compact > thead > tr > th { padding: 6px 8px; vertical-align: middle; }
        .piase-focus { animation: piasePulse 2s ease-in-out 1; border-color: #0f75bc !important; box-shadow: 0 0 0 3px rgba(15,117,188,.18); }
        @keyframes piasePulse { 0% { box-shadow: 0 0 0 0 rgba(15,117,188,.35); } 100% { box-shadow: 0 0 0 6px rgba(15,117,188,0); } }
    </style>

    <div class="piase-student-wrap">
        <h3 class="piase-title"><span class="glyphicon glyphicon-education"></span> PIASE - Seguimiento del estudiante</h3>
        <p class="piase-subtitle">Consulta tus citas, actividades asignadas, evidencias y observaciones realizadas por el responsable.</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if(!$permitido)
            <div class="alert alert-warning">{{ $mensaje }}</div>
        @else
            @if($mensaje)
                <div class="alert alert-info">{{ $mensaje }}</div>
            @endif
            <div class="row">
                <div class="col-md-8">
                    <div class="piase-card">
                        <div class="piase-card-head">Datos del estudiante</div>
                        <div class="piase-card-body">
                            <strong>{{ $alumno->nombre }} {{ $alumno->apaterno }} {{ $alumno->amaterno }}</strong><br>
                            <span class="piase-muted">Cuenta:</span> {{ $alumno->cuenta }}
                            <span class="piase-muted" style="margin-left:10px;">Carrera:</span> {{ $alumno->carrera }}
                            <span class="piase-muted" style="margin-left:10px;">Semestre:</span> {{ $alumno->id_semestre }}
                            <button type="button" class="btn btn-info btn-xs pull-right" data-toggle="modal" data-target="#modalRutaPiase">
                                <span class="glyphicon glyphicon-road"></span> Ver ruta PIASE
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="piase-card">
                        <div class="piase-card-head">Periodo académico vigente</div>
                        <div class="piase-card-body">
                            <strong>{{ $periodoSeleccionado ? $periodoSeleccionado->periodo : 'Sin periodo vigente' }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs" role="tablist" id="piaseStudentTabs">
                <li role="presentation" class="{{ $tabActivo == 'tab-actividades' ? 'active' : '' }}">
                    <a href="#tab-actividades" aria-controls="tab-actividades" role="tab" data-toggle="tab">Actividades asignadas</a>
                </li>
                <li role="presentation" class="{{ $tabActivo == 'tab-citas' ? 'active' : '' }}">
                    <a href="#tab-citas" aria-controls="tab-citas" role="tab" data-toggle="tab">Citas</a>
                </li>
                <li role="presentation" class="{{ $tabActivo == 'tab-ruta' ? 'active' : '' }}">
                    <a href="#tab-ruta" aria-controls="tab-ruta" role="tab" data-toggle="tab">Ruta de atención</a>
                </li>
            </ul>

            <div class="tab-content" style="padding-top:15px;">
                <div role="tabpanel" class="tab-pane {{ $tabActivo == 'tab-actividades' ? 'active' : '' }}" id="tab-actividades">
                    <div class="piase-student-activities">
                        <input type="text" class="form-control piase-search" data-filter-target=".piase-activity-card" placeholder="Buscar actividad, área, responsable, estado, fecha u observaciones...">

                        @php
                            $actividadesPorArea = $actividades->groupBy(function ($actividadItem) {
                                return trim((string) $actividadItem->area_atencion) !== '' ? trim((string) $actividadItem->area_atencion) : 'Área no especificada';
                            });
                        @endphp
                        @forelse($actividadesPorArea as $nombreArea => $actividadesArea)
                            <div class="piase-area-group">
                                <div class="piase-area-heading"><span class="glyphicon glyphicon-folder-open"></span> {{ $nombreArea }} <span class="piase-area-count">{{ $actividadesArea->count() }} {{ $actividadesArea->count() == 1 ? 'actividad' : 'actividades' }}</span></div>
                                @foreach($actividadesArea as $actividad)
                                        <?php
                                        $estadoActividad = strtolower(trim($actividad->estado));
                                        $tieneEvidencia = !empty($actividad->id_ar_entrega);
                                        $tieneRevision = !empty($actividad->id_ar_revision);
                                        $evidenciaBloqueada = $tieneEvidencia || $tieneRevision;
                                        $tituloActividad = $actividad->titulo ? $actividad->titulo : $actividad->actividad_catalogo;
                                        $focusId = 'actividad-' . $actividad->id_ar_actividad;
                                        ?>
                                    <div class="piase-card piase-activity-card {{ $focusActivo == $focusId ? 'piase-focus' : '' }}" id="{{ $focusId }}" data-search="{{ strtolower($tituloActividad.' '.$actividad->categoria_actividad.' '.$actividad->area_atencion.' '.$actividad->responsable_asigna.' '.$actividad->estado.' '.$actividad->fecha_asignacion.' '.$actividad->fecha_limite.' '.$actividad->comentarios.' '.$actividad->recomendaciones) }}">
                                        <div class="piase-card-head">
                                            <span class="glyphicon glyphicon-tasks"></span> {{ $tituloActividad }}

                                        </div>
                                        <div class="piase-card-body piase-activity">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <span class="piase-badge piase-badge-blue">{{ $actividad->categoria_actividad ? $actividad->categoria_actividad : 'Sin categoría' }}</span>
                                                    <span class="piase-badge {{ $tieneEvidencia ? 'piase-badge-green' : 'piase-badge-orange' }}">
                                        {{ $tieneRevision ? 'Actividad calificada' : ($tieneEvidencia ? 'Evidencia enviada' : 'Evidencia pendiente') }}
                                    </span>
                                                    <span class="piase-badge piase-badge-blue">Estado: {{ ucfirst(str_replace('_', ' ', $actividad->estado)) }}</span>
                                                    <p style="margin-top:8px;">{{ $actividad->descripcion }}</p>
                                                    <div><strong>Área:</strong> {{ $actividad->area_atencion ? $actividad->area_atencion : 'No especificada' }}</div>
                                                    <div><strong>Responsable:</strong> {{ $actividad->responsable_asigna ? $actividad->responsable_asigna : 'No especificado' }}</div>
                                                    <div><strong>Asignada:</strong> {{ $actividad->fecha_asignacion ? date('d/m/Y H:i', strtotime($actividad->fecha_asignacion)) : '-' }}</div>
                                                    <div><strong>Fecha límite:</strong> {{ $actividad->fecha_limite ? date('d/m/Y', strtotime($actividad->fecha_limite)) : 'Sin fecha límite' }}</div>
                                                    @if($actividad->id_ar_cita)
                                                        <div><strong>Sesión:</strong> {{ $actividad->fecha_cita ? date('d/m/Y', strtotime($actividad->fecha_cita)) : '-' }} {{ $actividad->hora_inicio_cita ? substr($actividad->hora_inicio_cita, 0, 5) : '' }} - {{ $actividad->hora_fin_cita ? substr($actividad->hora_fin_cita, 0, 5) : '' }}</div>
                                                    @endif
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="piase-student-evidence">
                                                        <strong><span class="glyphicon glyphicon-paperclip"></span> Evidencia de esta actividad</strong>
                                                        @if($tieneEvidencia)
                                                            <div style="margin-top:8px;">
                                                                @if($actividad->ruta_archivo)
                                                                    <a href="{{ asset($actividad->ruta_archivo) }}" target="_blank" rel="noopener noreferrer">Ver archivo entregado</a><br>
                                                                @endif
                                                                @if($actividad->texto_evidencia)
                                                                    <div><strong>Descripción:</strong> {{ $actividad->texto_evidencia }}</div>
                                                                @endif
                                                                <small class="piase-muted">Entregada: {{ $actividad->fecha_entrega ? date('d/m/Y H:i', strtotime($actividad->fecha_entrega)) : '-' }}</small>
                                                            </div>
                                                        @else
                                                            <p class="piase-muted" style="margin:8px 0 0;">Todavía no has enviado evidencia para esta actividad.</p>
                                                        @endif
                                                    </div>
                                                    <div class="piase-student-feedback">
                                                        <strong><span class="glyphicon glyphicon-star"></span> Calificación y observaciones de la actividad</strong>
                                                        @if($tieneRevision)
                                                            <div style="margin-top:8px;">
                                                                <strong>Calificación:</strong>
                                                                @if($actividad->calificacion_estrellas)
                                                                    <span class="piase-stars" aria-label="{{ (int)$actividad->calificacion_estrellas }} de 5 estrellas">
                                                        @for($i=1; $i<=5; $i++){{ $i <= $actividad->calificacion_estrellas ? '★' : '☆' }}@endfor
                                                    </span>
                                                                    ({{ (int)$actividad->calificacion_estrellas }}/5)
                                                                @else
                                                                    Pendiente
                                                                @endif
                                                            </div>
                                                            <div><strong>Estado de revisión:</strong> {{ $actividad->estado_revision ? ucfirst(str_replace('_', ' ', $actividad->estado_revision)) : 'Sin estado' }}</div>
                                                            @if($actividad->comentarios)
                                                                <div style="margin-top:7px;"><strong>Observaciones del responsable:</strong> {{ $actividad->comentarios }}</div>
                                                            @endif
                                                            @if($actividad->recomendaciones)
                                                                <div style="margin-top:7px;"><strong>Recomendaciones:</strong> {{ $actividad->recomendaciones }}</div>
                                                            @endif
                                                            @if(!$actividad->comentarios && !$actividad->recomendaciones)
                                                                <div class="piase-muted" style="margin-top:7px;">No se han registrado observaciones para esta actividad.</div>
                                                            @endif
                                                        @else
                                                            <p class="piase-muted" style="margin:8px 0 0;">La actividad aún no ha sido evaluada.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            @if($evidenciaBloqueada)
                                                <div class="piase-evidence-status alert {{ $tieneRevision ? 'alert-success' : 'alert-info' }}" role="status">
                                                    <span class="glyphicon {{ $tieneRevision ? 'glyphicon-ok-sign' : 'glyphicon-send' }}"></span>
                                                    {{ $tieneRevision ? 'Actividad calificada. La evidencia ya no puede modificarse.' : 'Evidencia enviada. Está pendiente de revisión y ya no se permiten nuevas entregas.' }}
                                                </div>
                                            @else
                                                <div class="piase-upload">
                                                    <form method="POST" action="{{ route('piase.estudiante.evidencia.subir') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id_ar_actividad" value="{{ $actividad->id_ar_actividad }}">
                                                        <input type="hidden" name="id_periodo" value="{{ $periodoSeleccionado ? $periodoSeleccionado->id_periodo : '' }}">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <label>Archivo de evidencia</label>
                                                                <input type="file" name="evidencia" class="form-control">
                                                            </div>
                                                            <div class="col-md-5">
                                                                <label>Descripción de evidencia</label>
                                                                <textarea name="texto_evidencia" class="form-control" rows="2" placeholder="Describe brevemente lo que entregas...">{{ $actividad->texto_evidencia }}</textarea>
                                                            </div>
                                                            <div class="col-md-2" style="padding-top:25px;">
                                                                <button type="submit" class="btn btn-primary btn-block">
                                                                    <span class="glyphicon glyphicon-upload"></span> Subir
                                                                </button>
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
                            <div class="alert alert-info">No tienes actividades asignadas en este periodo.</div>
                        @endforelse
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane {{ $tabActivo == 'tab-citas' ? 'active' : '' }}" id="tab-citas">
                    <input type="text" class="form-control piase-search" data-filter-target=".piase-cita-card" placeholder="Buscar cita, área, responsable, estado, fecha u horario...">

                    @forelse($citas as $cita)
                            <?php
                            $fecha = $cita->fecha_cita ? strtotime($cita->fecha_cita) : null;
                            $estadoCita = strtolower(trim($cita->estado));
                            $badgeClass = $estadoCita == 'cancelada' || $estadoCita == 'cancelado' ? 'piase-badge-red' : ($estadoCita == 'atendida' ? 'piase-badge-green' : 'piase-badge-blue');
                            ?>
                        <div class="piase-card piase-cita-card" data-search="{{ strtolower($cita->area_atencion.' '.$cita->responsable.' '.$cita->estado.' '.$cita->fecha_cita.' '.$cita->hora_inicio_cita.' '.$cita->hora_fin_cita.' '.$cita->lugar) }}">
                            <div class="piase-card-body">
                                <div class="piase-agenda">
                                    <div class="piase-date-box">
                                        <div class="piase-date-month">{{ $fecha ? strtoupper(date('M', $fecha)) : 'SIN' }}</div>
                                        <div class="piase-date-day">{{ $fecha ? date('d', $fecha) : '--' }}</div>
                                        <div class="piase-date-year">{{ $fecha ? date('Y', $fecha) : 'FECHA' }}</div>
                                    </div>
                                    <div class="piase-agenda-info">
                                        <div class="piase-hour">
                                            {{ $cita->hora_inicio_cita ? substr($cita->hora_inicio_cita, 0, 5) : '--:--' }} - {{ $cita->hora_fin_cita ? substr($cita->hora_fin_cita, 0, 5) : '--:--' }}
                                            <span class="piase-badge {{ $badgeClass }}">{{ ucfirst(str_replace('_', ' ', $cita->estado)) }}</span>
                                        </div>
                                        <div><strong>Área:</strong> {{ $cita->area_atencion ? $cita->area_atencion : 'No especificada' }}</div>
                                        <div><strong>Responsable:</strong> {{ $cita->responsable ? $cita->responsable : 'No especificado' }}</div>
                                        <div><strong>Lugar:</strong> {{ $cita->lugar ? $cita->lugar : 'No especificado' }}</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info">No tienes citas registradas en este periodo.</div>
                    @endforelse
                </div>

                <div role="tabpanel" class="tab-pane {{ $tabActivo == 'tab-ruta' ? 'active' : '' }}" id="tab-ruta">
                    <div class="piase-card">
                        <div class="piase-card-head">Ruta de atención</div>
                        <div class="piase-card-body">
                            @if($ruta->count() == 0)
                                <div class="alert alert-info">No hay canalizaciones registradas para mostrar la ruta.</div>
                            @else
                                <div class="piase-route">
                                    @foreach($ruta as $index => $item)
                                        <div class="piase-route-item">
                                            <div class="piase-route-dot"></div>
                                            <div class="piase-route-box">
                                                <strong>{{ $index + 1 }}. {{ $item->area_destino ? $item->area_destino : 'Área de atención' }}</strong><br>
                                                <span class="piase-muted">Fecha:</span> {{ $item->fecha_canalizacion ? date('d/m/Y H:i', strtotime($item->fecha_canalizacion)) : '-' }}<br>
                                                <span class="piase-muted">Responsable:</span> {{ $item->responsable_destino ? $item->responsable_destino : 'No especificado' }}<br>
                                                <span class="piase-badge piase-badge-blue">{{ ucfirst(str_replace('_', ' ', $item->estado)) }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalRutaPiase" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Ruta PIASE del estudiante</h4>
                        </div>
                        <div class="modal-body">
                            @if($ruta->count() == 0)
                                <div class="alert alert-info">No hay ruta registrada.</div>
                            @else
                                <div class="piase-route">
                                    @foreach($ruta as $index => $item)
                                        <div class="piase-route-item">
                                            <div class="piase-route-dot"></div>
                                            <div class="piase-route-box">
                                                <strong>{{ $index + 1 }}. {{ $item->area_destino ? $item->area_destino : 'Área de atención' }}</strong><br>
                                                <span class="piase-muted">{{ $item->fecha_canalizacion ? date('d/m/Y H:i', strtotime($item->fecha_canalizacion)) : '-' }}</span><br>
                                                Responsable: {{ $item->responsable_destino ? $item->responsable_destino : 'No especificado' }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
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
