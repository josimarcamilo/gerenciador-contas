<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    use HasFactory;

    protected $dates = [
        'mes'
    ];

    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }
}
