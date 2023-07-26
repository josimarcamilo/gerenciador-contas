<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialPlanning extends Model
{
    use HasFactory;

    public const OPEN = 1;
    public const CLOSED = 2;

    protected $hidden = [
        'id',
        'financial_area_id',
    ];

    public function financialArea()
    {
        return $this->belongsTo(FinancialArea::class, 'financial_area_id');
    }

    public function budget()
    {
        return $this->hasMany(Budget::class);
    }
}
