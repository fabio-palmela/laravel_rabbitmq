<?php

namespace App\Presentation\Console\Commands;

use App\Application\UseCases\NotificaEnteUseCase;
use App\Infra\Broken\NotificaEnteService\EmailEnteConsignanteConsumer;

class NotificaEnteConsignanteCommand{

    public function handle()
    {
        try{

            $enteConsignanteQueue = new EmailEnteConsignanteConsumer();
            $callback = function ($msg) use ($enteConsignanteQueue){
                $data = json_decode($msg->body);
                $notificaEnteUseCase = new NotificaEnteUseCase();
                $notificaEnteUseCase->handle($data);
                $enteConsignanteQueue->acknowledge($msg);
            };
            
            $enteConsignanteQueue->on($callback);
        } catch(\Exception $e){
            var_dump($e->getMessage());
        }
    }
}
