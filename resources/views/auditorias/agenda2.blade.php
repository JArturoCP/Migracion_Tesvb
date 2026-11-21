@extends('layouts.panel')
@section('title', 'Agenda del Plan')
@include('partials.panel.recursos_app')
@section('content')
    @if(\Illuminate\Support\Facades\Session::get('errors'))

        {{dd("ok")}}
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
                <a class="tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{url('/auditorias/planes')}}/{{$auditoria->id_auditoria}}">Detalles del plan</a>
                <span class="fa fa-chevron-right tw:text-[10px] tw:text-gray-400"></span>
                <span class="tw:text-gray-800 tw:dark:text-white/90">Agenda del plan</span>
            </nav>
            <div class="panel tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                <div class="panel-heading tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                    @if($porcentaje>=100)
                        {{--<a href="{{url('auditorias/printPlan')}}/{{$auditoria->id_auditoria}}" class="pull-right tw:float-right"><span class="fa fa-print"></span></a>--}}
                        <a href="#" class="btn_export" data-id="{{$auditoria->id_auditoria}}"><span class="pull-right fa fa-download tw:float-right" data-toggle="tooltip" title="Exportar Programa">&nbsp</span></a>

                    @endif
                    @foreach($auditorias as $auditoria_n)
                        @if($auditoria_n->id_auditoria==$auditoria->id_auditoria)
                            <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Agenda del plan {{\Carbon\Carbon::parse($auditoria_n->fecha_i)->format('Y')}}-{{$loop->iteration}}</h3>
                        @endif
                    @endforeach
                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    @if($porcentaje>0)
                        <div class="tw:mb-3 tw:flex tw:h-5 tw:w-full tw:overflow-hidden tw:rounded-full tw:bg-gray-200" id="porcentaje">
                            <div class="tw:flex tw:h-full tw:items-center tw:justify-center tw:bg-brand-500 tw:text-xs tw:font-medium tw:text-white" role="progressbar" aria-valuenow="{{$porcentaje}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$porcentaje}}%;">
{{--                                Agendado el {{$porcentaje}}% de los procesos del plan--}}
                                Agendados  {{sizeof($procesosT).'/'.$procesosAsignados->count()}} procesos del plan
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
                                        <div class="agenda-general panel panel-success tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:[&.panel-success]:border-green-300">
                                            <div class="panel-heading tw:rounded-t-2xl tw:in-[.panel-success]:border-green-200 tw:in-[.panel-success]:bg-green-50 tw:in-[.panel-success]:text-green-800 tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                                                @if($esLider)
                                                <a href="#!" class="pull-right btn-add-agenda tw:float-right" data-fecha="{{$dia}}" data-toggle="tooltip" title="Agregar evento"><span class="fa fa-plus"></span></a>
                                                @endif
                                                <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Agenda del día {{\Carbon\Carbon::parse($dia)->locale('es')->translatedFormat('d-m-Y')}}</h3>
                                            </div>
                                            <div class="tw:p-5 tw:sm:p-6">
                                                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-rayas tw-tabla-bordes tw-tabla-compacta">
                                                    <thead class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                    <th class="tw:lg:w-1/12 tw:text-center">Hora de inicio</th>
                                                    <th class="tw:lg:w-1/12 tw:text-center">Hora de termino</th>
                                                    <th class="tw:lg:w-4/12 tw:text-center">Procesos</th>
                                                    <th class="tw:lg:w-1/12 tw:text-center">Responsable</th>
                                                    <th class="tw:lg:w-4/12 tw:text-center">Areas</th>
                                                    <th class="tw:lg:w-1/12 tw:text-center">Acciones</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($agendaFinal as $agenda)


                                                            @if($agenda['fecha']==$dia)

                                                                @if($esLider OR in_array(Session::get('id_perso'),$agenda['id_auditores']) || Session::get('id_perso')==203||$agenda["tipo"]==2)
                                                                    <tr>
                                                                        <td>{{$agenda['inicio']}}</td>
                                                                        <td>{{$agenda['fin']}}</td>
                                                                        <td colspan="{{sizeof($agenda['responsables'])>0?'':(sizeof($agenda['areas'])>0?'':'3')}}">
                                                                            @if(strlen($agenda['criterios']))
                                                                            <p>{{$agenda['criterios']}}</p>
                                                                            @endif
                                                                            <div class="tw:w-full">
                                                                                @if(is_array($agenda['procesos']))
                                                                                    @foreach($agenda['procesos'] as $proceso)
                                                                                        <li>{{$proceso}}</li>
                                                                                    @endforeach
                                                                                @else
                                                                                    <li>{{$agenda['procesos']}}</li>
                                                                                @endif
                                                                            </div>
                                                                        </td>
                                                                            <td>
                                                                                @if(sizeof($agenda['responsables'] )==0||$agenda["tipo"]==2)
                                                                                    Grupo Auditor
                                                                                @else
                                                                                @foreach($agenda['responsables'] as $responsable)
                                                                                    <p>{{$responsable}}</p>
                                                                                @endforeach
                                                                                    @endif
                                                                            </td>
                                                                            <td>
                                                                                <div class="tw:w-full">
                                                                                    @foreach($agenda['areas'] as $area)
                                                                                        <li>{{$area}}</li>
                                                                                    @endforeach
                                                                                </div>
                                                                            </td>

                                                                        <td class="tw:text-center">
                                                                            @if($agenda['tipo']==1 and ($esLider || in_array(Session::get('id_perso'),$agenda['id_auditores'])))
                                                                                <a href="{{(sizeof($agenda['id_personal_lider'])>0||in_array(Session::get('id_perso'),$agenda['id_auditores']))?url('/auditorias/hoja_trabajo/').'/'.$agenda['id_agenda']:url('/auditorias/hoja_trabajo/').'/'.$agenda['id_agenda']}}" data-toggle="tooltip" title="{{(sizeof($agenda['id_personal_lider'])>0||in_array(Session::get('id_perso'),$agenda['id_auditores']))?'Hoja':'Ver hoja'}} de trabajo"><span class="fa fa-files-o {{(sizeof($agenda['id_personal_lider'])>0||in_array(Session::get('id_perso'),$agenda['id_auditores']))?'glyphicon-copy':' glyphicon-file '}} tw:float-left tw:text-green-600"></span></a>
                                                                                {{-- <a href="{{url('/auditorias/editar_evento').'/'.$agenda['id_agenda']}}/{{$agenda['tipo']}}" class="edit-event" data-id="{{$agenda['id_agenda']}}" data-toggle="tooltip" title="Editar evento"><span class="fa fa-cog"></span></a>--}}
                                                                            @endif
                                                                            @if($esLider)

                                                                                <a href="#" class="delete-event" data-id="{{$agenda['id_agenda']}}" data-type="{{$agenda['tipo']}}" data-toggle="tooltip" title="Eliminar evento"><span class="fa fa-trash pull-right tw:float-right tw:text-red-600"></span></a>
                                                                            @endif

                                                                        </td>
                                                                        {{--
                                                                        @elseif(in_array(Session::get('id_perso'),$agenda['id_auditores']))
                                                                            <a href="{{url('/auditorias/hoja_trabajo/').'/'.$agenda['id_agenda']}}" data-toggle="tooltip" title="Hoja de trabajo"><span class="fa fa-files-o"></span></a>
                                                                        @endif
                                                                    </td>--}}
                                                                    </tr>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                    {{--<tbody>
                                                    @foreach($agendaT as $agenda)
                                                        @if($agenda->fecha==$dia)
                                                            @if($esLider OR in_array(Session::get('id_perso'),$agenda->id_auditores))
                                                            <tr>
                                                                <td>{{$agenda->hora_i}}</td>
                                                                <td>{{$agenda->hora_f}}</td>
                                                                <td>
                                                                    <p>{{$agenda->criterios}}</p>
                                                                    <div class="tw:w-full">
                                                                        @foreach($agenda->procesos as $proceso)
                                                                            <li>{{$proceso}}</li>
                                                                        @endforeach
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    @foreach($agenda->auditores as $auditor)
                                                                        <p>{{$auditor}}</p>
                                                                    @endforeach
                                                                </td>
                                                                <td>
                                                                    <div class="tw:w-full">

                                                                        @if(is_array($agenda->areas))
                                                                            @foreach($agenda->areas as $area)
                                                                                <li>{{$area}}</li>
                                                                            @endforeach
                                                                        @else
                                                                            <li>{{$agenda->areas}}</li>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                                <td class="tw:text-center">
                                                                    @if($esLider)
                                                                        <a href="{{sizeof($agenda->id_personal_lider)>0?url('/auditorias/hoja_trabajo/').'/'.$agenda->id_agenda:url('/auditorias/ver_hoja').'/'.$agenda->id_agenda}}" data-toggle="tooltip" title="{{sizeof($agenda->id_personal_lider)>0?'Hoja':'Ver hoja'}} de trabajo"><span class="fa fa-paperclip {{sizeof($agenda->id_personal_lider)>0?'glyphicon-paperclip':' glyphicon glyphicon-eye-open '}} tw:float-left tw:text-green-600"></span></a>
                                                                        <a href="{{url('/auditorias/editar_evento').'/'.$agenda->id_agenda}}/1" class="edit-event" data-id="{{$agenda->id_agenda}}" data-toggle="tooltip" title="Editar evento"><span class="fa fa-cog"></span></a>
                                                                        <a href="#" class="delete-event" data-id="{{$agenda->id_agenda}}" data-toggle="tooltip" title="Eliminar evento"><span class="fa fa-trash pull-right tw:float-right tw:text-red-600"></span></a>
                                                                    @elseif(in_array(Session::get('id_perso'),$agenda->id_auditores))
                                                                        <a href="{{url('/auditorias/hoja_trabajo/').'/'.$agenda->id_agenda}}" data-toggle="tooltip" title="Hoja de trabajo"><span class="fa fa-paperclip"></span></a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    </tbody>--}}
                                                </table>
</div>
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
        
            <form data-panel-envio id="form-add-evento" action="{{url('auditorias/agenda')}}" method="POST">
                @csrf
                
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar evento a la agenda</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <input type="text" name="id_auditoria" value="{{$auditoria->id_auditoria}}" hidden>
                        <input type="text" name="fecha" id="fecha_agenda" hidden>
                        <div class="" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default procesos tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:[&.panel-success]:border-green-300">
                                <div class="panel-heading tw:rounded-t-2xl tw:in-[.panel-success]:border-green-200 tw:in-[.panel-success]:bg-green-50 tw:in-[.panel-success]:text-green-800 tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4" role="tab" id="headingProcesos" data-toggle="collapse" data-parent="#accordion" href="#collapseProcesos" aria-expanded="false" aria-controls="collapseProcesos">
                                    <strong class="pull-right procesos tw:float-right">0 Seleccionados</strong>
                                    <h4 class="tw:text-base tw:font-medium tw:text-gray-800" role="button">
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
                                                        <input class="actividad" type="checkbox" data-id="{{$actividad->id_actividad}}" data-name="actividad" data-back="proceso">
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
                                        <label for="">Procesos </label>
                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                            @foreach($procesosAsignados as $proceso)
                                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                                    <label class="{{in_array($proceso->id_auditoria_proceso,$procesosT)?'bg-success text-success':''}} tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700">
                                                        <input class="proceso" type="checkbox" data-id="{{$proceso->id_auditoria_proceso}}" data-name="proceso" data-back="actividad" data-proceso="{{$proceso->id_proceso}}" data-unidades="{{$proceso->unidades}}">
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

                            <div class="panel panel-default areas tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:[&.panel-success]:border-green-300">
                                <div class="panel-heading tw:rounded-t-2xl tw:in-[.panel-success]:border-green-200 tw:in-[.panel-success]:bg-green-50 tw:in-[.panel-success]:text-green-800 tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4" role="tab" id="headingArea" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <strong class="pull-right areas tw:float-right"></strong>
                                    <h4 class="tw:text-base tw:font-medium tw:text-gray-800" role="button">
                                        Área
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingArea">
                                    <div class="tw:p-5 tw:sm:p-6">
                                        <label for="">Grupos Administrativos</label>
                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                            @foreach($generalAreas as $area)
                                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                                    <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700">
                                                        <input class="areaG" type="checkbox" data-id="{{$area->id_area_general}}" data-name="areaG" data-back="area">
                                                        {{$area->descripcion}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <hr>
                                        <label for="">Areas</label>
                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                            @foreach($areasT as $area)
                                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                                    <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700">
                                                        <input class="area" type="checkbox" data-id="{{$area->id_unidad_admin}}" id="id_unidad_admin{{$area->id_unidad_admin}}" data-name="area" data-back="areaG">
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
                            <div class="panel panel-default responsables tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:[&.panel-success]:border-green-300">
                                <div class="panel-heading tw:rounded-t-2xl tw:in-[.panel-success]:border-green-200 tw:in-[.panel-success]:bg-green-50 tw:in-[.panel-success]:text-green-800 tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4" role="tab" id="headingThree" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <strong class="pull-right responsables tw:float-right">0 Seleccionados</strong>
                                    <h4 class="tw:text-base tw:font-medium tw:text-gray-800" role="button">
                                        Responsable
                                    </h4>
                                </div>
                                <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="tw:p-5 tw:sm:p-6">

                                        <label for="">Grupos de personas</label>
                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                            @foreach($generalPersonales as $personal)
                                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                                    <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700">
                                                        <input class="responsableG" type="checkbox" data-id="{{$personal->id_personal_general}}" data-name="responsableG" data-back="responsable">
                                                        {{$personal->descripcion}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <hr>
                                        <label for="">Auditores</label>
                                        @php $equipo=1; $entrenamiento=1; @endphp
                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                            @foreach($auditoresT as $auditor)
                                                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                                    <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700">
                                                        <input class="responsable" type="checkbox" data-id="{{$auditor->id_auditor_auditoria}}" data-name="responsable" data-back="responsableG">
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
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-10/12 tw:px-2">
                                <label for="">Puntos de la norma a auditar</label>
                                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="criterios" id="area_criterios" rows="2" ></textarea>
                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                <br><br><br>
                                <botton class="pull-right programar tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:float-right tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-fecha="{{$dia}}">Ver disponibilidad</botton>
                            </div>
                        </div>
                        <div class="horas tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4"></div>
                        <input type="text" name="procesos" id="procesos" hidden>
                        <input type="text" name="area" id="area" hidden>
                        <input type="text" name="responsable" id="responsable" hidden>
                    </div>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="guarda_evento hidden tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Agendar"/>
                    </div>
                
            </form>
        
    </x-panel.modal>


    <form data-panel-envio method="POST" role="form" id="form_delete_evento">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <input type="text" value="" id="tipo" name="tipo" hidden>
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
                                        Coordinadora del SGOE
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
            $(".actividad").click(function(){
                if($(this).prop('checked'))
                    $(".responsable").prop("disabled",true);
                else
                    $(".responsable").prop("disabled",false);

            });
            $(".area").prop("disabled","disabled")
            $('input:checkbox').click(function () {
                let input=$(this).data('name')
                let dataBack=$(this).data('back')
                let dataName=$(this).data('name')
                updateNum(input,dataBack,dataName)
            });

            $('.btn-add-agenda').click(function () {
                $("#form-add-evento").trigger("reset");
                $(".actividad, .proceso, .responsable, .responsableG").prop("disabled",false);
                $('#fecha_agenda').attr('value',$(this).data('fecha'));
                $('#modal_add_evento').modal('show');
                $('#form-add-evento .panel-success').removeClass('panel-success').addClass('panel-default');
                $("#form-add-evento .panel .panel-heading .pull-right").html("0 Seleccionados");
            });
            $(".proceso").click(function(){
                $(".area").prop("checked",false)
                $(".area").prop("disabled","disabled")
                let unidades=0;

                $(".proceso:checked").each(function(){
                    if($(this).prop('checked')) {
                        let unidades_ok = $(this).data('unidades');
                        unidades_ok = unidades_ok.toString().split(",");
                        unidades += (unidades_ok.length)
                        unidades_ok.forEach(function (valor, indice, array) {
                            $("#id_unidad_admin" + valor).prop("checked", "checked").prop("disabled", false);

                        });
                    }
                })

               // TNotify.alert(unidades)

                updateNum("area","areaG","area")

            })

            $('.programar').click(function () {
                var procesos=[];
                var responsables=[];
                var areas=[];
                procesos.push({generales:[], especificos: []});
                responsables.push({generales:[], especificos: []});
                areas.push({generales:[], especificos: []});
                $('.actividad:checked').each(function () {
                    procesos[0].generales.push($(this).data('id'));
                });
                $('.proceso:checked').each(function () {
                    procesos[0].especificos.push($(this).data('id'));
                });
                $('.responsableG:checked').each(function () {
                    responsables[0].generales.push($(this).data('id'));
                });
                $('.responsable:checked').each(function () {
                    responsables[0].especificos.push($(this).data('id'));
                });
                $('.areaG:checked').each(function () {
                    areas[0].generales.push($(this).data('id'))
                });
                $('.area:checked').each(function () {
                    areas[0].especificos.push($(this).data('id'))
                });

                if ((procesos[0].especificos.length>0 &&$("#area_criterios").val()!="")|| procesos[0].generales.length>0){
                    $('#procesos').attr('value',JSON.stringify(procesos));
                    $('#responsable').attr('value',JSON.stringify(responsables));
                    $('#area').attr('value',JSON.stringify(areas));

                    Swal.fire({
                        title: 'Cargando',
                        didOpen: () => {
                            Swal.showLoading();
                            $.ajax({
                                type: 'get',
                                url: "{{url('auditorias/ver_disponibilidad')}}/{{$auditoria->id_auditoria}}",
                                data: {datos: JSON.stringify($('#form-add-evento').serializeArray())},
                                success: function (data) {
                                    Swal.close();
                                    if (data[0].type=="Error"){
                                        Swal.fire({
                                            title: data[0].type,
                                            text: data[0].message,
                                            timer: 5000
                                        })
                                    }
                                    else{
                                        $('.horas').empty().html(data).addClass('has-error').fadeIn(500);
                                        $('.inicio').change(function () {
                                            Swal.fire({
                                                title: 'Cargando',
                                                didOpen: () => {
                                                    Swal.showLoading()
                                                    $.ajax({
                                                        type: 'get',
                                                        url: "{{url('auditorias/validar_hora')}}/{{$auditoria->id_auditoria}}",
                                                        data: {datos: JSON.stringify($('#form-add-evento').serializeArray())},
                                                        success: function (data2) {
                                                            Swal.close();
                                                            if (data2){
                                                                $('.h_fin').empty().html(data2);
                                                                $('.horas').addClass('has-error').fadeIn(500);
                                                                setInterval(function () {
                                                                    $('.horas').removeClass('has-error')
                                                                },1000)
                                                                $('.fin').change(function () {
                                                                    $('.guarda_evento').addClass('has-error').removeClass('hidden')
                                                                    setInterval(function () {
                                                                        $('.guarda_evento').removeClass('has-error')
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
                                },
                                error: function (XMLHttpRequest, textStatus, errorThrown) {
                                    Swal.close();
                                    Swal.fire({
                                        title: 'Error al cargar los datos',
                                        timer: 2500
                                    })
                                }
                            })
                        }
                    });
                }
                else{
                    if($("#area_criterios").val()=="")
                        Swal.fire({
                            title: 'Error',
                            text: 'Captura los puntos para la norma a auditar',
                            timer: 2500
                        });
                    else
                    Swal.fire({
                        title: 'Error',
                        text: 'Selecciona la actividad o proceso para agendar',
                        timer: 2500
                    });
                }

            });

            $('.guarda_evento').click(function () {
                console.log($('#form-add-evento').serializeArray())
            });

            $('.elemento').click(function () {
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


            $('.delete-event').click(function () {
                var tipo=$(this).data('type');
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
                            $('#tipo').val(tipo);
                            $("#form_delete_evento").attr("action","/auditorias/agenda/"+id).submit();
                        }
                        else if (result.dismiss === Swal.DismissReason.cancel) { //Si presionas boton cancelar
                            swal.close()
                        }
                    });
            });

            $('[data-toggle="tooltip"]').tooltip();

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
                   window.open('{{url('auditorias/printPlan')}}/'+programa+'/'+aprueba_formato,'_blank',"fullscreen=yes");
                }
            });
        })

        function updateNum(input,dataBack,dataName)
        {
            seleccionados=0;
            $('.'+input+':checked').each(function () {
                seleccionados++;
            });
            if (seleccionados>0){
                $('.'+dataBack).attr('disabled',true);
                $('div.'+dataBack+'s, div.'+dataName+'s').removeClass('panel-defalut').addClass('panel-success');
            }
            else{
                $('.'+dataBack).attr('disabled',false);
                $('div.'+$dataBack+'s, div.'+dataName+'s').removeClass('panel-success').addClass('panel-default');
            }
            $('strong.'+dataBack+'s, strong.'+dataName+'s').empty().append(seleccionados+' Seleccionados');

        }

    </script>



@if(($ver ?? null) === 'procesos_agenda')
    @include('auditorias.edita_procesos_agenda')
@endif

@include('partials.panel.validacion_envio')
@endsection
