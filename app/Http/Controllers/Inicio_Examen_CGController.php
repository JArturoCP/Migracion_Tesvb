<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class Inicio_Examen_CGController extends Controller
{
    public function docente()
    {
    $id_docente = Session::get('usuario_alumno');
    //dd($id_docente);

    $usuario = DB::table('users')
        ->where('id', $id_docente)
        ->first();

        //dd($usuario);

        return view('examen_gnral_con.index_examen',compact('id_docente'));
    }

   public function admin()
{   
    $id = session('usuario_alumno'); // o session('usuario_alumno')

    $usuario = DB::table('users')
        ->where('id', $id)
        ->first();

    $des_acad = 'des.academico@vbravo.tecnm.mx';

    if ($usuario && $usuario->email === $des_acad) {
        return view('examen_gnral_con.admin.index');
    }

    abort(403);
}

}