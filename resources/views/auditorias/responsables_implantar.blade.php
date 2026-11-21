@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <div class="tw:w-full">
        @if (session('success'))
            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800 tw:relative tw:pr-10 tw:mt-4">
                <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="alert" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('success') }}
            </div>
        @endif
            @if (session('error'))
                <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800 tw:relative tw:pr-10 tw:mt-4">
                    <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="alert" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('error') }}
                </div>
            @endif

            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-full tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                            <h2 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Acciones Asignadas para Implementar</h2>
                        </div>
                    </div>
                <!-- Tabla estática -->
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-bordes tw-tabla-rayas">
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
                                    <i class="fa fa-exclamation-circle tw:text-red-600" title="La fecha programada ha vencido"></i>
                                @elseif($diferencia <= 3)
                                    <i class="fa fa-clock-o tw:text-amber-600" title="Fecha próxima a vencer"></i>
                                @else
                                    <i class="fa fa-check-circle-o tw:text-green-600" title="Fecha dentro del plazo establecido"></i>
                                @endif
                            </td>

                            <td>{{ $accion->fecha_verificacion }}</td>
                            <td>{{ $accion->fecha_planeada ?? 'Sin fecha' }}</td>
                            <td>{{ $accion->medio_verificacion ?? 'No especificado' }}</td>
                            <td>
                                @if($accion->path_evidencia)
                                    <a href="{{ route('aud_seguimiento.descargar', $accion->id_plan_acciones) }}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm">Descargar</a>
                                @else
                                    <span class="tw:text-gray-500">Pendiente</span>
                                @endif
                            </td>
                            <td>
                                @if($accion->estado == 1)
                                    <button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm tw:mt-2" disabled>Evaluado</button>
                                @else
                                    <form id="formEvidencia{{ $accion->id_plan_acciones }}" action="{{ route('aud_seguimiento.upload', $accion->id_plan_acciones) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="path_evidencia" accept=".pdf" class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden" required>
                                        <button type="button" onclick="confirmarSubida({{ $accion->id_plan_acciones }})" class="{{ $accion->path_evidencia ? 'tw:bg-amber-500 tw:text-white tw:hover:bg-amber-600' : 'tw:bg-brand-500 tw:text-white tw:hover:bg-brand-600' }} tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm tw:mt-2">
                                            {{ $accion->path_evidencia ? 'Editar' : 'Subir' }}
                                        </button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                @if($accion->estado == 2 && $accion->observaciones)
                                    <button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm" data-toggle="modal" data-target="#modalObservaciones_{{ $accion->id_plan_acciones }}">
                                        Ver observaciones
                                    </button>

                                    <x-panel.modal id="modalObservaciones_{{ $accion->id_plan_acciones }}" tamano="md" sin-relleno>
                                        
                                            
                                                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Observaciones del revisor</h4>
                                                </div>
                                                <div class="tw-modal-cuerpo">
                                                    <p>{{ $accion->observaciones }}</p>
                                                </div>
                                                <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                                    <button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cerrar</button>
                                                </div>
                                            
                                        
                                    </x-panel.modal>
                                @else
                                    <span class="tw:text-gray-500">Sin observaciones</span>
                                @endif
                            </td>
                            <td>
                                @if(!$accion->path_evidencia)
                                    <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-gray-100 tw:text-gray-700">Sin enviar</span>
                                @elseif($accion->estado == 1)
                                    <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-green-50 tw:text-green-700">Aceptado</span>
                                @elseif($accion->estado == 2)
                                    <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-red-50 tw:text-red-600">No aceptado</span>
                                @elseif($accion->estado == 3)
                                    <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-amber-50 tw:text-amber-700">Regresado con cambios</span>
                                @else
                                    <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-sky-50 tw:text-sky-600">Enviado</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
</div>
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
</div>
@endsection
