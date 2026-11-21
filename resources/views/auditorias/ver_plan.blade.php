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
                <nav aria-label="Ruta de navegación" class="tw:mb-5 tw:flex tw:flex-wrap tw:items-center tw:gap-x-2 tw:gap-y-1 tw:text-sm tw:text-gray-500">
                    <span class="fa fa-arrow-right tw:text-brand-500"></span>
                    <a class="tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{url('/auditorias/programas')}}">Programas de auditoría</a>
                    <span class="fa fa-chevron-right tw:text-[10px] tw:text-gray-400"></span>
                    <a class="tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{url('/auditorias/programas')}}/{{\Illuminate\Support\Facades\Session::get('id_programa')}}">Detalles del programa</a>
                    <span class="fa fa-chevron-right tw:text-[10px] tw:text-gray-400"></span>
                    <a class="tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{url('/auditorias/programas')}}/{{\Illuminate\Support\Facades\Session::get('id_programa')}}/edit">Planes del programa</a>
                    <span class="fa fa-chevron-right tw:text-[10px] tw:text-gray-400"></span>
                    <span class="tw:text-gray-800 tw:dark:text-white/90">Detalles del plan</span>
                </nav>
                @if (session()->has('flash_notification.message'))
                    <x-panel.alerta class="tw:mb-4" :tipo="['success' => 'exito', 'danger' => 'error', 'warning' => 'advertencia'][session('flash_notification.level')] ?? 'info'">{!! session('flash_notification.message') !!}</x-panel.alerta>
                @endif
                @foreach($auditorias as $auditoria)
                    @if($auditoria->id_auditoria==$auditoria_id)
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4 tw:text-center">
                                Detalles del plan de auditoría {{\Carbon\Carbon::parse($auditoria->fecha_i)->format('Y').'-'.$loop->iteration}}
                                @if($auditoria->objetivo AND $auditoria->alcance AND $auditoria->criterio)
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:lg:w-1/12 tw:lg:ml-[83.3333%] tw:px-2">
                                            @if($esLider)
                                            <a href="{{url("/auditorias/informe").'/'.$auditoria->id_auditoria}}" class="tw:float-right" dstyle="margin-left: 1.5em;" ata-all="{{$auditoria}}"><span class="fa fa-clipboard" data-toggle="tooltip" title="Ver el informe de auditoria"></span></a>
                                            @endif
                                        </div>
                                        <div class="tw:w-full tw:lg:w-1/12 tw:px-2">
                                            <a href="{{url("/auditorias/agenda").'/'.$auditoria->id_auditoria}}" class="tw:float-right"  style="margin-left: 1.5em;" data-all="{{$auditoria}}"><span class="fa fa-th" data-toggle="tooltip" title="Editar agenda de auditoria"></span></a>
                                        </div>
                                    </div>

                                @endif
                            </div>
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <label>Objetivo</label>
                                        @if($esLider)
                                        <a href="#" class="btn-edit-plan tw:float-right" data-all="{{$auditoria}}"><span class="fa fa-cog" data-toggle="tooltip" title="Editar plan"></span></a>
                                        @endif
                                        <p>{{$auditoria->objetivo}}</p>
                                    </div>
                                    <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                        <label>Alcance</label>
                                        <p>{{$auditoria->alcance}}</p>
{{--                                        <p>{{count($procesosE)." procesos"}}</p>--}}
                                    </div>
                                    <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                        <label>Fechas</label>
                                        <p>Del <strong>{{Carbon::parse($auditoria->fecha_i)->format('d/m/Y')}}</strong> al <strong>{{Carbon::parse($auditoria->fecha_f)->format('d/m/Y')}}</strong></p>
                                    </div>
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <label>Criterios de auditoría</label>
                                        <p>{{$auditoria->criterio}}</p>

                                    </div>

                                </div>
                                <hr>
                                {{--<a href="#" class="btn_add_auditores tw:float-right" data-id="{{$auditoria->id_auditoria}}" data-toggle="modal" data-target="#modal_add_auditores"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar Auditores"></span></a>--}}
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    @if($esLider)
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <a href="{{url('auditorias/auditores_asignados')}}/{{$auditoria->id_auditoria}}/edit" class="tw:float-right"><span class="fa fa-cog" data-toggle="tooltip" title="Editar auditores"></span></a>
                                    </div>
                                    @endif
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
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                        <label>Auditores en entrenamiento:</label>
                                        {{--                                    <a href="#" class="btn-add-entrenado" data-id="{{$auditoria->id_auditoria}}" data-toggle="modal" data-target="#modal_edit_entrenado"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar auditor"></span></a>--}}
                                        @if($entrenados=$auditoria->getAuditores($auditoria->id_auditoria, 3) AND sizeof($entrenados)<1)
                                            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" role="alert">No se han agregado auditores en entrenamiento</div>
                                        @else
                                            <ul class="tw:divide-y tw:divide-gray-100 tw:rounded-lg tw:border tw:border-gray-200">
                                                @foreach($entrenados as $auditor)
                                                    <li class="tw:block tw:px-4 tw:py-3">
                                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                            <span class="tw:w-full tw:lg:w-10/12 tw:px-2"><label>AE {{$loop->iteration}}:</label>{{' '.\App\audParseCase::parseAbr($auditor->titulo).' '.\App\audParseCase::parseNombre($auditor->nombre)}}</span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </main>

    <form  method="POST" role="form" id="form_delete">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
    </form>

    @foreach($auditorias as $auditoria)
        @if($auditoria->id_auditoria==$auditoria_id)

            <form id="form_edit_aud" class="" role="form" method="POST" action="{{url('auditorias/planes')}}/{{$auditoria->id_auditoria}}">
                <x-panel.modal id="modal_edit_aud" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                
                                <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Editar plan de auditorias</h4>
                            </div>
                            <div class="tw-modal-cuerpo">

                                @csrf
                                @method("PUT")
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="">Periodo</label>
                                            <div class="input-daterange tw:flex tw:w-full tw:items-stretch">
                                                <input type="text" class="periodo tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Fecha de inicio" name="fecha_i" value="{{Carbon::parse($auditoria->fecha_i)->format('d-m-Y')}}">
                                                <div class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:bg-gray-50 tw:px-3 tw:text-sm tw:text-gray-600">a</div>
                                                <input type="text" class="periodo tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Fecha de término" name="fecha_f" id="f_fin" value="{{Carbon::parse($auditoria->fecha_f)->format('d-m-Y')}}">
                                            </div>
                                        </div>
                                        {{--                                <label for="fecha_i">Fecha de inicio</label>--}}
                                        {{--                                <input id="fecha_i" name="fecha_i" type="date">--}}
                                        {{--                            </div>--}}
                                        {{--                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">--}}
                                        {{--                                <label for="fecha_f">Fecha de termino</label>--}}
                                        {{--                                <input id="fecha_f" name="fecha_f" type="date">--}}
                                    </div>
                                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                                        <div class="tw:mb-4">
                                            <label for="objetivo">Objetivo</label>
                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="objetivo" name="objetivo" placeholder="Objetivo del plan de auditoria">{{$auditoria->objetivo}}</textarea>
                                        </div>
                                        <div class="tw:mb-4">
                                            <label for="alcance">Alcance</label>
                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="alcance" name="alcance" placeholder="Alcance del plan de auditoria">{{$auditoria->alcance!=""?$auditoria->alcance:\App\audParseCase::parseProceso(implode(", ",$procesosE->pluck('des_proceso')->toArray()))}}</textarea>
                                        </div>
                                        <div class="tw:mb-4">
                                            <label for="criterios">Criterios</label>
                                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="criterios" name="criterios" placeholder="Criterios del plan de auditoria">{{$auditoria->criterio}}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                                <input type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
                            </div>
                        
                    
                </x-panel.modal>
            </form>
        @endif

    @endforeach

    <script>
        $(document).ready(function () {
            $('.input-daterange').datepicker({
                autoclose: true,
                format: "dd-mm-yyyy",
                language: 'es'
            });
        });

        $(".btn-edit-plan").click(function () {
            var data=$(this).data('all');
            $("#modal_edit_aud").modal('show');
        });

        $('[data-toggle="tooltip"]').tooltip();

    </script>
@endsection
