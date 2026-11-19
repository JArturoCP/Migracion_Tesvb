@extends('layouts.panel')
@section('title', 'Inicio')
@include('evaluacion_docente.partials.recursos_panel')
@section('content')
    <x-panel.encabezado titulo="VER CARGA ACADEMICA" :migas="['Evaluación docente' => url('/evaluacion_alumno')]" />

    <div class="tw:mx-auto tw:max-w-2xl">
        @if($color==1)
            <x-panel.alerta tipo="error">{{$mensage_carga}}</x-panel.alerta>
        @else
            <x-panel.alerta tipo="exito">{{$mensage_carga}}</x-panel.alerta>
        @endif
    </div>
<?php
	$direccion=Session::get('ip');
?>
{{--
<script>

		@if(isset($mensage_carga))
		var direccion="{{$direccion}}";
		//TNotify.alert(direccion);
		setTimeout(myFunction, 1000);

		function myFunction(){
		window.location.href="/home/";
		}
		@endif

</script>
--}}
@endsection
