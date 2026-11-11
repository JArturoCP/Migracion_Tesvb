<?php

namespace App\Http\Controllers;

use App\PMMaterial_Prestamos;
use App\PMSolicitudMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;




class PMPrestamosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumno = Session::get('nombre');
        $id_user = Auth::id();

        $alumnoData = DB::table('gnral_alumnos')->where('id_usuario', $id_user)->first();
        $id_alumno = $alumnoData->id_alumno;

        // Obtener los IDs de materiales aprobados pero no devueltos
        $materialesPrestadosIds = DB::table('pmsolicitud_material')
            ->where('estatus', 'Aprobado')
            ->whereNull('fecha_entrega') // Materiales que aún no han sido entregados
            ->pluck('id_material')
            ->toArray();

        // Obtener todos los materiales, incluyendo aquellos que han sido prestados pero no devueltos
        $materiales_prestamos = DB::table('pmprestamos_materiales')
            ->whereNull('deleted_at')
            ->get()
            ->map(function ($material) use ($materialesPrestadosIds) {
                // Verificar si el material está en la lista de materiales prestados
                if (in_array($material->id_material, $materialesPrestadosIds)) {
                    // Si está en la lista, calcular la cantidad disponible
                    $cantidadDisponible = $material->cantidad - 1;
                } else {
                    // Si no está en la lista, la cantidad disponible es la misma que en la base de datos
                    $cantidadDisponible = $material->cantidad;
                }

                // Añadir la cantidad disponible al objeto material
                $material->cantidad_disponible = $cantidadDisponible;

                return $material;
            });

        $alum = DB::table('gnral_alumnos')
            ->where('id_usuario', \auth()->id())
            ->select('id_alumno')
            ->first();
        $historial = DB::table('pmsolicitud_material as pmsm')
            ->join('pmprestamos_materiales as pmpm', 'pmsm.id_material', '=', 'pmpm.id_material')
            ->where('pmsm.id_estudiante', $alum->id_alumno)
            ->whereNull('pmsm.deleted_at')
            ->select('pmsm.*', 'pmpm.*')
            ->get();
        $materialess=PMMaterial_Prestamos::all();

        // Redirigir a la vista con los datos necesarios y el mensaje de éxito
        return view('prestamo.Alumnos_Prestamos_material.index', compact('alumno', 'materiales_prestamos', 'id_user', 'historial', 'materialess'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $idUsuario = Auth::id();
        $alumno = DB::table('gnral_alumnos')->where('id_usuario', $idUsuario)->first();

        $request->validate([
            'id_material' => 'required|integer',
        ]);

        $material = DB::table('pmprestamos_materiales')->where('id_material', $request->id_material)->first();

        if (!$material || $material->cantidad < 1) {
            return redirect()->back()->with('error', 'No hay suficientes unidades disponibles para este material.');
        }

        // Decrementar la cantidad disponible
        DB::table('pmprestamos_materiales')
            ->where('id_material', $request->id_material)
            ->update(['cantidad' => $material->cantidad - 1]);

        // Crear la solicitud
        PMSolicitudMaterial::create([
            'id_material' => $request->id_material,
            'codigo' => null,
            'id_estudiante' => $alumno->id_alumno,
            'id_jefatura' => 2,
            'estatus' => 'pendiente',
        ]);


        //return view('Alumnos_Prestamos_material.index', compact('alumno', 'materiales_prestamos', 'id_user'));
        return redirect()->back();

        //return view('Alumnos_Prestamos_material.index', compact('alumno', 'materiales_prestamos', 'id_user'))
        //->with('success', 'Solicitud de préstamo realizada con éxito.');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store2(Request $request){
        $id_user = Auth::id();
        $idDoc = DB::table('gnral_personales')->where('tipo_usuario', $id_user)->first();
        $id=$idDoc->id_personal;
        //dd($id);
        $request->validate([
            'id_material' => 'required|integer',
        ]);

        $material = DB::table('pmprestamos_materiales')->where('id_material', $request->id_material)->first();
        if (!$material || $material->cantidad < 1) {
            return redirect()->back()->with('error', 'No hay suficientes unidades disponibles para este material.');
        }

        // Decrementar la cantidad disponible
        DB::table('pmprestamos_materiales')
            ->where('id_material', $request->id_material)
            ->update(['cantidad' => $material->cantidad - 1]);

        // Crear la solicitud
        PMSolicitudMaterial::create([
            'id_material' => $request->id_material,
            'codigo' => null,
            'id_docente' => $id,
            'id_jefatura' => 2,
            'estatus' => 'pendiente',
        ]);

        return redirect()->back();

    }



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
}
