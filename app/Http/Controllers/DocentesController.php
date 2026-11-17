<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Gnral_Personales;
use App\Gnral_Materias;
use App\Gnral_Cargos;
use App\Gnral_Perfiles;
use App\Hrs_Situaciones;
use App\Gnral_Materias_Perfiles;
use App\Abreviaciones;
use App\Abreviaciones_prof;
use Session;


class DocentesController extends Controller
{

    public function index()
    {
        $jefe_division=session()->has('jefe_division')?session()->has('jefe_division'):false;
        $directivo=session()->has('directivo')?session()->has('directivo'):false;

        $docentes= DB::select('select gnral_personales.id_personal,gnral_personales.nombre,gnral_personales.esc_procedencia,
        gnral_personales.origen_nac,gnral_personales.fch_nac,gnral_personales.direccion,
        gnral_personales.fch_ingreso_tesvb,gnral_personales.nombramiento,
        gnral_personales.rfc,gnral_personales.fch_recontratacion,gnral_personales.escolaridad,
        gnral_personales.clave,gnral_personales.horas_maxima,gnral_personales.correo,
        gnral_personales.telefono,gnral_personales.celular,gnral_personales.cedula,gnral_personales.sexo
        ,gnral_personales.maximo_horas_ingles,hrs_situaciones.situacion,gnral_perfiles.descripcion,gnral_cargos.cargo,
        gnral_personales.id_cargo
        FROM
        gnral_personales,gnral_perfiles,hrs_situaciones,gnral_cargos WHERE
        gnral_personales.id_perfil=gnral_perfiles.id_perfil AND
        gnral_personales.id_situacion=hrs_situaciones.id_situacion AND
        gnral_personales.id_cargo=gnral_cargos.id_cargo
        UNION
        select gnral_personales.id_personal,gnral_personales.nombre,gnral_personales.esc_procedencia,
        gnral_personales.origen_nac,gnral_personales.fch_nac,gnral_personales.direccion,
        gnral_personales.fch_ingreso_tesvb,gnral_personales.nombramiento,
        gnral_personales.rfc,gnral_personales.fch_recontratacion,gnral_personales.escolaridad,
        gnral_personales.clave,gnral_personales.horas_maxima,gnral_personales.correo,
        gnral_personales.telefono,gnral_personales.celular,gnral_personales.cedula,gnral_personales.sexo
        ,gnral_personales.maximo_horas_ingles,hrs_situaciones.situacion,gnral_perfiles.descripcion,"AUN NO ASIGNADO",
        "0" id_cargo
        FROM
        gnral_personales,gnral_perfiles,hrs_situaciones,gnral_cargos WHERE
        gnral_personales.id_perfil=gnral_perfiles.id_perfil AND
        gnral_personales.id_situacion=hrs_situaciones.id_situacion AND
        gnral_personales.id_cargo NOT IN (SELECT gnral_cargos.id_cargo FROM gnral_cargos) ORDER BY clave');

        if($jefe_division==true)
        {
            $id_carrera=Session::get('carrera');
        $reticulas= DB::select('select *from gnral_reticulas WHERE gnral_reticulas.id_carrera= ?', [$id_carrera]);
       $datos_docente=array();

            foreach($docentes as $docent)
            {
                $nombre['nombre']= $docent->nombre;
                $nombre['id_personal']= $docent->id_personal;
                $nombre['clave']= $docent->clave;
                $nombre['situacion']= $docent->situacion;
                $nombre['origen_nac']= $docent->origen_nac;
                $nombre['fch_ingreso_tesvb']= $docent->fch_ingreso_tesvb;
                $nombre['rfc']= $docent->rfc;
                $nombre['id_cargo']= $docent->id_cargo;
                $nombre['cargo']= $docent->cargo;
                $nombre['fch_recontratacion']=$docent->fch_recontratacion;

                $materias = DB::select('select gnral_materias_perfiles.id_materia_perfil, gnral_materias.id_materia, gnral_materias.nombre,
                gnral_reticulas.clave
                FROM gnral_materias_perfiles, gnral_reticulas, gnral_materias
                WHERE gnral_materias_perfiles.id_materia = gnral_materias.id_materia
                AND gnral_materias.id_reticula = gnral_reticulas.id_reticula
                AND gnral_reticulas.id_carrera = ?
                AND gnral_materias_perfiles.id_personal = ? AND
                gnral_materias_perfiles.mostrar=1', [$id_carrera, $docent->id_personal]);

                $nombre_materias=array();
                foreach($materias as $materia)
                {
                    $nombrem['nombre_materia']= $materia->nombre;
                    $nombrem['id_materia']= $materia->id_materia;
                    $nombrem['id_materia_perfil']= $materia->id_materia_perfil;
                    array_push($nombre_materias, $nombrem);

                }
                $nombre['materias']=$nombre_materias;
                array_push($datos_docente,$nombre);
            }

    //$datos_docente=(json_encode($datos_docente,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE));
   // dd($datos_docente);
            return view('docentes.mostrar_docentes',compact('reticulas'))->with('docentesss',$datos_docente);
        }
        else
        {
            return view('docentes.mostrar_docentes',compact('docentes'));
        }

    }

    public function editar($id_personal)
    {
        Session::put('id_personal',$id_personal);
         $cargos = DB::select('select *from gnral_cargos order by cargo');
         $docente_edit = Gnral_Personales::find($id_personal);
         return view('docentes.partials.partial_mo_docente',compact('cargos'))->with(['edit' => true, 'docente_edit' => $docente_edit]);
    }

    public function actualizar($cargo,$hrs_max,$hrs_m_i)
    {
        $id_personal=Session::get('id_personal');
       $docentes=array(
        'id_cargo' => $cargo,
        'horas_maxima' => $hrs_max,
        'maximo_horas_ingles' => $hrs_m_i
        );
        Gnral_Personales::find($id_personal)->update($docentes);
        return redirect('/docente');
    }

    public function show($id)
    {
        //
    }

    public function modificar_docentes()
    {

        $id_usuario =Session::get('usuario_alumno');
        Session::put('id_usuario',$id_usuario);
        $var_error=Session::get("error");
        $ok = !empty($var_error)?"true":"false";

        $id_doc=DB::selectOne('select gnral_personales.id_personal from gnral_personales where tipo_usuario= ? ', [$id_usuario]);
        $id_docente=($id_doc->id_personal);

        $cargos = DB::select('select *from gnral_cargos order by cargo');
        $perfiles = DB::select('select *from gnral_perfiles order by descripcion');
        $situaciones = DB::select('select *from hrs_situaciones order by situacion');
        $abreviaciones= DB::select('select *from abreviaciones order by titulo');
        $docente_edit = Gnral_Personales::find($id_docente);
        $abre_doc1=DB::selectOne('select abreviaciones_prof.id_abreviacion from abreviaciones_prof WHERE
            abreviaciones_prof.id_personal= ?', [$id_docente]);
        $abre_doc = isset($abre_doc1->id_abreviacion)?$abre_doc1->id_abreviacion:0;
        //se elimino la variable personales
        return view('docentes.docentes_edit',compact('cargos','perfiles','situaciones','abreviaciones','abre_doc','ok'))->with(['edit' => true, 'docente_edit' => $docente_edit]);
    }
   /* public function edit($usuario)
    {
        Session::put('id_usuario',$usuario);
        $var_error=Session::get("error");
        $ok = !empty($var_error)?"true":"false";

        $id_doc=DB::selectOne('select gnral_personales.id_personal from gnral_personales where tipo_usuario='.$usuario.' ');
        $id_docente=($id_doc->id_personal);

        $cargos = DB::select('select *from gnral_cargos order by cargo');
        $perfiles = DB::select('select *from gnral_perfiles order by descripcion');
        $situaciones = DB::select('select *from hrs_situaciones order by situacion');
        $abreviaciones= DB::select('select *from abreviaciones order by titulo');
        $docente_edit = Gnral_Personales::find($id_docente);
        $abre_doc1=DB::selectOne('select abreviaciones_prof.id_abreviacion from abreviaciones_prof WHERE
            abreviaciones_prof.id_personal='.$id_docente.'');
        $abre_doc = isset($abre_doc1->id_abreviacion)?$abre_doc1->id_abreviacion:0;
 //se elimino la variable personales
        return view('docentes.docentes_edit',compact('cargos','perfiles','situaciones','abreviaciones','abre_doc','ok'))->with(['edit' => true, 'docente_edit' => $docente_edit]);
    }
*/
    public function update(Request $request, $id_docente)
    {
        // Este formulario modifica los datos personales de la cuenta autenticada.
        $personal = Gnral_Personales::findOrFail($id_docente);
        abort_unless((int) $personal->tipo_usuario === (int) $request->user()->id, 403);

        $rules = [
            'nombre_docente' => 'required|string|max:60',
            'clave_docente' => 'required|string|max:8',
            'rfc' => 'required|string|max:13',
            'esc_p' => 'required|string',
            'dir' => 'required|string|max:100',
            'correo' => 'required|email|max:40',
            'selectPerfil' => 'required|integer|exists:gnral_perfiles,id_perfil',
            'selectSituacion' => 'required|integer|exists:hrs_situaciones,id_situacion',
            'o_nac' => 'required|string|max:30',
            'f_nac' => 'required|date|before:today|max:10',
            'f_ingreso' => 'required|date|max:10',
            'selectNombra' => 'required|in:T,D',
            'f_contrata' => 'required|date|max:10',
            'selectEsc' => 'required|string|max:15',
            'telefono' => 'required|string|max:20',
            'celular' => 'required|string|max:20',
            'cedula' => 'required|integer|min:0|max:2147483647',
            'selectSexo' => 'required|in:M,F',
            'selectAbreviacion' => 'required|integer|exists:abreviaciones,id_abreviacion',
            'numero_empleado' => 'required|string|max:100',
        ];
        $attributes = [
            'nombre_docente' => 'nombre', 'clave_docente' => 'clave', 'rfc' => 'RFC',
            'esc_p' => 'escuela de procedencia', 'dir' => 'dirección', 'correo' => 'correo',
            'selectPerfil' => 'perfil', 'selectSituacion' => 'situación', 'o_nac' => 'origen de nacimiento',
            'f_nac' => 'fecha de nacimiento', 'f_ingreso' => 'fecha de ingreso',
            'selectNombra' => 'nombramiento', 'f_contrata' => 'fecha de contratación',
            'selectEsc' => 'escolaridad', 'telefono' => 'teléfono', 'celular' => 'celular',
            'cedula' => 'cédula', 'selectSexo' => 'sexo', 'selectAbreviacion' => 'abreviación',
            'numero_empleado' => 'número de empleado',
        ];
        $data = $request->validate($rules, [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
            'email' => 'Ingresa un correo electrónico válido.',
            'max' => 'El campo :attribute supera el límite permitido (:max).',
            'min' => 'El campo :attribute debe ser al menos :min.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'date' => 'Ingresa una fecha válida en :attribute.',
            'before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'exists' => 'Selecciona una opción válida para :attribute.',
            'in' => 'Selecciona una opción válida para :attribute.',
        ], $attributes);

        $mapping = [
            'nombre_docente' => 'nombre', 'rfc' => 'rfc', 'esc_p' => 'esc_procedencia',
            'dir' => 'direccion', 'correo' => 'correo', 'selectPerfil' => 'id_perfil',
            'selectSituacion' => 'id_situacion', 'o_nac' => 'origen_nac',
            'f_nac' => 'fch_nac', 'f_ingreso' => 'fch_ingreso_tesvb',
            'selectNombra' => 'nombramiento', 'f_contrata' => 'fch_recontratacion',
            'selectEsc' => 'escolaridad', 'telefono' => 'telefono', 'celular' => 'celular',
            'cedula' => 'cedula', 'selectSexo' => 'sexo', 'numero_empleado' => 'numero_empleado',
        ];
        $values = ['clave' => str_pad($data['clave_docente'], 8, '0', STR_PAD_LEFT)];
        foreach ($mapping as $input => $column) {
            $values[$column] = in_array($input, ['nombre_docente', 'rfc', 'esc_p', 'dir', 'correo', 'o_nac', 'selectEsc'], true)
                ? mb_strtoupper($data[$input], 'utf-8') : $data[$input];
        }

        // Ambos registros se guardan juntos; cargo, horas y departamento no se editan aquí.
        try {
            DB::transaction(function () use ($personal, $values, $data) {
                $personal->update($values);
                Abreviaciones_prof::updateOrCreate(
                    ['id_personal' => $personal->id_personal],
                    ['id_abreviacion' => $data['selectAbreviacion']]
                );
            });
        } catch (\Illuminate\Database\QueryException $exception) {
            report($exception);
            $message = 'No se pudieron guardar los cambios. Tus datos siguen en el formulario; intenta nuevamente.';
            if ($request->expectsJson()) {
                return response()->json(['message' => $message], 500);
            }
            return back()->withInput()->withErrors(['guardado' => $message]);
        }

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Datos actualizados correctamente.']);
        }
        return redirect('/docentes/modificar/')->with('docente_success', 'Datos actualizados correctamente.');
    }

    public function destroy($id_materia)
    {
        $materias = array(
                    'mostrar' => 0
                    );
        Gnral_Materias_Perfiles::find($id_materia)->update($materias);
        return redirect('/docente');
    }
    public function eliminar($id)
    {
        Gnral_Personales::find($id)-> delete();
        return redirect('/docente');
    }
}

?>
