<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use DB;
use File;

class productsController extends Controller
{
    
    public function sliderList(Request $request) {
      $products = DB::table('productos')->where('status','A')->where('inSlider',1)->get();
      foreach ($products as $key => $prod) {
        $prod->images = DB::table('productos_imagenes')->where('status','A')->where('idproductos',$prod->idproductos)->get();
      }
      foreach ($products as $key => $prod) {
        // Colores
        $prod_colores = DB::table('productos_colores')->where('status','A')->where('idproductos',$prod->idproductos)->get();
        $colores = [];
        foreach ($prod_colores as $key => $prod_color) {
          $colores[$key] = DB::table('colores')->where('status','A')->where('idcolores',$prod_color->idcolores)->first();
        }
        $prod->colores = $colores;
        // Tallas
        $prod_tallas = DB::table('tallas_prods')->where('status','A')->where('idproductos',$prod->idproductos)->get();
        $tallas = [];
        foreach ($prod_tallas as $key => $prod_color) {
          $tallas[$key] = DB::table('tallas')->where('status','A')->where('idtallas',$prod_color->idtallas)->first();
        }
        $prod->tallas = $tallas;
      }
      
      return response()->json(["respuesta" => true, 'list' => $products]);            
    }

    public function sliderProdDestacados(Request $request) {
      $products = DB::table('productos')->where('status','A')->where('destacar',1)->get();
      foreach ($products as $key => $prod) {
        $prod->images = DB::table('productos_imagenes')->where('status','A')->where('idproductos',$prod->idproductos)->get();
      }
      foreach ($products as $key => $prod) {
        // Colores
        $prod_colores = DB::table('productos_colores')->where('status','A')->where('idproductos',$prod->idproductos)->get();
        $colores = [];
        foreach ($prod_colores as $key => $prod_color) {
          $colores[$key] = DB::table('colores')->where('status','A')->where('idcolores',$prod_color->idcolores)->first();
        }
        $prod->colores = $colores;
        // Tallas
        $prod_tallas = DB::table('tallas_prods')->where('status','A')->where('idproductos',$prod->idproductos)->get();
        $tallas = [];
        foreach ($prod_tallas as $key => $prod_color) {
          $tallas[$key] = DB::table('tallas')->where('status','A')->where('idtallas',$prod_color->idtallas)->first();
        }
        $prod->tallas = $tallas;
      }
      
      return response()->json(["respuesta" => true, 'list' => $products]);              
    }

    public function productsList(Request $request) {
    
    $products = DB::table('productos')->where('status','A')->orderBy('idproductos','DESC')->get();

    foreach ($products as $key => $prod) {
    	$prod->images = DB::table('productos_imagenes')->where('status','A')->where('idproductos',$prod->idproductos)->get();
    }
    foreach ($products as $key => $prod) {
        // Colores
        $prod_colores = DB::table('productos_colores')->where('status','A')->where('idproductos',$prod->idproductos)->get();
        $colores = [];
        foreach ($prod_colores as $key => $prod_color) {
          $colores[$key] = DB::table('colores')->where('status','A')->where('idcolores',$prod_color->idcolores)->first();
        }
        $prod->colores = $colores;
        // Tallas
        $prod_tallas = DB::table('tallas_prods')->where('status','A')->where('idproductos',$prod->idproductos)->get();
        $tallas = [];
        foreach ($prod_tallas as $key => $prod_color) {
          $tallas[$key] = DB::table('tallas')->where('status','A')->where('idtallas',$prod_color->idtallas)->first();
        }
        $prod->tallas = $tallas;
      }
    
    return response()->json(["respuesta" => true, 'list' => $products]);
                   	
    }

    public function addProduct(Request $request) {
        $prod = [
          'nombre' => $request->nombre,
          'description' => $request->description,
          'precio' => $request->precio,
          'status' => 'A',
          'inSlider' => $request->inSlider,
          'destacar' => $request->destacar,
          'stock' => $request->stock,
          'categoria' =>  $request->categoria
          ];
        $id = DB::table('productos')->insertGetId($prod);
        $prod['id'] = $id;
        foreach ($request->colores as $value) {
          $id = DB::table('productos_colores')->insert(
            [
              'idproductos' => $prod['id'],
              'idcolores' => $value,
              'status' => 'A'
            ]);
        }

        foreach ($request->tallas as $value) {
          $id = DB::table('tallas_prods')->insert(
            [
              'idproductos' => $prod['id'],
              'idtallas' => $value,
              'status' => 'A'
            ]);
        }
        return response()->json(["respuesta" => true,"row" => $prod]);          
    }

    public function updateProduct(Request $request) {
        $prod = [
          'nombre' => $request->nombre,
          'description' => $request->description,
          'precio' => $request->precio,
          'inSlider' => $request->inSlider,
          'destacar' => $request->destacar,
          'stock' => $request->stock,
          'categoria' =>  $request->categoria
          ];
        $id = DB::table('productos')->where('idproductos',$request->idproductos)->update($prod);
        $prod['id'] = $id;
        foreach ($request->colores as $value) {
          $existColor = DB::table('productos_colores')
          ->where('idcolores',$value)
          ->where('idproductos',$request->idproductos)->get();
          if (count($existColor) == 0) {
            DB::table('productos_colores')->insert(
            [
              'idproductos' => $request->idproductos,
              'idcolores' => $value,
              'status' => 'A'
            ]);
          }
        }

        foreach ($request->tallas as $value) {
          $existTalla = DB::table('tallas_prods')
          ->where('idtallas',$value)
          ->where('idproductos',$request->idproductos)->get();
          if (count($existTalla) == 0) {
            DB::table('tallas_prods')->insert(
              [
                'idproductos' => $request->idproductos,
                'idtallas' => $value,
                'status' => 'A'
              ]);
          }
        }
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
