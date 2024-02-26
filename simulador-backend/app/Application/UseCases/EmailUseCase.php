<?php
namespace App\Application\UseCases;

use App\Infra\Broken\Queue;
use App\Presentation\Mail\SimulacaoEmprestimoConsignadoMail;

class EmailUseCase
{
    private Queue $queue;

    public function __construct(){
        // $this->queue = $queue;
    }
    // public function __construct($queue){
    //     $this->queue = $queue;
    // }

    public function send($data){
        $userEmail = 'fabio.oliveira@credicom.com.br';
        \Illuminate\Support\Facades\Log::emergency($userEmail);
        \Illuminate\Support\Facades\Mail::to($userEmail)->send(new SimulacaoEmprestimoConsignadoMail($data));
    }

}
