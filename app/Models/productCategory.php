<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = ['name', 'details'];

    /**
     * Get all products that belong to this category
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'cat_id');
    }
}
