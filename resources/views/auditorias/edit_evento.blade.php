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

                <a class="tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{url('/auditorias/planes')}}/{{isset($agendaT[0])?$agendaT[0]->id_auditoria:0}}">Detalles del plan</a>

                <span class="fa fa-chevron-right tw:text-[10px] tw:text-gray-400"></span>
                <a class="tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{url('/auditorias/agenda')}}/{{isset($agendaT[0])?$agendaT[0]->id_auditoria:0}}">Agenda del plan</a>
                <span class="fa fa-chevron-right tw:text-[10px] tw:text-gray-400"></span>
                <span class="tw:text-gray-800 tw:dark:text-white/90">Editar evento de la agenda</span>
            </nav>
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                    <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Editar evento</h3>
                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    <form data-panel-envio action="{{url('auditorias/actualizaEvento')}}/{{$agendaT[0]->id_agenda}}" method="POST" id="reprogramar">
                        @csrf
                            <div>
                                <input type="text" name="id_auditoria" value="" hidden>
                                <input type="text" name="fecha" id="fecha_agenda" hidden value="{{$agendaT[0]->fecha}}">
                                <div class="" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel-{{sizeof($procesosT)>0?'success':'default'}} procesos tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:[&.panel-success]:border-green-300">
                                        <div class="tw:rounded-t-2xl tw:in-[.panel-success]:border-green-200 tw:in-[.panel-success]:bg-green-50 tw:in-[.panel-success]:text-green-800 tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4" role="tab" id="headingProcesos" data-toggle="collapse" data-parent="#accordion" href="#collapseProcesos" aria-expanded="false" aria-controls="collapseProcesos">
                                            <strong class="procesos tw:float-right">{{sizeof($procesosT)}} Seleccionados</strong>
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
                                                                <input class="actividad" type="checkbox" {{empty($agendaT[0]->procesos)?'disabled':''}} data-id="{{$actividad->id_actividad}}" data-name="actividad" data-back="proceso">
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
                                                            <label class="{{in_array($proceso->id_auditoria_proceso,$procesosT)?'bg-success text-success':''}} tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700">
                                                                <input class="proceso" type="checkbox" {{in_array($proceso->id_auditoria_proceso,$procesosT)?'checked':''}} {{empty($agendaT[0]->procesos)?'disabled':''}} data-id="{{$proceso->id_auditoria_proceso}}" data-name="proceso" data-back="actividad">
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
                                    <div class="panel-{{(sizeof($agendaT[0]->areas_generales)+sizeof($agendaT[0]->areas))>0?'success':'default'}} areas tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:[&.panel-success]:border-green-300">
                                        <div class="tw:rounded-t-2xl tw:in-[.panel-success]:border-green-200 tw:in-[.panel-success]:bg-green-50 tw:in-[.panel-success]:text-green-800 tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4" role="tab" id="headingArea" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <strong class="areas tw:float-right">{{sizeof($agendaT[0]->areas_generales)+sizeof($agendaT[0]->areas)}} Seleccionados</strong>
                                            <h4 class="tw:text-base tw:font-medium tw:text-gray-800" role="button">
                                                Área
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingArea">
                                            <div class="tw:p-5 tw:sm:p-6">
                                                <label for="">Generales</label>
                                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                    @foreach($generalAreas as $area)
                                                        <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                                            <label class="{{in_array($area->descripcion,$agendaT[0]->areas_generales)?'bg-success text-success':''}} tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700">
                                                                <input class="areaG" type="checkbox" {{empty($agendaT[0]->areas_generales)?'disabled':''}} {{in_array($area->descripcion,$agendaT[0]->areas_generales)?'checked':''}} data-id="{{$area->id_area_general}}" data-name="areaG" data-back="area">
                                                                {{$area->descripcion}}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <hr>
                                                <label for="">Especificas</label>
                                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                    @foreach($areas as $area)
                                                        <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                                            <label class="{{in_array($area->nom_departamento,$agendaT[0]->areas)?'bg-success text-success':''}} tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700">
                                                                <input class="area" type="checkbox" {{empty($agendaT[0]->areas)?'disabled':''}} {{in_array($area->nom_departamento,$agendaT[0]->areas)?'checked':''}} data-id="{{$area->id_unidad_admin}}" data-name="area" data-back="areaG">
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
                                    <div class="panel-{{sizeof($agendaT[0]->auditores)>0?'success':'default'}} responsables tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:[&.panel-success]:border-green-300">
                                        <div class="tw:rounded-t-2xl tw:in-[.panel-success]:border-green-200 tw:in-[.panel-success]:bg-green-50 tw:in-[.panel-success]:text-green-800 tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4" role="tab" id="headingThree" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <strong class="responsables tw:float-right">{{sizeof($agendaT[0]->auditores)}} Seleccionados</strong>
                                            <h4 class="tw:text-base tw:font-medium tw:text-gray-800" role="button">
                                                Responsable
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                                            <div class="tw:p-5 tw:sm:p-6">

                                                <label for="">Generales</label>
                                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                </div>
                                                <hr>
                                                <label for="">Especificos</label>
                                                @php $equipo=1; $entrenamiento=1; @endphp
                                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                    @foreach($auditoresT as $auditor)
                                                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                                            <label class="{{in_array($auditor->id_auditor_auditoria,$agendaT[0]->id_auditores)?'bg-success text-success':''}} tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700">
                                                                <input class="responsable" type="checkbox" {{in_array($auditor->id_auditor_auditoria,$agendaT[0]->id_auditores)?'checked':''}} data-id="{{$auditor->id_auditor_auditoria}}" data-name="responsable" data-back="responsableG">
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
                                        <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="criterios" id="criterios_agenda" rows="2">{{$agendaT[0]->criterios}}</textarea>
                                    </div>
                                    <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                        <br><br><br>
                                        <botton class="programar tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:float-right tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-fecha="">Modificar Horario</botton>
                                    </div>
                                </div>
                                <hr>
                                <div class="horas tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2" id="h_inicio">
                                        <label for="inicio">Hora de inicio</label>
                                        <div class="tw:flex tw:w-full tw:items-stretch">
                                            <select name="inicio" id="inicio" class="inicio tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" disabled="true">
                                                <option value="{{$agendaT[0]->hora_i}}" selected="" >{{$agendaT[0]->hora_i}}</option>
                                            </select>
                                            <span class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:bg-gray-50 tw:px-3 tw:text-sm tw:text-gray-600"><i class="fa fa-clock-o"></i></span>
                                        </div>
                                    </div>
                                    <div class="h_fin tw:w-full tw:lg:w-6/12 tw:px-2" id="h_fin">
                                        <label for="fin">Hora de Fin</label>
                                        <div class="tw:flex tw:w-full tw:items-stretch">
                                            <select name="fin" id="fin" class="fin tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" disabled="true">
                                                <option value="{{$agendaT[0]->hora_f}}" selected="" disabled="true">{{$agendaT[0]->hora_f}}</option>
                                            </select>
                                            <span class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:bg-gray-50 tw:px-3 tw:text-sm tw:text-gray-600"><i class="fa fa-clock-o"></i></span>
                                        </div>
                                    </div>


                                </div>
                                <input type="text" name="procesos" id="procesos" hidden>
                                <input type="text" name="area" id="area" hidden>
                                <input type="text" name="responsable" id="responsable" hidden>
                                <input type="text" name="id_evento" id="id_evento" value="{{$agendaT[0]->id_agenda}}" hidden>
                            </div>
                            <div class="tw:mt-5 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:border-t tw:border-gray-100 tw:pt-5">
                                <a href="{{url('/auditorias/agenda')}}/{{$agendaT[0]->id_auditoria}}" role="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</a>
                                <input type="submit" class="guarda_evento tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Agendar"/>
                            </div>
                        <button type="submit" class="guarda_agenda hidden tw:float-right tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <form data-panel-envio method="POST" role="form" id="form_delete_auditor">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
    </form>

    <script>
        $(document).ready(function () {
            $("#criterios_agenda").change(function(){
                verifyDisponibilidad();

            });
            $('input:checkbox').click(function () {

                seleccionados=0;
                $('.'+$(this).data('name')).each(function () {
                    if ($(this).prop('checked')==true)
                        seleccionados++;
                });
                if (seleccionados>0){
                    $('.'+$(this).data('back')).attr('disabled',true);
                    $('div.'+$(this).data('back')+'s, div.'+$(this).data('name')+'s').removeClass('panel-defalut').addClass('panel-success');
                }
                else{
                    $('.'+$(this).data('back')).attr('disabled',false);
                    $('div.'+$(this).data('back')+'s, div.'+$(this).data('name')+'s').removeClass('panel-success').addClass('panel-default');
                }
                $('strong.'+$(this).data('back')+'s, strong.'+$(this).data('name')+'s').empty().append(seleccionados+' Seleccionados');
                verifyDisponibilidad();
            });


            $('.programar').click(function () {
                verifyDisponibilidad();
            });



        function verifyDisponibilidad(){
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

            if (procesos[0].especificos.length>0 || procesos[0].generales.length>0) {
                $('#procesos').attr('value',JSON.stringify(procesos));
                $('#responsable').attr('value',JSON.stringify(responsables));
                $('#area').attr('value',JSON.stringify(areas));

                Swal.fire({
                    title: 'Cargando',
                    didOpen: () => {
                        Swal.showLoading();
                        $.ajax({
                            type: 'get',
                            url: "{{url('auditorias/ver_disponibilidad')}}/{{$agendaT[0]->id_auditoria}}",
                            data: {datos: JSON.stringify($('#reprogramar').serializeArray())},
                            success: function (data) {
                                console.log(data)
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
                                                    url: "{{url('auditorias/validar_hora')}}/{{$agendaT[0]->id_auditoria}}",
                                                    data: {datos: JSON.stringify($('#reprogramar').serializeArray())},
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
                Swal.fire({
                    title: 'Error',
                    text: 'Selecciona la actividad o proceso para agendar',
                    timer: 2500
                });
            }
        }


            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>

@if(($ver ?? null) === 'procesos_evento')
    @include('auditorias.edita_procesos_evento')
@endif

@include('partials.panel.validacion_envio')
@endsection
