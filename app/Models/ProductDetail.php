<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['product_id', 'product_size', 'stock'];

    function size ()
    {
        return $this->hasOne(ProductSize::class);
    }
}
