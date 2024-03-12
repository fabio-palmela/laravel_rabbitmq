<?php 

namespace App\Infra\Repositories;

use App\Domain\Repositories\EmprestimoInterface;
use App\Infra\Models\EmprestimoConsignado;

class EmprestimoRepositoryEloquent implements EmprestimoInterface{
    public function __construct(){

    }

    public function salvar($input){
        $emprestimo = new EmprestimoConsignado;
    
        // Definindo os valores dos atributos
        $emprestimo->cpf_cooperado = "12345678900";
        $emprestimo->cnpj_ente_consignante = "123456789014";
        $emprestimo->valor_credito = $input['valor_credito'];
    
        // Salvando o registro no banco de dados
        $emprestimo->save();
    }
}