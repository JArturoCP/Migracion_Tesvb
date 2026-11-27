{{--
    Encabezado del dashboard de TITULACIÓN: el encabezado común del personal
    (panel/dashboard/personal/encabezado → x-panel.hero, el mismo del alumno, consultas y finanzas) con los datos de este rol.
    $encabezadoPerfil: ['cargo', 'unidad', 'departamento'] de App\Services\Panel\EncabezadoPersonal (vía PanelInicioComposer).
--}}
@include('panel.dashboard.personal.encabezado', [
    'tituloId' => 'titulacion-saludo',
    'identidad' => ($encabezadoPerfil['departamento'] ?? null) ?: 'Titulación',
    'meta' => [
        'Cargo' => $encabezadoPerfil['cargo'] ?? null,
        'Unidad administrativa' => $encabezadoPerfil['unidad'] ?? null,
        'Periodo seleccionado' => Session::get('nombre_periodo') ?: 'No disponible',
    ],
])
