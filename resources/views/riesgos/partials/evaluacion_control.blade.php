@section('cont_evaluacion_control'.$id_factor)

    <ul class="nav-tabs tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800" >
        @if($ri_factor->tiene_controles=="SI")
        <li class="active"><a data-toggle="pill" href="#nav-controles{{$id_factor}}" >Controles</a></li>
        @endif
        <li><a data-toggle="pill" href="#nav-estrategias{{$id_factor}}">Acciones</a></li>
    </ul>
    <div class="tab-content">
        @if($ri_factor->tiene_controles=="SI")
            {{Session::put('controlado','SI')}}
        <div class="tab-pane fade in active tw:text-center" id="nav-controles{{$id_factor}}">
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" >
                <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:px-2">
                    {{--<span data-toggle="modal" data-target="#modal_controles_factores" class=""><a href="#!" class="h-primary_m btn_add_eva_control tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:px-12 tw:mb-2 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-id="{{$id_factor}}">Nuevo Control</a></span>--}}
                    <a href="#!" class="btn_add_eva_control tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="modal" data-target="#modal_controles_factores" data-id="{{$id_factor}}"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar Control"></span></a>
                </div>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada border-table tw-tabla tw:my-0">
                            <thead class="tw:text-center">
                            <tr class="table-active">
                                <th class="tw:text-center">No. de Control</th>
                                <th class="tw:text-center">Descripción</th>
                                <th class="tw:text-center">Tipo</th>
                                <th class="tw:text-center">Esta documentado</th>
                                <th class="tw:text-center">Esta formalizado</th>
                                <th class="tw:text-center">Se aplica</th>
                                <th class="tw:text-center">Es efectivo</th>
                                <th class="tw:text-center">Resultado</th>
                                <th class="tw:text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ri_factor->riEvaControl as $eva_control)

                                <tr>
                                    <td>{{(explode("-",$datos_registro_riesgo[0]->numero)[1]).".".$ri_factor->no_factor.".".$eva_control->No_controles_eva}}</td>
                                    <td>
                                        @if($eva_control->resultado=="DEFICIENTE")
                                            <a  href="#!" class="btn_add_accion tw:float-right" id="add_accion_control"data-toggle="modal" data-target="#modal_acciones_factores" data-id="{{$id_factor}}">
                                                {{$eva_control->descripcion}}
                                            </a>
                                        @else
                                            {{$eva_control->descripcion}}
                                        @endif

                                    </td>
                                    <td>{{$eva_control->tipoEva[0]->des_eva}}</td>
                                    <td>{{$eva_control->documentado}}</td>
                                    <td>{{$eva_control->formalizado}}</td>
                                    <td>{{$eva_control->aplica}}</td>
                                    <td>{{$eva_control->efectivo}}</td>
                                    <td>{{$eva_control->resultado}}</td>
                                    <td>
{{--                                        <span data-toggle="modal" data-target="#modal_controles_factores_edit" ><a href="#!" class="h-primary_m btn_edit_control_riesgo tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"  data-efectivo="{{$eva_control->efectivo}}" data-aplica="{{$eva_control->aplica}}" data-formalizado="{{$eva_control->formalizado}}" data-documentado="{{$eva_control->documentado}}" data-tipo_eva="{{$eva_control->id_tipo_eva}}" data-descripcion="{{$eva_control->descripcion}}" data-id="{{$eva_control->id_evaluacion}}" data-toggle="tooltip" data-placement="top" title="modificar"><span class="oi oi-pencil"></span></a></span>--}}
{{--                                        <span><a href="#!" class="h-primary_m btn_delete_element_riesgo tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-toggle="tooltip" data-placement="top" title="Eliminar" data-id="{{$eva_control->id_evaluacion}}" data-url="{{url("riesgos/rievaluacioncontrol")}}"><span class="oi oi-trash"></span></a></span>--}}
                                        <a href="#!" class="btn_edit_control_riesgo tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="modal" data-target="#modal_controles_factores_edit" data-efectivo="{{$eva_control->efectivo}}" data-aplica="{{$eva_control->aplica}}" data-formalizado="{{$eva_control->formalizado}}" data-documentado="{{$eva_control->documentado}}" data-tipo_eva="{{$eva_control->id_tipo_eva}}" data-descripcion="{{$eva_control->descripcion}}" data-id="{{$eva_control->id_evaluacion}}" ><span class="fa fa-cog" data-toggle="tooltip" data-placement="top" title="modificar"></span></a>
                                        <a href="#!" class="btn_delete_element_riesgo tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" data-id="{{$eva_control->id_evaluacion}}" data-url="{{url("riesgos/rievaluacioncontrol")}}"><span class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Eliminar"></span></a>

                                    </td>
                                </tr>
                                @if($eva_control->documentado=="NO" || $eva_control->formalizado=="NO" || $eva_control->aplica=="NO" || $eva_control->efectivo=="NO")
                                    {{Session::put('controlado','NO')}}
                                @endif
                            @endforeach
                            </tbody>
                        </table>
</div>
                </div>
            </div>
        </div>
        @endif
        <div class="tab-pane fade tw:text-center" id="nav-estrategias{{$id_factor}}">
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                 <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:lg:w-full tw:px-2">
                    {{--<span data-toggle="modal" data-target="#modal_acciones_factores" class=""><a href="#!" class="h-primary_m btn_add_accion tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:px-12 tw:mb-2 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-id="{{$id_factor}}">Nueva Accion</a></span>--}}
                     <a href="#!" class="btn_add_accion tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="modal" data-target="#modal_acciones_factores" data-id="{{$id_factor}}"><span class="fa fa-plus"></span></a>
                </div>
            </div>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:px-2">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada border-table tw-tabla tw:my-0">
                        <thead class="tw:text-center">
                        <tr class="table-active tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <th class="tw:w-full tw:text-center tw:lg:w-8/12 tw:px-2">Accion</th>
                            <th class="tw:w-full tw:text-center tw:lg:w-3/12 tw:px-2">Fecha Inicio</th>
                            <th class="tw:w-full tw:text-center tw:lg:w-3/12 tw:px-2">Fecha Termino</th>
                            <th class="tw:w-full tw:text-center tw:lg:w-3/12 tw:px-2">Unidad Responsable</th>

                            <th class="tw:w-full tw:text-center tw:lg:w-1/12 tw:px-2">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ri_factor->riAcciones as $accion_factor)

                            <tr class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <td class="tw:w-full tw:lg:w-8/12 tw:px-2">{{$accion_factor->accion}}</td>
                                <td class="tw:w-full tw:lg:w-3/12 tw:px-2">{{$accion_factor->fecha}}</td>
                                <td class="tw:w-full tw:lg:w-3/12 tw:px-2">{{$accion_factor->fecha_final}}</td>
                                <td class="tw:w-full tw:lg:w-3/12 tw:px-2">{{isset($accion_factor->getUnidadAdmin[0])?$accion_factor->getUnidadAdmin[0]->nom_departamento:""}}</td>
                                <td class="tw:w-full tw:lg:w-1/12 tw:px-2">
                                    <a href="#!" class="btn_edit_control_riesgo tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="modal" data-target="#modal_acciones_edit" data-unidad_admin="{{$accion_factor->id_unidad_admin}}"data-fecha_final="{{$accion_factor->fecha_final}}" data-fecha="{{$accion_factor->fecha}}" data-accion="{{$accion_factor->accion}}" data-id="{{$accion_factor->id_estrategia_a}}" ><span class="fa fa-cog" data-toggle="tooltip" data-placement="top" title="modificar"></span></a>
                                    <a href="#!" class="btn_delete_element_riesgo tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" data-id="{{$accion_factor->id_estrategia_a}}" data-url="{{url("riesgos/riestrategiaccion")}}"><span class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Eliminar"></span></a>
                                    <br>
                                    <a href="#!" class="btn_add_evidencia_riesgo tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-id="{{$accion_factor->id_estrategia_a}}" data-toggle="modal" data-target="#modal_add_evidencia" ><span class="fa fa-file" data-toggle="tooltip" data-placement="top" title="Adjuntar evidencia"></span></a>
                                    @if($accion_factor->file!=null)

                                    <a href="{{asset("storage/".$accion_factor->file)}}" target="_blank"  class="btn_add_evidencia_riesgo tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><span class="fa fa-camera" data-toggle="tooltip" data-placement="top" title="Ver evidencia"></span></a>
                                   
                                 
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
</div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#add_accion_control").click(function(){
                $('.nav-tabs a[href="#nav-estrategias{{$id_factor}}"]').tab('show');
                $("#cancel_accion_boton").attr("href","#nav-controles{{$id_factor}}");
            });

        })

    </script>
@endsection