<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Listar usuários

Route::get('usuarios', [UsuariosController::class, 'index']);

// Listar usuários especificos

Route::get('usuarios/{id}', [UsuariosController::class, 'show']);

// Criar novo usuário

Route::post('usuarios', [UsuariosController::class, 'store']);

// Atualizar usuários

Route::put('usuarios/{id}', [UsuariosController::class, 'update']);

// Deletar usuários

Route::delete('usuarios/{id}', [UsuariosController::class, 'destroy']);