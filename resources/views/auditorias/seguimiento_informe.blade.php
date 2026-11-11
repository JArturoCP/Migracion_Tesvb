@extends('layouts.app')
@foreach($auditorias as $auditoria)
    @if($auditoria->id_auditoria==$auditoria_id)
        @section('title', 'Detalle auditoria '.\Carbon\Carbon::parse($auditoria->fecha_i)->format('Y').'-'.$loop->iteration)
    @endif
@endforeach
@section('content')
    <?php use \Carbon\Carbon; ?>
    <main class="col-md-12">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <p>
                    <span>Informe de la auditoria</span>
                </p>

            @if (session()->has('flash_notification.message'))
                    <div class="alert alert-{{ session('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {!! session('flash_notification.message') !!}
                    </div>
                @endif


                @foreach($auditorias as $auditoria)
                    @if($auditoria->id_auditoria==$auditoria_id)

                        @php $isFull=true; @endphp

                        <div class="panel panel-info">
                            <div class="panel-heading text-center">
                                Informe de la auditoría {{\Carbon\Carbon::parse($auditoria->fecha_i)->format('Y').'-'.$loop->iteration}}
                                @if($auditoria->objetivo AND $auditoria->alcance AND $auditoria->criterio)
                                    <a href="#" data-id="{{$auditoria->id_auditoria}}" class="pull-right btn_export"  style="margin-left: 1.5em;" data-all="{{$auditoria}}"><span class="glyphicon glyphicon-print" data-toggle="tooltip" title="Imprimir informe de auditoria"></span></a>
                                @endif
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">Número de auditoría: <strong> {{\Carbon\Carbon::parse($auditoria->fecha_i)->format('Y').'-'.$loop->iteration}} </strong></div>
                                    <div class="col-md-6">Fechas de la auditoría: Del <strong>{{Carbon::parse($auditoria->fecha_i)->format('d/m/Y')}}</strong> al <strong>{{Carbon::parse($auditoria->fecha_f)->format('d/m/Y')}}</strong></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h4>Norma de Referencia:</h4>
                                        <h4>{{$auditoria->criterio}}</h4>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Objetivo</label>

                                        <p>{{$auditoria->objetivo}}</p>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Alcance</label>
                                        <p>{{$auditoria->alcance}}</p>
                                        {{--                                        <p>{{count($procesosE)." procesos"}}</p>--}}
                                    </div>
                                </div>
                                <hr>
                                {{--<a href="#" class="pull-right btn_add_auditores" data-id="{{$auditoria->id_auditoria}}" data-toggle="modal" data-target="#modal_add_auditores"><span class="glyphicon glyphicon-plus" data-toggle="tooltip" title="Agregar Auditores"></span></a>--}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Auditor Líder:</label>
                                        @if($lider->isEmpty())
                                            {{--                                        <a href="#" class="btn-add-lider" data-id="{{$auditoria->id_auditoria}}" data-toggle="modal" data-target="#modal_edit_lider"><span class="glyphicon glyphicon-plus" data-toggle="tooltip" title="Agregar lider"></span></a>--}}
                                            <div class="alert alert-danger" role="alert">No se ha agregado un lider</div>
                                        @else
                                            @foreach($lider as $auditores)
                                                @foreach($auditores->getAbr->getAbreviatura as $auditor)
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <span class="col-md-10">{{\App\audParseCase::parseAbr($auditor->titulo).' '.\App\audParseCase::parseNombre($auditores->getName->nombre)}}</span>
                                                            {{--<a href="#" class="btn-edit-lider col-md-1" data-id="{{$auditor->id_asigna_audi}}" data-toggle="modal" data-target="#modal_edit_lider"><span class="glyphicon glyphicon-cog" data-toggle="tooltip" title="Editar lider"></span></a>--}}
                                                            {{--                                                        <a href="#" class="pull-right btn_delete_auditor col-md-1" data-id="{{$auditor->id_auditor_auditoria}}"><span aria-hidden="true" class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Eliminar lider"></span></a>--}}
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endforeach
                                        @endif
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Equipo de auditores:</label>
                                        {{--                                    <a href="#" class="btn-add-aquipo" data-id="{{$auditoria->id_auditoria}}" data-toggle="modal" data-target="#modal_edit_equipo"><span class="glyphicon glyphicon-plus" data-toggle="tooltip" title="Agregar auditor"></span></a>--}}
                                        @if($equipo=$auditoria->getAuditores($auditoria->id_auditoria, 2) AND sizeof($equipo)<1)
                                            <div class="alert alert-danger" role="alert">No se han agregado auditores al equipo</div>
                                        @else
                                            <ul class="list-group">
                                                @foreach($equipo as $auditor)
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <span class="col-md-10"><label>Auditor {{$loop->iteration}}:</label>{{' '.\App\audParseCase::parseAbr($auditor->titulo).' '.\App\audParseCase::parseNombre($auditor->nombre)}}</span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>

                                </div>
                                <div class="alert alert-info text-center">
                                    <h4>Acciones Asignadas: <strong>{{ $asignados }}/{{ $totalRegistros }}</strong></h4>
                                </div>
                                {{---TABLA FORTALEZAS--}}
                                <div>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="col-md-4 text-center">
                                                Reportes Fortalezas
                                            </th>
                                            <th class="col-md-4 text-center">
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
                                            </form>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{---FIN TABLA FORTALEZAS--}}
                                {{--TABLA DE NO CONFORMIDADES--}}


                                <form id="form-responsables" action="{{ url('auditorias/responsables-multiples', $auditoria_id) }}" method="POST">
                                @csrf
                                    @method('PUT')

                                    {{-- TABLA DE NO CONFORMIDADES --}}
                                    <div>
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th class="col-md-4 text-center">Reportes No Conformidades</th>
                                                <th class="col-md-4 text-center">Responsable(s)</th>
                                                <th class="col-md-4 text-center">Responsables canalizados</th>
                                                <th class="col-md-2 text-center">Canalizar Responsable</th>
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
                                                                <button type="button" class="btn btn-sm btn-success agregar-responsable" data-nota="{{ $registro->id_notas }}">
                                                                    <span class="glyphicon glyphicon-ok-sign" data-toggle="tooltip" title="Guardar Responsable"></span>
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                {{---FIN TABLA DE NO CONFORMIDADES--}}

                                    {{-- TABLA DE OPORTUNIDADES --}}
                                    <div>
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th class="col-md-4 text-center">Reportes Oportunidades de Mejora</th>
                                                <th class="col-md-4 text-center">Responsable(s)</th>
                                                <th class="col-md-4 text-center">Responsables canalizados</th>
                                                <th class="col-md-2 text-center">Canalizar Responsable</th>
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
                                                                <button type="button" class="btn btn-sm btn-success agregar-responsable" data-nota="{{ $registro->id_notas }}">
                                                                    <span class="glyphicon glyphicon-ok-sign" data-toggle="tooltip" title="Guardar Responsable"></span>
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- CAMPO FECHA Y BOTÓN ENVIAR --}}
                                    @if($auditoria->asignado==null)
                                        <div class="text-center1">
                                            <form action="{{ url('auditorias/responsables', $auditoria_id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <label for="numero_dias" class="form-label">Plazo para registrar NC</label>
                                                <input type="text" id="numero_dias" name="numero_dias" class="form-control datepicker custom-input1" placeholder="Seleccionar Fecha" required>
                                                <button class="btn btn-custom-success1 mt-2" id="enviar_informe" type="submit">Enviar</button>
                                            </form>
                                        </div>
                                    @else
                                        @if($auditoria->asignado)

                                            {{--<h4 class="alert alert-success">Proceso terminado, fecha limite de atención: {{ \Carbon\Carbon::parse($auditoria->updated_at)->addDays($registro->dias)->format('d-m-Y')}}</h4>--}}
                                            <h4 class="alert alert-success">
                                                Proceso terminado, tiene {{ $registro->dias }} día(s) hábil(es). Fecha límite: {{ \Carbon\Carbon::parse($registro->updated_at)->addWeekdays($registro->dias)->format('d/m/Y') }}
                                            </h4>

                                        @else
                                            <h4 class="alert alert-danger">Asignar todos los responsables</h4>
                                        @endif
                                    @endif
                                </form>
                                @if($auditoria->asignado)
                                {{-- BOTÓN EDITAR --}}
                                <div class="mb-3">
                                    <button class="btn btn-warning" onclick="mostrarFormularioEdicion()">Editar fecha</button>
                                </div>

                                {{-- FORMULARIO DE EDICIÓN OCULTO --}}
                                <div class="text-center1" id="formulario_edicion" style="display: none;">
                                    <form action="{{ url('auditorias/responsables', $auditoria_id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <label for="numero_dias" class="form-label">Plazo para registrar NC</label>
                                        <input type="text" id="numero_dias" name="numero_dias" class="form-control datepicker custom-input1" placeholder="Seleccionar Fecha" required>
                                        <button class="btn btn-custom-success1 mt-2" id="enviar_informe_editar" type="submit">Actualizar</button>
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

    </main>
      <form  method="POST" role="form" id="form_informe" action="{{url('auditorias/informe/'.$informe->id_informe)}}">
        {{ csrf_field() }}
        {{ method_field('PUT')}}
        <input type="hidden" name="field" id="fieldInforme">
        <input type="hidden" name="value" id="valueInforme">

    </form>

    <div class="modal fade" id="modal_export_programa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Exportar programa de auditoría</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group persona-aprueba">
                        <label>Persona que aprueba el programa</label>
                        <div class="radio">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>
                                        <input class="aprueba_formato" type="radio" name="aprueba_formato" id="formato1" value="1">
                                        Coordinadora del SGC
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        <input class="aprueba_formato" type="radio" name="aprueba_formato" id="formato2" value="2">
                                        Director General
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <input type="button" class="btn btn-primary btn-exportar" value="Exportar"/>
                </div>
            </div>
        </div>
    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    <button type="button" class="btn btn-danger btn-xs eliminar-responsable" data-id-nota="${idNota}" data-id-responsable="${idResponsable}">✖</button>
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
