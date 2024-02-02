<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $dates = [
        'month',
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function extracts()
    {
        return $this->hasMany(Extract::class);
    }
}
