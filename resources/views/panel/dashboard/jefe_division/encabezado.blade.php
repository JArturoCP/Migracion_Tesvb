{{--
    Encabezado del dashboard del JEFE DE DIVISIÓN: el encabezado común del personal
    (panel/dashboard/personal/encabezado → x-panel.hero, el mismo de los demás dashboards) con los datos de este rol,
    incluida la carrera de la sesión (session('nombre_carrera'), la misma que muestran sus módulos y el selector).
    $encabezadoPerfil: ['cargo', 'unidad', 'departamento'] de App\Services\Panel\EncabezadoPersonal (vía PanelInicioComposer).
--}}
@include('panel.dashboard.personal.encabezado', [
    'tituloId' => 'jefe-division-saludo',
    'identidad' => ($encabezadoPerfil['departamento'] ?? null) ?: 'Jefatura de División',
    'meta' => [
        'Carrera' => Session::get('nombre_carrera') ?: null,
        'Cargo' => $encabezadoPerfil['cargo'] ?? null,
        'Unidad administrativa' => $encabezadoPerfil['unidad'] ?? null,
        'Periodo seleccionado' => Session::get('nombre_periodo') ?: 'No disponible',
    ],
])
