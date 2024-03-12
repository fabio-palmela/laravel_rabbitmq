<?php 

namespace App\Infra\Repositories;

use App\Domain\Repositories\ParcelasInterface;
use App\Infra\Models\parcelas;

class ParcelasRepositoryEloquent implements ParcelasInterface{
    public function __construct(){

    }

    public function salvar($input){
        $simulacaoId = $input->data->simulacaoId;
        $prestacoes = $input->prestacoes;
        foreach($prestacoes as $prestacao){
            $parcelas = new Parcelas();
            $parcelas->mes = isset($prestacao->mes) ? $prestacao->mes : 0;
            $parcelas->prestacao_mensal = isset($prestacao->prestacaoMensal) ? $prestacao->prestacaoMensal : 0;
            $parcelas->juros_mensais = isset($prestacao->jurosMensais) ? $prestacao->jurosMensais : 0;
            $parcelas->amortizacao = isset($prestacao->amortizacao) ? $prestacao->amortizacao : 0;
            $parcelas->saldo_devedor = isset($prestacao->saldoDevedor) ? $prestacao->saldoDevedor : 0;
            $parcelas->simulacaoId = $simulacaoId;
            $parcelas->save();
        }
    }
}