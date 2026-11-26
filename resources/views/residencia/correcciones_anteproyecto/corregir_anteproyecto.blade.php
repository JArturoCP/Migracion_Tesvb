@extends('layouts.panel')
@section('title', 'Registrar Anteproyecto')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    @if($modificar == 0)
        <x-panel.alerta tipo="error" class="tw:mb-4">No has registrado tu anteproyecto</x-panel.alerta>

        @elseif($modificar == 1)
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2"  >
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">Tu anteproyecto fue enviado para revisarlo.</div>
                    <div class="tw:p-5 tw:sm:p-6"><p>Los siguiente son tus revisores</p>
                    @foreach($revisores as $revisor)
                    <p>- {{ $revisor->nombre }}</p>
                    @endforeach</div>
                </div>
            </div>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2"  >
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">Los revisores que faltan por revisar tu anteproyecto.</div>

                <div class="tw:p-5 tw:sm:p-6">@foreach($revisores_faltan as $rev)
                        <p>- {{ $rev->nombre }}</p>
                    @endforeach</div>
                </div>
            </div>
        </div>
    @elseif($modificar == 3)
        <x-panel.encabezado titulo="Tu anteproyecto fue aceptado, registra tu empresa y ya puedes imprimir tu dictamen de anteproyecto" :migas="['Residencia profesional' => null]" />

    @endif
    <script type="text/javascript">
        $(document).ready( function() {
            $("#mensaje").click(function (event) {
                $('#modal_verificar').modal('show');
            });
            $("#mensaje1").click(function (event) {
                $('#modal_verificar').modal('show');
            });
            $("#mensaje2").click(function (event) {
                $('#modal_verificar').modal('show');
            });
            $("#mensaje3").click(function (event) {
                $('#modal_verificar').modal('show');
            });
            $("#mensaje4").click(function (event) {
                $('#modal_verificar').modal('show');
            });
            $(".enviar").click(function (event) {
                var id=$(this).attr('id');
                $('#id_anteproyecto').val(id);
                $('#modal_enviar').modal('show');
            });
        });
    </script>
</div>
@endsection