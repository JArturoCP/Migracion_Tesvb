@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="panel-title text-center">Asignar Revisor a Acción</h2>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                {{--<th>ID Acción</th>--}}
                <th>Nombre del Personal</th>
                <th>Requiere Acción</th>
                <th>Requiere Corrección</th>
                <th>Ver más detalles</th>
                <th>Ver Plan de Acciones</th>
                <th>Revisor Asignado</th>
                <th>Eliminar persona asignada</th>
            </tr>
            </thead>
            <tbody>
            @foreach($responsables as $r)
                <tr>
                    {{--<td>{{ $r->id_responsable }}</td>--}}
                    <td>{{ $r->personal->nombre ?? 'No disponible' }}</td>
                    <td>{{ $r->requiere_accion ? 'Sí' : 'No' }}</td>
                    <td>{{ $r->requiere_correccion ? 'Sí' : 'No' }}</td>
                    <td>
                        <!-- Botón para abrir el modal -->
                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal{{ $r->id_responsable }}">
                            Ver más detalles
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modal{{ $r->id_responsable }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $r->id_responsable }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel{{ $r->id_responsable }}">Detalles de la Acción</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Análisis:</strong> {{ $r->analisis ?? 'Sin Análisis'}}</p>
                                        <p><strong>Acción correctiva a realizar:</strong> {{ $r->accion_correctiva ?? 'Sin Acción correctiva'}}</p>
                                        <p><strong>Corrección a realizar:</strong> {{ $r->causa_raiz ?? 'Sin corrección'}}</p>
                                        <p><strong>Actualización de riesgos y oportunidades:</strong> {{ $r->actualizacion_riesgos ? 'Sí' : 'No' }}</p>
                                        <p><strong>¿Por qué?:</strong> {{ $r->valor_actr ?? 'Sin Valor ACTR'}}</p>
                                        <p><strong>Cambios al sistema de gestión para organizaciones educativas:</strong> {{ $r->cambios_sistema ? 'Sí' : 'No' }}</p>
                                        <p><strong>¿Por qué?:</strong> {{ $r->valor_cambios ?? 'Sin Valor Cambios'}}</p>
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
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalDetalle{{ $r->id_responsable }}">
                            Ver Plan de Acciones
                        </button>
                        <!-- Movemos los modales fuera de la tabla -->
                        @foreach($responsables as $a)
                            @php
                                $planAcciones = DB::table('aud_plan_acciones')
                                    ->where('id_responsable', $a->id_responsable)
                                    ->whereNull('deleted_at')
                                    ->get();
                            @endphp

                            <div class="modal fade" id="modalDetalle{{ $a->id_responsable }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $a->id_responsable }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{ $r->id_responsable }}">Actividades y Correcciones</h5>
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
                        @if(isset($asignaciones[$r->id_responsable]))
                            {{ $asignaciones[$r->id_responsable]->personal->nombre ?? 'Revisor eliminado' }}
                        @else
                            <form action="{{ route('auditorias.guardar_accion') }}" method="POST" class="form-inline">
                                @csrf
                                <input type="hidden" name="id_responsable" value="{{ $r->id_responsable }}">
                                <select name="id_personal" class="form-control" required>
                                    <option value="">Selecciona un revisor</option>
                                    @foreach($personales as $p)
                                        <option value="{{ $p->id_personal }}">{{ $p->nombre }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm ml-2">Asignar</button>
                            </form>
                        @endif
                    </td>
                    <td>
                        @if(isset($asignaciones[$r->id_responsable]))
                            <form action="{{ route('auditorias.eliminar_asignacion', $asignaciones[$r->id_responsable]->id_revisor) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        @else
                            <span class="text-muted">Sin asignación</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection