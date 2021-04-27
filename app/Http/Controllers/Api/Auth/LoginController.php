<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['usuario', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['errors' => 'El usuario o password son incorrectos, vuelva a intentarlo.']);
        }

        return response()->json(['token' => $token]);
    }
}
