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
        
        $clientes = Cliente::all();

        return view('home', compact('contas', 'totais', 'clientes'));
    }

    public function criarOrEditarConta(Request $req)
    {
        $campos = $req->only(['codigo', 'descricao', 'tipo', 'valor', 'vencimento']);
        $cliente = $req->only(['cliente']);
        $reqTags = $req->tags;

        $reqTags = explode(',', $reqTags);

        $tags = [];
        foreach ($reqTags as $tag) {
            $tags[] = Tag::firstOrCreate(['nome' => $tag]);
        }

        $dados = new stdClass();
        $dados->campos = $campos;
        $dados->tags = $tags;
        $dados->cliente = $cliente['cliente'];

        if($campos['codigo']) {
            $this->editarConta($campos);
        } else {
            $this->criarConta($dados);
        }

        return redirect()->route('home');
    }

    private function criarConta($dados)
    {
        $campos = $dados->campos;
        $tags = $dados->tags;

        $conta = new Conta($campos);
        $conta->user_id = 1;
        $conta->status = Conta::PENDENTE;
        $conta->valor  = str_replace(',', '.', $campos['valor']) * 100;

        if($dados->cliente) {
            $conta->cliente_id = $dados->cliente;
        }

        $conta->save();

        foreach($tags as $tag) {
            $result = DB::table('conta_tag')->updateOrInsert(
                ['conta_id' => $conta->id, 'tag_id' => $tag->id]
            );
        }        
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
