{{--
    Encabezado del dashboard del DOCENTE: el encabezado común del personal
    (panel/dashboard/personal/encabezado → x-panel.hero, el mismo de los demás dashboards) con los datos del docente.
    $encabezadoPerfil: ['cargo', 'unidad', 'departamento'] de App\Services\Panel\EncabezadoPersonal (vía PanelInicioComposer).
--}}
@include('panel.dashboard.personal.encabezado', [
    'tituloId' => 'docente-saludo',
    'identidad' => ($encabezadoPerfil['departamento'] ?? null) ?: 'Docente',
    'meta' => [
        'Cargo' => $encabezadoPerfil['cargo'] ?? null,
        'Unidad administrativa' => $encabezadoPerfil['unidad'] ?? null,
        'Periodo seleccionado' => Session::get('nombre_periodo') ?: 'No disponible',
    ],
])
