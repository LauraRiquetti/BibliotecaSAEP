<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\EmprestimoController;


// --- Rotas do Sistema (CRUDs) ---
// O Resource já cria automaticamente as rotas: index, create, store, edit, update e destroy
// --- Rotas do Sistema (CRUDs) ---
Route::get('/', [LivroController::class, 'index'])->name('livros.index');

Route::resource('usuarios', UsuarioController::class);
Route::resource('livros', LivroController::class); // Esta linha já faz TUDO (incluindo o store)
Route::resource('emprestimos', EmprestimoController::class);