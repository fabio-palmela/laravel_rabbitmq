<?php
namespace App\Application\UseCases;

use App\Domain\Repositories\EmprestimoInterface;
use App\Infra\Broken\Queue;
use App\Infra\Models\EmprestimoConsignado;

class SimularUseCase
{
    private Queue $queue;
    private Queue $notificaEnteConsignante;
    private EmprestimoInterface $emprestimoRepository;

    public function __construct($queue, $notificaEnteConsignante, $emprestimoRepository){
        $this->queue = $queue;
        $this->notificaEnteConsignante = $notificaEnteConsignante;
        $this->emprestimoRepository = $emprestimoRepository;
    }
    
    public function simular($data){
        $data = json_encode($data);
        $this->queue->publish($data);
        // $this->notificaEnteConsignante->publish($data);
        $this->emprestimoRepository->salvar($data);
    }

}
