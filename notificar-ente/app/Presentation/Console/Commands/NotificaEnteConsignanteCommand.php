<?php

namespace App\Presentation\Console\Commands;

use App\Presentation\Mail\Mailtrap;
use App\Application\UseCases\NotificaEnteUseCase;
use App\Infra\Broken\NotificaEnteService\EmailEnteConsignanteConsumer;

class NotificaEnteConsignanteCommand{

    public function handle()
    {
        try{

            $enteConsignanteQueue = new EmailEnteConsignanteConsumer();
            $callback = function ($msg) use ($enteConsignanteQueue){
                $data = json_decode($msg->body);
                $mailtrap = new Mailtrap();
                $notificaEnteUseCase = new NotificaEnteUseCase($mailtrap);
                $notificaEnteUseCase->handle($data);
                $enteConsignanteQueue->acknowledge($msg);
            };
            
            $enteConsignanteQueue->on($callback);
        } catch(\Exception $e){
            var_dump($e->getMessage());
        }
    }
}
