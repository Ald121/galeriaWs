<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuarios;
// Extras
use Hash;
use DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Mail;

class userController extends Controller
{
	public function __construct(){
    	// Modelos
    	$this->usuarios = new Usuarios();
    }

    public function enviar_correo_registro($data){
        $correo_enviar = $data['correo'];
        $send = Mail::send('email_registro', $data, function($message)use ($correo_enviar)
            {
                $message->from("info@otavalodigital.com",'Galeria');
                $message->to($correo_enviar,'Email de verificación')->subject('Verifica tu cuenta');
            });
        return $send;
    }

    public function generateRegisterCode($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

  	public function login(Request $request) {

        $datos=$this->usuarios->select('nick','id')->where('nick',$request->nick)->get();
        if (count($datos) == 0) {
            return response()->json(["respuesta" => false]);
        }

        $datos=DB::table('usuarios')->select('pass')->where('nick',$request->nick)->where('status','A')->first();
        if (count($datos) == 0) {
            return response()->json(["respuesta" => false]);
        }

        $checkpass = Hash::check($request->pass,$datos->pass);
        if ($checkpass) {
         $datos = $this->usuarios->select('id','nick')->where('nick',$request->nick)->where('status','A')->first();
         $datosUser = $this->usuarios->select('id','nombres','apellidos','email')->where('nick',$request->nick)->where('status','A')->first();
         $extra = ['id'=>$datosUser->id];
         $token = JWTAuth::fromUser($datos,$extra);
         return response()->json(['respuesta' => true,'token' => $token,'datos' => $datosUser]);
        }
        return response()->json(["respuesta" => $checkpass]);           
    }

    public function registrar(Request $request) {
        $activationCode = $this->generateRegisterCode(12);
        $save = DB::table('usuarios')->insert(
        [
         'nick' => $request->nick,
         'pass' => bcrypt($request->pass),
         'userType' => 'CLIENTE',
         'status' => 'P',
         'nombres' => $request->nombres,
         'apellidos' => $request->apellidos,
         'email' => $request->email,
         'activationCode' => $activationCode
        ]);
        if ($save) {
        $data = [ 
                "correo" => $request->email,
                "nombre" => $request->nombres,
                "codigo" => $activationCode
                ];
        $sendMail = $this->enviar_correo_registro($data);
        if ($sendMail == null) {
            return response()->json(["respuesta" => $save]);
        }else{
            return response()->json(["respuesta" => false]);
        }
        }else{
            return response()->json(["respuesta" => $save]);
        }
                   
    }

    public function activar(Request $request) {
        $activationCode = $this->generateRegisterCode(12);
        $save = DB::table('usuarios')->where('activationCode',$request->codigo)->update(
        [
         'status' => 'A',
         'activationCode' => 'NA'
        ]);
        if ($save) {
        $data = [ 
                "correo" => $request->email,
                "nombre" => $request->nombres,
                "codigo" => $activationCode
                ];
                $sendMail = null;
        // $sendMail = $this->enviar_correo_credenciales($data);
        if ($sendMail == null) {
            return response()->json(["respuesta" => true]);
        }else{
            return response()->json(["respuesta" => false]);
        }
        }else{
            return response()->json(["respuesta" => true]);
        }
                   
    }

    public function salir(Request $request) {
        $tokeninvalidate = JWTAuth::invalidate($request->token);
        return response()->json(["respuesta" => $tokeninvalidate]);          
    }

    public function checkSession(Request $request) {
        return response()->json(["respuesta" => true]);          
    }
}
