<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthController\LoginRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        try{
            // busca usuario
            $user = User::where('email', $request->input('email'))->firstOrFail();

            // validar senha
            if(!Hash::check($request->password, $user->password)){
                throw new InvalidArgumentException('Email ou senha incorretos.');
            }
            // gerar token
            $token = $user->createToken($user->email)->plainTextToken;

            // retorna token
            return response()
                ->json([
                    'token' => $token
                ]);
        }catch(InvalidArgumentException $e){
            return response()
                ->json([
                    'message' => $e->getMessage()
                ], 401);
        }
    }
}
