<?php

namespace App\Services\Panel;

use App\Services\TemaCarreraResolver;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

final class DatosEstudiante
{
    public function __construct(private readonly TemaCarreraResolver $temas)
    {
    }

    public function ficha(Authenticatable $usuario): ?object
    {
        try {
            $fichas = DB::table('gnral_alumnos')
                ->where('id_usuario', $usuario->getAuthIdentifier())
                ->limit(2)
                ->get(['id_alumno', 'cuenta', 'nombre', 'apaterno', 'amaterno']);
        } catch (QueryException $exception) {
            report($exception);

            return null;
        }

        $ficha = $fichas->first();

        return $fichas->count() === 1 && (int) $ficha->id_alumno > 0 ? $ficha : null;
    }

    public function presentacion(Authenticatable $usuario, object $ficha): array
    {
        $tema = $this->temas->para($usuario);
        $mascota = $tema['matched'] ? $this->recurso($tema['image']) : null;
        $logo = $tema['matched'] ? $this->recurso($tema['logo'] ?? null) : null;
        $sesionEstudiantil = session()->has('palumno')
            && (string) session('usuario_alumno') === (string) $usuario->getAuthIdentifier();
        $periodo = $sesionEstudiantil ? session('nombre_periodo') : null;
        $contexto = $sesionEstudiantil && (int) session('periodo_actual') > 0;
        $cuenta = $contexto && (string) $ficha->cuenta !== ''
            && (string) session('usuario') === (string) $ficha->cuenta;

        return [
            'nombre' => trim(implode(' ', array_filter([$ficha->nombre, $ficha->apaterno, $ficha->amaterno]))),
            'carrera' => $tema['matched'] ? $tema['name'] : null,
            'acento' => $tema['primary'],
            'mascota' => $mascota,
            'logo' => $logo,
            'periodo' => $periodo,
            'contexto' => $contexto,
            'accesos' => [
                ['titulo' => 'Materias', 'detalle' => 'Consulta tu carga académica', 'icono' => 'formularios', 'url' => $cuenta ? route('checar_carga.index') : null],
                ['titulo' => 'Horario', 'detalle' => 'Consulta tus clases y aulas', 'icono' => 'calendario', 'url' => route('alumno.horario')],
                ['titulo' => 'Calificaciones', 'detalle' => 'Revisa los resultados del período', 'icono' => 'tablas', 'url' => $contexto && (int) session('carrera') > 0 ? url('/calificaciones') : null],
                ['titulo' => 'Tutorías', 'detalle' => 'Consulta tu acompañamiento académico', 'icono' => 'usuario', 'url' => $contexto && (int) session('tipo_persona') === 1 ? route('tutorias.index') : null],
            ],
        ];
    }

    private function recurso(?string $ruta): ?string
    {
        return $ruta && is_file(public_path($ruta)) ? asset($ruta) : null;
    }
}
