<?php
namespace App\Application\UseCases;

use App\Infra\Broken\Queue;

class CalcularSimulacaoUseCase
{
    private Queue $queue;

    public function __construct($queue){
        $this->queue = $queue;
    }

    public function calcular($data){
        $valor_credito = ($data->margem_cooperado > $data->valor_credito) ? $data->margem_cooperado : $data->valor_credito;
        $prestacoes = $this->calcularPrestacoes($valor_credito, $data->taxa_juros, $data->prazo);
        $msg = json_encode($prestacoes);
        $this->queue->publish($msg);
        echo "Simulação no valor total de R$ {$valor_credito} processada.\n";
    }

    function calcularPrestacoes($valorEmprestimo, $taxaJuros, $prazoMeses) {
        $taxaDecimal = $taxaJuros / 100;
        
        $prestacaoMensal = ($valorEmprestimo * $taxaDecimal) / (1 - pow(1 + $taxaDecimal, -$prazoMeses));
    
        $prestacoes = [];
    
        for ($i = 1; $i <= $prazoMeses; $i++) {
            $jurosMensais = ($valorEmprestimo - (array_sum(array_column($prestacoes, 'amortizacao')))) * $taxaDecimal;
            $amortizacao = $prestacaoMensal - $jurosMensais;
            $saldoDevedor = $valorEmprestimo - $amortizacao * $i;
    
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
