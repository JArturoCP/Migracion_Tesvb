<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf as FPDF;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class In_pdf_generar_constancias_alumController extends Controller
{
    public function generar_pdf_alumno($id_alumno)
    {
        // Obtener datos
        $alumno = DB::selectOne(
            'SELECT * FROM gnral_alumnos WHERE id_alumno = ?',
            [$id_alumno]
        );

        $periodo_actual = DB::selectOne(
            'SELECT * FROM in_periodos WHERE estado_historial = 1'
        );

        $carrera = DB::selectOne(
            'SELECT * FROM gnral_carreras WHERE id_carrera = ?',
            [$alumno->id_carrera]
        );

        // Director
        $director_general = "DR. Fidel Argenis Flores Quiroz";
        $sexo_director_general = "M";

        // Fecha en español
        $hoy = Carbon::now()->locale('es');
        $day = $hoy->day;
        $month = $hoy->translatedFormat('F');
        $year = $hoy->year;

        // PDF
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();

        /* ================= ENCABEZADO ================= */
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, utf8_decode('TecNM-SEyV-DVIA-CNLE-ACT-12/22-TESVB-63'), 0, 1, 'C');
        $pdf->Ln(15);

        /* ================= ALUMNO ================= */
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(0, 8, utf8_decode('A'), 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->Cell(
            0,
            8,
            utf8_decode(
                mb_strtoupper(
                    $alumno->apaterno . " " . $alumno->amaterno . " " . $alumno->nombre,
                    'UTF-8'
                )
            ),
            0,
            1,
            'C'
        );

        /* ================= CUENTA ================= */
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(
            0,
            8,
            utf8_decode('Con número de cuenta: ' . $alumno->cuenta),
            0,
            1,
            'L'
        );

        /* ================= TEXTO ================= */
        $pdf->Ln(5);
        $pdf->Cell(0, 8, utf8_decode('En virtud que acreditó, las cuatro habilidades lingüísticas:'), 0, 1, 'L');
        $pdf->Cell(0, 8, utf8_decode('comprensión auditiva, comprensión lectora, expresión oral y'), 0, 1, 'L');

        // NIVEL B1 en negritas
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 8, utf8_decode('escrita correspondiente al NIVEL B1 '), 0, 1, 'L');

        // Continuación
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 8, utf8_decode('del programa de Inglés del'), 0, 1, 'L');
        $pdf->Cell(0, 8, utf8_decode('Tecnológico de Estudios de Valle de Bravo, de acuerdo'), 0, 1, 'L');
        $pdf->Cell(0, 8, utf8_decode('con el Marco Común Europeo de Referencia para las Lenguas.'), 0, 1, 'L');

        /* ================= FECHA ================= */
        $pdf->Ln(15);
        $pdf->Cell(
            0,
            8,
            utf8_decode("La presente se expide en Valle de Bravo, Estado de México a los $day de $month del $year"),
            0,
            1,
            'L'
        );

        /* ================= DIRECTOR ================= */
        $pdf->Ln(20);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 8, utf8_decode($director_general), 0, 1, 'C');

        if ($sexo_director_general == 'M') {
            $pdf->Cell(0, 8, utf8_decode("Director General"), 0, 1, 'C');
        } else {
            $pdf->Cell(0, 8, utf8_decode("Directora General"), 0, 1, 'C');
        }

        // Salida
        $pdfContent = $pdf->Output('S');

        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header(
                'Content-Disposition',
                'inline; filename="Constancia_' . $alumno->cuenta . '.pdf"'
            );
    }
}
