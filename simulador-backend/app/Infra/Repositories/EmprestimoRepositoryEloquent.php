<?php 

namespace App\Infra\Repositories;

use App\Domain\Repositories\EmprestimoInterface;
use App\Infra\Models\EmprestimoConsignado;

class EmprestimoRepositoryEloquent implements EmprestimoInterface{
    public function __construct(){

    }

    public function salvar($input){
        $emprestimo = new EmprestimoConsignado;
        $emprestimo->cpf_cooperado = $input['cpf_cooperado'];
        $emprestimo->cnpj_ente_consignante = $input['cnpj_ente_consignante'];
        $emprestimo->valor_credito = $input['valor_credito'];
        $emprestimo->save();
    }
}