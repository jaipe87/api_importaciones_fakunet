<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return response()->json($brands);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'active' => 'boolean',
        ]);

        $brand = Brand::create($validated);
        return response()->json($brand, 201);
    }

    public function show(string $id)
    {
        $brand = Brand::find($id);
        
        if (!$brand) {
            return response()->json(['message' => 'Brand not found'], 404);
        }

        return response()->json($brand);
    }

    public function update(Request $request, string $id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            return response()->json(['message' => 'Brand not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'active' => 'boolean',
        ]);

        $brand->update($validated);
        return response()->json($brand);
    }

    public function destroy(string $id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            return response()->json(['message' => 'Brand not found'], 404);
        }

        $brand->delete();
        return response()->json(['message' => 'Brand deleted successfully']);
    }
}
