<?php

namespace App\Presentation\Console\Commands;

use Illuminate\Console\Command;
use App\Application\UseCases\ConfirmaSimulacaoUseCase;
use App\Infra\Broken\SimuladorService\ConsignadoCalculadoQueue;
use App\Infra\Repositories\ParcelasRepositoryEloquent;

class ConfirmaSimulacaoConsignadoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:confirmasimulacao';

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
        try{

            $consignadoCalculadoQueue = new ConsignadoCalculadoQueue();
            $callback = function ($msg) use ($consignadoCalculadoQueue){
                $data = json_decode($msg->body);
                $parcelasRepository = new ParcelasRepositoryEloquent();
                $confirmaSimulacaoUseCase = new ConfirmaSimulacaoUseCase($parcelasRepository);
                $confirmaSimulacaoUseCase->handle($data);
                $consignadoCalculadoQueue->acknowledge($msg);
            };
            
            $consignadoCalculadoQueue->on($callback);
        } catch(\Exception $e){
            dd($e->getMessage());
        }

    }
}
