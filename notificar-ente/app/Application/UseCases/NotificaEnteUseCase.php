<?php
namespace App\Application\UseCases;

use App\Infra\Broken\Queue;
use App\Presentation\Mail\SimulacaoEmprestimoConsignadoMail;

class NotificaEnteUseCase
{
    private Queue $queue;

    public function __construct(){

    }

    public function handle($data){
        $userEmail = 'fabio.oliveira@credicom.com.br';
        $msg = json_encode($data);
        // \Illuminate\Support\Facades\Mail::to($userEmail)->send(new SimulacaoEmprestimoConsignadoMail($data));
        echo "Simulação no valor total de Notifica ente.\n";
    }
}
