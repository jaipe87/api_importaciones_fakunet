<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Http\Resources\MessageResource;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MessageController extends Controller
{
    public function index()
    {
        $query = Message::query();

        // Filtro por leído/no leído: ?read=1|0|true|false
        if (request()->has('read')) {
            $query->where('read', request()->boolean('read'));
        }

        // Filtro por rango de fecha en campo 'date': ?from=YYYY-MM-DD&to=YYYY-MM-DD
        $from = request()->query('from');
        $to = request()->query('to');
        if ($from && $to) {
            $query->whereBetween('date', [Carbon::parse($from), Carbon::parse($to)]);
        } elseif ($from) {
            $query->where('date', '>=', Carbon::parse($from));
        } elseif ($to) {
            $query->where('date', '<=', Carbon::parse($to));
        }

        // Orden por fecha descendente por defecto
        $query->orderBy('date', 'desc');

        return MessageResource::collection($query->paginate());
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
        return (new MessageResource($message))->response()->setStatusCode(201);
    }

    public function show(string $id)
    {
        $message = Message::find($id);
        
        if (!$message) {
            return response()->json(['message' => 'Message not found'], 404);
        }

        return new MessageResource($message);
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
        return new MessageResource($message);
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
