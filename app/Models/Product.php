<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    function category()
    {
        return $this->belongsTo(Category::class);
    }

    
    public function details()
    {
        return $this->hasMany(ProductDetail::class)->select([ 'id','product_id', 'product_size', 'stock']);
    }

    function images()
    {
        return $this->hasMany(Image::class);
    }
}
