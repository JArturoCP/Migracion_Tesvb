@extends('layouts.panel')
@section('title', 'Sectores Auxiliares')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <main class="main">

        <x-panel.encabezado titulo="Registro, Gestión y Consulta de Resguardatarios" :migas="['Recursos materiales' => null]" />
        <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:w-full">
            <button type="button" class="tw:mb-4 tw:self-start tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target="#myModal" id="open">Registrar Resguardatario</button>
                <div class="tw:w-full tw:mb-4 tw:lg:w-10/12 tw:px-2 tw:text-center">
                    <!-- Formulario para Busqueda -->

                    <form class="tw:flex tw:flex-wrap tw:gap-y-4" method="get" action="{{route('buscar')}}">
                        <div class="tw:w-full tw:lg:w-5/12 tw:px-2" >
                        <select name="tipo" id="" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" >
                            <option disabled >Seleccione el tipo</option>
                            <option value="nombre">nombre</option>
                            <option value="puesto">puesto</option>
                            <option value="csp">csp</option>
                            <option value="id_area">Número de Departamento</option>
                        </select>
                        </div>
                        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                        <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="search" name="buscarpor" placeholder="Buscar " aria-label="Search" >
                        </div>
                        <button type="submit" class="tw:w-full tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:size-9 tw:text-base"><span class="fa fa-search"></span></button>
                    </form>
                    <!-- Fin formulario -->
                </div>
            <form class="tw:w-full" name="formsec" method="post" action="{{route('asignarsec')}}">
                @csrf
                <!-- Modal -->
                <x-panel.modal id="myModal" tamano="md" sin-relleno>
                            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" style="display:none"></div>
                            <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Registrar nuevo Resguardatario</h3>
                            </div>
                            <div class="tw-modal-cuerpo">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                        <label for="name">Departamento:</label>
                                        <select name="id_area" id="inputId_area" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required >
                                            <option value="">Seleccione el Departamento</option>
                                            @foreach($departamentos as $depa)
                                            <option value="{{$depa['id_unidad_admin']}}">{{$depa['nom_departamento']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                        <label for="name">Nombre Completo:</label>
                                        <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:uppercase" name="nombre" id="nombre" required
                                        autocomplete="off">
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                        <label for="name">Ingrese CSP:</label>
                                        <input type="number" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="csp" id="csp" required
                                        maxlength="10" autocomplete="off" placeholder="Clave de Servidor Público">
                                    </div>
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                        <label for="name">Puesto Nominal:</label>
                                        <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="puesto" id="puesto" required>
                                    </div>
                                </div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-full tw:px-2 tw:text-center">
                                        <label  for="name" >Fecha de Registro</label>
                                        <input  type="date"  min="2022-11-01" id="fechain" name="fechain" required>
                                    </div>
                                </div>

                            </div>
                            <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                                <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" type="submit">Agregar Sector Público</button>

                            </div>
                        </x-panel.modal>
            </form>
            <!--Modal para agregar-->
        </div>
        <div class="tw:w-full" >
            <div class="tw:w-full">

                <div class="tw:p-5 tw:sm:p-6">
                    @if($sectores->isEmpty())
                        <div class="tw:text-center tw:bg-amber-50 tw:dark:bg-amber-500/15">No hay Resguardatarios</div>
                    @else
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada tw-tabla tw-tabla-bordes tw-tabla-rayas tw-tabla-compacta" >
                            <thead>
                            <tr>
                                <th class="tw:text-center">Departamento</th>
                                <th class="tw:text-center">Nombre</th>
                                <th class="tw:text-center">CSP</th>
                                <th class="tw:text-center">Puesto</th>
                                <th class="tw:text-center">Opciones</th>
                                <th class="tw:text-center">Registro</th>
                                <th class="tw:text-center">Estado</th>
                            </tr>
                            </thead>
                            @foreach($sectores as $sector)<!-- se crea un objeto para acceder a los datos-->
                            <tbody>
                            @if($sector-> condicion == 1)
                            <tr>

                                <td>{{$sector->departamentos->nom_departamento}}</td>
                                <td>{{$sector->nombre}}</td>
                                <td>{{$sector->csp}}</td>
                                <td>{{$sector->puesto}}</td>
                                <td>
                                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target="#editModal{{$sector->id}}">Editar</button>
                                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target='#desModal{{$sector->id}}'>Baja</button>

                                    <!--Modal Editar -->
                                        <form method="POST" action="{{route('editarsec',$sector->id)}}" >
                                            @csrf @method('PUT')

                                            <x-panel.modal id="editModal{{$sector->id}}" tamano="md" sin-relleno>
                                                        <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" style="display:none"></div>
                                                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                                            <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" >Editar Sector Auxiliar</h3>
                                                        </div>
                                                        <div class="tw-modal-cuerpo">
                                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                                                    <label for="name">Departamento:</label>
                                                                    <select name="id_area" id="inputId_area" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required >
                                                                        <option value=" {{$sector->departamentos->id_unidad_admin}}">{{$sector->departamentos->nom_departamento}}</option>
                                                                        @foreach($departamentos as $sec)
                                                                            <option value="{{$sec->id_unidad_admin}}">{{$sec->nom_departamento}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                                                    <label for="name">Nombre Completo:</label>
                                                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:uppercase" name="nombre" id="nombre" required value="{{$sector->nombre}}"
                                                                           autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                                                    <label for="name">Editar CSP:</label>
                                                                    <input type="number" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="csp" id="csp" required value="{{$sector->csp}}"
                                                                           maxlength="10" autocomplete="off">
                                                                </div>
                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                                                    <label for="name">Puesto Nominal:</label>
                                                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="puesto" id="puesto" value="{{$sector->puesto}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-full tw:px-2 tw:text-center">
                                                                    <label  for="name" >Editar Fecha de Registro</label>
                                                                    <input  type="date"  min="2022-11-01" id="fechain" name="fechain" value="{{$sector->fechain}}" required>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" type="submit">Actualizar Resguardatario</button>

                                                        </div>
                                                    </x-panel.modal>
                                        </form>
                                        <!--Modal Editar -->
                                    <!--Modal Desactivar -->
                                    <form method="POST" action="{{route('desactivarsec',$sector->id)}}" >
                                        @csrf @method('PUT')

                                        <x-panel.modal id="desModal{{$sector->id}}" tamano="md" sin-relleno>
                                                    <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" style="display:none"></div>
                                                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" >Dar de Baja Resguardatario</h4>
                                                    </div>
                                                    <div class="tw-modal-cuerpo">
                                                        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-600 tw:dark:text-red-400">¿Desea Realmente dar de Baja?</h4>
                                                        <h6 class="tw:mb-2 tw:text-sm tw:font-semibold tw:text-gray-700 tw:dark:text-gray-300 tw:text-gray-800 tw:dark:text-white/90">La acción no se podrá revertir</h6>

                                                    </div>
                                                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                                                        <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" type="submit">Dar de Baja</button>
                                                    </div>
                                                </x-panel.modal>
                                    </form>
                                    <!--Modal Desactivar -->
                                </td>

                                <td>{{$sector->fechain}}</td>
                                <td>
                                    @if($sector-> condicion == 1)
                                        <span class="tw:text-green-600">Activo</span>
                                    @else
                                        <span class="tw:text-red-600">Desactivado</span>
                                    @endif
                                </td>
                                @else
                                    <td>{{$sector->departamentos->nom_departamento}}</td>
                                    <td>{{$sector->nombre}}</td>
                                    <td>{{$sector->csp}}</td>
                                    <td>{{$sector->puesto}}</td>
                                    <td>Desactivado</td>
                                    <td>{{$sector->fechain}}</td>
                                    <td>
                                        @if($sector-> condicion == 1)
                                            <span class="tw:text-green-600">Activo</span>
                                        @else
                                            <span class="tw:text-red-600">Desactivado</span>
                                        @endif
                                    </td>

                                @endif
                            </tr>
                            @endforeach
                        </table>
</div>
                            {{$sectores->render()}}<!--para la paginacion-->
                    @endif
                </div>
            </div>
        </div>


    </main>



</div>
@endsection