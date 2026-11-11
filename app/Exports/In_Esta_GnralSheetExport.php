<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class In_Esta_GnralSheetExport implements FromView
{
    protected $tabla;
    protected $niveles;
    protected $tipo;
    protected $periodo;
    protected $totales_por_nivel;
    protected $total_general;

    public function __construct($tabla, $niveles, $tipo, $totales_por_nivel, $total_general,$periodo)
    {
        $this->tabla = $tabla;
        $this->niveles = $niveles;
        $this->tipo = $tipo;
        $this->totales_por_nivel = $totales_por_nivel;
        $this->total_general = $total_general;
        $this->periodo = $periodo;
    }

    public function view(): View
    {
        return view('ingles.desempeno_academico.estadisticas_generales_excel', [
            'tabla' => $this->tabla,
            'niveles' => $this->niveles,
            'tipo' => $this->tipo,
            'totales_por_nivel' => $this->totales_por_nivel,
            'total_general' => $this->total_general,
            'periodo' => $this->periodo,
        ]);
    }
}
