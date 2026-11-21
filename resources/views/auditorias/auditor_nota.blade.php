@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <div class="tw:w-full">
        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                <h2 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Seguimiento Auditorías Anteriores</h2>
            </div>
        </div>

        @if($acciones->isEmpty())
            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-sky-200 tw:bg-sky-50 tw:text-sky-800">No hay acciones en seguimiento para mostrar.</div>
        @else
            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-bordes tw-tabla-rayas">
                <thead>
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
                                <button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm" data-toggle="modal" data-target="#modalAnalisis{{ $accion->id_responsable }}" title="Ver análisis">
                                    <i class="fa fa-eye"></i>
                                </button>
                            @else
                                <span class="tw:text-gray-500">Sin registro</span>
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
                                <button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:gap-1 tw:px-2 tw:py-1 tw:text-xs"
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
                            <button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm" data-toggle="modal" data-target="#modalDetalle{{ $accion->id_responsable }}">
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
                                <button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700">Evaluar</button>
                            </form>
                        </td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
</div>

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

                <x-panel.modal id="modalDetalle{{ $accion->id_responsable }}" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="modalLabel{{ $accion->id_responsable }}">
                    
                        
                            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="modalLabel{{ $accion->id_responsable }}">Actividades y Correcciones - Nota {{ $accion->clave_nota }}</h5>
                                
                            </div>
                            <div class="tw-modal-cuerpo">
                                @if($planAcciones->isEmpty())
                                    <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-sky-200 tw:bg-sky-50 tw:text-sky-800">No hay acciones ni correcciones registradas.</div>
                                @else
                                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-compacta tw-tabla-bordes">
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
                                            <tr class="tw:bg-brand-50">
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
                                            <tr class="tw:bg-amber-50">
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
                                            <tr class="tw:bg-green-50">
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
                                                <td colspan="7" class="tw:text-center tw:text-gray-500">No hay acciones registradas.</td>
                                            </tr>
                                        @endif

                                        </tbody>
                                    </table>
</div>
                                @endif
                            </div>
                        
                    
                </x-panel.modal>
            @endforeach

            @foreach($acciones as $accion)
                @if($accion->analisis)
                    <x-panel.modal id="modalAnalisis{{ $accion->id_responsable }}" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="labelAnalisis{{ $accion->id_responsable }}">
                        
                            
                                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                    <h5 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="labelAnalisis{{ $accion->id_responsable }}">Análisis de Datos</h5>
                                    
                                </div>
                                <div class="tw-modal-cuerpo">
                                    <p>{!! nl2br(e($accion->analisis)) !!}</p>
                                </div>
                            
                        
                    </x-panel.modal>
                @endif

                    @if($esLider)
                        <x-panel.modal id="modalEditarAuditor{{ $accion->id_agenda_auditor }}" tamano="md" sin-relleno clase-cerrar="close">
                            
                                <form method="POST" action="{{ route('auditorias.actualizar_responsable') }}">
                                    @csrf
                                    <input type="hidden" name="id_agenda_auditor" value="{{ $accion->id_agenda_auditor }}">

                                    
                                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Editar Auditor Responsable</h4>
                                            
                                        </div>

                                        <div class="tw-modal-cuerpo">
                                            <label>Seleccionar auditor:</label>
                                            <select name="nuevo_responsable" class="select2 tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="">-- Seleccione --</option>
                                                @foreach($accion->auditores_permitidos as $aud)
                                                    <option value="{{ $aud->id_personal }}"
                                                            >
                                                        {{ $aud->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                            <button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Guardar Cambios</button>
                                            <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    
                                </form>
                            
                        </x-panel.modal>
                    @endif
            @endforeach

        @endif
    </div>
</div>
@endsection
