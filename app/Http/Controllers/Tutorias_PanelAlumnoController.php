<?php

namespace App\Http\Controllers;

use App\Tutorias_Exp_antecedentes_academico;
use App\Tutorias_Exp_area_psicopedagogica;
use App\Tutorias_Exp_bachillerato;
use App\Tutorias_Exp_bebidas;
use App\Tutorias_Exp_beca;
use App\Tutorias_Exp_civil_estado;
use App\Tutorias_Exp_datos_familiare;
use App\Tutorias_Exp_escalas;
use App\Tutorias_Exp_familia_union;
use App\Tutorias_Exp_formacion_integral;
use App\Tutorias_Exp_generale;
use App\Tutorias_Exp_habitos_estudio;
use App\Tutorias_Exp_opc_intelectual;
use App\Tutorias_Exp_opc_tiempo;
use App\Tutorias_Exp_opc_vives;
use App\Tutorias_Exp_parentesco;
use App\Tutorias_Exp_turno;
use App\Alumnos;
use App\Carreras;
use App\Gnral_grupos;
use App\Periodos;
use App\Semestres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class Tutorias_PanelAlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // dd("hola");
        $id_alumno= Session::get('id_alumno');

       // $gen=Tutorias_Exp_generale::where('id_alumno','=',Session::get('id_alumno'))->get();
        $alumno=DB::selectOne('SELECT * FROM `exp_generales` WHERE `id_alumno` = ?', [$id_alumno]);

        /*$aca=Exp_antecedentes_academico::where('id_alumno','=',Session::get('id_alumno'))->get();
        $familiares=Exp_datos_familiare::where('id_alumno','=',Session::get('id_alumno'))->get();
        $habitos=Exp_habitos_estudio::where('id_alumno','=',Session::get('id_alumno'))->get();
        $integral=Exp_formacion_integral::where('id_alumno','=',Session::get('id_alumno'))->get();
        $area=Exp_area_psicopedagogica::where('id_alumno','=',Session::get('id_alumno'))->get();*/
        //dd($alumno);
        if($alumno->nombre != null)
        {

            return ('1');
        }
        else{
            return ('2');
        }
    }
    public function principal()
    {
        $id_usuario = Session::get('usuario_alumno');
        $alumno=DB::selectOne('SELECT * FROM `gnral_alumnos` WHERE `id_usuario` = ? ', [$id_usuario]);
        $estado_contar=DB::selectOne('SELECT count(id_alumno)contar from exp_generales where id_alumno = ?', [$alumno->id_alumno]);
        $estado_contar=$estado_contar->contar;
        if($estado_contar == 0){

            return  view('tutorias.alumnos.incio_registro');
        }else{
            $alumno=DB::selectOne('SELECT gnral_alumnos.id_alumno,gnral_alumnos.cuenta, exp_generales.nombre,exp_generales.foto from gnral_alumnos,exp_generales where exp_generales.id_alumno = gnral_alumnos.id_alumno and  gnral_alumnos.id_alumno= ?', [Session::get('id_alumno')]);

            return view('tutorias.alumnos.index',compact('alumno'));
        }


    }
/*
    public function datosAlu()
    {
        $data['datos_alumn']=Alumnos::where('id_alumno',Session::get('id_alumno'))->get();
        $data['generales']=Tutorias_Exp_generale::where('id_alumno',Session::get('id_alumno'))->get();
        //dd($data['generales']);
        $data['academicos']=Tutorias_Exp_antecedentes_academico::where('id_alumno',Session::get('id_alumno'))->get();
        $data['familiares']=Tutorias_Exp_datos_familiare::where('id_alumno',Session::get('id_alumno'))->get();
        $data['estudio']=Tutorias_Exp_habitos_estudio::where('id_alumno',Session::get('id_alumno'))->get();
        $data['integral']=Tutorias_Exp_formacion_integral::where('id_alumno',Session::get('id_alumno'))->get();
        $data['area']=Tutorias_Exp_area_psicopedagogica::where('id_alumno',Session::get('id_alumno'))->get();

        $data['carreras']= Carreras::all();
        $data['grupos']= Gnral_grupos::all();
        $data['periodos'] = Periodos::all();
        $data['semestres']= Semestres::all();
        $data['estadocivil'] = Tutorias_Exp_civil_estado::all();
        //$data['nivel']= Exp_opc_nivel_socio::all();
        $data['bachillerato'] = Tutorias_Exp_bachillerato::all();
        $data['vive'] = Tutorias_Exp_opc_vives::all();
        $data['unionfam'] = Tutorias_Exp_familia_union::all();
        $data['turno'] = Tutorias_Exp_turno::all();
        $data['tiempoestudia']= Tutorias_Exp_opc_tiempo::all();
        $data['intelectual']= Tutorias_Exp_opc_intelectual::all();
        $data['parentesco']=Tutorias_Exp_parentesco::all();
        $data['escala']=Tutorias_Exp_escalas::all();
        $data['bebidas']=Tutorias_Exp_bebidas::all();
        $data['becas']=Tutorias_Exp_beca::all();
        return $data;
    }
*/

public function datosAlu(Request $request){
$data['datos_alumn'] = Alumnos::where('id_alumno',Session::get('id_alumno'))->get();

// Obtener el alumno
$datos = $data['datos_alumn']->first();

// Semestre registrado actualmente en BD
$sem = $datos->id_semestre;

// Último periodo registrado para el alumno
$semestre_actual = DB::selectOne('SELECT id_periodo FROM eva_semestre_alumno WHERE id_alumno = ? ORDER BY id_semestres_al DESC ',[$datos->id_alumno]);

// Periodo actual
$periodo_actual = DB::selectOne('SELECT * FROM gnral_periodos WHERE estado = 1');

// Semestre que se mostrará en Vue
if ($semestre_actual && $periodo_actual) {

if ($semestre_actual->id_periodo < $periodo_actual->id_periodo) {
        $sem = $datos->id_semestre - 1;
    }
}

// Agregar el valor para Vue
$datos->id_semestre_vue = $sem;
$data['generales'] = Tutorias_Exp_generale::where('id_alumno',Session::get('id_alumno'))->get();
$data['academicos'] = Tutorias_Exp_antecedentes_academico::where('id_alumno',Session::get('id_alumno'))->get();
$data['familiares'] = Tutorias_Exp_datos_familiare::where('id_alumno',Session::get('id_alumno'))->get();
$data['estudio'] = Tutorias_Exp_habitos_estudio::where('id_alumno',Session::get('id_alumno'))->get();
$data['integral'] = Tutorias_Exp_formacion_integral::where('id_alumno',Session::get('id_alumno'))->get();
$data['area'] = Tutorias_Exp_area_psicopedagogica::where('id_alumno',Session::get('id_alumno'))->get();
$data['carreras'] = Carreras::all();
$data['grupos'] = Gnral_grupos::all();
$data['periodos'] = Periodos::all();
$data['semestres'] = Semestres::all();
$data['estadocivil'] = Tutorias_Exp_civil_estado::all();
$data['bachillerato'] = Tutorias_Exp_bachillerato::all();
$data['vive'] = Tutorias_Exp_opc_vives::all();
$data['unionfam'] = Tutorias_Exp_familia_union::all();
$data['turno'] = Tutorias_Exp_turno::all();
$data['tiempoestudia'] = Tutorias_Exp_opc_tiempo::all();
$data['intelectual'] = Tutorias_Exp_opc_intelectual::all();
$data['parentesco'] = Tutorias_Exp_parentesco::all();
$data['escala'] = Tutorias_Exp_escalas::all();
$data['bebidas'] = Tutorias_Exp_bebidas::all();
$data['becas'] = Tutorias_Exp_beca::all();

return $data;
}

    public function datosPrincipales()
    {
        $data['datos']=Alumnos::where('id_alumno',Session::get('id_alumno'))->get();
        $data['generales']=Tutorias_Exp_generale::where('id_alumno',Session::get('id_alumno'))->get();
        $data['academicos']=Tutorias_Exp_antecedentes_academico::where('id_alumno',Session::get('id_alumno'))->get();
        $data['familiares']=Tutorias_Exp_datos_familiare::where('id_alumno',Session::get('id_alumno'))->get();
        $data['estudio']=Tutorias_Exp_habitos_estudio::where('id_alumno',Session::get('id_alumno'))->get();
        $data['integral']=Tutorias_Exp_formacion_integral::where('id_alumno',Session::get('id_alumno'))->get();
        $data['area']=Tutorias_Exp_area_psicopedagogica::where('id_alumno',Session::get('id_alumno'))->get();
        $data['email']=Auth::user()->email;
        $data['carreras']= Carreras::all();
        $data['grupos']= Gnral_grupos::all();
        $data['periodos'] = Periodos::all();
        $data['semestres']= Semestres::all();
        $data['estadocivil'] = Tutorias_Exp_civil_estado::all();
        /*$data['nivel']= Exp_opc_nivel_socio::all();*/
        $data['bachillerato'] = Tutorias_Exp_bachillerato::all();
        $data['vive'] = Tutorias_Exp_opc_vives::all();
        $data['unionfam'] = Tutorias_Exp_familia_union::all();
        $data['turno'] = Tutorias_Exp_turno::all();
        $data['tiempoestudia']= Tutorias_Exp_opc_tiempo::all();
        $data['intelectual']= Tutorias_Exp_opc_intelectual::all();
        $data['parentesco']=Tutorias_Exp_parentesco::all();
        $data['escala']=Tutorias_Exp_escalas::all();
        $data['bebidas']=Tutorias_Exp_bebidas::all();
        $data['becas']=Tutorias_Exp_beca::all();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function registrar_inicio_expediente(){
        $id_usuario = Session::get('usuario_alumno');
        $alumn=DB::selectOne('SELECT * FROM `gnral_alumnos` WHERE id_usuario = ?', [$id_usuario]);

            DB:: table('exp_generales')
                 ->insert([
                'id_alumno' => $alumn->id_alumno,
            ]);

            DB:: table('exp_antecedentes_academicos')
            ->insert([
                'id_alumno' => $alumn->id_alumno,
            ]);

            DB:: table('exp_datos_familiares')
            ->insert([
                'id_alumno' => $alumn->id_alumno,
            ]);

            DB:: table('exp_habitos_estudio')
            ->insert([
                'id_alumno' => $alumn->id_alumno,
            ]);
            DB:: table('exp_formacion_integral')
            ->insert([
                'id_alumno' => $alumn->id_alumno,
            ]);

           DB:: table('exp_area_psicopedagogica')
            ->insert([
                'id_alumno' => $alumn->id_alumno,
            ]);

          return redirect('/tutorias/inicioalu');


    }
}
