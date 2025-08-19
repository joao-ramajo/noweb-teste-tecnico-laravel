<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()
            ->json([
                'data' => User::all()->toArray()
            ], 200);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        // cria usuario
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        // salva usuario
        $user->save();

        // retorna usuario e mensagem
        return response()
            ->json([
                'message' => 'Usuário criado com sucesso',
                'data' => $user->toArray()
        ], 201);
    }
}
