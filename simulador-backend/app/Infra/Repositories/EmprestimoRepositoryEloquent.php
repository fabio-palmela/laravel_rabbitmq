<?php 

namespace App\Infra\Repositories;

use App\Domain\Repositories\EmprestimoInterface;
use App\Infra\Models\EmprestimoConsignado;
use Exception;

class EmprestimoRepositoryEloquent implements EmprestimoInterface{
    public function __construct(){

    }

    public function salvar($input){
        $emprestimo = new EmprestimoConsignado;
        $emprestimo->cpf_cooperado = $input['cpf_cooperado'];
        $emprestimo->cnpj_ente_consignante = $input['cnpj_ente_consignante'];
        $emprestimo->valor_credito = $input['valor_credito'];
        $emprestimo->taxa_juros = $input['taxa_juros'];
        $emprestimo->prazo = $input['prazo'];
        $emprestimo->mail_ente_consignante = $input['mail_ente_consignante'];
        $emprestimo->mail_cooperado = $input['mail_cooperado'];
        $emprestimo->save();
        return $emprestimo->id;
    }
    
    public function getSimulacaoPorCooperado($input){
        $simulacao = EmprestimoConsignado::where('cpf_cooperado', $input['cpf_cooperado'])->first();
        if (!$simulacao)
            throw new Exception('Simulação não encontrada para este cpf');
        return $simulacao->toArray();
    }
}