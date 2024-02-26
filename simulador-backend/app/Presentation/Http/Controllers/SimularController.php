<?php

namespace App\Presentation\Http\Controllers;

use Illuminate\Http\Request;
use App\Infra\Broken\SimuladorService\SimularQueue;
use App\Application\UseCases\SimularUseCase;
use Symfony\Component\HttpFoundation\Response;
use App\Presentation\Http\Controllers\Controller;
use App\Infra\Repositories\EmprestimoRepositoryEloquent;
use App\Infra\Broken\SimuladorService\EmailEnteConsignanteQueue;

class SimularController extends Controller
{
    public function __construct(){

    }

    public function simular(Request $request){
        $input = $request->input();
        $qtde = isset($input['num_simulacoes']) ? $input['num_simulacoes'] : 1;

        $simularUseCase = new SimularUseCase(
            new SimularQueue(),
            new EmailEnteConsignanteQueue(),
            new EmprestimoRepositoryEloquent()
        );
        for($i = 0; $i < $qtde; $i++){
            $simularUseCase->simular($input);
        }

        $valorEmprestimo = 10000;
        $taxaJuros = 0.02;
        $prazoMeses = 12;

        $listaPrestacoes = $this->calcularPrestacoes($valorEmprestimo, $taxaJuros, $prazoMeses);

        return response()->json([
			'status' => 'Sucesso',
			'message' => 'AAAAAA',
            'content' => $listaPrestacoes
		], 200);
    }

    function calcularPrestacoes($valorEmprestimo, $taxaJuros, $prazoMeses) {
        // Convertendo a taxa de juros para a forma decimal
        $taxaDecimal = $taxaJuros / 100;
        
        // Calculando a prestação mensal usando a fórmula de amortização constante (sistema PRICE)
        $prestacaoMensal = ($valorEmprestimo * $taxaDecimal) / (1 - pow(1 + $taxaDecimal, -$prazoMeses));
    
        // Inicializando a lista de prestações
        $prestacoes = [];
    
        // Calculando e armazenando cada prestação individual
        for ($i = 1; $i <= $prazoMeses; $i++) {
            $jurosMensais = ($valorEmprestimo - (array_sum(array_column($prestacoes, 'amortizacao')))) * $taxaDecimal;
            $amortizacao = $prestacaoMensal - $jurosMensais;
            $saldoDevedor = $valorEmprestimo - $amortizacao * $i;
    
            // Adicionando a prestação atual à lista de prestações
            $prestacoes[] = [
                'mes' => $i,
                'prestacaoMensal' => round($prestacaoMensal, 2),
                'jurosMensais' => round($jurosMensais, 2),
                'amortizacao' => round($amortizacao, 2),
                'saldoDevedor' => round($saldoDevedor, 2),
            ];
        }
    
        return $prestacoes;
    }
}
