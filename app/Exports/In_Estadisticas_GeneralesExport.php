<?php

namespace App\Exports;

use App\Exports\In_Esta_GnralSheetExport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class In_Estadisticas_GeneralesExport implements WithMultipleSheets
{
    protected $tabla;
    protected $niveles;
    protected $periodo;
    protected $totales_por_nivel;
    protected $total_general;

    public function __construct($tabla, $niveles, $totales_por_nivel, $total_general, $periodo)
    {
        $this->tabla = $tabla;
        $this->niveles = $niveles;
        $this->totales_por_nivel = $totales_por_nivel;
        $this->total_general = $total_general;
        $this->periodo = $periodo;
    }

    public function sheets(): array
    {
        return [
            'Aprobados' => new In_Esta_GnralSheetExport(
                $this->tabla,
                $this->niveles,
                'aprobados',
                $this->totales_por_nivel,
                $this->total_general,
                $this->periodo
            ),
            'Reprobados' => new In_Esta_GnralSheetExport(
                $this->tabla,
                $this->niveles,
                'reprobados',
                $this->totales_por_nivel,
                $this->total_general,
                $this->periodo
            ),
            'Desertores' => new In_Esta_GnralSheetExport(
                $this->tabla,
                $this->niveles,
                'desertores',
                $this->totales_por_nivel,
                $this->total_general,
                $this->periodo
            ),
        ];
    }
}
