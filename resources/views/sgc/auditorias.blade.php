@extends('layouts.panel')
@section('title', 'Auditorias')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <main class="tw:flex tw:flex-wrap tw:gap-y-4 tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                @if (session()->has('flash_notification.message'))
                    <x-panel.alerta :tipo="['success' => 'exito', 'danger' => 'error', 'warning' => 'advertencia'][session('flash_notification.level')] ?? 'info'" class="tw:mb-4">{!! session('flash_notification.message') !!}</x-panel.alerta>
                @endif
            </div>
        </div>
        <x-panel.encabezado titulo="Auditorias Internas" :migas="['Sistema de gestión de calidad' => null]" />
    <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla">
                        <thead>
                        <tr>
                            <th class="tw:w-full tw:lg:w-4/12 tw:px-2">Numero de Auditoria</th>
                            <th class="tw:w-full tw:lg:w-6/12 tw:px-2">Periodo</th>
                            <th class="tw:w-full tw:lg:w-2/12 tw:text-center tw:px-2">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($auditorias as $data_auditoria)
                            <tr>
                                <td>
                                    <a class="tw:text-brand-500 tw:hover:underline" href="{{url('sgc/ver_plan_auditoria/')}}/{{$data_auditoria->id_auditoria}}">{{date('Y',strtotime($data_auditoria->fecha_i)).'-'.$data_auditoria->id_auditoria}}</a>

                                </td>
                                <td>
                                    <p>{{$data_auditoria->fecha_i}}  al  {{$data_auditoria->fecha_f}}</p>
                                </td>
                                <td class="tw:text-center">
                                    {{--<a href="#" class="btn_add_auditores tw:float-left" data-id="{{$data_auditoria->id_auditoria}}" data-toggle="modal" data-target="#modal_add_auditores"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar Auditores"></span></a>--}}
                                    {{--<a href="#" class="btn-edit-plan" data-all="{{$data_auditoria}}"><span class="fa fa-cog" data-toggle="tooltip" title="Editar plan"></span></a>--}}
                                    <a href="#" class="btn_delete_plan tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" data-id="{{$data_auditoria->id_auditoria}}"><span class="fa fa-trash" data-toggle="tooltip" title="Eliminar Plan de Auditoria"></span></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
</div>
                </div>
            </div>
        </div>
        <div class="tw:w-full tw:px-2">
            {{--<div id="accordion" class="">--}}
                {{--@foreach($auditorias as $data_auditoria)--}}
                    {{--<div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">--}}
                        {{--<div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:bg-white tw:text-gray-700 tw:dark:text-gray-300 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50">--}}
                            {{--<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$data_auditoria->id_auditoria}}" data-id="{{$data_auditoria->id_auditoria}}" class="btn_open_panel"><span data-toggle="tooltip" title="Mostrar detalles">Plan de auditoria {{date('Y',strtotime($data_auditoria->fecha_i)).'-'.$data_auditoria->id_auditoria}}</span></span></a>--}}
                            {{--<a href="#!" class="btn_delete_plan tw:float-right" data-id="{{$data_auditoria->id_auditoria}}"><span class="fa fa-trash" data-toggle="tooltip" title="Eliminar Plan de Auditoria"></span></a>--}}
                        {{--</div>--}}
                        {{--<div id="collapse{{$data_auditoria->id_auditoria}}" class="collapse">--}}
                            {{--<div class="tw:p-5 tw:sm:p-6">--}}
                                {{--<div class="tw:w-full tw:lg:w-3/12 tw:px-2">--}}
                                    {{--<strong>Objetivo</strong>--}}
                                    {{--<p>{{$data_auditoria->objetivo}}</p>--}}
                                {{--</div>--}}
                                {{--<div class="tw:w-full tw:lg:w-3/12 tw:px-2">--}}
                                    {{--<strong>Alcance</strong>--}}
                                    {{--<p>{{$data_auditoria->alcance}}</p>--}}
                                {{--</div>--}}
                                {{--<div class="tw:w-full tw:lg:w-3/12 tw:px-2">--}}
                                    {{--<strong>Criterios</strong>--}}
                                    {{--<p>{{$data_auditoria->criterios}}</p>--}}
                                {{--</div>--}}
                                {{--<div class="tw:w-full tw:lg:w-3/12 tw:px-2">--}}
                                    {{--<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">--}}
                                        {{--<div class="tw:w-full tw:lg:w-6/12 tw:px-2">--}}
                                            {{--<strong>Fecha de inicio</strong>--}}
                                            {{--<p>{{$data_auditoria->fecha_i}}</p>--}}
                                        {{--</div>--}}
                                        {{--<div class="tw:w-full tw:lg:w-6/12 tw:px-2">--}}
                                            {{--<strong>Fecha de termino</strong>--}}
                                            {{--<p>{{$data_auditoria->fecha_f}}</p>--}}
                                            {{--<br>--}}
                                            {{--<h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">--}}
                                                {{--<a href="#" class="btn-edit-plan tw:float-left" data-all="{{$data_auditoria}}"><span class="fa fa-cog" data-toggle="tooltip" title="Editar plan"></span></a>--}}
                                            {{--</h4>--}}
                                            {{--<h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">--}}
                                                {{--<a href="#" class="btn_add_auditores tw:float-right" data-id="{{$data_auditoria->id_auditoria}}" data-toggle="modal" data-target="#modal_add_auditores"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar Auditores"></span></a>--}}
                                            {{--</h4>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}
        </div>
    </main>

    <div>
        <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar nueva auditoria" data-target="#modal_crea_aud" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
            <span class="fa fa-plus" aria-hidden="true"></span>
        </button>
    </div>

    <form id="form_add_aud" class="" role="form" method="POST" action="{{url("/sgc/auditorias")}}">
        <x-panel.modal id="modal_crea_aud" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Registro de plan de auditorias</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        {{ csrf_field() }}
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="objetivo">Objetivo</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"name="objetivo" placeholder="Objetivo del plan de auditorias"></textarea>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="alcance">Alcance</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"name="alcance" placeholder="Alcance del plan de auditorias"></textarea>
                                </div>
                                {{--<div class="tw:mb-4">--}}
                                    {{--<label for="criterios">Criterios</label>--}}
                                    {{--<textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"name="criterios" placeholder="Criterios del plan de auditorias"></textarea>--}}
                                {{--</div>--}}
                            </div>
                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <label for="fecha_i">Fecha de inicio</label>
                                <input name="fecha_i" type="date">
                            </div>
                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <label for="fecha_f">Fecha de termino</label>
                                <input name="fecha_f" type="date">
                            </div>
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Guardar"/>
                    </div>
                </x-panel.modal>
    </form>

    <form id="form_edit_aud" class="" role="form" method="POST" action="">
        <x-panel.modal id="modal_edit_aud" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Registro de plan de auditorias</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        @csrf
                        @method("PUT")
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="objetivo">Objetivo</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="objetivo" name="objetivo" placeholder="Objetivo del plan de auditorias"></textarea>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="alcance">Alcance</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="alcance" name="alcance" placeholder="Alcance del plan de auditorias"></textarea>
                                </div>
                                <div class="tw:mb-4">
                                    <label for="criterios">Criterios</label>
                                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="criterios" name="criterios" placeholder="Criterios del plan de auditorias"></textarea>
                                </div>
                            </div>
                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <label for="fecha_i">Fecha de inicio</label>
                                <input id="fecha_i" name="fecha_i" type="date">
                            </div>
                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <label for="fecha_f">Fecha de termino</label>
                                <input id="fecha_f" name="fecha_f" type="date">
                            </div>
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Guardar"/>
                    </div>
                </x-panel.modal>
    </form>

    <form id="form_add_auditores" class="" role="form" method="POST" action="{{url("/sgc/asignaAudi")}}">
        <x-panel.modal id="modal_add_auditores" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Registro de auditores</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        {{ csrf_field() }}
                        <input type="text" name="id_auditoria" id="id_auditoria" hidden>
                        <div class="tw:mb-4">
                            <label for="">Lider de la Auditoria</label>
                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="lider">
                                <option value="" selected="true" disabled="true">Selecciona...</option>
                                @foreach($personas as $auditores)
                                    <option value="{{$auditores->id_personal}}">{{$auditores->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                                <label for="">Equipo de Auditores</label>
                            </div>
                            <div class="tw:w-3/12 tw:text-right tw:px-2">
                                <label for="">Número de auditores:</label>
                            </div>
                            <div class="tw:w-3/12 tw:px-2">
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="num_auditores" id="num_auditores">
                                    <option value="" selected="true" disabled="true">Selecciona...</option>
                                    @for($i = 1; $i<=10; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="auditores">

                        </div>
                        <hr>
                        <div class="tw:flex tw:items-center tw:gap-2">
                            <label>
                                <input type="checkbox" name="en_entrenamiento" id="en_entrenamiento">
                                ¿Agregar auditores en entrenamiento?
                            </label>
                        </div>
                        <div hidden class="entrenamiento">
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-6/12 tw:px-2">
                                    <label for="">Número de auditores en entrenamiento:</label>
                                </div>
                                <div class="tw:w-4/12 tw:px-2">
                                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="num_auditores_ent" id="num_auditores_ent">
                                        <option value="" selected="true" disabled="true">Selecciona...</option>
                                        @for($i = 1; $i<=10; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" id="auditores_ent">

                            </div>
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="cancelar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Guardar"/>
                    </div>
                </x-panel.modal>
    </form>

    <form  method="POST" role="form" id="form_delete">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
    </form>

    <script>
        $(document).ready(function () {
            $(".btn-edit-plan").click(function () {
                var data=$(this).data('all');
                $("#form_edit_aud").attr("action","{{url("/sgc/auditorias")}}/"+data['id_auditoria'])
                $("#objetivo").val(data['objetivo']);
                $("#alcance").val(data['alcance']);
                $("#criterios").val(data['criterios']);
                $("#fecha_i").val(data['fecha_i'])
                $("#fecha_f").val(data['fecha_f'])
                $("#modal_edit_aud").modal('show');
            });

            $(".btn_delete_plan").click(function(){
                var id=$(this).data('id');
                swal({
                    title: "¿Seguro que desea eliminar?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $("#form_delete").attr("action","{{url('sgc/auditorias')}}/"+id)
                            $("#form_delete").submit();
                        }
                    });
            });

            $(".btn_add_auditores").click(function () {
                $("#id_auditoria").val($(this).data('id'))
            })

            $("#num_auditores").change(function () {
                $("#auditores").empty();
                var num=$(this).val();
                $.get("{{url('/sgc/auditorias/auditores')}}/1/"+$(this).val(),{},function (res) {
                    $("#auditores").append(res);
                });
            });
            $("#num_auditores_ent").change(function () {
                $("#auditores_ent").empty();
                var num=$(this).val();
                $.get("{{url('/sgc/auditorias/auditores')}}/2/"+$(this).val(),{},function (res) {
                    $("#auditores_ent").append(res);
                });
            });

            $("#en_entrenamiento").change(function () {
                if ($(this).is(':checked'))$(".entrenamiento").fadeIn(500);
                else $(".entrenamiento").fadeOut(500);
            });


            $('[data-toggle="tooltip"]').tooltip();

        })
    </script>
</div>
@endsection