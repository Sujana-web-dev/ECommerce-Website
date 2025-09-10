<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//define relationship with productCategory

class Product extends Model
{
    protected $fillable = ['name', 'amount', 'cat_id', 'details', 'image', 'stock'];

    public function category()
    {
        return $this->belongsTo(productCategory::class, 'cat_id');
    }

    public function isInStock()
    {
        return $this->stock > 0;
    }
}

