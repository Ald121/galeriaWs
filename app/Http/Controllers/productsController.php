<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use DB;
use File;

class productsController extends Controller
{
    public function productsList(Request $request) {
    
    $products = DB::table('productos')->where('status','A')->get();

    foreach ($products as $key => $prod) {
    	$prod->images = DB::table('productos_imagenes')->where('status','A')->where('idproductos',$prod->idproductos)->get();
    }
    
    return response()->json(["respuesta" => true, 'list' => $products]);
                   	
    }

    public function addProduct(Request $request) {
        $prod = [
          'nombre' => $request->nombre,
          'description' => $request->description,
          'precio' => $request->precio,
          'status' => 'A'
          ];
        $id = DB::table('productos')->insertGetId($prod);
        $prod['id'] = $id;
        return response()->json(["respuesta" => true,"row" => $prod]);         	
    }

    public function addImgProduct(Request $request) {
        if($request->hasFile('file'))
            {
                $image = $request->file('file');
                $filename  = time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('products/' . $filename);
                Image::make($image->getRealPath())->save($path);
                $save = DB::table('productos_imagenes')->insert(
                [
                 'url' => $filename,
                 'idproductos' => $request->idProd,
                 'default' => $request->default,
                 'status'=>'A'
                ]);
           }
        return response()->json(["respuesta" => true]);          
    }
    
    public function deleteProd(Request $request) {
       
       foreach ($request->item['images'] as $value) {
        $exists = File::exists(public_path().'/products/' . $value['url']);
          if ($exists) {
             File::Delete(public_path().'/products/' . $value['url']);
        }
        DB::table('productos_imagenes')->where('idproductos_imagenes',$value['idproductos_imagenes'])->update(['status' => 'I' ]);
       }
        $delete = DB::table('productos')->where('idproductos',$request->item['idproductos'])->update(['status' => 'I' ]);
        if ($delete == 1) {
            return response()->json(["respuesta" => true]);
        }else{
            return response()->json(["respuesta" => false]);
        }            
    }

    public function prodDetails(Request $request) {
    
    $product = DB::table('productos')->where('status','A')->where('idproductos',$request->id)->first();
    $product->images = DB::table('productos_imagenes')->where('status','A')->where('idproductos',$request->id)->get();
    return response()->json(["respuesta" => true,"prod" => $product]);
  }
}
