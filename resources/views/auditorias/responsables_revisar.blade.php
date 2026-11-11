@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="panel-title text-center">Acciones Asignadas para Revisar</h2>
            </div>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Acción</th>
                <th>Fecha de Implementación</th>
                <th>Fecha de Verificación</th>
                <th>Fecha de Subida de Evidencia</th>
                <th>Medio de Verificación</th>
                <th>Evidencia</th>
                <th>Observaciones</th>
                <th>Evaluar</th>
                <th>Estatus</th>
            </tr>
            </thead>
            <tbody>
            @php use Carbon\Carbon; @endphp
            @foreach($acciones as $accion)
                <tr>
                    <td>{{ $accion->acciones }}</td>
                    <td>{{ $accion->fecha_implantar_accion }}</td>
                    <td>
                        @php
                            $hoy = Carbon::now();
                            $fechaVerificacion = Carbon::parse($accion->fecha_verificacion);
                            $diff = $hoy->diffInDays($fechaVerificacion, false);
                        @endphp

                        {{ $accion->fecha_verificacion }}

                        @if($diff < 0)
                            <i class="glyphicon glyphicon-exclamation-sign text-danger" title="La fecha programada ha vencido"></i>
                        @elseif($diff <= 3)
                            <i class="glyphicon glyphicon-time text-warning" title="Fecha próxima a vencer"></i>
                        @else
                            <i class="glyphicon glyphicon-ok-circle text-success" title="Fecha dentro del plazo establecido"></i>
                        @endif
                    </td>
                    <td>{{ $accion->fecha_planeada ?? 'Sin fecha' }}</td>
                    <td>{{ $accion->medio_verificacion ?? 'No especificado' }}</td>
                    <td>
                        @if($accion->path_evidencia)
                            <a href="{{ route('aud_seguimiento.descargar', $accion->id_plan_acciones) }}" class="btn btn-success btn-sm">Descargar</a>
                        @else
                            <span class="text-muted">Pendiente</span>
                        @endif
                    </td>
                    <td>
                        @if($accion->observaciones)
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalObs_{{ $accion->id_plan_acciones }}">
                                Ver observaciones
                            </button>

                            <div class="modal fade" id="modalObs_{{ $accion->id_plan_acciones }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Observaciones del revisor</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{ $accion->observaciones }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <span class="text-muted">Sin observaciones</span>
                        @endif
                    </td>
                    <td>
                        @if($accion->estado == 1)
                            <button class="btn btn-sm btn-success mt-2" disabled>Aceptado</button>
                        @elseif($accion->estado == 2)
                            <button class="btn btn-sm btn-danger mt-2" disabled>No Aceptado</button>
                        @else
                            <form id="form-evaluar-{{ $accion->id_plan_acciones }}" action="{{ route('aud_revisar.evaluar', $accion->id_plan_acciones) }}" method="POST">
                                @csrf
                                <select name="estado" class="form-control estado-select" data-id="{{ $accion->id_plan_acciones }}"
                                        @if(!$accion->path_evidencia) disabled @endif required>
                                    <option value="">-- Selecciona --</option>
                                    <option value="1">Aceptar</option>
                                    <option value="2">No Aceptar</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary mt-2"
                                        @if(!$accion->path_evidencia) disabled @endif>
                                    Guardar
                                </button>
                                @if(!$accion->path_evidencia)
                                    <small class="text-danger d-block mt-1">Debe existir evidencia para evaluar</small>
                                @endif
                            </form>
                        @endif
                    </td>
                    <td>
                        @if(!$accion->path_evidencia)
                            <span class="label label-default">En espera</span>
                        @elseif($accion->estado == 1)
                            <span class="label label-success">Aceptado</span>
                        @elseif($accion->estado == 2)
                            <span class="label label-danger">No aceptado</span>
                        @elseif($accion->estado == 3)
                            <span class="label label-warning">Regresado con cambios</span>
                        @else
                            <span class="label label-info">Sin revisar</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal de Observaciones -->
    <div class="modal fade" id="modalObservaciones" tabindex="-1" role="dialog" aria-labelledby="modalObservacionesLabel">
        <div class="modal-dialog" role="document">
            <form id="form-observaciones" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Motivo de No Aceptación</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="estado" value="2">
                        <div class="form-group">
                            <label for="observaciones">Observaciones:</label>
                            <textarea name="observaciones" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Guardar evaluación</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.estado-select').on('change', function () {
                const estado = $(this).val();
                const id = $(this).data('id');
                if (estado == '2') {
                    const formAction = $('#form-evaluar-' + id).attr('action');
                    $('#form-observaciones').attr('action', formAction);
                    $('#modalObservaciones').modal('show');
                    // Reset textarea
                    $('#form-observaciones textarea[name="observaciones"]').val('');
                }
            });
        });
    </script>

@endsection