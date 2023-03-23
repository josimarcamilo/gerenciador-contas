<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialArea extends Model
{
    use HasFactory;

    protected $hidden = [
        'id',
        'user_id'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function financialPlannings()
    {
        return $this->hasMany(FinancialPlanning::class);
    }
}
