<?php
/**
 * Created by PhpStorm.
 * User: Juan Carlos
 * Date: 06/07/2019
 * Time: 03:05 PM
 */
use Jenssegers\Date\Date;
?>
@extends('layouts.app')
@section('title', 'Seguimiento de Auditorias')
@section('content')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <main class="col-md-12">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @if (session()->has('flash_notification.message'))
                    <div class="alert alert-{{ session('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {!! session('flash_notification.message') !!}
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    @if($esLider)
                        <a href="#!" class="pull-right" data-toggle="modal" data-target="#modal_crea_aud"><span class="glyphicon glyphicon-plus" data-toggle="tooltip" title="Agregar nuevo programa"></span></a>
                    @endif
                    <h3 class="panel-title text-center">Seguimiento de auditorías</h3>
                </div>


                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="col-md-4">Objetivo</th>
                            <th class="col-md-4">Criterio</th>
                            <th class="col-md-2">Periodo</th>
                            <th class="col-md-2">Numero de auditoría</th>

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
                                    <a href="{{url('auditorias/responsables/')}}/{{$auditoria->id_auditoria}}">{{Date::parse($auditoria->fecha_i)->format('F')}} - {{Date::parse($auditoria->fecha_f)->format('F Y')}}</a></td>
                                <td>{{ $auditoria->no_auditoria }}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    {{--    <div>--}}
    {{--        <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar nueva auditoria" data-target="#modal_crea_aud" type="button" class="btn btn-success btn-lg flotante">--}}
    {{--            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>--}}
    {{--        </button>--}}
    {{--    </div>--}}

@endsection
