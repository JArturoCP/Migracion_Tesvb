<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PMMaterial_Prestamos;
use App\PMCodigosMaterial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PMMaterial_PrestamosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materiales=PMMaterial_Prestamos::all();
        $codigos = PMCodigosMaterial::all();
        return view('prestamo.Jefe_prestamos_materiales.materiales_index', compact('materiales', 'codigos'));
    }

    // Nueva función para otra vista
    public function materialDocente()
    {

        // Obtener los IDs de materiales aprobados pero no devueltos
        $materialesPrestadosIds = DB::table('pmsolicitud_material')
            ->where('estatus', 'Aprobado')
            ->whereNull('fecha_entrega') // Materiales que aún no han sido entregados
            ->pluck('id_material')
            ->toArray();

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
        $docente = DB::table('gnral_personales')
            ->where('tipo_usuario', \auth()->id())
            ->select('id_personal')
            ->first();
        //dd($docente);
        $historial = DB::table('pmsolicitud_material as pmsm')
            ->join('pmprestamos_materiales as pmpm', 'pmsm.id_material', '=', 'pmpm.id_material')
            ->where('pmsm.id_docente', $docente->id_personal)
            ->whereNull('pmsm.deleted_at')
            ->select('pmsm.*', 'pmpm.*')
            ->get();
        $materialess=PMMaterial_Prestamos::all();
        //dd($materiales);

        // Aquí puedes agregar lógica y pasar datos específicos a la vista
        return view('prestamo.Alumnos_Prestamos_material.docente_index', compact('materiales_prestamos', 'historial', 'materialess'));
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

        // Validación de los datos del formulario
        $request->validate([
            'descripcion' => 'required|string|max:250',
            'cantidad' => 'required|integer',
        ]);

        // Crear una nueva instancia del modelo PMMaterial_Prestamos
        $material = new PMMaterial_Prestamos();
        $material->descripcion = $request->descripcion;
        $material->cantidad = $request->cantidad;

        // Guardar el material en la base de datos
        $material->save();

        // Redireccionar o retornar una respuesta JSON, dependiendo de tus necesidades
        return redirect()->back()->with('success', 'Material registrado exitosamente');

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
    public function update(Request $request)
    {
        $material = PMMaterial_Prestamos::find($request->input('edit-material-id'));
        $material->descripcion = $request->input('edit-descripcion');
        $material->cantidad = $request->input('edit-cantidad');
        $material->save();
        return redirect()->back()->with('success', 'Material actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $material = PMMaterial_Prestamos::findOrFail($id);
        $material->delete();
        return redirect()->back()->with('success', 'Material eliminado exitosamente');

    }

    public function getExistencia(Request $request)
    {
        /*$contador = 0;

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'codigo') === 0) {
                $contador++;
            }
        }
        for ($i=0; $i<$contador; $i++)
        {
            $codigo = $request->input('codigo' . $i);
            PMCodigosMaterial::create([
                'id_material' => $request->id_material,
                'codigo' =>$codigo,
            ]);
        }
        return redirect()->back()->with('success', 'Códigos registrados exitosamente.');*/
        $id_material = $request->input('id_material');
        $codigosRegistrados = PMCodigosMaterial::where('id_material', $id_material)->count();
        $faltante = $request->input('cantidad') - $codigosRegistrados;

        for ($i = 0; $i < $faltante; $i++) {
            PMCodigosMaterial::create([
                'id_material' => $id_material,
                'codigo' => $request->input('codigo' . ($codigosRegistrados + $i)),
            ]);
        }

        return redirect()->back()->with('success', 'Códigos registrados exitosamente.');
    }


}
