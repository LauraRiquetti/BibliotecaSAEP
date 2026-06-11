<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\EmprestimoController;


// --- Rotas do Sistema (CRUDs) ---
// O Resource já cria automaticamente as rotas: index, create, store, edit, update e destroy
Route::get('/', [LivroController::class, 'index'])->name('index.livros');
Route::resource('usuarios', UsuarioController::class);
Route::resource('livros', LivroController::class);
Route::resource('emprestimos', EmprestimoController::class);