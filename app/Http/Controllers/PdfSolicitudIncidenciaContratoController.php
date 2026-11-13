<?php
namespace App\Http\Controllers;
use Codedge\Fpdf\Fpdf\Fpdf as FPDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class PDF_PdfSolicitudIncidenciaContratoController extends FPDF
{
    //CABECERA DE LA PAGINA
    function Header()
    {
        if (count($this->pages) === 1) {
        $this->Image('img/nuevo/log_tesvb.png',10,5,200,18);
        $this->Image('img/nuevo/colibri.png',15,45,190,220);
        $this->SetFont('Arial','B',7);
        }
    }
    //PIE DE PAGINA
    function Footer()
    {
        if (count($this->pages) === 1) {-
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
}
class PdfSolicitudIncidenciaContratoController extends Controller
{
    /////////CONTRATO COLECTIVO/////////
    public function index1($id_solicitud) {

    $solicitud=DB::selectOne('SELECT gnral_personales.nombre, inc_solicitudes.motivo_oficio,inc_solicitudes.fecha_req,inc_solicitudes.hora_e,inc_solicitudes.hora_st,
    inc_articulos.descripcion_art, inc_articulos.nombre_articulosolo
    FROM inc_solicitudes, inc_articulos, gnral_personales WHERE inc_solicitudes.id_personal=gnral_personales.id_personal AND id_solicitud= ?', [$id_solicitud]);

    $nombre_personal=DB::SelectOne('SELECT abreviaciones.titulo,gnral_personales.nombre, gnral_cargos.cargo FROM
    abreviaciones, abreviaciones_prof,gnral_personales,gnral_cargos, inc_solicitudes WHERE
    abreviaciones.id_abreviacion=abreviaciones_prof.id_abreviacion
    AND abreviaciones_prof.id_personal=gnral_personales.id_personal AND gnral_personales.id_personal=inc_solicitudes.id_personal
    AND gnral_personales.id_cargo=gnral_cargos.id_cargo AND inc_solicitudes.id_solicitud= ?', [$id_solicitud]);

        $jefe_personal=DB::selectOne('SELECT abreviaciones.titulo, gnral_personales.nombre, gnral_unidad_administrativa.jefe_descripcion
   FROM abreviaciones, abreviaciones_prof, gnral_personales, gnral_unidad_personal, gnral_unidad_administrativa
   WHERE gnral_unidad_administrativa.id_unidad_admin=23 AND gnral_unidad_personal.id_personal = gnral_personales.id_personal
   AND gnral_personales.id_personal = abreviaciones_prof.id_personal AND abreviaciones_prof.id_abreviacion = abreviaciones.id_abreviacion
   AND gnral_unidad_personal.id_unidad_admin = gnral_unidad_administrativa.id_unidad_admin');
        //dd($jefe_personal);
        //dd($nombre_personal);
        $nombre_jefe=DB::SelectOne('SELECT inc_solicitudes.id_solicitud,abreviaciones.titulo,gnral_personales.nombre,gnral_unidad_administrativa.clave, gnral_unidad_administrativa.jefe_descripcion
        FROM abreviaciones, abreviaciones_prof,gnral_personales,gnral_unidad_administrativa,gnral_unidad_personal, inc_solicitudes
        WHERE abreviaciones.id_abreviacion=abreviaciones_prof.id_abreviacion
        AND abreviaciones_prof.id_personal=gnral_personales.id_personal AND gnral_personales.id_personal=inc_solicitudes.id_jefe
        and inc_solicitudes.id_solicitud= ? and gnral_personales.id_personal=gnral_unidad_personal.id_personal
        and gnral_unidad_personal.id_unidad_admin=gnral_unidad_administrativa.id_unidad_admin ', [$id_solicitud]);
       //dd($nombre_jefe);
        $etiqueta=DB::selectOne('SELECT * FROM etiqueta WHERE id_etiqueta = 1 ');
       // $articulos= DB::select('SELECT * from inc_articulos ORDER by nombre_articulo ASC');
       // dd($articulos);
       // return view('incidencias.pdfincidencia', compact('articulos'));
       {
        $pdf=new PDF_PdfSolicitudIncidenciaContratoController($orientation='P',$unit='mm',$format='Letter');
        #Establecemos los márgenes izquierda, arriba y derecha:
        $pdf->SetMargins(20, 25 , 20);
        $pdf->SetAutoPageBreak(true,25);
        $pdf->AddPage();
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetLineWidth(0.2);
        $pdf->SetFont('Arial','','8');
        $pdf->Cell(40);
           $pdf->Ln(3);
           $pdf->SetFont('Arial','B',7);
           $pdf->Cell(44);
           $pdf->Cell(135,-2,utf8_decode('Tecnológico de Estudios Superiores de Valle de Bravo'),0,0,'R');
           $pdf->Ln(3);
           $pdf->Cell(44);
           $pdf->Cell(135,-2,utf8_decode('Dirección General'),0,0,'R');
           $pdf->Ln(3);
           $pdf->SetFont('Arial','',6.5);
           $pdf->Cell(44);
           $pdf->Cell(135,-2,utf8_decode('Dirección de Administración y Finanzas'),0,0,'R');
           $pdf->Ln(3);
           $pdf->Cell(44);
           $pdf->Cell(135,-2,utf8_decode('Departamento de Administración de Personal'),0,0,'R');
           $pdf->Ln(5);
        $pdf->SetFont('Arial','','8');
        $pdf->Cell(40);
        $pdf->Ln();
        $pdf->SetFont('Arial','','7');
        $pdf->Cell(135);
        $pdf->Cell(44,4,utf8_decode('Valle de Bravo, México.'),0,0,'R');

        //fecha
        $fechas = date("d-m-Y");

        $num=date("j",strtotime($fechas));
        $ano=date("Y", strtotime($fechas));
        $mes= array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
        $mes=$mes[(date('m', strtotime($fechas))*1)-1];
        $fech= $num. ' de '.$mes.' del '.$ano;


           $fecha_req=$solicitud->fecha_req;

           $num1=date("j",strtotime($fecha_req));
           $ano1=date("Y", strtotime($fecha_req));
           $mes1= array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
           $mes1=$mes1[(date('m', strtotime($fecha_req))*1)-1];
           $fecha_reg="el dia ".$num1. ' de '.$mes1.' del '.$ano1;

        $pdf->Ln(4);
           $pdf->SetFont('Arial','','7');
           $pdf->Cell(135);
           $pdf->Cell(44,4,utf8_decode($fech),0,0,'R');
           $pdf->Ln();
           $pdf->SetFont('Arial','','7');
           $pdf->Cell(135);
           $numero=$id_solicitud;
           $pdf->Cell(44,4,utf8_decode('Oficio No. '.$nombre_jefe->clave.'/'.$nombre_jefe->id_solicitud.'/'.$ano),0,0,'R');
           $pdf->SetFont('Arial','B','10');


           $pdf->Ln(10);
           $pdf->Cell(180, 5, utf8_decode($jefe_personal->titulo.' '. $jefe_personal->nombre), 0, 1, '');
           $pdf->Cell(180, 5, utf8_decode($jefe_personal->jefe_descripcion), 0, 1, '');
           $pdf->SetFont('Arial','B','10');
           $pdf->Cell(80, 5, utf8_decode('PRESENTE'), 0, 0, '');

           $pdf->Ln(10);
           $pdf->SetFont('Arial','','11');
           $pdf->Cell(177,5,utf8_decode('Por medio del presente me permito enviarle un coordial saludo y al mismo tiempo solicitar a usted de'),0,'J',1);
           $pdf->Ln(5);
           $pdf->SetFont('Arial','','11');
           $pdf->Cell(166,5,utf8_decode('la manera más atenta y amable, que con fundamento en el/la '.$solicitud->nombre_articulosolo.' estipulado en el Reglamento'),0,'J',1);
           $pdf->Ln(5);
           $pdf->SetFont('Arial', '', '11');
           $pdf->Cell(175, 5,utf8_decode('Interno del Trabajo del Tecnológico de Estudios Superiores de Valle de Bravo, que a la letra dice:'),0,'J',1);
           $pdf->Ln(8);
           $pdf->SetFont('Arial', 'I', '11');
           $pdf->MultiCell(177, 5,utf8_decode(' "'.$solicitud->descripcion_art.'"'),0,'J',0);
           $pdf->Ln(5);
           $pdf->SetFont('Arial', '', '11');
           $pdf->MultiCell(177, 5,utf8_decode('Con lo anterior mencionado solicito el día '.$fecha_reg.' para cumplir con el siguiente motivo: '.$solicitud->motivo_oficio.''),0,'J',0);


           $pdf->Ln(6);
           $pdf->SetFont('Arial', '', '11');
           $pdf->Cell(90, 5,utf8_decode('Sin otro particular por el momento, quedó de usted.'),0,0,0);

           $pdf->Ln(20);
           $pdf->SetFont('Arial', 'B', '8');
           $pdf->Cell(90, 10, utf8_decode('A T E N T A M E N T E'), 0, 0, 'L');
           $pdf->Cell(90, 10, utf8_decode('Vo. Bo.'), 0, 1, 'C');
           $pdf->Ln(10);
           $pdf->Cell(90, 5, utf8_decode($nombre_personal->titulo.' '. $nombre_personal->nombre), 0, 0, 'L');
           $pdf->Cell(90, 5, utf8_decode($nombre_jefe->titulo.' '. $nombre_jefe->nombre), 0, 1, 'C');
           $y=$pdf->GetY();
           //dd($y);
           $pdf->Cell(90, 5, utf8_decode($nombre_personal->cargo),0 , 0, 'L');
           $pdf->SetXY(110,$y);
           $pdf->Cell(90, 5, utf8_decode($nombre_jefe->jefe_descripcion),0 , 1, 'C');
           $pdf->Ln(20);
           $pdf->SetFont('Arial', '', '8');
           $pdf->Cell(10, 5, utf8_decode('Nombre, Fecha, Hora y Firma de autorización'), 0, 0, 'L');


        }
//////////////////////////////NO BORRAR//////////
    $pdf->Output();
    exit();
}
///////////REGLAMENTO INTERNO////////////
public function index2($id_solicitud)

{
   /*$fechar=($fechass->fecha_req);
   $fechass=DB::SelectOne('SELECT fecha_req FROM `inc_solicitudes` WHERE inc_solicitudes.id_personal ');*/
   $solicitud=DB::selectOne('select gnral_personales.nombre, inc_solicitudes.motivo_oficio,
       inc_solicitudes.fecha_req, inc_solicitudes.hora_e,inc_solicitudes.fecha_invac,inc_solicitudes.fecha_tervac,inc_solicitudes.hora_st, inc_articulos.descripcion_art,
       inc_articulos.nombre_articulosolo,inc_articulos.id_articulo from gnral_personales, inc_solicitudes, inc_articulos
       where gnral_personales.id_personal=inc_solicitudes.id_personal and
             inc_articulos.id_articulo=inc_solicitudes.id_articulo and
             inc_solicitudes.id_solicitud= ?', [$id_solicitud]);

 //  dd($solicitud);
    $jefe_personal=DB::selectOne('SELECT abreviaciones.titulo, gnral_personales.nombre, gnral_unidad_administrativa.jefe_descripcion
   from abreviaciones, abreviaciones_prof, gnral_personales, gnral_unidad_personal, gnral_unidad_administrativa
   WHERE gnral_unidad_administrativa.id_unidad_admin=23 and gnral_unidad_personal.id_personal = gnral_personales.id_personal
   and gnral_personales.id_personal = abreviaciones_prof.id_personal and abreviaciones_prof.id_abreviacion = abreviaciones.id_abreviacion
   and gnral_unidad_personal.id_unidad_admin = gnral_unidad_administrativa.id_unidad_admin');


$nombre_personal=DB::SelectOne('SELECT abreviaciones.titulo,gnral_personales.nombre, gnral_cargos.cargo FROM abreviaciones, abreviaciones_prof,gnral_personales,gnral_cargos, inc_solicitudes WHERE abreviaciones.id_abreviacion=abreviaciones_prof.id_abreviacion
AND abreviaciones_prof.id_personal=gnral_personales.id_personal AND gnral_personales.id_personal=inc_solicitudes.id_personal and gnral_personales.id_cargo=gnral_cargos.id_cargo and inc_solicitudes.id_solicitud= ?', [$id_solicitud]);
$nombre_jefe=DB::SelectOne('SELECT gnral_unidad_administrativa.clave,inc_solicitudes.id_solicitud, abreviaciones.titulo,gnral_personales.nombre, gnral_unidad_administrativa.jefe_descripcion FROM abreviaciones, abreviaciones_prof,gnral_personales,gnral_unidad_administrativa,gnral_unidad_personal, inc_solicitudes WHERE abreviaciones.id_abreviacion=abreviaciones_prof.id_abreviacion
AND abreviaciones_prof.id_personal=gnral_personales.id_personal AND gnral_personales.id_personal=inc_solicitudes.id_jefe and inc_solicitudes.id_solicitud= ? and gnral_personales.id_personal=gnral_unidad_personal.id_personal
and gnral_unidad_personal.id_unidad_admin=gnral_unidad_administrativa.id_unidad_admin ', [$id_solicitud]);
//dd($nombre_jefe);

    $pdf=new PDF_PdfSolicitudIncidenciaContratoController($orientation='P',$unit='mm',$format='Letter');
    #Establecemos los márgenes izquierda, arriba y derecha:

    $pdf->SetMargins(20, 25 , 20);
    $pdf->SetAutoPageBreak(true,25);
    $pdf->AddPage();
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(0.2);
    $pdf->SetFont('Arial','','7');
    $pdf->Cell(40);

    $pdf->Ln(3);
    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(44);
    $pdf->Cell(135,-2,utf8_decode('Tecnológico de Estudios Superiores de Valle de Bravo'),0,0,'R');
    $pdf->Ln(3);
    $pdf->Cell(44);
    $pdf->Cell(135,-2,utf8_decode('Dirección General'),0,0,'R');
    $pdf->Ln(3);
    $pdf->SetFont('Arial','',6.5);
    $pdf->Cell(44);
    $pdf->Cell(135,-2,utf8_decode('Dirección de Administración y Finanzas'),0,0,'R');
    $pdf->Ln(3);
    $pdf->Cell(44);
    $pdf->Cell(135,-2,utf8_decode('Departamento de Administración de Personal'),0,0,'R');

    $pdf->Ln(2);
    $pdf->SetFont('Arial','','7');
    $pdf->Cell(130);
    $pdf->Cell(50,4,utf8_decode('Valle de Bravo,México.'),0,0,'R');

    //fecha
    $fechas = date("d-m-Y");

    $num=date("j",strtotime($fechas));
    $ano=date("Y", strtotime($fechas));
    $mes= array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
    $mes=$mes[(date('m', strtotime($fechas))*1)-1];
    $fech= $num. ' de '.$mes.' del '.$ano;


    if($solicitud->id_articulo == 1 || $solicitud->id_articulo == 4 || $solicitud->id_articulo == 5 || $solicitud->id_articulo == 6
        || $solicitud->id_articulo == 7  || $solicitud->id_articulo == 9 || $solicitud->id_articulo == 10    )
    {
        $fecha_req=$solicitud->fecha_req;

        $num1=date("j",strtotime($fecha_req));
        $ano1=date("Y", strtotime($fecha_req));
        $mes1= array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
        $mes1=$mes1[(date('m', strtotime($fecha_req))*1)-1];
        $fecha_reg="el dia ".$num1. ' de '.$mes1.' del '.$ano1;
    }else{


                if($solicitud->fecha_invac == $solicitud->fecha_tervac)
                {
                    $periodo=$solicitud->fecha_invac;

                    $num2=date("j",strtotime($periodo));
                    $ano2=date("Y", strtotime($periodo));
                    $mes2= array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
                    $mes2=$mes2[(date('m', strtotime($periodo))*1)-1];
                    $fecha_reg="el dia ".$num2. ' de '.$mes2.' del '.$ano2;

                }else{
                    $fecha_invac=$solicitud->fecha_invac;

                    $num3=date("j",strtotime($fecha_invac));
                    $ano3=date("Y", strtotime($fecha_invac));
                    $mes3= array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
                    $mes3=$mes3[(date('m', strtotime($fecha_invac))*1)-1];
                  ///  $fecha_periodo_inicio= $num3. ' de '.$mes3;


                    $fecha_tervac=$solicitud->fecha_tervac;

                    $num4=date("j",strtotime($fecha_tervac));
                    $ano4=date("Y", strtotime($fecha_tervac));
                    $mes4= array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
                    $mes4=$mes4[(date('m', strtotime($fecha_tervac))*1)-1];
                    //$fecha_periodo_final= $num4. ' de '.$mes4;

                    if($ano3 == $ano4){
                        if($mes3 == $mes4)
                        {
                            $fecha_reg="los dias del ".$num3." al ".$num4." de ".$mes3." del ".$ano3;


                        }else{
                            $fecha_reg="los dias del ".$num3." de ".$mes3." al ".$num4." de ".$mes4." del ".$ano3;

                        }

                    }else{
                        $fecha_reg="los dias del ".$num3." de ".$mes3." del ".$ano3." al ".$num4." de ".$mes4." del ".$ano4;

                    }

                }




    }
    $fecha_req=$solicitud->fecha_req;

    $num=date("j",strtotime($fecha_req));
    $ano=date("Y", strtotime($fecha_req));
     $mes=date('m', strtotime($fecha_req));
    $fecha_req= $num. '-'.$mes.'-'.$ano;
    //dd($fecha_req);
    $pdf->Ln(4);
        $pdf->SetFont('Arial','','7');
        $pdf->Cell(130);
        $pdf->Cell(50,4,utf8_decode($fech),0,0,'R');
        $pdf->Ln();
        $pdf->SetFont('Arial','','7');
        $pdf->Cell(130);
        $numero=$id_solicitud;
        $pdf->Cell(50,4,utf8_decode('Oficio No. '.$nombre_jefe->clave.'/'.$nombre_jefe->id_solicitud.'/'.$ano),0,0,'R');
        $pdf->SetFont('Arial','B','10');


    $pdf->Ln(10);
    $pdf->Cell(180, 5, utf8_decode($jefe_personal->titulo.' '. $jefe_personal->nombre), 0, 1, '');
    $pdf->Cell(180, 5, utf8_decode($jefe_personal->jefe_descripcion), 0, 1, '');
    $pdf->SetFont('Arial','B','10');
    $pdf->Cell(80, 5, utf8_decode('PRESENTE'), 0, 0, '');

    $pdf->Ln(10);
    $pdf->SetFont('Arial','','11');
    $pdf->Cell(177,5,utf8_decode('Por medio del presente me permito enviarle un coordial saludo y al mismo tiempo solicitar a usted de'),0,'J',1);
    $pdf->Ln(5);
    $pdf->SetFont('Arial','','11');
    $pdf->Cell(166,5,utf8_decode('la manera más atenta y amable, que con fundamento en el/la '.$solicitud->nombre_articulosolo.' estipulado en el Reglamento'),0,'J',1);
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', '11');
    $pdf->Cell(175, 5,utf8_decode('Interno del Trabajo del Tecnológico de Estudios Superiores de Valle de Bravo, que a la letra dice:'),0,'J',1);
    $pdf->Ln(8);
    $pdf->SetFont('Arial', 'I', '11');
    $pdf->MultiCell(177, 5,utf8_decode(' "'.$solicitud->descripcion_art.'"'),0,'J',0);
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', '11');
    $pdf->MultiCell(177, 5,utf8_decode('Con lo anterior mencionado solicito '.$fecha_reg.' para cumplir con el siguiente motivo: '.$solicitud->motivo_oficio.''),0,'J',0);


        $pdf->Ln(6);
        $pdf->SetFont('Arial', '', '11');
        $pdf->Cell(90, 5,utf8_decode('Sin otro particular por el momento, quedó de usted.'),0,0,0);

        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', '8');
        $pdf->Cell(90, 10, utf8_decode('A T E N T A M E N T E'), 0, 0, 'L');
        $pdf->Cell(90, 10, utf8_decode('Vo. Bo.'), 0, 1, 'C');
        $pdf->Ln(10);
        $pdf->Cell(90, 5, utf8_decode($nombre_personal->titulo.' '. $nombre_personal->nombre), 0, 0, 'L');
        $pdf->Cell(90, 5, utf8_decode($nombre_jefe->titulo.' '. $nombre_jefe->nombre), 0, 1, 'C');
         $y=$pdf->GetY();
         //dd($y);
        $pdf->Cell(90, 5, utf8_decode($nombre_personal->cargo),0 , 0, 'L');
        $pdf->SetXY(110,$y);
        $pdf->Cell(90, 5, utf8_decode($nombre_jefe->jefe_descripcion),0 , 1, 'C');
        $pdf->Ln(20);
        $pdf->SetFont('Arial', '', '8');
        $pdf->Cell(10, 5, utf8_decode('Nombre, Fecha, Hora y Firma de autorización'), 0, 0, 'L');
        $pdf->Output();
    exit();}

public function index3($id_solicitud)

{



    // dd($id_solicitud);
    /*$fechar=($fechass->fecha_req);
    $fechass=DB::SelectOne('SELECT fecha_req FROM `inc_solicitudes` WHERE inc_solicitudes.id_personal ');*/
    $solicitud=DB::selectOne('select gnral_personales.nombre, inc_solicitudes.motivo_oficio,
       inc_solicitudes.fecha_req, inc_solicitudes.hora_e,inc_solicitudes.fecha_invac,inc_Solicitudes.fecha_tervac,inc_solicitudes.hora_st, inc_articulos.descripcion_art,
       inc_articulos.nombre_articulosolo,inc_articulos.id_articulo, inc_solicitudes.direc_finanzas from gnral_personales, inc_solicitudes, inc_articulos
       where gnral_personales.id_personal=inc_solicitudes.id_personal and
             inc_articulos.id_articulo=inc_solicitudes.id_articulo and
             inc_solicitudes.id_solicitud= ?', [$id_solicitud]);

    $jefe_a_d=DB::selectOne('SELECT abreviaciones.titulo, gnral_personales.nombre, gnral_unidad_administrativa.jefe_descripcion
    from abreviaciones, abreviaciones_prof, gnral_personales, gnral_unidad_personal, gnral_unidad_administrativa
    where abreviaciones.id_abreviacion = abreviaciones_prof.id_abreviacion and abreviaciones_prof.id_personal=gnral_personales.id_personal
      and gnral_personales.id_personal = gnral_unidad_personal.id_personal and gnral_unidad_personal.id_unidad_admin = gnral_unidad_administrativa.id_unidad_admin
      and gnral_personales.id_personal= ?', [$solicitud->direc_finanzas]);

    $titulo_finanzas= mb_strtoupper($jefe_a_d->titulo, 'utf-8');
  //  dd($jefe_a_d);


    //  dd($solicitud);
    $jefe_personal=DB::selectOne('SELECT abreviaciones.titulo, gnral_personales.nombre, gnral_unidad_administrativa.jefe_descripcion
   from abreviaciones, abreviaciones_prof, gnral_personales, gnral_unidad_personal, gnral_unidad_administrativa
   WHERE gnral_unidad_administrativa.id_unidad_admin=23 and gnral_unidad_personal.id_personal = gnral_personales.id_personal
   and gnral_personales.id_personal = abreviaciones_prof.id_personal and abreviaciones_prof.id_abreviacion = abreviaciones.id_abreviacion
   and gnral_unidad_personal.id_unidad_admin = gnral_unidad_administrativa.id_unidad_admin');


    $nombre_personal=DB::SelectOne('SELECT abreviaciones.titulo,gnral_personales.nombre, gnral_cargos.cargo FROM abreviaciones, abreviaciones_prof,gnral_personales,gnral_cargos, inc_solicitudes WHERE abreviaciones.id_abreviacion=abreviaciones_prof.id_abreviacion
AND abreviaciones_prof.id_personal=gnral_personales.id_personal AND gnral_personales.id_personal=inc_solicitudes.id_personal and gnral_personales.id_cargo=gnral_cargos.id_cargo and inc_solicitudes.id_solicitud= ?', [$id_solicitud]);

    $nombre_jefe=DB::SelectOne('SELECT gnral_unidad_administrativa.clave,inc_solicitudes.id_solicitud, abreviaciones.titulo,gnral_personales.nombre, gnral_unidad_administrativa.jefe_descripcion FROM abreviaciones, abreviaciones_prof,gnral_personales,gnral_unidad_administrativa,gnral_unidad_personal, inc_solicitudes WHERE abreviaciones.id_abreviacion=abreviaciones_prof.id_abreviacion
AND abreviaciones_prof.id_personal=gnral_personales.id_personal AND gnral_personales.id_personal=inc_solicitudes.id_jefe and inc_solicitudes.id_solicitud= ? and gnral_personales.id_personal=gnral_unidad_personal.id_personal
and gnral_unidad_personal.id_unidad_admin=gnral_unidad_administrativa.id_unidad_admin ', [$id_solicitud]);
//dd($nombre_jefe);

    $pdf=new PDF_PdfSolicitudIncidenciaContratoController($orientation='P',$unit='mm',$format='Letter');
    #Establecemos los márgenes izquierda, arriba y derecha:

    $pdf->SetMargins(20, 25 , 20);
    $pdf->SetAutoPageBreak(true,25);
    $pdf->AddPage();
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(0.2);
    $pdf->SetFont('Arial','','7');
    $pdf->Cell(40);

    $pdf->Ln(3);
    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(44);
    $pdf->Cell(135,-2,utf8_decode('Tecnológico de Estudios Superiores de Valle de Bravo'),0,0,'R');
    $pdf->Ln(3);
    $pdf->Cell(44);
    $pdf->Cell(135,-2,utf8_decode('Dirección General'),0,0,'R');
    $pdf->Ln(3);
    $pdf->SetFont('Arial','',6.5);
    $pdf->Cell(44);
    $pdf->Cell(135,-2,utf8_decode('Dirección de Administración y Finanzas'),0,0,'R');
    $pdf->Ln(3);
    $pdf->Cell(44);
    $pdf->Cell(135,-2,utf8_decode('Departamento de Administración de Personal'),0,0,'R');

    $pdf->Ln(2);
    $pdf->SetFont('Arial','','7');
    $pdf->Cell(130);
    $pdf->Cell(50,4,utf8_decode('Valle de Bravo,México.'),0,0,'R');

    //fecha
    $fechas = date("d-m-Y");

    $num=date("j",strtotime($fechas));
    $ano=date("Y", strtotime($fechas));
    $mes= array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
    $mes=$mes[(date('m', strtotime($fechas))*1)-1];
    $fech= $num. ' de '.$mes.' del '.$ano;


    if($solicitud->id_articulo == 1 || $solicitud->id_articulo == 4 || $solicitud->id_articulo == 5 || $solicitud->id_articulo == 6
        || $solicitud->id_articulo == 7  || $solicitud->id_articulo == 9 || $solicitud->id_articulo == 10    )
    {
        $fecha_req=$solicitud->fecha_req;

        $num1=date("j",strtotime($fecha_req));
        $ano1=date("Y", strtotime($fecha_req));
        $mes1= array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
        $mes1=$mes1[(date('m', strtotime($fecha_req))*1)-1];
        $fecha_reg="el dia ".$num1. ' de '.$mes1.' del '.$ano1;
    }else{


        if($solicitud->fecha_invac == $solicitud->fecha_tervac)
        {
            $periodo=$solicitud->fecha_invac;

            $num2=date("j",strtotime($periodo));
            $ano2=date("Y", strtotime($periodo));
            $mes2= array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
            $mes2=$mes2[(date('m', strtotime($periodo))*1)-1];
            $fecha_reg="el dia ".$num2. ' de '.$mes2.' del '.$ano2;

        }else{
            $fecha_invac=$solicitud->fecha_invac;

            $num3=date("j",strtotime($fecha_invac));
            $ano3=date("Y", strtotime($fecha_invac));
            $mes3= array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
            $mes3=$mes3[(date('m', strtotime($fecha_invac))*1)-1];
            ///  $fecha_periodo_inicio= $num3. ' de '.$mes3;


            $fecha_tervac=$solicitud->fecha_tervac;

            $num4=date("j",strtotime($fecha_tervac));
            $ano4=date("Y", strtotime($fecha_tervac));
            $mes4= array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
            $mes4=$mes4[(date('m', strtotime($fecha_tervac))*1)-1];
            //$fecha_periodo_final= $num4. ' de '.$mes4;

            if($ano3 == $ano4){
                if($mes3 == $mes4)
                {
                    $fecha_reg="los dias del ".$num3." al ".$num4." de ".$mes3." del ".$ano3;


                }else{
                    $fecha_reg="los dias del ".$num3." de ".$mes3." al ".$num4." de ".$mes4." del ".$ano3;

                }

            }else{
                $fecha_reg="los dias del ".$num3." de ".$mes3." del ".$ano3." al ".$num4." de ".$mes4." del ".$ano4;

            }

        }




    }
    $fecha_req=$solicitud->fecha_req;

    $num=date("j",strtotime($fecha_req));
    $ano=date("Y", strtotime($fecha_req));
    $mes=date('m', strtotime($fecha_req));
    $fecha_req= $num. '-'.$mes.'-'.$ano;
    //dd($fecha_req);
    $pdf->Ln(4);
    $pdf->SetFont('Arial','','7');
    $pdf->Cell(130);
    $pdf->Cell(50,4,utf8_decode($fech),0,0,'R');
    $pdf->Ln();
    $pdf->SetFont('Arial','','7');
    $pdf->Cell(130);
    $numero=$id_solicitud;
    $pdf->Cell(50,4,utf8_decode('Oficio No. '.$nombre_jefe->clave.'/'.$nombre_jefe->id_solicitud.'/'.$ano),0,0,'R');
    $pdf->SetFont('Arial','B','10');


    $pdf->Ln(10);
    $pdf->Cell(180, 5, utf8_decode($titulo_finanzas.' '. $jefe_a_d->nombre), 0, 1, '');
    $pdf->Cell(180, 5, utf8_decode($jefe_a_d->jefe_descripcion), 0, 1, '');
    $pdf->SetFont('Arial','B','10');
    $pdf->Cell(80, 5, utf8_decode('PRESENTE'), 0, 0, '');

    $pdf->Ln(10);
    $pdf->SetFont('Arial','','11');
    $pdf->Cell(177,5,utf8_decode('Por medio del presente me permito enviarle un coordial saludo y al mismo tiempo solicitar a usted de'),0,'J',1);
    $pdf->Ln(5);
    $pdf->SetFont('Arial','','11');
    $pdf->Cell(166,5,utf8_decode('la manera más atenta y amable, que con fundamento en el/la '.$solicitud->nombre_articulosolo.' estipulado en el Reglamento'),0,'J',1);
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', '11');
    $pdf->Cell(175, 5,utf8_decode('Interno del Trabajo del Tecnológico de Estudios Superiores de Valle de Bravo, que a la letra dice:'),0,'J',1);
    $pdf->Ln(8);
    $pdf->SetFont('Arial', 'I', '11');
    $pdf->MultiCell(177, 5,utf8_decode(' "'.$solicitud->descripcion_art.'"'),0,'J',0);
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', '11');
    $pdf->MultiCell(177, 5,utf8_decode('Con lo anterior mencionado solicito '.$fecha_reg.' para cumplir con el siguiente motivo: '.$solicitud->motivo_oficio.''),0,'J',0);


    $pdf->Ln(6);
    $pdf->SetFont('Arial', '', '11');
    $pdf->Cell(90, 5,utf8_decode('Sin otro particular por el momento, quedó de usted.'),0,0,0);

    $pdf->Ln(20);
    $pdf->SetFont('Arial', 'B', '8');
    $pdf->Cell(90, 10, utf8_decode('A T E N T A M E N T E'), 0, 0, 'L');
    $pdf->Cell(90, 10, utf8_decode('Vo. Bo.'), 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->Cell(90, 5, utf8_decode($nombre_personal->titulo.' '. $nombre_personal->nombre), 0, 0, 'L');
    $pdf->Cell(90, 5, utf8_decode($nombre_jefe->titulo.' '. $nombre_jefe->nombre), 0, 1, 'C');
    $y=$pdf->GetY();
    //dd($y);
    $pdf->Cell(90, 5, utf8_decode($nombre_personal->cargo),0 , 0, 'L');
    $pdf->SetXY(110,$y);
    $pdf->Cell(90, 5, utf8_decode($nombre_jefe->jefe_descripcion),0 , 1, 'C');
    $pdf->Ln(20);
    $pdf->SetFont('Arial', '', '8');
    $pdf->Cell(10, 5, utf8_decode('Nombre, Fecha, Hora y Firma de autorización'), 0, 0, 'L');
    $pdf->Output();
    exit();
}
public function index4($id_solicitud){

    $solicitud=DB::selectOne('select gnral_personales.nombre, inc_solicitudes.motivo_oficio,inc_solicitudes.fecha_req,inc_solicitudes.hora_e,inc_solicitudes.hora_st, inc_articulos.descripcion_art, inc_articulos.nombre_articulosolo
    FROM inc_solicitudes, inc_articulos, gnral_personales
    WHERE inc_solicitudes.id_personal=gnral_personales.id_personal and id_solicitud= ?', [$id_solicitud]);


    $nombre_personal=DB::SelectOne('SELECT abreviaciones.titulo,gnral_personales.nombre, gnral_cargos.cargo FROM
        abreviaciones, abreviaciones_prof,gnral_personales,gnral_cargos, inc_solicitudes WHERE
        abreviaciones.id_abreviacion=abreviaciones_prof.id_abreviacion
        AND abreviaciones_prof.id_personal=gnral_personales.id_personal AND gnral_personales.id_personal=inc_solicitudes.id_personal
        and gnral_personales.id_cargo=gnral_cargos.id_cargo and inc_solicitudes.id_solicitud= ?', [$id_solicitud]);

    $jefe_personal=DB::selectOne('SELECT abreviaciones.titulo, gnral_personales.nombre, gnral_unidad_administrativa.jefe_descripcion
   from abreviaciones, abreviaciones_prof, gnral_personales, gnral_unidad_personal, gnral_unidad_administrativa
   WHERE gnral_unidad_administrativa.id_unidad_admin=23 and gnral_unidad_personal.id_personal = gnral_personales.id_personal
   and gnral_personales.id_personal = abreviaciones_prof.id_personal and abreviaciones_prof.id_abreviacion = abreviaciones.id_abreviacion
   and gnral_unidad_personal.id_unidad_admin = gnral_unidad_administrativa.id_unidad_admin');

    $director=DB::selectOne('SELECT abreviaciones.titulo, gnral_personales.nombre, gnral_unidad_administrativa.jefe_descripcion
   from abreviaciones, abreviaciones_prof, gnral_personales, gnral_unidad_personal, gnral_unidad_administrativa
   WHERE gnral_unidad_administrativa.id_unidad_admin=3 and gnral_unidad_personal.id_personal = gnral_personales.id_personal
   and gnral_personales.id_personal = abreviaciones_prof.id_personal and abreviaciones_prof.id_abreviacion = abreviaciones.id_abreviacion
   and gnral_unidad_personal.id_unidad_admin = gnral_unidad_administrativa.id_unidad_admin');
  //  dd($director);
    //dd($jefe_personal);
    //dd($nombre_personal);
    $nombre_jefe=DB::SelectOne('SELECT inc_solicitudes.id_solicitud,abreviaciones.titulo,gnral_personales.nombre,gnral_unidad_administrativa.clave, gnral_unidad_administrativa.jefe_descripcion
        FROM abreviaciones, abreviaciones_prof,gnral_personales,gnral_unidad_administrativa,gnral_unidad_personal, inc_solicitudes
        WHERE abreviaciones.id_abreviacion=abreviaciones_prof.id_abreviacion
        AND abreviaciones_prof.id_personal=gnral_personales.id_personal AND gnral_personales.id_personal=inc_solicitudes.id_jefe
        and inc_solicitudes.id_solicitud= ? and gnral_personales.id_personal=gnral_unidad_personal.id_personal
        and gnral_unidad_personal.id_unidad_admin=gnral_unidad_administrativa.id_unidad_admin ', [$id_solicitud]);
    //dd($nombre_jefe);
    $etiqueta=DB::selectOne('SELECT * FROM etiqueta WHERE id_etiqueta = 1 ');
    // $articulos= DB::select('SELECT * from inc_articulos ORDER by nombre_articulo ASC');
    // dd($articulos);
    // return view('incidencias.pdfincidencia', compact('articulos'));
    {
        $pdf=new PDF_PdfSolicitudIncidenciaContratoController($orientation='P',$unit='mm',$format='Letter');
        #Establecemos los márgenes izquierda, arriba y derecha:
        $pdf->SetMargins(20, 25 , 20);
        $pdf->SetAutoPageBreak(true,25);
        $pdf->AddPage();
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetLineWidth(0.2);
        $pdf->SetFont('Arial','','8');
        $pdf->Cell(40);
        $pdf->Ln(3);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(44);
        $pdf->Cell(135,-2,utf8_decode('Tecnológico de Estudios Superiores de Valle de Bravo'),0,0,'R');
        $pdf->Ln(3);
        $pdf->Cell(44);
        $pdf->Cell(135,-2,utf8_decode('Dirección General'),0,0,'R');
        $pdf->Ln(3);
        $pdf->SetFont('Arial','',6.5);
        $pdf->Cell(44);
        $pdf->Cell(135,-2,utf8_decode('Dirección de Administración y Finanzas'),0,0,'R');
        $pdf->Ln(3);
        $pdf->Cell(44);
        $pdf->Cell(135,-2,utf8_decode('Departamento de Administración de Personal'),0,0,'R');
        $pdf->Ln(5);
        $pdf->SetFont('Arial','','8');
        $pdf->Cell(40);
        // $etiqueta=DB::selectOne('SELECT * FROM etiqueta WHERE id_etiqueta = 1');
        /// $pdf->Cell(100,5,utf8_decode($etiqueta->descripcion),0,0,'C');
        $pdf->Ln();
        //$pdf->SetFont('Arial','B','11');
        //$pdf->Cell(80);

        // $pdf->Ln(5);
        $pdf->SetFont('Arial','','7');
        $pdf->Cell(135);
        $pdf->Cell(44,4,utf8_decode('Valle de Bravo, México.'),0,0,'R');

        //fecha
        $fechas = date("d-m-Y");

        $num=date("j",strtotime($fechas));
        $ano=date("Y", strtotime($fechas));
        $mes= array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
        $mes=$mes[(date('m', strtotime($fechas))*1)-1];
        $fech= $num. ' de '.$mes.' del '.$ano;


        $fecha_req=$solicitud->fecha_req;

        $num1=date("j",strtotime($fecha_req));
        $ano1=date("Y", strtotime($fecha_req));
        $mes1= array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
        $mes1=$mes1[(date('m', strtotime($fecha_req))*1)-1];
        $fecha_reg="el dia ".$num1. ' de '.$mes1.' del '.$ano1;

        $pdf->Ln(4);
        $pdf->SetFont('Arial','','7');
        $pdf->Cell(135);
        $pdf->Cell(44,4,utf8_decode($fech),0,0,'R');
        $pdf->Ln();
        $pdf->SetFont('Arial','','7');
        $pdf->Cell(135);
        $numero=$id_solicitud;
        $pdf->Cell(44,4,utf8_decode('Oficio No. '.$nombre_jefe->clave.'/'.$nombre_jefe->id_solicitud.'/'.$ano),0,0,'R');
        $pdf->SetFont('Arial','B','10');


        $pdf->Ln(10);
        $pdf->Cell(180, 5, utf8_decode($jefe_personal->titulo.' '. $jefe_personal->nombre), 0, 1, '');
        $pdf->Cell(180, 5, utf8_decode($jefe_personal->jefe_descripcion), 0, 1, '');
        $pdf->SetFont('Arial','B','10');
        $pdf->Cell(80, 5, utf8_decode('PRESENTE'), 0, 0, '');

        $pdf->Ln(10);
        $pdf->SetFont('Arial','','11');
        $pdf->Cell(177,5,utf8_decode('Por medio del presente me permito enviarle un coordial saludo y al mismo tiempo solicitar a usted de'),0,'J',1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial','','11');
        $pdf->Cell(166,5,utf8_decode('la manera más atenta y amable, que con fundamento en el/la '.$solicitud->nombre_articulosolo.' estipulado en el Reglamento'),0,'J',1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', '11');
        $pdf->Cell(175, 5,utf8_decode('Interno del Trabajo del Tecnológico de Estudios Superiores de Valle de Bravo, que a la letra dice:'),0,'J',1);
        $pdf->Ln(8);
        $pdf->SetFont('Arial', 'I', '11');
        $pdf->MultiCell(177, 5,utf8_decode(' "'.$solicitud->descripcion_art.'"'),0,'J',0);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', '11');
        $pdf->MultiCell(177, 5,utf8_decode('Con lo anterior mencionado solicito el día '.$fecha_reg.' para cumplir con el siguiente motivo: '.$solicitud->motivo_oficio.''),0,'J',0);


        $pdf->Ln(6);
        $pdf->SetFont('Arial', '', '11');
        $pdf->Cell(90, 5,utf8_decode('Sin otro particular por el momento, quedó de usted.'),0,0,0);

        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', '7');
        $pdf->Cell(60, 10, utf8_decode('A T E N T A M E N T E'), 0, 0, 'L');
        $pdf->Cell(60, 10, utf8_decode('Vo. Bo.'), 0, 0, 'C');
        $pdf->Cell(60, 10, utf8_decode('Vo. Bo.'), 0, 1, 'C');
        $pdf->Ln(10);
        $y=$pdf->GetY();
        $pdf->SetFont('Arial', 'B', '6');
        $pdf->MultiCell(60, 5, utf8_decode($nombre_personal->titulo.' '. $nombre_personal->nombre), 0,'J');
        $pdf->MultiCell(60, 5, utf8_decode($nombre_personal->cargo), 0,'J');

        //dd($y);
        $pdf->SetXY(80,$y);
        $pdf->MultiCell(60, 5, utf8_decode($nombre_jefe->titulo.' '. $nombre_jefe->nombre),0, 'C');
        $pdf->SetX(80);
        $pdf->MultiCell(60, 5, utf8_decode($nombre_jefe->jefe_descripcion ),0, 'C');
        $pdf->SetXY(140,$y);
        $pdf->MultiCell(60, 5, utf8_decode($director->titulo.' '. $director->nombre),0, 'C');
        $pdf->SetX(140);
        $pdf->MultiCell(60, 5, utf8_decode($director->jefe_descripcion ),0, 'C');
        $pdf->Ln(20);
        $pdf->SetFont('Arial', '', '8');
        $pdf->Cell(10, 5, utf8_decode('Nombre, Fecha, Hora y Firma de autorización'), 0, 0, 'L');


    }
//////////////////////////////NO BORRAR//////////
    $pdf->Output();
    exit();

}
}
