<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialPlanning extends Model
{
    use HasFactory;

    public const OPEN = 1;
    public const CLOSED = 2;

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
