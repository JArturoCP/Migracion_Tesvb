<?php

namespace App\Http\Controllers;
use App\Exports\Inc_reportequincenalExport;
use App\Exports\Ingles_voucher_val_export;
use App\Incidencias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Redirect;
use Session;
use App\Inc_solicitude;

class IncidenciasController extends Controller
{

    public function vista()
    {
        $articulos= DB::select('SELECT * from inc_articulos ORDER by nombre_articulo ASC');
       // dd($articulos);

       $id_usuario = Session::get('usuario_alumno');
       $id_personal = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario= ?', [$id_usuario]);
       $id_personal = $id_personal->id_personal;
        $id_periodo = Session::get('periodotrabaja');
        $estado_profesor = DB::SelectOne('SELECT COUNT(gnral_personales.id_personal) contar
        from gnral_personales, gnral_horarios, gnral_periodo_carreras WHERE
        gnral_horarios.id_personal = gnral_personales.id_personal AND
        gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera AND gnral_personales.id_personal = ?
        AND gnral_periodo_carreras.id_periodo = ?', [$id_personal, $id_periodo]);
        //dd($estado_profesor);
        if($estado_profesor->contar == 0){
            $estado_profesor=0;
            $array_carreras=0;
            $titulo=0;

        }else
        {
            $estado_profesor=1;
            $carreras = DB::Select('SELECT gnral_periodo_carreras.id_carrera
            from gnral_personales, gnral_horarios, gnral_periodo_carreras WHERE
            gnral_horarios.id_personal = gnral_personales.id_personal AND
            gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera AND gnral_personales.id_personal= ?
            AND gnral_periodo_carreras.id_periodo = ?', [$id_personal, $id_periodo]);
          ///  dd($carreras);
            $array_carreras=array();
            $titulo=DB::SelectOne('SELECT abreviaciones.titulo as titulo
                FROM abreviaciones_prof, abreviaciones
                where  abreviaciones_prof.id_abreviacion=abreviaciones.id_abreviacion
                and id_personal= ?', [$id_personal]);
            $titulo=$titulo->titulo;

            foreach($carreras as $carrera){
                //
                $nombre_jefe=DB::selectOne('SELECT gnral_personales.id_personal,gnral_personales.nombre,abreviaciones.titulo
                FROM gnral_personales, gnral_jefes_periodos,abreviaciones,abreviaciones_prof
                WHERE gnral_jefes_periodos.id_personal=gnral_personales.id_personal AND gnral_jefes_periodos.id_carrera= ?
                  and gnral_jefes_periodos.id_periodo= ? and abreviaciones_prof.id_personal=gnral_personales.id_personal
                  and abreviaciones_prof.id_abreviacion=abreviaciones.id_abreviacion', [$carrera->id_carrera, $id_periodo]);

                $dat['id_personal']=$nombre_jefe->id_personal;
                $dat['nombre']=$nombre_jefe->nombre;
                $dat['titulo']=$nombre_jefe->titulo;

            array_push($array_carreras, $dat);
            }

        }
       // dd($titulo);
    //return view('incidencias.agregar', compact('articulos', 'estado_profesor', 'array_carreras','titulo'));
        return view('incidencias.agregar', compact('articulos', 'estado_profesor', 'array_carreras','titulo'));
    }

    //////////////agregar evidencia
    public function vista2($id_evid)
    {

        $tipo_evidencia= DB::select('SELECT * from inc_tipo_evidencia ORDER by nombre_evidencia ASC');
        $evidencia = DB::selectOne('SELECT * FROM `inc_evidencias` WHERE id_evid= ?', [$id_evid]);
         return view('incidencias.cargar_evidencia', compact ('tipo_evidencia','evidencia'));

    }
    public function fecha_periodo_incidencia(){
        $tipo_evidencia= DB::select('SELECT * from inc_tipo_evidencia WHERE id_tipo_evid NOT IN (2) ORDER by nombre_evidencia ASC');


        return view('incidencias.agregar_perido_dia_inc', compact('tipo_evidencia'));
    }
    public function cargar_evidencia_tipo_fecha($id_tipo_evid,$tipo_fecha){
        if($tipo_fecha == 1)
        {
            $tipo_evidencia=DB::selectOne('SELECT * FROM `inc_tipo_evidencia` WHERE `id_tipo_evid` = ?', [$id_tipo_evid]);

            return view('incidencias.cargar_evidencia_otra', compact ('tipo_evidencia','tipo_fecha'));
        }else{
            $tipo_evidencia=DB::selectOne('SELECT * FROM `inc_tipo_evidencia` WHERE `id_tipo_evid` = ?', [$id_tipo_evid]);

            return view('incidencias.cargar_evidencia_otra2', compact ('tipo_evidencia','tipo_fecha'));
        }

    }
    public function guardar_evid_fecha_solicita2(Request $request,$id_tipo_evid,$tipo_fecha){
      //  dd($request);
        $maximo= DB::selectOne('select max(id_evid) maximo FROM inc_evidencias');

        if($maximo->maximo==null){
            $maximo=1;

        }else{
            $maximo= $maximo->maximo+1;
        }
        $file=$request->file('arch_evidencia');

        $name="evidencia_incidencia_".$maximo.".".$file->getClientOriginalExtension();
        $file->move(public_path().'/incidencias/', $name);
        $id_usuario = Session::get('usuario_alumno');
        $id_personal = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario= ?', [$id_usuario]);
        $id_personal = $id_personal->id_personal;

        $fecha_requerida1=$request->input('fecha_req1');
        $fecha_requerida2=$request->input('fecha_req2');

        if($id_tipo_evid == 1 || $id_tipo_evid == 3 || $id_tipo_evid == 5 || $id_tipo_evid == 6)
        {
            $no_folio=$request->input('no_folio');
        }else{
            $no_folio=0;

        }
        DB::table('inc_evidencias')->insert([
            'id_evid'=>$maximo,
            'id_personal'=>$id_personal,
            'id_tipo_evid' => $id_tipo_evid,
            'arch_evidencia' => $name,
            'fecha_solicita' => $fecha_requerida1,
            'fecha_solicita_2' => $fecha_requerida2,
            'no_folio'=>$no_folio,
            'no_fecha'=>$tipo_fecha,
            'id_autorizado'=>0,
        ]);

        return redirect('/incidencias/editar_evidencia2/'.$maximo);
    }
    public function guardar_evidencia_fecha_solicita(Request $request,$id_tipo_evid,$tipo_fecha){

        //  dd($request);
        $maximo= DB::selectOne('select max(id_evid) maximo FROM inc_evidencias');

        if($maximo->maximo==null){
            $maximo=1;

        }else{
            $maximo= $maximo->maximo+1;
        }
        $file=$request->file('arch_evidencia');

        $name="evidencia_incidencia_".$maximo.".".$file->getClientOriginalExtension();
        $file->move(public_path().'/incidencias/', $name);
        $id_usuario = Session::get('usuario_alumno');
        $id_personal = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario= ?', [$id_usuario]);
        $id_personal = $id_personal->id_personal;

      $fecha_requerida=$request->input('fecha_req1');

        if($id_tipo_evid == 1 || $id_tipo_evid == 3 || $id_tipo_evid == 5 || $id_tipo_evid == 6)
        {
            $no_folio=$request->input('no_folio');
        }else{
            $no_folio=0;

        }
        DB::table('inc_evidencias')->insert([
            'id_evid'=>$maximo,
            'id_personal'=>$id_personal,
            'id_tipo_evid' => $id_tipo_evid,
            'arch_evidencia' => $name,
            'fecha_solicita' => $fecha_requerida,
            'no_folio'=>$no_folio,
            'no_fecha'=>$tipo_fecha,
            'id_autorizado'=>0,
        ]);

        return redirect('/incidencias/editar_evidencia/'.$maximo);

    }
    public function vista2_1()
    {
        $tipo_evidencia= DB::select('SELECT * FROM `inc_tipo_evidencia` WHERE `id_tipo_evid` NOT IN (2, 9)
ORDER BY `nombre_evidencia` ASC');
      //  dd($tipo_evidencia);
       // $evidencia = DB::selectOne('SELECT * FROM `inc_evidencias`');
        return view('incidencias.cargar_evidencia_otra', compact ('tipo_evidencia','evidencia'));
    }


    public function vista3(){
        $solicitud = DB::select('SELECT inc_solicitudes.*,inc_articulos.nombre_articulo, gnral_personales.nombre, abreviaciones.titulo
         from inc_solicitudes,inc_articulos, gnral_personales, abreviaciones_prof,abreviaciones
         where inc_solicitudes.id_articulo=inc_articulos.id_articulo and inc_solicitudes.id_personal=gnral_personales.id_personal
        and abreviaciones_prof.id_personal = gnral_personales.id_personal and abreviaciones_prof.id_abreviacion=abreviaciones.id_abreviacion
        and inc_solicitudes.id_estado_solicitud=2 ORDER BY `inc_solicitudes`.`fecha_solicitud` DESC');

       // dd($solicitud);
        return view('incidencias.historial_oficio', compact('solicitud'));
        /*$usuario=DB:: table('user')*/
    }

    public function vistaevidencias(){

        $evidencias = DB:: table ('inc_evidencias')
            ->join ('inc_tipo_evidencia', 'inc_evidencias.id_tipo_evid','=','inc_tipo_evidencia.id_tipo_evid')
            ->join ('gnral_personales', 'gnral_personales.id_personal','=','inc_evidencias.id_personal')
            ->where('inc_evidencias.id_autorizado','=',2)
            ->select('inc_evidencias.*', 'inc_tipo_evidencia.*','gnral_personales.nombre')
            ->orderBy('inc_evidencias.fecha_envio','DESC')
            ->get();


        return view('incidencias.historial_evidencias', compact('evidencias'));
        /*$usuario=DB:: table('user')*/
    }
    ///////VISTA REPORTES INCIDENCIAS//////
    public function vista4(){

        $articulos= DB::select('SELECT * from inc_articulos ORDER by nombre_articulo ASC');

        $art= array();
        foreach ($articulos as $articulo){
            $dat['id'] = $articulo->id_articulo;
            $dat['nombre'] = $articulo->nombre_articulo ;
            $dat['estado'] = 1;
            array_push($art,$dat);
        }
       $evidencias=DB::select('SELECT * FROM `inc_tipo_evidencia` WHERE `id_tipo_evid` != 2  ORDER BY inc_tipo_evidencia.nombre_evidencia ASC');
        foreach ($evidencias as $evidencia){
            $dat['id']=$evidencia->id_tipo_evid;
            $dat['nombre'] = $evidencia->nombre_evidencia ;
            $dat['estado'] = 2;
            array_push($art,$dat);
        }
       // dd($art);


        $estados=0;

        return view('incidencias.reportes_quincenales', compact('art','estados'));

    }
 public function vista5(){
        $id_usuario = Session::get('usuario_alumno');
        $id_personal = DB::SelectOne('SELECT * FROM gnral_personales WHERE tipo_usuario= ?', [$id_usuario]);
        $id_personal = $id_personal->id_personal;
//dd($id_personal);


        $solicitudes = DB:: table ('inc_solicitudes')
->join('inc_articulos','inc_solicitudes.id_articulo','=','inc_articulos.id_articulo')
->join('gnral_personales','inc_solicitudes.id_personal','=','gnral_personales.id_personal')
->where('inc_solicitudes.id_estado_solicitud','=',1)
->where('inc_solicitudes.direc_finanzas','=',0)
->where('inc_solicitudes.id_jefe','=',$id_personal)
->select('inc_solicitudes.*', 'inc_articulos.*', 'gnral_personales.nombre')
->orderBy('inc_solicitudes.fecha_solicitud','ASC')
->get();


// dd($solicitudes);



return view('incidencias.validar_oficios', compact('solicitudes','id_personal'));
}
    public function vista6(){
        $id_usuario = Session::get('usuario_alumno');
        $id_personal = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario= ?', [$id_usuario]);
        $id_personal = $id_personal->id_personal;

        /*
        $histSol=DB::select('SELECT inc_solicitudes.*,inc_articulos.nombre_articulo, gnral_personales.nombre, abreviaciones.titulo,inc_evidencias.id_evid,
        inc_evidencias.id_tipo_evid, inc_evidencias.arch_evidencia from inc_solicitudes,inc_articulos, gnral_personales,abreviaciones_prof,abreviaciones, inc_evidencias
        where inc_solicitudes.id_articulo=inc_articulos.id_articulo and inc_solicitudes.id_personal='.$id_personal.' and inc_solicitudes.id_jefe=gnral_personales.id_personal
          and abreviaciones_prof.id_personal = gnral_personales.id_personal and abreviaciones_prof.id_abreviacion=abreviaciones.id_abreviacion
           and inc_evidencias.id_solicitud = inc_solicitudes.id_solicitud ORDER BY `inc_solicitudes`.`fecha_req` DESC');
*/

        $histSol=DB::select('SELECT inc_solicitudes.*,inc_articulos.nombre_articulo, gnral_personales.nombre, abreviaciones.titulo
        from inc_solicitudes,inc_articulos, gnral_personales,abreviaciones_prof,abreviaciones
        where inc_solicitudes.id_articulo=inc_articulos.id_articulo and inc_solicitudes.id_personal= ?
        and inc_solicitudes.id_jefe=gnral_personales.id_personal and abreviaciones_prof.id_personal = gnral_personales.id_personal
        and abreviaciones_prof.id_abreviacion=abreviaciones.id_abreviacion ORDER BY `inc_solicitudes`.`fecha_solicitud` DESC', [$id_personal]);
        //dd($histSol);

        $id_periodo = Session::get('periodotrabaja');
        $estado_profesor = DB::SelectOne('SELECT COUNT(gnral_personales.id_personal) contar
        from gnral_personales, gnral_horarios, gnral_periodo_carreras WHERE
        gnral_horarios.id_personal = gnral_personales.id_personal AND
        gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera AND gnral_personales.id_personal = ?
        AND gnral_periodo_carreras.id_periodo = ?', [$id_personal, $id_periodo]);

        if($estado_profesor->contar == 0){
            $jefe_a_d=DB::selectOne('SELECT abreviaciones.titulo, gnral_personales.nombre, gnral_unidad_administrativa.jefe_descripcion
        from abreviaciones, abreviaciones_prof, gnral_personales, gnral_unidad_personal, gnral_unidad_administrativa
       where abreviaciones.id_abreviacion = abreviaciones_prof.id_abreviacion and abreviaciones_prof.id_personal=gnral_personales.id_personal
        and gnral_personales.id_personal = gnral_unidad_personal.id_personal
        and gnral_unidad_personal.id_unidad_admin = gnral_unidad_administrativa.id_unidad_admin and gnral_unidad_administrativa.id_unidad_admin=22');
        }else{
            $jefe_a_d=DB::selectOne('SELECT abreviaciones.titulo, gnral_personales.nombre, gnral_unidad_administrativa.jefe_descripcion
        from abreviaciones, abreviaciones_prof, gnral_personales, gnral_unidad_personal, gnral_unidad_administrativa
       where abreviaciones.id_abreviacion = abreviaciones_prof.id_abreviacion and abreviaciones_prof.id_personal=gnral_personales.id_personal
        and gnral_personales.id_personal = gnral_unidad_personal.id_personal
        and gnral_unidad_personal.id_unidad_admin = gnral_unidad_administrativa.id_unidad_admin and gnral_unidad_administrativa.id_unidad_admin=5');
        }

        $director=DB::selectOne('SELECT abreviaciones.titulo, gnral_personales.nombre, gnral_unidad_administrativa.jefe_descripcion
        from abreviaciones, abreviaciones_prof, gnral_personales, gnral_unidad_personal, gnral_unidad_administrativa
       where abreviaciones.id_abreviacion = abreviaciones_prof.id_abreviacion and abreviaciones_prof.id_personal=gnral_personales.id_personal
        and gnral_personales.id_personal = gnral_unidad_personal.id_personal
        and gnral_unidad_personal.id_unidad_admin = gnral_unidad_administrativa.id_unidad_admin and gnral_unidad_administrativa.id_unidad_admin=3');



      //  dd($histSol);

/*
        $histSol=DB::select('SELECT inc_solicitudes.*,inc_articulos.nombre_articulo, gnral_personales.nombre, abreviaciones.titulo
        from inc_solicitudes,inc_articulos, gnral_personales,abreviaciones_prof,abreviaciones where inc_solicitudes.id_articulo=inc_articulos.id_articulo
        and inc_solicitudes.id_personal='.$id_personal.' and inc_solicitudes.id_jefe=gnral_personales.id_personal
        and abreviaciones_prof.id_personal = gnral_personales.id_personal and abreviaciones_prof.id_abreviacion=abreviaciones.id_abreviacion');
*/
       // dd($histSol);

       // dd($histSol);
       /*
        $histSol = DB:: table ('inc_solicitudes')
        ->join ('inc_articulos', 'inc_solicitudes.id_articulo','=','inc_articulos.id_articulo')
        ->select('inc_solicitudes.*', 'inc_articulos.*')
        ->get();
       */

        return view('incidencias.historial_docentesSo', compact ('histSol','id_personal','jefe_a_d','director'));
    }
    public function vista7(){
        $id_usuario = Session::get('usuario_alumno');
        $id_personal = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario= ?', [$id_usuario]);
        $id_personal = $id_personal->id_personal;

        $histEvi = DB:: table ('inc_evidencias')
        ->join ('inc_tipo_evidencia', 'inc_evidencias.id_tipo_evid','=','inc_tipo_evidencia.id_tipo_evid')
            ->where('inc_evidencias.id_personal','=',$id_personal)
            ->whereIn('inc_evidencias.id_autorizado',[1,2,3])
        ->select('inc_evidencias.*', 'inc_tipo_evidencia.*')
            ->orderBy('inc_evidencias.fecha_solicita','DESC')
        ->get();

       // dd($histEvi);

        return view('incidencias.historial_docentesEv', compact ('histEvi','id_personal'));
    }
    public function validar_evidencia_departamentos()
    {
        $histEvi = DB::select('SELECT gnral_personales.nombre, inc_tipo_evidencia.nombre_evidencia,
        inc_evidencias.* from inc_evidencias,gnral_personales,inc_tipo_evidencia
      where inc_evidencias.id_personal = gnral_personales.id_personal
        and inc_evidencias.id_tipo_evid =inc_tipo_evidencia.id_tipo_evid and inc_evidencias.id_autorizado=1 ORDER BY `inc_evidencias`.`fecha_envio` ASC');
       // dd($histEvi);

        return view('incidencias.validar_evidencia_departamentos', compact ('histEvi'));
    }
    public function vista8(){
        $id_usuario = Session::get('usuario_alumno');
        $id_personal=DB::selectOne('SELECT * FROM `gnral_personales` WHERE `tipo_usuario` = ?', [$id_usuario]);
        $id_personal=$id_personal->id_personal;

        $eviden= DB::table('inc_evidencias')
        ->join('inc_solicitudes', 'inc_solicitudes.id_solicitud','=','inc_evidencias.id_solicitud')
        ->join('inc_articulos', 'inc_articulos.id_articulo','=','inc_solicitudes.id_articulo')
            ->where('inc_evidencias.id_personal','=',$id_personal)
        ->select( 'inc_evidencias.*','inc_solicitudes.*', 'inc_articulos.*')
        ->orderBy('inc_evidencias.id_evid','DESC')
        ->get();

       // dd($eviden);

        $fechaact = date('Y-m-d');

        return view('incidencias.articulos_evidencia',compact('eviden','fechaact'));
    }
    public function ver_datos_oficio_evidencia($id_evid){

         $evid=DB::selectOne('SELECT inc_articulos.nombre_articulo,inc_solicitudes.*, inc_evidencias.id_evid
         from inc_articulos, inc_solicitudes, inc_evidencias where inc_articulos.id_articulo = inc_solicitudes.id_articulo
          and inc_solicitudes.id_solicitud=inc_evidencias.id_solicitud and inc_evidencias.id_evid= ?', [$id_evid]);
//dd($evid);
        return view('incidencias.datos_oficio_evidencia',compact('evid'));
    }
    public function cargando_evidencia_oficio(Request $request){
       // dd($request);
        $file=$request->file('arch_evidencia');
        $id_evid=$request->input('id_evid');
        $name="evidencia_incidencia_".$id_evid.".".$file->getClientOriginalExtension();
        $file->move(public_path().'/incidencias/', $name);

        DB::table('inc_evidencias')->where('id_evid', $id_evid)
            ->update([
                'id_tipo_evid' =>9,
                'arch_evidencia' => $name,
            ]);

       return redirect("/incidencias/editar_evidencia_oficio/".$id_evid);

    }
    public function editar_evidencia_oficio($id_evid){
        $evid=DB::selectOne('SELECT inc_articulos.nombre_articulo,inc_solicitudes.*, inc_evidencias.id_evid,inc_evidencias.arch_evidencia
         from inc_articulos, inc_solicitudes, inc_evidencias where inc_articulos.id_articulo = inc_solicitudes.id_articulo
          and inc_solicitudes.id_solicitud=inc_evidencias.id_solicitud and inc_evidencias.id_evid= ?', [$id_evid]);

//dd($evid);

       return view('incidencias.editar_evidencia_oficio',compact('evid'));
    }
    /*public function articulos_evidencia(Request $request){

        return view('incidencias.articulos_evidencia', compact('eviden'));


    }*/

    public function guardar_evidencia(Request $request, $id_evid)
{
    $file=$request->file('arch_evidencia');
    $id_tipo_evid=$request->input('id_tipo_evid');
    $name="evidencia_incidencia_".$id_evid.".".$file->getClientOriginalExtension();
    $file->move(public_path().'/incidencias/', $name);

        DB::table('inc_evidencias')->where('id_evid', $id_evid)
        ->update([
            'id_tipo_evid' => $id_tipo_evid,
            'arch_evidencia' => $name,
        ]);
    //dd($id_evid, $name, $id_tipo_evid);
    return redirect('/incidencias/editar_evidencia/'.$id_evid);
}
    public function reportes_incidencias_ver($id_articulo,$fecha_inicial,$fecha_final,$estado){

       // dd($id_articulo,$fecha_inicial,$fecha_final);

        $id_usuario = Session::get('usuario_alumno');
        $id_personal = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario= ?', [$id_usuario]);
        $id_personal = $id_personal->id_personal;
       // $arti=$request->input ('id_articulo');
       // $desd_fecha=$request->input('id_desd_fech');
       // $hast_fecha=$request->input('id_hast_fech');
        $estados=1;

        //dd($arti);
        ///////variables de sesión////////
      ///  Session::put('id_articulo_solicitud',$arti);
       // Session::put('id_desd_fech_solicitud',$desd_fecha);
       // Session::put('id_hast_fech_solicitud',$hast_fecha);


      //  $articulos= DB::select('SELECT * from inc_articulos ORDER by nombre_articulo ASC');
       // dd($id_articulo);
        if($id_articulo == 200){
            $articulos=DB::select('SELECT inc_articulos.id_articulo id,
       inc_articulos.nombre_articulo documento,
       gnral_personales.nombre servidor,
       inc_solicitudes.fecha_req fecha_i,
       \'\' fecha_f, inc_solicitudes.id_solicitud,
       gnral_personales.numero_empleado,
       1 estado,
       0 no_folio,
       0 no_fecha
       from
        inc_solicitudes,inc_articulos, gnral_personales
        where inc_solicitudes.id_articulo=inc_articulos.id_articulo
        and inc_solicitudes.id_estado_solicitud=2
        and inc_solicitudes.id_personal=gnral_personales.id_personal
        and  inc_solicitudes.fecha_req >=? and  inc_solicitudes.fecha_req <=? and
        inc_articulos.id_articulo
        not in(2,8,11)
        union
      SELECT
    inc_articulos.id_articulo id,
    inc_articulos.nombre_articulo documento ,
    gnral_personales.nombre servidor,
    inc_solicitudes.fecha_invac fecha_i,
    inc_solicitudes.fecha_tervac fecha_f,
    inc_solicitudes.id_solicitud ,
    gnral_personales.numero_empleado,
    1 estado,
    0 no_folio,
    0 no_fecha
FROM
    inc_solicitudes
JOIN
    inc_articulos ON inc_solicitudes.id_articulo = inc_articulos.id_articulo
JOIN
    gnral_personales ON inc_solicitudes.id_personal = gnral_personales.id_personal
WHERE
    inc_solicitudes.id_estado_solicitud = 2
    AND inc_articulos.id_articulo IN (2, 8, 11)
    AND (
        inc_solicitudes.fecha_invac BETWEEN ? AND ?
        OR inc_solicitudes.fecha_tervac BETWEEN ? AND ?
    )
        UNION
        SELECT inc_tipo_evidencia.id_tipo_evid id,
       inc_tipo_evidencia.nombre_evidencia documento,
       gnral_personales.nombre servidor,
       inc_evidencias.fecha_solicita fecha_i,
       \'\' fecha_f,
       inc_evidencias.id_evid,
       gnral_personales.numero_empleado,
       2 estado,
       inc_evidencias.no_folio,
       inc_evidencias.no_fecha
       from
        inc_evidencias,inc_tipo_evidencia, gnral_personales
        where inc_evidencias.id_tipo_evid=inc_tipo_evidencia.id_tipo_evid
        and inc_evidencias.no_fecha =1
           and inc_evidencias.id_autorizado =2
        and inc_evidencias.id_personal=gnral_personales.id_personal
        and  inc_evidencias.fecha_solicita >=? and  inc_evidencias.fecha_solicita <=?
        UNION
        SELECT inc_tipo_evidencia.id_tipo_evid id,
       inc_tipo_evidencia.nombre_evidencia documento,
       gnral_personales.nombre servidor,
       inc_evidencias.fecha_solicita fecha_i,
       inc_evidencias.fecha_solicita_2 fecha_f,
       inc_evidencias.id_evid,
       gnral_personales.numero_empleado,
       2 estado,
       inc_evidencias.no_folio,
       inc_evidencias.no_fecha
       from
        inc_evidencias,inc_tipo_evidencia, gnral_personales
        where inc_evidencias.id_tipo_evid=inc_tipo_evidencia.id_tipo_evid
        and inc_evidencias.no_fecha =2
           and inc_evidencias.id_autorizado =2
        and inc_evidencias.id_personal=gnral_personales.id_personal
        and    ((inc_evidencias.fecha_solicita >=? and  inc_evidencias.fecha_solicita_2 <=?) OR
        (
        inc_evidencias.fecha_solicita BETWEEN ? AND ?
        OR inc_evidencias.fecha_solicita_2 BETWEEN ? AND ?
    ))
ORDER BY `fecha_i` DESC', [(string) ($fecha_inicial), (string) ($fecha_final), (string) ($fecha_inicial), (string) ($fecha_final), (string) ($fecha_inicial), (string) ($fecha_final), (string) ($fecha_inicial), (string) ($fecha_final), (string) ($fecha_inicial), (string) ($fecha_final), (string) ($fecha_inicial), (string) ($fecha_final), (string) ($fecha_inicial), (string) ($fecha_final)]);
//dd($articulos);

        }
        else{
            if($estado == 1) {

                if ($id_articulo == 2 || $id_articulo == 8 || $id_articulo == 11) {
                    //dd($articulos);
                    $articulos = DB::select('SELECT
    inc_articulos.id_articulo id,
    inc_articulos.nombre_articulo documento ,
    gnral_personales.nombre servidor,
    inc_solicitudes.fecha_invac fecha_i,inc_solicitudes.fecha_tervac fecha_f,
    inc_solicitudes.id_solicitud ,gnral_personales.numero_empleado,1 estado,0 no_folio,0 no_fecha
FROM
    inc_solicitudes
JOIN
    inc_articulos ON inc_solicitudes.id_articulo = inc_articulos.id_articulo
JOIN
    gnral_personales ON inc_solicitudes.id_personal = gnral_personales.id_personal
WHERE
    inc_solicitudes.id_estado_solicitud = 2
    AND inc_articulos.id_articulo= ?
    AND (
        inc_solicitudes.fecha_invac BETWEEN ? AND ?
        OR inc_solicitudes.fecha_tervac BETWEEN ? AND ?
    ) ORDER BY inc_solicitudes.fecha_invac DESC
', [$id_articulo, (string) ($fecha_inicial), (string) ($fecha_final), (string) ($fecha_inicial), (string) ($fecha_final)]);


                } else {

                    $articulos = DB::select('SELECT inc_articulos.id_articulo id,
       inc_articulos.nombre_articulo documento,
       gnral_personales.nombre servidor,
       inc_solicitudes.fecha_req fecha_i,
       \'\' fecha_f, inc_solicitudes.id_solicitud,gnral_personales.numero_empleado,1 estado,0 no_folio,0 no_fecha from
        inc_solicitudes,inc_articulos, gnral_personales
        where inc_solicitudes.id_articulo=inc_articulos.id_articulo
        and inc_solicitudes.id_estado_solicitud=2
        and inc_solicitudes.id_personal=gnral_personales.id_personal and
          inc_solicitudes.id_articulo= ?
        and  inc_solicitudes.fecha_req >=? and  inc_solicitudes.fecha_req <=? ORDER BY  inc_solicitudes.fecha_req DESC', [$id_articulo, (string) ($fecha_inicial), (string) ($fecha_final)]);

                }
            }else{

                $articulos=DB::select('SELECT inc_tipo_evidencia.id_tipo_evid id,
       inc_tipo_evidencia.nombre_evidencia documento,
       gnral_personales.nombre servidor,
       inc_evidencias.fecha_solicita fecha_i,
       \'\' fecha_f, inc_evidencias.id_evid,gnral_personales.numero_empleado,2 estado,inc_evidencias.no_folio,inc_evidencias.no_fecha from
        inc_evidencias,inc_tipo_evidencia, gnral_personales
        where inc_evidencias.id_tipo_evid=inc_tipo_evidencia.id_tipo_evid
        and inc_evidencias.no_fecha =1
           and inc_evidencias.id_autorizado =2
        and inc_evidencias.id_tipo_evid = ?
        and inc_evidencias.id_personal=gnral_personales.id_personal
        and  inc_evidencias.fecha_solicita >=? and  inc_evidencias.fecha_solicita <=?
        UNION
        SELECT inc_tipo_evidencia.id_tipo_evid id,
       inc_tipo_evidencia.nombre_evidencia documento,
       gnral_personales.nombre servidor,
       inc_evidencias.fecha_solicita fecha_i,
       inc_evidencias.fecha_solicita_2 fecha_f, inc_evidencias.id_evid,gnral_personales.numero_empleado,2 estado,inc_evidencias.no_folio,inc_evidencias.no_fecha from
        inc_evidencias,inc_tipo_evidencia, gnral_personales
        where inc_evidencias.id_tipo_evid=inc_tipo_evidencia.id_tipo_evid
        and inc_evidencias.no_fecha =2
           and inc_evidencias.id_autorizado =2
        and inc_evidencias.id_tipo_evid = ?
        and inc_evidencias.id_personal=gnral_personales.id_personal
        and    ((inc_evidencias.fecha_solicita >=? and  inc_evidencias.fecha_solicita_2 <=?) OR
        (
        inc_evidencias.fecha_solicita BETWEEN ? AND ?
        OR inc_evidencias.fecha_solicita_2 BETWEEN ? AND ?
    ))
ORDER BY `fecha_i` DESC', [$id_articulo, (string) ($fecha_inicial), (string) ($fecha_final), $id_articulo, (string) ($fecha_inicial), (string) ($fecha_final), (string) ($fecha_inicial), (string) ($fecha_final), (string) ($fecha_inicial), (string) ($fecha_final)]);

            }

        }
        //dd($articulos);
        //dd($fecha);

        $arti= DB::select('SELECT * from inc_articulos ORDER by nombre_articulo ASC');

        $art= array();
        foreach ($arti as $articulo){
            $dat['id'] = $articulo->id_articulo;
            $dat['nombre'] = $articulo->nombre_articulo ;
            $dat['estado'] = 1;
            array_push($art,$dat);
        }
        $evidencias=DB::select('SELECT * FROM inc_tipo_evidencia  ORDER BY inc_tipo_evidencia.nombre_evidencia ASC');
        foreach ($evidencias as $evidencia){
            $dat['id']=$evidencia->id_tipo_evid;
            $dat['nombre'] = $evidencia->nombre_evidencia ;
            $dat['estado'] = 2;
            array_push($art,$dat);
        }
        $dat['id']=200;
        $dat['nombre'] = "TODOS";
        $dat['estado'] = 3;
        array_push($art,$dat);

        return view('incidencias.reportes_quincenales', compact('articulos','estados','art', 'fecha_inicial','fecha_final','id_articulo','estado'));


    }
    public function index(){
        $historial = DB::table('inc_solicitudes')->paginate(10);
        return view ('inc_solicitudes.index',['historial'=> $historial]);
    }
    public function guardar_mod_evidencia(Request $request, $id_evid){
        $tipo_evidencia=DB::selectOne('SELECT * FROM `inc_evidencias` WHERE `id_evid` = ?', [$id_evid]);
        $tipo_evidencia=$tipo_evidencia->id_tipo_evid;

        $documento=$request->file('arch_evidencia');
        //$id_tipo_evid=$request->input('id_tipo_evid');
        $name="evidencia_incidencia_".$id_evid.".".$documento->getClientOriginalExtension();
        $documento->move(public_path().'/incidencias/', $name);

        $id_usuario = Session::get('usuario_alumno');
        $id_personal = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario= ?', [$id_usuario]);
        $id_personal = $id_personal->id_personal;
        $fecha_mod_requerida=$request->input('fecha_mod_requerida');

        if($tipo_evidencia== 1 || $tipo_evidencia == 3 ||  $tipo_evidencia == 5  ||  $tipo_evidencia == 6)
        {
            $no_folio=$request->input('no_folio');
            DB::table('inc_evidencias')->where('id_evid', $id_evid)
                ->update([
                    'no_folio' => $no_folio,
                    'arch_evidencia' => $name,
                    'id_personal' =>$id_personal,
                    'fecha_solicita' =>$fecha_mod_requerida,
                ]);
        }else{
            DB::table('inc_evidencias')->where('id_evid', $id_evid)
                ->update([
                    // 'id_tipo_evid' => $id_tipo_evid,
                    'arch_evidencia' => $name,
                    'id_personal' =>$id_personal,
                    'fecha_solicita' =>$fecha_mod_requerida,
                ]);
        }

         return redirect('/incidencias/editar_evidencia/'.$id_evid);
    }
    public function guardar_mod_evidencia2(Request $request, $id_evid,$id_tipo_evid){
//dd($request);
        $documento=$request->file('arch_evidencia');
        //$id_tipo_evid=$request->input('id_tipo_evid');
        $name="evidencia_incidencia_".$id_evid.".".$documento->getClientOriginalExtension();
        $documento->move(public_path().'/incidencias/', $name);
        $mod_fecha_req1=$request->input('mod_fecha_req1');
        $mod_fecha_req2=$request->input('mod_fecha_req2');
        $id_usuario = Session::get('usuario_alumno');
        $id_personal = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario= ?', [$id_usuario]);
        $id_personal = $id_personal->id_personal;

        if($id_tipo_evid == 1 || $id_tipo_evid == 3 ||  $id_tipo_evid == 5  ||  $id_tipo_evid == 6)
        {
            $no_folio=$request->input('no_folio');
            DB::table('inc_evidencias')->where('id_evid', $id_evid)
                ->update([
                     'no_folio' => $no_folio,
                    'arch_evidencia' => $name,
                    'id_personal' =>$id_personal,
                    'fecha_solicita'=>$mod_fecha_req1,
                    'fecha_solicita_2'=>$mod_fecha_req2,
                ]);
        }else{
            DB::table('inc_evidencias')->where('id_evid', $id_evid)
                ->update([
                    // 'id_tipo_evid' => $id_tipo_evid,
                    'arch_evidencia' => $name,
                    'id_personal' =>$id_personal,
                    'fecha_solicita'=>$mod_fecha_req1,
                    'fecha_solicita_2'=>$mod_fecha_req2,
                ]);
        }

        return redirect('/incidencias/editar_evidencia2/'.$id_evid);
    }
    public function enviar_evidencia_fecha($id_evid){
        DB::table('inc_evidencias')->where('id_evid', $id_evid)
            ->update([
                'id_autorizado' =>1,
            ]);

        return Redirect::to('/incidencias/historial_docentesEv');



    }
    public function guardar_incidencia_solicitada(Request $request){
       // dd($request);
        $id_usuario = Session::get('usuario_alumno');
        $id_personal = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario= ?', [$id_usuario]);
        $id_personal = $id_personal->id_personal;
        $id_estado_solicitud="1";
        $today = date("Y-m-d H:i:s");

        //dd($estado_profesor);
       $id_articulo = $request->input('id_articulo');

       $estado_profesor = $request->input('estado_profesor');
       if($estado_profesor==0){
        $id_pers = DB::SelectOne('SELECT *FROM `adscripcion_personal` WHERE id_personal= ?', [$id_personal]);
        ///dd($id_pers);
        $id_jefe= DB::SelectOne('SELECT * FROM `gnral_unidad_personal` WHERE `id_unidad_persona` = ?', [$id_pers->id_unidad_persona]) ;
        //dd($id_unidad_persona);
        $id_jefe_finan = DB::SelectOne('SELECT * FROM `gnral_unidad_personal` WHERE `id_unidad_admin` = 22 ');
        $id_jefe_a=$id_jefe_finan->id_personal;
        $id_jefe=$id_jefe->id_personal;
       }
       else{
        $id_jefe_academ = DB::SelectOne('SELECT * FROM `gnral_unidad_personal` WHERE `id_unidad_admin` = 5 ');
        $id_jefe_a=$id_jefe_academ->id_personal;
        $id_jefe = $request->input('id_jefe');

       }
       //////////articulo 56///////////////
        if($id_articulo ==2){
            $fecha_invac3=$request->input('fecha_invac3');
            $fecha_tervac3=$request->input('fecha_tervac3');
            $hoy = date("Y-m-d");
            $fecha_req =$hoy;
        $motivo_oficio = $request->input('motivo_oficio');

        //$usuario = DB::select("Consulta de usuario logeado");
        $id_solicitud=Inc_solicitude::create([
            'id_articulo' => $id_articulo,
            'fecha_solicitud' => $today,
            'fecha_req' => $fecha_req,
            'motivo_oficio' => $motivo_oficio,
            'id_personal' =>$id_personal,
            'id_jefe' =>$id_jefe,
            'fecha_invac'=>$fecha_invac3,
            'fecha_tervac'=>$fecha_tervac3,
            'id_estado_solicitud'=>$id_estado_solicitud,
        ]);
/*
        $id_solicitud=$id_solicitud->id;
        DB::table('inc_evidencias')->insert([
            'id_solicitud' => $id_solicitud,
            'id_personal' =>$id_personal,
            'id_jefe' =>$id_jefe,
        ]);
*/
        }
        //////articulo 61///////////////
        if($id_articulo ==4){
            $fecha_req = $request->input('fecha_req2');
            $motivo_oficio = $request->input('motivo_oficio');


            $id_solicitud=Inc_solicitude::create([
                'id_articulo' => $id_articulo,
                'fecha_solicitud' => $today,
                'fecha_req' => $fecha_req,
                'motivo_oficio' => $motivo_oficio,
                'id_personal' =>$id_personal,
                'id_estado_solicitud'=>$id_estado_solicitud,
                'id_jefe' =>$id_jefe,
            ]);
            /*
            $id_solicitud=$id_solicitud->id;
            DB::table('inc_evidencias')->insert([
                'id_solicitud' => $id_solicitud,
                'id_personal' =>$id_personal,
                'id_jefe' =>$id_jefe,
            ]);
            */
        }
        ////////////////articulo 64/////////////
        if($id_articulo ==5){
            $fecha_req=$request->input('fecha_req1');
            $motivo_oficio = $request->input('motivo_oficio');
            $hora_e=$request->input('hora_e');
            $hora_st=$request->input('hora_st');

            $id_solicitud=Inc_solicitude::create([
                'id_articulo'=>$id_articulo,
                'fecha_solicitud' => $today,
                'fecha_req'=>$fecha_req,
                'motivo_oficio' => $motivo_oficio,
                'hora_e'=>$hora_e,
                'hora_st'=>$hora_st,
                'id_personal' =>$id_personal,
                'id_jefe' =>$id_jefe,
                'id_estado_solicitud'=>$id_estado_solicitud,
            ]);
            /*
            $id_solicitud=$id_solicitud->id;
            DB::table('inc_evidencias')->insert([
                'id_solicitud' => $id_solicitud,
                'id_personal' =>$id_personal,
                'id_jefe' =>$id_jefe,
            ]);
            */
        }
        //////art68diaeconomico/////
        if($id_articulo ==6){
            $fecha_req=$request->input('fecha_req2');
            $motivo_oficio = $request->input('motivo_oficio');

            $id_solicitud=Inc_solicitude::create([
                'id_articulo'=>$id_articulo,
                'fecha_solicitud' => $today,
                'fecha_req'=>$fecha_req,
                'motivo_oficio' => $motivo_oficio,
                'id_personal' =>$id_personal,
                'id_jefe' =>$id_jefe,
                'id_estado_solicitud'=>$id_estado_solicitud,
            ]);
            /*
            $id_solicitud=$id_solicitud->id;
            DB::table('inc_evidencias')->insert([
                'id_solicitud' => $id_solicitud,
                'id_personal' =>$id_personal,
                'id_jefe' =>$id_jefe,
            ]);
            */
        }
        /////////art 68 mediass jornadas//////////////
        if($id_articulo ==10){
            $fecha_req=$request->input('fecha_req2');
            $motivo_oficio = $request->input('motivo_oficio');
            $hora_e1=$request->input('hora_e1');
            $hora_s1=$request->input('hora_s1');

            $id_solicitud=Inc_solicitude::create([
                'id_articulo'=>$id_articulo,
                'fecha_solicitud' => $today,
                'fecha_req'=>$fecha_req,
                'motivo_oficio' => $motivo_oficio,
                'hora_e1'=>$hora_e1,
                'hora_s1'=>$hora_s1,
                'id_personal' =>$id_personal,
                'id_jefe' =>$id_jefe,
                'id_estado_solicitud'=>$id_estado_solicitud,

            ]);
            /*
            $id_solicitud=$id_solicitud->id;
            DB::table('inc_evidencias')->insert([
                'id_solicitud' => $id_solicitud,
                'id_personal' =>$id_personal,
                'id_jefe' =>$id_jefe,
            ]);
            */
        }
         /////////art 68 dia economico//////////////
         if($id_articulo ==7){
             //dd($id_jefe);
            $fecha_req=$request->input('fecha_req1');
            $motivo_oficio = $request->input('motivo_oficio');

            $id_solicitud=Inc_solicitude::create([
                'id_articulo'=>$id_articulo,
                'fecha_solicitud' => $today,
                'fecha_req'=>$fecha_req,
                'motivo_oficio' => $motivo_oficio,
                'id_personal' =>$id_personal,
                'id_jefe' =>$id_jefe,
                'direc_finanzas' =>$id_jefe_a,
                'id_estado_solicitud'=>$id_estado_solicitud,
            ]);
            /*
            $id_solicitud=$id_solicitud->id;
            DB::table('inc_evidencias')->insert([
                'id_solicitud' => $id_solicitud,
                'id_personal' =>$id_personal,
                'id_jefe' =>$id_jefe_a,
            ]);
            */
        }
        ///////////////art 73//////////
        if($id_articulo ==8 ){
            $hoy = date("Y-m-d");
            $fecha_req= $hoy;
            $fecha_invac=$request->input('fecha_invac');
            $fecha_tervac=$request->input('fecha_tervac');
            $motivo_oficio = $request->input('motivo_oficio');

            $id_solicitud=Inc_solicitude::create([
                'id_articulo'=>$id_articulo,
                'fecha_solicitud' => $today,
                'fecha_req'=>$fecha_req,
                'motivo_oficio' => $motivo_oficio,
                'fecha_invac'=>$fecha_invac,
                'fecha_tervac'=>$fecha_tervac,
                'id_personal' =>$id_personal,
                'id_estado_solicitud'=>$id_estado_solicitud,
                'id_jefe' =>$id_jefe,
            ]);
            /*
            $id_solicitud=$id_solicitud->id;
            DB::table('inc_evidencias')->insert([
                'id_solicitud' => $id_solicitud,
                'id_personal' =>$id_personal,
                'id_jefe' =>$id_jefe,
            ]);
            */
        }
        ///////////////art 75//////////
        if($id_articulo ==11 ){
          // dd($id_personal);
            $hoy = date("Y-m-d");
            $fecha_req= $hoy;
            $fecha_invac=$request->input('fecha_invac2');
            $fecha_tervac=$request->input('fecha_tervac2');
            $motivo_oficio = $request->input('motivo_oficio');

            $id_solicitud=Inc_solicitude::create([
                'id_articulo'=>$id_articulo,
                'fecha_solicitud' => $today,
                'fecha_req'=>$fecha_req,
                'motivo_oficio' => $motivo_oficio,
                'fecha_invac'=>$fecha_invac,
                'fecha_tervac'=>$fecha_tervac,
                'id_personal' =>$id_personal,
                'id_estado_solicitud'=>$id_estado_solicitud,
                'id_jefe' =>$id_jefe,
            ]);
            /*
            $id_solicitud=$id_solicitud->id;
            DB::table('inc_evidencias')->insert([
                'id_solicitud' => $id_solicitud,
                'id_personal' =>$id_personal,
                'id_jefe' =>$id_jefe,
            ]);
            */
        }
        ////art44 diaeconomico////
        if($id_articulo ==1){
            $fecha_req=$request->input('fecha_req2');
            $motivo_oficio = $request->input('motivo_oficio');
            $id_solicitud=Inc_solicitude::create([
                'id_articulo'=>$id_articulo,
                'fecha_solicitud' => $today,
                'fecha_req'=>$fecha_req,
                'motivo_oficio' => $motivo_oficio,
                'id_personal' =>$id_personal,
                'id_jefe' =>$id_jefe,
                'id_estado_solicitud'=>$id_estado_solicitud,
            ]);
            /*
            $id_solicitud=$id_solicitud->id;
            DB::table('inc_evidencias')->insert([
                'id_solicitud' => $id_solicitud,
                'id_personal' =>$id_personal,
                'id_jefe' =>$id_jefe,
            ]);
            */
        }
        ///////art 44 medias jornadas////
        if($id_articulo ==9){

            $fecha_req=$request->input('fecha_req2');
            $motivo_oficio = $request->input('motivo_oficio');
            $hora_e2=$request->input('hora_e2');
            $hora_s2=$request->input('hora_s2');

            $id_solicitud=Inc_solicitude::create([
                'id_articulo'=>$id_articulo,
                'fecha_solicitud' => $today,
                'fecha_req'=>$fecha_req,
                'motivo_oficio' => $motivo_oficio,
                'hora_e2'=>$hora_e2,
                'hora_s2'=>$hora_s2,
                'id_personal' =>$id_personal,
                'id_jefe' =>$id_jefe,
                'id_estado_solicitud'=>$id_estado_solicitud,
                //////a
            ]);
            /*
            $id_solicitud=$id_solicitud->id;
            DB::table('inc_evidencias')->insert([
                'id_solicitud' => $id_solicitud,
                'id_personal' =>$id_personal,
                'id_jefe' =>$id_jefe,
            ]);
            */
        }
        return Redirect::to('/incidencias/historial_docentesSo');
        }

    public function guardar_otra_evidencia(Request $request)
    {
      //  dd($request);
    $maximo= DB::selectOne('select max(id_evid) maximo FROM inc_evidencias');

    if($maximo->maximo==null){
     $maximo=1;

    }else{
        $maximo= $maximo->maximo+1;
    }
    $file=$request->file('arch_evidencia');

    $documento=$request->file('arch_evidencia');
    $id_tipo_evid=$request->input('id_tipo_evid');
    $name="evidencia_incidencia_".$maximo.".".$file->getClientOriginalExtension();
    $file->move(public_path().'/incidencias/', $name);
    $id_usuario = Session::get('usuario_alumno');
    $id_personal = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario= ?', [$id_usuario]);
    $id_personal = $id_personal->id_personal;
    if( $id_tipo_evid == 1 || $id_tipo_evid == 3 || $id_tipo_evid == 4 || $id_tipo_evid == 5 || $id_tipo_evid == 6 || $id_tipo_evid == 8 ){
        $fecha_requerida=$request->input('fecha_req1');
    }else{
        $fecha_requerida=$request->input('fecha_req2');
    }



        DB::table('inc_evidencias')->insert([
            'id_evid'=>$maximo,
            'id_personal'=>$id_personal,
            'id_tipo_evid' => $id_tipo_evid,
            'arch_evidencia' => $name,
            'fecha_solicita' => $fecha_requerida,
        ]);

     return redirect('/incidencias/editar_evidencia/'.$maximo);
    }



    public function editar_evidencia ($id_evid){

    $evidencia= DB::selectOne('select inc_evidencias.*,inc_tipo_evidencia.nombre_evidencia FROM inc_tipo_evidencia, inc_evidencias WHERE inc_evidencias.id_tipo_evid = inc_tipo_evidencia.id_tipo_evid AND inc_evidencias.id_evid= ?', [$id_evid]);
    //dd($evidencia);
    return view('incidencias.editar_evidencia',compact ('evidencia'));
}
public function editar_evidencia2($id_evid){
    $evidencia= DB::selectOne('select inc_evidencias.*,inc_tipo_evidencia.nombre_evidencia FROM inc_tipo_evidencia, inc_evidencias WHERE inc_evidencias.id_tipo_evid = inc_tipo_evidencia.id_tipo_evid AND inc_evidencias.id_evid= ?', [$id_evid]);

    return view('incidencias.editar_evidencia2',compact ('evidencia'));

}
public function eliminar_evidencia(Request $request,$id_evid){
    DB::delete('DELETE FROM inc_evidencias WHERE id_evid= ?', [$id_evid]);
    return redirect('/incidencias/cargar_otra_evidencia');
}
public function modificar_evidencia($id_evid){
    $evidencia= DB::selectOne('select inc_evidencias.*,inc_tipo_evidencia.nombre_evidencia FROM inc_tipo_evidencia, inc_evidencias WHERE inc_evidencias.id_tipo_evid = inc_tipo_evidencia.id_tipo_evid AND inc_evidencias.id_evid= ?', [$id_evid]);
    $tipo_evidencia= DB::select('SELECT * from inc_tipo_evidencia ORDER by nombre_evidencia ASC');
    //dd($evidencia);
    return view('incidencias.partials_mod_evidencia',compact('evidencia','tipo_evidencia'));
}
    public function modificar_evidencia2($id_evid){
        $evidencia= DB::selectOne('select inc_evidencias.*,inc_tipo_evidencia.nombre_evidencia FROM inc_tipo_evidencia, inc_evidencias WHERE inc_evidencias.id_tipo_evid = inc_tipo_evidencia.id_tipo_evid AND inc_evidencias.id_evid= ?', [$id_evid]);
        $tipo_evidencia= DB::select('SELECT * from inc_tipo_evidencia ORDER by nombre_evidencia ASC');
        //dd($evidencia);
        return view('incidencias.partials_mod_evidencia2',compact('evidencia','tipo_evidencia'));
    }


public function consultar_jefes(){
    $id_usuario = Session::get('usuario_alumno');
    $id_personal = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario= ?', [$id_usuario]);
    $id_personal = $id_personal->id_personal;
    $id_periodo = Session::get('periodotrabaja');
    $carreras = DB::Select('SELECT gnral_periodo_carreras.id_carrera
    from gnral_personales, gnral_horarios, gnral_periodo_carreras WHERE
    gnral_horarios.id_personal = gnral_personales.id_personal AND
    gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera AND gnral_personales.id_personal= ?
    AND gnral_periodo_carreras.id_periodo = ?', [$id_personal, $id_periodo]);
    $array_carreras=array();

    foreach($carreras as $carrera){
        $nombre_jefe=DB::SelectOne('SELECT gnral_personales.id_personal,gnral_personales.nombre
        FROM gnral_personales, gnral_jefes_periodos WHERE gnral_jefes_periodos.id_personal=gnral_personales.id_personal
        AND gnral_jefes_periodos.id_carrera= ? and gnral_jefes_periodos.id_periodo= ?', [$carrera->id_carrera, $id_periodo]);
    $dat['id_personal']=$nombre_jefe->id_personal;
    $dat['nombre']=$nombre_jefe->nombre;
    array_push($array_carreras, $dat);
    }
    return $array_carreras;

}
public function aceptadojefe($id_solicitud_oficio)
{
    DB::table('inc_solicitudes')
        ->where('id_solicitud', $id_solicitud_oficio)
        ->update([
            'id_estado_solicitud' => 2
        ]);

    $solicitud = DB::table('inc_solicitudes')
        ->where('id_solicitud', $id_solicitud_oficio)
        ->first();

    //dd($solicitud);

    return redirect('/incidencias/validar_oficios/historial');
}


public function aceptado_acad_finanzas($id_solicitud_oficio){

    DB::update('UPDATE `inc_solicitudes` SET `id_estado_solicitud` = 2 WHERE `inc_solicitudes`.`id_solicitud` = ?', [$id_solicitud_oficio]);
    return redirect('/incidencias/validar_oficios_departamentos/historial');
}

    public function aceptadodirector($id_solicitud_oficio){
        DB::update('UPDATE `inc_solicitudes` SET `id_estado_solicitud` = 2 WHERE `inc_solicitudes`.`id_solicitud` = ?', [$id_solicitud_oficio]);
        return redirect('/incidencias/validar_oficios_direct_historial');
    }
public function rechazadojefe($id_solicitud_oficio){
    DB::update('UPDATE `inc_solicitudes` SET `id_estado_solicitud` = 3 WHERE `inc_solicitudes`.`id_solicitud` = ?', [$id_solicitud_oficio]);
    return back();
}
public function rechazado_acad_finanzas($id_solicitud_oficio){
    DB::update('UPDATE `inc_solicitudes` SET `id_estado_solicitud` = 3 WHERE `inc_solicitudes`.`id_solicitud` = ?', [$id_solicitud_oficio]);
    return back();
}
public function enviadojefe($id_solicitud_oficio){
    DB::update('UPDATE `inc_solicitudes` SET `id_estado_solicitud` = 4 WHERE `inc_solicitudes`.`id_solicitud` = ?', [$id_solicitud_oficio]);
    DB::update('UPDATE `inc_solicitudes` SET `directora` = 274  WHERE `inc_solicitudes`.`id_solicitud` = ?', [$id_solicitud_oficio]);
    return redirect('/incidencias/validar_oficios');
}

public function validacion_historial(){
    $id_usuario = Session::get('usuario_alumno');
    $id_personal = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario= ?', [$id_usuario]);
   // dd($id_personal);
    $id_personal = $id_personal->id_personal;
    //dd($id_personal);
    $solicitudes = DB:: table ('inc_solicitudes')
    ->join('inc_articulos','inc_solicitudes.id_articulo','=','inc_articulos.id_articulo')
    ->join('gnral_personales','inc_solicitudes.id_personal','=','gnral_personales.id_personal')
        ->whereIn('inc_solicitudes.id_estado_solicitud',[2,4])
        ->where('inc_solicitudes.id_jefe','=',$id_personal)
    ->select('inc_solicitudes.*', 'inc_articulos.*', 'gnral_personales.*')
    ->orderBy('inc_solicitudes.id_solicitud','DESC')
    ->get();
   // dd($solicitudes);
    return view('incidencias.validacion_historial',compact('solicitudes', 'id_personal'));
}
public function ver($id_oficio){
    //mostar la solicitud por comisionado

    $oficios=DB::selectOne('select gnral_personales.nombre, inc_solicitudes.*,inc_articulos.*
    FROM inc_solicitudes, inc_articulos, gnral_personales
    WHERE inc_solicitudes.id_personal=gnral_personales.id_personal and inc_solicitudes.id_articulo=inc_articulos.id_articulo and id_solicitud= ?', [$id_oficio]);
//dd($oficios);
    return view('incidencias.modal_ver',compact('oficios'));
}
public function validar_articulos($id_articulo){
    $id_usuario = Session::get('usuario_alumno');
    $id_personal = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario= ?', [$id_usuario]);
    $id_personal = $id_personal->id_personal;
    $articulo=$id_articulo;

    $anio=DB::SelectOne('SELECT p.nombre, (YEAR(NOW())-p.fch_ingreso_tesvb ) as anios_tesvb
    from gnral_personales as p where p.id_personal= ?', [$id_personal]);
    $estado='2';
    $s_enviada=DB::SelectOne('SELECT COUNT(s.id_articulo) as solicitudes
    from inc_solicitudes as s, inc_articulos as a, gnral_personales as p
    where s.id_articulo=a.id_articulo and s.id_articulo= ?
    and p.id_personal=s.id_personal and p.id_personal= ? and s.id_estado_solicitud= ?', [$articulo, $id_personal, $estado]);

    $validacion_art=DB::selectOne('SELECT * FROM inc_articulos WHERE inc_articulos.id_articulo= ?', [$id_articulo]);

    if($validacion_art->id_articulo==1 || $validacion_art->id_articulo==6){
        if($anio->anios_tesvb>= '1' && $anio->anios_tesvb<='9'){
            $dias_dis = '4';
        }else{
            if($anio->anios_tesvb> '9'  && $anio->anios_tesvb<='15'){
                $dias_dis = '5';
            }else{
                if($anio->anios_tesvb>'15'){
                    $dias_dis='6';
                }
            }
        }
        $estado=$dias_dis-$s_enviada->solicitudes;
    }else{
        if($validacion_art->id_articulo==9 || $validacion_art->id_articulo==10){
            $dias_art='4';
            $estado=$dias_art-$s_enviada->solicitudes;
        }else{
            $estado='1';
        }
    }
    return($estado);
}

public function vista2oficio($id_solicitud)
{
    $oficio = DB::selectOne('SELECT * FROM `inc_solicitudes` WHERE id_solicitud= ?', [$id_solicitud]);
    return view('incidencias.cargar_oficio', compact ('oficio'));
}

public function guardar_oficio(Request $request, $id_oficio)
{
    $file=$request->file('arch_solicitud');
    $name="evidencia_oficio_".$id_oficio.".".$file->getClientOriginalExtension();
    $file->move(public_path().'/incidencias_oficios/', $name);

        DB::table('inc_solicitudes')->where('id_solicitud', $id_oficio)
        ->update([
            'arch_solicitud' => $name,
        ]);
        $id_solicitud=$id_oficio;

 return redirect('/incidencias/editar_oficio_firmado/'.$id_solicitud);
}
public function  notificaciones() {
    $id_usuario = Session::get('usuario_alumno');
    $id_personal = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario= ?', [$id_usuario]);
    $id_personal = $id_personal->id_personal;
    $num=1;
    $noti=DB::selectOne('SELECT COUNT(id_jefe) as contador FROM inc_solicitudes WHERE inc_solicitudes.id_jefe= ? and inc_solicitudes.id_estado_solicitud= ?', [$id_personal, $num]);

    return response()->json($noti);

}
public function  notificacionesacep() {
    $id_usuario = Session::get('usuario_alumno');
    $id_personal = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario= ?', [$id_usuario]);
    $id_personal = $id_personal->id_personal;
    $num=2;
    $noti=DB::selectOne('SELECT COUNT(id_personal) as contador FROM inc_solicitudes
    WHERE inc_solicitudes.id_personal= ? and inc_solicitudes.id_estado_solicitud= ? and inc_solicitudes.arch_solicitud IS null', [$id_personal, $num]);

    return response()->json($noti);

}
public  function ver_solicitud_incidencia($id_solicitud){

    $solicitud=DB::selectOne('select gnral_personales.nombre,
       inc_solicitudes.*,inc_articulos.*,inc_evidencias.id_evid,inc_evidencias.arch_evidencia
    FROM inc_solicitudes, inc_articulos, gnral_personales,inc_evidencias
    WHERE inc_solicitudes.id_personal=gnral_personales.id_personal
    and inc_solicitudes.id_articulo=inc_articulos.id_articulo and inc_evidencias.id_solicitud = inc_solicitudes.id_solicitud
    and inc_solicitudes.id_solicitud= ?', [$id_solicitud]);
  // dd($solicitud);
    $fechaact = date('Y-m-d');

    return view('incidencias.agregar_evidencia_oficio',compact('solicitud','fechaact'));

}
public function historial_oficios_autorizados(){

        $id_usuario = Session::get('usuario_alumno');
        $id_personal = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario= ?', [$id_usuario]);
        $id_personal = $id_personal->id_personal;


        $historial_oficios=DB::select('SELECT gnral_personales.id_personal, gnral_personales.nombre, inc_solicitudes.*, inc_articulos.*
       from gnral_personales, inc_solicitudes, inc_articulos where gnral_personales.id_personal=inc_solicitudes.id_personal
        and inc_articulos.id_articulo=inc_solicitudes.id_articulo and inc_solicitudes.id_estado_solicitud=2 and inc_solicitudes.id_jefe= ?
     ORDER BY inc_solicitudes.fecha_solicitud DESC', [$id_personal]);
       // dd($historial_oficios);

    return view('incidencias.historial_oficio_autorizados',compact('historial_oficios'));

}
public function historial_evidencias_conocimiento($id_personal){

 //  dd($id_personal);

    $histEvi = DB:: table ('inc_evidencias')
        ->join ('inc_tipo_evidencia', 'inc_evidencias.id_tipo_evid','=','inc_tipo_evidencia.id_tipo_evid')
        ->join ('gnral_personales', 'gnral_personales.id_personal','=','inc_evidencias.id_personal')
        ->where('inc_evidencias.id_autorizado','=',2)
        ->where('inc_evidencias.id_personal','=',$id_personal)
        ->select('inc_evidencias.*', 'inc_tipo_evidencia.*','gnral_personales.nombre')
        ->orderBy('inc_evidencias.fecha_solicita','DESC')
        ->get();
    //dd($histEvi);


    $id_usuario = Session::get('usuario_alumno');
    $id_personals = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario= ?', [$id_usuario]);
    // dd($id_personal);
    $id_personals = $id_personals->id_personal;
    $id_periodo = Session::get('periodotrabaja');

    $estado_jefe=DB::selectOne('SELECT COUNT(id_jefe_periodo)contar  FROM gnral_jefes_periodos
     WHERE id_personal = ? AND id_periodo = ?', [$id_personals, $id_periodo]);
    $unidad = Session::get('id_unidad_admin');

    if($estado_jefe->contar == 0){
        $estado=1;
        $personal=DB::select('select gnral_personales.id_personal,gnral_personales.nombre FROM gnral_personales, adscripcion_personal,gnral_unidad_personal,
abreviaciones_prof,abreviaciones WHERE gnral_personales.id_personal=adscripcion_personal.id_personal
and gnral_unidad_personal.id_unidad_persona=adscripcion_personal.id_unidad_persona and abreviaciones_prof.id_personal=gnral_personales.id_personal
AND abreviaciones_prof.id_abreviacion=abreviaciones.id_abreviacion and gnral_unidad_personal.id_unidad_admin= ?', [$unidad]);
    }else{
        $id_carrera = Session::get('carrera');

        $id_periodo_carrera = DB::selectOne('select id_periodo_carrera from gnral_periodo_carreras where id_periodo= ? AND
            id_carrera= ?', [$id_periodo, $id_carrera]);
        $id_periodo_carrera=$id_periodo_carrera->id_periodo_carrera;

        $personal=DB::select('select gnral_personales.id_personal,gnral_personales.nombre FROM gnral_personales, gnral_horarios
WHERE gnral_horarios.id_periodo_carrera= ? AND gnral_horarios.id_personal=gnral_personales.id_personal
UNION select gnral_personales.id_personal,gnral_personales.nombre FROM gnral_personales, adscripcion_personal,gnral_unidad_personal,
abreviaciones_prof,abreviaciones WHERE gnral_personales.id_personal=adscripcion_personal.id_personal
and gnral_unidad_personal.id_unidad_persona=adscripcion_personal.id_unidad_persona and abreviaciones_prof.id_personal=gnral_personales.id_personal
AND abreviaciones_prof.id_abreviacion=abreviaciones.id_abreviacion and gnral_unidad_personal.id_unidad_admin= ?', [$id_periodo_carrera, $unidad]);

        $estado=1;


    }
   // dd($histEvi);

    return view('incidencias.historial_evidencia_conocimiento', compact ('histEvi','id_personal','personal','estado'));
}
public function validar_oficios_departamentos(){
    //$id_usuario = Session::get('usuario_alumno');
   // $id_personal = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario='.$id_usuario.'');
    // dd($id_personal);
   // $id_personal = $id_personal->id_personal;
    //dd($id_personal);
    $solicitudes = DB:: table ('inc_solicitudes')
        ->join('inc_articulos','inc_solicitudes.id_articulo','=','inc_articulos.id_articulo')
        ->join('gnral_personales','inc_solicitudes.id_personal','=','gnral_personales.id_personal')
        ->where('inc_solicitudes.id_estado_solicitud','=',4)
        ->select('inc_solicitudes.*', 'inc_articulos.*', 'gnral_personales.nombre')
        ->orderBy('inc_solicitudes.id_solicitud','DESC')
        ->get();
   // dd($solicitudes);

    return view('incidencias.director_validar', compact ('solicitudes'));
}
public function validar_oficios_dep_acad_finanzas(){
      //  dd("hola");
    $id_usuario = Session::get('usuario_alumno');
    $id_personal = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario= ?', [$id_usuario]);
    // dd($id_personal);
    $id_personal = $id_personal->id_personal;
    //dd($id_personal);
    $solicitudes = DB:: table ('inc_solicitudes')
        ->join('inc_articulos','inc_solicitudes.id_articulo','=','inc_articulos.id_articulo')
        ->join('gnral_personales','inc_solicitudes.id_personal','=','gnral_personales.id_personal')
        ->where('inc_solicitudes.id_estado_solicitud','=',1)
        ->where('inc_solicitudes.direc_finanzas','=',$id_personal)
        ->select('inc_solicitudes.*', 'inc_articulos.*', 'gnral_personales.*')
        ->orderBy('inc_solicitudes.fecha_req','ASC')
        ->get();
    return view('incidencias.validar_aca_finanzas', compact ('solicitudes'));
}
public function validacion_departamentos_historial(){
    //  dd("hola");
    $id_usuario = Session::get('usuario_alumno');
    $id_personal = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario= ?', [$id_usuario]);
    // dd($id_personal);
    $id_personal = $id_personal->id_personal;
    //dd($id_personal);
    $solicitudes = DB:: table ('inc_solicitudes')
        ->join('inc_articulos','inc_solicitudes.id_articulo','=','inc_articulos.id_articulo')
        ->join('gnral_personales','inc_solicitudes.id_personal','=','gnral_personales.id_personal')
        ->where('inc_solicitudes.id_estado_solicitud','=',2)
        ->where('inc_solicitudes.direc_finanzas','=',$id_personal)
        ->select('inc_solicitudes.*', 'inc_articulos.*', 'gnral_personales.*')
        ->orderBy('inc_solicitudes.fecha_req','ASC')
        ->get();
    return view('incidencias.validacion_historial_oficios_depart', compact ('solicitudes'));
}
public function validar_oficios_direct_historial(){

    $id_usuario = Session::get('usuario_alumno');
    $id_personal = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario= ?', [$id_usuario]);
    // dd($id_personal);
    $id_personal = $id_personal->id_personal;
    //dd($id_personal);
    $solicitudes = DB:: table ('inc_solicitudes')
        ->join('inc_articulos','inc_solicitudes.id_articulo','=','inc_articulos.id_articulo')
        ->join('gnral_personales','inc_solicitudes.id_personal','=','gnral_personales.id_personal')
        ->where('inc_solicitudes.id_estado_solicitud','=',2)
        ->where('inc_solicitudes.directora','=',$id_personal)
        ->select('inc_solicitudes.*', 'inc_articulos.*', 'gnral_personales.*')
        ->orderBy('inc_solicitudes.fecha_req','ASC')
        ->get();


    return view('incidencias.historiales_direct_valida',compact('solicitudes', 'id_personal'));
}
public function agregar_oficio_firmado($id_solicitud){

    $solicitud=DB::selectOne('select gnral_personales.nombre,
       inc_solicitudes.*,inc_articulos.*
    FROM inc_solicitudes, inc_articulos, gnral_personales
    WHERE inc_solicitudes.id_personal=gnral_personales.id_personal
    and inc_solicitudes.id_articulo=inc_articulos.id_articulo
    and inc_solicitudes.id_solicitud= ?', [$id_solicitud]);


    $fechaact = date('Y-m-d');

    return view('incidencias.agregar_oficio_firmado',compact('solicitud','fechaact'));

}
public function editar_oficio_firmado($id_solicitud){

    $solicitud=DB::selectOne('select gnral_personales.nombre,
       inc_solicitudes.*,inc_articulos.*
    FROM inc_solicitudes, inc_articulos, gnral_personales
    WHERE inc_solicitudes.id_personal=gnral_personales.id_personal
    and inc_solicitudes.id_articulo=inc_articulos.id_articulo
    and inc_solicitudes.id_solicitud= ?', [$id_solicitud]);
    // dd($solicitud);
    $fechaact = date('Y-m-d');


    return view('incidencias.editar_oficio_autiruzar',compact('solicitud','fechaact'));

}
public function historial_evid_personal(){

    $id_usuario = Session::get('usuario_alumno');
    $id_personal = DB::SelectOne('SELECT * FROM `gnral_personales` WHERE tipo_usuario= ?', [$id_usuario]);
    // dd($id_personal);
    $id_personal = $id_personal->id_personal;
    $id_periodo = Session::get('periodotrabaja');

    $estado_jefe=DB::selectOne('SELECT COUNT(id_jefe_periodo)contar  FROM gnral_jefes_periodos
     WHERE id_personal = ? AND id_periodo = ?', [$id_personal, $id_periodo]);
    $unidad = Session::get('id_unidad_admin');

    if($estado_jefe->contar == 0){
        $estado=0;
        $personal=DB::select('select gnral_personales.id_personal,gnral_personales.nombre FROM gnral_personales, adscripcion_personal,gnral_unidad_personal,
abreviaciones_prof,abreviaciones WHERE gnral_personales.id_personal=adscripcion_personal.id_personal
and gnral_unidad_personal.id_unidad_persona=adscripcion_personal.id_unidad_persona and abreviaciones_prof.id_personal=gnral_personales.id_personal
AND abreviaciones_prof.id_abreviacion=abreviaciones.id_abreviacion and gnral_unidad_personal.id_unidad_admin= ?', [$unidad]);
    }else{
        $id_carrera = Session::get('carrera');

        $id_periodo_carrera = DB::selectOne('select id_periodo_carrera from gnral_periodo_carreras where id_periodo= ? AND
            id_carrera= ?', [$id_periodo, $id_carrera]);
        $id_periodo_carrera=$id_periodo_carrera->id_periodo_carrera;

        $personal=DB::select('select gnral_personales.id_personal,gnral_personales.nombre FROM gnral_personales, gnral_horarios
WHERE gnral_horarios.id_periodo_carrera= ? AND gnral_horarios.id_personal=gnral_personales.id_personal
UNION select gnral_personales.id_personal,gnral_personales.nombre FROM gnral_personales, adscripcion_personal,gnral_unidad_personal,
abreviaciones_prof,abreviaciones WHERE gnral_personales.id_personal=adscripcion_personal.id_personal
and gnral_unidad_personal.id_unidad_persona=adscripcion_personal.id_unidad_persona and abreviaciones_prof.id_personal=gnral_personales.id_personal
AND abreviaciones_prof.id_abreviacion=abreviaciones.id_abreviacion and gnral_unidad_personal.id_unidad_admin= ?', [$id_periodo_carrera, $unidad]);

        $estado=0;


    }
    return view('incidencias.historial_evidencia_conocimiento', compact ('estado','personal'));
      //  dd("hola");
}
public function reporte_excel_inc($id_articulo,$fecha_inicial,$fecha_final,$estado){


    return Excel::download(new Inc_reportequincenalExport($id_articulo, $fecha_inicial,$fecha_final,$estado), $fecha_inicial.'_al_'.$fecha_final.'.xlsx');

}
public function validar_evid_autorizar($id_evid){
    DB::table('inc_evidencias')
        ->where('id_evid', $id_evid)
        ->update([
            'id_autorizado' => 2,
        ]);
    return back();
}
    public function validar_evid_rechazar($id_evid){
        DB::table('inc_evidencias')
            ->where('id_evid', $id_evid)
            ->update([
                'id_autorizado' => 3,
            ]);
        return back();
    }
}
