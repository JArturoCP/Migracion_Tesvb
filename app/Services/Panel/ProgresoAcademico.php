<?php

namespace App\Services\Panel;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

final class ProgresoAcademico
{
    public function paraFichaVerificada(int $alumnoId): array
    {
        $academicos = config('tesvb_creditos.academicos');
        $complementarios = config('tesvb_creditos.complementarios');

        return [
            'requisito_academico' => $academicos,
            'requisito_complementario' => $complementarios,
            'requisito_total' => $academicos + $complementarios,
            'complementarios' => $this->complementarios($alumnoId, $complementarios),
        ];
    }

    private function complementarios(int $alumnoId, int $requisito): array
    {
        try {
            $registros = DB::table('cal_actividades_complementarias')
                ->where('id_alumno', $alumnoId)
                ->limit(2)
                ->get(['cal', 'clave']);
        } catch (QueryException) {
            return ['acreditados' => null, 'estado' => 'No se pudo consultar la acreditación.'];
        }

        if ($registros->isEmpty()) {
            return ['acreditados' => null, 'estado' => 'Sin acreditación registrada'];
        }

        // El historial registra la acreditación oficial del bloque completo como ACA.
        $registro = $registros->first();
        if ($registros->count() !== 1 || $registro->cal !== 'ACA' || $registro->clave !== 'ACC-0001') {
            return ['acreditados' => null, 'estado' => 'Acreditación por verificar'];
        }

        return ['acreditados' => $requisito, 'estado' => 'Requisito cumplido'];
    }
}
