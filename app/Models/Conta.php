<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;

    const PENDENTE = 1;
    const QUITADA = 2;

    const STATUS_DESCRIPTION = [
        self::PENDENTE => 'Pendente',
        self::QUITADA => 'Quitada'
    ];

    const APAGAR = 1;
    const ARECEBER = 2;

    const TYPE_DESCRIPTION = [
        self::APAGAR => 'A pagar',
        self::ARECEBER => 'A Receber'
    ];

    protected $fillable = [
        'descricao',
        'tipo',
        'status',
        'valor',
        'vencimento',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getTags()
    {
        $string = [];

        foreach($this->tags as $tag) {
            $string[] = $tag->nome;
        }

        return implode(' ', $string);
    }
}
