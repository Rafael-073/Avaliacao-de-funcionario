<?php

use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\AvaliacaoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return redirect('/funcionarios'); });

// ===== FUNCIONÁRIOS =====
Route::get('/funcionarios',                    [FuncionarioController::class, 'index']);
Route::post('/funcionarios/salvar',            [FuncionarioController::class, 'salvar']);
Route::get('/funcionarios/editar/{id}',        [FuncionarioController::class, 'editar']);
Route::post('/funcionarios/atualizar/{id}',    [FuncionarioController::class, 'atualizar']);
Route::get('/funcionarios/visualizar/{id}',    [FuncionarioController::class, 'visualizar']);
Route::get('/funcionarios/apagar/{id}',        [FuncionarioController::class, 'apagar']);

// ===== AVALIAÇÕES =====
Route::get('/avaliacoes/criar/{funcionario_id}',          [AvaliacaoController::class, 'criar']);
Route::post('/avaliacoes/salvar/{funcionario_id}',        [AvaliacaoController::class, 'salvar']);