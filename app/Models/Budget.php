<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $hidden = [
        'financial_planning_id',
    ];

    public function financialPlanning()
    {
        return $this->belongsTo(FinancialPlanning::class, 'financial_planning_id');
    }
}
