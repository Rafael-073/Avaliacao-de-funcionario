<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\AvaliacaoController;

Route::get('/', function () {
    return redirect('/funcionarios');
});

/*
|--------------------------------------------------------------------------
| FUNCIONÁRIOS
|--------------------------------------------------------------------------
*/

Route::get('/funcionarios', [FuncionarioController::class, 'listar'])
    ->name('funcionarios.listar');

Route::get('/funcionarios/criar', [FuncionarioController::class, 'criar'])
    ->name('funcionarios.criar');

Route::post('/funcionarios/salvar', [FuncionarioController::class, 'salvar'])
    ->name('funcionarios.salvar');

Route::get('/funcionarios/editar/{id}', [FuncionarioController::class, 'editar'])
    ->name('funcionarios.editar');

Route::put('/funcionarios/atualizar/{id}', [FuncionarioController::class, 'atualizar'])
    ->name('funcionarios.atualizar');

Route::delete('/funcionarios/{id}', [FuncionarioController::class, 'apagar'])
    ->name('funcionarios.apagar');

Route::get('/funcionarios/visualizar/{id}', [FuncionarioController::class, 'visualizar'])
    ->name('funcionarios.visualizar');

/*
|--------------------------------------------------------------------------
| AVALIAÇÕES
|--------------------------------------------------------------------------
*/

Route::get(
    '/funcionarios/{id}/avaliacoes/criar',
    [AvaliacaoController::class, 'criar']
)->name('avaliacoes.criar');

Route::post(
    '/funcionarios/{id}/avaliacoes/salvar',
    [AvaliacaoController::class, 'salvar']
)->name('avaliacoes.salvar');