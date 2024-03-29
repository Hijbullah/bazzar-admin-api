<?php

namespace App\Models;

use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, NodeTrait;

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
