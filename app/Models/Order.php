<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'order_meta_data' => 'array',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity'); 
    }
}
