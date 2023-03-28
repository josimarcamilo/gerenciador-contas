<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extract extends Model
{
    use HasFactory;

    public const ENTRY = 1;
    public const EXIT = 2;
    public const CREDIT_CARD = 3;

    public const PENDING = 1;
    public const PAID = 2;

    protected $hidden = [
        'financial_planning_id'
    ];

    public function financialPlanning()
    {
        return $this->belongsTo(FinancialPlanning::class, 'financial_planning_id');
    }
}
