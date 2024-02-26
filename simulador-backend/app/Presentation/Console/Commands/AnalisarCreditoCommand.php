<?php

namespace App\Presentation\Console\Commands;

use Illuminate\Console\Command;
use App\Infra\Broken\SimularQueue;
use App\Infra\Broken\PreAprovadoQueue;
use App\Infra\Broken\AnalisarCreditoQueue;
use App\Application\UseCases\AnaliseRiscoUseCase;

class AnalisarCreditoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:analisar-credito';

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
        $preAprovadoQueue = new PreAprovadoQueue();
        $analisarCreditoQueue = new AnalisarCreditoQueue();
        $simularQueue = new SimularQueue();
        $analiseRisco = new AnaliseRiscoUseCase(
            $simularQueue, 
            $analisarCreditoQueue,
            $preAprovadoQueue
        );
        $analiseRisco->validarAlcada();
    }
}
