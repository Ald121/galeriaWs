<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use DB;
use File;
use App\libs\funciones;
use Mail;
use Carbon\Carbon;

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
        $userData = DB::table('usuarios')->select('email','nombres','apellidos')->where('id',$request->user)->first();
        $userDataAdmin = DB::table('usuarios')->select('email')->where('userType','ADMIN')->first();
        $prodsDetalles = ['items' => []];
        $suma = 0;
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
          $prod = DB::table('productos')->where('idproductos',$value['idproductos'])->first();
          $prod->total_fac = $value['totalCu'];
          $suma = $suma + $value['totalCu'];
          array_push($prodsDetalles['items'],$prod);
        }
        $prodsDetalles['correo'] = $userData->email;
        $prodsDetalles['total'] = count($prodsDetalles['items']);
        $prodsDetalles['total_total'] = $suma;
        $prodsDetalles['fecha_fac'] = Carbon::now()->toDateTimeString();
        $sendMail = $this->enviar_correo_pedido($prodsDetalles);
        $prodsDetalles['correo'] = $userDataAdmin->email;
        $prodsDetalles['client_data'] = $userData;
        $sendMailAdmin = $this->enviar_correo_pedido_admin($prodsDetalles);
        return response()->json(["respuesta" => true]);     	
    }

    public function enviar_correo_pedido_admin($data){
        $correo_enviar = $data['correo'];
        $send = Mail::send('email_pedido_admin', $data, function($message)use ($correo_enviar)
            {
                $message->from("info@otavalodigital.com",'Pedido');
                $message->to($correo_enviar,'Nuevo Pedido')->subject('Nuevo Pedido');
            });
        return $send;
    }

    public function enviar_correo_pedido($data){
        $correo_enviar = $data['correo'];
        $send = Mail::send('email_pedido_client', $data, function($message)use ($correo_enviar)
            {
                $message->from("info@otavalodigital.com",'Detalles de tu pedido');
                $message->to($correo_enviar,'Detalles de tu pedido')->subject('Detalles de tu pedido');
            });
        return $send;
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

    public function getClientData(Request $request) {
        $datosUser = DB::table('usuarios')->select('id','nombres','apellidos','email','direccion','ciudad','telefono','userType')->where('id',$request->id)->where('status','A')->first();
         $prov = DB::table('ciudades')->select('provincia')->where('nombre',$datosUser->ciudad)->where('status','A')->first();
         $datosUser->provincia = $prov->provincia;
        return response()->json(["respuesta" => true,'datos' => $datosUser]);          
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
