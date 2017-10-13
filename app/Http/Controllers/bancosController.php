<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class bancosController extends Controller
{
   public function bancosList(Request $request) {
      $bancos = DB::table('bancos')->where('status','A')->get();
      return response()->json(["respuesta" => true, 'list' => $bancos]);            
    }

    public function addBanco(Request $request) {
        $banco = [
          'nombre' => $request->nombre,
          'nro_cuenta' => $request->nro_cuenta,
          'tipo_cuenta' => $request->tipo_cuenta,
          'status' => 'A'
          ];
        $id = DB::table('bancos')->insertGetId($banco);
        $banco['id'] = $id;
        return response()->json(["respuesta" => true,"row" => $banco]);         	
    }

    public function updateBanco(Request $request) {
        $banco = [
          'nombre' => $request->nombre,
          'nro_cuenta' => $request->nro_cuenta,
          'tipo_cuenta' => $request->tipo_cuenta
          ];
        $id = DB::table('bancos')->where('idbancos',$request->idbancos)->update($banco);
        $banco['id'] = $id;
        return response()->json(["respuesta" => true,"row" => $banco]);         	
    }
    
    public function deleteBanco(Request $request) {
        $delete = DB::table('bancos')->where('idbancos',$request->id)->update(['status' => 'I' ]);
        if ($delete == 1) {
            return response()->json(["respuesta" => true]);
        }else{
            return response()->json(["respuesta" => false]);
        }            
    }

}
