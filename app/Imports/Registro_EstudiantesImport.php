<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\User;
class Registro_EstudiantesImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $dat=array();
        foreach($collection as $dato){
            $tipo = gettype($dato['no_cuenta']);
            if($tipo == "double"){
                $da['no_cuenta'] =intval($dato['no_cuenta']);
            }else{
                $da['no_cuenta'] =$dato['no_cuenta'];
            }
            $da['nombre'] =$dato['nombre'];
            $da['grupo'] =$dato['grupo'];
            $usuario = $dato['usuario'];
            $estado = DB::selectOne("SELECT COUNT(id) AS contar FROM users WHERE email = '$usuario'");

            $estado=$estado->contar;
            if($estado == 0){
                $estado =0;
                $da['estado'] =0;
            }else{
                $estado=1;
                $da['estado'] =1;
            }
            $da['usuario'] =$dato['usuario'];
            $da['contrasena'] =$dato['contrasena'];

            array_push($dat,$da);

        }
        foreach ($dat as $dat){
            if($dat['estado'] == 0){
                User::create([
                    //'name' => $data['name'],
                    'email' => $dat['usuario'],
                    'password' => bcrypt($dat['contrasena']),
                    'tipo_usuario' => 1
                ]);
            }

        }

    }
}
