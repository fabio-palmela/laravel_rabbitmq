<?php
namespace App\Domain\Repositories;

interface ParcelasInterface
{
    public function salvar($input, $simulacaoId);
}
