<?php

namespace App\Presentation\Console\Commands;

use Illuminate\Console\Command;
use App\Application\UseCases\CalcularSimulacaoUseCase;
use App\Infra\Broken\CalcularEmprestimoService\CalcularQueue;
use App\Infra\Broken\CalcularEmprestimoService\ConsignadoCalculadoQueue;

class CalcularSimulacaoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:calcular';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
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
