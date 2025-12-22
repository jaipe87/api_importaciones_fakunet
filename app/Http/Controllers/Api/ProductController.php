<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['brand', 'category'])->paginate();
        return ProductResource::collection($products);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:products,code',
            'name' => 'required|string|max:255',
            'brand_id' => 'nullable|integer|exists:brands,id',
            'category_id' => 'nullable|integer|exists:categories,id',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'stock' => 'nullable|string',
            'image_url' => 'nullable|string',
            'pdf_url' => 'nullable|string',
        ]);

        $product = Product::create($validated);
        return (new ProductResource($product->load(['brand','category'])))->response()->setStatusCode(201);
    }

    public function show(string $id)
    {
        $product = Product::with(['brand','category'])->find($id);
        
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return new ProductResource($product);
    }

    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validated = $request->validate([
            'code' => 'sometimes|string|unique:products,code,' . $id,
            'name' => 'sometimes|string|max:255',
            'brand_id' => 'nullable|integer|exists:brands,id',
            'category_id' => 'nullable|integer|exists:categories,id',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'stock' => 'nullable|string',
            'image_url' => 'nullable|string',
            'pdf_url' => 'nullable|string',
        ]);

        $product->update($validated);
        return new ProductResource($product->load(['brand','category']));
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
