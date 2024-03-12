<?php

namespace App\Presentation;

use App\Application\UseCases\CalcularSimulacaoUseCase;
use App\Infra\Broken\CalcularEmprestimoService\CalcularQueue;
use App\Infra\Broken\CalcularEmprestimoService\ConsignadoCalculadoQueue;

class CalcularSimulacaoCommand
{
    public function handle()
    {
        $calcularQueue = new CalcularQueue();
        $callback = function ($msg) use ($calcularQueue){
            $data = json_decode($msg->body);
            $consignadoCalculadoQueue = new ConsignadoCalculadoQueue();
            $simularUseCase = new CalcularSimulacaoUseCase($consignadoCalculadoQueue);
            $simularUseCase->calcular($data);
            $calcularQueue->acknowledge($msg);
        };
        
        $calcularQueue->on($callback);
    }
}
