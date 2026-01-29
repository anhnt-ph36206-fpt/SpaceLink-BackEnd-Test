<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// ============================================
// PROTECTED ROUTES (Cần token)
// ============================================
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'profile']);
    });
});
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::post('/login', function (Request $request) {
//     $credentials = $request->validate([
//         'email' => ['required', 'email'],
//         'password' => ['required'],
//     ]);

//     if (!Auth::attempt($credentials)) {
//         return response()->json([
//             'message' => 'Invalid credentials'
//         ], 401);
//     }

//     $user = $request->user();

//     // (optional) xoá token cũ
//     $user->tokens()->delete();

//     $token = $user->createToken('api-token')->plainTextToken;

//     return response()->json([
//         'token' => $token,
//         'user' => $user,
//     ]);
// });

// Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
//     return $request->user();
// });