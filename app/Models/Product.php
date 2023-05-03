<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
    */
    protected $fillable = [
        'product_categories_id',
        'name',
        'price',
        'image',
        'created_by'
    ];

    public function productCategory()
    {
        $this->belongsToMany(ProductCategory::class);
    }
}
