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
                  ->orderBy('createat','DESC')->paginate(5);

      foreach ($pedidos as $key => $pedido) {
        $usuario = DB::table('usuarios')->select('nombres','apellidos')
                  ->where('status','A')
                  ->where('id',$pedido->idusuarios)->first();
        $pedido->usuario = $usuario;          
       $detalles = DB::table('pedidos_prods')->select('idproductos','cantidad','total_prod')
                  ->where('status','A')
                  ->where('idpedido',$pedido->idpedidos)->get();

        foreach ($detalles as $key => $prod) {
          $prodq = DB::table('productos')
                  ->where('status','A')
                  ->where('idproductos',$prod->idproductos)->first();
          $imageProd = DB::table('productos_imagenes')->select('url')
                  ->where('default',1)
                  ->where('idproductos',$prod->idproductos)->first();
          $prodq->cantidad = $prod->cantidad;
          $prodq->total_prod = $prod->total_prod;
          $prodq->image = $imageProd->url;
          $detalles[$key] = $prodq;
          unset($detalles[$key]->idproductos);
        }
        $pedido->detalles =  $detalles;
      }
      return response()->json(["respuesta" => true, 'list' => $pedidos]);           	
    }

    public function addPedido(Request $request) {
        $items = $request->items;
        $prod = [
          'codigo'=>$this->funciones->generarPass(8,false,'ud'),
          'total'=>$request->total,
          'estado'=>'Pendiente',
          'status'=>'A',
          'idusuarios'=>$request->user,
          'comprobante'=> ''
         ];
        $id = DB::table('pedidos')->insertGetId($prod);
        foreach ($items as $value) {
          DB::table('pedidos_prods')->insert(
            [
              'idpedido'=> $id,
              'idproductos'=> $value['idproductos'],
              'cantidad'=> $value['cantidadInCar'],
              'total_prod'=> $value['totalCu'],
              'talla'=> $value['talla'],
              'color'=> $value['color'],
              'status'=>'A'
           ]);
          // update stock
          // $prodUpdate = DB::table('productos')->select('stock')->where('idproductos',$value['idproductos'])->first();
          // $resta = $prodUpdate->stock - $value['cantidadInCar'];
          // DB::table('productos')->where('idproductos',$value['idproductos'])->update(
          //   [
          //     'stock' => $resta
          //  ]);
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

    public function pedidosListCliente(Request $request) {
      $currentPage = $request->pagina_actual;
      $limit = $request->limit;
      $pedidos = DB::table('pedidos')
                  ->where('status','A')
                  ->where('idusuarios',$request->iduser)
                  ->orderBy('createat','DESC')->paginate(5);

      foreach ($pedidos as $key => $pedido) {
        $usuario = DB::table('usuarios')->select('nombres','apellidos')
                  ->where('status','A')
                  ->where('id',$pedido->idusuarios)->first();
        $pedido->usuario = $usuario;          
       $detalles = DB::table('pedidos_prods')->select('idproductos','cantidad','total_prod')
                  ->where('status','A')
                  ->where('idpedido',$pedido->idpedidos)->get();

        foreach ($detalles as $key => $prod) {
          $prodq = DB::table('productos')
                  ->where('status','A')
                  ->where('idproductos',$prod->idproductos)->first();
          $imageProd = DB::table('productos_imagenes')->select('url')
                  ->where('default',1)
                  ->where('idproductos',$prod->idproductos)->first();
          $prodq->cantidad = $prod->cantidad;
          $prodq->total_prod = $prod->total_prod;
          $prodq->image = $imageProd->url;
          $detalles[$key] = $prodq;
          unset($detalles[$key]->idproductos);
        }
        $pedido->detalles =  $detalles;
      }
      return response()->json(["respuesta" => true, 'list' => $pedidos]);             
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

    public function procesPedido(Request $request) {
      $updatePedido = DB::table('pedidos')->where('idpedidos',$request->id)->update([
        'estado' => 'Enviado'
      ]);
      // Reducir Stock
      $producstPedidos = DB::table('pedidos_prods')->where('idpedido',$request->id)->get();
      foreach ($producstPedidos as $key => $value) {
        $cantidad = $value->cantidad;
        $prod = DB::table('productos')->select('stock')->where('idproductos',$value->idproductos)->first();
        $res = intval($prod->stock) - intval($cantidad);
        DB::table('productos')->where('idproductos',$value->idproductos)->update([
          'stock' => $res
        ]);
      }
      return response()->json(["respuesta" => true]);
    }

    public function uploadComprobante(Request $request) {
      if($request->hasFile('file'))
            {
                $image = $request->file('file');
                $filename  = 'PEDIDO-'.$request->pedido . '.' . $image->getClientOriginalExtension();
                $path = public_path('comprobantes/' . $filename);
                Image::make($image->getRealPath())->save($path);
                $save = DB::table('pedidos')->where('idpedidos',$request->pedido)->update(
                [
                 'comprobante' => $filename
                ]);
           }
      return response()->json(["respuesta" => true]);
    }
}
