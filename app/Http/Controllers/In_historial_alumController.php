<?php

namespace App\Http\Controllers;

use App\Exports\Tutorias_carrerasMulti_export;
use App\Exports\Ingles_historial_cal_export;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class In_historial_alumController extends Controller
{
    public function  index(){
        $carreras=DB::table('gnral_carreras')
            ->where('gnral_carreras.id_carrera','!=',9)
           /* ->where('gnral_carreras.id_carrera','!=',11)*/
            ->where('gnral_carreras.id_carrera','!=',15)
            ->select('gnral_carreras.*')
            ->get();
       return view('ingles.departamento.carreras_historial',compact('carreras'));
    }
    public function ver_alumnos_carrera($id_carrera){
        $alumnos=DB::select('SELECT gnral_alumnos.id_alumno,gnral_alumnos.cuenta,
       gnral_alumnos.nombre,gnral_alumnos.apaterno,gnral_alumnos.amaterno
from gnral_alumnos,in_validar_carga where gnral_alumnos.id_alumno = in_validar_carga.id_alumno
AND gnral_alumnos.id_carrera = ?
GROUP BY gnral_alumnos.id_alumno ORDER BY `gnral_alumnos`.`apaterno`,
                                          `gnral_alumnos`.`amaterno`, `gnral_alumnos`.`nombre` DESC
', [$id_carrera]);
        $periodo_actual=DB::selectOne('SELECT in_periodos.* from in_periodos where estado_historial=1 ');
       /// dd($periodo_actual);

        $array_alumnos = array();
        $numero=0;
        foreach ($alumnos as $alumno){
            $numero++;
            $dat_alumnos['numero'] = $numero;
            $dat_alumnos['id_alumno'] = $alumno->id_alumno;
            $dat_alumnos['cuenta'] = $alumno->cuenta;
            $dat_alumnos['nombre'] = mb_strtoupper($alumno->apaterno, 'utf-8') . " " . mb_strtoupper($alumno->amaterno, 'utf-8') . " " . mb_strtoupper($alumno->nombre, 'utf-8');
            $periodos=DB::select('SELECT in_periodos.* from in_periodos where id_periodo_ingles < ? and id_periodo_ingles >1', [$periodo_actual->id_periodo_ingles]);

            $array_periodo=array();
            foreach ($periodos as $periodo){
                $validacion_carga= DB::selectOne('SELECT count(in_validar_carga.id_validar_carga) validacion
              from in_validar_carga where id_alumno= ?
              and id_periodo= ? and id_estado=2 ', [$alumno->id_alumno, $periodo->id_periodo_ingles]);
                if($validacion_carga->validacion == 0)
                {
                    $cal['id_periodo'] = $periodo->id_periodo_ingles;
                    $cal['estado_periodo']=0;
                    $cal['calificacion']=0;
                    $cal['descripcion']="";
                }else{
                    $carga=DB::selectOne('SELECT * FROM `in_carga_academica_ingles`
                   WHERE `id_alumno` = ? AND `id_periodo_ingles` = ? ', [$alumno->id_alumno, $periodo->id_periodo_ingles]);
                    $nivel=DB::selectOne('SELECT * FROM `in_niveles_ingles` WHERE `id_niveles_ingles` = ? ', [$carga->id_nivel]);
                    $nivel=$nivel->descripcion;
                    $calificacion=DB::selectOne('SELECT SUM(calificacion) calificacion
                  from in_evaluar_calificacion where id_carga_ingles= ?', [$carga->id_carga_ingles]);
                    if($calificacion->calificacion == 0){
                        $cali=0;
                    }else{
                        $cali=($calificacion->calificacion)/4;
                        $cali=round($cali,0);
                    }
                    $cal['id_periodo'] = $periodo->id_periodo_ingles;
                    $cal['estado_periodo']=1;
                    $cal['calificacion']=$cali;
                    $cal['descripcion']="Nivel: ".$nivel." Grupo: ".$carga->id_grupo;

                }
                array_push($array_periodo, $cal);



            }
            $dat_alumnos['calificaciones']=$array_periodo;

            array_push($array_alumnos, $dat_alumnos);
            $carrera=DB::selectOne('SELECT * FROM `gnral_carreras` WHERE `id_carrera` = ? ORDER BY `id_carrera` ASC ', [$id_carrera]);

        }
        return view('ingles.departamento.mostrar_calificaciones',compact('array_alumnos','periodos','carrera','id_carrera'));
    }
    /*
    public function historial_calificaciones_excel($id_carrera){
        Session::put('historial_id_carrera',$id_carrera);

        $carr=DB::selectOne('SELECT * FROM `gnral_carreras` WHERE `id_carrera` = '.$id_carrera.'');

        if($carr->id_carrera == 2){
            $carrer="I S C";
        }
        else {
            $carrer = $carr->nombre;
        }

        Excel::create($carrer,function ($excel)
        {

            $id_carrera=Session::get('historial_id_carrera');

            $carr=DB::selectOne('SELECT * FROM `gnral_carreras` WHERE `id_carrera` = '.$id_carrera.'');
            if($carr->id_carrera == 2){
                $carrer="I S C";
            }
            else {
                $carrer = $carr->nombre;
            }

            $excel->sheet(''.$carrer, function($sheet) use($id_carrera)
            {
                $alumnos=DB::select('SELECT gnral_alumnos.id_alumno,gnral_alumnos.cuenta,
       gnral_alumnos.nombre,gnral_alumnos.apaterno,gnral_alumnos.amaterno
from gnral_alumnos,in_validar_carga where gnral_alumnos.id_alumno = in_validar_carga.id_alumno
AND gnral_alumnos.id_carrera = '.$id_carrera.'
GROUP BY gnral_alumnos.id_alumno ORDER BY `gnral_alumnos`.`apaterno`,
                                          `gnral_alumnos`.`amaterno`, `gnral_alumnos`.`nombre` DESC
');
                $periodo_actual=DB::selectOne('SELECT in_periodos.* from in_periodos where estado_historial=1 ');

                $array_alumnos = array();
                $numero=0;
                foreach ($alumnos as $alumno) {
                    $numero++;
                    $dat_alumnos['numero'] = $numero;
                    $dat_alumnos['id_alumno'] = $alumno->id_alumno;
                    $dat_alumnos['cuenta'] = $alumno->cuenta;
                    $dat_alumnos['nombre'] = mb_strtoupper($alumno->apaterno, 'utf-8') . " " . mb_strtoupper($alumno->amaterno, 'utf-8') . " " . mb_strtoupper($alumno->nombre, 'utf-8');
                    $periodos = DB::select('SELECT in_periodos.* from in_periodos where id_periodo_ingles <' . $periodo_actual->id_periodo_ingles . ' and id_periodo_ingles >1');

                    $array_periodo = array();
                    foreach ($periodos as $periodo) {
                        $validacion_carga = DB::selectOne('SELECT count(in_validar_carga.id_validar_carga) validacion
              from in_validar_carga where id_alumno=' . $alumno->id_alumno . '
              and id_periodo=' . $periodo->id_periodo_ingles . ' and id_estado=2 ');
                        if ($validacion_carga->validacion == 0) {
                            $cal['id_periodo'] = $periodo->id_periodo_ingles;
                            $cal['estado_periodo'] = 0;
                            $cal['calificacion'] = 0;
                            $cal['descripcion'] = "";
                        } else {
                            $carga = DB::selectOne('SELECT * FROM `in_carga_academica_ingles`
                   WHERE `id_alumno` = ' . $alumno->id_alumno . ' AND `id_periodo_ingles` = ' . $periodo->id_periodo_ingles . ' ');
                            $nivel = DB::selectOne('SELECT * FROM `in_niveles_ingles` WHERE `id_niveles_ingles` = ' . $carga->id_nivel . ' ');
                            $nivel = $nivel->descripcion;
                            $calificacion = DB::selectOne('SELECT SUM(calificacion) calificacion
                  from in_evaluar_calificacion where id_carga_ingles=' . $carga->id_carga_ingles . '');
                            if ($calificacion->calificacion == 0) {
                                $cali = 0;
                            } else {
                                $cali = ($calificacion->calificacion) / 4;
                                $cali = round($cali, 0);
                            }
                            $cal['id_periodo'] = $periodo->id_periodo_ingles;
                            $cal['estado_periodo'] = 1;
                            $cal['calificacion'] = $cali;
                            $cal['descripcion'] = "Nivel: " . $nivel . " Grupo: " . $carga->id_grupo;

                        }
                        array_push($array_periodo, $cal);


                    }
                    $dat_alumnos['calificaciones'] = $array_periodo;

                    array_push($array_alumnos, $dat_alumnos);
                }
                $sheet->loadView('ingles.departamento.concentrado_historial_cal',compact('array_alumnos','periodos'))
                ;
                $sheet->setOrientation('landscape');


            });



            //dd($array_carreras);

        })->export('xlsx');

    }
    */
    public function historial_calificaciones_excel($id_carrera){
        //Session::put('historial_id_carrera',$id_carrera);

        $carr=DB::selectOne('SELECT * FROM `gnral_carreras` WHERE `id_carrera` = ?', [$id_carrera]);
        if($carr->id_carrera == 2){
            $carrer="I S C";
        }
        else {
            $carrer = $carr->nombre;
        }
        return Excel::download(new Ingles_historial_cal_export($carr), $carrer.'.xlsx');

    }

    public function generar_constancias_alumnos_ingles($id_carrera)
    {
        // 1. Alumnos nivel 10
        /*$alumnos = DB::select("SELECT id_alumno, cuenta, nombre, apaterno, amaterno
        FROM gnral_alumnos
        JOIN in_carga_academica_ingles USING(id_alumno)
        WHERE id_carrera = ?
          AND id_nivel = 10
        ORDER BY cuenta ASC
    ", [$id_carrera]);*/


        $alumnos = DB::select("
    SELECT DISTINCT
        ga.id_alumno,
        ga.cuenta,
        ga.nombre,
        ga.apaterno,
        ga.amaterno,
        icai.id_nivel
    FROM gnral_alumnos ga
    JOIN in_carga_academica_ingles icai
        ON icai.id_alumno = ga.id_alumno
    WHERE ga.id_carrera = ?
      AND icai.id_nivel = 10
    ORDER BY ga.cuenta ASC
", [$id_carrera]);



        //dd($alumnos);
        // 2. Periodo actual
        $periodo_actual = DB::selectOne("
        SELECT * FROM in_periodos WHERE estado_historial = 1
    ");

        // 3. Periodos una sola vez
        $periodos = DB::select("
        SELECT * FROM in_periodos
        WHERE id_periodo_ingles < ? AND id_periodo_ingles > 1
    ", [$periodo_actual->id_periodo_ingles]);

        // IDs de alumnos
        $ids = array_column($alumnos, 'id_alumno');

        // 4. Cargas de todos
        $cargas = DB::table('in_carga_academica_ingles')
            ->whereIn('id_alumno', $ids)
            ->get()
            ->groupBy('id_alumno');

        // 5. Validaciones de todos
        $validaciones = DB::table('in_validar_carga')
            ->whereIn('id_alumno', $ids)
            ->get()
            ->groupBy('id_alumno');

        // 6. Calificaciones de todos
        $calificaciones = DB::table('in_evaluar_calificacion')
            ->select('id_carga_ingles', DB::raw('SUM(calificacion) as suma'))
            ->groupBy('id_carga_ingles')
            ->get()
            ->keyBy('id_carga_ingles');

        $array_alumnos = [];
        $numero = 0;

        foreach ($alumnos as $alumno) {
            $numero++;

            $data['numero'] = $numero;
            $data['id_alumno'] = $alumno->id_alumno;
            $data['cuenta'] = $alumno->cuenta;
            $data['nombre'] = mb_strtoupper("{$alumno->apaterno} {$alumno->amaterno} {$alumno->nombre}");

            $array_periodos = [];

            foreach ($periodos as $p) {
                // validación
                $val = $validaciones[$alumno->id_alumno]
                    ->where('id_periodo', $p->id_periodo_ingles)
                    ->where('id_estado', 2)
                    ->count();

                if ($val == 0) {
                    $array_periodos[] = [
                        'id_periodo' => $p->id_periodo_ingles,
                        'estado_periodo' => 0,
                        'calificacion' => 0,
                        'descripcion' => '',
                    ];
                } else {
                    $carga = $cargas[$alumno->id_alumno]
                        ->where('id_periodo_ingles', $p->id_periodo_ingles)
                        ->first();

                    $cal = $calificaciones[$carga->id_carga_ingles]->suma ?? 0;
                    $promedio = $cal == 0 ? 0 : round($cal / 4);

                    $array_periodos[] = [
                        'id_periodo' => $p->id_periodo_ingles,
                        'estado_periodo' => 1,
                        'calificacion' => $promedio,
                        'descripcion' => "Nivel: {$carga->id_nivel} Grupo: {$carga->id_grupo}",
                    ];
                }
            }

            $data['calificaciones'] = $array_periodos;
            $array_alumnos[] = $data;
        }

        //dd($array_alumnos);

        $carrera = DB::selectOne("SELECT * FROM gnral_carreras WHERE id_carrera = ?", [$id_carrera]);

        return view('ingles.departamento.generar_constancias', compact(
            'array_alumnos', 'periodos', 'carrera', 'id_carrera'
        ));
    }
}
