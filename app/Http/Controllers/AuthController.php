<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthController\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        echo "realizando login";
    }
}
