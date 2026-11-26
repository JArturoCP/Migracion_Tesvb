<?php
use Carbon\Carbon;
setlocale(LC_ALL, 'es_ES');
?>
@extends('layouts.panel')
@include('partials.panel.recursos_app', ['selectorHora' => true])
@foreach($auditorias as $auditoria)
    @section('title', 'Agenda auditoria '.date('Y',strtotime($auditoria->fecha_i)).'-'.$auditoria->id_auditoria)
@endforeach
@section('content')
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                <p>
                    <span class="fa fa-arrow-right"></span>
                    <a href="{{url('/sgc/auditorias')}}">Planes de auditorias</a>
                    <span class="fa fa-chevron-right"></span>
                    @foreach($auditorias as $auditoria)
                        <a href="{{url('sgc/ver_plan_auditoria')}}/{{$auditoria->id_auditoria}}">Detalles del Plan</a>
                    @endforeach
                    <span class="fa fa-chevron-right"></span>
                    <span>Agenda</span>
                </p>
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                        <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800">
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                    <a href="#" class="btn_select_aud tw:float-left">
                                        <span class="fa fa-user" data-toggle="tooltip" title="Seleccionar auditor"></span>
                                        @if(isset($auditorSelected))
                                            @foreach($auditorSelected as $selected)
                                                {{$selected->getAbrPer[0]->getAbreviatura[0]->titulo.' '.$selected->getNombre[0]->nombre}}
                                            @endforeach
                                        @endif
                                    </a>
                                </div>
                                <div class="tw:w-full tw:lg:w-4/12 tw:text-center tw:px-2">
                                    Agenda de la auditoria
                                </div>
                            </div>
                        </h3>
                    </div>
                    <div class="tw:p-5 tw:sm:p-6">
                        @if(!Session::get('auditorUsed'))
                            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" role="alert">No se ha seleccionado un auditor</div>
                        @else
                            <div id="exTab2" class="">
                                <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200">
                                    @foreach($fechas as $dia)
                                        <li class="{{$dia==Session::get('dateUsed')?'active':''}}"><a href="#{{$dia}}" class="tab" data-fecha="{{$dia}}" data-toggle="tab" aria-expanded="{{$dia==Session::get('dateUsed')?'true':'false'}}">{{$dia}}</a></li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach($fechas as $dia)
                                        <div class="tab-pane {{$dia==Session::get('dateUsed')?'active':''}}" id="{{$dia}}">
                                            <a href="#!" class="btn-add-agenda tw:float-right" data-fecha="{{$dia}}" data-toggle="tooltip" title="Agregar evento"><span class="fa fa-plus"></span></a>
                                            <h5>Agenda del día {{$dia}}</h5>
                                            <br>
                                            <div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
<table class="tw-tabla">
                                                <thead>
                                                    <tr>
                                                        <th class="tw:w-full tw:lg:w-1/12 tw:text-center tw:px-2">Hora</th>
                                                        <th class="tw:w-full tw:lg:w-5/12 tw:text-center tw:px-2">Procesos</th>
                                                        <th class="tw:w-full tw:lg:w-3/12 tw:text-center tw:px-2">Area responsable</th>
                                                        <th class="tw:w-full tw:lg:w-2/12 tw:text-center tw:px-2">Auditor</th>
                                                        <th class="tw:w-full tw:lg:w-1/12 tw:text-center tw:px-2">Acciones</th>
                                                    </tr>
                                                </thead>
                                                    <tbody>
                                                    @foreach($eventos as $evento)
                                                        @if($evento['id_auditor']==Session::get('auditorUsed'))
                                                        @if($evento['fecha']==$dia AND $evento)
                                                        <tr>
                                                            <td>{{$evento['hora_i']}}</td>
                                                            <td>{{$evento['procesos']}}</td>
                                                            <td>{{$evento['area']}}</td>
                                                            <td>{{$evento['auditor']}}</td>
                                                            <td class="tw:text-center"><a href="{{url('/sgc/hoja_trabajo')}}/{{$evento['id_agenda']}}"><span class="fa fa-copy" data-toggle="tooltip" title="Hoja de trabajo"></span></a></td>
                                                        </tr>
                                                        @endif
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                            </table>
</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <form id="validaHoras" action='{{url("/sgc/validate")}}/2' method="PUT">@csrf</form>

    <div class="modal fade tw-modal-compat" id="modal_ag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-panel-modal hidden>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Registro de actividad</h4>
                </div>
                <form id="form_add_ag" class="" role="form" method="POST" action="{{url("/sgc/guarda_evento")}}">
                    <div class="modal-body">
                        @csrf
                        <div id="metodo"></div>

                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                <label for="inicio">Hora de inicio</label>
                                <div class="tw:flex tw:w-full tw:items-stretch">
                                    <input id="inicio" class="timepicker tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="text" name="inicio">
                                    <span class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:bg-gray-50 tw:px-3 tw:text-sm tw:text-gray-600"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                            <div hidden class="hora_final tw:w-full tw:lg:w-4/12 tw:px-2">
                                <label for="fin">Hora de termino</label>
                                <div class="tw:flex tw:w-full tw:items-stretch">
                                    <input id="fin" class="timepicker tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="text" name="fin">
                                    <span class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:bg-gray-50 tw:px-3 tw:text-sm tw:text-gray-600"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <label for="">Área a auditar</label>
                                <select name="area" id="unidad_auditoria" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                    <option value="" selected disabled="true">Selecciona...</option>
                                    @foreach($areas as $area)
                                        <option value="{{$area->id_unidad_admin}}">{{$area->nom_departamento}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="procesos">Procesos</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="procesos" id="procesos" ></textarea>
                                </div>

                            </div>

                            <input type="text" name="fecha" hidden id="fecha" value="">
                            @foreach($auditorias as $auditoria)
                                <input type="text" name="id_auditoria" hidden value="{{$auditoria->id_auditoria}}">
                            @endforeach
                            @if(Session::get('auditorUsed'))
                                @foreach($auditorSelected as $auditor)
                                    <input type="text" name="auditor" hidden value="{{$auditor->id_asigna_audi}}">
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade tw-modal-compat" id="modal_auditores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-panel-modal hidden>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Registro de actividad</h4>
                </div>
                <form id="form_selec_aud" class="" role="form" method="GET" action="">
                    <div class="modal-body">
                        <select id="id_set_auditor" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                            <option value="" selected disabled="true">Selecciona...</option>
                            @foreach($auditores as $auditor)
                                @if(Session::get('auditorUsed'))
                                    @foreach($auditorSelected as $selected)
                                        {{$selected->getAbrPer[0]->getAbreviatura[0]->titulo.' '.$selected->getNombre[0]->nombre}}
                                    @endforeach
                                @endif
                                <option value="{{$auditor->id_auditor}}" {{Session::get('auditorUsed')==$auditor->id_auditor?'selected':''}}>{{$auditor->getAbrPer[0]->getAbreviatura[0]->titulo.' '.$auditor->getNombre[0]->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Ok"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(".btn-add-agenda").click(function () {
                var fecha=$(this).data('fecha');
                $("#fecha").val(fecha);
                $('#metodo').html('<input type="hidden" name="_method" value="PUT" id="met">');
                $.post('{{url("/sgc/validate")}}/2',$('#form_add_ag').serialize(),function (res) {
                    if(res.length>0){
                        $('#inicio').pickatime({
                            min: [9,0],
                            max: [18,0],
                            format: 'HH:i',
                            disable: res,
                            onSet: function () {
                                $('#fin').pickatime({
                                    min: $('#inicio').val(),
                                    format: 'HH:i',
                                    disable: res
                                })
                                $('.hora_final').fadeIn(500);
                            }
                        })
                    }
                    else{
                        $('#inicio').pickatime({
                            min: [9,0],
                            max: [18,0],
                            format: 'HH:i',
                            onSet: function () {
                                $('#fin').pickatime({
                                    min: $('#inicio').val(),
                                    format: 'HH:i',
                                })
                                $('.hora_final').fadeIn(500);
                            }
                        })
                    }

                })
                $("#modal_ag").modal('show');
            });

            $('#unidad_auditoria').change(function () {
                $('#metodo').html('<input type="hidden" name="_method" value="PUT" id="met">');
                $.post('{{url("/sgc/validate")}}/1',$('#form_add_ag').serialize(),function (res) {
                    $('#auditor_area').html(res);
                    $('.auditores_area').fadeIn(500);
                    $('#metodo').empty();
                })
            });

            $(".btn_select_aud").click(function(){
                $("#modal_auditores").modal('show');
            });

            $("#id_set_auditor").change(function () {
                $("#form_selec_aud").attr('action','{{url('/sgc/auditor')}}/'+$(this).val())
            });



            $(".tab").click(function () {
                $.get('{{url('/sgc/setFecha')}}/'+$(this).data('fecha'))
            });



            $('[data-toggle="tooltip"]').tooltip();

        })
    </script>
@endsection
















