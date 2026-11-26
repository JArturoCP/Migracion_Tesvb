@extends('layouts.panel')
@section('title', 'Resguardos')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <main class="main">
        <!--<link href="/css/select2.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        -->

        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:w-full">
            <x-panel.encabezado titulo="Registro, Gestión y Consulta de Resguardos" :migas="['Recursos materiales' => null]" />
            <div class="tw:w-full tw:mb-4 tw:lg:w-2/12 tw:px-2">
                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target="#myModal" id="open">Asignar Resguardo</button>
            </div>
            <div class="tw:w-full tw:mb-4 tw:lg:w-10/12 tw:px-2 tw:text-center">
                <!-- Formulario para Busqueda -->

                <form class="tw:flex tw:flex-wrap tw:gap-y-4" method="get" action="{{route('buscarres')}}">
                    <div class="tw:w-full tw:lg:w-5/12 tw:px-2" >
                        <select name="tipo" id="" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" >
                            <option disabled >Seleccione el tipo</option>
                            <option value="fecha">Año de Resguardo</option>
                            <option value="id_sector">Número de Resguardatario</option>
                        </select>
                    </div>
                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                        <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="search" name="buscarpor" placeholder="Buscar " aria-label="Search" >


                    </div>
                    <button type="submit" class="tw:w-full tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:size-9 tw:text-base"><span class="fa fa-search"></span></button>

                </form>
                <!-- Fin formulario -->
            </div>
            <form class="tw:w-full" name="forbien" method="post" action="{{route('agregares')}}">
                @csrf
                <!-- Modal -->

                <x-panel.modal id="myModal" tamano="md" sin-relleno>
                            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" style="display:none"></div>
                            <div class="tw:px-6 tw:pt-6 tw:pr-14">

                                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Resguardar Nuevo Bien</h3>
                            </div>
                            <div class="tw-modal-cuerpo">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                        <label for="res_list">Resguardatario:</label>
                                        <!-- <select name="res_list[]" id="res_list" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:lg:w-6/12 tw:px-2" multiple required></select> -->
                                        <select name="id_sector" id="inputId_sector" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                            <option disabled selected hidden>Selecciona una opción</option>
                                            @foreach($sectores as $sec)
                                                <option value="{{$sec['id']}}">{{$sec['nombre']}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                        <div class="tw:mb-4">
                                        <label for="Name">Seleccione el Bien a Resguardar:</label>
                                        <select name="id_bienres" id="inputId_bienres" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                            <option disabled selected hidden>Selecciona una opción</option>
                                            @foreach($bienes as $bien)
                                                <option value="{{$bien['id']}}">{{$bien['nombre_bien']}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                        <label for="Name" >Fecha de Resguardo:</label>
                                        <input type="date" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="fecha" id="fecha" required>
                                    </div>
                                </div>

                            </div>
                            <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                                <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" type="submit">Resguardar Bien</button>

                            </div>
                        </x-panel.modal>

            </form>
            <!--Modal para Agregar-->



        </div>
        <div class="tw:w-full" >
            <div class="tw:w-full">
                <div class="tw:p-5 tw:sm:p-6">
                    @if($resguardos->isEmpty())
                        <div class="tw:text-center tw:bg-amber-50 tw:dark:bg-amber-500/15">No hay Resguardos Disponibles</div>
                    @else
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada tw-tabla tw-tabla-bordes tw-tabla-rayas tw-tabla-compacta"  >
                            <thead>
                            <tr>

                                <th class="tw:text-center">No.:</th>
                                <th class="tw:text-center">Resguardatario:</th>
                                <th class="tw:text-center">Categoría:</th>
                                <th class="tw:text-center">Nombre y Serie del Bien:</th>
                                <th class="tw:text-center">Fecha de Resguardo:
                                <th class="tw:text-center">Opciones:</th>



                            </tr>
                            </thead>

                                        <tbody>
                                        @foreach($resguardos as $res)<!-- se crea un objeto para acceder a los datos-->
                                        @foreach($res->sectores as $sect)
                                            @foreach($res->bienes as $bien)
                                        <tr>
                                            <td>{{$sect->id}}</td>
                                            <td>{{$sect->nombre}}</td>
                                            <td>{{$bien->categorias->nombre}}</td>
                                            <td>{{$bien->nombre}}<br>
                                                Serial: {{$bien->serie}}</td>
                                            <td>{{$res->fecha}}</td>
                                            <td>
                                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target="#editModal{{$res->id}}">Cambiar</button>
                                                <!--Modal Editar -->
                                                <form method="POST" action="{{route('editarres',$res->id)}}" >
                                                    @csrf @method('PUT')

                                                    <x-panel.modal id="editModal{{$res->id}}" tamano="md" sin-relleno>
                                                                <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" style="display:none"></div>
                                                                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                                                    <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Actualizar Resguardo Actual</h3>
                                                                </div>
                                                                <div class="tw-modal-cuerpo">
                                                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                                        <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                                                            <label for="Name">Cambio de Resguardatario:</label>
                                                                            <select name="id_sector" id="inputId_sector" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                                                <option value="{{$sect->id}}">{{$sect->nombre}}</option> <!-- se actualizo esta parte-->
                                                                                @foreach($sectores as $sector)
                                                                                    <option value="{{$sector->id}}">{{$sector->nombre}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                                                            <label for="Name" >Fecha de Resguardo:</label>
                                                                            <input type="date" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="fecha" id="fecha"
                                                                                   value="{{$res->fecha}}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                                        <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                                                            <label for="Name">Cambio de Bien:</label>
                                                                            <select name="id_bienres" id="inputId_bienres" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                                                <option value="{{$bien->id}}">{{$bien->nombre}}</option> <!-- se actualizo esta parte-->
                                                                                @foreach($bienes as $bien)
                                                                                    <option value="{{$bien->id}}">{{$bien->nombre}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                                                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                                                                    <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" type="submit">Actualizar Resguardo</button>

                                                                </div>
                                                            </x-panel.modal>
                                                </form>
                                                <!--Modal Editar -->
                                            </td>

                                            <!--lo borrado-->
                                        </tr>
                                            @endforeach
                                        @endforeach

                                        @endforeach
                                        </tbody>


                        </table>
</div>
                        {{$resguardos->links()}}<!--para la paginacion-->
                    @endif
                </div>
            </div>
        </div>


    <!--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $('#res_list').select2({
            dropdownParent:$("#myModal"),
            placeholder: "Busque un Resguardatario...",
            minimumInputLength: 2,
            ajax: {
                url: '/Resguardos/find',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    </script> -->
    </main>


</div>
@endsection