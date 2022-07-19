<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orcamento extends Model
{
    use HasFactory;

    public static function encode($id)
    {
        $hash = new Hashids('orcamento', 4);
        return 'orc'.$hash->encode($id);
    }

    public static function decode($hash)
    {
        $value = substr($hash, 3);
        return (new Hashids('orcamento', 4))->decode($value)[0];
    }

    public static function findByHas($hash)
    {
        return self::find(self::decode($hash));
    }

    public function distribuicoes()
    {
        return $this->hasMany(Distribuicao::class, 'orcamento_id');
    }

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
