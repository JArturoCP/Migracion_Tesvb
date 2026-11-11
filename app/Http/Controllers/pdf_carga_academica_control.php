<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf as FPDF;
use Illuminate\Support\Facades\DB;
use Session;


class PDF extends FPDF
{

    //CABECERA DE LA PAGINA
    function Header()
    {
        $this->Image('img/tes.png', 120, 5, 40);
        $this->SetXY(0,20);
        $this->SetFont('Arial','B',8);
        $this->Ln(2);
        $this->Cell(270,5,utf8_decode('TECNOLÓGICO DE ESTUDIOS SUPERIORES DE VALLE DE BRAVO'),0,0,'C');
        $this->Ln(4);
        $this->Ln(10);
    }
    //PIE DE PAGINA
    function Footer()
    {
        $this->SetY(-25);
        $this->SetFont('Arial','B',8);
        $this->Cell(100);
        $this->Cell(150,-2,utf8_decode('F39-PSGOE-07  V.1  14-12-2023'),0,0,'R');
    }

}


class pdf_carga_academica_control extends Controller
{
    public function index($id){
        //dd($id);
            $periodo=Session::get('periodo_actual');

            $pdf=new PDF($orientation='L',$unit='mm',$format='Letter');
            #Establecemos los márgenes izquierda, arriba y derecha:
            $etiqueta=DB::selectOne('SELECT * FROM etiqueta WHERE id_etiqueta = 1 ');
            $pdf->SetMargins(10, 20 , 0);
            $pdf->SetAutoPageBreak(true,25);
            $pdf->AddPage();
            $pdf->SetFont('Arial','','11');
            $pdf->Cell(80);
            ///$pdf->Cell(100,10,utf8_decode($etiqueta->descripcion),0,1,'C');
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',13);
            $pdf->Cell(80);
            $pdf->Cell(100,5,utf8_decode('Carga Académica'),0,1,'C');
            $pdf->Ln(8);

            $pdf->SetFont('Arial','B',10);

            $pdf->SetDrawColor(0,0,0);
            $pdf->SetLineWidth(0.5);
            $pdf->SetFillColor(166,166,166);
        $validaciones=DB::select('SELECT eva_validacion_de_cargas.estado_validacion, eva_validacion_de_cargas.id_alumno 
                                    FROM eva_validacion_de_cargas 
                                    WHERE eva_validacion_de_cargas.id_alumno='.$id.' 
                                    AND eva_validacion_de_cargas.id_periodo='.$periodo.'');
        //dd($validaciones);
        $id_usuario=($validaciones[0]->id_alumno);
            $datosalumno=DB::selectOne('SELECT * FROM `gnral_alumnos` WHERE id_alumno='.$id_usuario.'');
            $id_usuario=$datosalumno->id_alumno;
            $datosalumno=DB::selectOne('SELECT * FROM `gnral_alumnos` WHERE id_alumno='.$id_usuario.'');
            $carreralumno=DB::selectOne('SELECT gnral_carreras.nombre FROM gnral_carreras WHERE id_carrera='.$datosalumno->id_carrera.'');
            $periodoc=DB::selectOne('SELECT gnral_periodos.periodo FROM gnral_periodos WHERE id_periodo='.$periodo.'');
            $pdf->Cell(31,5,"CICLO ESCOLAR",1,'R',1,true);
            $pdf->SetFont('Arial','',9);
            $pdf->Cell(60,5,$periodoc->periodo,1);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(50,5,utf8_decode("PROGRAMA ACADÉMICO"),1,'R',0,true);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(120,5,utf8_decode($carreralumno->nombre),1);
            $pdf->Ln();
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(31,5,"No. DE CUENTA ",1,'R',0,true);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(60,5,$datosalumno->cuenta,1);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(50,5,"NOMBRE DEL ESTUDIANTE",1,'R',0,true);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(120,5,utf8_decode($datosalumno->nombre." ".$datosalumno->apaterno." ".$datosalumno->amaterno),1);
            $pdf->SetFont('Arial','B',10);
            $pdf->Ln(10);
            /////////////////////////////////////////////////datos
            $pdf->SetLineWidth(0.3);
        $pdf->SetY(70); /* Inicio */
        $pdf->MultiCell(30,5,utf8_decode("CLAVE DE LA MATERIA"),1,'L',true);
        $pdf->SetXY(40,70);
            $pdf->Cell(130,10,"NOMBRE DE LA MATERIA",1,0,'C',true);
            $pdf->Cell(24,10,"CREDITOS",1,0,'C',true);
            $pdf->SetXY(194,70);
            $pdf->MultiCell(31,5,utf8_decode("STATUS DE LA MATERIA"),1,'C',true);
        $pdf->SetXY(225,70);
            $pdf->Cell(25,10,"TIPO CURSO",1,0,'C',true);
            $pdf->Cell(20,10,"GRUPO",1,0,'C',true);


          ///////////////////////////
            //   $pdf->Ln();

            ////////////////////////////////////////consulta


            $consulta=DB::select('SELECT eva_carga_academica.id_carga_academica,gnral_materias.id_materia,gnral_materias.clave,gnral_materias.nombre,gnral_materias.id_semestre,gnral_materias.creditos,eva_status_materia.nombre_status,eva_tipo_curso.nombre_curso,eva_carga_academica.grupo
                                FROM
                                gnral_materias,eva_status_materia,eva_tipo_curso,gnral_grupos,eva_carga_academica,gnral_periodos,gnral_alumnos
                                WHERE eva_carga_academica.id_materia=gnral_materias.id_materia
                                AND eva_carga_academica.id_status_materia=eva_status_materia.id_status_materia
                                AND eva_carga_academica.id_tipo_curso=eva_tipo_curso.id_tipo_curso
                                AND eva_carga_academica.id_periodo=gnral_periodos.id_periodo
                                AND eva_carga_academica.grupo=gnral_grupos.id_grupo
                                AND eva_carga_academica.id_alumno=gnral_alumnos.id_alumno
                                AND gnral_periodos.id_periodo='.$periodo.'
                                AND eva_carga_academica.id_alumno='.$id_usuario.'');

        $suma=0;
        $suma_materias=0;
        $mater=0;
        foreach ($consulta as $cons){
            $mater ++;
            if($cons->id_materia != 2258) {
                $suma = $suma + $cons->creditos;
                $suma_materias++;
            }
        }
        /*
            $suma=DB::selectOne('select sum(gnral_materias.creditos)suma 
                            from gnral_materias,eva_status_materia,eva_tipo_curso,gnral_grupos,eva_carga_academica,gnral_periodos,gnral_alumnos 
                            where eva_carga_academica.id_materia=gnral_materias.id_materia 
                            and eva_carga_academica.id_status_materia=eva_status_materia.id_status_materia 
                            and eva_carga_academica.id_tipo_curso=eva_tipo_curso.id_tipo_curso 
                            and eva_carga_academica.id_periodo=gnral_periodos.id_periodo 
                            and eva_carga_academica.grupo=gnral_grupos.id_grupo 
                            and eva_carga_academica.id_alumno=gnral_alumnos.id_alumno 
                            and gnral_periodos.id_periodo='.$periodo.' 
                            and eva_carga_academica.id_alumno='.$id_usuario.'');

            $suma=$suma->suma;
        */

//dd($consulta);
            $pdf->SetFont('Arial','',9);
        $uno=80;

               foreach ($consulta as $consulta)
               {
                   $txt=$consulta->nombre;
                   $height = 1;
                   $strlen = strlen($txt);
                   $wdth = 0;
                   for ($i = 0; $i <= $strlen; $i++) {
                       $char = substr($txt, $i, 1);
                       $wdth += $pdf->GetStringWidth($char);
                       if($char == "\n"){
                           $height++;
                           $wdth = 0;
                       }
                       if($wdth >= 132){
                           $height++;
                           $wdth = 0;
                       }
                   }
                   $contar_linea_nombre=$height*5;
                   $pdf->SetY($uno);
                   $pdf->Cell(30,($contar_linea_nombre),utf8_decode($consulta->clave),1,0,'C');
                   $pdf->SetXY(40,$uno);
                   $pdf->MultiCell(130,5,utf8_decode($consulta->nombre),1, 'L');
                   $pdf->SetXY(170,$uno);
                   if($consulta->id_materia == 2258){
                       $pdf->Cell(24, ($contar_linea_nombre), utf8_decode(""), 1, 0, 'C');
                   }else {
                       $pdf->Cell(24, ($contar_linea_nombre), utf8_decode($consulta->creditos), 1, 0, 'C');
                   }
                   $pdf->Cell(31,($contar_linea_nombre),utf8_decode($consulta->nombre_status),1,0,'C');
                   $pdf->Cell(25,($contar_linea_nombre),utf8_decode($consulta->nombre_curso),1,0,'C');
                   if($consulta->id_materia == 2258){
                       $pdf->Cell(20, ($contar_linea_nombre), utf8_decode(" "), 1, 1, 'C');
                   }else {
                       $pdf->Cell(20, ($contar_linea_nombre), utf8_decode($consulta->id_semestre . "0" . $consulta->grupo), 1, 1, 'C');
                   }
                  $uno+=$contar_linea_nombre;
               }



            $pdf->Cell(55,5,"",0);
            $pdf->Cell(105,5,"TOTAL DE CREDITOS",0,'R',0,false);
            $pdf->Cell(24,5,$suma,1,0,'C');

            $pdf->SetFillColor(230,230,230);
            $pdf->Rect(40,158, 100,25,"DF");
            $pdf->Line(60, 175, 120, 175);
            $pdf->Rect(145,158, 100,25,"DF");
            $pdf->Line(165, 175, 225, 175);

            $pdf->Text(82,180,"ESTUDIANTE");

            $pdf->Text(160,180,utf8_decode("SUBDIRECCIÓN DE SERVICIOS ESCOLARES"));

            $pdf->SetFont('Arial','B',10);
            $pdf->Text(186,162,"AUTORIZO");
            $pdf->Text(83,162,"ELABORO");
            $pdf->Output();
            exit();
    }
    //
}
