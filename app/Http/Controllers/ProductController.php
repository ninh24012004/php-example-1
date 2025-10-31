<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'asc')->paginate(3);
        return response()->json($products);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        return response()->json(
            [
                'message' => 'Product created successfully.',
                'product' => $product
            ],
            201
        );
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return response()->json(
            [
                'message' => 'Product updated successfully.',
                'product' => $product->fresh() 
            ]
        );
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(
            [
                'message' => 'Product deleted successfully.'
            ]
        );
    }
}
