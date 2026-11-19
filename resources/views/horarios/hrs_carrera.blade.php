@extends('layouts.panel')
@section('title', 'Horas por Carrera')
@include('partials.panel.recursos_app')
@section('content')
<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="Horas de las  Carreras por categoria" />

    <x-panel.tarjeta class="tw:max-w-md">
                            <div class="dropdown">
                                <x-panel.select etiqueta="Categorias" id="selectCargo" name="selectCargo">
                                    <option disabled selected hidden>Selecciona una categoria</option>
                                    @foreach($cargos as $cargo)
                                        @if($cargo->id_cargo==$categoria)
                                            <option value="{{$cargo->id_cargo}}" selected="selected">{{$cargo->cargo}}</option>
                                        @else
                                            <option value="{{$cargo->id_cargo}}"> {{$cargo->cargo}}</option>
                                        @endif
                                    @endforeach
                                </x-panel.select>
                            </div>
    </x-panel.tarjeta>
    @if($ver == 1)
    <x-panel.tarjeta sin-relleno>
        <div class="tw:max-w-full tw:overflow-x-auto">
            <table class="tw-tabla tw-tabla-bordes">
                <tr>
                    <th rowspan="2" class="tw:text-center">CARRERA</th>
                    <th rowspan="2">HRS.CLASE</th>
                    <th colspan="5" class="tw:text-center">HRS.EXTRA CLASE</th>
                    <th rowspan="2" class="tw:bg-brand-50 tw:text-brand-700">TOTALES POR CARRERA</th>
                </tr>
                <tr>
                    <th>TUTORIAS</th>
                    <th>GESTIÓN A.</th>
                    <th>INVEST.</th>
                    <th>VINCULACIÓN</th>
                    <th>RESIDENCIA P.</th>
                </tr>
                @foreach($carreras as $carrera)
                    <tr>

                        <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$carrera["carrera"]}}</td>
                        <td>{{$carrera["clase"]}}</td>
                        <td>{{$carrera["tutorias"]}}</td>
                        <td>{{$carrera["gestion"]}}</td>
                        <td>{{$carrera["investigacion"]}}</td>
                        <td>{{$carrera["vinculacion"]}}</td>
                        <td>{{$carrera["residencia"]}}</td>
                        <td class="tw:bg-brand-50 tw:font-semibold tw:text-brand-700">{{$carrera["totales"]}}</td>
                    </tr>
                @endforeach
                <tr class="tw:font-semibold">
                    <td class="tw:bg-brand-50 tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">TOTALES POR CARRERAS</td>
                    <td class="tw:bg-brand-50">{{$clase1}}</td>
                    <td class="tw:bg-brand-50">{{$tutorias1}}</td>
                    <td class="tw:bg-brand-50">{{$gestion1}}</td>
                    <td class="tw:bg-brand-50">{{$invest1}}</td>
                    <td class="tw:bg-brand-50">{{$vincula1}}</td>
                    <td class="tw:bg-brand-50">{{$residencia1}}</td>
                    <td class="tw:bg-brand-100 tw:font-semibold tw:text-brand-700">{{$totales}}</td>
                </tr>
            </table>
        </div>
    </x-panel.tarjeta>
        @endif

</main>
<script>
    $(document).ready(function() {
        $("#selectCargo").on('change',function(e){
            var id_cargo= $("#selectCargo").val();
//TNotify.alert(id_cargo);
            //var mensaje = TNotify.confirm('/p_educativa/datos/'+id_carrera +'/'+id_cargo);
            //Detectamos si el usuario acepto el mensaje
            //if (mensaje)
            //{
            window.location.href='/hrs_carrera/categoria/'+id_cargo ;
            //  }

        });
    });
</script>

@endsection
