<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function login(Request $request)
    {
        #Autentificar para generar nuestro token
        $credentials = $request->validate([

            "email"=>"required|email|string",
            "password"=>"required|string"
        ]);
        # verificar en BD: El Auth no reconoce posecionar y presionar ctrl+ barra Espaceador para imporatr
        if (!Auth::attempt($credentials)) {
            return response()->json(["mensaje"=>"credenciales incorrectos"
            ], 401);
        }
        #autentificar  para generar nuestro token
         //return $request->user();
         $user = $request->user();
         # generar token: plainTextToken genera el token y es de laravel
         $tokenResult = $user->createToken('Token de Accesos');
         $token = $tokenResult->plainTextToken;  //geenero el token
        // return $token;
         # responder : bearer es un transportador de token
          return response()->json([
             "accessToken" => $token,
             "token_type" => "Bearer",
             "user" => $user


         ]);

    }
    public function registrar(Request $request)
    {
        //validar
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required"
        ]);
            //guardar
            $usuario = new User;
            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $usuario->password = bcrypt($request->password);
            $usuario->save();
            //responder
            return response()->json([
                "mensaje" => "Usuario Registrado",
                "status" => 1
            ],201);


    }
    public function perfil(Request $request)
    {
        return response() -> json($request->User());

    }
    public function salir(Request $request)

    {
        $request->user()->tokens()->delete();
        return response()->json([
            "mensaje"=>"logout"
        ]);
    }
}
