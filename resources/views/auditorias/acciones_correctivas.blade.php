@extends('layouts.app')
@section('title', 'No conformidad y Acción Correctiva')
@section('content')
    <main class="col-md-12">

        <form action="{{url("auditorias/notas_auditorias",$asignacion)}}" method="POST" enctype="multipart/form-data" id="save_accion">
            @csrf
            @method("PUT")

            @foreach($datos_nota as $datos)
                <input type="hidden" name="clasificacion" value="{{$datos->id_clasificacion}}">
                <div class="row">
                    <div class="col-md-6 col-md-offset-1">
                        @if (session()->has('flash_notification.message'))
                            <div class="alert alert-{{ session('flash_notification.level') }}">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {!! session('flash_notification.message') !!}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-10 col-md-offset-1">
                    <p>
                        <span class="glyphicon glyphicon-arrow-right"></span>
                        <a href="{{url('/auditorias/notas_auditorias')}}">Notas Auditorías</a>
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span>No Conformidad y Acción Correctiva</span>
                    </p>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">No Conformidad y Acción Correctiva</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-info">
                        @foreach($datos_nota as $datos)
                            <div class="container-fluid">
                                <!-- Sección de origen -->
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">{{$datos->id_clasificacion==1?"La No Conformidad":"La oportunidad de mejora"}} proviene de: Auditoría Interna</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Sección de solicitud -->
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <strong>SOLICITUD:</strong>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{$datos->resultado}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                                <!-- Sección de análisis -->
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <label class="form-label"><strong>Análisis de Datos (Técnica estadística utilizada):</strong></label>
                                                @if($asignacion->estado == 7)
                                                    <textarea class="form-control" rows="5" name="analisis" id="analisis">{{ old('analisis', $asignacion->analisis) }}</textarea>
                                                @else
                                                    <textarea class="form-control" rows="5" name="analisis" id="analisis"></textarea>
                                                @endif

                                                <div class="form-check mt-3">
                                                    <input class="form-check-input" type="checkbox" name="viable" id="active_viable" {{$datos->id_clasificacion==1?"checked disabled":""}}>
                                                    <label class="form-check-label" for="active_viable">Viable</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($datos->id_clasificacion==1)
                                    <div class="row" >
                                        <div class="col-md-12" id="cont_radio_requiere_accion">
                                            <label>Requiere Acción Correctiva</label><br>

                                            @if($asignacion->estado == 7)
                                                <input class="form-check-input requiere_accion_correctiva" type="radio" name="requiere_accion" id="requiere_accion_si" value="1"
                                                        {{ old('requiere_accion', $asignacion->requiere_accion) == 1 ? 'checked' : '' }}>
                                            @else
                                                <input class="form-check-input requiere_accion_correctiva" type="radio" name="requiere_accion" id="requiere_accion_si" value="1">
                                            @endif
                                            <label class="form-check-label" for="requiere_accion_si">SI</label>

                                            @if($asignacion->estado == 7)
                                                <input class="form-check-input requiere_accion_correctiva" type="radio" name="requiere_accion" id="requiere_accion_no" value="0"
                                                        {{ old('requiere_accion', $asignacion->requiere_accion) == 0 ? 'checked' : '' }}>
                                            @else
                                                <input class="form-check-input requiere_accion_correctiva" type="radio" name="requiere_accion" id="requiere_accion_no" value="0">
                                            @endif
                                            <label class="form-check-label" for="requiere_accion_no">NO</label>
                                        </div>

                                        <div class="col-md-12" id="cont_radio_requiere_correccion">
                                            <label>Requiere Corrección</label><br>

                                            @if($asignacion->estado == 7)
                                                <input class="form-check-input requiere_correccion" type="radio" name="requiere_correccion" id="requiere_correccion_si" value="1"
                                                        {{ old('requiere_correccion', $asignacion->requiere_correccion) == 1 ? 'checked' : '' }}>
                                            @else
                                                <input class="form-check-input requiere_correccion" type="radio" name="requiere_correccion" id="requiere_correccion_si" value="1">
                                            @endif
                                            <label class="form-check-label" for="requiere_correccion_si">SI</label>

                                            @if($asignacion->estado == 7)
                                                <input class="form-check-input requiere_correccion" type="radio" name="requiere_correccion" id="requiere_correccion_no" value="0"
                                                        {{ old('requiere_correccion', $asignacion->requiere_correccion) == 0 ? 'checked' : '' }}>
                                            @else
                                                <input class="form-check-input requiere_correccion" type="radio" name="requiere_correccion" id="requiere_correccion_no" value="0">
                                            @endif
                                            <label class="form-check-label" for="requiere_correccion_no">NO</label>
                                        </div>
                                    </div>
                                @endif

                                <div id="content_viable" {{--style="display:{{$datos->id_clasificacion==1?'block':'none'}};"--}}>
                                    @if($datos->id_clasificacion==1)
                                        <div class="row" id="cont_valid_accion_correctiva" style="display:none;">
                                            <div class="col-md-12" >
                                                <label>
                                                    Acción Correctiva a Realizar :
                                                </label>
                                                @if($asignacion->estado == 7)
                                                    <textarea cols="100" rows="5" name="accion_correctiva" id="accion_correctiva">{{ old('accion_correctiva', $asignacion->accion_correctiva ?? '') }}</textarea>
                                                @else
                                                    <textarea cols="100" rows="5" name="accion_correctiva" id="accion_correctiva"></textarea>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row" id="cont_valid_reuiere_accion" style="display:none;">
                                            <div class="col-md-12" >
                                                <label>
                                                    Corrección a realizar :
                                                </label>
                                                @if($asignacion->estado == 7)
                                                    <textarea cols="100" rows="5" name="causa_raiz">{{ old('causa_raiz', $asignacion->causa_raiz ?? '') }}</textarea>
                                                @else
                                                    <textarea cols="100" rows="5" name="causa_raiz"></textarea>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    @php
                                        // 1. Acciones Correctivas (Tipo 1)
                                        /*$accionesPlan = \App\AudPlanAccion::where('id_responsable', $asignacion->id_responsable)
                                            ->where('tipo', 1)
                                            ->whereNull('deleted_at')->get();*/
                                         $accionesPlan = \App\AudPlanAccion::withTrashed() // <--- Agrega esto al principio
                                            ->where('id_responsable', $asignacion->id_responsable)
                                            ->where('tipo', 1)
                                            ->get();

                                        // 2. Correcciones (Tipo 2)
                                        /*$accionesCorreccion = \App\AudPlanAccion::where('id_responsable', $asignacion->id_responsable)
                                            ->where('tipo', 2)
                                            ->whereNull('deleted_at')->get();*/
                                          $accionesCorreccion = \App\AudPlanAccion::withTrashed() // <--- Agrega esto al principio
                                            ->where('id_responsable', $asignacion->id_responsable)
                                            ->where('tipo', 2)
                                            ->get();

                                        // 3. Oportunidades (Tipo 3)
                                        /*$accionesOportunidad = \App\AudPlanAccion::where('id_responsable', $asignacion->id_responsable)
                                            ->where('tipo', 3)
                                            ->whereNull('deleted_at')->get();*/
                                          $accionesOportunidad = \App\AudPlanAccion::withTrashed() // <--- Agrega esto al principio
                                            ->where('id_responsable', $asignacion->id_responsable)
                                            ->where('tipo', 3)
                                            ->get();
                                    @endphp
                                    <div class="row" id="contenedor_plan_acciones" style="display:none;">
                                        <div class="col-md-11  panel panel-success">
                                            <div class="panel-heading ">
                                                <h3 class="panel-title text-center">{{$datos->id_clasificacion==1?"Plan de la Acción Correctiva":"Plan de implementación"}}</h3>
                                            </div>
                                            <div class="panel-body">
                                                @if($accionesPlan->count() > 0)
                                                    @foreach($accionesPlan as $accionPlan)
                                                        <div class="row item_accion_plan">
                                                            <input type="hidden" name="id_plan_accion[]" value="{{$accionPlan->id_plan_acciones}}">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="acciones">Acciones</label>
                                                                    <textarea class="form-control" rows="5" name="acciones_plan[]" id="acciones">{{$accionPlan->acciones}}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="id_personal_implementar">
                                                                        Responsable de la actividad
                                                                    </label>
                                                                    <select class="form-control" name="personal_implementar_plan[]" id="id_personal_implementar">
                                                                        @foreach($personas as $responsable)
                                                                            <option value="{{$responsable->id_personal}}" {{ $accionPlan->id_responsable_implantar == $responsable->id_personal ? 'selected' : '' }}>
                                                                                {{$responsable->nombre}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <br>
                                                                <div class="form-group">
                                                                    <label for="id_personal_revisar">
                                                                        Responsable de revisar la eficacia de la actividad
                                                                    </label>
                                                                    <select class="form-control" name="personal_revisar_plan[]" id="id_personal_revisar">
                                                                        @foreach($personas as $responsable)
                                                                            <option value="{{$responsable->id_personal}}" {{$accionPlan->id_responsable_revisar == $responsable->id_personal ? 'selected' :''}}>
                                                                                {{$responsable->nombre}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="fecha_implementar">Fecha programada para terminar la actividad</label>
                                                                    <input type="date" class="form-control" name="fecha_implementar_plan[]" value="{{ $accionPlan->fecha_implantar_accion }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="fecha_verificacion">
                                                                        Fecha programada de la verificación
                                                                    </label>
                                                                    <input type="date" class="form-control" name="fecha_verificacion_plan[]" value="{{ $accionPlan->fecha_verificacion }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Medio verificación</label>
                                                                    <select class="form-control" name="medio_verificacion_plan[]">
                                                                        @foreach($evidenciaValida as $row)
                                                                            <option value="{{$row->id_evidencia}}" {{ $accionPlan->id_evidencia == $row->id_evidencia ? 'selected' : '' }}>
                                                                                {{$row->descripcion}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                {{--<div class="form-group">
                                                                    <label for="evidencia_acciones">Cargar evidencia</label>
                                                                    <input type="file" class="form-control" name="evidencia_acciones[]" id="evidencia_acciones" multiple accept=".pdf">
                                                                </div>--}}
                                                            </div>
                                                            <div class="col-md-3">
                                                                {{--<a id="add_accion_plan_implementaction" class="btn btn-primary" href="#" data-toggle="tooltip" title="Agregar">
                                                                    <span class="glyphicon glyphicon-plus"></span>
                                                                </a>--}}
                                                                <a class="btn btn-danger btn-remove-accion-plan" href="#!" data-toggle="tooltip" title="Eliminar">
                                                                    <span class="glyphicon glyphicon-trash"></span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="acciones">Acciones</label>
                                                                <textarea class="form-control" rows="5" name="acciones_plan[]" id="acciones"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="id_personal_implementar">
                                                                    Responsable de la actividad
                                                                </label>
                                                                <select class="form-control" name="personal_implementar_plan[]" id="id_personal_implementar">
                                                                    @foreach($personas as $responsable)
                                                                        <option value="{{$responsable->id_personal}}" {{$responsable->id_personal == $responsable->id_personal ? 'selected' :''}}> {{$responsable->nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <br>
                                                            <div class="form-group">
                                                                <label for="id_personal_revisar">
                                                                    Responsable de revisar la eficacia de la actividad
                                                                </label>
                                                                <select class="form-control" name="personal_revisar_plan[]" id="id_personal_revisar">
                                                                    @foreach($personas as $responsable)
                                                                        <option value="{{$responsable->id_personal}}" {{$responsable->id_personal == $responsable->id_personal ? 'selected' :''}}> {{$responsable->nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="fecha_implementar">Fecha programada para terminar la actividad</label>
                                                                <input type="date" class="form-control" name="fecha_implementar_plan[]">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fecha_verificacion">
                                                                    Fecha programada de la verificación
                                                                </label>
                                                                <input type="date" class="form-control" name="fecha_verificacion_plan[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="medio_verificacion_plan">
                                                                    Medio de verificación
                                                                </label>
                                                                <select class="form-control" name="medio_verificacion_plan[]" id="medio_verificacion_plan[]">
                                                                    <option value="" disabled selected>Seleccionar evidencia</option>
                                                                    @foreach($evidenciaValida as $row)
                                                                        <option value="{{$row->id_evidencia}}">{{$row->descripcion}}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            {{--<div class="form-group">
                                                                <label for="evidencia_acciones">Cargar evidencia</label>
                                                                <input type="file" class="form-control" name="evidencia_acciones[]" id="evidencia_acciones" multiple accept=".pdf">
                                                            </div>--}}
                                                        </div>
                                                        <div class="col-md-3">

                                                            <a class="btn btn-danger" href="" data-toggle="tooltip" title="Eliminar">
                                                                <span class="glyphicon glyphicon-trash"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                                <a id="add_accion_plan_implementaction" class="btn btn-primary" href="#" data-toggle="tooltip" title="Agregar">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="cont_acciones_plan_implementacion"></div>

                                    {{--CONTENEDOR DE CORRECCIONES--}}
                                    <div class="row" id="contenedor_plan_correcciones" style="display:none;">
                                        <div class="col-md-11 panel panel-success">
                                            <div class="panel-heading">
                                                <h3 class="panel-title text-center">{{$datos->id_clasificacion==1?"Plan de corrección":""}}</h3>
                                            </div>
                                            <div class="panel-body">
                                                @if($accionesCorreccion->count() > 0)
                                                    @foreach($accionesCorreccion as $accionCorreccion)
                                                        <div class="row item_correccion">
                                                            <input type="hidden" name="id_correccion_accion[]" value="{{$accionCorreccion->id_plan_acciones}}">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="acciones">Acciones</label>
                                                                    <textarea class="form-control" rows="5" id="acciones" name="acciones_correcciones[]">{{$accionCorreccion->acciones}}</textarea>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="id_responsable_implantar">Responsable de implantar</label>
                                                                    <select class="form-control" name="personal_implementar_correccion[]">
                                                                        @foreach($personas as $responsable)
                                                                            <option value="{{$responsable->id_personal}}" {{ $accionCorreccion->id_responsable_implantar == $responsable->id_personal ? 'selected' : '' }}>
                                                                                {{$responsable->nombre}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="personal_revisar_correccion">Responsable de revisar</label>
                                                                    <select class="form-control" name="personal_revisar_correccion[]">
                                                                        @foreach($personas as $responsable)
                                                                            <option value="{{$responsable->id_personal}}" {{$accionCorreccion->id_responsable_revisar == $responsable->id_personal ? 'selected' :''}}>
                                                                                {{$responsable->nombre}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="fecha_implementar">Fecha programada para implementar la acción</label>
                                                                    <input type="date" class="form-control" name="fecha_implementar_correccion[]" value="{{ $accionCorreccion->fecha_implantar_accion }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="fecha_verificacion">Fecha programada de la verificación</label>
                                                                    <input type="date" name="fecha_verificacion_correccion[]" class="form-control" value="{{ $accionCorreccion->fecha_verificacion }}">
                                                                </div>
                                                            </div>


                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Medio verificación</label>
                                                                    <select class="form-control" name="medio_verificacion_correccion[]">
                                                                        @foreach($evidenciaValida as $row)
                                                                            <option value="{{$row->id_evidencia}}" {{ $accionCorreccion->id_evidencia == $row->id_evidencia ? 'selected' : '' }}>
                                                                                {{$row->descripcion}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            {{--<div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="evidencia_correcciones">Cargar evidencia</label>
                                                                    <input type="file" class="form-control" name="evidencia_correcciones[]" id="evidencia_correcciones" multiple accept=".pdf">
                                                                </div>
                                                            </div>--}}

                                                            <div class="col-md-3">
                                                                {{--<a class="btn btn-primary" href="#" id="add_accion_plan_correcciones" data-toggle="tooltip" title="Agregar">
                                                                    <span class="glyphicon glyphicon-plus"></span>
                                                                </a>--}}
                                                                <a class="btn btn-danger btn-remove-correccion" href="" data-toggle="tooltip" title="Eliminar">
                                                                    <span class="glyphicon glyphicon-trash"></span>
                                                                </a>
                                                            </div>

                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="acciones">Acciones</label>
                                                                <textarea class="form-control" rows="5" id="acciones" name="acciones_correcciones[]"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="id_responsable_implantar">Responsable de implantar</label>
                                                                <select class="form-control" name="personal_implementar_correccion[]">
                                                                    @foreach($personas as $responsable)
                                                                        <option value="{{$responsable->id_personal}}">{{$responsable->nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="personal_revisar_correccion">Responsable de revisar</label>
                                                                <select class="form-control" name="personal_revisar_correccion[]">
                                                                    @foreach($personas as $responsable)
                                                                        <option value="{{$responsable->id_personal}}">{{$responsable->nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="fecha_implementar">Fecha programada para implementar la acción</label>
                                                                <input type="date" class="form-control" name="fecha_implementar_correccion[]">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fecha_verificacion">Fecha programada de la verificación</label>
                                                                <input type="date" name="fecha_verificacion_correccion[]" class="form-control">
                                                            </div>
                                                        </div>


                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="fecha_implementar">Medio de verificación</label>
                                                                <select class="form-control"  name="medio_verificacion_correccion[]" id="medio_verificacion_correccion[]">
                                                                    @foreach($evidenciaValida as $row)
                                                                        <option value="{{$row->id_evidencia}}">{{$row->descripcion}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        {{--<div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="evidencia_correcciones">Cargar evidencia</label>
                                                                <input type="file" class="form-control" name="evidencia_correcciones[]" id="evidencia_correcciones" multiple accept=".pdf">
                                                            </div>
                                                        </div>--}}

                                                        <div class="col-md-3">

                                                            <a class="btn btn-danger btn-remove-correccion" href="" data-toggle="tooltip" title="Eliminar">
                                                                <span class="glyphicon glyphicon-trash"></span>
                                                            </a>
                                                        </div>

                                                    </div>
                                                @endif
                                                <a class="btn btn-primary" href="#" id="add_accion_plan_correcciones" data-toggle="tooltip" title="Agregar">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    {{--DIV PARA EL CONTENEDOR NUEVO QUE SE AGREGA EN EL BOTÓN AGREGAR--}}
                                    <div id="cont_correcciones_implementadas"></div>



                                    @if($datos->id_clasificacion==2)
                                        <!-- CONTENEDOR PRINCIPAL -->
                                        <div class="row" id="contenedor_oportunidades" style="display:none;">
                                            <div class="col-md-11 panel panel-success">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title text-center">Plan de implementación</h3>
                                                </div>
                                                <div class="panel-body">
                                                    @if($accionesOportunidad->count() > 0)
                                                        @foreach($accionesOportunidad as $accionOportunidad)
                                                            <div class="row item_oportunidad">
                                                                <input type="hidden" name="id_oportunidad_accion[]" value="{{$accionOportunidad->id_plan_acciones}}">
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="acciones">Acciones</label>
                                                                        <textarea class="form-control" rows="5" name="acciones_oportunidades[]">{{$accionOportunidad->acciones}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="id_personal_implementar">Responsable de la actividad</label>
                                                                        <select class="form-control" name="personal_implementar_oportunidades[]">
                                                                            @foreach($personas as $responsable)
                                                                                <option value="{{$responsable->id_personal}}" {{ $accionOportunidad->id_responsable_implantar == $responsable->id_personal ? 'selected' : '' }}>
                                                                                    {{$responsable->nombre}}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <br>
                                                                    <div class="form-group">
                                                                        <label for="id_personal_revisar">Responsable de revisar la eficacia de la actividad</label>
                                                                        <select class="form-control" name="personal_revisar_oportunidades[]">
                                                                            @foreach($personas as $responsable)
                                                                                <option value="{{$responsable->id_personal}}" {{$accionOportunidad->id_responsable_revisar == $responsable->id_personal ? 'selected' :''}}>
                                                                                    {{$responsable->nombre}}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="fecha_implementar">Fecha programada para terminar la actividad</label>
                                                                        <input type="date" class="form-control" name="fecha_implementar_oportunidades[]" value="{{ $accionOportunidad->fecha_implantar_accion }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="fecha_verificacion">Fecha programada de la verificación</label>
                                                                        <input type="date" class="form-control" name="fecha_verificacion_oportunidades[]" value="{{ $accionOportunidad->fecha_verificacion }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="medio_verificacion">Medio de verificación</label>
                                                                        <select class="form-control" name="medio_verificacion_oportunidades[]">
                                                                            @foreach($evidenciaValida as $row)
                                                                                <option value="{{$row->id_evidencia}}" {{ $accionOportunidad->id_evidencia == $row->id_evidencia ? 'selected' : '' }}>
                                                                                    {{$row->descripcion}}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                {{--<div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="evidencia_oportunidades">Cargar evidencia</label>
                                                                        <input type="file" class="form-control" name="evidencia_oportunidades[]" id="evidencia_oportunidades" multiple accept=".pdf">
                                                                    </div>
                                                                </div>--}}
                                                                <a href="#!" class="btn btn-danger btn-remove-oportunidad" data-toggle="tooltip" title="Eliminar">
                                                                    <span class="glyphicon glyphicon-trash"></span>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="row item_oportunidad">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="acciones">Acciones</label>
                                                                    <textarea class="form-control" rows="5" name="acciones_oportunidades[]"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="id_personal_implementar">Responsable de la actividad</label>
                                                                    <select class="form-control" name="personal_implementar_oportunidades[]">
                                                                        @foreach($personas as $responsable)
                                                                            <option value="{{$responsable->id_personal}}">{{$responsable->nombre}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <br>
                                                                <div class="form-group">
                                                                    <label for="id_personal_revisar">Responsable de revisar la eficacia de la actividad</label>
                                                                    <select class="form-control" name="personal_revisar_oportunidades[]">
                                                                        @foreach($personas as $responsable)
                                                                            <option value="{{$responsable->id_personal}}">{{$responsable->nombre}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="fecha_implementar">Fecha programada para terminar la actividad</label>
                                                                    <input type="date" class="form-control" name="fecha_implementar_oportunidades[]">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="fecha_verificacion">Fecha programada de la verificación</label>
                                                                    <input type="date" class="form-control" name="fecha_verificacion_oportunidades[]">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="medio_verificacion">Medio de verificación</label>
                                                                    <select class="form-control" name="medio_verificacion_oportunidades[]">
                                                                        @foreach($evidenciaValida as $row)
                                                                            <option value="{{$row->id_evidencia}}">{{$row->descripcion}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            {{--<div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="evidencia_oportunidades">Cargar evidencia</label>
                                                                    <input type="file" class="form-control" name="evidencia_oportunidades[]" id="evidencia_oportunidades" multiple accept=".pdf">
                                                                </div>
                                                            </div>--}}
                                                            <a href="#!" class="btn btn-danger btn-remove-oportunidad" data-toggle="tooltip" title="Eliminar">
                                                                <span class="glyphicon glyphicon-trash"></span>
                                                            </a>
                                                        </div>
                                                    @endif
                                                    <div class="row">
                                                        <a href="#!" id="add_accion_plan_oportunidades" class="btn btn-primary" data-toggle="tooltip" title="Agregar">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- DIV PARA EL CONTENEDOR NUEVO QUE SE AGREGA -->
                                    <div id="cont_oportunidades_implementadas"></div>

                                    <div class="row">
                                        <div class="alert alert-info text-center">
                                            <h4>Actualización de riesgos y oportunidades</h4>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="form-check form-check-inline">
                                                    @if($asignacion->estado == 7)
                                                        <input class="form-check-input" type="radio" name="actulizacion_riesgos" id="actulizacion_riesgos_si" value="1"
                                                                {{ old('actulizacion_riesgos', $asignacion->actualizacion_riesgos) == 1 ? 'checked' : '' }}>
                                                    @else
                                                        <input class="form-check-input" type="radio" name="actulizacion_riesgos" id="actulizacion_riesgos_si" value="1">
                                                    @endif
                                                    <label class="form-check-label" for="actulizacion_riesgos_si">
                                                        SI ¿Por qué?
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    @if($asignacion->estado == 7)
                                                        <input class="form-check-input" type="radio" name="actulizacion_riesgos" id="actulizacion_riesgos_no" value="0"
                                                                {{ old('actulizacion_riesgos', $asignacion->actualizacion_riesgos) == 0 ? 'checked' : '' }}>
                                                    @else
                                                        <input class="form-check-input" type="radio" name="actulizacion_riesgos" id="actulizacion_riesgos_no" value="0">
                                                    @endif
                                                    <label class="form-check-label" for="actulizacion_riesgos_no">
                                                        NO ¿Por qué?
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                @if($asignacion->estado == 7)
                                                    <textarea class="form-control" name="motivo_actualizacion_riesgos" id="motivo_actualizacion_riesgos" rows="6">{{ old('motivo_actualizacion_riesgos', $asignacion->valor_actr) }}</textarea>
                                                @else
                                                    <textarea class="form-control" name="motivo_actualizacion_riesgos" id="motivo_actualizacion_riesgos" rows="6"></textarea>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="alert alert-info text-center">
                                            <h4>Cambios al sistema de gestión para organizaciones educativas</h4>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="form-check form-check-inline">
                                                    @if($asignacion->estado == 7)
                                                        <input class="form-check-input" type="radio" name="cambios_sistemaOE" id="cambios_sistemaOE_si" value="1"
                                                                {{ old('cambios_sistemaOE', $asignacion->cambios_sistema) == 1 ? 'checked' : '' }}>
                                                    @else
                                                        <input class="form-check-input" type="radio" name="cambios_sistemaOE" id="cambios_sistemaOE_si" value="1">
                                                    @endif
                                                    <label class="form-check-label" for="cambios_sistemaOE_si">
                                                        SI ¿Por qué?
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    @if($asignacion->estado == 7)
                                                        <input class="form-check-input" type="radio" name="cambios_sistemaOE" id="cambios_sistemaOE_no" value="0"
                                                                {{ old('cambios_sistemaOE', $asignacion->cambios_sistema) == 0 ? 'checked' : '' }}>
                                                    @else
                                                        <input class="form-check-input" type="radio" name="cambios_sistemaOE" id="cambios_sistemaOE_no" value="0">
                                                    @endif
                                                    <label class="form-check-label" for="cambios_sistemaOE_no">
                                                        NO ¿Por qué?
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                @if($asignacion->estado == 7)
                                                    <textarea class="form-control" name="motivo_cambios_sistemaOE" id="motivo_cambios_sistemaOE" rows="6">{{ old('motivo_cambios_sistemaOE', $asignacion->valor_cambios) }}</textarea>
                                                @else
                                                    <textarea class="form-control" name="motivo_cambios_sistemaOE" id="motivo_cambios_sistemaOE" rows="6"></textarea>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Botón Guardar Centrado -->
                                    <div class="row mt-4">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-success btn-lg px-5">
                                                <i class="fas fa-save me-2"></i>Enviar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            @endforeach

        </form>
    </main>

    {{--CONTENEDOR FAKE DEL PLAN DE ACCIONES CORRECTIVAS--}}
    <div id="cont_acciones_plan_implementacion_fake" style="display: none">
        <div class="row" class="item_acciones_plan_implementacion">
            <input type="hidden" name="id_plan_accion[]" value="">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="acciones">Acciones</label>
                    <textarea class="form-control" rows="5" id="acciones_plan" name="acciones_plan[]"></textarea>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="id_personal_implementar">
                        Responsable de la actividad
                    </label>
                    <select class="form-control"  name="personal_implementar_plan[]">
                        @foreach($personas as $responsable)
                            <option value="{{$responsable->id_personal}}" {{$responsable->id_personal == $responsable->id_personal ? 'selected' :''}}> {{$responsable->nombre}}</option>

                        @endforeach
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label for="id_personal_revisar">
                        Responsable de revisar la eficacia de la actividad
                    </label>
                    <select  class="form-control" name="personal_revisar_plan[]">
                        @foreach($personas as $responsable)
                            <option value="{{$responsable->id_personal}}" {{$responsable->id_personal == $responsable->id_personal ? 'selected' :''}}> {{$responsable->nombre}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="fecha_implementar">Fecha programada para terminar la actividad</label>
                    <input type="date" name="fecha_implementar_plan[]" class="form-control">
                </div>
                <div class="form-group">
                    <label for="fecha_implementar">
                        Fecha programada de la verificación
                    </label>
                    <input type="date" name="fecha_verificacion_plan[]" class="form-control">
                </div>

            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="fecha_implementar">
                        Medio de verificación
                    </label>
                    <select class="form-control"  name="medio_verificacion_plan[]" id="">
                        @foreach($evidenciaValida as $row)
                            <option value="{{$row->id_evidencia}}">{{$row->descripcion}}</option>
                        @endforeach
                    </select>
                </div>



            </div>
            <div class="col-md-3">
                {{--<div class="form-group">
                    <label for="evidencia_acciones">Cargar evidencia</label>
                    <input type="file" class="form-control" name="evidencia_acciones[]" id="evidencia_acciones" multiple accept=".pdf">
                </div>--}}
                <a href="#!" id="" class="btn btn-danger" data-toggle="tooltip" title="Eliminar"><span class="glyphicon glyphicon-trash"></span>
                </a>
            </div>
        </div>

    </div>

    {{--CONTENEDOR FAKE DEL PROGRAMA DE CORRECCIONES--}}
    <div id="contenedor_plan_correcciones_fake" style="display: none">
        <div class="row item_correccion">
            <input type="hidden" name="id_correccion_accion[]" value="">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="acciones">Acciones</label>
                    <textarea class="form-control" rows="5" name="acciones_correcciones[]"></textarea>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="id_responsable_implantar">Responsable de implantar</label>
                    <select class="form-control" name="personal_implementar_correccion[]">
                        @foreach($personas as $responsable)
                            <option value="{{$responsable->id_personal}}">{{$responsable->nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="personal_revisar_correccion">Responsable de revisar</label>
                    <select class="form-control" name="personal_revisar_correccion[]">
                        @foreach($personas as $responsable)
                            <option value="{{$responsable->id_personal}}">{{$responsable->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="fecha_implementar">Fecha programada para implementar la acción</label>
                    <input type="date" name="fecha_implementar_correccion[]" class="form-control">
                </div>
                <div class="form-group">
                    <label for="fecha_verificacion">Fecha programada de la verificación</label>
                    <input type="date" name="fecha_verificacion_correccion[]" class="form-control">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="medio_verificacion_correccion">Medio de verificación</label>
                    <select class="form-control" name="medio_verificacion_correccion[]">
                        @foreach($evidenciaValida as $row)
                            <option value="{{$row->id_evidencia}}">{{$row->descripcion}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{--<div class="col-md-3">
                <div class="form-group">
                    <label for="evidencia_correcciones">Cargar evidencia</label>
                    <input type="file" class="form-control" name="evidencia_correcciones[]" id="evidencia_correcciones" multiple accept=".pdf">
                </div>
            </div>--}}

            <div class="col-md-3">
                <a href="#!" class="btn btn-danger btn-remove-correccion" data-toggle="tooltip" title="Eliminar">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </div>
        </div>
    </div>

    <!-- CONTENEDOR FAKE DEL PLAN DE IMPLEMENTACIÓN (OPORTUNIDADES) -->
    <div id="contenedor_oportunidades_fake" style="display:none;">
        <div class="row item_oportunidad">
            <input type="hidden" name="id_oportunidad_accion[]" value="">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="acciones">Acciones</label>
                    <textarea class="form-control" rows="5" name="acciones_oportunidades[]"></textarea>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="id_personal_implementar">Responsable de la actividad</label>
                    <select class="form-control" name="personal_implementar_oportunidades[]">
                        @foreach($personas as $responsable)
                            <option value="{{$responsable->id_personal}}">{{$responsable->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label for="id_personal_revisar">Responsable de revisar la eficacia de la actividad</label>
                    <select class="form-control" name="personal_revisar_oportunidades[]">
                        @foreach($personas as $responsable)
                            <option value="{{$responsable->id_personal}}">{{$responsable->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="fecha_implementar">Fecha programada para terminar la actividad</label>
                    <input type="date" name="fecha_implementar_oportunidades[]" class="form-control">
                </div>
                <div class="form-group">
                    <label for="fecha_verificacion">Fecha programada de la verificación</label>
                    <input type="date" name="fecha_verificacion_oportunidades[]" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="medio_verificacion">Medio de verificación</label>
                    <select class="form-control" name="medio_verificacion_oportunidades[]">
                        @foreach($evidenciaValida as $row)
                            <option value="{{$row->id_evidencia}}">{{$row->descripcion}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                {{--<div class="form-group">
                    <label for="evidencia_oportunidades">Cargar evidencia</label>
                    <input type="file" class="form-control" name="evidencia_oportunidades[]" id="evidencia_oportunidades" multiple accept=".pdf">
                </div>--}}
                <a href="#!" class="btn btn-danger btn-remove-oportunidad" data-toggle="tooltip" title="Eliminar">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $( "#save_accion" ).on( "submit", function( event ) {
                let isValid=true;

                let ra_act_riesgo=$('input[name="actulizacion_riesgos"]:checked').val()
                let ra_camb=$('input[name="cambios_sistemaOE"]:checked').val()

                if (
                    $("#analisis").val() == "" ||
                    ra_act_riesgo === undefined ||
                    ra_camb === undefined ||
                    $("#motivo_actualizacion_riesgos").val() == "" ||
                    $("#motivo_cambios_sistemaOE").val() == "" ||
                    ($("#contenedor_plan_acciones").is(":visible") && $("#acciones").val() == "") ||
                    ($("#cont_valid_accion_correctiva").is(":visible") && $("#accion_correctiva").val() == "") ||
                    ($("#cont_valid_reuiere_accion").is(":visible") && $('textarea[name="causa_raiz"]').val() == "") ||

                        @if($datos->id_clasificacion == 1)
                        $('input[name="requiere_accion"]:checked').length === 0 ||
                    $('input[name="requiere_correccion"]:checked').length === 0 ||
                        @endif

                            false // <- evita que el último "||" cause error
                )
                    isValid = false;

                if ($("#contenedor_plan_correcciones").is(":visible")) {
                    $("#contenedor_plan_correcciones textarea[name='acciones_correcciones[]'], #cont_correcciones_implementadas textarea[name='acciones_correcciones[]']").each(function () {
                        if ($(this).val().trim() === "") {
                            isValid = false;
                        }
                    });

                    $("#contenedor_plan_correcciones input[name='fecha_implementar_correccion[]'], #cont_correcciones_implementadas input[name='fecha_implementar_correccion[]']").each(function () {
                        if ($(this).val().trim() === "") {
                            isValid = false;
                        }
                    });

                    $("#contenedor_plan_correcciones input[name='fecha_verificacion_correccion[]'], #cont_correcciones_implementadas input[name='fecha_verificacion_correccion[]']").each(function () {
                        if ($(this).val().trim() === "") {
                            isValid = false;
                        }
                    });

                    $("#contenedor_plan_correcciones select[name='medio_verificacion_correccion[]'], #cont_correcciones_implementadas select[name='medio_verificacion_correccion[]']").each(function () {
                        if ($(this).val() === "" || $(this).val() === null) {
                            isValid = false;
                        }
                    });

                    $("#contenedor_plan_correcciones select[name='personal_implementar_correccion[]'], #cont_correcciones_implementadas select[name='personal_implementar_correccion[]']").each(function () {
                        if ($(this).val() === "" || $(this).val() === null) {
                            isValid = false;
                        }
                    });

                    $("#contenedor_plan_correcciones select[name='personal_revisar_correccion[]'], #cont_correcciones_implementadas select[name='personal_revisar_correccion[]']").each(function () {
                        if ($(this).val() === "" || $(this).val() === null) {
                            isValid = false;
                        }
                    });
                }

                if ($("#contenedor_plan_acciones").is(":visible")) {
                    $("#contenedor_plan_acciones textarea[name='acciones_plan[]'], #cont_acciones_plan_implementacion textarea[name='acciones_plan[]']").each(function () {
                        if ($(this).val().trim() === "") {
                            isValid = false;
                        }
                    });

                    $("#contenedor_plan_acciones select[name='personal_implementar_plan[]'], #cont_acciones_plan_implementacion select[name='personal_implementar_plan[]']").each(function () {
                        if ($(this).val().trim() === "") {
                            isValid = false;
                        }
                    });

                    $("#contenedor_plan_acciones select[name='personal_revisar_plan[]'], #cont_acciones_plan_implementacion select[name='personal_revisar_plan[]']").each(function () {
                        if ($(this).val().trim() === "") {
                            isValid = false;
                        }
                    });

                    $("#contenedor_plan_acciones input[name='fecha_implementar_plan[]'], #cont_acciones_plan_implementacion input[name='fecha_implementar_plan[]']").each(function () {
                        if ($(this).val().trim() === "") {
                            isValid = false;
                        }
                    });

                    $("#contenedor_plan_acciones input[name='fecha_verificacion_plan[]'], #cont_acciones_plan_implementacion input[name='fecha_verificacion_plan[]']").each(function () {
                        if ($(this).val().trim() === "") {
                            isValid = false;
                        }
                    });

                    $("#contenedor_plan_acciones select[name='medio_verificacion_plan[]'], #cont_acciones_plan_implementacion select[name='medio_verificacion_plan[]']").each(function () {
                        if ($(this).val() === "" || $(this).val() === null) {
                            isValid = false;
                        }
                    });
                }

                if ($("#contenedor_oportunidades").is(":visible")) {
                    $("#contenedor_oportunidades textarea[name='acciones_oportunidades[]'], #cont_oportunidades_implementadas textarea[name='acciones_oportunidades[]']").each(function () {
                        if ($(this).val().trim() === "") {
                            isValid = false;
                        }
                    });

                    $("#contenedor_oportunidades select[name='personal_implementar_oportunidades[]'], #cont_oportunidades_implementadas select[name='personal_implementar_oportunidades[]']").each(function () {
                        if ($(this).val() === "" || $(this).val() === null) {
                            isValid = false;
                        }
                    });

                    $("#contenedor_oportunidades select[name='personal_revisar_oportunidades[]'], #cont_oportunidades_implementadas select[name='personal_revisar_oportunidades[]']").each(function () {
                        if ($(this).val() === "" || $(this).val() === null) {
                            isValid = false;
                        }
                    });

                    $("#contenedor_oportunidades input[name='fecha_implementar_oportunidades[]'], #cont_oportunidades_implementadas input[name='fecha_implementar_oportunidades[]']").each(function () {
                        if ($(this).val().trim() === "") {
                            isValid = false;
                        }
                    });

                    $("#contenedor_oportunidades input[name='fecha_verificacion_oportunidades[]'], #cont_oportunidades_implementadas input[name='fecha_verificacion_oportunidades[]']").each(function () {
                        if ($(this).val().trim() === "") {
                            isValid = false;
                        }
                    });

                    $("#contenedor_oportunidades select[name='medio_verificacion_oportunidades[]'], #cont_oportunidades_implementadas select[name='medio_verificacion_oportunidades[]']").each(function () {
                        if ($(this).val() === "" || $(this).val() === null) {
                            isValid = false;
                        }
                    });
                }

                @if($datos->id_clasificacion==2)

                $("#contenedor_oportunidades textarea[name*='acciones_oportunidades']").each(function()
                {
                    if($(this).val()=="")
                        isValid=false
                })
                $("#contenedor_oportunidades select[name*='personal_implementar_plan']").each(function()
                {
                    if($(this).val()=="")
                        isValid=false
                })
                $("#contenedor_oportunidades select[name*='personal_revisar_plan']").each(function()
                {
                    if($(this).val()=="")
                        isValid=false
                })
                $("#contenedor_oportunidades input[name*='fecha_implementar_plan']").each(function()
                {
                    if($(this).val()=="")
                        isValid=false
                })
                $("#contenedor_oportunidades input[name*='fecha_verificacion_plan']").each(function()
                {
                    if($(this).val()=="")
                        isValid=false
                })
                $("#contenedor_oportunidades select[name*='medio_verificacion_plan']").each(function()
                {
                    if($(this).val()=="")
                        isValid=false
                })

                @else


                @endif

                @if($datos->id_clasificacion == 1)
                const accionVal = $('input[name="requiere_accion"]:checked').val();
                const correccionVal = $('input[name="requiere_correccion"]:checked').val();

                if (accionVal === "0" && correccionVal === "0") {
                    isValid = false;

                    swal({
                        title: "No puedes seleccionar 'NO' en ambas opciones",
                        text: "Debe marcar 'SI' al menos en 'Actividad Correctiva' o en 'Corrección'.",
                        icon: "warning",
                        confirmButtonText: "Aceptar"
                    });

                    return false; // Detener envío del formulario
                }
                @endif

                if(!isValid) {
                    event.preventDefault();
                    swal({
                        title: "Llenar todos los campos",
                        allowOutsideClick: false,
                        // showCancelButton: true,
                        //  cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Aceptar',
                    })
                }
            });

            $("#cont_acciones_plan_implementacion").on("click", "a",function(){
                $(this).parent().parent().html("");
            });

            $("#add_accion_plan_implementaction").click(function(){
                $("#cont_acciones_plan_implementacion").append($("#cont_acciones_plan_implementacion_fake").html());
            });
            $(".requiere_accion_correctiva").click(function (){
                let value=$(this).val();
                if(value==1)
                {
                    $("#contenedor_plan_acciones").show();
                    // $("#contenedor_plan_correcciones").hide();

                    $("#cont_valid_accion_correctiva").show();
                    //$("#cont_valid_reuiere_accion").hide();

                    //$("#requiere_correccion_si").prop('checked', false);
                    //$("#requiere_correccion_no").prop('checked', true);;

                }
                else
                {
                    $("#contenedor_plan_acciones").hide();
                    //$("#contenedor_plan_correcciones").show();

                    // $("#requiere_correccion_no").prop('checked', false);
                    //  $("#requiere_correccion_si").prop('checked', true);

                    $("#cont_valid_accion_correctiva").hide();
                    //$("#cont_valid_reuiere_accion").show();

                }

            });

            $(".requiere_correccion").click(function (){
                let value=$(this).val();
                if(value==1) {
                    //$("#requiere_accion_correctiva_si").prop('checked', false);
                    //$("#requiere_accion_correctiva_no").prop('checked', true);;

                    $("#cont_valid_reuiere_accion").show();
                    //$("#cont_valid_accion_correctiva").hide();

                    // $("#contenedor_plan_acciones").hide();
                    $("#contenedor_plan_correcciones").show();

                }
                else
                {
                    //$("#contenedor_plan_acciones").show();
                    $("#contenedor_plan_correcciones").hide();

                    // $("#requiere_accion_correctiva_si").prop('checked', true);
                    //$("#requiere_accion_correctiva_no").prop('checked', false);

                    $("#cont_valid_reuiere_accion").hide();
                    //$("#cont_valid_accion_correctiva").show();

                }
            });

            $("#active_viable").click(function(){
                // alert("ok");
                let isViable=$(this).is(':checked');
                if(isViable) {
                    $("#contenedor_oportunidades").show()

                }
                else {
                    $("#contenedor_oportunidades").hide()

                }

            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.body.addEventListener('click', function (e) {
                // Para plan de acciones correcctivas
                if (e.target.closest('#add_accion_plan_implementaction')) {
                    e.preventDefault();
                    let template = document.querySelector('#contenedor_plan_acciones_fake');
                    let clone = template.cloneNode(true);
                    clone.id = '';
                    clone.style.display = 'block';
                    document.querySelector('#cont_acciones_plan_implementacion').appendChild(clone);
                }

                // Para programa de correcciones
                if (e.target.closest('#add_accion_plan_correcciones')) {
                    e.preventDefault();
                    let template = document.querySelector('#contenedor_plan_correcciones_fake');
                    let clone = template.cloneNode(true);
                    clone.id = '';
                    clone.style.display = 'block';
                    document.querySelector('#cont_correcciones_implementadas').appendChild(clone);
                }

                // Eliminar Acción Correctiva (Tipo 1)
                if (e.target.closest('.btn-remove-accion-plan')) {
                    e.preventDefault();
                    // Busca el contenedor padre más cercano con la clase específica
                    e.target.closest('.item_accion_plan')?.remove();
                }

                // Eliminar acción (genérico)
                if (e.target.closest('.btn-remove-correccion')) {
                    e.preventDefault();
                    e.target.closest('.item_correccion')?.remove();
                }

                // Para plan de implementación (oportunidades)
                if (e.target.closest('#add_accion_plan_oportunidades')) {
                    e.preventDefault();
                    let template = document.querySelector('#contenedor_oportunidades_fake');
                    let clone = template.cloneNode(true);
                    clone.id = '';
                    clone.style.display = 'block';
                    document.querySelector('#cont_oportunidades_implementadas').appendChild(clone);
                }

                // Eliminar oportunidad
                if (e.target.closest('.btn-remove-oportunidad')) {
                    e.preventDefault();
                    e.target.closest('.item_oportunidad')?.remove();
                }
            });
        });
    </script>


@endsection