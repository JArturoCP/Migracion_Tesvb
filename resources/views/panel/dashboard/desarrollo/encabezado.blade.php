{{--
    Encabezado del dashboard de DESARROLLO ACADÉMICO: el encabezado común del personal
    (panel/dashboard/personal/encabezado → x-panel.hero, el mismo del alumno, consultas, finanzas, titulación,
    residencia, cómputo, recursos humanos y servicios escolares) con los datos de este rol.
    $encabezadoPerfil: ['cargo', 'unidad', 'departamento'] de App\Services\Panel\EncabezadoPersonal (vía PanelInicioComposer).
--}}
@include('panel.dashboard.personal.encabezado', [
    'tituloId' => 'desarrollo-saludo',
    'identidad' => ($encabezadoPerfil['departamento'] ?? null) ?: 'Desarrollo Académico',
    'meta' => [
        'Cargo' => $encabezadoPerfil['cargo'] ?? null,
        'Unidad administrativa' => $encabezadoPerfil['unidad'] ?? null,
        'Periodo seleccionado' => Session::get('nombre_periodo') ?: 'No disponible',
    ],
])
