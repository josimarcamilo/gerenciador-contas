<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use App\Models\Conta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $contas = Conta::all();
        $totalProjetado = DB::table('contas')
            ->select('tipo', DB::raw('SUM(valor) as total'))
            ->where('user_id', 1)
            ->whereNull('quitada')
            ->groupBy('tipo')
            ->get();
        
        $totais = [];

        if(count($totalProjetado->all())) {
            foreach($totalProjetado as $total){
                $totais[Conta::TYPE_DESCRIPTION[$total->tipo]] = $total->total / 100;
            }
        }        

        return view('home', compact('contas', 'totais'));
    }

    public function criarOrEditarConta(Request $req)
    {
        $campos = $req->only(['codigo', 'descricao', 'tipo', 'valor', 'vencimento']);
        if($campos['codigo']) {
            $this->editarConta($campos);
        } else {
            $this->criarConta($campos);
        }

        return redirect()->route('home');
    }

    private function criarConta($campos)
    {
        $conta = new Conta($campos);
        $conta->user_id = 1;
        $conta->status = Conta::PENDENTE;
        $conta->valor  = str_replace(',', '.', $campos['valor']) * 100;

        $conta->save();
    }

    private function editarConta($campos)
    {
        $conta = Conta::findOrFail($campos['codigo']);
        $conta->descricao = $campos['descricao'];
        $conta->tipo = $campos['tipo'];
        $conta->valor = str_replace(',', '.', $campos['valor']) * 100;
        $conta->vencimento = $campos['vencimento'];

        $conta->save();
    }

    public function quitarConta (Request $req)
    {
        if($req->comprovante){
            $pasta = 'public/'.now()->format('Ym');
            $path = $req->comprovante->store($pasta);

            $comprovante = new Arquivo();
            $comprovante->nome = "";
            $comprovante->path = $path;
            $comprovante->conta_id = $req->codigo_conta;
            $comprovante->save();

            $link = Storage::url($path);
        }

        $conta = Conta::findOrFail($req->codigo_conta);
        $conta->status = Conta::QUITADA;
        $conta->quitada = now();
        $conta->save();

        return redirect()->route('home');
    }

    public function deletarConta(Request $req)
    {
        $dados = $req->all();
        $deletado = DB::table('contas')
        ->where('id', $req->codigo_conta)
        ->delete();

        return redirect()->route('home');
    }
}
