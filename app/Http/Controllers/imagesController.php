<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use DB;

class imagesController extends Controller
{
    
	public function imagesList(Request $request) {
    
    $images = DB::table('pictures')->where('status','A')->get();
    
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
         'status'=>'A'
        ]);
       }
    
    return response()->json(["respuesta" => true]);
                   	
    }
}
