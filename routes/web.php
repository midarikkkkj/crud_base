<?php

use App\Http\Controllers\PessoaController;
use Illuminate\Support\Facades\Route;

// A página inicial manda direto para a lista
Route::redirect('/', '/pessoas');
// Tudo aqui exige estar logado (middleware "auth")
Route::middleware('auth')->group(function () {
    // Listar: qualquer usuário logado (comum ou admin)
    Route::get('/pessoas', [PessoaController::class, 'index'])->name('pessoas.index');
    // Criar, editar e excluir: só admin (regra "admin" do Gate)
    Route::middleware('can:admin')->group(function () {
        Route::resource('pessoas', PessoaController::class)->except(['index', 'show']);
    });
});
