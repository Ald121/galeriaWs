<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use DB;
use File;

class productsController extends Controller
{
    public function productsList(Request $request) {
    
    $products = DB::table('products')->where('status','A')->get();

    foreach ($products as $key => $prod) {
    	$prod->images = DB::table('image_products')->where('status','A')->where('idproducts',$prod->idproducts)->get();
    }
    
    return response()->json(["respuesta" => true, 'list' => $products]);
                   	
    }

    public function addProduct(Request $request) {
    
    if($request->hasFile('file'))
        {
        $image = $request->file('file');
        $filename  = time() . '.' . $image->getClientOriginalExtension();

        $path = public_path('galeria/' . $filename);
        Image::make($image->getRealPath())->save($path);
        $save = DB::table('products')->insert(
        [
         'src'=>'galeria/' . $filename, 
         'status'=>'A'
        ]);
       }
    
    return response()->json(["respuesta" => true]);
                   	
    }
    
    public function deleteProd(Request $request) {
        $exists = File::exists(public_path().'/'.$request->img);
        if ($exists) {
           File::Delete(public_path().'/'.$request->img);
        }
        $delete = DB::table('products')->where('idproducts',$request->id)->update(['status' => 'I' ]);
        if ($delete == 0) {
            return response()->json(["respuesta" => true]);
        }else{
            return response()->json(["respuesta" => false]);
        }            
    }
}
