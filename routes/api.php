<?php

use Illuminate\Support\Facades\Route;


Route::get('/instituicoes', function () {
    return response()->json(['chave' => 'valor']);
});