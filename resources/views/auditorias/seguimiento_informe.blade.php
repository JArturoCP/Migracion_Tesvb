@extends('layouts.panel')
@include('partials.panel.recursos_app', ['datepicker' => true])
@foreach($auditorias as $auditoria)
    @if($auditoria->id_auditoria==$auditoria_id)
        @section('title', 'Detalle auditoria '.\Carbon\Carbon::parse($auditoria->fecha_i)->format('Y').'-'.$loop->iteration)
    @endif
@endforeach
@section('content')
    <?php use \Carbon\Carbon; ?>
    <main class="tw-pantalla tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                <p>
                    <span>Informe de la auditoria</span>
                </p>

            @if (session()->has('flash_notification.message'))
                    <x-panel.alerta class="tw:mb-4" :tipo="['success' => 'exito', 'danger' => 'error', 'warning' => 'advertencia'][session('flash_notification.level')] ?? 'info'">{!! session('flash_notification.message') !!}</x-panel.alerta>
                @endif


                @foreach($auditorias as $auditoria)
                    @if($auditoria->id_auditoria==$auditoria_id)

                        @php $isFull=true; @endphp

                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4 tw:text-center">
                                Informe de la auditoría {{\Carbon\Carbon::parse($auditoria->fecha_i)->format('Y').'-'.$loop->iteration}}
                                @if($auditoria->objetivo AND $auditoria->alcance AND $auditoria->criterio)
                                    <a href="#" data-id="{{$auditoria->id_auditoria}}" class="btn_export tw:float-right"  style="margin-left: 1.5em;" data-all="{{$auditoria}}"><span class="fa fa-print" data-toggle="tooltip" title="Imprimir informe de auditoria"></span></a>
                                @endif
                            </div>
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">Número de auditoría: <strong> {{\Carbon\Carbon::parse($auditoria->fecha_i)->format('Y').'-'.$loop->iteration}} </strong></div>
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">Fechas de la auditoría: Del <strong>{{Carbon::parse($auditoria->fecha_i)->format('d/m/Y')}}</strong> al <strong>{{Carbon::parse($auditoria->fecha_f)->format('d/m/Y')}}</strong></div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:text-center tw:px-2">
                                        <h4>Norma de Referencia:</h4>
                                        <h4>{{$auditoria->criterio}}</h4>
                                    </div>
                                </div>

                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <label>Objetivo</label>

                                        <p>{{$auditoria->objetivo}}</p>
                                    </div>
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <label>Alcance</label>
                                        <p>{{$auditoria->alcance}}</p>
                                        {{--                                        <p>{{count($procesosE)." procesos"}}</p>--}}
                                    </div>
                                </div>
                                <hr>
                                {{--<a href="#" class="btn_add_auditores tw:float-right" data-id="{{$auditoria->id_auditoria}}" data-toggle="modal" data-target="#modal_add_auditores"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar Auditores"></span></a>--}}
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <label>Auditor Líder:</label>
                                        @if($lider->isEmpty())
                                            {{--                                        <a href="#" class="btn-add-lider" data-id="{{$auditoria->id_auditoria}}" data-toggle="modal" data-target="#modal_edit_lider"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar lider"></span></a>--}}
                                            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" role="alert">No se ha agregado un lider</div>
                                        @else
                                            @foreach($lider as $auditores)
                                                @foreach($auditores->getAbr->getAbreviatura as $auditor)
                                                    <li class="tw:block tw:px-4 tw:py-3">
                                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                            <span class="tw:w-full tw:lg:w-10/12 tw:px-2">{{\App\audParseCase::parseAbr($auditor->titulo).' '.\App\audParseCase::parseNombre($auditores->getName->nombre)}}</span>
                                                            {{--<a href="#" class="btn-edit-lider tw:w-full tw:lg:w-1/12 tw:px-2" data-id="{{$auditor->id_asigna_audi}}" data-toggle="modal" data-target="#modal_edit_lider"><span class="fa fa-cog" data-toggle="tooltip" title="Editar lider"></span></a>--}}
                                                            {{--                                                        <a href="#" class="btn_delete_auditor tw:w-full tw:float-right tw:lg:w-1/12 tw:px-2" data-id="{{$auditor->id_auditor_auditoria}}"><span aria-hidden="true" class="fa fa-trash" data-toggle="tooltip" title="Eliminar lider"></span></a>--}}
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endforeach
                                        @endif
                                    </div>

                                </div>

                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <label>Equipo de auditores:</label>
                                        {{--                                    <a href="#" class="btn-add-aquipo" data-id="{{$auditoria->id_auditoria}}" data-toggle="modal" data-target="#modal_edit_equipo"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar auditor"></span></a>--}}
                                        @if($equipo=$auditoria->getAuditores($auditoria->id_auditoria, 2) AND sizeof($equipo)<1)
                                            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" role="alert">No se han agregado auditores al equipo</div>
                                        @else
                                            <ul class="tw:divide-y tw:divide-gray-100 tw:rounded-lg tw:border tw:border-gray-200">
                                                @foreach($equipo as $auditor)
                                                    <li class="tw:block tw:px-4 tw:py-3">
                                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                            <span class="tw:w-full tw:lg:w-10/12 tw:px-2"><label>Auditor {{$loop->iteration}}:</label>{{' '.\App\audParseCase::parseAbr($auditor->titulo).' '.\App\audParseCase::parseNombre($auditor->nombre)}}</span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>

                                </div>
                                <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-sky-200 tw:bg-sky-50 tw:text-sky-800 tw:text-center">
                                    <h4>Acciones Asignadas: <strong>{{ $asignados }}/{{ $totalRegistros }}</strong></h4>
                                </div>
                                {{---TABLA FORTALEZAS--}}
                                <div>
                                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-bordes">
                                        <thead>
                                        <tr>
                                            <th class="tw:lg:w-4/12 tw:text-center">
                                                Reportes Fortalezas
                                            </th>
                                            <th class="tw:lg:w-4/12 tw:text-center">
                                                Responsable(s)
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($fortalezas as $registro)

                                            <tr>
                                                <td>
                                                    <h5>{{($loop->index+1)}} <strong>{{$registro->punto_proceso}}</strong> {{$registro->resultado}}</h5>

                                                </td>

                                                <td>
                                                    {{$registro->nombre}}
                                                </td>
                                            </tr>
                                            {{-- (se quitó un </form> sin apertura del original; el navegador lo ignoraba) --}}
                                        @endforeach
                                        </tbody>
                                    </table>
</div>
                                </div>
                                {{---FIN TABLA FORTALEZAS--}}
                                {{--TABLA DE NO CONFORMIDADES--}}


                                <form id="form-responsables" action="{{ url('auditorias/responsables-multiples', $auditoria_id) }}" method="POST">
                                @csrf
                                    @method('PUT')

                                    {{-- TABLA DE NO CONFORMIDADES --}}
                                    <div>
                                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-bordes">
                                            <thead>
                                            <tr>
                                                <th class="tw:lg:w-4/12 tw:text-center">Reportes No Conformidades</th>
                                                <th class="tw:lg:w-4/12 tw:text-center">Responsable(s)</th>
                                                <th class="tw:lg:w-4/12 tw:text-center">Responsables canalizados</th>
                                                <th class="tw:lg:w-2/12 tw:text-center">Canalizar Responsable</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($noConformidad as $registro)
                                                <tr>
                                                    <td>
                                                        <h5>{{ $loop->iteration }} <strong>{{ $registro->punto_proceso }}</strong> {{ $registro->resultado }}</h5>
                                                    </td>
                                                    <td>{{ $registro->nombre }}</td>
                                                    <td id="responsables-canalizados-{{ $registro->id_notas }}">
                                                        @if($registro->getResponsables($registro->id_notas)->count() > 0)
                                                            @foreach($registro->getResponsables($registro->id_notas) as $responsable)
                                                                <h5>{{ $responsable->nombre }}</h5>
                                                            @endforeach
                                                        @else
                                                            @php $isFull = false; @endphp
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($auditoria->asignado == 0)
                                                            <div style="display: flex; gap: 5px;">
                                                                <select class="id_personal_no_conformidades" data-nota="{{ $registro->id_notas }}">
                                                                    @foreach($personas as $responsable)
                                                                        <option value="{{ $responsable->id_personal }}"
                                                                                {{ (trim($responsable->nombre) == trim($registro->nombre)) ? 'selected' : '' }}>
                                                                            {{ $responsable->nombre }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <button type="button" class="agregar-responsable tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700" data-nota="{{ $registro->id_notas }}">
                                                                    <span class="fa fa-check-circle" data-toggle="tooltip" title="Guardar Responsable"></span>
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
</div>
                                    </div>
                                {{---FIN TABLA DE NO CONFORMIDADES--}}

                                    {{-- TABLA DE OPORTUNIDADES --}}
                                    <div>
                                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-bordes">
                                            <thead>
                                            <tr>
                                                <th class="tw:lg:w-4/12 tw:text-center">Reportes Oportunidades de Mejora</th>
                                                <th class="tw:lg:w-4/12 tw:text-center">Responsable(s)</th>
                                                <th class="tw:lg:w-4/12 tw:text-center">Responsables canalizados</th>
                                                <th class="tw:lg:w-2/12 tw:text-center">Canalizar Responsable</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($oportunidades as $registro)
                                                <tr>
                                                    <td>
                                                        <h5>{{ $loop->iteration }} <strong>{{ $registro->punto_proceso }}</strong> {{ $registro->resultado }}</h5>
                                                    </td>
                                                    <td>{{ $registro->nombre }}</td>
                                                    <td id="responsables-canalizados-{{ $registro->id_notas }}">
                                                        @if($registro->getResponsables($registro->id_notas)->count() > 0)
                                                            @foreach($registro->getResponsables($registro->id_notas) as $responsable)
                                                                <h5>{{ $responsable->nombre }}</h5>
                                                            @endforeach
                                                        @else
                                                            @php $isFull = false; @endphp
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($auditoria->asignado == 0)
                                                            <div style="display: flex; gap: 5px;">
                                                                <select class="id_personal_no_conformidades" data-nota="{{ $registro->id_notas }}">
                                                                    @foreach($personas as $responsable)
                                                                        <option value="{{ $responsable->id_personal }}"
                                                                                {{ (trim($responsable->nombre) == trim($registro->nombre)) ? 'selected' : '' }}>
                                                                            {{ $responsable->nombre }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <button type="button" class="agregar-responsable tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700" data-nota="{{ $registro->id_notas }}">
                                                                    <span class="fa fa-check-circle" data-toggle="tooltip" title="Guardar Responsable"></span>
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
</div>
                                    </div>

                                    {{-- CAMPO FECHA Y BOTÓN ENVIAR --}}
                                    @if($auditoria->asignado==null)
                                        <div class="text-center1">
                                            <form action="{{ url('auditorias/responsables', $auditoria_id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <label for="numero_dias" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-400">Plazo para registrar NC</label>
                                                <input type="text" id="numero_dias" name="numero_dias" class="datepicker custom-input1 tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Seleccionar Fecha" required>
                                                <button class="btn-custom-success1 tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:mt-2 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" id="enviar_informe" type="submit">Enviar</button>
                                            </form>
                                        </div>
                                    @else
                                        @if($auditoria->asignado)

                                            {{--<h4 class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800">Proceso terminado, fecha limite de atención: {{ \Carbon\Carbon::parse($auditoria->updated_at)->addDays($registro->dias)->format('d-m-Y')}}</h4>--}}
                                            <h4 class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800">
                                                Proceso terminado, tiene {{ $registro->dias }} día(s) hábil(es). Fecha límite: {{ \Carbon\Carbon::parse($registro->updated_at)->addWeekdays($registro->dias)->format('d/m/Y') }}
                                            </h4>

                                        @else
                                            <h4 class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700">Asignar todos los responsables</h4>
                                        @endif
                                    @endif
                                </form>
                                @if($auditoria->asignado)
                                {{-- BOTÓN EDITAR --}}
                                <div class="tw:mb-4">
                                    <button class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" onclick="mostrarFormularioEdicion()">Editar fecha</button>
                                </div>

                                {{-- FORMULARIO DE EDICIÓN OCULTO --}}
                                <div class="text-center1" id="formulario_edicion" style="display: none;">
                                    <form action="{{ url('auditorias/responsables', $auditoria_id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <label for="numero_dias" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-400">Plazo para registrar NC</label>
                                        <input type="text" id="numero_dias" name="numero_dias" class="datepicker custom-input1 tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Seleccionar Fecha" required>
                                        <button class="btn-custom-success1 tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:mt-2 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" id="enviar_informe_editar" type="submit">Actualizar</button>
                                    </form>
                                </div>

                                <script>
                                    function mostrarFormularioEdicion() {
                                        document.getElementById('formulario_edicion').style.display = 'block';
                                    }
                                </script>
                                @endif
                                @endif
            @endforeach
        </div>
        </div></div></div>{{-- (contenedores sin cerrar en el original, con la auditoría elegida; los cerraba </main>) --}}

    </main>
      <form  method="POST" role="form" id="form_informe" action="{{url('auditorias/informe/'.$informe->id_informe)}}">
        {{ csrf_field() }}
        {{ method_field('PUT')}}
        <input type="hidden" name="field" id="fieldInforme">
        <input type="hidden" name="value" id="valueInforme">

    </form>

    <x-panel.modal id="modal_export_programa" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Exportar programa de auditoría</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div class="persona-aprueba tw:mb-4">
                        <label>Persona que aprueba el programa</label>
                        <div class="tw:flex tw:items-center tw:gap-2">
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                    <label>
                                        <input class="aprueba_formato" type="radio" name="aprueba_formato" id="formato1" value="1">
                                        Coordinadora del SGC
                                    </label>
                                </div>
                                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                    <label>
                                        <input class="aprueba_formato" type="radio" name="aprueba_formato" id="formato2" value="2">
                                        Director General
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                    <input type="button" class="btn-exportar tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Exportar"/>
                </div>
            
        
    </x-panel.modal>
    <script>
        $(document).ready(function () {
            $('#numero_dias').datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy',
                language: 'es'
            });
        });
    </script>
    <style>
        .custom-input1 {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 10px;
            padding: 10px;
            font-size: 16px;
            color: #6c757d;
        }

        .btn-custom-success1 {
            background-color: #28a745;
            border: none;
            border-radius: 20px;
            padding: 8px 20px;
            font-size: 16px;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .text-center1 {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>

    <script>
        function contarDiasHabiles(fechaInicio, fechaFin) {
            let inicio = new Date(fechaInicio);
            let fin = new Date(fechaFin);
            let count = 0;

            // Normalizar horas para evitar errores
            inicio.setHours(0, 0, 0, 0);
            fin.setHours(0, 0, 0, 0);

            while (inicio <= fin) {
                let day = inicio.getDay();
                if (day !== 0 && day !== 6) { // 0 = Domingo, 6 = Sábado
                    count++;
                }
                inicio.setDate(inicio.getDate() + 1);
            }

            return count;
        }

        document.getElementById('enviar_informe').addEventListener('click', function(e) {
            e.preventDefault(); // Detener el envío del formulario

            const fechaInput = document.getElementById('numero_dias').value;
            if (!fechaInput) {
                Swal.fire('Error', 'Por favor selecciona una fecha.', 'error');
                return;
            }

            // Convertir a formato dd-mm-yyyy -> yyyy-mm-dd
            const partes = fechaInput.split('-');
            const fechaSeleccionada = new Date(partes[2], partes[1] - 1, partes[0]);
            fechaSeleccionada.setHours(0, 0, 0, 0);

            const fechaHoy = new Date();
            fechaHoy.setHours(0, 0, 0, 0);

            if (fechaSeleccionada < fechaHoy) {
                Swal.fire('Error', 'La fecha debe ser mayor o igual a hoy.', 'error');
                return;
            }

            const diasHabiles = contarDiasHabiles(fechaHoy, fechaSeleccionada);

            Swal.fire({
                title: '¿Estás seguro?',
                text: `¿Estás seguro que quieres tener ${diasHabiles-1} día(s) hábil(es)?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí, continuar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.closest('form').submit(); // Enviar el formulario
                }
            });
        });
    </script>
    <script>
        function contarDiasHabiles(fechaInicio, fechaFin) {
            let inicio = new Date(fechaInicio);
            let fin = new Date(fechaFin);
            let count = 0;

            // Normalizar horas para evitar errores
            inicio.setHours(0, 0, 0, 0);
            fin.setHours(0, 0, 0, 0);

            while (inicio <= fin) {
                let day = inicio.getDay();
                if (day !== 0 && day !== 6) { // 0 = Domingo, 6 = Sábado
                    count++;
                }
                inicio.setDate(inicio.getDate() + 1);
            }

            return count;
        }
 @if($auditoria->asignado)
        document.getElementById('enviar_informe_editar').addEventListener('click', function(e) {
            e.preventDefault(); // Detener el envío del formulario

            const fechaInput = document.getElementById('numero_dias').value;
            if (!fechaInput) {
                Swal.fire('Error', 'Por favor selecciona una fecha.', 'error');
                return;
            }

            // Convertir a formato dd-mm-yyyy -> yyyy-mm-dd
            const partes = fechaInput.split('-');
            const fechaSeleccionada = new Date(partes[2], partes[1] - 1, partes[0]);
            fechaSeleccionada.setHours(0, 0, 0, 0);

            const fechaHoy = new Date();
            fechaHoy.setHours(0, 0, 0, 0);

            if (fechaSeleccionada < fechaHoy) {
                Swal.fire('Error', 'La fecha debe ser mayor o igual a hoy.', 'error');
                return;
            }

            const diasHabiles = contarDiasHabiles(fechaHoy, fechaSeleccionada);

            Swal.fire({
                title: '¿Estás seguro?',
                text: `¿Estás seguro que quieres tener ${diasHabiles-1} día(s) hábil(es)?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí, continuar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.closest('form').submit(); // Enviar el formulario
                }
            });
        });
        @endif
    </script>
    <script>
        const responsablesPorNota = {};

        document.querySelectorAll('.agregar-responsable').forEach(boton => {
            boton.addEventListener('click', function () {
                const idNota = this.dataset.nota;
                const select = document.querySelector(`select[data-nota="${idNota}"]`);
                const idResponsable = select.value;
                const nombreResponsable = select.options[select.selectedIndex].text;

                if (!responsablesPorNota[idNota]) {
                    responsablesPorNota[idNota] = new Set();
                }

                // Evita duplicados
                if (!responsablesPorNota[idNota].has(idResponsable)) {
                    responsablesPorNota[idNota].add(idResponsable);

                    const contenedor = document.getElementById(`responsables-canalizados-${idNota}`);
                    const nuevoResponsable = document.createElement('div');
                    nuevoResponsable.classList.add('responsable-item');
                    nuevoResponsable.style.display = 'flex';
                    nuevoResponsable.style.alignItems = 'center';
                    nuevoResponsable.style.gap = '5px';

                    nuevoResponsable.innerHTML = `
    <span>${nombreResponsable}</span>
    <button type="button" class="eliminar-responsable tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-1 tw:px-2 tw:py-1 tw:text-xs" data-id-nota="${idNota}" data-id-responsable="${idResponsable}">✖</button>
`;

// Agregar al contenedor visible
                    contenedor.appendChild(nuevoResponsable);

// Agregar input oculto al formulario
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = `responsables[${idNota}][]`;
                    hiddenInput.value = idResponsable;
                    hiddenInput.classList.add(`input-hidden-${idNota}-${idResponsable}`);
                    document.getElementById('form-responsables').appendChild(hiddenInput);
                }
            });
        });
    </script>
    <script>
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('eliminar-responsable')) {
                const idNota = e.target.dataset.idNota;
                const idResponsable = e.target.dataset.idResponsable;

                // Elimina visual
                const item = e.target.closest('.responsable-item');
                if (item) item.remove();

                // Elimina input oculto
                const input = document.querySelector(`.input-hidden-${idNota}-${idResponsable}`);
                if (input) input.remove();

                // Quita del Set temporal
                if (responsablesPorNota[idNota]) {
                    responsablesPorNota[idNota].delete(idResponsable);
                }
            }
        });

    </script>


    <script>
        $(document).ready(function () {
            $('.input-daterange').datepicker({
                autoclose: true,
                format: "dd-mm-yyyy",
                language: 'es'
            });
            $(".btnInforme").click(function(){
                var id=$(this).data('id');
                var field=$(this).data("field")
                $("#valueInforme").val($("#"+id).val())
                $("#fieldInforme").val(field);
                $("#form_informe").submit();
            });

            $(".btn_export").click(function () {
                programa=$(this).data('id');
                $('#modal_export_programa').modal('show');
            });

            $('.btn-exportar').click(function () {
                if ((typeof $('.aprueba_formato:checked').val() === "undefined")) {
                    // $('.formato-exportacion').addClass('has-error');
                    $('.persona-aprueba').addClass('has-error');
                }
                else{
                    var formato = $('.formato:checked').val();
                    var aprueba_formato = $('.aprueba_formato:checked').val();
                    window.open('{{url("auditorias/printinforme")}}/'+programa+'/'+aprueba_formato,'_blank',"fullscreen=yes");
                }
            });

        });

        $(".btn-edit-plan").click(function () {
            var data=$(this).data('all');
            $("#modal_edit_aud").modal('show');
        });

        $('[data-toggle="tooltip"]').tooltip();



    </script>
@endsection
