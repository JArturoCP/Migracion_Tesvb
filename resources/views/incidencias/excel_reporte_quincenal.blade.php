<table>
    <thead >
    <tr>
    <th width="20px;">ID EMPLEADO</th>
    <th width="70px;">SERVIDOR PÚBLICO DEL JUSTIFICANTE </th>
    <th width="30px;">FECHA QUE JUSTIFICA </th>
    <th width="30px;">NUMERO DE OFICIO Y/O DOCUMENTO</th>
    <th width="70px;">DOCUMENTO </th>
    </tr>
    </thead>
    <tbody>

    @foreach($articulos as $fecha)
        <tr>
            <td>{{$fecha->numero_empleado}}</td>
            <td>{{$fecha->servidor}}</td>
            @if($fecha->estado == 1)

                @if($fecha->no_fecha == 2)
                    <td>{{$fecha->fecha_i }} al {{$fecha->fecha_f }}</td>
                @else
                    <td>{{$fecha->fecha_i }} </td>
                @endif
                <td>{{$fecha->id_solicitud }} </td>
            @elseif($fecha->estado == 2)

                @if($fecha->no_fecha == 2 )
                    <td>{{$fecha->fecha_i }} al {{$fecha->fecha_f }}</td>
                @else
                    <td>{{$fecha->fecha_i }} </td>
                @endif
                @if($fecha->id == 1 || $fecha->id == 3 ||  $fecha->id == 5  ||  $fecha->id == 6)
                    <td>{{ $fecha->no_folio }}</td>
                @else
                    <td></td>
                @endif

            @endif

            <td>{{$fecha->documento}}</td>
        </tr>
    @endforeach
    </tbody>
</table>