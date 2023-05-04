<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryRequest;
use App\Http\Resources\ProductCategoryResource;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductCategoryResource::Collection(ProductCategory::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryRequest $request, CategoryService $categoryService)
    {
        $data = $categoryService->createNewCategory($request->validated());

        return new ProductCategoryResource($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $product_category)
    {
        return new ProductCategoryResource($product_category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductCategoryRequest $request, ProductCategory $product_category)
    {
        $product_category->update($request->validated());

        return new ProductCategoryResource($product_category);
    }

    public function destroy(ProductCategory $product_category)
    {
        $product_category->delete();

        return response()->noContent();
    }
}
