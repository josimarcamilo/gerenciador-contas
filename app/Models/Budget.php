<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $dates = [
        'month'
    ];

    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }
}
