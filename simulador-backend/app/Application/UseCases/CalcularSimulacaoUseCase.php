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
        // \Illuminate\Support\Facades\Log::emergency($date);
        $prestacoes = $this->calcularPrestacoes($data->valor_credito, $data->taxa_juros, $data->prazo);
        // $dataResponse = array_merge(
        //     $data,
        //     ['prestacoes' => $prestacoes]
        // );
        // $msg = json_encode($dataResponse);
        $msg = json_encode($prestacoes);
        $this->queue->publish($msg);
        // dd($msg->valor_credito);
        echo "Simulação no valor total de R$ {$data->valor_credito} processada.\n";
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
