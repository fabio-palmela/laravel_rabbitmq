<?php
namespace App\Application\UseCases;

use App\Domain\Repositories\ParcelasInterface;
use App\Domain\Repositories\EmprestimoInterface;

class ConfirmaSimulacaoUseCase
{
    private ParcelasInterface $parcelasRepository;
    private EmprestimoInterface $emprestimoRepository;

    public function __construct($parcelasRepository, $emprestimoRepository){
        $this->parcelasRepository = $parcelasRepository;
        $this->emprestimoRepository = $emprestimoRepository;
    }
    
    public function handle($data){
        if (
            isset($data->data->margem_cooperado)
        ){
            $data_emp = json_decode(json_encode($data->data), true);
            $simulacaoId = $this->emprestimoRepository->salvar($data_emp);
            $this->parcelasRepository->salvar($data, $simulacaoId);
        } else {
            $this->parcelasRepository->salvar($data, $data->data->simulacaoId);
            // var_dump($data->data->simulacaoId); die;
        }
        echo "Confirmação do cálculo da simulação no valor de R$ {$data->data->valor_credito}.\n";
    }

}
