<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf as FPDF;
use Illuminate\Support\Facades\DB;
use Session;
class PDF_Cal_pdf_historial_academicoController extends FPDF
{

    //CABECERA DE LA PAGINA
    function Header()
    {
        $this->Image('img/tes.png', 85, 5, 40);
        $this->SetXY(0,20);
        $this->SetFont('Arial','B',8);
        $this->Ln(2);
        $this->Cell(170,5,utf8_decode('TECNOLÓGICO DE ESTUDIOS SUPERIORES DE VALLE DE BRAVO'),0,0,'C');
        $this->Ln(10);


    }
    //PIE DE PAGINA
    function Footer()
    {

        $this->SetY(-35);
        $this->Ln(18);
        $this->Cell(50);
        $this->SetFont('Arial','B',8);
        $this->Cell(125,-2,utf8_decode('FO-TESVB-38  V.0  23-03-2018'),0,0,'R');
    }

}
class Cal_pdf_historial_academicoController extends Controller
{
    public function pdf_academico($id_alumno,$plan,$especialidad,$calificada){

        $materias = [];
        $residencia_agregada = false;
       
        $alumno=DB::selectOne('SELECT gnral_alumnos.*, gnral_carreras.nombre carrera FROM gnral_carreras,gnral_alumnos WHERE gnral_alumnos.id_carrera=gnral_carreras.id_carrera  AND gnral_alumnos.id_alumno='.$id_alumno.'');
        $nombre=mb_strtoupper($alumno->apaterno,'utf-8')." ".mb_strtoupper($alumno->amaterno,'utf-8')." ".mb_strtoupper($alumno->nombre,'utf-8');
        $no_cuenta=mb_strtoupper($alumno->cuenta);
        $carrera=mb_strtoupper($alumno->carrera);
        $id_periodo=Session::get('periodotrabaja');
        $materias_excluidas = '773,817,845,853,1160,1263,1264,1265,1443,1496,1502,1565,1566,1567,1568,1569,1571,2516,2517,2614,2250';
       if ($calificada == 1) {
            $materias_rep = DB::select(" SELECT eca.id_carga_academica,gm.id_materia,gm.unidades, gm.clave, gm.nombre AS nombre_materia,
            gm.creditos, gp.siglas AS periodo, gp.year, gm.id_semestre, eca.id_tipo_curso,
                CASE
                WHEN eca.tipo_alumno = 'C' THEN 'CON'
                WHEN eca.tipo_alumno = 'R' THEN 'REE'
                ELSE ''
                END AS tipo_alumno
                FROM eva_validacion_de_cargas evc
                INNER JOIN eva_carga_academica eca ON evc.id_alumno = eca.id_alumno AND evc.id_periodo = eca.id_periodo
                INNER JOIN gnral_materias gm ON eca.id_materia = gm.id_materia
                INNER JOIN gnral_periodos gp ON evc.id_periodo = gp.id_periodo
                WHERE evc.id_alumno = ?
                AND eca.id_status_materia = 1 AND eca.id_materia NOT IN ($materias_excluidas)
                AND gp.id_periodo >= 20 AND gp.id_periodo < ? 
                AND evc.id_periodo = (SELECT MAX(evc2.id_periodo) FROM eva_validacion_de_cargas evc2
                INNER JOIN eva_carga_academica eca2 ON evc2.id_alumno = eca2.id_alumno AND evc2.id_periodo = eca2.id_periodo
                WHERE evc2.id_alumno = evc.id_alumno AND eca2.id_materia = eca.id_materia AND eca2.id_status_materia = 1 AND evc2.id_periodo >= 20 AND evc2.id_periodo < ?)
                AND evc.estado_validacion IN (2,8,9,10) ORDER BY gm.id_semestre ASC, gm.nombre ASC ", [$id_alumno, $id_periodo, $id_periodo]);
                
                foreach ($materias_rep as $materia) {
                    $alumnos_materia = array();
                    $alumnos_materia['id_carga_academica'] = $materia->id_carga_academica;
                    $alumnos_materia['id_materia'] = $materia->id_materia;
                    $alumnos_materia['unidades'] = $materia->unidades;
                    $alumnos_materia['clave'] = $materia->clave;
                    $alumnos_materia['nombre_materia'] = $materia->nombre_materia;
                    $alumnos_materia['creditos'] = $materia->creditos;
                    $alumnos_materia['periodo'] = $materia->periodo;
                    $alumnos_materia['year'] = $materia->year;
                    $alumnos_materia['id_semestre'] = $materia->id_semestre;
                    $alumnos_materia['id_tipo_curso'] = $materia->id_tipo_curso;
                    $alumnos_materia['tipo_alumno'] = $materia->tipo_alumno;
                    $materias[] = $alumnos_materia;
                    }
        } elseif ($calificada == 2) {

            $materias_rep = DB::select(" SELECT eca.id_carga_academica,gm.id_materia,gm.unidades,gm.clave,gm.nombre AS nombre_materia,gm.creditos,gp.siglas AS periodo,gp.year,gm.id_semestre,eca.id_tipo_curso,
            CASE
                WHEN eca.tipo_alumno = 'C' THEN 'CON'
                WHEN eca.tipo_alumno = 'R' THEN 'REE'
                ELSE ''
            END AS tipo_alumno FROM eva_validacion_de_cargas evc
            INNER JOIN eva_carga_academica eca ON evc.id_alumno = eca.id_alumno AND evc.id_periodo = eca.id_periodo
            INNER JOIN gnral_materias gm ON eca.id_materia = gm.id_materia
            INNER JOIN gnral_periodos gp ON evc.id_periodo = gp.id_periodo
            WHERE evc.id_alumno = ?
                AND eca.id_status_materia = 1
                AND eca.id_materia NOT IN ($materias_excluidas)
                AND gp.id_periodo >= 20
                AND gp.id_periodo < ?
                AND evc.id_periodo = (SELECT MAX(evc2.id_periodo) FROM eva_validacion_de_cargas evc2
                    INNER JOIN eva_carga_academica eca2 ON evc2.id_alumno = eca2.id_alumno AND evc2.id_periodo = eca2.id_periodo
                    WHERE evc2.id_alumno = evc.id_alumno
                        AND eca2.id_materia = eca.id_materia
                        AND eca2.id_status_materia = 1
                        AND evc2.id_periodo >= 20
                        AND evc2.id_periodo < ? )
                        AND evc.estado_validacion IN (2,8,9,10) ORDER BY gm.id_semestre ASC,gm.nombre ASC", [$id_alumno, $id_periodo, $id_periodo]);

            $materias = array();
            foreach ($materias_rep as $materias_rep) {
                $contar_mat = DB::selectOne('SELECT  count(gnral_materias.id_materia) contar_materia FROM eva_validacion_de_cargas,eva_carga_academica,gnral_materias,gnral_periodos
                                                        WHERE eva_validacion_de_cargas.id_alumno=' . $id_alumno . ' 
                                                        AND eva_carga_academica.id_status_materia=1 
                                                        AND eva_carga_academica.id_materia=' . $materias_rep->id_materia . ' 
                                                        AND eva_validacion_de_cargas.estado_validacion IN (2,8,9,10) 
                                                        AND eva_validacion_de_cargas.id_alumno=eva_carga_academica.id_alumno
                                                        AND eva_validacion_de_cargas.id_periodo=eva_carga_academica.id_periodo 
                                                        AND eva_validacion_de_cargas.id_periodo=gnral_periodos.id_periodo 
                                                        AND gnral_periodos.id_periodo >= 20  
                                                        AND  gnral_periodos.id_periodo <' . $id_periodo . ' 
                                                        AND eva_carga_academica.id_materia=gnral_materias.id_materia ORDER BY `gnral_materias`.`id_semestre` ASC');

                if ($contar_mat->contar_materia > 1) {
                    $max_periodo = DB::selectOne('SELECT max(eva_validacion_de_cargas.id_periodo) periodo FROM eva_validacion_de_cargas,eva_carga_academica,gnral_materias,gnral_periodos 
                                                        WHERE eva_validacion_de_cargas.id_alumno=' . $id_alumno . '
                                                        AND eva_carga_academica.id_status_materia=1 
                                                        AND eva_carga_academica.id_materia=' . $materias_rep->id_materia . ' 
                                                        AND eva_validacion_de_cargas.estado_validacion IN (2,8,9,10) 
                                                        AND eva_validacion_de_cargas.id_alumno=eva_carga_academica.id_alumno 
                                                        AND eva_validacion_de_cargas.id_periodo=eva_carga_academica.id_periodo 
                                                        AND eva_validacion_de_cargas.id_periodo=gnral_periodos.id_periodo 
                                                        AND gnral_periodos.id_periodo >= 20 
                                                        AND gnral_periodos.id_periodo < ' . $id_periodo . ' 
                                                        AND eva_carga_academica.id_materia=gnral_materias.id_materia ORDER BY `gnral_materias`.`id_semestre` ASC');

                    $max = DB::selectOne('SELECT  eva_carga_academica.id_carga_academica  FROM eva_validacion_de_cargas,eva_carga_academica,gnral_materias,gnral_periodos
                                                where eva_validacion_de_cargas.id_alumno=' . $id_alumno . ' 
                                                and eva_carga_academica.id_status_materia=1 
                                                and eva_carga_academica.id_materia=' . $materias_rep->id_materia . ' 
                                                and eva_validacion_de_cargas.estado_validacion in (2,8,9,10) 
                                                and eva_validacion_de_cargas.id_alumno=eva_carga_academica.id_alumno
                                                and eva_validacion_de_cargas.id_periodo=eva_carga_academica.id_periodo 
                                                and eva_validacion_de_cargas.id_periodo=gnral_periodos.id_periodo 
                                                and gnral_periodos.id_periodo = ' . $max_periodo->periodo . ' 
                                                and eva_carga_academica.id_materia=gnral_materias.id_materia ORDER BY `gnral_materias`.`id_semestre` ASC');

                    $materias_n = DB::selectOne("SELECT gm.*, eca.id_tipo_curso,eca.id_carga_academica, gp.year,gp.siglas, gp.id_periodo,
                    CASE
                        WHEN eca.tipo_alumno = 'C' THEN 'CON'
                        WHEN eca.tipo_alumno = 'R' THEN 'REE'
                        END AS tipo_alumno
                            FROM eva_carga_academica eca
                                JOIN gnral_materias gm ON eca.id_materia = gm.id_materia
                                JOIN gnral_periodos gp ON eca.id_periodo = gp.id_periodo
                                    WHERE eca.id_carga_academica = ?
                                        ORDER BY gm.id_semestre ASC",[$max->id_carga_academica]);
                    $alumnos_materia['id_carga_academica'] = $materias_n->id_carga_academica;
                    $alumnos_materia['id_materia'] = $materias_n->id_materia;
                    $alumnos_materia['unidades'] = $materias_n->unidades;
                    $alumnos_materia['clave'] = $materias_n->clave;
                    $alumnos_materia['nombre_materia'] = $materias_n->nombre;
                    $alumnos_materia['creditos'] = $materias_n->creditos;
                    $alumnos_materia['periodo'] = $materias_n->siglas;
                    $alumnos_materia['year'] = $materias_n->year;
                    $alumnos_materia['id_semestre'] = $materias_n->id_semestre;
                    $alumnos_materia['id_tipo_curso'] = $materias_n->id_tipo_curso;
                    $alumnos_materia['tipo_alumno'] = $materias_n->tipo_alumno;
                    $alumnos_materia['id_carga_academica'] = $materias_n->id_carga_academica;
                    $alumnos_materia['id_materia'] = $materias_n->id_materia;
                    $alumnos_materia['unidades'] = $materias_n->unidades;
                    $alumnos_materia['clave'] = $materias_n->clave;
                    $alumnos_materia['nombre_materia'] = $materias_n->nombre;
                    $alumnos_materia['creditos'] = $materias_n->creditos;
                    $alumnos_materia['periodo'] = $materias_n->siglas;
                    $alumnos_materia['year'] = $materias_n->year;
                    $alumnos_materia['id_semestre'] = $materias_n->id_semestre;
                    $alumnos_materia['id_tipo_curso'] = $materias_n->id_tipo_curso;
                    $alumnos_materia['tipo_alumno'] = $materias_n->tipo_alumno;
//dd($materias_n);
                } else {
                    $materias_o = DB::selectOne("SELECT gm.*, eca.id_tipo_curso, eca.id_carga_academica, gp.year, gp.siglas, gp.id_periodo,
                    CASE
                        WHEN eca.tipo_alumno = 'C' THEN 'CON'
                        WHEN eca.tipo_alumno = 'R' THEN 'REE'
                        END AS tipo_alumno
                            FROM eva_validacion_de_cargas evc
                                INNER JOIN eva_carga_academica eca ON evc.id_alumno = eca.id_alumno 
                                AND evc.id_periodo = eca.id_periodo
                                INNER JOIN gnral_materias gm ON eca.id_materia = gm.id_materia
                                INNER JOIN gnral_periodos gp ON evc.id_periodo = gp.id_periodo
                                WHERE evc.id_alumno = ? 
                                    AND eca.id_status_materia = 1
                                    AND eca.id_materia = ?
                                    AND evc.estado_validacion IN (2,8,9,10)
                                    AND gp.id_periodo >= 20
                                ORDER BY gm.id_semestre ASC", [$id_alumno, $materias_rep->id_materia]);
                    $alumnos_materia['id_carga_academica'] = $materias_o->id_carga_academica;
                    $alumnos_materia['id_materia'] = $materias_o->id_materia;
                    $alumnos_materia['unidades'] = $materias_o->unidades;
                    $alumnos_materia['clave'] = $materias_o->clave;
                    $alumnos_materia['nombre_materia'] = $materias_o->nombre;
                    $alumnos_materia['creditos'] = $materias_o->creditos;
                    $alumnos_materia['periodo'] = $materias_o->siglas;
                    $alumnos_materia['year'] = $materias_o->year;
                    $alumnos_materia['id_semestre'] = $materias_o->id_semestre;
                    $alumnos_materia['id_tipo_curso'] = $materias_o->id_tipo_curso;
                    $alumnos_materia['tipo_alumno'] = $materias_o->tipo_alumno;

                }

                /* if ($residencia_agregada) {
                      continue;
                  }

                  array_push($materias, $alumnos_materia);
                  $residencia_agregada = true;*/

                array_push($materias, $alumnos_materia);

            }




        }
        //dd($materias,$alumnos_materia);

        $suma_promedio_final = 0;
        $suma_materia = 0;
        $alumnos = array();

        foreach ($materias as $mat) {
            $suma_materia++;
            $datos_alumnos['numero'] = $suma_materia;
            $datos_alumnos['id_carga_academica'] = $mat['id_carga_academica'];
            $datos_alumnos['id_materia'] = $mat['id_materia'];
            $datos_alumnos['nombre_materia'] = $mat['nombre_materia'];
            $datos_alumnos['id_semestre'] = $mat['id_semestre'];
            $datos_alumnos['clave'] = $mat['clave'];
            $datos_alumnos['creditos'] = $mat['creditos'];
            $datos_alumnos['periodo'] = $mat['periodo'];
            $datos_alumnos['year'] = $mat['year'];
            $datos_alumnos['id_tipo_curso'] = $mat['id_tipo_curso'];
            $datos_alumnos['tipo_alumno'] = $mat['tipo_alumno'];
            $materia_promedio = DB::selectOne('SELECT SUM(calificacion) suma FROM cal_evaluaciones WHERE id_carga_academica =' . $mat['id_carga_academica'] . ' AND calificacion >= 70');
            $materia_promedio = $materia_promedio->suma ?? 0;
            $contar_unidades_pasadas = DB::selectOne('SELECT COUNT(calificacion) suma FROM cal_evaluaciones WHERE id_carga_academica = ' . $mat['id_carga_academica'] . ' AND calificacion >= 70');
            $contar_unidades_pasadas = $contar_unidades_pasadas->suma ?? 0;
            $contar_sumativa = DB::selectOne('SELECT COUNT(esc) contar FROM cal_evaluaciones WHERE id_carga_academica = ' . $mat['id_carga_academica'] . ' AND esc = 1');
            $contar_sumativa = $contar_sumativa->contar ?? 0;
            $promedio = 0;
            $te = '';
            if ($contar_unidades_pasadas == $mat['unidades']) {
                // Calcular promedio solo si aprobó todas las unidades
                if ($contar_unidades_pasadas > 0) {
                    $promedio = round($materia_promedio / $contar_unidades_pasadas);
                }

                if ($mat['id_tipo_curso'] == 1) {
                    $te = ($contar_sumativa == 0) ? 'O' : 'ESC';
                } elseif ($mat['id_tipo_curso'] == 2) {
                    $te = ($contar_sumativa == 0) ? 'O2' : 'ESC2';
                } elseif ($mat['id_tipo_curso'] == 3) {
                    $te = ($contar_sumativa == 0) ? 'CE' : 'CG';
                } elseif ($mat['id_tipo_curso'] == 4) {
                    $te = 'CG';
                }
            } else {
                // No aprobó todas las unidades → promedio 0
                $promedio = 0;

                if ($mat['id_tipo_curso'] == 1) $te = 'ESC';
                if ($mat['id_tipo_curso'] == 2) $te = 'ESC2';
                if ($mat['id_tipo_curso'] == 3) $te = 'CE';
                if ($mat['id_tipo_curso'] == 4) $te = 'CG';
            }

            // --- Ajuste final según tipo de alumno ---
            if ($mat['tipo_alumno'] == 'CON') {
                $te = 'CON';
            } elseif ($mat['tipo_alumno'] == 'REE') {
                $te = 'REE';
            }
            $datos_alumnos['promedio'] = $promedio;
            $datos_alumnos['te'] = $te;
            array_push($alumnos, $datos_alumnos);
        }

        $suma_mat = 0;
        $promedio_final = 0;
        $contar_creditos = 0;
        $materias_actualizadas = array();
        $datos_residencia = array();
        $datos_servicio = array();
        $datos_actividades = array();
        foreach ($alumnos as $alum) {
            $eliminacion_mat = DB::selectOne('SELECT COUNT(id_carga_academica) total FROM cal_eliminacion_materia WHERE id_carga_academica=' . $alum['id_carga_academica'] . '');
            if ($eliminacion_mat->total == 0) {
                $suma_mat++;
                $datos_alu['numero'] = $suma_materia;
                $datos_alu['id_carga_academica'] = $alum['id_carga_academica'];
                $datos_alu['id_materia'] = $alum['id_materia'];
                $datos_alu['nombre_materia'] = $alum['nombre_materia'];
                $datos_alu['id_semestre'] = $alum['id_semestre'];
                $datos_alu['clave'] = $alum['clave'];
                if ($alum['promedio'] < 70) {
                    $datos_alu['creditos'] = 0;
                } else {
                    $datos_alu['creditos'] = $alum['creditos'];
                    $contar_creditos += $alum['creditos'];
                }
                $datos_alu['promedio'] = $alum['promedio'];
                $datos_alu['periodo'] = $alum['periodo'];
                $datos_alu['year'] = $alum['year'];
                $datos_alu['id_tipo_curso'] = $alum['id_tipo_curso'];
                $datos_alu['tipo_alumno'] = $alum['tipo_alumno'];
                $datos_alu['esc'] = $alum['te'];
                $promedio_final += $alum['promedio'];

                array_push($materias_actualizadas, $datos_alu);
            }
        }

        $residencia = DB::selectOne('SELECT COUNT(id_cal_residencia) residencia  FROM cal_residencia  WHERE id_alumno = '.$id_alumno.'');

        if ($residencia->residencia > 0 && !$residencia_agregada) {
            $datos_residencia = DB::selectOne('SELECT *  FROM cal_residencia WHERE id_alumno = '.$id_alumno.'');
            $suma_mat++;
            $promedio_final += $datos_residencia->calificacion;
            if ($datos_residencia->calificacion >= 70) {
                $contar_creditos += 10;
            }
            $residencia_agregada = true;
        }

        $servicio_social=DB::selectOne('SELECT count(id_servicio_social) servicio FROM cal_servicio_social WHERE id_alumno='.$id_alumno.'');
        $servicio_social=$servicio_social->servicio;
        if($servicio_social == 0){
            $servicio=0;

        }
        else{
            $servicio=10;
            $datos_servicio=DB::selectOne('SELECT *FROM cal_servicio_social WHERE id_alumno='.$id_alumno.'');
            $promedio_servicio=$datos_servicio->calificacion;
            $promedio_final=$promedio_final+$promedio_servicio;
            $suma_mat++;
            if($promedio_servicio >= 70) {
                $contar_creditos = $contar_creditos + $servicio;
            }
        }


        $actividades_complementaria=DB::selectOne('SELECT count(id_actividades_comple)actividades from cal_actividades_complementarias WHERE id_alumno='.$id_alumno.'');
        $actividades_complementaria=$actividades_complementaria->actividades;
        if($actividades_complementaria == 0){
            $actividades=0;
        }
        else{
            $actividades=5;
            $datos_actividades=DB::selectOne('SELECT *from cal_actividades_complementarias WHERE id_alumno='.$id_alumno.'');

            $contar_creditos=$contar_creditos+$actividades;
        }

//dd($suma_mat);
        if($promedio_final == 0)
        {
            $promedio_f=0;
        }
        else{
            $promedio_f=($promedio_final/$suma_mat);
            $promedio_f = number_format($promedio_f, 2, '.', ' ');
        }
        $especialidad=mb_strtoupper($especialidad);
        $plan=mb_strtoupper($plan);
        $fechas = date("Y-m-d");

        $num=date("d",strtotime($fechas));
        $ano=date("Y", strtotime($fechas));
        $mes= array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
        $mes=$mes[(date('m', strtotime($fechas))*1)-1];
        $fech= $num.' de '.$mes.' de '.$ano;
        $pdf=new PDF_Cal_pdf_historial_academicoController($orientation='P',$unit='mm',$format='Legal');
        #Establecemos los márgenes izquierda, arriba y derecha:
        $pdf->SetMargins(10, 0, 10);
        $pdf->AddPage();
        $pdf->SetFillColor(166,166,166);
        $pdf->Ln(5);
        $pdf->SetFont('Arial','','7');
        $pdf->Cell(30,3,utf8_decode('No. Cuenta'),'LTR',0,'L');
        $pdf->Cell(90,3,utf8_decode('Nombre:'),'LTR',0,'L');
        $pdf->Cell(75,3,utf8_decode('Carrera:'),'LTR',1,'L');
        $pdf->SetFont('Arial','B','7');
        $pdf->Cell(30,3,utf8_decode($no_cuenta),'LBR',0,'L');
        $pdf->Cell(90,3,utf8_decode($nombre),'LBR',0,'L');
        $pdf->Cell(75,3,utf8_decode($carrera),'LBR',1,'L');
        $pdf->SetFont('Arial','','7');
        $pdf->Cell(65,3,utf8_decode('Especialidad'),1,0,'L');
        $pdf->Cell(65,3,utf8_decode('Plan:'),1,0,'L');
        $pdf->Cell(65,3,utf8_decode('Fecha:'),1,1,'L');
        $pdf->SetFont('Arial','B','7');
        $y=$pdf->GetY();
        $x=$pdf->GetX();
        $pdf->MultiCell(65, 4,utf8_decode($especialidad),0);
        $y2=$pdf->GetY();
        $x2=$pdf->GetX();
        $pdf->Setxy(75,46);
        $pdf->MultiCell(65, 4, utf8_decode($plan),0);
        $pdf->Setxy(140,46);
        $pdf->MultiCell(65, 4, utf8_decode($fech),0);

        $y3=$y2-$y;
        $pdf->Setxy($x,$y);
        $pdf->Cell(65,$y3,utf8_decode(''),1,0,'L');
        $pdf->Cell(65,$y3,utf8_decode(''),1,0,'L');
        $pdf->Cell(65,$y3,utf8_decode(''),1,0,'L');
        //dd($y3);
        //$pdf->Cell(65,3,utf8_decode($plan),'LBR',0,'L');
        //$pdf->Cell(65,3,utf8_decode($fech),'LBR',1,'L');
        $pdf->Setxy($x2,$y2);
        $pdf->SetFont('Arial','B','7');
        $pdf->Cell(8,4,utf8_decode('Sem.'),1,0,'C');
        $pdf->Cell(18,4,utf8_decode('Clave'),1,0,'C');
        $pdf->Cell(100,4,utf8_decode('Nombre de la Materia'),1,0,'C');
        $pdf->Cell(8,4,utf8_decode('Cr.'),1,0,'C');
        $pdf->Cell(8,4,utf8_decode('Cal.'),1,0,'C');
        $pdf->Cell(8,4,utf8_decode('Acr.'),1,0,'C');
        $pdf->Cell(20,4,utf8_decode('Periodo'),1,0,'C');
        $pdf->Cell(8,4,utf8_decode('Año'),1,0,'C');
        $pdf->Cell(17,4,utf8_decode('Fech. Esp.'),1,1,'C');

        $pdf->SetFont('Arial','','6');
        foreach($materias_actualizadas as $alumno) {
            $pdf->Cell(8, 4, utf8_decode($alumno['id_semestre']), 1, 0, 'C');
            $pdf->Cell(18, 4, utf8_decode($alumno['clave']), 1, 0, 'C');

            $pdf->Cell(100, 4, utf8_decode($alumno['nombre_materia']), 1, 0, 'L');

            $pdf->Cell(8, 4, utf8_decode($alumno['creditos']), 1, 0, 'C');
            if($alumno['promedio']  <70 )
            {
                $pdf->Cell(8, 4, utf8_decode('N.A.'), 1, 0, 'C');
            }
            else{
                $pdf->Cell(8, 4, utf8_decode($alumno['promedio']), 1, 0, 'C');
            }

            $pdf->Cell(8, 4, utf8_decode($alumno['esc']), 1, 0, 'C');
            $pdf->Cell(20, 4, utf8_decode($alumno['periodo']), 1, 0, 'C');
            $pdf->Cell(8, 4, utf8_decode($alumno['year']), 1, 0, 'C');
            $pdf->Cell(17, 4, utf8_decode(''), 1, 1, 'C');
        }

function formatearFecha($fecha){
    $year = substr($fecha,0,4);
    $mes  = substr($fecha,5,2);
    $dia  = substr($fecha,8,2);
    return $dia.'/'.$mes.'/'.$year;
}

if ($residencia->residencia > 0)
{
    $fecha_re = formatearFecha($datos_residencia->fecha_termino);

    $pdf->Cell(8,4,'9',1,0,'C');
    $pdf->Cell(18,4,'RES-0001',1,0,'C');
    $pdf->Cell(100,4,utf8_decode('RESIDENCIA PROFESIONAL'),1,0,'L');

    if ($datos_residencia->calificacion < 70){
        $pdf->Cell(8,4,'0',1,0,'C');
        $pdf->Cell(8,4,'N.A',1,0,'C');
    }else{
        $pdf->Cell(8,4,'10',1,0,'C');
        $pdf->Cell(8,4,$datos_residencia->calificacion,1,0,'C');
    }

    $pdf->Cell(8,4,'',1,0,'C');
    $pdf->Cell(20,4,'',1,0,'C');
    $pdf->Cell(8,4,'',1,0,'C');
    $pdf->Cell(17,4,$fecha_re,1,1,'C');
}

if ($servicio > 0)
{
    $fecha_s = formatearFecha($datos_servicio->fecha_termino);

    $pdf->Cell(8,4,'9',1,0,'C');
    $pdf->Cell(18,4,'SSC-0001',1,0,'C');
    $pdf->Cell(100,4,utf8_decode('SERVICIO SOCIAL'),1,0,'L');

    if ($datos_servicio->calificacion < 70){
        $pdf->Cell(8,4,'0',1,0,'C');
        $pdf->Cell(8,4,'N.A.',1,0,'C');
    }else{
        $pdf->Cell(8,4,'10',1,0,'C');
        $pdf->Cell(8,4,$datos_servicio->calificacion,1,0,'C');
    }
    $pdf->Cell(8,4,'',1,0,'C');
    $pdf->Cell(20,4,'',1,0,'C');
    $pdf->Cell(8,4,'',1,0,'C');
    $pdf->Cell(17,4,$fecha_s,1,1,'C');
}

if ($actividades > 0)
{
    $pdf->Cell(8,4,'9',1,0,'C');
    $pdf->Cell(18,4,'ACC-0001',1,0,'C');
    $pdf->Cell(100,4,utf8_decode('ACTIVIDADES COMPLEMENTARIAS'),1,0,'L');
    $pdf->Cell(8,4,'5',1,0,'C');
    $pdf->Cell(8,4,'ACA',1,0,'C');
    $pdf->Cell(8,4,'',1,0,'C');
    $pdf->Cell(20,4,'',1,0,'C');
    $pdf->Cell(8,4,'',1,0,'C');
    $pdf->Cell(17,4,'',1,1,'C');
}
$num_filas = 1;
$ancho_celdas = [8,18,100,8,8,8,20,8,17];

for ($i = 0; $i < $num_filas; $i++) {
    foreach ($ancho_celdas as $ancho) {
        $pdf->Cell($ancho,4,'',1,0,'C');
    }
    $pdf->Ln();
}
        if (isset($id_alumno)) {
            $folio = DB::selectOne('SELECT folio FROM gnral_alumnos WHERE id_alumno = ?', [$id_alumno]);
            if ($folio && isset($folio->folio)) {
                $folio_text = $folio->folio;
            } else {
                $folio_text = 'Folio no disponible';
            }
        } else {
            $folio_text = 'Folio no disponible (ID de alumno no especificado)';
        }
        $pdf->SetFont('Arial','B','6');
        $pdf->Cell(8, 4, utf8_decode(''), 1, 0, 'C');
        $pdf->Cell(18, 4, utf8_decode(''), 1, 0, 'C');
        $pdf->Cell(100, 4, utf8_decode( $folio_text), 1, 0, 'L');
        $pdf->Cell(8, 4, utf8_decode(''), 1, 0, 'C');
        $pdf->Cell(8, 4, utf8_decode(''), 1, 0, 'C');
        $pdf->Cell(8, 4, utf8_decode(''), 1, 0, 'C');
        $pdf->Cell(20, 4, utf8_decode(''), 1, 0, 'C');
        $pdf->Cell(8, 4, utf8_decode(''), 1, 0, 'C');
        $pdf->Cell(17, 4, utf8_decode(''), 1, 1, 'C');
        $pdf->SetFont('Arial','B','6');
        $pdf->Cell(126, 4, utf8_decode('Totales:'), 0, 0, 'R');
        $pdf->Cell(8, 4, utf8_decode($contar_creditos), 1, 0, 'C');
        $pdf->Cell(8, 4, utf8_decode($promedio_f), 1, 1, 'C');
        $pdf->Ln(5);
        $pdf->SetFont('Arial','','6');
        $pdf->Cell(12, 3, utf8_decode(''), 0, 0, 'C');
        $pdf->Cell(8, 3, utf8_decode('O'), 1, 0, 'L');
        $pdf->Cell(55, 3, utf8_decode('Curso Normal Ordinario'), 1, 0, 'L');
        $pdf->Cell(48, 3, utf8_decode(''), 0, 0, 'C');
        $pdf->SetFont('Arial','B','11');
        $pdf->Cell(48, 3, utf8_decode('A T E N T A M E N T E '), 0, 1, 'L');
        $pdf->SetFont('Arial','','6');
        $pdf->Cell(12, 3, utf8_decode(''), 0, 0, 'C');
        $pdf->Cell(8, 3, utf8_decode('R'), 1, 0, 'L');
        $pdf->Cell(55, 3, utf8_decode('Curso Normal Regularización'), 1, 1, 'L');
        $pdf->SetFont('Arial','','6');
        $pdf->Cell(12, 3, utf8_decode(''), 0, 0, 'C');
        $pdf->Cell(8, 3, utf8_decode('E'), 1, 0, 'L');
        $pdf->Cell(55, 3, utf8_decode('Curso Normal Extraordinario'), 1, 1, 'L');
        $pdf->SetFont('Arial','','6');
        $pdf->Cell(12, 3, utf8_decode(''), 0, 0, 'C');
        $pdf->Cell(8, 3, utf8_decode('O2'), 1, 0, 'L');
        $pdf->Cell(55, 3, utf8_decode('Curso Repetición Ordinario'), 1, 1, 'L');
        $pdf->SetFont('Arial','','6');
        $pdf->Cell(12, 3, utf8_decode(''), 0, 0, 'C');
        $pdf->Cell(8, 3, utf8_decode('R2'), 1, 0, 'L');
        $pdf->Cell(55, 3, utf8_decode('Curso Repetición Regularización'), 1, 1, 'L');
        $pdf->SetFont('Arial','','6');
        $pdf->Cell(12, 3, utf8_decode(''), 0, 0, 'C');
        $pdf->Cell(8, 3, utf8_decode('EE'), 1, 0, 'L');
        $pdf->Cell(55, 3, utf8_decode('Examen Especial'), 1, 1, 'L');
        $pdf->SetFont('Arial','','6');
        $pdf->Cell(12, 3, utf8_decode(''), 0, 0, 'C');
        $pdf->Cell(8, 3, utf8_decode('CG'), 1, 0, 'L');
        $pdf->Cell(55, 3, utf8_decode('Examen Global'), 1, 1, 'L');
        $pdf->SetFont('Arial','','6');
        $pdf->Cell(12, 3, utf8_decode(''), 0, 0, 'C');
        $pdf->Cell(8, 3, utf8_decode('ESC'), 1, 0, 'L');
        $pdf->Cell(55, 3, utf8_decode('Evaluación Sumativa de Complementación'), 1, 1, 'L');
        $pdf->SetFont('Arial','','6');
        $pdf->Cell(12, 3, utf8_decode(''), 0, 0, 'C');
        $pdf->Cell(8, 3, utf8_decode('ESC2'), 1, 0, 'L');
        $pdf->Cell(55, 3, utf8_decode('Evaluación Sumativa de Complementación 2'), 1, 0, 'L');
        $pdf->Cell(35, 3, utf8_decode(''), 0, 0, 'C');
        $pdf->SetFont('Arial','B','10');
        $pdf->Cell(56, 3, utf8_decode(' __________________________________'), 0, 1, 'L');
        $pdf->SetFont('Arial','','6');
        $pdf->Cell(12, 3, utf8_decode(''), 0, 0, 'C');
        $pdf->Cell(8, 3, utf8_decode('CR'), 1, 0, 'L');
        $pdf->Cell(55, 3, utf8_decode('Curso de Repetición'), 1, 1, 'L');
        $pdf->SetFont('Arial','','6');
        $pdf->Cell(12, 3, utf8_decode(''), 0, 0, 'C');
        $pdf->Cell(8, 3, utf8_decode('CE'), 1, 0, 'L');
        $pdf->Cell(55, 3, utf8_decode('Curso Especial'), 1, 0, 'L');
        $pdf->Cell(35, 3, utf8_decode(''), 0, 0, 'C');
        $pdf->SetFont('Arial','B','11');
        $pdf->Cell(56, 3, utf8_decode('L. EN C. ROMULO ESQUIVEL REYES'), 0, 1, 'L');
        $pdf->SetFont('Arial','','6');
        $pdf->Cell(12, 3, utf8_decode(''), 0, 0, 'C');
        $pdf->Cell(8, 3, utf8_decode('ACA'), 1, 0, 'L');
        $pdf->Cell(55, 3, utf8_decode('Actividad Complementaria Acreditada'), 1, 1, 'L');
        $pdf->Output();
        exit();
    }
}