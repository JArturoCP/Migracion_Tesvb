<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Session;

class Serv_Esc_Dual_AlumnoController extends Controller
{
    public function index()
    {
        $id_periodo = Session::get('periodotrabaja');

        $estudiantes = DB::select('SELECT eva_validacion_de_cargas.id, eva_validacion_de_cargas.id_alumno, 
    gnral_alumnos.cuenta, gnral_alumnos.nombre, gnral_alumnos.apaterno, gnral_alumnos.amaterno, gnral_carreras.nombre AS carreras 
FROM eva_validacion_de_cargas
    JOIN gnral_alumnos ON eva_validacion_de_cargas.id_alumno = gnral_alumnos.id_alumno
    JOIN gnral_carreras ON gnral_alumnos.id_carrera = gnral_carreras.id_carrera
WHERE 
    (
        gnral_alumnos.cuenta LIKE ? OR
        gnral_alumnos.cuenta LIKE ? 
    )
    AND eva_validacion_de_cargas.id_alumno NOT IN (
        SELECT id_alumno 
        FROM cal_duales_actuales 
        WHERE id_periodo = ?
    )
GROUP BY eva_validacion_de_cargas.id_alumno',
            ['C%', 'R%', $id_periodo]
        );


        //dd($estudiantes);
        $array_estudiantes = array();
        foreach ($estudiantes as $estudiante) {
            $estado_estudiante = DB::selectOne('SELECT COUNT(id_datos_alumno_reg_dep) AS contar FROM ti_datos_alumno_reg_dep WHERE ti_datos_alumno_reg_dep.id_alumno = ' . $estudiante->id_alumno . '');
            $cal_resi = DB::selectOne('SELECT COUNT(id_alumno) AS contar FROM cal_residencia WHERE id_alumno = ' . $estudiante->id_alumno . '');
            if ($estado_estudiante->contar == 0 || $cal_resi->contar == 0) {
                $dat['id_alumno'] = $estudiante->id_alumno;
                $dat['cuenta'] = $estudiante->cuenta;
                $dat['nombre'] = $estudiante->nombre;
                $dat['apaterno'] = $estudiante->apaterno;
                $dat['amaterno'] = $estudiante->amaterno;
                $dat['carreras'] = $estudiante->carreras;
                array_push($array_estudiantes, $dat);
            }
        }
        //dd($array_estudiantes);
        $plantillas = DB::select('SELECT gnral_alumnos.id_alumno,gnral_alumnos.cuenta,
        gnral_alumnos.nombre,gnral_alumnos.apaterno,
        gnral_alumnos.amaterno,gnral_carreras.nombre AS carrera,
        MAX(eva_carga_academica.tipo_alumno) as tipo_alumno,
        cal_duales_actuales.id_duales_actuales
    FROM cal_duales_actuales
    JOIN gnral_alumnos ON gnral_alumnos.id_alumno = cal_duales_actuales.id_alumno
    JOIN gnral_carreras ON gnral_alumnos.id_carrera = gnral_carreras.id_carrera
    LEFT JOIN eva_carga_academica ON eva_carga_academica.id_alumno = gnral_alumnos.id_alumno
        AND eva_carga_academica.id_periodo = cal_duales_actuales.id_periodo
    WHERE cal_duales_actuales.id_periodo = ?
      AND (gnral_alumnos.cuenta LIKE "C%" OR gnral_alumnos.cuenta LIKE "R%")
    GROUP BY 
        gnral_alumnos.id_alumno,
        gnral_alumnos.cuenta,
        gnral_alumnos.nombre,
        gnral_alumnos.apaterno,
        gnral_alumnos.amaterno,
        gnral_carreras.nombre,
        cal_duales_actuales.id_duales_actuales
', [$id_periodo]);


        $estado_periodo = DB::selectOne('SELECT count(id_periodo)contar FROM gnral_periodos WHERE estado = 1 and id_periodo=' . $id_periodo . '');
        $estado_periodo = $estado_periodo->contar;


        return view('servicios_escolares.duales.agregar_alumnos_dual', compact('array_estudiantes', 'plantillas', 'estado_periodo'));
    }

    public function guardar_alumno_dual(Request $request)
    {
        $id_periodo = Session::get('periodotrabaja');
        $this->validate($request, [
            'alumno' => 'required',
        ]);
        $id_alumno = $request->input("alumno");
        //dd($request);
        $estado_dual = DB::selectOne('SELECT count(id_duales_actuales) contar 
        from cal_duales_actuales where id_periodo=' . $id_periodo . ' and id_alumno =' . $id_alumno . '');

        if ($estado_dual->contar == 0) {

            DB::table('cal_duales_actuales')
                ->insert([
                    'id_alumno' => $id_alumno,
                    'id_periodo' => $id_periodo,
                ]);
        }
        $estado_carga = DB::selectOne('SELECT count(id)contar FROM eva_validacion_de_cargas WHERE id_alumno = ' . $id_alumno . ' AND id_periodo = ' . $id_periodo . '');
        if ($estado_carga->contar == 0) {

            DB:: table('eva_validacion_de_cargas')
                ->insert([
                    'id_alumno' => $id_alumno,
                    'id_periodo' => $id_periodo,
                    'estado_validacion' => 0,
                ]);
        } else {

            DB::update('UPDATE eva_validacion_de_cargas SET estado_validacion = 0 WHERE id_alumno=' . $id_alumno . ' and id_periodo= ' . $id_periodo . ' ');

        }
        return back();
    }

    public function eliminar_alumno_dual(Request $request, $id_duales_actuales)
    {
        //dd($id_duales_actuales);
        $dual_registro = DB::selectOne('SELECT * FROM cal_duales_actuales WHERE id_duales_actuales = ' . $id_duales_actuales . ' ');

        DB::delete('DELETE FROM cal_duales_actuales WHERE id_duales_actuales=' . $id_duales_actuales . '');
        DB::table('eva_validacion_de_cargas')
            ->where('id_periodo', $dual_registro->id_periodo)
            ->where('id_alumno', $dual_registro->id_alumno)
            ->update(['estado_validacion' => 0]);
        /*
                DB::delete('DELETE FROM eva_validacion_de_cargas WHERE id_periodo='.$dual_registro->id_periodo.'
                AND id_alumno = '.$dual_registro->id_alumno.'');
                DB::delete('DELETE FROM eva_carga_academica  WHERE id_periodo='.$dual_registro->id_periodo.'
                AND id_alumno = '.$dual_registro->id_alumno.'');
        */

        return back();
    }

    public function eliminacion_dual(Request $request, $id_duales_actuales)
    {
        DB::table('cal_duales_actuales')
            ->where('id_duales_actuales', $id_duales_actuales)
            ->update(['id_personal' => 0]);
        return back();
    }

}
