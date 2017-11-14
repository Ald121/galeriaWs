<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use DB;
use File;

class imagesController extends Controller
{
    
	public function addVideo(Request $request) {
        $save = DB::table('videos')->insert([
            'url' => $request->url,
            'descripcion' => $request->descripcion
        ]);
        return response()->json(["respuesta" => $save]);              
    }

    public function imagesList(Request $request) {
        $images = DB::table('pictures')->where('status','A')->get();
        return response()->json(["respuesta" => true, 'list' => $images]);              
    }

    public function videoList(Request $request) {
        $videos = DB::table('videos')->where('status','A')->get();
        return response()->json(["respuesta" => true, 'list' => $videos]);          	
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
        $delete = DB::table('pictures')->where('idpictures',$request->id)->update(['status' => 'I' ]);
        if ($delete == 1) {
            $exists = File::exists(public_path().'/'.$request->img);
            if ($exists) {
               File::Delete(public_path().'/'.$request->img);
            }
            return response()->json(["respuesta" => true]);
        }else{
            return response()->json(["respuesta" => false]);
        }            
    } 

    public function deleteImgProd(Request $request) {
        $delete = DB::table('productos_imagenes')->where('idproductos_imagenes',$request->idImage)->update(['status' => 'I' ]);
        if ($delete == 1) {
            $exists = File::exists(public_path().'/'.$request->img);
            if ($exists) {
               File::Delete(public_path().'/'.$request->img);
            }
            return response()->json(["respuesta" => true]);
        }else{
            return response()->json(["respuesta" => false]);
        }            
    }

    public function setPreviewProdImage(Request $request) {
        $changeAll = DB::table('productos_imagenes')->where('idproductos',$request->idProd)->update(['default' => 0 ]);
        $change = DB::table('productos_imagenes')->where('idproductos_imagenes',$request->idImage)->update(['default' => 1 ]);
        if ($change == 1) {
            return response()->json(["respuesta" => true]);
        }else{
            return response()->json(["respuesta" => false]);
        }            
    }
}
