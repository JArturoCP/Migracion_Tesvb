<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;
use App\Imports\Registro_EstudiantesImport;
class Compu_reg_usuarioController extends Controller
{
    public function index(){
    return view('centro_computo.registrar_usuarios.registrar_usuario');
    }
    public function registro_datos_estudiante_excel(Request $request){

        $file = $request->file('excel_registro');

        Excel::import(new Registro_EstudiantesImport, $file);

        return redirect('/centro_computo/notificacion_datos_reg/');

    }
    public function notificacion_datos_reg(){
        return view('centro_computo.registrar_usuarios.notificacion_usuarios_reg');
    }
    public function  configuracion_datos(){
        // Verificar el tamaño máximo de archivo permitido
        $maxFileSize = ini_get('upload_max_filesize');
    //   echo 'El tamaño máximo de archivo permitido es: ' . $maxFileSize;

// Verificar el tamaño máximo de POST permitido
        $maxPostSize = ini_get('post_max_size');
   //     echo 'El tamaño máximo de POST permitido es: ' . $maxPostSize;
        return response('Tamaño máximo de archivo: ' . $maxFileSize . ' | Tamaño máximo de POST: ' . $maxPostSize);

    }
}
