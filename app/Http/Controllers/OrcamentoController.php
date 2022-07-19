<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrcamentoResource;
use App\Models\Orcamento;
use Illuminate\Http\Request;

class OrcamentoController extends Controller
{
    public function create(Request $req)
    {
        $campos = $req->validate([
            "descricao" => 'required',
            "visibilidade" => 'required',
            "distribuicao" => 'required'
        ]);

        (new Orcamento())->criar($campos);
        
        return response()->json($req->all());
    }

    public function list(Request $req)
    {
        return new OrcamentoResource(Orcamento::find($req->codigo));
    }
}
