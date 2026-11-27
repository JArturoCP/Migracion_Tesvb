<?php

namespace App\Services\Panel;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Datos del encabezado grande (x-panel.hero) de los dashboards del personal: cargo, unidad administrativa y
 * departamento del usuario, e iniciales. Solo lectura, por usuario y sin caché. Lo usan Planeación y Consultas
 * y Finanzas (docs/DASHBOARD_CONSULTAS.md, docs/DASHBOARD_FINANZAS.md).
 */
final class EncabezadoPersonal
{
    /**
     * ['cargo', 'unidad', 'departamento'] del personal; null en lo que no exista o si la consulta falla
     * (el encabezado omite los valores null). Con $conDepartamento = false no consulta el departamento.
     */
    public static function datos(?int $idPersonal, bool $conDepartamento = true): array
    {
        $datos = ['cargo' => null, 'unidad' => null, 'departamento' => null];
        if (! $idPersonal) {
            return $datos;
        }

        try {
            $datos['cargo'] = DB::table('gnral_personales as p')
                ->join('gnral_cargos as c', 'c.id_cargo', '=', 'p.id_cargo')
                ->where('p.id_personal', $idPersonal)
                ->value('c.cargo');
            $datos['unidad'] = DB::table('gnral_unidad_personal as up')
                ->join('gnral_unidad_administrativa as ua', 'ua.id_unidad_admin', '=', 'up.id_unidad_admin')
                ->where('up.id_personal', $idPersonal)
                ->orderBy('up.id_unidad_persona')
                ->value('ua.nom_departamento');
        } catch (\Throwable $e) {
            Log::warning('Panel: no se pudo leer el encabezado del personal', ['id_personal' => $idPersonal, 'error' => $e->getMessage()]);
        }

        if (! $conDepartamento) {
            return $datos;
        }

        try {
            $datos['departamento'] = DB::table('gnral_personales as p')
                ->join('gnral_departamentos as d', 'd.id_departamento', '=', 'p.id_departamento')
                ->where('p.id_personal', $idPersonal)
                ->value('d.nombre_departamento');
        } catch (\Throwable $e) {
            Log::warning('Panel: no se pudo leer el departamento del personal', ['id_personal' => $idPersonal, 'error' => $e->getMessage()]);
        }

        return $datos;
    }

    /** "PAOLA FLORES ROJAS" → "PF" (primeras letras de las dos primeras palabras). */
    public static function iniciales(?string $nombre): ?string
    {
        $palabras = preg_split('/\s+/u', trim((string) $nombre), -1, PREG_SPLIT_NO_EMPTY);
        if (! $palabras) {
            return null;
        }

        return mb_strtoupper(implode('', array_map(fn ($p) => mb_substr($p, 0, 1), array_slice($palabras, 0, 2))));
    }
}
