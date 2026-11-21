@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="panel-title text-center">Seguimiento Auditorías Anteriores</h2>
            </div>
        </div>

        @if($acciones->isEmpty())
            <div class="alert alert-info">No hay acciones en seguimiento para mostrar.</div>
        @else
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                <tr>
                    <th>Clave</th>
                    <th>Punto / Proceso</th>
                    <th>Observaciones</th>
                    <th>Análisis de Datos (Técnica estadística utilizada)</th>
                    <th>Corrección</th>
                    <th>Accción Correctiva</th>
                    <th>Actualización de riesgos y oportunidades</th>
                    <th>Cambios al sistema de gestión para organizaciones educativas</th>
                    <th>Auditor Responsable</th>
                    <th>Estado</th>
                    <th>Acciones y Correcciones</th>
                    {{--<th>Evaluar</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($acciones as $accion)
                    <tr>
                        <td>{{ $accion->clave_nota ?? 'Sin registro' }}</td>
                        <td>{{ $accion->punto_proceso ?? 'Sin registro' }}</td>
                        <td>{{ $accion->observaciones ?? 'Sin registro' }}</td>
                        <td>
                            @if($accion->analisis)
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalAnalisis{{ $accion->id_responsable }}" title="Ver análisis">
                                    <i class="glyphicon glyphicon-eye-open"></i>
                                </button>
                            @else
                                <span class="text-muted">Sin registro</span>
                            @endif
                        </td>
                        <td>{{ $accion->causa_raiz ?? 'Sin corrección' }}</td>
                        <td>{{ $accion->accion_correctiva ?? 'Sin Actividad correctiva' }}</td>
                        <td>
                            {{ $accion->valor_actr ?? 'Sin registro' }}
                        </td>
                        <td>
                            {{ $accion->valor_cambios ?? 'Sin registro' }}
                        </td>
                        <td>{{ $accion->auditor_nombre ?? 'Sin registro' }}
                            @if($esLider)
                                <button class="btn btn-warning btn-xs"
                                        data-toggle="modal"
                                        data-target="#modalEditarAuditor{{ $accion->id_agenda_auditor }}">
                                    Editar
                                </button>
                            @endif
                        </td>
                        {{--<td>
                            @php
                                $estado = $accion->estado;
                                if ($estado == 4) {
                                    $estadoTexto = 'Aceptado';
                                } elseif ($estado == 5) {
                                    $estadoTexto = 'Rechazado';
                                } else {
                                    $estadoTexto = 'En proceso de revisión';
                                }
                            @endphp
                            {{ $estadoTexto }}
                        </td>--}}
                        <td>
                            @php
                                $estado = $accion->estado;
                                $todasAceptadas = $accion->todas_aceptadas ?? 0;

                                if ($estado == 4 && $todasAceptadas == 1) {
                                    $estadoTexto = 'Aceptado';
                                } elseif ($estado == 5) {
                                    $estadoTexto = 'Rechazado';
                                } else {
                                    $estadoTexto = 'En proceso de revisión';
                                }
                            @endphp

                            {{ $estadoTexto }}
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalDetalle{{ $accion->id_responsable }}">
                                Ver detalles
                            </button>
                        </td>
                        {{--<td>
                            <form action="{{ route('acciones.evaluar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_responsable" value="{{ $accion->id_responsable }}">
                                <select name="estado" required>
                                    <option value="">-- Seleccionar --</option>
                                    <option value="4" {{ $accion->estado == 4 ? 'selected' : '' }}>Aceptar</option>
                                    <option value="5" {{ $accion->estado == 5 ? 'selected' : '' }}>Rechazar</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-success">Evaluar</button>
                            </form>
                        </td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Movemos los modales fuera de la tabla -->
            @foreach($acciones as $accion)
                @php
                    $planAcciones = DB::table('aud_plan_acciones')
                        ->where('id_responsable', $accion->id_responsable)
                        ->whereNull('deleted_at')
                        ->get();

                    // AGRUPACIÓN POR TIPO
                    $accionesCorrectivas = $planAcciones->where('tipo', 1);
                    $correcciones        = $planAcciones->where('tipo', 2);
                    $accionesOM          = $planAcciones->where('tipo', 3);
                @endphp

                <div class="modal fade" id="modalDetalle{{ $accion->id_responsable }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $accion->id_responsable }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel{{ $accion->id_responsable }}">Actividades y Correcciones - Nota {{ $accion->clave_nota }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if($planAcciones->isEmpty())
                                    <div class="alert alert-info">No hay acciones ni correcciones registradas.</div>
                                @else
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Acción / Corrección</th>
                                            <th>Responsable de Implantar</th>
                                            <th>Fecha de Implantación</th>
                                            <th>Responsable de Revisar</th>
                                            <th>Fecha de Verificación</th>
                                            <th>Observaciones</th>
                                            <th>Estado</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {{-- ACCIONES CORRECTIVAS (tipo 1) --}}
                                        @if($accionesCorrectivas->count() > 0)
                                            <tr class="table-primary">
                                                <td colspan="7"><strong style="color:blue;">Acciones Correctivas NC</strong></td>
                                            </tr>

                                            @foreach($accionesCorrectivas as $plan)
                                                @php
                                                    $implantador = \DB::table('gnral_personales')->where('id_personal', $plan->id_responsable_implantar)->value('nombre');
                                                    $revisor     = \DB::table('gnral_personales')->where('id_personal', $plan->id_responsable_revisar)->value('nombre');
                                                    $estado = $plan->estado == 1 ? 'Aceptado' : ($plan->estado == 2 ? 'Rechazado' : 'En proceso de revisión');
                                                @endphp

                                                <tr>
                                                    <td>{{ $plan->acciones ?? 'Sin descripción' }}</td>
                                                    <td>{{ $implantador ?? 'Sin responsable' }}</td>
                                                    <td>{{ $plan->fecha_implantar_accion ?? 'Sin fecha' }}</td>
                                                    <td>{{ $revisor ?? 'Sin responsable' }}</td>
                                                    <td>{{ $plan->fecha_verificacion ?? 'Sin fecha' }}</td>
                                                    <td>{{ $plan->observaciones ?? 'Sin observaciones' }}</td>
                                                    <td>{{ $estado }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        {{-- CORRECCIONES (tipo 2) --}}
                                        @if($correcciones->count() > 0)
                                            <tr class="table-warning">
                                                <td colspan="7"><strong style="color:blue;">Correcciones NC</strong></td>
                                            </tr>

                                            @foreach($correcciones as $plan)
                                                @php
                                                    $implantador = \DB::table('gnral_personales')->where('id_personal', $plan->id_responsable_implantar)->value('nombre');
                                                    $revisor     = \DB::table('gnral_personales')->where('id_personal', $plan->id_responsable_revisar)->value('nombre');
                                                    $estado = $plan->estado == 1 ? 'Aceptado' : ($plan->estado == 2 ? 'Rechazado' : 'En proceso de revisión');
                                                @endphp

                                                <tr>
                                                    <td>{{ $plan->acciones ?? 'Sin descripción' }}</td>
                                                    <td>{{ $implantador ?? 'Sin responsable' }}</td>
                                                    <td>{{ $plan->fecha_implantar_accion ?? 'Sin fecha' }}</td>
                                                    <td>{{ $revisor ?? 'Sin responsable' }}</td>
                                                    <td>{{ $plan->fecha_verificacion ?? 'Sin fecha' }}</td>
                                                    <td>{{ $plan->observaciones ?? 'Sin observaciones' }}</td>
                                                    <td>{{ $estado }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        {{-- ACCIONES DE OPORTUNIDAD DE MEJORA (tipo 3) --}}
                                        @if($accionesOM->count() > 0)
                                            <tr class="table-success">
                                                <td colspan="7"><strong style="color:blue;">Acciones Correctivas OM</strong></td>
                                            </tr>

                                            @foreach($accionesOM as $plan)
                                                @php
                                                    $implantador = \DB::table('gnral_personales')->where('id_personal', $plan->id_responsable_implantar)->value('nombre');
                                                    $revisor     = \DB::table('gnral_personales')->where('id_personal', $plan->id_responsable_revisar)->value('nombre');
                                                    $estado = $plan->estado == 1 ? 'Aceptado' : ($plan->estado == 2 ? 'Rechazado' : 'En proceso de revisión');
                                                @endphp

                                                <tr>
                                                    <td>{{ $plan->acciones ?? 'Sin descripción' }}</td>
                                                    <td>{{ $implantador ?? 'Sin responsable' }}</td>
                                                    <td>{{ $plan->fecha_implantar_accion ?? 'Sin fecha' }}</td>
                                                    <td>{{ $revisor ?? 'Sin responsable' }}</td>
                                                    <td>{{ $plan->fecha_verificacion ?? 'Sin fecha' }}</td>
                                                    <td>{{ $plan->observaciones ?? 'Sin observaciones' }}</td>
                                                    <td>{{ $estado }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        {{-- SI NO EXISTE NINGÚN TIPO DE REGISTRO --}}
                                        @if($accionesCorrectivas->count() == 0 && $correcciones->count() == 0 && $accionesOM->count() == 0)
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">No hay acciones registradas.</td>
                                            </tr>
                                        @endif

                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @foreach($acciones as $accion)
                @if($accion->analisis)
                    <div class="modal fade" id="modalAnalisis{{ $accion->id_responsable }}" tabindex="-1" role="dialog" aria-labelledby="labelAnalisis{{ $accion->id_responsable }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="labelAnalisis{{ $accion->id_responsable }}">Análisis de Datos</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>{!! nl2br(e($accion->analisis)) !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                    @if($esLider)
                        <div class="modal fade" id="modalEditarAuditor{{ $accion->id_agenda_auditor }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('auditorias.actualizar_responsable') }}">
                                    @csrf
                                    <input type="hidden" name="id_agenda_auditor" value="{{ $accion->id_agenda_auditor }}">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Editar Auditor Responsable</h4>
                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                        </div>

                                        <div class="modal-body">
                                            <label>Seleccionar auditor:</label>
                                            <select name="nuevo_responsable" class="form-control select2" required>
                                                <option value="">-- Seleccione --</option>
                                                @foreach($accion->auditores_permitidos as $aud)
                                                    <option value="{{ $aud->id_personal }}"
                                                            >
                                                        {{ $aud->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-success">Guardar Cambios</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
            @endforeach

        @endif
    </div>
@endsection