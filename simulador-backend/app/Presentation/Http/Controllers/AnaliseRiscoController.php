<?php

namespace App\Presentation\Http\Controllers;

use App\Presentation\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AnaliseRiscoController extends Controller
{
    public function __construct(){

    }

    public function analisarRiscoCredito(Request $request){
        $params = $request->input();
        switch($params['valor_credito']){
            case $params['valor_credito'] <= 500:
                //Registrar fila para envio de email de crédito concedido.
            case $params['valor_credito'] > 500 && $params['valor_credito'] <= 1500:
                //salvar em model no banco
                //Registrar fila para aprovação de crédito nível 1.
            case $params['valor_credito'] > 1500:
                //salvar em model no banco
                //Registrar fila para aprovação de crédito nível 2.
        }
        // channel.queue_declare(queue='revisao_manual_queue')
        // channel.basic_publish(exchange='', routing_key='revisao_manual_queue', body=str(dados))
        return 'Análise de risco: Encaminhado para revisão manual.';
    }
}
