<?php
namespace App\Application\UseCases;

use App\Infra\Broken\Queue;
class AtualizarMargemUseCase
{
    private Queue $queue;

    public function __construct($queue){
        $this->queue = $queue;
    }

    public function handle($data){
        //atualiza margem e informa o cooperado
        $data = json_encode($data);
        $this->queue->publish($data);
    }

}
