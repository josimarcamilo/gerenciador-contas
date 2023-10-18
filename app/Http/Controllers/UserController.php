<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    public function store(Request $req)
    {
        $credentials = $req->only([
            'name',
            'email',
            'password',
        ]);
        try {

            $user = User::create($credentials);

            event(new Registered($user));

            return response()->json($user);
        } catch (Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 422);
        }
    }
}
