<?php

namespace App\Presentation\Console\Commands;

use App\Presentation\Mail\Mailtrap;
use App\Application\UseCases\NotificaCooperadoUseCase;
use App\Infra\Broken\NotificaCooperadoService\EmailCooperadoConsumer;

class NotificaCooperadoCommand{

    public function handle()
    {
        try{

            $enteCooperadoQueue = new EmailCooperadoConsumer();
            $callback = function ($msg) use ($enteCooperadoQueue){
                $data = json_decode($msg->body);
                $mailtrap = new Mailtrap();
                $notificaCooperadoUseCase = new NotificaCooperadoUseCase($mailtrap);
                $notificaCooperadoUseCase->handle($data);
                $enteCooperadoQueue->acknowledge($msg);
            };
            
            $enteCooperadoQueue->on($callback);
        } catch(\Exception $e){
            var_dump($e->getMessage());
        }
    }
}
