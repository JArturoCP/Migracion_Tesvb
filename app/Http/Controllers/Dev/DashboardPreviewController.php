<?php

namespace App\Http\Controllers\Dev;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class DashboardPreviewController
{
    public function __invoke(Request $request): Response
    {
        abort_unless(
            app()->environment('local')
            && config('app.env') === 'local'
            && config('app.debug') === true
            && config('dev_preview.enabled') === true
            && PHP_SAPI === 'cli-server'
            && in_array($request->server('REMOTE_ADDR'), ['127.0.0.1', '::1'], true)
            && in_array($request->getHost(), ['127.0.0.1', '[::1]'], true)
            && !$request->headers->has('Forwarded')
            && !$request->headers->has('X-Forwarded-For'),
            404,
        );

        $catalogo = array_column(config('tesvb_themes.careers'), null, 'key');
        $clave = $request->query->all()['carrera'] ?? array_key_first($catalogo);
        abort_unless(is_string($clave) && isset($catalogo[$clave]), 404);
        $tema = $catalogo[$clave];
        abort_unless(preg_match('/\A#[0-9a-f]{6}\z/i', $tema['primary']) === 1, 404);

        $accesos = [
            ['titulo' => 'Materias', 'icono' => 'formularios', 'url' => null],
            ['titulo' => 'Horario', 'icono' => 'calendario', 'url' => null],
            ['titulo' => 'Calificaciones', 'icono' => 'tablas', 'url' => null],
            ['titulo' => 'Tutorías', 'icono' => 'usuario', 'url' => null],
        ];

        $view = view('panel.dashboard.estudiante.inicio', [
            'vistaPreviaDashboard' => true,
            'colorVistaPrevia' => $tema['primary'],
            'catalogoVistaPrevia' => $catalogo,
            'claveVistaPrevia' => $clave,
            'estudiante' => [
                'nombre' => 'Estudiante de muestra',
                'carrera' => $tema['name'],
                'semestre' => 'Por verificar',
                'periodo' => 'Por verificar',
                'logo' => asset($tema['logo']),
                'mascota' => asset($tema['image']),
                'contexto' => true,
                'accesos' => $accesos,
            ],
            'progreso' => [
                'requisito_total' => null,
                'requisito_academico' => null,
                'requisito_complementario' => null,
                'complementarios' => ['acreditados' => null, 'estado' => 'Por verificar'],
            ],
            'novedades' => [
                ['tipo' => 'Ejemplo', 'titulo' => 'Aviso de muestra', 'detalle' => 'Información académica: Por verificar.'],
            ],
        ]);

        return new Response($view, 200, [
            'Cache-Control' => 'no-store',
            'X-Robots-Tag' => 'noindex',
        ]);
    }
}
