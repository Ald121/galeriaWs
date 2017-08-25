<?php
namespace App\Http\Middleware;
use Closure;
use Config;
use \Firebase\JWT\JWT;
use App\Usuarios;

class validateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->has('token')) {
            return response(['error'=>'Sin-Token-de-Seguridad'], 401);
        }
        try {
        $key = config('jwt.secret');
        $decoded = JWT::decode($request->token, $key, array('HS256'));
        $id = $decoded->id;
        $usuarios = new Usuarios();
        $datos = $usuarios->where('id',$id)->get();
        if (count($datos) > 0) {
            return $next($request);
        }else{
            return response(['error' => 'Usuario-no-Autorizado'], 401);
        }
        }catch (\Firebase\JWT\ExpiredException $e) {
            return response(['error' => 'Token-Expirado'],401);
        } catch (\Firebase\JWT\TokenInvalidException $e) {
            return response(['error' => 'Token-Invalido'],500);
        } catch (\Firebase\JWT\JWTException $e) {
            return response(['error' => 'Sin-Token-de-Seguridad'], 401);
        }
        
    }
}