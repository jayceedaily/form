<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->where('is_enabled', 1)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
           return response(['errors'=>['email' => ['The provided credentials are incorrect']]], 422);

        }

        return response(['token'=>$user->createToken('my-token')->plainTextToken], 201);
    }

    public function init(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response(['message'=>'Token deleted'], 200);
    }
}
