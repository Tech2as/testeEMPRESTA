<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SimCreditoController;

// Rotas solicitadas no teste
Route::get('/instituicoes',[SimCreditoController::class, 'instituicoes']);
Route::get('/convenios',[SimCreditoController::class, 'convenios']);
Route::post('/simulacao', [SimCreditoController::class, 'simulacao']);

