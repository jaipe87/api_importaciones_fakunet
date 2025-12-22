<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Http\Resources\SlideResource;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    public function index()
    {
        return SlideResource::collection(Slide::paginate());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image_url' => 'required|string',
            'active' => 'boolean',
        ]);

        $slide = Slide::create($validated);
        return (new SlideResource($slide))->response()->setStatusCode(201);
    }

    public function show(string $id)
    {
        $slide = Slide::find($id);
        if (!$slide) {
            return response()->json(['message' => 'Slide not found'], 404);
        }
        return new SlideResource($slide);
    }

    public function update(Request $request, string $id)
    {
        $slide = Slide::find($id);
        if (!$slide) {
            return response()->json(['message' => 'Slide not found'], 404);
        }

        $validated = $request->validate([
            'image_url' => 'sometimes|string',
            'active' => 'boolean',
        ]);

        $slide->update($validated);
        return new SlideResource($slide);
    }

    public function destroy(string $id)
    {
        $slide = Slide::find($id);
        if (!$slide) {
            return response()->json(['message' => 'Slide not found'], 404);
        }
        $slide->delete();
        return response()->json(['message' => 'Slide deleted successfully']);
    }
}
