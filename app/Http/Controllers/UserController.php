<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response()
            ->json(User::paginate(10), 200);
    }

    public function store(UserStoreRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $user->save();

        return response()
            ->json([
                'message' => 'Usuário criado com sucesso',
                'data' => $user->toArray()
        ], 201);
    }
}
