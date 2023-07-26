<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function store(Request $req)
    {
        $credentials = $req->only([
            'name',
            'email',
            'password',
        ]);

        $user = User::create($credentials);

        event(new Registered($user));

        return response()->json($user);
    }

    public function storeToken(Request $req)
    {
        if (!Auth::attempt(['email'=> $req->email, 'password'=>$req->password])) {
            return response()->json(['error' => 'invalid crentials'], 400);
        }

        $req->user()->tokens()->delete();
        $token = $req->user()->createToken($req->token_name);

        return response()->json(['token' => $token->plainTextToken]);
    }
}
