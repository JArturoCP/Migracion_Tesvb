@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="panel-title text-center">Acciones Asignadas</h2>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                {{--<th>ID Acción</th>--}}
                <th>Nombre del Personal</th>
                <th>Requiere Acción</th>
                <th>Requiere Corrección</th>
                <th>Ver más detalles</th>
                <th>Ver Plan de Acciones</th>
                <th>Estado</th>
                <th>Evaluación</th>
            </tr>
            </thead>
            <tbody>
            @foreach($asignaciones as $a)
                <tr>
                    {{--<td>{{ $a->responsable->id_responsable }}</td>--}}
                    <td>{{ $a->personal->nombre ?? 'No disponible' }}</td>
                    <td>{{ $a->responsable->requiere_accion ? 'Sí' : 'No' }}</td>
                    <td>{{ $a->responsable->requiere_correccion ? 'Sí' : 'No' }}</td>
                    <td><!-- Botón para abrir el modal -->
                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal{{ $a->responsable->id_responsable }}">
                            Ver más detalles
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modal{{ $a->responsable->id_responsable }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $a->responsable->id_responsable }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel{{ $a->responsable->id_responsable }}">Detalles de la Acción</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Análisis:</strong> {{ $a->responsable->analisis ?? 'Sin Análisis'}}</p>
                                        <p><strong>Acción correctiva a realizar:</strong> {{ $a->responsable->accion_correctiva ?? 'Sin Acción correctiva'}}</p>
                                        <p><strong>Corrección a realizar:</strong> {{ $a->responsable->causa_raiz ?? 'Sin corrección'}}</p>
                                        <p><strong>Actualización de riesgos y oportunidades:</strong> {{ $a->responsable->actualizacion_riesgos ? 'Sí' : 'No' }}</p>
                                        <p><strong>¿Por qué?:</strong> {{ $a->responsable->valor_actr ?? 'Sin Valor ACTR'}}</p>
                                        <p><strong>Cambios al sistema de gestión para organizaciones educativas:</strong> {{ $a->responsable->cambios_sistema ? 'Sí' : 'No' }}</p>
                                        <p><strong>¿Por qué?:</strong> {{ $a->responsable->valor_cambios ?? 'Sin Valor Cambios'}}</p>
                                        {{--<p><strong>Observaciones:</strong> {{ $r->observaciones ?? 'Sin Observaciones por el momento'}}</p>--}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalDetalle{{ $a->responsable->id_responsable }}">
                            Ver Plan de Acciones
                        </button>
                        <!-- Movemos los modales fuera de la tabla -->
                        @foreach($asignaciones as $as)
                            @php
                                $planAcciones = DB::table('aud_plan_acciones')
                                    ->where('id_responsable', $as->id_responsable)
                                    ->whereNull('deleted_at')
                                    ->get();
                            @endphp

                            <div class="modal fade" id="modalDetalle{{ $as->id_responsable }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $as->id_responsable }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{ $a->id_responsable }}">Actividades y Correcciones</h5>
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
                                                        <th>Evidencia</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($planAcciones as $plan)
                                                        @php
                                                            $implantador = \DB::table('gnral_personales')->where('id_personal', $plan->id_responsable_implantar)->value('nombre');
                                                            $revisor = \DB::table('gnral_personales')->where('id_personal', $plan->id_responsable_revisar)->value('nombre');
                                                            $evidencia = \DB::table('aud_evidencias')->where('id_evidencia', $plan->id_evidencia)->value('descripcion');
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $plan->acciones ?? 'Sin descripción' }}</td>
                                                            <td>{{ $implantador ?? 'Sin responsable' }}</td>
                                                            <td>{{ $plan->fecha_implantar_accion ?? 'Sin fecha' }}</td>
                                                            <td>{{ $revisor ?? 'Sin responsable' }}</td>
                                                            <td>{{ $plan->fecha_verificacion ?? 'Sin fecha' }}</td>
                                                            <td>{{ $evidencia ?? 'Sin evidencia' }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </td>
                    <td>
                        @php
                            $estado = $a->responsable->estado;
                            if ($estado == 4) {
                                $estadoTexto = 'Aceptado';
                            } elseif ($estado == 5) {
                                $estadoTexto = 'Rechazado';
                            } else {
                                $estadoTexto = 'Sin Evaluar';
                            }
                        @endphp
                        {{ $estadoTexto }}
                    </td>
                    <td>
                        @if($estado == 4)
                            <button class="btn btn-success btn-sm" disabled>Aceptado</button>
                        @else
                            <!-- Formulario principal -->
                            <form action="{{ route('auditorias.evaluar_accion', $a->responsable->id_responsable) }}" method="POST" id="form-{{ $a->responsable->id_responsable }}">
                                @csrf
                                <div class="form-inline">
                                    <select name="estado" class="form-control estado-select" data-id="{{ $a->responsable->id_responsable }}" required>
                                        <option value="">-- Evaluar --</option>
                                        <option value="4">Aceptar</option>
                                        <option value="5">Rechazar</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-success guardar-btn" data-id="{{ $a->responsable->id_responsable }}">Guardar</button>
                                </div>
                            </form>

                            <!-- Modal de observación para rechazo -->
                            <div class="modal fade" id="modal-rechazo-{{ $a->responsable->id_responsable }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ route('auditorias.evaluar_accion', $a->responsable->id_responsable) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="estado" value="5">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Motivo de Rechazo</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <textarea name="observaciones" class="form-control" placeholder="Describe el motivo del rechazo" required></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Guardar Rechazo</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.guardar-btn').forEach(function (btn) {
                    btn.addEventListener('click', function (e) {
                        const id = btn.dataset.id;
                        const select = document.querySelector(`select[data-id="${id}"]`);
                        const valor = select.value;

                        if (valor === "5") {
                            e.preventDefault();
                            $('#modal-rechazo-' + id).modal('show');
                        }
                    });
                });
            });
        </script>
@endsection