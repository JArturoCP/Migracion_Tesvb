@foreach($array_requisiciones as $req)
    <form id="form_guardar_aut_req" class="" action="{{url("/presupuesto_autorizado/guardar_aut_requisicion/".$req['id_actividades_req_ante'])}}" role="form" method="POST" >
        {{ csrf_field() }}
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw:mb-4">
                    <label>Ingresar descripcion solicitud</label>
                    <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="des_solicitud" name="des_solicitud" rows="3" onkeyup="javascript:this.value=this.value.toUpperCase();" required></textarea>
                </div>
            </div>
        </div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Clave presupuestal: {{ $req['clave_presupuestal'] }}</h4>
        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Denominación: {{ $req['nombre_partida'] }}</h4>
        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">MES: {{ $req['mes'] }}</h4>
    </div>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Materiales o servicios</h4>
        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
            <thead>
            <tr>
                <th>Descripcion</th>
                <th>Unidad de medida</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
                <th>Importe</th>
            </tr>
            </thead>
            <tbody>
            <?php $total_req=0; ?>
            @foreach($req['materiales'] as $mat)
                    <?php
                    $importe=$mat['cantidad']*$mat['precio_unitario'];
                    $total_req=$total_req+$importe;
                    ?>
                <tr>
                    <td>{{$mat['descripcion']}}</td>
                    <td>{{$mat['unidad_medida']}}</td>
                    <td>{{$mat['cantidad']}}</td>
                    <td>{{ number_format($mat['precio_unitario'], 2, '.', ',')  }}</td>
                    <td>{{ number_format($importe, 2, '.', ',')  }}</td>
                </tr>
          @endforeach
            <tr>
                <td class="tw:text-right" colspan="4">Total</td>
                <td>{{ number_format($total_req, 2, '.', ',')  }}</td>
            </tr>
            </tbody>
        </table>
</div>
    </div>
</div>
    </form>
    @endforeach

