<?php
namespace App\Application\UseCases;

use App\Domain\Repositories\EmprestimoInterface;
use App\Infra\Broken\Queue;

class SimularUseCase
{
    private Queue $queue;
    private EmprestimoInterface $emprestimoRepository;

    public function __construct($queue, $emprestimoRepository){
        $this->queue = $queue;
        $this->emprestimoRepository = $emprestimoRepository;
    }
    
    public function simular($data){
        $this->emprestimoRepository->salvar($data);
        $msg = json_encode($data);
        $this->queue->publish($msg);
    }

}
