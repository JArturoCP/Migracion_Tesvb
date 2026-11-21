@extends('layouts.panel')
@section('title', 'Catalogo Generales')
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
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                    <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Catalogo Generales</h3>
                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                                    <a href="#" class="tw:float-right" data-toggle="modal" data-target="#modal_add_grupo_adm"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar Grupo Administrativo"></span></a>
                                    <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Grupos Administrativos</h3>
                                </div>
                                @if($areas_generales->count()>0)
                                    <div class="tw:p-5 tw:sm:p-6">
                                        @foreach($areas_generales as $area)
                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                <div class="tw:w-full tw:lg:w-10/12 tw:px-2">
                                                    <li>{{\App\audParseCase::parseNombre($area->descripcion)}}</li>
                                                </div>
                                                <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                                    <a href="#" class="delete-admon tw:float-right" data-id="{{$area->id_area_general}}" data-toggle="tooltip" title="Eliminar grupo"><span class="fa fa-trash"></span></a>
                                                    <a href="#" class="edit_admon tw:float-left" data-all="{{$area}}" data-toggle="tooltip" title="Editar grupo"><span class="fa fa-cog"></span></a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="tw:p-5 tw:sm:p-6 tw:border-red-200 tw:bg-red-50 tw:text-red-700 tw:text-center" role="alert">No existen registros</div>
                                @endif
                            </div>
                        </div>
                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                                    <a href="#" class="tw:float-right" data-toggle="modal" data-target="#modal_add_grupo_per"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar Grupo de Personas"></span></a>
                                    <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Grupos de Personas</h3>
                                </div>
                                @if($personal_generales->count()>0)
                                    <div class="tw:p-5 tw:sm:p-6">
                                        @foreach($personal_generales as $personal)
                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                <div class="tw:w-full tw:lg:w-10/12 tw:px-2">
                                                    <li>{{\App\audParseCase::parseNombre($personal->descripcion)}}</li>
                                                </div>
                                                <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                                    <a href="#" class="delete-personal tw:float-right" data-id="{{$personal->id_personal_general}}" data-toggle="tooltip" title="Eliminar grupo"><span class="fa fa-trash"></span></a>
                                                    <a href="#" class="edit_personal tw:float-left" data-all="{{$personal}}" data-toggle="tooltip" title="Editar grupo"><span class="fa fa-cog"></span></a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="tw:p-5 tw:sm:p-6 tw:border-amber-200 tw:bg-amber-50 tw:text-amber-800 tw:text-center" role="alert">No existen registros</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <x-panel.modal id="modal_add_grupo_adm" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Registro de grupo administrativo</h4>
                </div>
                <form id="form_add_grupo_adm" class="" role="form" method="POST" action="{{url('/auditorias/generales')}}">
                    @csrf
                    <div class="tw-modal-cuerpo">
                        <div class="tw:mb-4">
                            <label for="descripcion">Nombre del grupo</label>
                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="text" name="descripcion">
                        </div>
                        <label for="">Areas para el grupo</label>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            @foreach($areas as $area)
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                    <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700">
                                        <input class="areaG" type="checkbox" data-id="{{$area->id_unidad_admin}}">
                                        {{\App\audParseCase::parseNombre($area->nom_departamento)}}
                                    </label>
                                </div>
                                @if($loop->iteration%3==0)
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            @endif
                            @endforeach
                        </div>
                        <input type="text" id="areas" name="areas" hidden value="">
                        <input type="text" name="catalogo" hidden value="areas">
                    </div>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
                    </div>
                </form>
            
        
    </x-panel.modal>
    <x-panel.modal id="modal_add_grupo_per" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Registro de grupo de personas</h4>
                </div>
                <form id="form_add_grupo_per" class="" role="form" method="POST" action="{{url('/auditorias/generales')}}">
                    @csrf
                    <div class="tw-modal-cuerpo">
                        <div class="tw:mb-4">
                            <label for="descripcion">Nombre del grupo</label>
                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="text" name="descripcion">
                        </div>
                        <hr>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-4/12 tw:lg:ml-[50%] tw:px-2">
                                <input class="search-persona tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="search" placeholder="Buscar">
                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                <strong class="seleccion tw:float-right">0 Seleccionados</strong>
                            </div>
                        </div>
                        <label for="">Auditores para el grupo</label>
                        <br>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            @foreach($auditores as $auditor)
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2" >
                                    <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700" id="{{$auditor->id_personal}}">
                                        <input class="personalG" type="checkbox" data-id="{{$auditor->id_personal}}">
                                        <strong>{{$auditor->categoria}}</strong> ({{\App\audParseCase::parseNombre($auditor->nombre)}})
                                    </label>
                                </div>
                                @if($loop->iteration%3==0)
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            @endif
                            @endforeach
                        </div>
                        <br>
                        <label for="">Personal para el grupo</label>
                        <br>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            @foreach($personalT as $persona)
                                <div class="personas_u tw:w-full tw:lg:w-4/12 tw:px-2" data-name="{{$persona->nombre}}">
                                    <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700" id="{{$persona->id_personal}}">
                                        <input class="personalG" type="checkbox" data-id="{{$persona->id_personal}}">
                                        {{\App\audParseCase::parseAbr($persona->titulo)}} {{\App\audParseCase::parseNombre($persona->nombre)}}
                                    </label>
                                </div>

                            @endforeach
                        </div>
                        <input type="text" id="personal" name="personal" hidden value="">
                        <input type="text" name="catalogo" hidden value="personal">
                    </div>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
                    </div>
                </form>
            
        
    </x-panel.modal>

    <x-panel.modal id="modal_edit_grupo_adm" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Editar grupo administrativo</h4>
                </div>
                <form id="form_edit_grupo_adm" class="" role="form" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="tw-modal-cuerpo">
                        <div class="tw:mb-4">
                            <label for="descripcion">Nombre del grupo</label>
                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="text" name="descripcion" id="descripcionA">
                        </div>
                        <label for="">Areas para el grupo</label>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            @foreach($areas as $area)
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                    <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700" id="areaGE{{$area->id_unidad_admin}}">
                                        <input class="areaGE" type="checkbox" data-id="{{$area->id_unidad_admin}}">
                                        {{\App\audParseCase::parseNombre($area->nom_departamento)}}
                                    </label>
                                </div>
                                @if($loop->iteration%3==0)
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            @endif
                            @endforeach
                        </div>
                        <input type="text" id="areasE" name="areas" hidden value="">
                        <input type="text" name="catalogo" hidden value="areas">
                    </div>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
                    </div>
                </form>
            
        
    </x-panel.modal>
    <x-panel.modal id="modal_edit_grupo_per" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Editar grupo de personas</h4>
                </div>
                <form id="form_edit_grupo_per" class="" role="form" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="tw-modal-cuerpo">
                        <div class="tw:mb-4">
                            <label for="descripcion">Nombre del grupo</label>
                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="text" name="descripcion" id="descripcionP">
                        </div>
                        <hr>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-4/12 tw:lg:ml-[50%] tw:px-2">
                                <input class="search-personaE tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="search" placeholder="Buscar">
                            </div>
                            <div class="tw:w-full tw:lg:w-2/12 tw:px-2">
                                <strong class="seleccionE tw:float-right">0 Seleccionados</strong>
                            </div>
                        </div>
                        <label for="">Auditores para el grupo</label>
                        <br>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            @foreach($auditores as $auditor)
                                <div class="tw:w-full tw:lg:w-4/12 tw:px-2" >
                                    <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700" id="personalGE{{$auditor->id_personal}}">
                                        <input class="personalGE" type="checkbox" data-id="{{$auditor->id_personal}}">
                                        <strong>{{$auditor->categoria}}</strong> ({{\App\audParseCase::parseNombre($auditor->nombre)}})
                                    </label>
                                </div>
                                @if($loop->iteration%3==0)
                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            @endif
                            @endforeach
                        </div>
                        <br>
                        <label for="">Personal para el grupo</label>
                        <br>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            @foreach($personalT as $persona)
                                <div class="personas_uE tw:w-full tw:lg:w-4/12 tw:px-2" data-name="{{$persona->nombre}}">
                                    <label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700" id="personalGE{{$persona->id_personal}}">
                                        <input class="personalGE" type="checkbox" data-id="{{$persona->id_personal}}">
                                        {{\App\audParseCase::parseAbr($persona->titulo)}} {{\App\audParseCase::parseNombre($persona->nombre)}}
                                    </label>
                                </div>

                            @endforeach
                        </div>
                        <input type="text" id="personalE" name="personal" hidden value="">
                        <input type="text" name="catalogo" hidden value="personal">
                    </div>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
                    </div>
                </form>
            
        
    </x-panel.modal>

    <form  method="POST" role="form" id="form_delete_admon">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <input type="text" name="accion" value="area" hidden>
    </form>
    <form  method="POST" role="form" id="form_delete_personal">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <input type="text" name="accion" value="personal" hidden>
    </form>

    <script>
        $(document).ready(function () {
            $('.search-persona').keyup(function () {
                val = $('.search-persona').val();
                if (val != "")
                    $('.personas_u').each(function () {
                        if ($(this).data('name').toLowerCase().indexOf(val.toLowerCase())<0) $(this).fadeOut();
                        else $(this).fadeIn();
                    });
                else $('.personas_u').fadeIn();
            });

            var areas=[];
            $('.areaG').click(function () {
                areas=[];
                $('.areaG:checked').each(function () {
                    areas.push($(this).data('id'))
                });
                $('#areas').attr('value',JSON.stringify(areas));
            });

            var personal=[];
            $('.personalG').click(function () {
                if ($('.search-persona').val('')!=''){
                    $('.search-persona').val('');
                    $('.personas_u').fadeIn();
                }

                id=$(this).data('id');
                if ($(this).prop('checked')==true) $('#'+id).addClass('bg-success text-success')
                else $('#'+id).removeClass('bg-success text-success')

                personal=[];
                $('.personalG:checked').each(function () {
                    personal.push($(this).data('id'))
                });
                $('.seleccion').empty().html(personal.length+' Seleccionados');
                $('#personal').attr('value',JSON.stringify(personal));
            });

            $('[data-toggle="tooltip"]').tooltip();

            $('.delete-admon').click(function () {
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
                            $("#form_delete_admon").attr("action","/auditorias/generales/"+id).submit();
                        }
                        else if (result.dismiss === Swal.DismissReason.cancel) { //Si presionas boton cancelar
                            swal.close()
                        }
                    });
            });

            $('.delete-personal').click(function () {
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
                            $("#form_delete_personal").attr("action","/auditorias/generales/"+id).submit();
                        }
                        else if (result.dismiss === Swal.DismissReason.cancel) { //Si presionas boton cancelar
                            swal.close()
                        }
                    });
            });

            $('.edit_admon').click(function () {
                data=$(this).data('all');
                $('#form_edit_grupo_adm').attr('action','/auditorias/generales/'+data.id_area_general);
                $('#descripcionA').val(data.descripcion);

                $('.areaGE').each(function () {
                    id=$(this).data('id');
                    if ($.inArray(id,data.areas)!==-1) {
                        $(this).prop('checked',true);
                        $('#areaGE'+id).addClass('bg-success text-success')
                    }
                    else{
                        $(this).prop('checked',false);
                        $('#areaGE'+id).removeClass('bg-success text-success')
                    }
                });


                $('#areasE').attr('value',JSON.stringify(data.areas));
                $('#modal_edit_grupo_adm').modal('show');
            });

            $('.edit_personal').click(function () {
                data=$(this).data('all');
                $('#form_edit_grupo_per').attr('action','/auditorias/generales/'+data.id_personal_general);
                $('#descripcionP').val(data.descripcion);

                $('.personalGE').each(function () {
                    id=$(this).data('id');
                    if ($.inArray(id,data.personal)!==-1) {
                        $(this).prop('checked',true);
                        $('#personalGE'+id).addClass('bg-success text-success')
                    }
                    else{
                        $(this).prop('checked',false);
                        $('#personalGE'+id).removeClass('bg-success text-success')
                    }
                });
                $('#personalE').attr('value',JSON.stringify(data.personal));
                $('.seleccionE').empty().html(data.personal.length+' Seleccionados');
                $('#modal_edit_grupo_per').modal('show');
            });

            $('.search-personaE').keyup(function () {
                val = $('.search-personaE').val();
                if (val != "")
                    $('.personas_uE').each(function () {
                        if ($(this).data('name').toLowerCase().indexOf(val.toLowerCase())<0) $(this).fadeOut();
                        else $(this).fadeIn();
                    });
                else $('.personas_uE').fadeIn();
            });

            var areasE=[];
            $('.areaGE').click(function () {
                areasE=[];
                $('.areaGE:checked').each(function () {
                    areasE.push($(this).data('id'))
                });
                $('#areasE').attr('value',JSON.stringify(areasE));
            });

            var personalE=[];
            $('.personalGE').click(function () {
                if ($('.search-personaE').val('')!=''){
                    $('.search-personaE').val('');
                    $('.personas_uE').fadeIn();
                }

                id=$(this).data('id');
                if ($(this).prop('checked')==true) $('#personalGE'+id).addClass('bg-success text-success')
                else $('#personalGE'+id).removeClass('bg-success text-success')

                personalE=[];
                $('.personalGE:checked').each(function () {
                    personalE.push($(this).data('id'))
                });
                $('.seleccionE').empty().html(personalE.length+' Seleccionados');
                $('#personalE').attr('value',JSON.stringify(personalE));
            });
        })
    </script>

@endsection