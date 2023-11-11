<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected function fullname(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return $attributes['firstname'] . ' ' . $attributes['lastname'];
            }
        );
    }
}
