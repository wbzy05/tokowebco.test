<?php

namespace App\Services;

use App\Models\ProductCategory;

class CategoryService {

    public function createNewCategory(array $categoryData): ProductCategory
    {
        $category = ProductCategory::create($categoryData);

        return $category;
    }
}