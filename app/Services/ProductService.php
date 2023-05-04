<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductService {

    public function createNewProduct(array $productsData): Product
    {
        return Product::create($productsData);
    }

    public function updateProduct()
    {
        
    }

    public function uploadImage($file, $oldimage = null): String
    {
        $imagename = date('YmdHi') . uniqid() . '.' . $file->extension();
        $file->storePubliclyAs('public/product', $imagename);
        
        if($oldimage){
            Storage::delete('public/product/' . $oldimage);
        }

        return $imagename;
    }
}