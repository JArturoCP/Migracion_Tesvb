<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf as FPDF;

use Illuminate\Support\Facades\DB;
use Session;

class PDF_Ti_pdf_cert_antecedentes1Controller extends FPDF
{

}

class Ti_pdf_cert_antecedentes1Controller extends Controller
{
    public function index($id_alumno)
    {
        $datos_alumnos=DB::selectOne('SELECT ti_datos_alumno_reg_dep.*, ti_clave_carrera.clave,
       ti_nacionalidad.nacionalidad, ti_genero.genero, ti_sexo.sexo, ti_preparatatoria.preparatoria,   ti_entidades_federativas.nom_entidad,
       ti_numeros_titulos.abreviatura_folio_titulo, ti_tipo_titulo_obtenido.tipo_titulo, ti_decisiones_jurado.decision,
       ti_fundamento_legal_s_s.fundamento_legal, ti_autorizacion_reconocimiento.autorizacion_reconocimiento,
       ti_reg_datos_alum.fecha_ingreso_preparatoria,ti_reg_datos_alum.fecha_egreso_preparatoria,
        ti_reg_datos_alum.fecha_ingreso_tesvb,ti_reg_datos_alum.fecha_egreso_tesvb,ti_reg_datos_alum.id_nacionalidad,
ti_descuentos_alum.id_preparatoria,ti_reg_datos_alum.mencion_honorifica

FROM ti_datos_alumno_reg_dep,ti_clave_carrera, ti_nacionalidad, ti_genero, ti_sexo,ti_preparatatoria,ti_entidades_federativas,
     ti_tipo_titulo_obtenido, ti_numeros_titulos,ti_autorizacion_reconocimiento, ti_fundamento_legal_s_s, ti_reg_datos_alum,ti_decisiones_jurado,ti_descuentos_alum
     WHERE ti_reg_datos_alum.id_carrera= ti_clave_carrera.id_carrera and  ti_reg_datos_alum.id_nacionalidad = ti_nacionalidad.id_nacionalidad and
ti_datos_alumno_reg_dep.id_genero = ti_genero.id_genero and ti_datos_alumno_reg_dep.id_sexo = ti_sexo.id_sexo
and ti_descuentos_alum.id_preparatoria = ti_preparatatoria.id_preparatoria and
                ti_preparatatoria.id_entidad_federativa = ti_entidades_federativas.id_entidad_federativa  and
                ti_datos_alumno_reg_dep.id_numero_titulo =ti_numeros_titulos.id_numero_titulo and
ti_datos_alumno_reg_dep.id_tipo_titulo = ti_tipo_titulo_obtenido.id_tipo_titulo and
    ti_datos_alumno_reg_dep.id_decision = ti_decisiones_jurado.id_decision and
    ti_fundamento_legal_s_s.id_fundamento_legal = ti_datos_alumno_reg_dep.id_fundamento_legal AND
    ti_reg_datos_alum.id_alumno=ti_datos_alumno_reg_dep.id_alumno and
     ti_reg_datos_alum.id_alumno=ti_descuentos_alum.id_alumno  and
    ti_autorizacion_reconocimiento.id_autorizacion_reconocimiento =ti_datos_alumno_reg_dep.id_autorizacion_reconocimiento
    and      ti_datos_alumno_reg_dep.id_alumno = ?', [$id_alumno]);

        $registro_datos=DB::selectOne('SELECT ti_reg_datos_alum.*,ti_tipo_estudiante.tipo_estudiante,
       gnral_carreras.nombre as carrera,gnral_estados.nombre_estado,ti_opciones_titulacion.opcion_titulacion
FROM ti_reg_datos_alum,ti_tipo_estudiante,gnral_carreras,gnral_estados, ti_opciones_titulacion
where ti_reg_datos_alum.id_tipo_estudiante= ti_tipo_estudiante.id_tipo_estudiante
  and ti_reg_datos_alum.id_carrera = gnral_carreras.id_carrera  and
gnral_estados.id_estado= ti_reg_datos_alum.entidad_federativa
  and ti_reg_datos_alum.id_opcion_titulacion = ti_opciones_titulacion.id_opcion_titulacion and
ti_reg_datos_alum.id_alumno= ?', [$id_alumno]);
        $subdirector_escolares=$registro_datos->nombre_subdirector_servicios;
        $jefe_titulacion=$registro_datos->nombre_jefe_titulacion;

        $fecha_titulacion=DB::selectOne('SELECT * FROM ti_fecha_jurado_alumn WHERE id_alumno = ?', [$id_alumno]);

        $dia_titulacion=  substr($fecha_titulacion->fecha_titulacion, 0, 2);
        $mes_titulacion=  substr($fecha_titulacion->fecha_titulacion, 3, 2);
        $year=  substr($fecha_titulacion->fecha_titulacion, 6, 4);

        $fecha_ingreso_preparatoria=substr($datos_alumnos->fecha_ingreso_preparatoria, 0, 4);
        $fecha_egreso_preparatoria=substr($datos_alumnos->fecha_egreso_preparatoria, 0, 4);
        $fecha_ingreso_tesvb=substr($datos_alumnos->fecha_ingreso_tesvb, 0, 4);
        $fecha_egreso_tesvb=substr($datos_alumnos->fecha_egreso_tesvb, 0, 4);
        $numero_foja_titulo=$datos_alumnos->numero_foja_titulo;
        $numero_libro_titulo=$datos_alumnos->numero_libro_titulo;


        if($mes_titulacion == 1){
            $mes_titulacion="enero";
        }
        if($mes_titulacion == 2){
            $mes_titulacion="febrero";
        }
        if($mes_titulacion == 3){
            $mes_titulacion="marzo";
        }
        if($mes_titulacion == 4){
            $mes_titulacion="abril";
        }
        if($mes_titulacion == 5){
            $mes_titulacion="mayo";
        }
        if($mes_titulacion == 6){
            $mes_titulacion="junio";
        }
        if($mes_titulacion == 7){
            $mes_titulacion="julio";
        }
        if($mes_titulacion == 8){
            $mes_titulacion="agosto";
        }
        if($mes_titulacion == 9){
            $mes_titulacion="septiembre";
        }
        if($mes_titulacion == 10){
            $mes_titulacion="octubre";
        }
        if($mes_titulacion == 11){
            $mes_titulacion="noviembre";
        }
        if($mes_titulacion == 12){
            $mes_titulacion="diciembre";
        }
        $nombre_alumno=$registro_datos->nombre_al." ".$registro_datos->apaterno." ".$registro_datos->amaterno;
        $opcion_titulacion=$registro_datos->opcion_titulacion;
        $titulo_obtenido=$datos_alumnos->tipo_titulo;
        $etiqueta=DB::selectOne('SELECT * FROM etiqueta WHERE id_etiqueta = 1 ');

        $pdf = new PDF_Ti_pdf_cert_antecedentes1Controller($orientation = 'P', $unit = 'mm', $format = 'Letter');
        #Establecemos los márgenes izquierda, arriba y derecha:
        $pdf->SetMargins(15, 10, 10);
        $pdf->SetAutoPageBreak(true, 25);
        $pdf->AddPage();
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetFillColor(166,166,166);
        // Dibuja un contenedor alrededor del contenido (borde del documento)
        $pdf->SetDrawColor(0, 0, 0); // Color negro
        $pdf->SetLineWidth(0.4);     // Grosor de línea
        //$pdf->Rect(10, 10, 195, 130); // (x, y, ancho, alto)
        $pdf->SetFont('Arial','B','12');
        $pdf->Ln(20);
        $pdf->Cell(0, 5, utf8_decode('CERTIFICACIÓN DE ANTECEDENTES ACADÉMICOS'), 0, 1, 'L');
        $pdf->SetFont('Arial','','10');
        $pdf->Ln(2);
        $pdf->Cell(180,4,utf8_decode("A continuación, se certifican los estudios de "),0,1,'');
        $pdf->Cell(30,4,utf8_decode("Nombre: "),0,0,'');
        //$pdf->Cell(140, 4, utf8_decode(ucwords(strtolower($nombre_alumno))), 0, 1, '');
        $pdf->Cell(140, 4, utf8_decode(mb_convert_case($nombre_alumno, MB_CASE_TITLE, 'UTF-8')), 0, 1, '');
        $pdf->Cell(30,4,utf8_decode("Nacionalidad: "),0,0,'');
        //$pdf->Cell(140,5,utf8_decode($datos_alumnos->nacionalidad),0,1,'');
        $pdf->Cell(140, 4, utf8_decode(ucwords(strtolower($datos_alumnos->nacionalidad))), 0, 1, '');
        $pdf->Cell(30,4,utf8_decode("Titulo: "),0,0,'');
        //$pdf->Cell(140,5,utf8_decode($titulo_obtenido),0,1,'');
        /*$titulo = strtolower($titulo_obtenido);
        $titulo = ucwords($titulo);

        $excepciones = ['en', 'de', 'la', 'el', 'y', 'a', 'con'];
        $palabras = explode(' ', $titulo);

        foreach ($palabras as $i => $palabra) {
            if ($i > 0 && in_array(strtolower($palabra), $excepciones)) {
                $palabras[$i] = strtolower($palabra);
            }
        }

        $titulo = implode(' ', $palabras);

        $pdf->Cell(140, 4, utf8_decode($titulo), 0, 1, '');*/

        $titulo = mb_convert_case($titulo_obtenido, MB_CASE_TITLE, 'UTF-8');

// Minúsculas para palabras cortas no al principio
        $excepciones = ['en', 'de', 'la', 'el', 'y', 'a', 'con'];
        $palabras = explode(' ', $titulo);

        foreach ($palabras as $i => $palabra) {
            if ($i > 0 && in_array(mb_strtolower($palabra, 'UTF-8'), $excepciones)) {
                $palabras[$i] = mb_strtolower($palabra, 'UTF-8');
            }
        }

        $titulo = implode(' ', $palabras);

        $pdf->Cell(140, 4, utf8_decode($titulo), 0, 1, '');


        //$pdf->Cell(140, 4, utf8_decode(ucwords(strtolower($titulo_obtenido))), 0, 1, '');
        $pdf->Cell(30,4,utf8_decode("CURP: "),0,0,'');
        $pdf->Cell(140,4,utf8_decode($registro_datos->curp_al),0,1,'');
        $pdf->Ln(5);
        $pdf->SetFont('Arial','B','10');
        $pdf->Cell(150,3,utf8_decode("Estudios de Bachillerato"),0,1,'');
        $pdf->SetFont('Arial','','10');
        $y=$pdf->GetY();
        $x=$pdf->GetX();
        $pdf->Cell(20,3,utf8_decode("Institución: "),0,0,'');
        $pdf->MultiCell(125,3,utf8_decode($datos_alumnos->preparatoria),0,'');
        $yi=$pdf->GetY();
        $pdf->SetXY(160,$y);
        $pdf->Cell(15,3,utf8_decode("Periodo "),0,0,'');
        $pdf->Cell(20,3,utf8_decode($fecha_ingreso_preparatoria." - ".$fecha_egreso_preparatoria),0,1,'C');
        $pdf->SetXY($x,$yi);
        $pdf->Cell(30,3,utf8_decode("Entidad Federativa:"),0,0,'');
        //$pdf->Cell(140,5,utf8_decode($datos_alumnos->nom_entidad),0,1,'');
        //$pdf->Cell(140, 4, utf8_decode(ucwords(strtolower($datos_alumnos->nom_entidad))), 0, 1, '');
        $pdf->Cell(140, 3, utf8_decode(mb_convert_case($datos_alumnos->nom_entidad, MB_CASE_TITLE, 'UTF-8')), 0, 1, '');
        $pdf->Ln(5);
        $pdf->SetFont('Arial','B','10');
        $pdf->Cell(150,3,utf8_decode("Estudios Profesionales"),0,1,'');
        $pdf->SetFont('Arial','','10');
        $pdf->Cell(20,3,utf8_decode("Institución: "),0,0,'');
        $pdf->Cell(125,3,utf8_decode("Tecnológico de Estudios Superiores de Valle de Bravo"),0,0,'');
        $pdf->Cell(15,3,utf8_decode("Periodo "),0,0,'');
        $pdf->Cell(20,3,utf8_decode($fecha_ingreso_tesvb." - ".$fecha_egreso_tesvb),0,1,'C');
        $pdf->Cell(20,3,utf8_decode("Carrera: "),0,0,'');
        //$pdf->Cell(140,5,utf8_decode($registro_datos->carrera),0,1,'');
        //$pdf->Cell(140, 4, utf8_decode(ucwords(strtolower($registro_datos->carrera))), 0, 1, '');
        //$pdf->Cell(140, 3, utf8_decode(mb_convert_case($registro_datos->carrera, MB_CASE_TITLE, 'UTF-8')), 0, 1, '');

        $titulo = mb_convert_case($registro_datos->carrera, MB_CASE_TITLE, 'UTF-8');

        $excepciones = ['en', 'de', 'la', 'el', 'y', 'a', 'con'];
        $palabras = explode(' ', $titulo);

        foreach ($palabras as $i => $palabra) {
            if ($i > 0 && in_array(mb_strtolower($palabra, 'UTF-8'), $excepciones)) {
                $palabras[$i] = mb_strtolower($palabra, 'UTF-8');
            }
        }

        $titulo = implode(' ', $palabras);

        $pdf->Cell(140, 3, utf8_decode($titulo), 0, 1, '');


        $pdf->Cell(30,3,utf8_decode("Entidad Federativa: "),0,0,'');
        $pdf->Cell(140,3,utf8_decode("  México"),0,1,'');
        $pdf->Ln(5);
        $pdf->Cell(40,5,utf8_decode("Opción de Titulación: "),0,0,'');
        $pdf->Cell(105,5,utf8_decode("$registro_datos->opcion_titulacion"),0,0,'');
        $pdf->Cell(25,5,utf8_decode("Fecha: "),0,0,'');
        $pdf->Cell(10,5,utf8_decode($mes_titulacion." ".$dia_titulacion.", ".$year),0,1,'C');
        $pdf->Ln(5);
        $pdf->MultiCell(180,3,utf8_decode('Cumplió con el Servicio Social, conforme al Articulo 55 de la Ley Reglamentaria del Articulo 5° Constitucional, relativo al ejercicio de las profesiones en la Ciudad de México y al Articulo 85 del Reglamento de la Ley Reglamentaria del Articulo 5° Constitucional.'),0,'J');
        $pdf->Ln(5);
        $pdf->Cell(180,5,utf8_decode("Valle de Bravo, Estado de México, a ".$dia_titulacion." de ".$mes_titulacion." de ".$year),0,1,'');
        $pdf->Ln(10);
        $pdf->Cell(180,5,utf8_decode("Subdirección de Servicios Escolares"),0,1,'');
        $pdf->Ln(5);
        //$pdf->Cell(50, 0, '', 'T', 1, 'C');
        $pdf->Ln(2);
        //$pdf->Cell(180, 5, utf8_decode($subdirector_escolares), 0, 1, 'C');
        $pdf->Cell(50, 4, utf8_decode(ucwords(strtolower($subdirector_escolares))), 0, 1, 'C');
        $pdf->Ln(17);
        $pdf->SetDrawColor(0, 0, 0); // Color negro
        $pdf->SetLineWidth(0.4);     // Grosor de línea
        //$pdf->Rect(10, 145, 90, 35); // (x, y, ancho, alto)
        $pdf->Ln(2);
        $pdf->SetFont('Arial','','8');
        $pdf->Cell(60,3,utf8_decode("Registrado en el Departamento de Titulación"),0,1,'C');
        //$pdf->Cell(60,3,utf8_decode("en la foja 0".$numero_foja_titulo."FTE del libro 0".$numero_libro_titulo." el día "),0,1,'C');


        // Centrar manualmente dentro de 60mm de ancho
        $x = ($pdf->GetPageWidth() - 600) / 2;
        $y = $pdf->GetY();
        $pdf->SetXY($x, $y);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial','','8');
        $pdf->Write(3, utf8_decode("en la foja "));
        // Texto rojo -> "0" + numero_foja_titulo
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Write(3, "0FTE".$numero_foja_titulo." ");
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(3, utf8_decode("del libro "));
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Write(3, "0".$numero_libro_titulo." ");
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Write(3, utf8_decode("el día"));
        $pdf->Ln(3); // salto de línea
        $pdf->Cell(60,3,utf8_decode($dia_titulacion." de ".$mes_titulacion." de ".$year),0,1,'C');
        //$pdf->Ln(10);
        //$pdf->Cell(80, 0, '', 'T', 1, 'C');
        $pdf->Ln(5);
        $pdf->Cell(60,5,utf8_decode("I.F Noemí Marín Gómez"),0,1,'C');
        $y3=$pdf->GetY();
        $pdf->SetFont('Arial','','8');
        $pdf->SetDrawColor(0, 0, 0); // Color negro
        $pdf->SetLineWidth(0.4);     // Grosor de línea
        //$pdf->Rect(115, 145, 90, 35); // (x, y, ancho, alto)
        // Texto y línea para la firma del interesado (dentro del recuadro derecho)
        $pdf->SetXY(115, 170); // posición dentro del recuadro derecho
        //$pdf->Cell(90, 5, utf8_decode(""), 0, 1, 'C');

        $pdf->Output();
        exit;

    }
}
