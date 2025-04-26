<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; //validao do parametro

class SimCreditoController extends Controller
{
    // funcao da rota instituicoes
    public function instituicoes()
    {
        //consumindo o file de convenios do json de resources
        $instituicoes = file_get_contents(resource_path('json/instituicoes.json'));
        $dados = json_decode($instituicoes, true);
    
        return response()->json($dados);
    }

    // funcao da rota convenios
    public function convenios()
    {
        //consumindo o file de convenios do json de resources
        $convenios = file_get_contents(resource_path('json/convenios.json'));
        $dados = json_decode($convenios, true);

        return response()->json($dados);
    }

    //funcao da rota simulacao
    public function simulacao(Request $request)
    {
        $dados = $request->validate([
            'valor_emprestimo' => 'required|numeric', // nao tem float no validator
            'instituicoes' => 'array',
            'convenios' => 'array',
            'parcela' => 'integer', // por ser parcela em meses, precisa ser inteiro
        ]);

        //consumindo o file taxas_instituicoes do json de resources
        $simulacao = file_get_contents(resource_path('json/taxas_instituicoes.json'));
        $simulacoes = json_decode($simulacao, true);

        $resultado = [];
     

        foreach ($simulacoes as $simulacao) {

            if (isset($dados['instituicoes']) && !in_array($simulacao['instituicao'], $dados['instituicoes'])) {
                continue;
            }

            if (isset($dados['convenios']) && !in_array($simulacao['convenio'], $dados['convenios'])) {
                continue;
            }

            if (isset($dados['parcela']) && $simulacao['parcelas'] != $dados['parcela']) {
                continue;
            }

            // valor solicitado multiplicado pelo valor do coeficiente
            $valorParcela = $dados['valor_emprestimo'] * $simulacao['coeficiente'];

            $item = [
                'parcelas' => $simulacao['parcelas'],
                'taxaJuros' => $simulacao['taxaJuros'],
                'coeficiente' => $simulacao['coeficiente'],
                'convenio' => $simulacao['convenio'],
                'valor_parcela' => round($valorParcela, 2), // valor monetário, em 2 casas decimais
            ];

            $instituicao = $simulacao['instituicao'];
            $resultado[$instituicao][] = $item;
        }
        return response()->json($resultado);
    }

}
