<?php

namespace App\Http\Controllers;

use App\PMCodigosMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PMCodigosMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


        $contador = 0;

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'codigo') === 0) {
                $contador++;
            }
        }

        $errores = [];

        for ($i = 0; $i < $contador; $i++) {
            $codigo = $request->input('codigo' . $i);

            // Comprobar si el código ya existe en la base de datos
            $codigoExistente = PMCodigosMaterial::where('codigo', $codigo)->first();

            if (!$codigoExistente) {
                // Crear el registro si el código no existe
                PMCodigosMaterial::create([
                    'id_material' => $request->id_material,
                    'codigo' => $codigo,
                ]);
            } else {
                // Almacenar los códigos duplicados para mostrar en el mensaje de error
                $errores[] = $codigo;
            }
        }

// Redirigir con un mensaje de éxito o de error dependiendo del resultado
        if (empty($errores)) {
            return redirect()->back()->with('success', 'Códigos registrados exitosamente.');
        } else {
            return redirect()->back()->with('error', 'Los siguientes códigos ya existen: ' . implode(', ', $errores));
        }

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
        //dd($request);
        $soli = PMCodigosMaterial::findOrFail($id);

        if ($soli){
            $soli->update([
                'codigo' => $request->descripcion,
            ]);
            return redirect()->back();
        }else{
            return redirect()->back();
        }

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
        //dd($id);
        $registro = PMCodigosMaterial::where('id_codigo', $id)->first();
        //dd($registro);

        $count = DB::table('pmsolicitud_material as pms')
            ->where('pms.codigo', $registro->codigo)
            ->whereNull('pms.deleted_at')
            ->where('pms.estatus', 'Aprobado')
            ->count();
        //dd($count);


        if ($registro) {
            // Elimina el registro si se encuentra
            if ($count == 0){
                $registro->delete();
                session()->flash('message', 'Registro eliminado exitosamente.');
                return redirect()->back();
            } else{
                session()->flash('message', 'No se pudo borrar el registro, actualmente esta en uso.');
                return redirect()->back();
            }
        } else {
            // Maneja el caso donde no se encuentra el registro
            session()->flash('message', 'No se pudo borrar el registro.');
            return redirect()->back();
        }
    }
}
