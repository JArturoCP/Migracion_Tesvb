<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Egel_InicioController extends Controller
{
    public function alumno()
    {
 $id_usuario = session('usuario');

    $id_carrera = DB::table('gnral_alumnos')
        ->where('id_usuario', $id_usuario)
        ->value('id_carrera');

        return view('examen_egel.dashboard',compact('id_carrera'));
    }

   public function admin()
{
    $id = session('usuario_alumno'); // o session('usuario_alumno')
//dd($id);
    $usuario = DB::table('users')
        ->where('id', $id)
        ->first();

    $des_acad = 'des.academico@vbravo.tecnm.mx';

    if ($usuario && $usuario->email === $des_acad) {
        return view('examen_egel.admin.dashboard');
    }

    abort(403);
}

}