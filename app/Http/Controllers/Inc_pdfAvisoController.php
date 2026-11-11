<?php

namespace App\Http\Controllers;

use Codedge\Fpdf\Fpdf\Fpdf as FPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class PDF extends FPDF
{

    //CABECERA DE LA PAGINA
    function Header()
    {

        $this->Image('img/nuevo/log_tesvb.png',10,5,200,18);
        $this->Image('img/nuevo/colibri.png',15,45,190,220);
        $this->SetFont('Arial','B',7);

        ///$this->Ln();
    }
    //PIE DE PAGINA
    function Footer()
    {
        $this->SetXY(60,200);
        $this->SetFillColor(120,120,120);
        $this->Ln(65);
        $this->SetFont('Arial','',7);
        $this->Cell(180,4,utf8_decode('Km. 30 de la carretera federal Monumento-Valle de Bravo, Ejido de San Antonio de la Laguna,C.P. 51200, Valle de Bravo, Estado de México.'),0,1,'C',false);
        $this->SetFont('Arial','',7);
        $this->SetFont('Arial','',7);
        $this->Cell(200,4,utf8_decode('Página web: htps://tesvb.edomex.gob.mx/'),0,0,'C',false);
    }

}
class Inc_pdfAvisoController extends Controller
{
    public function index($id_solicitud){

        $solicitud=DB::selectOne('SELECT inc_solicitudes.*, abreviaciones.titulo, gnral_personales.nombre,gnral_personales.id_cargo,gnral_personales.id_personal,gnral_personales.numero_empleado
        from inc_solicitudes,gnral_personales, abreviaciones_prof, abreviaciones where inc_solicitudes.id_personal = gnral_personales.id_personal 
        and gnral_personales.id_personal = abreviaciones_prof.id_personal and abreviaciones_prof.id_abreviacion=abreviaciones.id_abreviacion and
        inc_solicitudes.id_solicitud='.$id_solicitud.'');


        $categoria=DB::selectOne('SELECT * FROM `gnral_cargos` WHERE `id_cargo` = '.$solicitud->id_cargo.'');



            $jefe=DB::selectOne('SELECT gnral_unidad_administrativa.id_unidad_admin,gnral_unidad_administrativa.nom_departamento,gnral_personales.nombre, abreviaciones.titulo 
            FROM gnral_unidad_personal,gnral_unidad_administrativa, gnral_personales, abreviaciones_prof, abreviaciones 
            WHERE gnral_unidad_personal.id_personal = '.$solicitud->id_jefe.' and gnral_unidad_personal.id_unidad_admin = gnral_unidad_administrativa.id_unidad_admin 
            and gnral_unidad_personal.id_personal = gnral_personales.id_personal AND gnral_personales.id_personal = abreviaciones_prof.id_personal 
              and abreviaciones_prof.id_abreviacion = abreviaciones.id_abreviacion');

            $id_unidad_admin=$jefe->id_unidad_admin;

            if($id_unidad_admin == 6 || $id_unidad_admin == 7 || $id_unidad_admin == 8
                || $id_unidad_admin == 9 || $id_unidad_admin == 10 || $id_unidad_admin == 11 || $id_unidad_admin == 12
                || $id_unidad_admin == 29 || $id_unidad_admin == 33 || $id_unidad_admin == 41)
            {
                $departamento="JEFATURA DE ".$jefe->nom_departamento;
                $nombre_jefe=$jefe->titulo." ".$jefe->nombre;
            }
            else{
                $departamento=$jefe->nom_departamento;
                $nombre_jefe=$jefe->titulo." ".$jefe->nombre;
            }
            $fecha_requerida=$solicitud->fecha_req;








        $pdf=new PDF($orientation='P',$unit='mm',$format='Letter');
        #Establecemos los márgenes izquierda, arriba y derecha:
        $pdf->SetMargins(20, 25 , 20);
        $pdf->SetAutoPageBreak(true,25);
        $pdf->AddPage();
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetLineWidth(0.2);
        $pdf->SetFont('Arial','B','12');
        $pdf->Ln(3);
        $pdf->Cell(180,5,utf8_decode("AVISO DE JUSTIFICACIÓN DE INCIDENCIAS EN LA PUNTUALIDAD Y ASISTENCIA"),1,1,'C');
        $pdf->Cell(180,2,utf8_decode(""),0,1,'C');
        $pdf->SetFont('Arial','B','8');
        $pdf->Cell(130,5,utf8_decode("NOMBRE DEL SERVIDOR PÚBLICO"),'LTR',0,'C');
        $pdf->Cell(50,5,utf8_decode("NO. DE EMPLEADO"),'LTR',1,'C');
        $pdf->SetFont('Arial','','11');
        $pdf->SetFont('Arial','','8');
        $pdf->SetXY(20,40);
        $pdf->Cell(130,10,utf8_decode($solicitud->titulo." ".$solicitud->nombre),"LBR",0,'C');
        $pdf->Cell(50,10,utf8_decode($solicitud->numero_empleado),"LBR",1,'C');
        $pdf->SetFont('Arial','','8');

        $pdf->Ln(1);
        $pdf->SetFont('Arial','B','8');
        $pdf->Cell(90,5,utf8_decode("ÁREA DE ADSCRIPCIÓN"),'LTR',0,'C');
        $pdf->Cell(90,5,utf8_decode("CATEGORÍA"),'LTR',1,'C');
        $pdf->SetFont('Arial','','8');
        $pdf->Cell(90,10,utf8_decode(""),'LBR',0,'C');
        $pdf->Cell(90,10,utf8_decode($categoria->cargo),'LBR',1,'C');
        $pdf->SetFont('Arial','B','8');
        $pdf->Cell(90,5,utf8_decode("FECHA DEL PERMISO"),'LTR',0,'C');
        $pdf->Cell(90,5,utf8_decode("HORARIO DEL PERMISO"),'LTR',1,'C');
        $pdf->SetFont('Arial','','8');
        $pdf->Cell(90,10,utf8_decode($fecha_requerida),'LBR',0,'C');
        $pdf->Cell(90,10,utf8_decode($solicitud->hora_e1." - ".$solicitud->hora_s1),'LBR',1,'C');
        if(!empty($solicitud->hora_e2) && !empty($solicitud->hora_s2)){
        $pdf->Cell(90,10,utf8_decode($solicitud->hora_e2." - ".$solicitud->hora_s2),'LBR',1,'C');
        }

        $pdf->Ln(1);

        $pdf->Cell(180,8,utf8_decode("POR AUTORIZACIÓN DE LA JEFA (E) INMEDIATO (Desde jefa o Jefe de Departamento)"),'1',1,'L');
        $pdf->SetFont('Arial','','8');
        $pdf->SetXY(20,95);
        $pdf->Cell(90,17,utf8_decode(""),1,0,'C');
        $pdf->Cell(90,17,utf8_decode(""),1,0,'C');
        $pdf->SetXY(22,97);
        $pdf->Cell(6,6,utf8_decode(""),1,0,'C');
        $pdf->SetXY(20,95);
        $pdf->Cell(10,5,utf8_decode(""),0,0,'C');
        $pdf->MultiCell(80,5,utf8_decode("Día económico (con fundamento en el Artículo 68 para  personal no sindicalizado y Cláusula 44 del para personal sindicalizado con previa solicitud)"),0,'J');
        $pdf->SetXY(113,97);
        $pdf->Cell(6,6,utf8_decode(""),1,0,'C');
        $pdf->SetXY(120,95);
        $pdf->MultiCell(80,5,utf8_decode("Media Jornada (con fundamento en el Artículo 68 para personal no sindicalizado y Cláusula 44 para personal sindicalizado con previa solicitud)"),0,'J');


        $pdf->SetXY(20,112);
        $pdf->Cell(90,17,utf8_decode(""),1,0,'C');
        $pdf->Cell(90,17,utf8_decode(""),1,0,'C');
        $pdf->SetXY(22,114);
        $pdf->Cell(6,6,utf8_decode(""),1,0,'C');

        $pdf->SetXY(30,112);
        $pdf->MultiCell(80,5,utf8_decode("Oficio  de comisión (generado en el Sistema de Gestión Institucional debidamente firmado)"),0,'J');

        $pdf->SetXY(113,114);
        $pdf->Cell(6,6,utf8_decode(""),1,0,'C');
        $pdf->SetXY(120,112);
        $pdf->MultiCell(80,5,utf8_decode("Licencia sin goce de sueldo (con fundamento en el Artículo 61 para personal sindicalizado y no sindicalizado, con previa solicitud"),0,'J');

        $pdf->SetXY(20,129);
        $pdf->Cell(90,12,utf8_decode(""),1,0,'C');
        $pdf->Cell(90,12,utf8_decode(""),1,0,'C');
        $pdf->SetXY(22,130);
        $pdf->Cell(6,6,utf8_decode(""),1,0,'C');
        $pdf->SetXY(30,128);
        $pdf->MultiCell(80,5,utf8_decode("Artículo 73 (para personal sindicalizado y no sindicalizado, con previa solicitud)"),0,'J');
        $pdf->SetXY(113,130);
        $pdf->Cell(6,6,utf8_decode(""),1,0,'C');
        $pdf->SetXY(120,128);
        $pdf->MultiCell(80,5,utf8_decode("Artículo 75 (para personal sindicalizado y no sindicalizado, con previa solicitud)"),0,'J');

        $pdf->SetXY(20,141);
        $pdf->Cell(90,12,utf8_decode(""),1,0,'C');
        $pdf->Cell(90,12,utf8_decode(""),1,0,'C');
        $pdf->SetXY(22,142);
        $pdf->Cell(6,6,utf8_decode(""),1,0,'C');
        $pdf->SetXY(30,140);
        $pdf->MultiCell(80,5,utf8_decode("Artículo 64 (para personal sindicalizado y no sindicalizado, máximo 5 días posteriores a la incidencia para justificar)"),0,'J');
        $pdf->SetXY(113,142);
        $pdf->Cell(6,6,utf8_decode(""),1,0,'C');
        $pdf->SetXY(120,140);
        $pdf->MultiCell(80,5,utf8_decode("Artículo 69 (para personal sindicalizado y no sindicalizado, máximo 5 días posteriores a la incidencia para justificar)"),0,'J');

        $pdf->Ln(5);

        $pdf->Cell(180,6,utf8_decode("LICENCIAS MÉDICAS (Documentación comprobatoria expedida por el ISSEMMYM)"),'1',1,'L');
        $pdf->SetXY(20,161);
        $pdf->Cell(90,10,utf8_decode(""),1,0,'C');
        $pdf->Cell(90,10,utf8_decode(""),1,0,'C');
        $pdf->SetXY(22,163);
        $pdf->Cell(6,6,utf8_decode(""),1,0,'C');
        $pdf->SetXY(30,163);
        $pdf->Cell(80,5,utf8_decode("Incapacidad (firmada y sella por el ISSEMYM)"),0,0,'L');

        $pdf->SetXY(112,163);
        $pdf->Cell(6,6,utf8_decode(""),1,0,'C');
        $pdf->SetXY(120,162);
        $pdf->MultiCell(80,4,utf8_decode("Constancia de Permanencia (firmada y sellada por el ISSEMYM)"),0,'J');

        $pdf->SetXY(20,171);
        $pdf->Cell(90,10,utf8_decode(""),1,0,'C');
        $pdf->Cell(90,10,utf8_decode(""),1,0,'C');
        $pdf->SetXY(22,173);
        $pdf->Cell(6,6,utf8_decode(""),1,0,'C');
        $pdf->SetXY(30,173);
        $pdf->MultiCell(80,5,utf8_decode("Certificado de Cuidados (firmado y sellado por el ISSEMYM)"),0,'J');

        $pdf->SetXY(112,173);
        $pdf->Cell(6,6,utf8_decode(""),1,0,'C');
        $pdf->SetXY(120,173);
        $pdf->Cell(80,5,utf8_decode("Lactancia (firmada y sellada por el ISSEMYM)"),0,0,'L');

        $pdf->Ln(10);
        $pdf->Cell(180,5,utf8_decode("LICENCIAS PERSONALES (Requiere copia según sea el caso)"),'1',1,'L');

        $pdf->SetXY(20,188);
        $pdf->Cell(90,10,utf8_decode(""),1,0,'C');
        $pdf->Cell(90,10,utf8_decode(""),1,0,'C');
        $pdf->SetXY(22,190);
        $pdf->Cell(6,6,utf8_decode(""),1,0,'C');
        $pdf->SetXY(30,190);
        $pdf->MultiCell(80,5,utf8_decode("Por contraer nupcias (presentar copia de acta de matrimonio)"),0,'J');

        $pdf->SetXY(112,190);
        $pdf->Cell(6,6,utf8_decode(""),1,0,'C');
        $pdf->SetXY(120,188);
        $pdf->MultiCell(80,5,utf8_decode("Por nacimiento o adopción (presentar certificado según corresponda)"),0,"j");

        $pdf->SetXY(20,198);
        $pdf->Cell(90,10,utf8_decode(""),1,0,'C');
        $pdf->Cell(90,10,utf8_decode(""),1,0,'C');
        $pdf->SetXY(22,200);
        $pdf->Cell(6,6,utf8_decode(""),1,0,'C');
        $pdf->SetXY(30,198);
        $pdf->MultiCell(80,5,utf8_decode("Exámen Profesional (presentar copia de documento oficial con fecha de exámen)"),0,'J');

        $pdf->SetXY(112,200);
        $pdf->Cell(6,6,utf8_decode(""),1,0,'C');
        $pdf->SetXY(120,198);
        $pdf->MultiCell(80,5,utf8_decode("Por fallecimiento de un familiar (presentar copia de acta de defunción)"),0,'J');
        $pdf->Cell(180,5,utf8_decode("OTRO: "),1,1,'L');
        $pdf->SetFont('Arial','B','8');
        $pdf->Cell(90,5,utf8_decode("ELABORA"),0,0,'C');
        $pdf->Cell(90,5,utf8_decode("ENTERADO"),0,1,'C');
        $pdf->Cell(90,15,utf8_decode(""),0,0,'C');
        $pdf->Cell(90,15,utf8_decode(""),0,1,'C');
        $pdf->SetFont('Arial','','7');

        $pdf->Cell(20,5,utf8_decode(""),0,0,'C');
        $pdf->Cell(50,5,utf8_decode("SERVIDORA (OR) PÚBLICO"),"T",0,'C');
        $pdf->Cell(20,5,utf8_decode(""),0,0,'C');
        $pdf->Cell(20,5,utf8_decode(""),0,0,'C');
        $pdf->Cell(50,5,utf8_decode("JEFA (E) INMEDIATO"),"T",0,'C');
        $pdf->Cell(20,5,utf8_decode(""),0,0,'C');

        $pdf->SetXY(20,228);
        $pdf->SetFont('Arial','','7');
        $pdf->Cell(90,5,utf8_decode($solicitud->titulo." ".$solicitud->nombre),0,0,'C');
        $pdf->Cell(90,5,utf8_decode($nombre_jefe),0,0,'C');

        $pdf->SetXY(20,213);
        $pdf->Cell(90,27,utf8_decode(""),1,0,'C');
        $pdf->Cell(90,27,utf8_decode(""),1,0,'C');

        $pdf->SetXY(20,61);
        $pdf->SetFont('Arial','','8');
        $pdf->MultiCell(90,5,utf8_decode($departamento),0,'C');

        $pdf->Ln(3);
        $pdf->Output();
        exit();
    }
}
