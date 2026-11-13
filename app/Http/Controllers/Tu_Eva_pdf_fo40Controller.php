<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf as FPDF;
use Illuminate\Support\Facades\DB;
use Session;
use Storage;

class PDF_Tu_Eva_pdf_fo40Controller extends FPDF
{

    //CABECERA DE LA PAGINA
    function Header()
    {
        $this->Image('img/tes.png', 120, 5, 40);
        $this->SetXY(0,20);
        $this->SetFont('Arial','B',8);
        $this->Ln(2);
        $this->Cell(240,5,utf8_decode('TECNOLÓGICO DE ESTUDIOS SUPERIORES DE VALLE DE BRAVO'),0,0,'C');

        /*
        $this->Image('img/logos/marcaagua.png',0,-15,210,290);
        $this->SetFont('Arial','B',7);
        $this->SetXY(0,0);
        $this->Ln(5);
        $this->Cell(50);
        $this->Cell(130,2,utf8_decode('Tecnológico de Estudios Superiores de Valle de Bravo'),0,0,'R');
        $this->Ln(3);
        $this->Cell(50);
        $this->Cell(130,2,utf8_decode('Dirección General'),0,0,'R');
        $this->Ln(3);
        $this->SetFont('Arial','',6.5);
        $this->Cell(50);
        $this->Cell(130,2,utf8_decode('Dirección Académica' ),0,0,'R');
        $this->Ln(3);
        $this->Cell(50);
        $this->Cell(130,2,utf8_decode('Desarrollo Académico'),0,0,'R');

        $this->Ln(10);
        */
    }
    //PIE DE PAGINA
    function Footer()
    {
        $this->SetY(-35);


        // $this->Image('img/sga.PNG',65,240,20);
        $this->Ln(18);
        $this->Cell(50);
        $this->SetFont('Arial','B',8);
        $this->Cell(200,-2,utf8_decode('FO-TESVB-40 V.0 25/06/2020'),0,0,'R');



        // $this->Image('img/pie/logos_iso.jpg',40,245,58);
        // $this->Image('img/sgc.PNG',40,240,20);
        // $this->Image('img/tutorias/cir.jpg',89,239,20);
        //  $this->Image('img/sga.PNG',65,240,20);
        /*
        $this->SetFont('Arial','B',8);
        $this->Ln(1);
        // $this->Cell(50);
        $this->Cell(190,-2,utf8_decode('FO-TESVB-40 V.0 25/06/2020'),0,0,'R');
        $this->SetXY(0,262);
        $this->SetFillColor(120,120,120);
        // $this->SetTextColor(255,255,255);
        $this->SetFont('Arial','',7);
        $this->Cell(200,4,utf8_decode('Km. 30 de la Carretera Federal Monumento-Valle de Bravo, Ejido de San Antonio de la Laguna'),0,1,'C',false);
        $this->SetXY(0,266);
        $this->SetFont('Arial','',7);
        $this->Cell(200,4,utf8_decode('C.P. 51200, Valle de Bravo, Estado de México.'),0,1,'C',false);
        $this->SetXY(0,270);
        $this->SetFont('Arial','',7);
        $this->Cell(200,4,utf8_decode('     Tels.: (726) 266 52 00, 266 51 87      des.academico@vbravo.tecnm.mx'),0,0,'C',false);

*/
    }

}
class Tu_Eva_pdf_fo40Controller extends Controller
{
    public function imprime($periodo)
    {
        $datos = DB::select(' select gc.nombre carrera,gp.nombre nombre,
                                                   (case
                                                       when f.se1 = 1 then \'Cumplió\'
                                                       when f.se1 = 2 then \'No cumplió\'
                                                       when f.se1 = 3 then \'Avance 75%\'
                                                       when f.se1 = 4 then \'Avance 50%\'
                                                       when f.se1 = 5 then \'Avance 25%\'
                                                    end) se1,
                                                    (case
                                                       when f.se2 = 1 then \'Cumplió\'
                                                       when f.se2 = 2 then \'No cumplió\'
                                                       when f.se2 = 3 then \'Avance 75%\'
                                                       when f.se2 = 4 then \'Avance 50%\'
                                                       when f.se2 = 5 then \'Avance 25%\'
                                                    end) se2,
                                                    concat(f.com,\'  \',f.com2) com ,res1,res2
                                            from tu_eva_fo40 f
                                            inner join exp_asigna_coordinador eac on f.id_asigna_coordinador = eac.id_asigna_coordinador
                                            inner join gnral_personales gp on eac.id_personal = gp.id_personal
                                            inner join gnral_jefes_periodos gjp on eac.id_jefe_periodo = gjp.id_jefe_periodo
                                            inner join gnral_carreras gc on gjp.id_carrera = gc.id_carrera
                                            where f.periodo =  ? ', [(string) ($periodo)]);
        $corIn = DB::selectOne(" select  concat(ap.titulo,' ',gp.nombre)   nom from gnral_personales gp
                                        inner join desarrollo_asigna_coordinador_general dacg on gp.id_personal = dacg.id_personal
                                        inner join abreviaciones_prof apf on dacg.id_personal = apf.id_personal
                                        inner join abreviaciones ap on apf.id_abreviacion = ap.id_abreviacion");
        $etiqueta=DB::selectOne('SELECT * FROM etiqueta WHERE id_etiqueta = 1 ');
        $des = DB::selectOne("select concat(ap.titulo,' ',gp.nombre) nom from gnral_personales gp
                                           inner join abreviaciones_prof apf on gp.id_personal = apf.id_personal
                                           inner join abreviaciones ap on apf.id_abreviacion = ap.id_abreviacion
                                           where gp.tipo_usuario = 796");
        //dd($hola);
        //$condi=$request->get('condi');
        $pdf=new PDF_Tu_Eva_pdf_fo40Controller($orientation='L',$unit='mm',$format='Letter');
        #Establecemos los márgenes izquierda, arriba y derecha:
        //dd($request);

        //$nombre = 'Tutor: '.$datos_tutor->nombre;
        //dd($datos);
        $pdf->SetMargins(10, 30 , 10, 30);
        $pdf->SetAutoPageBreak(true,25);
        $pdf->AddPage();
        $pdf->SetDrawColor(164,164,164);
        $pdf->SetLineWidth(1.0);
        //$pdf->Line(231, 10, 231, 32);
        $pdf->SetFont('Arial','',9);
        $pdf->Ln(15);
        $pdf->Cell(240,5,utf8_decode('SEGUIMIENTO DEL COORDINADOR INSTITUCIONAL'),0,1,'C');
        $pdf->Ln();
        $pdf->Cell(75,5,utf8_decode('Programa de Estudio: '),1,0,'C');
        $pdf->Cell(65,5,utf8_decode('Nombre de Tutor(a): '),1,0,'C');
        $pdf->Cell(20,5,utf8_decode($datos[0]->res1),1,0,'C');
        $pdf->Cell(20,5,utf8_decode($datos[0]->res2),1,0,'C');
        $pdf->Cell(80,5,utf8_decode('Comentario'),1,1,'C');
        foreach ($datos as $dato) {
            $pdf->Cell(75,5,utf8_decode($dato->carrera),1,0,'C');
            $pdf->Cell(65,5,utf8_decode($dato->nombre),1,0,'C');
            $pdf->Cell(20,5,utf8_decode($dato->se1),1,0,'C');
            $pdf->Cell(20,5,utf8_decode($dato->se2),1,0,'C');
            $pdf->Cell(80,5,utf8_decode($dato->com),1,1,'C');
        }
        $pdf->SetFont('Arial','',7);
        $pdf->Ln(50);
        $pdf->Cell(30,5,utf8_decode(''),0,0,'C');
        $pdf->Cell(100,5,utf8_decode('Realizó'),0,0,'C');
        $pdf->Cell(100,5,utf8_decode('Vo. Bo.'),0,0,'C');
        $pdf->Ln(20);
        $pdf->Cell(30,5,utf8_decode(''),0,0,'C');
        $pdf->Cell(100,5,utf8_decode('_____________________________________________'),0,0,'C');
        $pdf->Cell(100,5,utf8_decode('_____________________________________________'),0,0,'C');
        $pdf->Ln(5);
        $pdf->Cell(30,5,utf8_decode(''),0,0,'C');
        $pdf->Cell(100,5,utf8_decode($corIn->nom),0,0,'C');
        $pdf->Cell(100,5,utf8_decode($des->nom),0,0,'C');
        $pdf->Ln(5);
        $pdf->Cell(30,5,utf8_decode(''),0,0,'C');
        $pdf->Cell(100,5,utf8_decode('Firma del Coordinador Institucional'),0,0,'C');
        $pdf->Cell(100,5,utf8_decode('Firma de Jefe(a) de Departamento de Desarrollo Académico'),0,0,'C');

        $pdf->Output();
        exit();
    }
    public function p1($periodo)
    {
        $datos = DB::select(' select gc.nombre carrera,gp.nombre nombre,
                                                   (case
                                                       when f.se1 = 1 then \'Cumplió\'
                                                       when f.se1 = 2 then \'No cumplió\'
                                                       when f.se1 = 3 then \'Avance 75%\'
                                                       when f.se1 = 4 then \'Avance 50%\'
                                                       when f.se1 = 5 then \'Avance 25%\'
                                                    end) se1,
                                                    concat(f.com) com ,res1,res2
                                            from tu_eva_fo40 f
                                            inner join exp_asigna_coordinador eac on f.id_asigna_coordinador = eac.id_asigna_coordinador
                                            inner join gnral_personales gp on eac.id_personal = gp.id_personal
                                            inner join gnral_jefes_periodos gjp on eac.id_jefe_periodo = gjp.id_jefe_periodo
                                            inner join gnral_carreras gc on gjp.id_carrera = gc.id_carrera
                                            where f.periodo =  ? ', [(string) ($periodo)]);

        $corIn = DB::selectOne(" select  concat(ap.titulo,' ',gp.nombre)   nom from gnral_personales gp
                                        inner join desarrollo_asigna_coordinador_general dacg on gp.id_personal = dacg.id_personal
                                        inner join abreviaciones_prof apf on dacg.id_personal = apf.id_personal
                                        inner join abreviaciones ap on apf.id_abreviacion = ap.id_abreviacion");
        $etiqueta=DB::selectOne('SELECT * FROM etiqueta WHERE id_etiqueta = 1 ');
        $des = DB::selectOne("select concat(ap.titulo,' ',gp.nombre) nom from gnral_personales gp
                                           inner join abreviaciones_prof apf on gp.id_personal = apf.id_personal
                                           inner join abreviaciones ap on apf.id_abreviacion = ap.id_abreviacion
                                           where gp.tipo_usuario = 796");
        //dd($hola);
        //$condi=$request->get('condi');
        $pdf=new PDF_Tu_Eva_pdf_fo40Controller($orientation='L',$unit='mm',$format='Letter');
        #Establecemos los márgenes izquierda, arriba y derecha:
        //dd($request);

        //$nombre = 'Tutor: '.$datos_tutor->nombre;
        //dd($datos);
        $pdf->SetMargins(20, 30 , 10, 30);
        $pdf->SetAutoPageBreak(true,25);
        $pdf->AddPage();
        $pdf->SetDrawColor(164,164,164);
        $pdf->SetLineWidth(1.0);
        //$pdf->Line(241, 10, 231, 32);
        $pdf->SetFont('Arial','',8);
        $pdf->Ln(15);
        $pdf->Cell(240,5,utf8_decode('SEGUIMIENTO DEL COORDINADOR INSTITUCIONAL'),0,1,'C');
        $pdf->Ln();
        $pdf->Cell(70,5,utf8_decode('Programa de Estudio: '),1,0,'C');
        $pdf->Cell(75,5,utf8_decode('Nombre de Tutor(a): '),1,0,'C');
        $pdf->Cell(20,5,utf8_decode($datos[0]->res1),1,0,'C');
        //$pdf->Cell(20,5,utf8_decode($datos[0]->res2),1,0,'C');
        $pdf->Cell(80,5,utf8_decode('Comentario'),1,1,'C');
        foreach ($datos as $dato) {
            $pdf->Cell(70,5,utf8_decode($dato->carrera),1,0,'C');
            $pdf->Cell(75,5,utf8_decode($dato->nombre),1,0,'C');
            $pdf->Cell(20,5,utf8_decode($dato->se1),1,0,'C');
            $pdf->Cell(80,5,utf8_decode($dato->com),1,1,'C');
        }
        $pdf->SetMargins(10, 30 , 10, 30);

        $pdf->Ln(50);
        $pdf->Cell(40,5,utf8_decode(''),0,0,'C');
        $pdf->Cell(100,5,utf8_decode('Realizó'),0,0,'C');
        $pdf->Cell(100,5,utf8_decode('Vo. Bo.'),0,0,'C');
        $pdf->Ln(20);
        $pdf->Cell(40,5,utf8_decode(''),0,0,'C');
        $pdf->Cell(100,5,utf8_decode('_____________________________________________'),0,0,'C');
        $pdf->Cell(100,5,utf8_decode('_____________________________________________'),0,0,'C');
        $pdf->Ln(5);
        $pdf->Cell(40,5,utf8_decode(''),0,0,'C');
        $pdf->Cell(100,5,utf8_decode($corIn->nom),0,0,'C');
        $pdf->Cell(100,5,utf8_decode($des->nom),0,0,'C');
        $pdf->Ln(5);
        $pdf->Cell(40,5,utf8_decode(''),0,0,'C');
        $pdf->Cell(100,5,utf8_decode('Firma del Coordinador Institucional'),0,0,'C');
        $pdf->Cell(100,5,utf8_decode('Firma de Jefe(a) del Departamento de Desarrollo Académico'),0,0,'C');

        $pdf->Output();
        exit();
    }
}
