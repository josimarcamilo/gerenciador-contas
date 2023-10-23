<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
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

            if (User::where('email', $credentials['email'])->exists()) {
                throw new Exception('User already exists');
            }

            $user = User::create($credentials);

            event(new Registered($user));

            return response()->json(['data' => $user], 201);
        } catch (Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 422);
        }
    }
}
