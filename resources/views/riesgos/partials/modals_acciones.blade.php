@section('cont_modals_acciones')

    <div class="modal fade tw-modal-compat" id="modal_acciones_factores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-panel-modal hidden>
        <div class="modal-dialog tw:mt-2" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo accion</h5>
                    <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_add_accion" class="" role="form" method="POST" action="{{url('riesgos/riestrategiaccion')}}"/>
                @csrf
                <div class="modal-body">

                    <input type="hidden" id="id_factor_accion" name="id_factor_accion" value="">

                    <div class="tw:mb-4">
                        <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">Acción</label>
                        <textarea name="desc_accion" id="desc_accion" cols="30" rows="3" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"></textarea>
                    </div>

                    <h3 class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700">Después de establecer las fechas no podrá realizar ningún cambio, asegúrese de verificar que sean correctas.</h3>
                    <div class="tw:mb-4">
                        <label for="fecha_entrega" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">Fecha Inicial</label>
                        <div class="date tw:flex tw:w-full tw:items-stretch" id="date_picker_group" data-provide="datepicker">
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="fecha_programada" name="fecha_programada" />
                            <div class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:bg-gray-50 tw:px-3 tw:text-sm tw:text-gray-600">
                                <span class="fa fa-th"></span>
                            </div>
                        </div>
                    </div>
                    <div class="tw:mb-4">
                        <label for="fecha_final" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">Fecha Final</label>
                        <div class="date tw:flex tw:w-full tw:items-stretch" id="date_picker_group" data-provide="datepicker">
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="fecha_final" name="fecha_final" />
                            <div class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:bg-gray-50 tw:px-3 tw:text-sm tw:text-gray-600">
                                <span class="fa fa-th"></span>
                            </div>
                        </div>
                    </div>
                    <div class="tw:mb-4">
                        <label for="unidad_admin" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">Unidad Responsable</label>
                        <select  class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="unidad_admin" id="unidad_admin">
                            <option value="0" disabled="true" selected="true">Seleccione una opción</option>

                        @foreach($unidad_administrativa as $unidad_admin)
                                <option value="{{$unidad_admin->id_unidad_admin}}">{{$unidad_admin->nom_departamento}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#!" id="cancel_accion_boton"  class="h-secondary_m tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</a>
                    <button type="submit" class="h-primary_m tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Aceptar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade tw-modal-compat" id="modal_acciones_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-panel-modal hidden>
        <div class="modal-dialog tw:mt-2" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar control de riesgo</h5>
                    <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_edit_accion" class="" role="form" method="POST" action=""/>
                @csrf
                @method("PUT")
                <div class="modal-body">

                    <div class="tw:mb-4">
                        <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">Acción</label>
                        <textarea name="desc_accion_edit" id="desc_accion_edit" cols="30" rows="3" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500"></textarea>
                    </div>
                    <div class="tw:mb-4">
                        <label for="fecha_entrega" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">Fecha entrega</label>
                        <div class="date tw:flex tw:w-full tw:items-stretch" id="date_picker_group" data-provide="datepicker">
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="fecha_programada_edit" name="fecha_programada_edit"  disabled="true" />
                            <div class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:bg-gray-50 tw:px-3 tw:text-sm tw:text-gray-600">
                                <span class="fa fa-th"></span>
                            </div>
                        </div>
                    </div>
                    <div class="tw:mb-4">
                        <label for="fecha_final_edit" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">Fecha Final</label>
                        <div class="date tw:flex tw:w-full tw:items-stretch" id="date_picker_group" data-provide="datepicker">
                            <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="fecha_final_edit" name="fecha_final_edit" disabled="true"  />
                            <div class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:bg-gray-50 tw:px-3 tw:text-sm tw:text-gray-600">
                                <span class="fa fa-th"></span>
                            </div>
                        </div>
                    </div>
                    <div class="tw:mb-4">
                        <label for="unidad_admin_edit" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">Unidad Responsable</label>
                        <select  class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="unidad_admin_edit" id="unidad_admin_edit">
                        <option value="0" disabled="true" selected="true">Seleccione una opción</option>

                        @foreach($unidad_administrativa as $unidad_admin)
                            <option value="{{$unidad_admin->id_unidad_admin}}">{{$unidad_admin->nom_departamento}}</option>
                            @endforeach
                            </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="h-secondary_m tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="h-primary_m tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Aceptar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade tw-modal-compat" id="modal_add_evidencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-panel-modal hidden>
        <div class="modal-dialog tw:mt-2" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar control de riesgo</h5>
                    <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_add_evidencia" class="" role="form" method="POST" action="" enctype="multipart/form-data" />
                @csrf
                @method("PUT")
                <div class="modal-body">

                    <div class="tw:mb-4">
                        <label for="" class="tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700">Evidencia</label>
                        <input name="evidencia" id="evidencia"  class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden" type="file" accept="application/pdf">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="h-secondary_m tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="h-primary_m tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Aceptar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".btn_add_evidencia_riesgo").click(function(){

                        $("#form_add_evidencia").attr("action","{{url("riesgos/seguimiento/file_riesgo/")}}/"+$(this).data("id"));
            });
            $("#form_add_accion").validate({
                rules: {
                    desc_accion:{required:true,},
                    fecha_programada:{required:true,},
                    fecha_final:{required:true,},
                    unidad_admin:{required:true,},

                },
            });
            $("#form_edit_accion").validate({
                rules: {
                    desc_accion_edit:{required:true,},
                    fecha_programada_edit:{required:true,},
                    fecha_final_edit:{required:true,},
                    unidad_admin_edit:{required:true,},

                },
            });
            $(".btn_edit_control_riesgo").click(function(){
                //console.log($(this).data("descripcion"));
                $("#desc_accion_edit").val($(this).data("accion"));
                $("#fecha_programada_edit").val($(this).data("fecha"));
                $("#fecha_final_edit").val($(this).data("fecha_final"));
                $("#unidad_admin_edit").val($(this).data("unidad_admin"));
                $("#form_edit_accion").attr("action","{{url('riesgos/riestrategiaccion')}}/"+$(this).data("id"));
            });

            $(".btn_add_accion").click(function(){
                $("#id_factor_accion").val($(this).data("id"));
            });

            $('.date').datepicker({
                format: 'yyyy/mm/dd',
                language: 'es',
                autoclose: true,
                startDate: '+1d',

            });
            $("#cancel_accion_boton").click(function(){
                $('.nav-tabs a[href="'+$(this).attr('href')+'"]').tab('show');

                $("#cancel_accion_boton").attr("href","#!");
            });
        });
    </script>
@endsection