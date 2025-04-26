<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SimCreditoController extends Controller
{
    // funcao da rota instituicoes
    public function instituicoes()
    {
        $instituicoes = file_get_contents(resource_path('json/instituicoes.json'));
        $dados = json_decode($instituicoes, true);
    
        return response()->json($dados);
    }

    // funcao da rota convenios
    public function convenios()
    {
        $convenios = file_get_contents(resource_path('json/convenios.json'));
        $dados = json_decode($convenios, true);

        return response()->json($dados);
    }

}
