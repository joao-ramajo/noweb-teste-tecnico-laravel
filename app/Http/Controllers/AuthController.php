<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthController\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        try{
            $user = User::where('email', $request->input('email'))->firstOrFail();

            if(!Hash::check($request->password, $user->password)){
                throw new InvalidArgumentException('Email ou senha incorretos.');
            }

            $token = $user->createToken($user->email)->plainTextToken;

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

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()
            ->json([
                'message' => 'Logou realizado com sucesso'
            ], 200);
    }
}
