<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:products',
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string',
            'category' => 'nullable|string',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'stock' => 'nullable|string',
            'whatsapp_message' => 'nullable|string',
            'image_url' => 'nullable|string',
            'active' => 'boolean',
            'pdf_url' => 'nullable|string',
        ]);

        $product = Product::create($validated);
        return response()->json($product, 201);
    }

    public function show(string $id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
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
            'brand' => 'nullable|string',
            'category' => 'nullable|string',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'stock' => 'nullable|string',
            'whatsapp_message' => 'nullable|string',
            'image_url' => 'nullable|string',
            'active' => 'boolean',
            'pdf_url' => 'nullable|string',
        ]);

        $product->update($validated);
        return response()->json($product);
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
