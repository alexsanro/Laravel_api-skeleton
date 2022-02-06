<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Funcion de registro del usuario
     */
    public function signup(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|between:6,12'
        ]);

        $user = new User([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    /**
     * Funcion de login del usuario 
     */
    public function login(Request $request)
    {
        error_log("ddd222");
        //echo "hola";
        //var_dump("dddad");
        $hola = var_dump($request->json());
        error_log($request->password);
        $request->validate([
            'username'       => 'required',
            'password'    => 'required',
        ]);
        error_log("dd231");
        $credentials = request(['email', 'password']);
        die(var_dump($credentials));
        error_log($credentials);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Error chinga'
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at
            )
                ->toDateTimeString(),
        ]);
    }

    /**
     * Funcion de logout del usuario (salida de la session)
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(
            ['message' =>
                'Successfully logged out'
            ]);
    }

    /**
     * Devuelve los datos básicos del usuario en la base de datos
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
