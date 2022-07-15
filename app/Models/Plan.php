<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'stripe_name',
        'stripe_id',
        'product_id',
        'price',
        'description'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
