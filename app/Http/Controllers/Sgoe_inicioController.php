<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Sgoe_inicioController extends Controller
{
    public function index(){


       return view('sgoe.inicio');
    }
    public function documentacion(){

        $pro_ver=DB::select('SELECT * FROM `ri_proceso` ORDER BY `ri_proceso`.`clave` DESC;');
        return view('sgoe.ejemplo',compact('pro_ver'));

       }


}
