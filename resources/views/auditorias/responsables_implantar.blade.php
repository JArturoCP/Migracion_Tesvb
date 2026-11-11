@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible mt-3">
                <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('success') }}
            </div>
        @endif
            @if (session('error'))
                <div class="alert alert-success alert-dismissible mt-3">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
            <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h2 class="panel-title text-center">Acciones Asignadas para Implementar</h2>
                        </div>
                    </div>
                <!-- Tabla estática -->
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Acción</th>
                        <th>Fecha de Implementación</th>
                        <th>Fecha de Verificación</th>
                        <th>Fecha de Subida de Evidencia</th>
                        <th>Medio de Verificación</th>
                        <th>Evidencia</th>
                        <th>Subir Evidencia</th>
                        <th>Observaciones</th>
                        <th>Estatus</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php use Carbon\Carbon; @endphp
                    @foreach($acciones as $accion)
                        <tr>
                            <td>{{ $accion->acciones }}</td>
                            @php
                                $hoy = \Carbon\Carbon::now();
                                $fechaLimite = \Carbon\Carbon::parse($accion->fecha_implantar_accion);
                                $diferencia = $hoy->diffInDays($fechaLimite, false); // negativo si ya pasó
                            @endphp

                            <td>
                                {{ $accion->fecha_implantar_accion }}
                                @if($diferencia < 0)
                                    <i class="glyphicon glyphicon-exclamation-sign text-danger" title="La fecha programada ha vencido"></i>
                                @elseif($diferencia <= 3)
                                    <i class="glyphicon glyphicon-time text-warning" title="Fecha próxima a vencer"></i>
                                @else
                                    <i class="glyphicon glyphicon-ok-circle text-success" title="Fecha dentro del plazo establecido"></i>
                                @endif
                            </td>

                            <td>{{ $accion->fecha_verificacion }}</td>
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
                                @if($accion->estado == 1)
                                    <button class="btn btn-default btn-sm mt-2" disabled>Evaluado</button>
                                @else
                                    <form id="formEvidencia{{ $accion->id_plan_acciones }}" action="{{ route('aud_seguimiento.upload', $accion->id_plan_acciones) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="path_evidencia" accept=".pdf" class="form-control-file" required>
                                        <button type="button" onclick="confirmarSubida({{ $accion->id_plan_acciones }})" class="btn {{ $accion->path_evidencia ? 'btn-warning' : 'btn-primary' }} btn-sm mt-2">
                                            {{ $accion->path_evidencia ? 'Editar' : 'Subir' }}
                                        </button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                @if($accion->estado == 2 && $accion->observaciones)
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalObservaciones_{{ $accion->id_plan_acciones }}">
                                        Ver observaciones
                                    </button>

                                    <div class="modal fade" id="modalObservaciones_{{ $accion->id_plan_acciones }}" tabindex="-1" role="dialog">
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
                                @if(!$accion->path_evidencia)
                                    <span class="label label-default">Sin enviar</span>
                                @elseif($accion->estado == 1)
                                    <span class="label label-success">Aceptado</span>
                                @elseif($accion->estado == 2)
                                    <span class="label label-danger">No aceptado</span>
                                @elseif($accion->estado == 3)
                                    <span class="label label-warning">Regresado con cambios</span>
                                @else
                                    <span class="label label-info">Enviado</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
        <script>
            function confirmarSubida(formId) {
                const form = document.getElementById(`formEvidencia${formId}`);
                const fileInput = form.querySelector('input[type="file"]');

                // Verificar si se seleccionó un archivo
                if (!fileInput.files || fileInput.files.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Por favor seleccione un archivo PDF primero'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Confirmación de subida',
                    html: `Si necesita subir más de un documento, debe unirlos en un solo PDF. <br><br>
               Puede usar el siguiente enlace: <a href="https://www.ilovepdf.com/es/unir_pdf" target="_blank">iLovePDF - Unir PDFs</a>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar y subir',
                    cancelButtonText: 'Cancelar para unir archivos',
                    reverseButtons: true,
                    width: '350px', // Aumentar el ancho
                    padding: '6em', // Aumentar el padding interno
                    focusConfirm: false,
                    preConfirm: () => {
                        return new Promise((resolve) => {
                            // Forzar el envío del formulario
                            form.submit();
                            resolve();
                        });
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // El formulario ya se envió en preConfirm
                    }
                });
            }
        </script>
@endsection