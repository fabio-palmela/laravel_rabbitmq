<?php
namespace App\Domain\Repositories;

interface EmprestimoInterface
{
    public function salvar($input);
    public function getSimulacaoPorCooperado($input);
}
