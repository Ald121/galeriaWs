<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuarios;
// Extras
use Hash;
use DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class userController extends Controller
{
	public function __construct(){
    	// Modelos
    	$this->usuarios=new Usuarios();
    }

  	public function login(Request $request) {

        $datos=$this->usuarios->select('nick','id')->where('nick',$request->nick)->get();
        if (count($datos)==0) {
            return response()->json(["respuesta"=>false]);
        }

        $datos=DB::table('usuarios')->select('pass')->where('nick',$request->nick)->where('status','A')->first();
        if (count($datos)==0) {
            return response()->json(["respuesta"=>false]);
        }

        $checkpass=Hash::check($request->pass,$datos->pass);
        if ($checkpass) {
         $datos = $this->usuarios->select('id','nick')->where('nick',$request->nick)->where('status','A')->first();
         $token = JWTAuth::fromUser($datos);

         return response()->json(['respuesta'=>true,'token'=>$token]);
        }
        return response()->json(["respuesta"=>$checkpass]);           
    }
}
