<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Examen_GnralC_PeriodoController extends Controller
{
    public function index()
    {
        $examen_gnral_periodo = DB::table('egel_periodo_examen')
            ->orderBy('id_periodo_examen', 'desc')
            ->get();

        $examen_periodo_resultados = DB::table('egel_periodo_resultados_examen')
            ->orderBy('id_periodo_resultado_examen', 'desc')
            ->get();

        return view('examen_gnral_con.admin.periodos.index', compact('examen_gnral_periodo', 'examen_periodo_resultados'));
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'periodo' => 'required|string|max:500',
            'periodo_examen_inicio' => 'required|date',
            'periodo_examen_fin' => 'required|date|after_or_equal:periodo_examen_inicio',
            'periodo_resultado_inicio' => 'required|date|after_or_equal:periodo_examen_fin',
            'periodo_resultado_fin' => 'required|date|after_or_equal:periodo_resultado_inicio',
        ]);

        $id_periodo_examen = DB::table('egel_periodo_examen')->insertGetId([
            'periodo' => $request->periodo,
            'fecha_inicio' => $request->periodo_examen_inicio,
            'fecha_fin' => $request->periodo_examen_fin,
            'estado' => 1
        ]);

        DB::table('egel_periodo_resultados_examen')->insert([
            'periodo' => $request->periodo,
            'fecha_inicio' => $request->periodo_resultado_inicio,
            'fecha_fin' => $request->periodo_resultado_fin,
            'id_periodo_examen' => $id_periodo_examen,
            'estado' => 1
        ]);

        return back()->with('success', 'Periodos guardados correctamente');
    }

    // -------------------
    // ✏️ Editar Periodo
    // -------------------
    public function edit($id_periodo_examen)
    {
        //dd($id_periodo_examen);

        $examen_gnral_periodo = DB::table('egel_periodo_examen')
            ->where('id_periodo_examen', $id_periodo_examen)
            ->first();

            //dd($examen_gnral_periodo);

        $examen_periodo_resultados = DB::table('egel_periodo_resultados_examen')
            ->where('id_periodo_examen', $id_periodo_examen)
            ->first();

            //dd($examen_periodo_resultados,$examen_gnral_periodo);

        if(!$examen_gnral_periodo){
            return redirect()->route('admin.examen_general.periodos.index')->with('error', 'Periodo no encontrado');
        }

        return view('examen_gnral_con.admin.periodos.edit', compact('examen_gnral_periodo', 'examen_periodo_resultados'));
    }

    // -------------------
    // 🔄 Actualizar Periodo
    // -------------------
    public function update(Request $request, $id_periodo_examen)
    {
         //dd('Entró al update', $request->all(), $id_periodo_examen);

        $request->validate([
            'periodo' => 'required|string|max:500',
            'periodo_examen_inicio' => 'required|date',
            'periodo_examen_fin' => 'required|date|after_or_equal:periodo_examen_inicio',
            'periodo_resultado_inicio' => 'required|date|after_or_equal:periodo_examen_fin',
            'periodo_resultado_fin' => 'required|date|after_or_equal:periodo_resultado_inicio',
        ]);

        DB::table('egel_periodo_examen')
            ->where('id_periodo_examen', $id_periodo_examen)
            ->update([
                'periodo' => $request->periodo,
                'fecha_inicio' => $request->periodo_examen_inicio,
                'fecha_fin' => $request->periodo_examen_fin,
            ]);

        DB::table('egel_periodo_resultados_examen')
            ->where('id_periodo_examen', $id_periodo_examen)
            ->update([
                'periodo' => $request->periodo,
                'fecha_inicio' => $request->periodo_resultado_inicio,
                'fecha_fin' => $request->periodo_resultado_fin,
            ]);


        return redirect()->route('admin.examen_general.periodos.index')->with('success', 'Periodo actualizado correctamente');
    }

    // -------------------
    // 🗑️ Eliminar Periodo
    // -------------------
    public function destroy($id_periodo_examen)
    {
        DB::table('egel_periodo_resultados_examen')->where('id_periodo_examen', $id_periodo_examen)->delete();
        DB::table('egel_periodo_examen')->where('id_periodo_examen', $id_periodo_examen)->delete();

        return redirect()->route('admin.examen_general.periodos.index')->with('success', 'Periodo eliminado correctamente');
    }

    // -------------------
    // Validaciones de periodos
    // -------------------
    public static function enAplicacion()
    {
        $hoy = now()->toDateString();

        return DB::table('egel_periodo_examen')
            ->where('estado', 1)
            ->whereDate('fecha_inicio', '<=', $hoy)
            ->whereDate('fecha_fin', '>=', $hoy)
            ->exists();
    }

    public static function enPublicacion()
    {
        $hoy = now()->toDateString();

        return DB::table('egel_periodo_resultados_examen')
            ->where('estado', 1)
            ->whereDate('fecha_inicio', '<=', $hoy)
            ->whereDate('fecha_fin', '>=', $hoy)
            ->exists();
    }
}