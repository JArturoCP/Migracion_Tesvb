{{--
    Encabezado del dashboard de FINANZAS: el encabezado común del personal
    (panel/dashboard/personal/encabezado → x-panel.hero, el mismo del alumno y de consultas) con los datos de este rol.
    $encabezadoPerfil: ['cargo', 'unidad', 'departamento'] de App\Services\Panel\EncabezadoPersonal (vía PanelInicioComposer).
    $tablero['anio']: ejercicio fiscal que usan las pantallas de presupuesto (date('Y')).
--}}
@include('panel.dashboard.personal.encabezado', [
    'tituloId' => 'finanzas-saludo',
    'identidad' => ($encabezadoPerfil['departamento'] ?? null) ?: 'Finanzas',
    'meta' => [
        'Cargo' => $encabezadoPerfil['cargo'] ?? null,
        'Unidad administrativa' => $encabezadoPerfil['unidad'] ?? null,
        'Ejercicio fiscal' => (string) ($tablero['anio'] ?? now()->year),
        'Periodo seleccionado' => Session::get('nombre_periodo') ?: 'No disponible',
    ],
])
