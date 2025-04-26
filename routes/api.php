<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SimCreditoController;

Route::get('/instituicoes',[SimCreditoController::class, 'instituicoes']);

Route::get('/convenios',[SimCreditoController::class, 'convenios']);

