<?php

namespace App\Http\Controllers;

use App\RegistroAlumnos;
use Illuminate\Http\Request;

class Consulta_modificar_ActividadController extends Controller
{
    public function eliminar_registro(Request $request, $id_registro_alumno){
        $id=$id_registro_alumno;
        RegistroAlumnos::destroy($id);
        return redirect('/consulta_actividades');

    }
}
