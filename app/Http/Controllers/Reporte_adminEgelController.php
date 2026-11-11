<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Libraries\PdfExtend;
use Carbon\Carbon;

class Reporte_adminEgelController extends Controller
{
    public function generar()
    {

        $fecha_aplicacion = DB::select('SELECT * FROM egel_periodo_examen');

        /*$total_alumno = DB::table('gnral_alumnos as a')
    ->join('egel_resultados as r', 'a.id_alumno', '=', 'r.id_alumno')
    ->join('egel_examenes as e', 'r.id_examen_egel', '=', 'e.id_examen_egel')
    ->select('a.id_carrera', DB::raw('COUNT(DISTINCT a.id_alumno) as total_alumnos'))
    ->whereIn('a.id_carrera', [6, 8])
    ->where('e.estado', 1)
    ->groupBy('a.id_carrera')
    ->get();*/

    $total_alumno = DB::table('gnral_alumnos as a')
    ->join('gnral_carreras as c', 'a.id_carrera', '=', 'c.id_carrera')
    ->join('egel_resultados as r', 'a.id_alumno', '=', 'r.id_alumno')
    ->join('egel_examenes as e', 'r.id_examen_egel', '=', 'e.id_examen_egel')
    ->whereIn('a.id_carrera', [6,8])
    ->where('e.estado', 1)
    ->groupBy('a.id_carrera', 'c.nombre')
    ->selectRaw('
        a.id_carrera,
        c.nombre,
        COUNT(DISTINCT a.id_alumno) as total_alumnos
    ')
    ->get();

dd($total_alumno);
$carrera = DB::table('gnral_carreras')
    ->whereIn('id_carrera', [6, 8])
    ->get();

$id_examen_egel = DB::table('egel_examenes')
    ->where('estado', 1)
    ->whereIn('id_carrera', [6, 8])
    ->select('id_carrera', 'id_examen_egel')
    ->get()
    ->groupBy('id_carrera');

if (!$id_examen_egel) {
    abort(403, 'Examen no encontrado');
}

        $carrera_param = request('carrera');

$nombreCarrera = ($carrera_param == 'turismo') 
    ? 'turismo' 
    : 'forestal';
        // =========================
        // PDF CON FOOTER DINÁMICO (CORRECTO)
        // =========================
        $pdf = new class($nombreCarrera) extends PdfExtend {

            private $carreraNombreFooter;

            public function __construct($carreraNombre)
            {
                parent::__construct('L', 'mm', 'A4');
                $this->carreraNombreFooter = $carreraNombre;

                $this->AddPage();
                $this->SetAutoPageBreak(false);
            }

            public function Footer()
            {
                $this->SetY(-20);
                $this->SetFont('Arial', '', 8);
                $this->SetTextColor(7, 80, 139);

                $footerText = utf8_decode(
                    "Av. Camino al Desierto de los Leones 19, Col. San Ángel, Alcaldía Álvaro Obregón\n" .
                    "C.P. 01000, Ciudad de México, Tel: 55 5322 9200\n" .
                    "www.ceneval.edu.mx"
                );

                $this->MultiCell(140, 4, $footerText, 0, 'R');

                // Logos por carrera
                $logos = [
                    'turismo' => 'img/turismo.png',
                    'forestal' => 'img/forestal.png',
                ];

                foreach ($logos as $key => $ruta) {
                    if (stripos($this->carreraNombreFooter, $key) !== false) {

                        $logoFooter = public_path($ruta);

                        if (file_exists($logoFooter)) {
                            $this->Image($logoFooter, 250, 190, 25, 15);
                        }

                        break;
                    }
                }

                $this->SetDrawColor(10, 90, 110);
                $this->SetLineWidth(0.5);
                $this->Line(5, 190, 292, 190);
            }
        };

        // =========================
        // LOGO Y ENCABEZADO PRINCIPAL
        // =========================
        $pdf->Image(public_path('img/TESVB.png'), 7, 5, 45, 25);

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetTextColor(0, 102, 153);
        $pdf->MultiCell(0, 10, utf8_decode("Examen General de Conocimientos para el Egreso (EGEL)"), 0, 'R');

        // =========================
        // TITULO
        // =========================
        $azulOscuro = [10, 52, 87];

        $pdf->SetFillColor(...$azulOscuro);
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetXY(5, 35);

        $pdf->MultiCell(287,8,utf8_decode("REPORTE DE RESULTADOS POR SEDE DE REGISTRO\nORDENAMIENTO DESCENDENTE"),1,'C',true);

        // =========================
        // DATOS GENERALES
        // =========================
        $pdf->SetTextColor(7, 80, 139);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetXY(5, 50);

        $pdf->Cell(250, 6, utf8_decode('Institución: TECNOLÓGICO DE ESTUDIOS SUPERIORES DE VALLE DE BRAVO'), 0, 0, 'C');

        $pdf->SetXY(5, 55);
        $pdf->Cell(170, 6, utf8_decode('Entidad: ESTADO DE MÉXICO'), 0, 0, 'C');

        $pdf->SetXY(5, 60);
        $pdf->Cell(150, 6, utf8_decode('Clave de la Sede: 15EIT0013G'), 0, 0, 'C');

        $fecha = Carbon::parse($fecha_aplicacion[0]->fecha_inicio)
            ->locale('es')
            ->translatedFormat('d \\d\\e F \\d\\e Y');

        $pdf->SetXY(5, 65);
        $pdf->Cell(180, 6, utf8_decode('Fecha de aplicación: ' . $fecha), 0, 0, 'C');

        foreach ($total_alumno as $row) {
            $pdf->SetXY(5, 70);
            $pdf->Cell(175, 6, utf8_decode('No. de Sustentantes: ' . $row->total_alumnos), 0, 1, 'C');
        }

        // =========================
        // SEGUNDA PÁGINA
        // =========================
        $pdf->AddPage();

        $pdf->Image(public_path('img/TESVB.png'), 7, 5, 70, 25);

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetTextColor(0, 102, 153);
        $pdf->Cell(0, 10, utf8_decode('Examen General de Conocimientos'), 0, 1, 'R');

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 8, utf8_decode('Licenciatura en ' . $nombreCarrera), 0, 1, 'R');

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 8, utf8_decode('Ordenamiento Descendente'), 0, 1, 'C');

        # ==============================
# INFORMACIÓN GENERAL
# ==============================

$pdf->SetFont('Arial','',10);

// Línea 1: institución + fecha
$pdf->SetX(5);
$pdf->Cell(140,6,utf8_decode('Institución: TECNOLÓGICO DE ESTUDIOS SUPERIORES DE VALLE DE BRAVO'),0,0,'L');

$pdf->Cell(0,6,utf8_decode('Fecha de aplicación: '.$fecha),0,1,'R');

// Línea 2: sustentantes incluidos + excluidos
$pdf->SetX(5);

$total = $total_alumno[0]->total_alumnos;

$pdf->Cell(140,6,utf8_decode('Sustentantes incluidos en el reporte: '.$total),0,0,'L');

$pdf->Cell(0,6,utf8_decode('Sustentantes excluidos: 0'),0,1,'R');

        // =========================
        // TABLA
        // =========================
        $azul_oscuro = [0, 84, 130];
        $turquesa = [0, 150, 190];
        $vino = [165, 70, 110];
        $gris = [230, 230, 230];

        $w = [
            'no' => 7,
            'nombre' => 50,
            'folio' => 22,
            'global' => 25,
            'disc' => 23,
            'trans' => 23,
            'diseno' => 17,
            'const' => 17,
            'oper'=> 17,
            'test'=>17,
            'com' =>17,
            'red'=>17
        ];

        function pdfText($text)
        {
            return iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $text);
        }

        $header = function($pdf) use ($w, $azul_oscuro, $turquesa, $vino, $gris) {

           $pdf->SetLineWidth(0.2);

$pdf->SetFont('Arial','B',8);

// =========================
// DATOS ALUMNO
// =========================
$pdf->SetFillColor(...$azul_oscuro);
$pdf->SetTextColor(255,255,255);

$pdf->Cell(
    $w['no'] + $w['nombre'] + $w['folio'],
    9,
    pdfText("Datos del alumno"),
    0,
    0,
    'C',
    true
);

// =========================
// SECCIONES DEL EXAMEN
// =========================
$pdf->SetFillColor(...$turquesa);

$pdf->Cell(
    $w['global'] + $w['disc'] + $w['trans'],
    9,
    pdfText("Secciones del examen"),
    0,
    0,
    'C',
    true
);

// =========================
// SECCIÓN DISCIPLINAR
// =========================
$pdf->SetFillColor(...$vino);

$pdf->Cell(
    $w['diseno'] + $w['const'] + $w['oper'] + $w['test'],
    9,
    pdfText("Sección Disciplinar"),
    0,
    0,
    'C',
    true
);

// =========================
// TRANSVERSAL (SIN BORDES Y SIN ROMPER TABLA)
// =========================
$pdf->SetFillColor(...$gris);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',7);

$h = 4;

// primera línea
$pdf->Cell(
    $w['com'] + $w['red'],
    $h,
    pdfText("Sección Transversal de"),
    0,
    2,
    'C',
    true
);

// segunda línea
$pdf->Cell(
    $w['com'] + $w['red'],
    $h,
    pdfText("Lenguaje y Comunicación"),
    0,
    1,
    'C',
    true
);

// =========================
// ENCABEZADOS DE COLUMNAS (SIN BORDES)
// =========================
$pdf->SetFillColor(...$azul_oscuro);
$pdf->SetTextColor(255,255,255);

$pdf->Cell($w['no'], 9, pdfText('No.'), 0, 0, 'C', true);
$pdf->Cell($w['nombre'], 9, pdfText('Nombre'), 0, 0, 'C', true);
$pdf->Cell($w['folio'], 9, pdfText('Folio'), 0, 0, 'C', true);

// =========================
// GLOBAL
// =========================
$pdf->SetFillColor(...$turquesa);

$pdf->Cell($w['global'], 9, pdfText('Nivel global'), 0, 0, 'C', true);
$pdf->Cell($w['disc'], 9, pdfText('Disciplinar'), 0, 0, 'C', true);
$pdf->Cell($w['trans'], 9, pdfText('Transversal'), 0, 0, 'C', true);

// =========================
// DISCIPLINAR DETALLE
// =========================
$pdf->SetFillColor(...$vino);
$pdf->SetTextColor(255,255,255);

$pdf->Cell($w['diseno'], 9, pdfText('Diseño'), 0, 0, 'C', true);
$pdf->Cell($w['const'], 9, pdfText('Construcción'), 0, 0, 'C', true);
$pdf->Cell($w['oper'], 9, pdfText('Operación'), 0, 0, 'C', true);
$pdf->Cell($w['test'], 9, pdfText('Pruebas'), 0, 0, 'C', true);

// =========================
// TRANSVERSAL DETALLE
// =========================
$pdf->SetFillColor(...$gris);
$pdf->SetTextColor(0,0,0);

$pdf->Cell($w['com'], 9, pdfText('Comprensión'), 0, 0, 'C', true);
$pdf->Cell($w['red'], 9, pdfText('Redacción'), 0, 1, 'C', true);

$pdf->SetTextColor(0,0,0);
        };

        $header($pdf);

        // =========================
        // ALUMNOS
        // =========================
        /*$alumnos = DB::table('gnral_alumnos as a')
            ->join('egel_respuestas_alumno as ra','ra.id_alumno','=','a.id_alumno')
            ->leftJoin('egel_resultados as r','r.id_alumno','=','a.id_alumno')
            ->select('a.id_alumno','a.nombre','a.apaterno','a.amaterno','a.cuenta','r.nivel')
            ->distinct()
            ->get();*/

            $carrera_param = request('carrera');

            if ($carrera_param == 'forestal') {
                $id_carrera = 6;
            } elseif ($carrera_param == 'turismo') {
                $id_carrera = 8;
            } else {
                abort(404, 'Carrera no válida');
            }

            
    $modulosPorAlumno = DB::table('egel_respuestas_alumno as ra')
    ->join('egel_preguntas as p', 'p.id_pregunta', '=', 'ra.id_pregunta')
    ->join('egel_modulos as m', 'm.id_modulos', '=', 'p.id_modulos')
    ->select(
        'ra.id_alumno',
        'm.nombre as modulo',
        DB::raw('ROUND((SUM(ra.es_correcta = 1) / COUNT(*)) * 100, 2) as porcentaje')
    )
    ->groupBy('ra.id_alumno', 'm.id_modulos', 'm.nombre')
    ->get()
    ->groupBy('id_alumno'); 

$alumnos = DB::table('gnral_alumnos as a')
    ->where('a.id_carrera', $id_carrera)
    ->whereExists(function ($q) {
        $q->select(DB::raw(1))
          ->from('egel_respuestas_alumno as ra')
          ->whereColumn('ra.id_alumno', 'a.id_alumno')
          ->whereNotNull('ra.id_examen_egel');
    })
    ->whereExists(function ($q) {
        $q->select(DB::raw(1))
          ->from('egel_resultados as r')
          ->whereColumn('r.id_alumno', 'a.id_alumno')
          ->whereNotNull('r.nivel');
    })
    ->get();
//dd($alumnos);
        $contador = 1;

        foreach ($alumnos as $alumno) {

            if($pdf->GetY() > 170){
                $pdf->AddPage();
                $header($pdf);
            }

            $nombre = $alumno->nombre.' '.$alumno->apaterno.' '.$alumno->amaterno;
            $nivelGlobal = $alumno->nivel ?? 'Aún no satisfactorio';

            $pdf->SetFont('Arial','',8);

            $pdf->Cell($w['no'], 7, $contador, 1, 0, 'C');
            $pdf->Cell($w['nombre'], 7, pdfText($nombre), 1, 0);
            $pdf->Cell($w['folio'], 7, $alumno->cuenta, 1, 0, 'C');
            $pdf->Cell($w['global'], 7, pdfText($nivelGlobal), 1, 0, 'C');
            $mods = $modulosPorAlumno[$alumno->id_alumno] ?? collect([]);
// DISCIPLINAR (PROMEDIO DE MÓDULOS)
$disc = $mods->avg('porcentaje');
$pdf->Cell($w['disc'], 7, $disc ? round($disc,2).'%' : '', 1, 0, 'C');

// TRANSVERSAL (puedes dejarlo vacío o calcularlo después)
$pdf->Cell($w['trans'], 7, '', 1, 0, 'C');

// DETALLE POR MÓDULO (ORDENADOS)
$pdf->Cell($w['diseno'], 7, $mods->get(0)->porcentaje ?? '', 1, 0, 'C');
$pdf->Cell($w['const'], 7, $mods->get(1)->porcentaje ?? '', 1, 0, 'C');
$pdf->Cell($w['oper'], 7, $mods->get(2)->porcentaje ?? '', 1, 0, 'C');
$pdf->Cell($w['test'], 7, $mods->get(3)->porcentaje ?? '', 1, 0, 'C');

// TRANSVERSAL LENGUAJE (si luego quieres lo armamos por sección)
$pdf->Cell($w['com'], 7, '', 1, 0, 'C');
$pdf->Cell($w['red'], 7, '', 1, 1, 'C');

            $contador++;
        }

        return response($pdf->Output('S'), 200)
            ->header('Content-Type','application/pdf');
    }
}