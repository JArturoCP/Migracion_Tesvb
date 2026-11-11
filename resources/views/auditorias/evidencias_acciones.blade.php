@extends('layouts.app')
@section('title', 'Evidencias Acciones')
@section('content')
    <main class="col-md-12">
        <div class="row">
            <div class="col-md-6 col-md-offset-1">
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

                    <h3 class="panel-title text-center">Evidencias Acciones</h3>

                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Evidencias de las Acciones Correctivas Realizadas</label>
                            <div>

                            </div>
                        </div>
                        <div class="col-md-8">
                            <label>Evidencias de la o el responsable de revisar la eficacia de las acciones correctivas tomadas</label>
                            <div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Evidencias de las correciones realizadas</label>
                            <div>

                            </div>

                        </div>
                        <div class="col-md-12">
                            <label>Actualización de riesgos y oportunidades</label>
                            <div>

                            </div>

                        </div>
                        <div class="col-md-12">
                            <label>Cambios al sistema para organizaciones educativas</label>
                            <div>

                            </div>
                        </div>
                        <div class="col-md-12">
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