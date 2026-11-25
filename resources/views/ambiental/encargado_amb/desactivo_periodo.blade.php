@extends('layouts.panel')
@section('title', 'Envío de documentación')

@section('content')
    <x-panel.encabezado titulo="ENVÍO DE DOCUMENTACIÓN" :migas="['Procedimiento Ambiental' => '#procedimientos']" />

    <x-panel.tarjeta id="procedimientos" titulo="Periodo ambiental">
        <x-panel.alerta tipo="advertencia" titulo="Sin periodo activo">
            No se encuentra activo ningún periodo.
        </x-panel.alerta>
    </x-panel.tarjeta>
@endsection
