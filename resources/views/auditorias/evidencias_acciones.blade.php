@extends('layouts.panel')
@section('title', 'Evidencias Acciones')
@include('partials.panel.recursos_app')
@section('content')
    <main class="tw-pantalla tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-6/12 tw:lg:ml-[8.3333%] tw:px-2">
                @if (session()->has('flash_notification.message'))
                    <x-panel.alerta class="tw:mb-4" :tipo="['success' => 'exito', 'danger' => 'error', 'warning' => 'advertencia'][session('flash_notification.level')] ?? 'info'">{!! session('flash_notification.message') !!}</x-panel.alerta>
                @endif
            </div>
        </div>
        <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">

                    <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Evidencias Acciones</h3>

                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:lg:w-full tw:px-2">
                            <label>Evidencias de las Acciones Correctivas Realizadas</label>
                            <div>

                            </div>
                        </div>
                        <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                            <label>Evidencias de la o el responsable de revisar la eficacia de las acciones correctivas tomadas</label>
                            <div>

                            </div>
                        </div>
                        <div class="tw:w-full tw:lg:w-full tw:px-2">
                            <label>Evidencias de las correciones realizadas</label>
                            <div>

                            </div>

                        </div>
                        <div class="tw:w-full tw:lg:w-full tw:px-2">
                            <label>Actualización de riesgos y oportunidades</label>
                            <div>

                            </div>

                        </div>
                        <div class="tw:w-full tw:lg:w-full tw:px-2">
                            <label>Cambios al sistema para organizaciones educativas</label>
                            <div>

                            </div>
                        </div>
                        <div class="tw:w-full tw:lg:w-full tw:px-2">
                            <label>Definó la acción correctiva o corrección</label>
                            <div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </main>


@endsection