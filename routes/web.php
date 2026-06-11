<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\EmprestimoController;

// --- Rotas de Autenticação ---
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// --- Rotas do Sistema (CRUDs) ---
// O Resource já cria automaticamente as rotas: index, create, store, edit, update e destroy
Route::resource('usuarios', UsuarioController::class);
Route::resource('livros', LivroController::class);
Route::resource('emprestimos', EmprestimoController::class);