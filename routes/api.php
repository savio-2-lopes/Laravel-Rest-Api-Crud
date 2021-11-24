<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Listar usuarios
Route::get('usuarios', [UsuarioController::class, 'index']);

// Listar especifico usuarios
Route::get('usuarios/{id}', [UsuarioController::class, 'show']);

// Criar novo artigo
Route::post('usuarios', [UsuarioController::class, 'store']);

// Atualizar usuarios
Route::put('usuarios/{id}', [UsuarioController::class, 'update']);

// Delete usuarios
Route::delete('usuarios/{id}', [UsuarioController::class,'destroy']);
