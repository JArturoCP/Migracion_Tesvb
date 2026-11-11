<table border="1" style="border-collapse: collapse; width: 100%;">
    <thead>
    <tr>
        <th colspan="7"></th><th colspan="15" style="border: 1px solid black; padding: 8px; background: #a8daef;
        text-align: center;font-family: 'Times New Roman', serif;font-size:12pt">Seguimiento de Resultados Académicos Institucionales</th>
    </tr>
    <tr>
        <th colspan="7"></th><th colspan="15" style="border: 1px solid black; padding: 8px; background: #a8daef;
        text-align: center;font-family: 'Times New Roman', serif;font-size:12pt">PROGRAMA DE ESTUDIO: {{ $datos_alum_in[0]->carrera }}</th>
    </tr>
    <tr>
        <th colspan="7"></th><th colspan="15" style="border: 1px solid black; padding: 8px; background: #a8daef;
        text-align: center;font-family: 'Times New Roman', serif;font-size:12pt">NIVEL: {{ $datos_alum_in[0]->nivel }}</th>
    </tr>
    <tr>
        <th colspan="7"></th><th colspan="15" style="border: 1px solid black; padding: 8px; background: #a8daef;
        text-align: center;font-family: 'Times New Roman', serif;font-size:12pt">GRUPO: {{ $datos_alum_in[0]->id_grupo }}</th>
    </tr>
    <tr></tr>
    <th colspan="7"></th><th colspan="15" style="border: 1px solid black; padding: 8px; background: yellow;
     text-align: center;font-family: 'Times New Roman', serif;font-size:12pt">Concentrado de Calificaciones Completo Ingles</th>
    <tr></tr>
    </thead>
</table>
<table border="1" style="border-collapse: collapse; width: 100%;">
    <thead>
    <tr>
        <th colspan="2"></th><th style="border: 1px solid black; padding: 8px; background: #a8daef; text-align: center;font-family: 'Times New Roman', serif;font-size:12pt" colspan="5">NP.</th>
        <th style="border: 1px solid black; padding: 8px; background: #a8daef; text-align: center;font-family: 'Times New Roman', serif;font-size:12pt" colspan="5">No. CTA</th>
        <th style="border: 1px solid black; padding: 8px; background: #a8daef; text-align: center;font-family: 'Times New Roman', serif;font-size:12pt" colspan="5">ALUMNO</th>
        <th style="border: 1px solid black; padding: 8px; background: #a8daef; text-align: center;font-family: 'Times New Roman', serif;font-size:12pt" colspan="5">TE</th>
        <th style="border: 1px solid black; padding: 8px; background: #a8daef; text-align: center;font-family: 'Times New Roman', serif;font-size:12pt" colspan="5">PROMEDIO</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($datos_alum_in as $alumno)
        <tr>
            <th colspan="2"></th><td style="border: 1px solid black; padding: 8px;text-align: center;font-family: 'Times New Roman', serif;font-size:12pt" colspan="5">{{$loop->iteration}}</td>
            <td style="border: 1px solid black; padding: 8px;text-align: center;font-family: 'Times New Roman', serif;font-size:12pt" colspan="5">{{ $alumno->cuenta }}</td>
            <td style="border: 1px solid black; padding: 8px;text-align: center;font-family: 'Times New Roman', serif;font-size:12pt" colspan="5">{{ $alumno->nombre }} {{ $alumno->apaterno }} {{ $alumno->amaterno }}</td>
            <td style="border: 1px solid black; padding: 8px;text-align: center;font-family: 'Times New Roman', serif;font-size:12pt" colspan="5">O</td>
            <td style="border: 1px solid black; padding: 8px;text-align: center;font-family: 'Times New Roman', serif;font-size:12pt" colspan="5">{{ $alumno->promedio }}</td>
        </tr>
    @endforeach

    <tr>
        <th colspan="2"></th><td colspan="15" style="border: 1px solid black; padding: 8px;text-align: right;font-family: 'Times New Roman', serif;font-size:12pt">Indice de Reprobación</td>
        <td style="border: 1px solid black; padding: 8px;text-align: center;font-family: 'Times New Roman', serif;font-size:12pt" colspan="5">
            {{ $indice_reprobacion }}%
        </td>
    </tr>
    <tr>
        <th colspan="2"></th><td colspan="15" style="border: 1px solid black; padding: 8px;text-align: right;font-family: 'Times New Roman', serif;font-size:12pt">Indice de Deserción</td>
        <td style="border: 1px solid black; padding: 8px;text-align: center;font-family: 'Times New Roman', serif;font-size:12pt" colspan="5">
            {{ $indice_desercion }}%
        </td>
    </tr>
    </tbody>
</table>

