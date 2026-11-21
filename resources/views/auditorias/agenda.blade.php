@extends('layouts.panel')
@section('title', 'Agenda del Plan')
@include('partials.panel.recursos_app')
@section('content')
    @if(\Illuminate\Support\Facades\Session::get('errors'))
        <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" role="alert">
            @foreach(\Illuminate\Support\Facades\Session::get('errors')->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>
        @if(\Illuminate\Support\Facades\Session::forget('errors'))@endif
    @endif
    <main class="tw-pantalla tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-6/12 tw:lg:ml-[25%] tw:px-2">
                @if (session()->has('flash_notification.message'))
                    <x-panel.alerta class="tw:mb-4" :tipo="['success' => 'exito', 'danger' => 'error', 'warning' => 'advertencia'][session('flash_notification.level')] ?? 'info'">{!! session('flash_notification.message') !!}</x-panel.alerta>
                @endif
            </div>
        </div>
        <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
            <nav aria-label="Ruta de navegación" class="tw:mb-5 tw:flex tw:flex-wrap tw:items-center tw:gap-x-2 tw:gap-y-1 tw:text-sm tw:text-gray-500">
                <span class="fa fa-arrow-right tw:text-brand-500"></span>
                <a class="tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{url('/auditorias/programas')}}">Programas de auditoría</a>
                <span class="fa fa-chevron-right tw:text-[10px] tw:text-gray-400"></span>
                <a class="tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{url('/auditorias/programas')}}/{{\Illuminate\Support\Facades\Session::get('id_programa')}}">Detalles del programa</a>
                <span class="fa fa-chevron-right tw:text-[10px] tw:text-gray-400"></span>
                <a class="tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{url('/auditorias/programas')}}/{{\Illuminate\Support\Facades\Session::get('id_programa')}}/edit">Planes del programa</a>
                <span class="fa fa-chevron-right tw:text-[10px] tw:text-gray-400"></span>
                <a class="tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{url('/auditorias/planes')}}/{{$auditoria_id}}">Detalles del plan</a>
                <span class="fa fa-chevron-right tw:text-[10px] tw:text-gray-400"></span>
                <span class="tw:text-gray-800 tw:dark:text-white/90">Agenda del plan</span>
            </nav>
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                    @if($porcentaje>=100)
                        <a href="{{url('auditorias/printPlan')}}/{{$auditoria_id}}" class="tw:float-right"><span class="fa fa-print"></span></a>
                    @endif
                    @foreach($auditorias as $auditoria_n)
                        @if($auditoria_n->id_auditoria==$auditoria_id)
                            <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Agenda del plan {{\Carbon\Carbon::parse($auditoria_n->fecha_i)->format('Y')}}-{{$loop->iteration}}</h3>
                        @endif
                    @endforeach
                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    @if($porcentaje>0)
                        <div class="tw:mb-3 tw:flex tw:h-5 tw:w-full tw:overflow-hidden tw:rounded-full tw:bg-gray-200" id="porcentaje">
                            <div class="tw:flex tw:h-full tw:items-center tw:justify-center tw:bg-brand-500 tw:text-xs tw:font-medium tw:text-white" role="progressbar" aria-valuenow="{{$porcentaje}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$porcentaje}}%;">
                                Agendado el {{$porcentaje}}% de los procesos del plan
                            </div>
                        </div>
                    @endif

                    <div class="horarios">
                        <div id="exTab2" class="">
                            <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200">
                                @foreach($fechas as $dia)
                                    <li class="{{$dia==Session::get('dia')?'active':''}} elemento" data-item="{{$dia}}"><a href="#{{$dia}}" class="tab" data-fecha="{{$dia}}" data-toggle="tab" aria-expanded="{{$dia==Session::get('dateUsed')?'true':'false'}}">{{\Carbon\Carbon::parse($dia)->locale('es')->translatedFormat('d-m-Y')}}</a></li>
                                @endforeach
                            </ul>
                            <div class="tab-content">

                                @foreach($fechas as $dia)
                                    <div class="tab-pane {{$dia==Session::get('dia')?'active':''}}"  id="{{$dia}}">
                                        <div class="form_programar{{$dia}} tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white" {{$dia==Session::get('dia')?Session::get('editando'):'hidden'}}>
                                            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                                                <a href="#" class="btn-cancelar-agregar tw:float-right" data-fecha="{{$dia}}" data-toggle="tooltip" title="Cancelar"><span class="fa fa-times"></span></a>
                                                <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Agregar evento a la agenda</h3>
                                            </div>
                                            <div class="tw:p-5 tw:sm:p-6">
                                                <form id="form_programar{{$dia}}" action="{{url('auditorias/agenda')}}" method="POST">
                                                    @csrf
                                                    <input class="opcion" type="text" name="opcion" hidden value="">
                                                    <input type="text" name="fecha" hidden value="{{$dia}}">
                                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                                            <div class="tw:mb-4">
                                                                <label for="proceso">Proceso(s) a auditar&nbsp;<a href="{{url('auditorias/agenda')}}/{{$auditoria_id}}/{{$dia}}/edit" class="tw:float-right" data-toggle="tooltip" title="Seleccionar procesos"><span class="fa fa-cog"></span></a></label>
                                                                @if(\Illuminate\Support\Facades\Session::get('dia')==$dia)
                                                                    @foreach($procesos as $proceso)
                                                                        <li class="item tw:block tw:px-4 tw:py-3">{{\App\audParseCase::parseProceso($proceso->des_proceso)}}</li>
                                                                    @endforeach
                                                                @endif
                                                                <input type="text" name="procesos" hidden value="{{json_encode($procesosE)}}">
                                                            </div>
                                                            <div>
                                                                <label for="">Puntos de la norma a auditar</label>
                                                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="criterios" id="" rows="2"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                                            <div class="tw:mb-4">
                                                                <label for="area">Area</label>
                                                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="area" id="area">
                                                                    <option value="" selected disabled="true">Selecciona...</option>
                                                                    @foreach($areas as $area)
                                                                        <option value="{{$area->id_unidad_admin}}">{{\App\audParseCase::parseNombre($area->nom_departamento)}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="tw:mb-4">
                                                                <label for="area">Auditor Responsable</label>
                                                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="auditor" id="auditor">
                                                                    <option value="" selected disabled="true">Selecciona...</option>
                                                                    <optgroup label="Generales">
                                                                        <option value="">Grupo auditor</option>
                                                                    </optgroup>
                                                                    <optgroup label="Especificos">
                                                                        <option value="{{$auditor_l->id_auditor_auditoria}}">Auditor Lider  ({{\App\audParseCase::parseAbr($auditor_l->titulo).' '.\App\audParseCase::parseNombre($auditor_l->nombre)}})</option>
                                                                        @foreach($auditores as $auditor)
                                                                            <option value="{{$auditor->id_auditor_auditoria}}">Auditor {{$loop->iteration}}  ({{\App\audParseCase::parseAbr($auditor->titulo).' '.\App\audParseCase::parseNombre($auditor->nombre)}})</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                </select>
                                                            </div>
                                                            @if(sizeof($auditores_entrenamiento)>0)
                                                                <div>
                                                                    <div class="tw:mb-4">
                                                                        <label for="area">Auditor en Entrenamiento</label>
                                                                        <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="" id="auditor_entrenamiento">
                                                                            <option value="" selected disabled="true">Selecciona...</option>
                                                                            @foreach($auditores_entrenamiento as $auditor)
                                                                                <option value="{{$auditor->id_auditor_auditoria}}">{{\App\audParseCase::parseAbr($auditor->titulo).' '.\App\audParseCase::parseNombre($auditor->nombre)}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <botton class="programar tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:float-right tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-fecha="{{$dia}}">Ver disponibilidad</botton>
                                                        </div>
                                                    </div>
                                                    <div class="horas tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" hidden></div>
                                                    <br>
                                                    <button type="submit" class="guarda_agenda hidden tw:float-right tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-fecha="{{$dia}}">Guardar</button>
                                                    <br>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="agenda-general tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                                            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                                                <a href="#!" class="btn-add-agenda tw:float-right" data-fecha="{{$dia}}" data-toggle="tooltip" title="Agregar evento"><span class="fa fa-plus"></span></a>
                                                <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Agenda del día {{$dia}}</h3>
                                            </div>
                                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw:p-5 tw:sm:p-6 tw-tabla tw-tabla-bordes">
                                                <thead>
                                                <th>Hora inicio</th>
                                                <th>Hora fin</th>
                                                <th>Proceso</th>
                                                <th>Auditor</th>
                                                <th>Area</th>
                                                <th>Acciones</th>
                                                </thead>
                                                <tbody>

                                                @foreach($horasAgenda as $evento)
                                                    @if($evento->fecha==$dia)
                                                        <tr>
                                                            <td>{{\Carbon\Carbon::parse($evento->hora_i)->format('H:i')}}</td>
                                                            <td>{{\Carbon\Carbon::parse($evento->hora_f)->format('H:i')}}</td>
                                                            <td>
                                                                <p>{{$evento->criterios}}</p>
                                                                @foreach(\App\AudAgenda::getProcesos($evento->id_agenda) as $proceso)
                                                                    <p>{{\App\audParseCase::parseProceso($proceso->proceso)}}</p>
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                @foreach(\App\AudAgenda::getAuditores($evento->id_agenda) as $auditor)
                                                                    @if($auditor->id_categoria==1)
                                                                        Auditor Lider
                                                                    @else
                                                                        @foreach(\App\AudAuditorias::getAuditores($auditoria_id,2) as $audT)
                                                                            @if($audT->nombre==$auditor->nombre)<p>Auditor {{$loop->iteration}}</p>@endif
                                                                        @endforeach
                                                                        @foreach(\App\AudAuditorias::getAuditores($auditoria_id,3) as $audT)
                                                                            @if($audT->nombre==$auditor->nombre)<p>AE {{$loop->iteration}}</p>@endif
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td>{{\App\audParseCase::parseNombre($evento->nom_departamento)}}</td>
                                                            <td>
                                                                <a href="{{url('auditorias/evento')}}/{{$evento->id_agenda}}" class="tw:float-left" data-id="{{$evento->id_agenda}}"><span class="fa fa-cog" data-toggle="tooltip" title="Configurar evento"></span></a>
                                                                <a href="#" class="btn_delete_evento tw:float-right" data-id="{{$evento->id_agenda}}"><span class="fa fa-trash" data-toggle="tooltip" title="Eliminar evento"></span></a>
                                                            </td>
                                                        </tr>
                                                    @endif

                                                @endforeach
                                                </tbody>
                                            </table>
</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <x-panel.modal id="modal_add_evento" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
        
            <form id="form-add-evento" method="POST" action="">
                @csrf
                
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar evento a la agenda</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <div class="" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4" role="tab" id="headingProcesos">
                                    <h4 class="tw:text-base tw:font-medium tw:text-gray-800" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseProcesos" aria-expanded="false" aria-controls="collapseProcesos">
                                        Proceso(s) a auditar / Actividad
                                    </h4>
                                </div>
                                <div id="collapseProcesos" class="collapse" role="tabpanel" aria-labelledby="headingProcesos">
                                    <div class="tw:p-5 tw:sm:p-6">
                                        <label for="">Actividades para la Agenda</label>
                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        @foreach($actividades as $actividad)
                                            <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                                <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700">
                                                    <input class="proceso" type="checkbox" data-id="{{$actividad->id_actividad}}">
                                                    {{\App\audParseCase::parseProceso($actividad->descripcion)}}
                                                </label>
                                            </div>
                                            @if($loop->iteration%3==0)
                                                </div>
                                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                            @endif
                                        @endforeach
                                        </div>
                                        <hr>
                                        <label for="">Procesos</label>
                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                            @foreach($procesosAsignados as $proceso)
                                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                                    <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700">
                                                        <input class="proceso" type="checkbox" data-id="{{$proceso->id_auditoria_proceso}}">
                                                        <strong>{{$proceso->clave.' '}}</strong>
                                                        {{\App\audParseCase::parseProceso($proceso->des_proceso)}}
                                                    </label>
                                                </div>
                                                @if($loop->iteration%3==0)
                                                    </div>
                                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4" role="tab" id="headingArea">
                                    <h4 class="tw:text-base tw:font-medium tw:text-gray-800" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Área
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingArea">
                                    <div class="tw:p-5 tw:sm:p-6">
                                        <label for="">Generales</label>
                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                            <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                                <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700">
                                                    <input class="area" type="checkbox" data-id="-1">
                                                    Jefaturas de División
                                                </label>
                                            </div>
                                            <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                                <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700">
                                                    <input class="area" type="checkbox" data-id="-2">
                                                    Área academica
                                                </label>
                                            </div>
                                            <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                                <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700">
                                                    <input class="area" type="checkbox" data-id="-3">
                                                    Área administrativa
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <label for="">Especificas</label>
                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        @foreach($areas as $area)
                                            <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                                <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700">
                                                    <input class="area" type="checkbox" data-id="{{$area->id_unidad_admin}}">
                                                    {{\App\audParseCase::parseNombre($area->nom_departamento)}}
                                                </label>
                                            </div>
                                            @if($loop->iteration%3==0)
                                                </div>
                                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                            @endif
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4" role="tab" id="headingThree">
                                    <h4 class="tw:text-base tw:font-medium tw:text-gray-800" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Responsable
                                    </h4>
                                </div>
                                <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="tw:p-5 tw:sm:p-6">

                                        <label for="">Generales</label>
                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                            <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                                <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700">
                                                    <input class="area" type="checkbox" data-id="-1">
                                                    Director General
                                                </label>
                                            </div>
                                            <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                                <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700">
                                                    <input class="area" type="checkbox" data-id="-2">
                                                    Grupo Auditor
                                                </label>
                                            </div>
                                            <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                                <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700">
                                                    <input class="area" type="checkbox" data-id="-3">
                                                    Coordinadora del SGOE
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <label for="">Especificos</label>
                                        @php $equipo=1; $entrenamiento=1; @endphp
                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                            @foreach($auditoresT as $auditor)
                                                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                                    <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700">
                                                        <input class="area" type="checkbox" data-id="{{$auditor->id_auditor_auditoria}}">
                                                        @if($auditor->id_categoria==1)
                                                            <strong>Auditor Líder</strong>
                                                        @elseif($auditor->id_categoria==2)
                                                            <strong>Auditor {{$equipo}}</strong>
                                                            @php $equipo++; @endphp
                                                        @elseif($auditor->id_categoria==3)
                                                            <strong>AE {{$entrenamiento}}</strong>
                                                            @php $entrenamiento++; @endphp
                                                        @endif
                                                        {{" (".\App\audParseCase::parseAbr($auditor->titulo).' '.\App\audParseCase::parseNombre($auditor->nombre).")"}}
                                                    </label>
                                                </div>
                                                @if($loop->iteration%2==0)
                                        </div>
                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="">Puntos de la norma a auditar</label>
                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="criterios" id="" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Ok"/>
                    </div>
                
            </form>
        
    </x-panel.modal>

    <form  method="POST" role="form" id="form_delete_evento">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
    </form>

    <script>
        $(document).ready(function () {


            $('#modal_add_evento').modal('show');


            fecha="";
            $('.hora_agenda').click(function () {
                TNotify.alert($(this).data('inicio')+" - "+$(this).data('fin'))
            });

            $('.btn-add-agenda').click(function () {
                TNotify.alert("ok");
                $("#form-add-evento input[type=checkbox]").prop( "checked", false );
                $('.agenda-general').fadeOut();
                $('.form_programar'+$(this).data('fecha')).fadeIn();
                fecha=$(this).data('fecha');
            });

            $('.btn-cancelar-agregar').click(function () {
                $('.form_programar'+$(this).data('fecha')).fadeOut();
                $('.agenda-general').fadeIn();
            });
            
            $('.programar').click(function () {
                fecha=$(this).data('fecha');
                $('.opcion').attr('value','1');
                Swal.fire({
                    title: 'Cargando',
                    onBeforeOpen: () => {
                        Swal.showLoading()
                        $.ajax({
                            type: 'get',
                            url: "{{url('auditorias/validar')}}/{{$auditoria_id}}",
                            data: {datos: JSON.stringify($('#form_programar'+fecha).serializeArray())},
                            success: function (data) {
                                if (Array.isArray(data)){
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: data[0],
                                    })
                                    return false;
                                }
                                $('.opcion').attr('value','2');
                                Swal.close();
                                if (data){
                                    $('.horas').empty().html(data).addClass('has-error').fadeIn(500);
                                    $('.inicio').change(function () {
                                        Swal.fire({
                                            title: 'Cargando',
                                            onBeforeOpen: () => {
                                                Swal.showLoading()
                                                $.ajax({
                                                    type: 'get',
                                                    url: "{{url('auditorias/validar')}}/{{$auditoria_id}}",
                                                    data: {datos: JSON.stringify($('#form_programar' + fecha).serializeArray())},
                                                    success: function (data2) {
                                                        Swal.close();
                                                        if (data2){
                                                            $('.h_fin').empty().html(data2);
                                                            $('.horas').addClass('has-error').fadeIn(500);
                                                            setInterval(function () {
                                                                $('.horas').removeClass('has-error')
                                                            },1000)
                                                            $('.fin').change(function () {
                                                                $('.guarda_agenda').addClass('has-error').removeClass('hidden')
                                                                setInterval(function () {
                                                                    $('.guarda_agenda').removeClass('has-error')
                                                                },1000)
                                                            });
                                                        }
                                                    },
                                                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                                                        Swal.close();
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Error al cargar los datos',
                                                            timer: 1500
                                                        })
                                                    }
                                                })
                                            }
                                        });
                                    });
                                    setInterval(function () {
                                        $('.horas').removeClass('has-error')
                                    },1000)
                                }
                                else{

                                }
                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                Swal.close();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error al cargar los datos',
                                    timer: 1500
                                })
                            }
                        })
                    }
                })
            });

            $('#auditor').change(function () {
                $('.horas').fadeOut(100);
            });

            $('#auditor_entrenamiento').change(function () {
                $(this).attr('name','auditor_entrenamiento');
                $('.horas').fadeOut(100);
            });

            $('.elemento').click(function () {
                $('.horas').fadeOut();
                $.ajax({
                    type: 'get',
                    url: "{{url('auditorias/setItem')}}/"+$(this).data('item')+'/set',
                    data: { },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al establecer la fecha',
                            timer: 1500
                        })
                    }
                })
            });

            $('.guarda_agenda').click(function () {
                console.log($('#form_programar'+$(this).data('fecha')).serialize());
            });

            $(".btn_delete_evento").click(function(){
                var id=$(this).data('id');
                swal({
                    title: "Seguro que desea eliminar?",
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Aceptar',
                })
                .then((result) => {
                    if (result.value) { //Si presionas boton aceptar
                        $("#form_delete_evento").attr("action","/auditorias/evento/"+id)
                        $("#form_delete_evento").submit();
                    }
                    else if (result.dismiss === Swal.DismissReason.cancel) { //Si presionas boton cancelar
                        swal.close()
                    }
                });
            });


            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>

@endsection