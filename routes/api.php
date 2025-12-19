<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MessageController;

// ---------------------------------------------------------
// 1. Ruta pública básica (para probar la API rápidamente)
// ---------------------------------------------------------
Route::get('/status', function () {
    return response()->json([
        'app' => config('app.name'),
        'env'  => config('app.env'),
        'status' => 'API OK',
        'timestamp' => now(),
    ]);
});

// ---------------------------------------------------------
// 2. Grupo de autenticación
// ---------------------------------------------------------
Route::post('/login', [AuthController::class, 'login']);
// Route::post('/register', [AuthController::class, 'register']);

// ---------------------------------------------------------
// 3. Rutas protegidas por autenticación
// ---------------------------------------------------------
Route::middleware('bearer')->group(function () {

    // ---------------------------
    // 3.1. Módulo de Usuarios
    // ---------------------------
    Route::apiResource('users', UserController::class);

    // ---------------------------
    // 3.2. Módulo de Productos
    // ---------------------------
    Route::apiResource('products', ProductController::class);

    // ---------------------------
    // 3.3. Módulo de Marcas
    // ---------------------------
    Route::apiResource('brands', BrandController::class);

    // ---------------------------
    // 3.4. Módulo de Categorías
    // ---------------------------
    Route::apiResource('categories', CategoryController::class);

    // ---------------------------
    // 3.5. Módulo de Mensajes
    // ---------------------------
    Route::apiResource('messages', MessageController::class);

    // Logout
    // Route::post('/logout', [AuthController::class, 'logout']);
});

// ---------------------------------------------------------
// 4. Versionado opcional (v1)
// ---------------------------------------------------------
// Route::prefix('v1')->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index']);
// });

