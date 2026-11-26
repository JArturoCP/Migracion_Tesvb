@extends('layouts.panel')
@section('title', 'S.Escolares')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Bienvenido" :migas="['Servicios escolares' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                
                <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                    <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6">
                                <h5 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">Calificaciones</h5>
                                <p class="tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">
                                    Administrar los periodos para la carga de calificaciones.
                                    <br>
                                    Realizar cambios en calificaciones.
                                </p>
                                <a href="/servicios_escolares/evaluaciones" class="btn-menu-admin tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Abrir</a>
                            </div>
                        </div>
                    </div>
                    <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6">
                                <h5 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">Datos Estadísticos</h5>
                                <p class="tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">Vizualizar datos estadisticos del TESVB</p>
                                <a href="/servicios_escolares/estadisticas" class="btn-menu-admin tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Abrir</a>
                            </div>
                        </div>
                    </div>
                    <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6">
                                <h5 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">Modificaciones en periodos</h5>
                                <p class="tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">
                                    Viualiza movimientos en periodos de evaluación.
                                </p>
                                <a href="/servicios_escolares/bitacora_periodos" class="btn-menu-admin tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Abrir</a>
                            </div>
                        </div>
                    </div>
                    <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6">
                                <h5 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">Modificaciones en calificaciones</h5>
                                <p class="tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">
                                    Viualiza movimientos en las calificaciones.
                                </p>
                                <a href="/servicios_escolares/bitacora_evaluaciones" class="btn-menu-admin tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Abrir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection