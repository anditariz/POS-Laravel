<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'id',
        'name',
        'price',
        'image',
        'stock',
        'description',
        'is_active',
    ];
}
