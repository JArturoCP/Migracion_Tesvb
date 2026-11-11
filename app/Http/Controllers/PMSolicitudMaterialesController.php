<?php

namespace App\Http\Controllers;

use App\PMMaterial_Prestamos;
use App\PMSolicitudMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Alumnos;
use App\Gnral_Personales;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class PMSolicitudMaterialesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudes = DB::table('pmsolicitud_material as sm')
            ->join('pmprestamos_materiales as pm', 'sm.id_material', '=', 'pm.id_material')
            ->join('gnral_alumnos as ga', 'sm.id_estudiante', '=', 'ga.id_alumno')
            ->join("gnral_semestres as gs", "ga.id_semestre", "=", "gs.id_semestre")
            ->select('sm.id_solicitud', 'sm.estatus', 'pm.descripcion', 'sm.codigo', 'ga.nombre', 'ga.apaterno', 'ga.amaterno', 'gs.descripcion as desc')
            ->where('sm.estatus', '=', 'pendiente')
            ->whereNull('sm.deleted_at')
            ->get();

        $solicitudesA = DB::table('pmsolicitud_material as sm')
            ->join('pmprestamos_materiales as pm', 'sm.id_material', '=', 'pm.id_material')
            ->join('gnral_alumnos as ga', 'sm.id_estudiante', '=', 'ga.id_alumno')
            ->join('gnral_semestres as gs', 'ga.id_semestre', '=', 'gs.id_semestre')
            ->leftJoin('adeudo_departamento as ad', function ($join) {
                $join->on('sm.id_solicitud', '=', 'ad.id_solicitud')
                    ->whereNull('ad.deleted_at');
            })
            ->select('sm.id_solicitud', 'sm.codigo', 'sm.estatus', 'pm.descripcion', 'ga.nombre', 'ga.apaterno', 'ga.amaterno', 'ga.cuenta', 'gs.descripcion as desc', 'ad.id_adeudo_departamento')
            ->where('sm.estatus', '=', 'Aprobado')
            ->whereNull('sm.deleted_at')
            ->whereNull('sm.fecha_entrega') // Agregar condición para excluir solicitudes con fecha de entrega
            ->get();

        $solicitudesD = DB::table('pmsolicitud_material as sm')
            ->join('pmprestamos_materiales as pm', 'sm.id_material', '=', 'pm.id_material')
            ->join('gnral_personales as gp', 'sm.id_docente', '=', 'gp.id_personal')
            ->select(
                'sm.id_solicitud',
                'sm.estatus',
                'sm.codigo',
                'pm.descripcion',
                'gp.nombre'
            )
            ->where('sm.estatus', '=', 'pendiente')
            ->whereNull('sm.deleted_at')
            ->get();

        $solicitudesD2 = DB::table('pmsolicitud_material as sm')
            ->join('pmprestamos_materiales as pm', 'sm.id_material', '=', 'pm.id_material')
            ->join('gnral_personales as gp', 'sm.id_docente', '=', 'gp.id_personal')
            ->select(
                'sm.id_solicitud',
                'sm.estatus',
                'sm.codigo',
                'pm.descripcion',
                'gp.nombre'
            )
            ->where('sm.estatus', '=', 'Aprobado')
            ->whereNull('sm.deleted_at')

            ->whereNull('sm.fecha_entrega')
            ->get();

        return view('prestamo.Jefe_prestamos_materiales.vista_solicitudes_material', compact('solicitudes', 'solicitudesA', 'solicitudesD', 'solicitudesD2'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    
    public function update(Request $request, $id)
    {
        // Obtener la solicitud
        $solicitud = DB::table('pmsolicitud_material')->where('id_solicitud', $id)->first();

        if (!$solicitud) {
            return redirect()->back()->with('error', 'La solicitud no existe.');
        }

        // Obtener nombre del usuario logueado
        $idUsuario = Auth::id();
        $nombre = null;

        $alternativo = DB::table('gnral_alumnos as ga')
            ->join('users as u', 'u.id', '=', 'ga.id_usuario')
            ->where('u.id', $idUsuario)
            ->select('ga.nombre', 'ga.apaterno', 'ga.amaterno')
            ->first();

        $alternativo2 = DB::table('gnral_personales as gp')
            ->join('users as u', 'u.id', '=', 'gp.tipo_usuario')
            ->where('u.id', $idUsuario)
            ->select('gp.nombre')
            ->first();

        if ($alternativo) {
            $nombre = "{$alternativo->nombre} {$alternativo->apaterno} {$alternativo->amaterno}";
        } elseif ($alternativo2) {
            $nombre = $alternativo2->nombre;
        }

        // VALIDACIÓN CORRECTA DEL CÓDIGO DEL MATERIAL (debe coincidir con el material solicitado)
        $validacionCodigo = DB::table('pmcodigos_material')
            ->where('id_material', $solicitud->id_material)
            ->where('codigo', $request->codigo)
            ->exists();

        // ---------------------------------------
        // APROBAR
        // ---------------------------------------
        if ($request->action === 'aprobar') {

            if (!$validacionCodigo) {
                return redirect()->back()->with('error', 'Código de material incorrecto.');
            }

            DB::table('pmsolicitud_material')
                ->where('id_solicitud', $id)
                ->update([
                    'estatus' => 'Aprobado',
                    'fecha_salida' => now(),
                    'codigo' => $request->codigo,
                    'responsable' => $nombre
                ]);

            // Datos adicionales
            $alumno = DB::table('gnral_alumnos')->where('id_alumno', $solicitud->id_estudiante)->first();
            $material = DB::table('pmprestamos_materiales')->where('id_material', $solicitud->id_material)->first();

            if ($alumno && $material) {
                DB::table('adeudo_departamento')->insert([
                    'id_alumno' => $alumno->id_alumno,
                    'id_periodo' => 28,
                    'id_departamento' => 6,
                    'id_solicitud' => $id,
                    'fecha_registro' => now(),
                    'comentario' => 'Material prestado: ' . $material->descripcion,
                ]);
            }

            return redirect()->route('Jefe_prestamos_materiales.index')
                ->with('success', 'Solicitud aprobada correctamente.');
        }

        // ---------------------------------------
        // RECHAZAR
        // ---------------------------------------
        if ($request->action === 'rechazar') {

            $material = DB::table('pmprestamos_materiales')
                ->where('id_material', $solicitud->id_material)
                ->first();

            if ($material) {
                DB::table('pmprestamos_materiales')
                    ->where('id_material', $material->id_material)
                    ->update(['cantidad' => $material->cantidad + 1]);
            }

            DB::table('pmsolicitud_material')
                ->where('id_solicitud', $id)
                ->update(['estatus' => 'Rechazado']);

            return redirect()->route('Jefe_prestamos_materiales.index')
                ->with('success', 'Solicitud rechazada correctamente.');
        }

        return redirect()->back()->with('error', 'Acción no válida.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateDocente(Request $request, $id)
    {
        //dd('hola desde update para docente', $id);
        //dd($id);
        $solicitud = DB::table('pmsolicitud_material')->where('id_solicitud', $id)->first();
        /*
         * este codigo es para obtener el nombre del usuario que esta logueado dependiendo si es un alumno
         * o si es el jefe, ya que se ocupa para saber quien es el que hace el prestamo del equipo.*/
        $idUsuario = Auth::id();
        $nombre = null;
        $alternativo = DB::table('users as u')
            ->join('gnral_alumnos as ga', 'u.id', '=', 'ga.id_usuario')
            ->where('u. id', '=', $idUsuario)
            ->select('ga.nombre', 'ga.apaterno', 'ga.amaterno')
            ->first();
        $alternativo2 = DB::table('users as u')
            ->join('gnral_personales as gp', 'u.id', '=', 'gp.tipo_usuario')
            ->where('u.id', '=', $idUsuario)
            ->select('gp.nombre')
            ->first();
        //obtener el nombre de la persona que va a liberar el prestamo
        if ($alternativo) {
            $nombre = $alternativo->nombre . ' ' . $alternativo->apaterno . ' ' . $alternativo->amaterno;
        } elseif ($alternativo2) {
            $nombre = $alternativo2->nombre;
        }
        //dd($nombre);

        //para la validacion si existe el codigo------------------------------------------------------------------
        $validacionCodigo = DB::table('pmcodigos_material as cm')
            ->join('pmprestamos_materiales as pm', 'cm.id_material', '=', 'pm.id_material')
            ->where('cm.codigo', $request->codigo)
            ->count();
        //dd($validacionCodigo);
        if ($request->input('action') == 'aprobar') {
            if ($validacionCodigo == 1) {
                $updateResult = DB::table('pmsolicitud_material')
                    ->where('id_solicitud', $id)
                    ->update([
                        'estatus' => 'Aprobado',
                        'fecha_salida' => now(),
                        'codigo' => $request->codigo,
                        'responsable' => $nombre
                    ]);
                return redirect()->route('prestamo.Jefe_prestamos_materiales.index')->with('success', 'Solicitud aprobada y registrada en adeudo departamento.');
            } else {
                return redirect()->route('prestamo.Jefe_prestamos_materiales.index')->with('error', 'Codigo del material no válido.');
            }
        } elseif ($request->input('action') == 'rechazar') {
            //dd('entro al if de rechazar la solicitud');
            $solicitud = DB::table('pmsolicitud_material')
                ->where('id_solicitud', $id)
                ->first();
            //dd($solicitud);
            if ($solicitud) {
                // Obtener el material relacionado
                $material = DB::table('pmprestamos_materiales')
                    ->where('id_material', $solicitud->id_material)
                    ->first();
                //dd($material);

                // Verificar que se encontró el material
                if ($material) {
                    // Incrementar la cantidad disponible del material
                    //dd("verificacion exitosa del material", $material->cantidad);
                    /*DB::table('prestamos_materiales')
                        ->where('id_material', $solicitud->id_material)
                        ->update(['cantidad' => $material->cantidad + 1]);*/
                    try {
                        DB::table('pmprestamos_materiales')
                            ->where('id_material', $solicitud->id_material)
                            ->update(['cantidad' => $material->cantidad + 1]);
                        DB::table('pmsolicitud_material')
                            ->where('id_solicitud', $id)
                            ->update(['estatus' => 'Rechazado']);
                        return redirect()->route('prestamo.Jefe_prestamos_materiales.index');
                    } catch (\Exception $e) {
                        Log::error('Error actualizando registro: ' . $e->getMessage());
                        return back()->with('error', 'Hubo un problema al actualizar los registros.');
                    }
                }

                // Actualizar el estado de la solicitud a "Rechazado"

            }
            //return redirect()->route('Jefe_prestamos_materiales.index')->with('success', 'Acción no válidda.');
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
        $registro = PMSolicitudMaterial::where('id_solicitud', $id)->first();

        if ($registro) {
            // Elimina el registro si se encuentra
            $registro->delete();
            return redirect()->back();
        } else {
            // Maneja el caso donde no se encuentra el registro
            return redirect()->back();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminarDocente($id){

        $solicitud = PMSolicitudMaterial::where('id_solicitud', $id)->first();
        //dd($solicitud);
        if ($solicitud) {
            // Elimina el registro si se encuentra
            $solicitud->delete();
            return redirect()->back();
        } else {
            // Maneja el caso donde no se encuentra el registro
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function editarDocente(Request $request, $id){

        $validatedData = $request->validate([
            'material' => 'required|exists:pmprestamos_materiales,id_material', // Asegúrate de que el material exista
            'solicitud_id' => 'required|exists:pmsolicitud_material,id_solicitud', // Valida que la solicitud exista
        ]);

        $solicitud = PMSolicitudMaterial::where('id_solicitud', $id)->first();
        $materialNuevo = PMMaterial_Prestamos::where('id_material', $request->material)->first();
        $materialAntiguo = PMMaterial_Prestamos::where('id_material', $request->material_anterior_id)->first();

        //dd($materialAntiguo);
        if($solicitud && $materialNuevo && $materialAntiguo){
            if ($materialNuevo->cantidad > 0){
                $solicitud -> update([
                    'id_material' => $request->material,
                ]);
                $materialAntiguo -> update([
                    'cantidad' => $materialAntiguo->cantidad + 1,
                ]);
                $materialNuevo -> update([
                    'cantidad' => $materialNuevo->cantidad - 1,
                ]);
                return redirect()->back();
            }else{
                return redirect()->back()->with('error', 'Error al actualizar la solicitud');
            }

        }else{
            return redirect()->back()->with('error', 'Error al actualizar la solicitud');
        }
        //dd($solicitud);
    }
}
