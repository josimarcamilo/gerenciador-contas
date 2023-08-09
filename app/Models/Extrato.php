<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extrato extends Model
{
    use HasFactory;

    const RECEITA = 1;
    const DESPESA = 2;
    const CARTAO = 3;

    const PENDENTE = 1;
    const PAGO = 2;
}
