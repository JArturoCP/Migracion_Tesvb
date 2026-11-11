<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th, td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
        }

        .titulo {
            font-weight: bold;
            text-align: center;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .subtitulo {
            font-weight: bold;
            text-align: left;
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="titulo">
    Estadísticas Generales - {{ ucfirst($tipo) }}
    <br>
</div>

<table border="1" style="border-collapse: collapse; width: 100%;">
    <thead>
    <th colspan="7"></th><th colspan="15" style="border: 1px solid black; padding: 8px; background: #d9edf7;
     text-align: center;font-family: Helvetica, sans-serif;font-size:12pt"> Estadísticas Trimestre: {{ $periodo->periodo_ingles }} </th>
    <tr></tr>
    </thead>
</table>

<table border="1" style="border-collapse: collapse; width: 100%;">
    <thead>
    <tr>
        <th colspan="1"></th><th style="border: 1px solid black; padding: 8px; background: #919597; text-align: center;font-family: 'Helvetica', sans-serif;font-size:12pt" colspan="1">#</th>
        <th style="border: 1px solid black; padding: 8px; background: #919597; text-align: center;font-family: 'Helvetica', sans-serif;font-size:12pt" colspan="7">Programa Académico</th>
        @foreach($niveles as $nivel)
            <th style="border: 1px solid black; padding: 8px; background: #919597; text-align: center;font-family: 'Helvetica', sans-serif;font-size:12pt" colspan="2">{{ $nivel }}</th>
        @endforeach
        <th style="border: 1px solid black; padding: 8px; background: #919597; text-align: center;font-family: 'Helvetica', sans-serif;font-size:12pt" colspan="5">Total por Carrera</th>
    </tr>
    </thead>
    <tbody>
    @php $contador = 1; @endphp
    @foreach($tabla as $carrera => $datos)
        <tr>
            <th colspan="1"></th><td style="border: 1px solid black; padding: 8px;text-align: center;font-family: 'Helvetica', sans-serif;font-size:12pt" colspan="1">{{ $contador++ }}</td>
            <td style="border: 1px solid black; padding: 8px;text-align: center;font-family: 'Helvetica', sans-serif;font-size:12pt" colspan="7">{{ $carrera }}</td>
            @foreach($niveles as $nivel)
                <td style="border: 1px solid black; padding: 8px;text-align: center;font-family: 'Helvetica', sans-serif;font-size:12pt" colspan="2">{{ $datos[$tipo][$nivel] ?? 0 }}</td>
            @endforeach
            <td style="border: 1px solid black; padding: 8px;text-align: center;font-family: 'Helvetica', sans-serif;font-size:12pt" colspan="5">{{ $datos['total_' . $tipo] ?? 0 }}</td>
        </tr>
    @endforeach

    <!-- Totales por nivel y total general -->
    <tr style="font-weight: bold; background-color: #39da21;">
        <th colspan="1" style="border: 1px"></th><td style="border: 1px solid black; padding: 8px;text-align: center;font-family: 'Helvetica', sans-serif;font-size:12pt" colspan="8">Total por Nivel</td>
        @foreach($niveles as $nivel)
            <td style="border: 1px solid black; padding: 8px;text-align: center;font-family: 'Helvetica', sans-serif;font-size:12pt" colspan="2">{{ $totales_por_nivel[$tipo][$nivel] ?? 0 }}</td>
        @endforeach
        <td style="border: 1px solid black; padding: 8px;text-align: center;font-family: 'Helvetica', sans-serif;font-size:12pt" colspan="5">{{ $total_general[$tipo] ?? 0 }}</td>
    </tr>
    </tbody>
</table>

</body>
</html>
