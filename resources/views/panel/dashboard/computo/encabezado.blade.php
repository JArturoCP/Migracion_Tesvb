{{--
    Encabezado del dashboard del CENTRO DE CÓMPUTO: el encabezado común del personal
    (panel/dashboard/personal/encabezado → x-panel.hero, el mismo del alumno, consultas, finanzas, titulación y
    residencia) con los datos de este rol.
    $encabezadoPerfil: ['cargo', 'unidad', 'departamento'] de App\Services\Panel\EncabezadoPersonal (vía PanelInicioComposer).
--}}
@include('panel.dashboard.personal.encabezado', [
    'tituloId' => 'computo-saludo',
    'identidad' => ($encabezadoPerfil['departamento'] ?? null) ?: 'Centro de Cómputo',
    'meta' => [
        'Cargo' => $encabezadoPerfil['cargo'] ?? null,
        'Unidad administrativa' => $encabezadoPerfil['unidad'] ?? null,
        'Periodo seleccionado' => Session::get('nombre_periodo') ?: 'No disponible',
    ],
])
