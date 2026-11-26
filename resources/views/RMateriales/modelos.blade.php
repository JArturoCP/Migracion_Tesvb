@extends('layouts.panel')
@section('title', 'Modelos')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <main class="main">
        <div class="tw:w-full">
                <x-panel.encabezado titulo="Registrar Y Gestionar Modelos" :migas="['Recursos materiales' => null]" />
            <div class="tw:w-full tw:mb-4 tw:lg:w-4/12 tw:px-2">
                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target="#myModal" id="open">Agregar Modelo</button>
            </div>
            <form class="tw:flex tw:flex-wrap tw:gap-y-4" method="get" action="{{route('buscarmod')}}">
                <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2">
                    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="search" name="buscarpor" placeholder="Buscar por Palabra " aria-label="Search"
                           autocomplete="off">


                </div>
                <button type="submit" class="tw:w-full tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:size-9 tw:text-base"><span class="fa fa-search"></span></button>
            </form>

            <form method="post" action="{{route('guardarmodelo')}}" id="form">
                @csrf
                <!-- Modal -->
                <x-panel.modal id="myModal" tamano="md" sin-relleno>
                            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" style="display:none"></div>
                            <div class="tw:px-6 tw:pt-6 tw:pr-14">

                                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Agregar Nuevo Modelo</h3>
                            </div>
                            <div class="tw-modal-cuerpo">
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2 tw:text-center">
                                        <label for="Name">Nombre del Modelo:</label>
                                        <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="modelo" id="modelo" required
                                        autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                                <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" type="submit">Guardar Modelo</button>
                            </div>
                        </x-panel.modal>
            </form>
        </div>

        <div class="tw:w-full" >
            <div class="tw:w-full">
                <div class="tw:p-5 tw:sm:p-6">
                    @if($modelos->isEmpty())
                        <div class="tw:text-center tw:bg-amber-50 tw:dark:bg-amber-500/15">No hay Modelos</div>
                    @else
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada tw-tabla tw-tabla-bordes tw-tabla-rayas tw-tabla-compacta"  >
                            <thead>
                            <tr>
                                <th class="tw:text-center">Nombre del Modelo</th>
                                <th class="tw:text-center">Opciones</th >
                                <th class="tw:text-center">Estado</th >

                            </tr>
                            </thead>
                            @foreach($modelos as $modelo)<!-- se crea un objeto para acceder a los datos-->
                            <tbody>
                            <tr>
                                <td>{{$modelo->modelo}}</td>
                                <td>
                                    @if($modelo-> condicion == 1)
                                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target="#editModal{{$modelo->id}}">Editar</button> <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target='#desModal{{$modelo->id}}'>Desactivar</button>
                                        <!--Modal Editar -->
                                        <form method="POST" action="{{route('editarmod',$modelo->id)}}" >
                                            @csrf @method('PUT')

                                            <x-panel.modal id="editModal{{$modelo->id}}" tamano="md" sin-relleno>
                                                        <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" style="display:none"></div>
                                                        <div class="tw:px-6 tw:pt-6 tw:pr-14">

                                                            <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" >Actualizar Modelo</h3>
                                                        </div>
                                                        <div class="tw-modal-cuerpo">
                                                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                                <div class="tw:w-full tw:mb-4 tw:lg:w-6/12 tw:px-2">
                                                                    <label for="Name">Nombre del Modelo:</label>
                                                                    <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="modelo" value="{{$modelo->modelo}}" id="modelo">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" type="submit">Actualizar Modelo</button>

                                                        </div>
                                                    </x-panel.modal>
                                        </form>
                                        <!--Modal Editar -->
                                        <!--Modal Desactivar -->
                                        <form method="POST" action="{{route('desactivarmod',$modelo->id)}}" >
                                            @csrf @method('PUT')

                                            <x-panel.modal id="desModal{{$modelo->id}}" tamano="md" sin-relleno>
                                                        <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" style="display:none"></div>
                                                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" >Desactivar Modelo</h4>
                                                        </div>
                                                        <div class="tw-modal-cuerpo">
                                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-red-600 tw:dark:text-red-400">¿Desea Desactivar el Modelo?</h4>
                                                        </div>
                                                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" type="submit">Desactivar Modelo</button>
                                                        </div>
                                                    </x-panel.modal>
                                        </form>
                                        <!--Modal Desactivar -->
                                    @else
                                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" data-toggle="modal" data-target='#actModal{{$modelo->id}}'>Activar</button>

                                        <!--Modal Activar -->
                                        <form method="POST" action="{{route('activarmod',$modelo->id)}}" >
                                            @csrf @method('PUT')

                                            <x-panel.modal id="actModal{{$modelo->id}}" tamano="md" sin-relleno>
                                                        <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" style="display:none"></div>
                                                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                                                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" >Activar Modelo</h4>
                                                        </div>
                                                        <div class="tw-modal-cuerpo">
                                                            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">¿Desea Activar el Modelo?</h4>
                                                        </div>
                                                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                                                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
                                                            <button  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" type="submit">Activar Modelo</button>


                                                        </div>
                                                    </x-panel.modal>
                                        </form>
                                        <!--Modal Activar -->

                                    @endif
                                </td>
                                <td>
                                    @if($modelo-> condicion == 1)
                                        <span class="tw:text-green-600 tw:text-green-700 tw:dark:text-green-400">Activo</span>
                                    @else
                                        <span class="tw:text-red-600">Inactivo</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
</div>
                        {{$modelos->links()}}<!--para la paginacion-->
                    @endif
                </div>
            </div>
        </div>

    </main>
</div>
@endsection