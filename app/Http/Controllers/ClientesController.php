<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use App\Models\Cliente;
use App\Models\Conta;
use App\Models\Tag;
use Illuminate\Foundation\Console\ClearCompiledCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use stdClass;

class ClientesController extends Controller
{
    public function contas($id)
    {
        $cliente = Cliente::findOrFail($id);

        $contasPendentes = Conta::where('cliente_id', $id)
        ->where('tipo', Conta::ARECEBER)
        ->whereNull('quitada')
        ->get();

        $contasQuitadas = Conta::where('cliente_id', $id)
        ->where('tipo', Conta::ARECEBER)
        ->whereNotNull('quitada')
        ->orderBy('id', 'desc')
        ->get();

        $totais['Valor a pagar'] = DB::table('contas')
            ->select(DB::raw('SUM(valor) as total'))
            ->where('tipo', Conta::ARECEBER)
            ->where('cliente_id', $id)
            ->whereNull('quitada')
            ->first()->total /100;

        return view('cliente', compact('contasPendentes', 'contasQuitadas', 'totais'));
    }
}
