<?php
namespace App\Application\UseCases;

use App\Domain\Repositories\EmprestimoInterface;
use App\Infra\Broken\Queue;
class AtualizarMargemUseCase
{
    private Queue $queue;
    private EmprestimoInterface $emprestimoRepository;

    public function __construct($queue, $emprestimoRepository){
        $this->queue = $queue;
        $this->emprestimoRepository = $emprestimoRepository;
    }

    public function handle($data){
        $emprestimoMargem = $this->emprestimoRepository->getSimulacaoPorCooperado($data);
        $emprestimoMargem['simulacaoId'] = $emprestimoMargem['id'];
        $emprestimoMargem['margem_cooperado'] = $data['margem_cooperado'];
        $msg = json_encode($emprestimoMargem);
        $this->queue->publish($msg);
    }

}
