<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            DB::beginTransaction();
            $user = User::create($credentials);
            $accountDefault = new Account();
            $accountDefault->user_id = $user->id;
            $accountDefault->save();
            DB::commit();
            event(new Registered($user));

            return response()->json(['data' => $user], 201);
        } catch (Throwable $th) {
            DB::rollBack();

            return response()->json([
                'message' => $th->getMessage(),
            ], 422);
        }
    }
}
