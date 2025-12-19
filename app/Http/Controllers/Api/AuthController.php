<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Validar credenciales de usuario (login)
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Buscar usuario por nombre
        $user = User::where('name', $validated['name'])->first();

        // Verificar si existe el usuario y la contraseña con MD5
        if (!$user || $user->password !== md5($validated['password'])) {
            return response()->json([
                'message' => 'Credenciales inválidas'
            ], 401);
        }

        // Login exitoso
        return response()->json([
            'message' => 'Login exitoso',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'created_at' => $user->created_at,
            ]
        ]);
    }
}
