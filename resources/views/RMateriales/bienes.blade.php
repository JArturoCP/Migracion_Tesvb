@extends('layouts.panel')
@section('title', 'Bienes')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <main class="main">

        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:w-full">
            <x-panel.encabezado titulo="Registro, Gestion y Consulta de Bienes" :migas="['Recursos materiales' => null]" />
            <div class="tw:w-full tw:mb-4 tw:lg:w-2/12 tw:px-2">
            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target="#myModal" id="open">Dar de Alta Bien</button>
            </div>
                <div class="tw:w-full tw:mb-4 tw:lg:w-10/12 tw:px-2 tw:text-center">
                <!-- Formulario para Busqueda -->

                <form class="tw:flex tw:flex-wrap tw:gap-y-4" method="get" action="{{route('buscarbien')}}">
                    <div class="tw:w-full tw:lg:w-5/12 tw:px-2" >
                        <select name="tipo" id="" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" >
                            <option disabled >Seleccione el tipo</option>
                            <option value="nombre">Nombre del Bien</option>
                            <option value="nick">Nick</option>
                            <option value="num_inventario">Numero de inventario</option>
                            <option value="serie">Número de Serie</option>
                        </select>
                    </div>
                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                        <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="search" name="buscarpor" placeholder="Buscar " aria-label="Search">


                    </div>
                    <button type="submit" class="tw:w-full tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:size-9 tw:text-base"><span class="fa fa-search"></span></button>

                </form>
                <!-- Fin formulario -->
            </div>



            <form class="tw:w-full" name="forbien" method="post" action="{{route('altabien')}}" enctype="multipart/form-data" accept-charset="UTF-8">
                @csrf
                <!-- Modal -->

                <x-panel.modal id="myModal" tamano="md" sin-relleno>
                            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" style="display:none"></div>
                            <div class="tw:px-6 tw:pt-6 tw:pr-14">

                                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Agregar Nuevo Bien</h3>
                            </div>
                            <div class="tw-modal-cuerpo">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                        <label for="Name"  >Nombre del Bien:</label>
                                        <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="nombre" id="nombre" autocomplete="off" required>
                                    </div>
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                        <label for="Name">Categoría:</label>

                                        <select name="id_categoria" id="inputId_categoria" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                            <option value="">Seleccione la Categoría</option>
                                            @foreach($categorias as $cate)
                                                <option value="{{$cate['id']}}">{{$cate['nombre']}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                        <label for="Name">Tipo de Bien:</label>
                                        <select name="id_tipob" id="inputId_tipob" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                            <option value="">Seleccione el tipo de bien</option>
                                            @foreach($bienest as $bient)
                                                <option value="{{$bient['id']}}">{{$bient['tipob']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                        <label for="Name">Provedor:</label>
                                        <select name="id_provedor" id="inputId_provedor" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                            <option value="">Seleccione Provedor</option>
                                            @foreach($provedores as $prove)
                                                <option value="{{$prove['id']}}">{{$prove['nombre']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-4/12 tw:px-2 tw:text-center">
                                        <label for="Name" >Número de Inventario:</label>
                                        <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="num_inventario" id="num_inventario" autocomplete="off">
                                    </div>
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-4/12 tw:px-2 tw:text-center">
                                        <label for="Name" >Nic del Bien:</label>
                                        <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="nick" id="nick" autocomplete="off">
                                    </div>
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-4/12 tw:px-2 tw:text-center">
                                        <label for="Name">No. de Serie:</label>
                                        <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="serie" id="serie" autocomplete="off">
                                    </div>
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-full tw:px-2 tw:text-center">
                                        <label class="tw:text-red-600">Nota: Los campos Numero de Inventario, Nic y Serie no seran actualizables</label>
                                    </div>

                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-full tw:px-2 tw:text-center">
                                        <label for="Name">Características:</label>
                                        <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="caracteristicas" id="caracteristicas" autocomplete="off">
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                                    <div class="tw:w-full tw:mb-4 tw:lg:w-4/12 tw:px-2 tw:text-center">
                                        <label for="Name">Costo con IVA:</label>
                                        <input type="float" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="costo" id="costo">
                                    </div>
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-4/12 tw:px-2 tw:text-center">
                                        <label for="Name" >Color:</label>
                                        <select name="id_color" id="inputId_color" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                            <option value="">Seleccione Color</option>
                                            @foreach($colores as $col)
                                                <option value="{{$col['id']}}">{{$col['color']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-4/12 tw:px-2 tw:text-center">
                                        <label for="Name" >Tipo de adquisición:</label>
                                        <select name="id_tipoadqui" id="inputId_tipoadqui" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                            <option value="">Seleccione tipo de adquisición</option>
                                            @foreach($adquisiciones as $adqui)
                                                <option value="{{$adqui['id']}}">{{$adqui['tipoadqui']}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-4/12 tw:px-2 tw:text-center">
                                        <label for="Name" >Modelo:</label>
                                        <select name="id_modelo" id="inputId_modelo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="">Seleccione Modelo</option>
                                            @foreach($modelos as $bienm)
                                                <option value="{{$bienm['id']}}">{{$bienm['modelo']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-4/12 tw:px-2 tw:text-center">
                                        <label for="Name">Estado de Uso:</label>
                                        <select name="id_estado" id="inputId_estado" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                <option value="">S. estado de uso</option>
                                            @foreach($usos as $biene)
                                                <option value="{{$biene['id']}}">{{$biene['estado']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-4/12 tw:px-2 tw:text-center">
                                        <label for="Name" >Marca:</label>
                                        <select name="id_marca" id="inputId_marca" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                            <option value="">Seleccione la Marca</option>
                                            @foreach($marcas as $bienm)
                                                <option value="{{$bienm['id']}}">{{$bienm['marca']}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-4/12 tw:px-2 tw:text-center">
                                        <label for="Name"  >Fecha de Adquisicion:</label>
                                        <input type="date" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="fechadqui" id="fechadqui" required>
                                    </div>
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-8/12 tw:px-2 tw:text-center">
                                        <label for="Name"  >Capturar Factura:</label>
                                        <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="factura" id="factura" required>
                                    </div>
                                </div>
                                </div>
                                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                                    <button id="btngenera"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" type="submit">Agregar Bien</button>

                                </div>
                            </x-panel.modal>


            </form>


        </div>
        <div class="tw:w-full" >
            <div class="tw:w-full">
                <div class="tw:p-5 tw:sm:p-6">
                    @if($bienes->isEmpty())
                        <div class="tw:text-center tw:bg-amber-50 tw:dark:bg-amber-500/15">No hay Bienes Disponibles</div>
                    @else
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada tw-tabla tw-tabla-bordes tw-tabla-rayas"  >
                            <thead>
                            <tr>

                                <th class="tw:text-center">Nombre:</th>
                                <th class="tw:text-center">Categoría:</th>
                                <th class="tw:text-center">Caracteristicas (Marca,Modelo):</th>
                                <th class="tw:text-center">No.Inventario:</th>
                                <th class="tw:text-center">Nick:</th>
                                <th class="tw:text-center">Serie:</th>
                                <th class="tw:text-center">Costo:</th>
                                <th class="tw:text-center">Fecha Adquisicion:</th>
                                <th class="tw:text-center">Tipo:</th>
                                <th class="tw:text-center">Estado:</th>
                                <th class="tw:text-center">Opciones:</th>
                                <th class="tw:text-center">Número de Factura:</th>



                            </tr>
                            </thead>
                            @foreach($bienes as $bien)<!-- se crea un objeto para acceder a los datos-->
                            <tbody>
                            <tr>
                                <td>{{$bien->nombre}}</td>
                                <td>{{$bien->categorias->nombre}}</td>
                                <td>{{$bien->caracteristicas}}<br>
                                    {{$bien->marcas->marca}}<br>
                                    {{$bien->modelos->modelo}}
                                    {{$bien->colores->color}}<br>
                                </td>
                                <td>{{$bien->num_inventario}}</td>
                                <td>{{$bien->nick}}</td>
                                <td>{{$bien->serie}}</td>
                                <td>{{$bien->costo}}</td>
                                <td>{{$bien->fechadqui}}</td>
                                <td>{{$bien->bienest->tipob}}</td>
                                <td>
                                    @if($bien-> condicion == 1)
                                        <span class="tw:text-green-600">Activo</span>
                                    @else
                                        <span class="tw:text-red-600">Desactivado</span>
                                    @endif
                                </td>
                                <td>
                                    @if($bien-> condicion == 1 && $bien->categorias->condicion = 1)

                                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="modal" data-target="#editModal{{$bien->id}}"><span class="fa fa-pencil"></span></button><br><br>
                                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base"  data-toggle="modal" data-target='#desModal{{$bien->id}}'><span class="fa fa-times"></span></button>
                                         <!--Modal Editar -->
                                        <form method="post" action="{{route('editarbien',$bien->id)}}">
                                            @csrf @method('PUT')
                                            <!-- Modal -->
                                            <x-panel.modal id="editModal{{$bien->id}}" tamano="md" sin-relleno>
                                                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                                            <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Actualizar Bien</h3>
                                                        </div>
                                                        <div class="tw-modal-cuerpo">
                                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                                                    <label for="Name">Categoría:</label>
                                                                    <select name="id_categoria" id="selectId_categoria" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                                        <option value="{{$bien->categorias->id}}">{{$bien->categorias->nombre}}</option>
                                                                        @foreach($categorias as $cate)
                                                                            <option value="{{$cate->id}}" >{{$cate->nombre}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                                                    <label for="Name"  >Nombre del Bien:</label>
                                                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="nombre" id="nombre"
                                                                           autocomplete="off" required value="{{$bien->nombre}}">
                                                                </div>
                                                            </div>
                                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                                                    <label for="Name">Tipo de Bien:</label>
                                                                    <select name="id_tipob" id="inputId_tipob" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                                        <option value="{{$bien->bienest->id}}">{{$bien->bienest->tipob}}</option>
                                                                        @foreach($bienest as $bient)
                                                                            <option value="{{$bient->id}}">{{$bient->tipob}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                                                    <label for="Name">Provedor:</label>
                                                                    <select name="id_provedor" id="inputId_provedor" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                                        <option value="{{$bien->provedores->id}}">{{$bien->provedores->nombre}}</option>
                                                                        @foreach($provedores as $prove)
                                                                            <option value="{{$prove->id}}">{{$prove->nombre}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-4/12 tw:px-2 tw:text-center">
                                                                    <label for="Name">Número de Inventario:</label>
                                                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="num_inventario" id="num_inventario" required
                                                                           value="{{$bien->num_inventario}}" disabled>
                                                                </div>
                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-4/12 tw:px-2 tw:text-center">
                                                                    <label for="Name">Nick del Bien:</label>
                                                                    <input type="number" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="nick" id="nick"
                                                                           autocomplete="off" required value="{{$bien->nick}}" disabled>
                                                                </div>
                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-4/12 tw:px-2 tw:text-center">
                                                                    <label for="Name">No. de Serie:</label>
                                                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="serie" id="serie"
                                                                           autocomplete="off" required value="{{$bien->serie}}"disabled>
                                                                </div>
                                                            </div>
                                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-full tw:px-2 tw:text-center">
                                                                    <label for="Name">Características:</label>
                                                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="caracteristicas" id="caracteristicas"
                                                                           autocomplete="off" value="{{$bien->caracteristicas}}">
                                                                </div>
                                                            </div>
                                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-4/12 tw:px-2 tw:text-center">
                                                                    <label for="Name">Costo con IVA:</label>
                                                                    <input type="float" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  name="costo" id="costo" value="{{$bien->costo}}"
                                                                           autocomplete="off" required>
                                                                </div>
                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-4/12 tw:px-2 tw:text-center">
                                                                    <label for="Name" >Color:</label>
                                                                    <select name="id_color" id="inputId_color" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                                        <option value="{{$bien->colores->id}}">{{$bien->colores->color}}</option>
                                                                        @foreach($colores as $col)
                                                                            <option value="{{$col->id}}">{{$col->color}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-4/12 tw:px-2 tw:text-center">
                                                                    <label for="Name" >Tipo de adquisición:</label>
                                                                    <select disabled name="id_tipoadqui" id="inputId_tipoadqui" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>

                                                                    </select>
                                                                </div>

                                                            </div>

                                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-4/12 tw:px-2 tw:text-center">
                                                                    <label for="Name" >Modelo:</label>
                                                                    <select name="id_modelo" id="inputId_modelo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                                        <option value="{{$bien->modelos->id}}">{{$bien->modelos->modelo}}</option>
                                                                        @foreach($modelos as $bienm)
                                                                            <option value="{{$bienm->id}}">{{$bienm->modelo}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-4/12 tw:px-2 tw:text-center">
                                                                    <label for="Name">Estado de Uso:</label>
                                                                    <select name="id_estado" id="inputId_estado" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                                        <option value="{{$bien->usos->id}}">{{$bien->usos->estado}}</option>
                                                                        @foreach($usos as $biene)
                                                                            <option value="{{$biene->id}}">{{$biene->estado}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-4/12 tw:px-2 tw:text-center">
                                                                    <label for="Name" >Marca:</label>
                                                                    <select name="id_marca" id="id_marca" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                                                        <option value="{{$bien->marcas->id}}">{{$bien->marcas->marca}}</option>
                                                                        <!-- se actualizo esta parte en cada uno de los select del formulario editar-->
                                                                        @foreach($marcas as $bienm)
                                                                            <option value="{{$bienm->id}}">{{$bienm->marca}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-4/12 tw:px-2 tw:text-center">
                                                                    <label for="Name"  >Fecha de Adquisicion:</label>
                                                                    <input type="date" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="fechadqui" id="fechadqui"
                                                                           value="{{$bien->fechadqui}}" required>
                                                                </div>
                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-8/12 tw:px-2 tw:text-center">
                                                                    <label for="Name"  >Número de Factura:</label>
                                                                    <input type="input" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="factura" id="factura"
                                                                           autocomplete="off" value="{{$bien->factura}}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" type="submit">Actualizar Bien</button>

                                                        </div>
                                                    </x-panel.modal>

                                        </form>
                                        <!--Modal Desactivar -->
                                        <form method="POST" action="{{route('desactivarbien',$bien->id)}}" >
                                            @csrf @method('PUT')

                                            <x-panel.modal id="desModal{{$bien->id}}" tamano="md" sin-relleno>
                                                        <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" style="display:none"></div>
                                                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" >Desactivar Bien</h4>
                                                        </div>
                                                        <div class="tw-modal-cuerpo">
                                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-600 tw:dark:text-red-400">¿Desea Desactivar el Bien?</h4>
                                                        </div>
                                                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" type="submit">Desactivar Bien</button>
                                                        </div>
                                                    </x-panel.modal>
                                        </form>
                                        <!--Modal Desactivar -->
                                    @else
                                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-toggle="modal" data-target='#actModal{{$bien->id}}'><span class="fa fa-check"></span></button>

                                        <!--Modal Activar -->
                                        <form method="POST" action="{{route('activarbien',$bien->id)}}" >
                                            @csrf @method('PUT')

                                            <x-panel.modal id="actModal{{$bien->id}}" tamano="md" sin-relleno>
                                                        <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" style="display:none"></div>
                                                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" >Activar Bien</h4>
                                                        </div>
                                                        <div class="tw-modal-cuerpo">
                                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">¿Desea Activar el Bien?</h4>
                                                        </div>
                                                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" type="submit">Activar Bien</button>


                                                        </div>
                                                    </x-panel.modal>
                                        </form>
                                        <!--Modal Activar -->

                                    @endif
                                </td>
                                <td>{{$bien->factura}}</td>


                            </tr>
                            @endforeach
                        </table>
</div>
                        {{$bienes->links()}}<!--para la paginacion-->
                    @endif
                </div>
            </div>
        </div>

    </main>
    <script>
        let btnsubmit = document.getElementById('btngenera');
        btnsubmit.onclick = function () {

        }
        function genera(user_input) {
            var qrfinal = document.querySelector('.qrcode-final');
            var qrcode = new QRCode(qrfinal,{

            });

        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>



</div>
@endsection