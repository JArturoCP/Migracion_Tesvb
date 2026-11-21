<?php
/**
 * Created by PhpStorm.
 * User: Juan Carlos
 * Date: 06/07/2019
 * Time: 03:05 PM
 */
?>
@extends('layouts.panel')
@section('title', 'Informe del Estado')
@include('partials.panel.recursos_app')
@section('content')

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
                    @if($esLider)
                        <a href="#!" class="tw:float-right" data-toggle="modal" data-target="#modal_crea_aud"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar nuevo informe"></span></a>
                    @endif
                    <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Informe del Estado de las No Conformidades y Acciones Correctivas</h3>
                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-bordes">
                        <thead>
                        <tr>
                            <th class="tw:lg:w-4/12">Objetivo</th>
                            <th class="tw:lg:w-4/12">Criterio</th>
                            <th class="tw:lg:w-4/12">periodo</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($auditorias as $auditoria)
                            <tr class="bg-{{$auditoria->active==1?'warning':($auditoria->active==2?'danger':($auditoria->active==3?'success':''))}}">

                                <td>
                                    {{$auditoria->objetivo}}
                                </td>
                                <td>
                                    {{$auditoria->criterio}}
                                </td>
                                <td>
                                    <a href="{{url('auditorias/informe_estado')}}/{{$auditoria->id_auditoria}}">{{\Carbon\Carbon::parse($auditoria->fecha_i)->locale('es')->translatedFormat('F')}} - {{\Carbon\Carbon::parse($auditoria->fecha_f)->locale('es')->translatedFormat('F Y')}}</a>

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
</div>
                </div>
            </div>
        </div>
    </main>
@endsection
