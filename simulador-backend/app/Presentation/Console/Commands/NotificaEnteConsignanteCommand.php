<?php

namespace App\Presentation\Console\Commands;

use Illuminate\Console\Command;
use App\Infra\Broken\NotificaEnteService\CalcularQueue;
use App\Application\UseCases\NotificaEnteUseCase;
use App\Infra\Broken\EmailCooperadoService\EmailEnteConsignanteQueue;

class NotificaEnteConsignanteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notificaente';

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

            $calcularQueue = new CalcularQueue();
            $callback = function ($msg) use ($calcularQueue){
                $data = json_decode($msg->body);
                $EmailEnteConsignanteQueue = new EmailEnteConsignanteQueue();
                $notificaEnteUseCase = new NotificaEnteUseCase();
                $notificaEnteUseCase->handle($data);
                $calcularQueue->acknowledge($msg);
            };
            
            $calcularQueue->on($callback);
        } catch(\Exception $e){
            dd($e->getMessage());
        }
    }
}
