@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <div class="tw:w-full">
        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                <h2 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Acciones Asignadas</h2>
            </div>
        </div>

        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-bordes">
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
                        <button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700" data-toggle="modal" data-target="#modal{{ $a->responsable->id_responsable }}">
                            Ver más detalles
                        </button>

                        <!-- Modal -->
                        <x-panel.modal id="modal{{ $a->responsable->id_responsable }}" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="modalLabel{{ $a->responsable->id_responsable }}">
                            
                                
                                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                        <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="modalLabel{{ $a->responsable->id_responsable }}">Detalles de la Acción</h5>
                                        
                                    </div>
                                    <div class="tw-modal-cuerpo">
                                        <p><strong>Análisis:</strong> {{ $a->responsable->analisis ?? 'Sin Análisis'}}</p>
                                        <p><strong>Acción correctiva a realizar:</strong> {{ $a->responsable->accion_correctiva ?? 'Sin Acción correctiva'}}</p>
                                        <p><strong>Corrección a realizar:</strong> {{ $a->responsable->causa_raiz ?? 'Sin corrección'}}</p>
                                        <p><strong>Actualización de riesgos y oportunidades:</strong> {{ $a->responsable->actualizacion_riesgos ? 'Sí' : 'No' }}</p>
                                        <p><strong>¿Por qué?:</strong> {{ $a->responsable->valor_actr ?? 'Sin Valor ACTR'}}</p>
                                        <p><strong>Cambios al sistema de gestión para organizaciones educativas:</strong> {{ $a->responsable->cambios_sistema ? 'Sí' : 'No' }}</p>
                                        <p><strong>¿Por qué?:</strong> {{ $a->responsable->valor_cambios ?? 'Sin Valor Cambios'}}</p>
                                        {{--<p><strong>Observaciones:</strong> {{ $r->observaciones ?? 'Sin Observaciones por el momento'}}</p>--}}
                                    </div>
                                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cerrar</button>
                                    </div>
                                
                            
                        </x-panel.modal>
                    </td>
                    <td>
                        <button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm" data-toggle="modal" data-target="#modalDetalle{{ $a->responsable->id_responsable }}">
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

                            <x-panel.modal id="modalDetalle{{ $as->id_responsable }}" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="modalLabel{{ $as->id_responsable }}">
                                
                                    
                                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                            <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="modalLabel{{ $a->id_responsable }}">Actividades y Correcciones</h5>
                                            
                                        </div>
                                        <div class="tw-modal-cuerpo">
                                            @if($planAcciones->isEmpty())
                                                <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-sky-200 tw:bg-sky-50 tw:text-sky-800">No hay acciones ni correcciones registradas.</div>
                                            @else
                                                <table class="tw-tabla tw-tabla-compacta tw-tabla-bordes">
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
                                    
                                
                            </x-panel.modal>
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
                            <button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm" disabled>Aceptado</button>
                        @else
                            <!-- Formulario principal -->
                            <form action="{{ route('auditorias.evaluar_accion', $a->responsable->id_responsable) }}" method="POST" id="form-{{ $a->responsable->id_responsable }}">
                                @csrf
                                <div class="tw:flex tw:flex-wrap tw:items-center tw:gap-3">
                                    <select name="estado" class="estado-select tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" data-id="{{ $a->responsable->id_responsable }}" required>
                                        <option value="">-- Evaluar --</option>
                                        <option value="4">Aceptar</option>
                                        <option value="5">Rechazar</option>
                                    </select>
                                    <button type="submit" class="guardar-btn tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700" data-id="{{ $a->responsable->id_responsable }}">Guardar</button>
                                </div>
                            </form>

                            <!-- Modal de observación para rechazo -->
                            <x-panel.modal id="modal-rechazo-{{ $a->responsable->id_responsable }}" tamano="md" sin-relleno clase-cerrar="close">
                                
                                    <form action="{{ route('auditorias.evaluar_accion', $a->responsable->id_responsable) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="estado" value="5">
                                        
                                            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                                <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Motivo de Rechazo</h5>
                                                
                                            </div>
                                            <div class="tw-modal-cuerpo">
                                                <textarea name="observaciones" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" placeholder="Describe el motivo del rechazo" required></textarea>
                                            </div>
                                            <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                                <button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Guardar Rechazo</button>
                                                <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                                            </div>
                                        
                                    </form>
                                
                            </x-panel.modal>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
</div>
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
</div>
@endsection
