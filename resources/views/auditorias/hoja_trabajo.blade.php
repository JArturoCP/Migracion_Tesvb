@extends('layouts.panel')
@section('title', 'Hoja de trabajo')
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
            <a class="tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{url('/auditorias/planes')}}/{{$agenda->id_auditoria}}">Detalles del plan</a>
            <span class="fa fa-chevron-right tw:text-[10px] tw:text-gray-400"></span>
            <a class="tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{url('/auditorias/agenda')}}/{{$agenda->id_auditoria}}">Agenda del plan</a>
            <span class="fa fa-chevron-right tw:text-[10px] tw:text-gray-400"></span>
            <span class="tw:text-gray-800 tw:dark:text-white/90">Hoja de trabajo</span>
        </nav>
        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Hoja de trabajo</h3>
            </div>
            <div class="tw:p-5 tw:sm:p-6">

                @if($reporte->count()>0)
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:lg:w-8/12 tw:mb-4 tw:px-2">
                            <strong>Área:</strong>
                            {{\App\audParseCase::parseNombre($reporte->nom_departamento)}}
                        </div>
                        <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                            <strong>Auditoria:</strong>
                            {{\Carbon\Carbon::parse($agenda->fecha)->locale('es')->translatedFormat('Y').'-'.$noAud}}
                        </div>
                        <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                            <strong>Auditado:</strong>
                            {{\App\audParseCase::parseAbr($reporte->titulo).' '.\App\audParseCase::parseNombre($reporte->nombre)}}
                        </div>
                        <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                            <strong>Fecha:</strong>
                            {{\Carbon\Carbon::parse($agenda->fecha)->locale('es')->translatedFormat('d-m-Y')}}
                        </div>
                    </div>
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:lg:w-full tw:px-2">
                            <br>
                            <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Reporte Agenda </h3>
                            <br>
                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-rayas tw-tabla-bordes tw-tabla-compacta">
                                <thead>
                                <tr class="">
                                    <th class="tw:text-center" style="width:20px !important;">Criterio <br>de la norma</th>
                                    <th class="tw:text-center">Hallazgos</th>
                                    <th class="tw:text-center">Evaluación</th>
                                    <th class="tw:text-center">Resultado</th>
                                    <th class="tw:text-center">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($criterios as $nota)
                                    <tr class="">
                                        <td style="width:20px !important;">{{$nota->punto_proceso}}</td>
                                        <td>
                                            <textarea rows="8" disabled="disabled" id="observacion{{$nota->id_notas}}" class="notas{{$nota->id_notas}}">{{$nota->observaciones}}</textarea>
                                        </td>
                                        <td>
                                            <select disabled="disabled" id="clasificacion{{$nota->id_notas}}" class="notas{{$nota->id_notas}}">
                                                <option selected disabled="disabled">No Evaluado</option>
                                                @foreach($audClasificacion as $clasifi)

                                                    <option name="" id="" value="{{$clasifi->id_clasificacion}}" {{$clasifi->id_clasificacion==$nota->id_clasificacion?"selected":""}} {{--$clasifi->id_clasificacion==5?"disabled":""--}}>{{$clasifi->descripcion}}</option>

                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <textarea  rows="8" disabled="disabled" id="resultado{{$nota->id_notas}}" class="notas{{$nota->id_notas}}">{{$nota->resultado}}</textarea>
                                        </td>
                                        <td class="tw:lg:w-2/12 tw:text-center">

                                            @if($esLider)

                                                <a href="#!" id="autorizar-event{{$nota->id_notas}}" class="autorizar-event {{ ['success' => 'tw:bg-green-600 tw:text-white tw:hover:bg-green-700', 'info' => 'tw:bg-sky-500 tw:text-white tw:hover:bg-sky-600', 'warning' => 'tw:bg-amber-500 tw:text-white tw:hover:bg-amber-600', 'danger' => 'tw:bg-red-600 tw:text-white tw:hover:bg-red-700', 'primary' => 'tw:bg-brand-500 tw:text-white tw:hover:bg-brand-600'][($nota->autorizacion==null||$nota->autorizacion==0)?"danger":"success"] ?? 'tw:bg-gray-500 tw:text-white' }} tw:md:m-2 tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-id="{{$nota->id_notas}}" data-value="{{($nota->autorizacion==null||$nota->autorizacion==0)?"true":"false"}}" data-type="{{$agenda['tipo']}}" data-toggle="tooltip" title="{{($nota->autorizacion==null||$nota->autorizacion==0)?"Autorizar evaluación":"Cancelar autorización"}}"><span class="fa fa-star tw:float-right"></span></a>
                                            @endif
                                            @if(($nota->autorizacion==null||$nota->autorizacion==0)||$esLider)
                                            <a href="#!" id="editar{{$nota->id_notas}}" class="editar_nota tw:md:m-2 tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-id="{{$nota->id_notas}}" data-toggle="tooltip" title="Editar evento"><span class="fa fa-pencil tw:float-right"></span></a>
                                            @endif
                                                <a href="#!" id="guardar{{$nota->id_notas}}" class="guardar_nota tw:md:m-2 tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-id="{{$nota->id_notas}}" data-toggle="tooltip" title="Guardar nota" style="display:none"><span class="fa fa-floppy-o tw:float-left"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td style="width:20px !important;">
                                        <input type="text" id="notaNueva" class="notasNueva" disabled>
                                    </td>
                                    <td>
                                        <textarea rows="8" disabled="disabled" id="observacionNueva" class="notasNueva"></textarea>
                                    </td>
                                    <td>
                                        <select disabled="disabled" id="clasificacionNueva" class="notasNueva">
                                            <option selected disabled="disabled">No Evaluado</option>
                                            @foreach($audClasificacion as $clasifi)
                                                <option name="" id="" value="{{$clasifi->id_clasificacion}}">{{$clasifi->descripcion}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <textarea rows="8" disabled="disabled" id="resultadoNueva" class="notasNueva"></textarea>
                                    </td>
                                    <td >
                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                            <div class="tw:w-full tw:lg:w-1/12 tw:px-2">
                                                <a href="#!" id="editarNueva" class="editar_nota tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-id="Nueva" data-toggle="tooltip" title="Agregar evento"><span class="fa fa-plus tw:float-right"></span></a>
                                            </div>
                                            <div class="tw:w-full tw:lg:w-1/12 tw:px-2">
                                                <a href="#!" id="guardarNueva" class="guardar_nota tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-id="Nueva" data-toggle="tooltip" title="Guardar nota" style="display:none"><span class="fa fa-floppy-o tw:float-left"></span></a>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
</div>
                        </div>
                    </div>
                @else
                    <form action="{{url('auditorias/hoja_trabajo')}}" method="POST">
                        @csrf
                        <input type="text" name="id_agenda" value="{{$agenda->id_agenda}}" hidden>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-6/12 tw:mb-4 tw:px-2">
                                <strong>Área:</strong>
                                <select name="id_area" id="id_area" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                    <option selected disabled="true" value="">Selecciona...</option>
                                    @foreach($areas as $area)
                                        <option value="{{$area->id_area}}">{{\App\audParseCase::parseNombre($area->nom_departamento)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <strong>Auditado:</strong>
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" value="" id="auditado" disabled>
                                <input type="text" value="" name="id_auditado" id="id_auditado" hidden>
                            </div>
                        </div>
                        <br>
                        <input type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:float-right tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
                    </form>
                @endif
            </div>
        </div>
    </div>
</main>

<form  method="POST" role="form" id="form_edit_evento">
    {{ method_field('PUT') }}
    {{ csrf_field() }}

    <input type="hidden" id="idNota" name="id_nota" value="">
    <input type="hidden" id="saveNueva" name="saveNueva">
    <input type="hidden" id="saveHallazgo" name="observaciones" value="">
    <input type="hidden" id="saveClasifica" name="id_clasificacion" value="">
    <input type="hidden" id="saveResultado" name="resultado" value="">

    <input type="hidden" id="idReporte" name="idReporte" value="{{$reporte->id_reporte}}">

</form>

<form  method="POST" role="form" id="form_autoriza_evento">
    {{ method_field('PUT') }}
    {{ csrf_field() }}

    <input type="hidden" id="id_nota_autorizar" name="id_nota_autorizar" value="">
    <input type="hidden" id="autorizaNota" name="autorizaNota" value="">


</form>

<script>
    $(document).ready(function () {
        $('#id_area').change(function(){
            var val=$(this).val();
            $.get('{{url('auditorias/get_responsable_area')}}/'+val,{},function (data) {
                // $("#id_auditado option[value="+ data.id_personal +"]").attr("selected",true);
                console.log(data);
                $('#auditado').attr('value',data[0].titulo+' '+data[0].nombre);
                $('#id_auditado').attr('value',data[0].id_personal);
            });
        });

        $(".editar_nota").click(function(){
           var id_nota=$(this).data("id");
            $(".notas"+id_nota).prop("disabled",false);
           $(this,"#autorizar-event"+id_nota).hide();

           $("#guardar"+id_nota).show();
           $(".notasNueva").val("");

            $('#form_edit_evento').trigger("reset");
        });

        $(".autorizar-event").click(function(){
            var data_id=$(this).data("id");
            $("#id_nota_autorizar").val(data_id);
            $("#autorizaNota").val($(this).data("value"))
            $("#form_autoriza_evento").submit();
        });
        $(".guardar_nota").click(function(){

            var id_nota=$(this).data("id");
            //TNotify.alert($("#clasificacionNueva").val());
            if(id_nota=="Nueva")
                if($("#notaNueva").val()!=""&&$("#clasificacionNueva").val()!=""&&$("#clasificacionNueva").val()!=null)
                    if($("#resultadoNueva").val()==""&&($("#clasificacionNueva").val()!=3||$("#clasificacionNueva").val()==null))
                        Swal.fire({
                            title: 'Error',
                            text: 'Debes capturar el resultado de la auditoria',
                            timer: 2500
                        });
                    else
                        saveNota(id_nota);
                else
                    Swal.fire({
                        title: 'Error',
                        text: 'Captura el criterio de la norma y la evaluación',
                        timer: 2500
                    });
            else
                if($("#resultado"+id_nota).val()==""&&($("#clasificacion"+id_nota).val()!=3||$("#clasificacion"+id_nota).val()==null))
                    Swal.fire({
                        title: 'Error',
                        text: 'Debes capturar el resultado de la auditoria',
                        timer: 2500
                    });
                else
                saveNota(id_nota);
        });



        $('[data-toggle="tooltip"]').tooltip();
    });

    function saveNota(id_nota){
        $("#idNota").val(id_nota);
        $("#saveHallazgo").val($("#observacion"+id_nota).val())
        $("#saveClasifica").val($("#clasificacion"+id_nota).val())
        $("#saveResultado").val($("#resultado"+id_nota).val())
        $("#saveNueva").val($("#notaNueva").val())
        $("#form_edit_evento").submit();
        $(".notas"+id_nota).prop("disabled",true);
        $(this).hide();
        $("#editar"+id_nota,"#autorizar-event"+id_nota).show();
        $('#form_edit_evento').trigger("reset");

    }
</script>

@endsection
