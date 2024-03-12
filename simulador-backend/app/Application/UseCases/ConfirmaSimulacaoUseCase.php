<?php
namespace App\Application\UseCases;

use App\Domain\Repositories\ParcelasInterface;

class ConfirmaSimulacaoUseCase
{
    private ParcelasInterface $parcelasRepository;

    public function __construct($parcelasRepository){
        $this->parcelasRepository = $parcelasRepository;
    }
    
    public function handle($data){
        $this->parcelasRepository->salvar($data);
    }

}
