<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class categoriasController extends Controller
{
    public function categoriasList(Request $request) {
      $categorias = DB::table('categorias')->where('status','A')->get();
      return response()->json(["respuesta" => true, 'list' => $categorias]);            
    }

    public function addCategoria(Request $request) {
        $categoria = [
          'nombre' => $request->nombre,
          'key' => $request->key,
          'descripcion' => $request->descripcion,
          'status' => 'A'
          ];
        $id = DB::table('categorias')->insertGetId($categoria);
        $categoria['id'] = $id;
        return response()->json(["respuesta" => true,"row" => $categoria]);         	
    }

    public function updateCategoria(Request $request) {
        $categoria = [
          'nombre' => $request->nombre,
          'key' => $request->key,
          'descripcion' => $request->descripcion
          ];
        $id = DB::table('categorias')->where('idcategorias',$request->id)->update($categoria);
        $categoria['id'] = $id;
        return response()->json(["respuesta" => true,"row" => $categoria]);         	
    }
    
    public function deleteCategoria(Request $request) {
        $delete = DB::table('categorias')->where('idcategorias',$request->id)->update(['status' => 'I' ]);
        if ($delete == 1) {
            return response()->json(["respuesta" => true]);
        }else{
            return response()->json(["respuesta" => false]);
        }            
    }
}
