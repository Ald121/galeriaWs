<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use DB;
use File;

class imagesController extends Controller
{
    
	public function imagesList(Request $request) {
    
    $images = DB::table('pictures')->where('status','A')->get();
    
    return response()->json(["respuesta" => true, 'list' => $images]);
                   	
    }

    public function imagesListByCat(Request $request) {
    
    $images = DB::table('pictures')->where('status','A')->where('category',$request->cat)->get();
    
    return response()->json(["respuesta" => true, 'list' => $images]);
                    
    }

    public function uploadFiles(Request $request) {
    
    if($request->hasFile('file'))
        {
        $image = $request->file('file');
        $filename  = time() . '.' . $image->getClientOriginalExtension();

        $path = public_path('galeria/' . $filename);
        Image::make($image->getRealPath())->save($path);
        $save = DB::table('pictures')->insert(
        [
         'src'=>'galeria/' . $filename,
         'category'=>$request->cat, 
         'status'=>'A'
        ]);
       }
    
    return response()->json(["respuesta" => true]);
                   	
    }
    
    public function deleteImg(Request $request) {
        $exists = File::exists(public_path().'/'.$request->img);
        if ($exists) {
           File::Delete(public_path().'/'.$request->img);
        }
        $delete = DB::table('productos_imagenes')->where('idproductos_imagenes',$request->idImage)->update(['status' => 'I' ]);
        if ($delete == 1) {
            return response()->json(["respuesta" => true]);
        }else{
            return response()->json(["respuesta" => false]);
        }            
    }
}
