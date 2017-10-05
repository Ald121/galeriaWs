<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class tallasController extends Controller
{
    public function addTalla(Request $request) {
        $talla = [
          'nombre' => $request->nombre,
          'rango' => $request->rango,
          'status' => 'A'
         ];
        $id = DB::table('tallas')->insertGetId($talla);
        $talla['id'] = $id;

        return response()->json(["respuesta" => true,"row" => $talla]);         	
    }

    public function tallasList(Request $request) {
        $tallas = DB::table('tallas')->get();
        return response()->json(["respuesta" => true,"list" => $tallas]);           
    }
}
