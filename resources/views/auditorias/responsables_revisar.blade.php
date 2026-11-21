@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <div class="tw:w-full">
        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                <h2 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Acciones Asignadas para Revisar</h2>
            </div>
        </div>

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
                            <i class="fa fa-exclamation-circle tw:text-red-600" title="La fecha programada ha vencido"></i>
                        @elseif($diff <= 3)
                            <i class="fa fa-clock-o tw:text-amber-600" title="Fecha próxima a vencer"></i>
                        @else
                            <i class="fa fa-check-circle-o tw:text-green-600" title="Fecha dentro del plazo establecido"></i>
                        @endif
                    </td>
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
                        @if($accion->observaciones)
                            <button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm" data-toggle="modal" data-target="#modalObs_{{ $accion->id_plan_acciones }}">
                                Ver observaciones
                            </button>

                            <x-panel.modal id="modalObs_{{ $accion->id_plan_acciones }}" tamano="md" sin-relleno>
                                
                                    
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
                        @if($accion->estado == 1)
                            <button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:mt-2" disabled>Aceptado</button>
                        @elseif($accion->estado == 2)
                            <button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:mt-2" disabled>No Aceptado</button>
                        @else
                            <form id="form-evaluar-{{ $accion->id_plan_acciones }}" action="{{ route('aud_revisar.evaluar', $accion->id_plan_acciones) }}" method="POST">
                                @csrf
                                <select name="estado" class="estado-select tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" data-id="{{ $accion->id_plan_acciones }}"
                                        @if(!$accion->path_evidencia) disabled @endif required>
                                    <option value="">-- Selecciona --</option>
                                    <option value="1">Aceptar</option>
                                    <option value="2">No Aceptar</option>
                                </select>
                                <button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:mt-2"
                                        @if(!$accion->path_evidencia) disabled @endif>
                                    Guardar
                                </button>
                                @if(!$accion->path_evidencia)
                                    <small class="tw:text-red-600 tw:block tw:mt-1">Debe existir evidencia para evaluar</small>
                                @endif
                            </form>
                        @endif
                    </td>
                    <td>
                        @if(!$accion->path_evidencia)
                            <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-gray-100 tw:text-gray-700">En espera</span>
                        @elseif($accion->estado == 1)
                            <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-green-50 tw:text-green-700">Aceptado</span>
                        @elseif($accion->estado == 2)
                            <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-red-50 tw:text-red-600">No aceptado</span>
                        @elseif($accion->estado == 3)
                            <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-amber-50 tw:text-amber-700">Regresado con cambios</span>
                        @else
                            <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-sky-50 tw:text-sky-600">Sin revisar</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
</div>
    </div>

    <!-- Modal de Observaciones -->
    <x-panel.modal id="modalObservaciones" tamano="md" sin-relleno aria-labelledby="modalObservacionesLabel">
        
            <form id="form-observaciones" method="POST">
                @csrf
                
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Motivo de No Aceptación</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <input type="hidden" name="estado" value="2">
                        <div class="tw:mb-4">
                            <label for="observaciones">Observaciones:</label>
                            <textarea name="observaciones" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Guardar evaluación</button>
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                    </div>
                
            </form>
        
    </x-panel.modal>

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

</div>
@endsection
