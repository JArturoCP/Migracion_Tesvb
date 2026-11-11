<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRespuestaController extends Controller
{
    public function editRespuesta($id)
{
    $respuesta = DB::table('egel_respuestas')->where('id', $id)->first();

    return view('examen_egel.admin.examenes.edit_respuesta', compact('respuesta'));
}

public function updateRespuesta(Request $request, $id)
{
    DB::table('egel_respuestas')
        ->where('id', $id)
        ->update([
            'respuesta' => $request->respuesta,
            'es_correcta' => $request->es_correcta
        ]);

    return back()->with('success', 'Respuesta actualizada correctamente');
}

public function deleteRespuesta($id)
{
    DB::table('egel_respuestas')->where('id', $id)->delete();
    return back()->with('success', 'Respuesta eliminada');
}

}