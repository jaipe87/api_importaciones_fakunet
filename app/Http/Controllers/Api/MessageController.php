<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'required|email',
            'content' => 'required|string',
            'date' => 'required|date',
            'read' => 'boolean',
        ]);

        $message = Message::create($validated);
        return response()->json($message, 201);
    }

    public function show(string $id)
    {
        $message = Message::find($id);
        
        if (!$message) {
            return response()->json(['message' => 'Message not found'], 404);
        }

        return response()->json($message);
    }

    public function update(Request $request, string $id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json(['message' => 'Message not found'], 404);
        }

        $validated = $request->validate([
            'firstName' => 'sometimes|string|max:255',
            'lastName' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string',
            'email' => 'sometimes|email',
            'content' => 'sometimes|string',
            'date' => 'sometimes|date',
            'read' => 'boolean',
        ]);

        $message->update($validated);
        return response()->json($message);
    }

    public function destroy(string $id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json(['message' => 'Message not found'], 404);
        }

        $message->delete();
        return response()->json(['message' => 'Message deleted successfully']);
    }
}
