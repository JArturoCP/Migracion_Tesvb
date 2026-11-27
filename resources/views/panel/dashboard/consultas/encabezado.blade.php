{{--
    Encabezado del dashboard de PLANEACIÓN Y CONSULTAS: el encabezado común del personal
    (panel/dashboard/personal/encabezado → x-panel.hero, el mismo del alumno) con los datos de este rol.
    $encabezadoPerfil: ['cargo', 'unidad'] de App\Services\Panel\DatosConsultas::encabezado (vía PanelInicioComposer).
--}}
@include('panel.dashboard.personal.encabezado', [
    'tituloId' => 'consultas-saludo',
    'identidad' => Session::get('nombre_carrera') ?: 'Planeación y Consultas',
    'meta' => [
        'Cargo' => $encabezadoPerfil['cargo'] ?? null,
        'Unidad administrativa' => $encabezadoPerfil['unidad'] ?? null,
        'Periodo seleccionado' => Session::get('nombre_periodo') ?: 'No disponible',
    ],
])
