<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Lista de articulos</h1>

    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="tabla_envio" class="tw-tabla tw-tabla-bordes">
            <thead>
                <tr class="tw:text-center">
                    <th class="tw:text-center">artiulos</th>
                </tr>
                <tr>
                    <th>
                    @foreach($articulos as $articulo)
                <option value="{{$articulo->id_articulo}}" data-art="{{$articulo->nombre_articulo}}"> {{$articulo->nombre_articulo}} </option>
                @endforeach
                    </th>
                </tr>
            </thead>
        </table>
</div>
</body>
</html>


