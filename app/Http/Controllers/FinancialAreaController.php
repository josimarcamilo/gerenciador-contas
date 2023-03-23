<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinancialAreaController extends Controller
{
    public function all(Request $req)
    {
        $user = $req->user();

        return response()->json($user->financialAreas);
    }
}
