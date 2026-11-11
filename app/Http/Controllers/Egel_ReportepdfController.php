<?php

    namespace App\Http\Controllers;

    use Illuminate\Support\Facades\DB;
    use App\Libraries\PdfExtend;

    class Egel_ReportepdfController extends Controller
    {
        public function generar()
        {
              // Obtener alumno logueado
        $alumno = DB::table('gnral_alumnos')
            ->where('id_usuario', auth()->id())
            ->first();

        if (!$alumno) {
            abort(403, utf8_decode('Alumno no encontrado'));
        }

        // Obtener carrera
        $carrera = DB::table('gnral_carreras')
            ->where('id_carrera', $alumno->id_carrera)
            ->first();

        // Obtener examen según carrera
        $id_examen_egel = DB::table('egel_examenes')
            ->where('estado', 1)
            ->where('id_carrera', $alumno->id_carrera)
            ->value('id_examen_egel');

        if (!$id_examen_egel) {
            abort(403, 'Examen no encontrado');
        }

        // Obtener resultado general del alumno para ese examen
        $resultado = DB::table('egel_resultados')
            ->where('id_alumno', $alumno->id_alumno)
            ->where('id_examen_egel', $id_examen_egel)
            ->first();

        $porSeccion = DB::table('egel_respuestas_alumno as ra')
    ->join('egel_preguntas as p', 'p.id_pregunta', '=', 'ra.id_pregunta')
    ->where('ra.id_alumno', $alumno->id_alumno)
    ->where('ra.id_examen_egel', $id_examen_egel)
    ->groupBy('ra.id_seccion')
    ->selectRaw('
        ra.id_seccion,
        COUNT(*) as total,

        SUM(CASE WHEN ra.es_correcta > 0 THEN p.valor ELSE 0 END) as puntos_obtenidos,

        SUM(p.valor) as puntos_totales,

        ROUND((
            SUM(CASE WHEN ra.es_correcta > 0 THEN p.valor ELSE 0 END)
            / SUM(p.valor)
        ) * 100, 2) as porcentaje
    ')
    ->get();

        $disciplinar = $porSeccion->firstWhere('id_seccion', 1);
        $transversal = $porSeccion->firstWhere('id_seccion', 2);

        $porcentajeDisc = $disciplinar->porcentaje ?? 0;
        $porcentajeTrans = $transversal->porcentaje ?? 0;

        $puntajeDisc = 700 + ($porcentajeDisc * 6);
        $puntajeTrans = 700 + ($porcentajeTrans * 6);

        $porModulo = DB::table('egel_respuestas_alumno as ra')
    ->join('egel_preguntas as p', 'p.id_pregunta', '=', 'ra.id_pregunta')
    ->join('egel_modulos as m', 'm.id_modulo', '=', 'p.id_modulo')
    ->where('ra.id_alumno', $alumno->id_alumno)
    ->where('ra.id_examen_egel', $id_examen_egel)
    ->groupBy('m.id_modulo', 'm.nombre')
    ->selectRaw('
        m.nombre,
        COUNT(*) as total,
        SUM(CASE WHEN ra.es_correcta > 0 THEN p.valor ELSE 0 END) as puntos_obtenidos,
        SUM(p.valor) as puntos_totales,
        ROUND((
            SUM(CASE WHEN ra.es_correcta > 0 THEN p.valor ELSE 0 END)
            / SUM(p.valor)
        ) * 100, 2) as porcentaje
    ')
    ->get();

            $carreraNombre = $carrera->nombre ?? '';

            // ===== CLASE PDF PERSONALIZADA CON FOOTER AUTOMÁTICO =====
            $pdf = new class($carreraNombre) extends PdfExtend {
                private $carreraNombreFooter;

                public function __construct($carreraNombre)
                {
                    parent::__construct();
                    $this->carreraNombreFooter = $carreraNombre;
                }

                // Footer automático
                public function Footer()
                {
                    $this->SetY(-30);
                    $this->SetFont('Arial', '', 8);
                    $this->SetTextColor(7, 80, 139);

                    $footerText = utf8_decode(
                        "Av. Camino al Desierto de los Leones 19, Col. San Ángel, Alcaldía Álvaro Obregón\n" .
                        "C.P. 01000, Ciudad de México, Tel: 55 5322 9200\n" .
                        "www.ceneval.edu.mx"
                    );
                    $this->MultiCell(140, 4, $footerText, 0, 'R');

                    $logos = [
                        'turismo' => 'img/turismo.png',
                        'forestal' => 'img/forestal.png',
                    ];

                    foreach ($logos as $key => $ruta) {
                        if (stripos($this->carreraNombreFooter, $key) !== false) {
                            $logoFooter = public_path($ruta);
                            if (file_exists($logoFooter)) {
                                $this->Image($logoFooter, 160, 250, 25);
                            }
                            break;
                        }
                    }
                }
            };

            // ===== FUNCIÓN PARA DIBUJAR BARRAS =====
            $drawBar = function ($pdf, $puntaje, $barX, $barY, $barWidth = 120, $barHeight = 8) {
                $pdf->SetFillColor(200, 200, 200);
                $pdf->Rect($barX, $barY, $barWidth, $barHeight, 'F');

                $pdf->SetFillColor(0, 75, 130);
                $pdf->Rect($barX + ($barWidth * 40 / 600), $barY, $barWidth * 109 / 600, $barHeight, 'F');

                $pdf->SetFillColor(0, 45, 90);
                $pdf->Rect($barX + ($barWidth * 149 / 600), $barY, $barWidth * 51 / 600, $barHeight, 'F');

                $posX = $barX + (($puntaje - 700) / 600) * $barWidth;
                $pdf->SetFillColor(255, 170, 0);
                $pdf->Rect($posX - 1, $barY - 3, 3, $barHeight + 6, 'F');
            };

            // ===== PÁGINA 1 =====
            $pdf->AddPage();
            $pdf->SetAutoPageBreak(false, 20);

            // HEADER
            $pdf->Image(public_path('img/TESVB.png'), 7, 2, 45, 25);
            $pdf->SetXY(60, 10);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->SetTextColor(0, 75, 130);
            $pdf->Cell(0, 7, utf8_decode("Examen General de Conocimientos"), 0, 1, 'C');
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 7, utf8_decode(strtoupper($carreraNombre)), 0, 1, 'C');

            // DATOS DEL ALUMNO
            $pdf->Ln(5);
            $pdf->SetFillColor(220, 220, 220);
            $pdf->SetTextColor(0, 60, 100);
            $pdf->SetFont('Arial', 'B', 10);
            $nombreCompleto = ucwords(strtolower($alumno->nombre . ' ' . $alumno->apaterno . ' ' . $alumno->amaterno));
            $pdf->Cell(130, 10, utf8_decode('Nombre: ' . $nombreCompleto), 0, 0, 'L', true);
            $pdf->Cell(60, 10, 'Folio: ' . $alumno->cuenta, 0, 1, 'R', true);

            $pdf->Cell(130, 10, utf8_decode('Institución: Tecnológico de Estudios Superiores de Valle de Bravo'), 0, 0, 'L', true);
            $pdf->Cell(60, 10, 'Fecha: ' . date('d/m/Y'), 0, 1, 'R', true);

            $pdf->Ln(5);
            $pdf->SetFont('Arial', '', 9);
            $pdf->SetTextColor(0, 90, 140);
            $pdf->MultiCell(0, 6, utf8_decode('A continuación, se muestra el nivel de desempeño global obtenido, conformado por los resultados de la sección Disciplinar y la sección Transversal de Lenguaje y Comunicación.'), 0, 'L');

            // NIVEL GLOBAL
            $pdf->Ln(5);
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->SetFillColor(0, 65, 105);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(95, 12, utf8_decode('Nivel de desempeño global'), 1, 0, 'C', true);

            $pdf->SetFillColor(240, 240, 240);
            $pdf->SetTextColor(0, 0, 0);
            $nivelGlobal = $resultado->nivel ?? utf8_decode('Sin resultado');
            $pdf->Cell(95, 12, utf8_decode($nivelGlobal), 1, 1, 'C', true);

            // SECCIÓN DISCIPLINAR
            $pdf->Ln(10);
            $pdf->SetFillColor(0, 65, 105);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(0, 10, utf8_decode('SECCIÓN DISCIPLINAR'), 0, 1, 'L', true);

            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 80, 140);
            $pdf->Cell(40, 5, utf8_decode('Aún no satisfactorio'), 0, 0, 'C');
            $pdf->Cell(40, 5, 'Satisfactorio', 0, 0, 'C');
            $pdf->Cell(40, 5, 'Sobresaliente', 0, 1, 'C');

            $pdf->Cell(40, 5, '700-999', 0, 0, 'C');
            $pdf->Cell(40, 5, '1000-1149', 0, 0, 'C');
            $pdf->Cell(40, 5, '1150-1300', 0, 1, 'C');

            $barX = $pdf->GetX();
            $barY = $pdf->GetY();
            $drawBar($pdf, $puntajeDisc, $barX, $barY);

            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY($barX, $barY + 12);
            $pdf->Cell(120, 6, utf8_decode('Tu puntaje en Índice Ceneval: ') . round($puntajeDisc), 0, 1, 'C');

            if ($puntajeDisc >= 1150) {
                $nivelDisc = utf8_decode('Sobresaliente');
            } elseif ($puntajeDisc >= 1000) {
                $nivelDisc = utf8_decode('Satisfactorio');
            } else {
                $nivelDisc = utf8_decode('Aún no satisfactorio');
            }

            $pdf->SetXY($barX + 125, $barY - 1);
            $pdf->SetDrawColor(0, 75, 130);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(0, 75, 130);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(50, 14, $nivelDisc, 1, 1, 'C', true);

            // SECCIÓN TRANSVERSAL
            $pdf->Ln(20);
            $pdf->SetFillColor(150, 150, 150);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(0, 10, utf8_decode('SECCIÓN TRANSVERSAL DE LENGUAJE Y COMUNICACIÓN'), 0, 1, 'L', true);

            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 80, 140);
            $pdf->Cell(40, 5, utf8_decode('Aún no satisfactorio'), 0, 0, 'C');
            $pdf->Cell(40, 5, 'Satisfactorio', 0, 0, 'C');
            $pdf->Cell(40, 5, 'Sobresaliente', 0, 1, 'C');

            $pdf->Cell(40, 5, '700-999', 0, 0, 'C');
            $pdf->Cell(40, 5, '1000-1149', 0, 0, 'C');
            $pdf->Cell(40, 5, '1150-1300', 0, 1, 'C');

            $barY = $pdf->GetY();
            $drawBar($pdf, $puntajeTrans, $barX, $barY);

            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY($barX, $barY + 12);
            $pdf->Cell(120, 6, utf8_decode('Tu puntaje en Índice Ceneval: ') . round($puntajeTrans), 0, 1, 'C');

            if ($puntajeTrans >= 1150) {
                $nivelTrans = utf8_decode('Sobresaliente');
            } elseif ($puntajeTrans >= 1000) {
                $nivelTrans = utf8_decode('Satisfactorio');
            } else {
                $nivelTrans = utf8_decode('Aún no satisfactorio');
            }

            $pdf->SetXY($barX + 125, $barY - 1);
            $pdf->SetDrawColor(110, 110, 110);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(110, 110, 110);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(50, 14, $nivelTrans, 1, 1, 'C', true);

            // TEXTO FINAL
            $pdf->Ln(20);
            $pdf->SetFont('Arial', '', 9);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->MultiCell(0, 5, utf8_decode('Para mayor información acerca de los reportes de resultados, consulte la infografía en el siguiente QR.'));

// ===== FUNCIÓN PARA ENCABEZADO DE PÁGINA 2 =====
function drawHeaderSeccionDisciplinar($pdf, $carreraNombre) {
    // HEADER GENERAL
    $pdf->Image(public_path('img/TESVB.png'), 7, 2, 45, 25);
    $pdf->SetXY(60, 10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetTextColor(0, 75, 130);
    $pdf->Cell(0, 7, utf8_decode("Examen General de Conocimientos"), 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 7, utf8_decode(strtoupper($carreraNombre)), 0, 1, 'C');

    // TÍTULO DE LA PÁGINA
    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->SetTextColor(0, 75, 130);
    $pdf->Cell(0, 12, utf8_decode('RESULTADOS EN LAS ÁREAS DE LA SECCIÓN DISCIPLINAR'), 0, 1, 'L');

    $pdf->SetFont('Arial', '', 11);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->MultiCell(0, 8, utf8_decode(
        'Nivel de desempeño obtenido en cada área de la sección Disciplinar de acuerdo con el puntaje en Índice Ceneval.'
    ), 0, 'L');

    $pdf->Ln(8);
}

// ===== PÁGINA 2 - DETALLE SECCIÓN DISCIPLINAR =====
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 25);

// Dibujar encabezado completo
drawHeaderSeccionDisciplinar($pdf, $carreraNombre);

// SECCIÓN DISCIPLINAR - Fondo azul
$pdf->SetFillColor(0, 65, 105);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 12, utf8_decode('SECCIÓN DISCIPLINAR'), 0, 1, 'L', true);
$pdf->Ln(3);

// RECORRER ÁREAS DINÁMICAMENTE
foreach ($porModulo as $index => $modulo) {
    // NUEVA PÁGINA PARA CADA MÓDULO DESPUÉS DEL PRIMERO
    if ($index > 0) {
        $pdf->AddPage();
        drawHeaderSeccionDisciplinar($pdf, $carreraNombre);

        $pdf->SetFillColor(0, 65, 105);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 12, utf8_decode('SECCIÓN DISCIPLINAR'), 0, 1, 'L', true);
        $pdf->Ln(3);
    }

    $areaNombre = $modulo->nombre;
    $puntajeArea = 700 + ($modulo->porcentaje * 6);

    // Nombre del área
    $pdf->SetFillColor(0, 65, 105);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 12, utf8_decode($areaNombre), 0, 1, 'L', true);
    $pdf->Ln(15);

    // ===== BARRA CON RANGOS =====
    $barX = $pdf->GetX() + 40;
    $barY = $pdf->GetY();
    $barWidth = 120;
    $barHeight = 10;

    // Fondo barra general
    $pdf->SetFillColor(180, 200, 220);
    $pdf->Rect($barX, $barY, $barWidth, $barHeight, 'F');

    // Rangos de desempeño
    $pdf->SetFillColor(100, 130, 170);
    $pdf->Rect($barX, $barY, 50, $barHeight, 'F'); // 700-999
    $pdf->SetFillColor(50, 100, 160);
    $pdf->Rect($barX + 50, $barY, 40, $barHeight, 'F'); // 1000-1149
    $pdf->SetFillColor(0, 70, 130);
    $pdf->Rect($barX + 90, $barY, 30, $barHeight, 'F'); // 1150-1300

    // Texto rangos arriba
    $pdf->SetFont('Arial', '', 8);
    $pdf->SetTextColor(50, 70, 100);
    $pdf->SetXY($barX, $barY - 14);
    $pdf->Cell(50, 14, utf8_decode("Aún no\nsatisfactorio\n700-999"), 0, 0, 'C');
    $pdf->Cell(40, 14, utf8_decode("Satisfactorio\n1000-1149"), 0, 0, 'C');
    $pdf->Cell(30, 14, utf8_decode("Sobresaliente\n1150-1300"), 0, 1, 'C');

    // Marcador puntaje
    $posX = $barX + (($puntajeArea - 700) / 600) * $barWidth;
    $pdf->SetFillColor(255, 190, 0);
    $pdf->Rect($posX - 1.5, $barY - 3, 3, $barHeight + 6, 'F');

    $pdf->Ln(18);

    // ===== BARRA DE PUNTAJE REDONDA Y CENTRADA =====
$barTextWidth = 80;
$barTextHeight = 20;
$centerX = ($pdf->GetPageWidth() - $barTextWidth) / 2;
$barY = $pdf->GetY();

$pdf->SetFillColor(0, 75, 130);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', 'B', 10);

$pdf->RoundedRect($centerX, $barY, $barTextWidth, $barTextHeight, 3, 'DF');

// Posicionar texto centrado dentro de la barra
$pdf->SetXY($centerX, $barY + 4);
$pdf->MultiCell($barTextWidth, 6, utf8_decode("Tu puntaje en Índice Ceneval\n" . round($puntajeArea)), 0, 'C');

// Moverse justo después de la barra, sin espacio extra
$pdf->SetY($barY + $barTextHeight + 3);

    // ===== DETERMINAR NIVEL DINÁMICO =====
    if ($puntajeArea >= 1150) {
        $nivelActual = utf8_decode('Sobresaliente');
    } elseif ($puntajeArea >= 1000) {
        $nivelActual = utf8_decode('Satisfactorio');
    } else {
        $nivelActual = utf8_decode('Aún no satisfactorio');
    }

    // ===== TABLA DE NIVELES =====
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetFillColor(0, 65, 105);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(80, 18, utf8_decode('NIVEL DE DESEMPEÑO'), 1, 0, 'C', true);

    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(110, 18, $nivelActual, 1, 1, 'C', true);

    // Descripción de niveles
    $pdf->SetFont('Arial', 'B', 8);

    $nivelesDesc = [
        "Aún no satisfactorio" => "El sustentante ubicado en este nivel aún está en proceso de consolidar lo manifestado en el nivel de desempeño Satisfactorio.",
        "Satisfactorio" => "El sustentante con un nivel de desempeño Satisfactorio es capaz de aplicar estructuras de datos lineales, analizar algoritmos con base en matemáticas discretas y lógica computacional; asimismo, puede valorar la integración de estos elementos para la solución de problemas.",
        "Sobresaliente" => "Además de lo señalado en el nivel Satisfactorio, el sustentante con nivel Sobresaliente es capaz de analizar problemas complejos, estructuras de datos no lineales, lógica de predicados y complejidad algorítmica en escenarios específicos."
    ];

    foreach ($nivelesDesc as $nivel => $desc) {
        $pdf->SetFillColor(($nivel == $nivelActual) ? 230 : 255, 230, 230);
        $pdf->MultiCell(190, 9, utf8_decode("$nivel:\n$desc"), 1, 'L');
        $pdf->Ln(2);
    }
}
            return $pdf->Output('I', 'reporte_egel.pdf');
        }
    }