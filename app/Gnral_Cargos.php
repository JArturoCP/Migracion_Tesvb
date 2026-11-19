<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gnral_Cargos extends Model
{
    protected $table = 'gnral_cargos';
    protected $primaryKey='id_cargo';
    protected $fillable=['cargo','abre'];

    /** Opciones de consulta; no modifica los IDs referenciados por los horarios. */
    public static function opcionesPlantilla()
    {
        $options = DB::table('gnral_cargos')
            ->selectRaw('MIN(id_cargo) as id_cargo, cargo, abre')
            ->groupBy('cargo', 'abre')->orderBy('cargo')->orderBy('abre')->get();

        foreach ($options->groupBy('cargo') as $group) {
            if ($group->count() > 1) {
                foreach ($group as $option) {
                    $option->cargo .= ' ('.($option->abre ?: 'sin abreviación').')';
                }
            }
        }

        return $options;
    }

    /** Un parámetro enlazado: acepta también un ID antiguo del mismo grupo. */
    public const IDS_EQUIVALENTES_SQL = '(SELECT equivalente.id_cargo
        FROM gnral_cargos equivalente JOIN gnral_cargos seleccionado
          ON equivalente.cargo = seleccionado.cargo
         AND (equivalente.abre = seleccionado.abre OR (equivalente.abre IS NULL AND seleccionado.abre IS NULL))
        WHERE seleccionado.id_cargo = ?)';
}
