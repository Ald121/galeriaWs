<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class colorController extends Controller
{
    public function colorList(Request $request) {
      $colors = DB::table('colores')->where('status','A')->get();
      return response()->json(["respuesta" => true, 'list' => $colors]);            
    }

    public function addColor(Request $request) {
        $color = [
          'nombre' => $request->nombre,
          'value' => $request->value,
          'status' => 'A'
          ];
        $id = DB::table('colores')->insertGetId($color);
        $color['id'] = $id;
        return response()->json(["respuesta" => true,"row" => $color]);         	
    }
    
    public function deleteColor(Request $request) {
        $delete = DB::table('colores')->where('idcolores',$request->id)->update(['status' => 'I' ]);
        if ($delete == 1) {
            return response()->json(["respuesta" => true]);
        }else{
            return response()->json(["respuesta" => false]);
        }            
    }

}
