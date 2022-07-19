<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orcamento extends Model
{
    use HasFactory;

    public function criar($campos)
    {
        try{
            DB::beginTransaction();
            $orcamentoId = DB::table('orcamentos')->insertGetId([
                'descricao' => $campos["descricao"],
                'padrao' => false,
                'visibilidade' => $campos["visibilidade"],
                'user_id' => auth()->user()->id,
            ]);

            foreach($campos["distribuicao"] as $valores){
                $distribuicao = DB::table('distribuicao')->insertGetId([
                    'descricao' => $valores["descricao"],
                    'porcentagem' => $valores["porcentagem"],
                    'orcamento_id'=> $orcamentoId
                ]);
            }           

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }
    }
}
