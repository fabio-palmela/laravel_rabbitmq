<?php
namespace App\Application\UseCases;

use App\Infra\Broken\Queue;
class AnaliseRiscoUseCase
{
    private Queue $queue;
    private Queue $alcada_um;
    private Queue $preAprovado;

    public function __construct($queue, $alcada_um, $preAprovado){
        $this->queue = $queue;
        $this->alcada_um = $alcada_um;
        $this->preAprovado = $preAprovado;
    }

    public function validarAlcada(){
        $callback = function ($msg) {
            $data = json_decode($msg->body);
            $this->preAprovado->publish(json_encode($data));
                
            echo "Simulação no valor total de R$ {$data->valor_credito} processada.\n";
        };
        $this->queue->on($callback);
        
        // switch($params['valor_credito']){
        //     case $params['valor_credito'] <= 500:
        //         //Registrar fila para envio de email de crédito concedido.
        //     case $params['valor_credito'] > 500 && $params['valor_credito'] <= 1500:
        //         //salvar em model no banco
        //         //Registrar fila para aprovação de crédito nível 1.
        //         $this->queue->publish();
        //     case $params['valor_credito'] > 1500:
        //         //salvar em model no banco
        //         //Registrar fila para aprovação de crédito nível 2.
        // }
    }

}
