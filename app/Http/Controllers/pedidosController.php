<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use DB;
use File;
use App\libs\funciones;

class pedidosController extends Controller
{
    public function __construct(Request $request){
        // Funciones
        $this->funciones = new Funciones();
    }

    public function pedidosList(Request $request) {
      $currentPage = $request->pagina_actual;
      $limit = $request->limit;
      $pedidos = DB::table('pedidos')
                  ->where('status','A')
                  ->orderBy('createat','DESC')->paginate(10);
      // foreach ($pedidos as $key => $prod) {
      // 	$prod->images = DB::table('pedidos_prods')->where('status','A')->where('idproductos',$prod->idproductos)->get();
      // }
      // foreach ($pedidos as $key => $prod) {
      //     $prod_colores = DB::table('productos_colores')->where('status','A')->where('idproductos',$prod->idproductos)->get();
      //     $colores = [];
      //     foreach ($prod_colores as $key => $prod_color) {
      //       $colores[$key] = DB::table('colores')->where('status','A')->where('idcolores',$prod_color->idcolores)->first();
      //     }
      //     $prod->colores = $colores;
      //   }
      // $data = $this->funciones->paginarDatos($pedidos,$currentPage,$limit);
      // $data = $this->funciones->paginarDatos($pedidos,$currentPage,$limit);
      return response()->json(["respuesta" => true, 'list' => $pedidos]);           	
    }

    public function addPedido(Request $request) {
        $items = $request->items;
        $prod = [
          'codigo'=>$this->funciones->generarPass(8,false,'ud'),
          'total'=>$request->total,
          'estado'=>'P',
          'status'=>'A',
          'idusuarios'=>$request->user
         ];
        $id = DB::table('pedidos')->insertGetId($prod);
        foreach ($items as $value) {
          DB::table('pedidos_prods')->insert(
            [
              'idpedido'=> $id,
              'idproductos'=> $value['idproductos'],
              'cantidad'=> $value['cantidadInCar'],
              'total_prod'=> $value['totalCu'],
              'status'=>'A'
           ]);
          $prodUpdate = DB::table('productos')->select('stock')->where('idproductos',$value['idproductos'])->first();
          $resta = $prodUpdate->stock - $value['cantidadInCar'];
          DB::table('productos')->where('idproductos',$value['idproductos'])->update(
            [
              'stock' => $resta
           ]);
        }
        return response()->json(["respuesta" => true]);     	
    }

    public function addImgProduct(Request $request) {
        if($request->hasFile('file'))
            {
                $image = $request->file('file');
                $filename  = time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('pedidos/' . $filename);
                Image::make($image->getRealPath())->save($path);
                $save = DB::table('pedidos_prods')->insert(
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
        $exists = File::exists(public_path().'/pedidos/' . $value['url']);
          if ($exists) {
             File::Delete(public_path().'/pedidos/' . $value['url']);
        }
        DB::table('pedidos_prods')->where('idpedidos_prods',$value['idpedidos_prods'])->update(['status' => 'I' ]);
       }
        $delete = DB::table('pedidos')->where('idproductos',$request->item['idproductos'])->update(['status' => 'I' ]);
        if ($delete == 1) {
            return response()->json(["respuesta" => true]);
        }else{
            return response()->json(["respuesta" => false]);
        }            
    }

    public function prodDetails(Request $request) {
    
    $product = DB::table('pedidos')->where('status','A')->where('idproductos',$request->id)->first();
    $product->images = DB::table('pedidos_prods')->where('status','A')->where('idproductos',$request->id)->get();
    return response()->json(["respuesta" => true,"prod" => $product]);
  }
}
