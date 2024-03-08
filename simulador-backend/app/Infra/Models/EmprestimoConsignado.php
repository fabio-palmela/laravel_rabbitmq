<?php

namespace App\Infra\Models;

use Illuminate\Database\Eloquent\Model;

class EmprestimoConsignado extends Model
{
    protected $connection = 'simulador';

    protected $table = 'simulacao_consignado';

    protected $fillable = [
        'cpf_cooperado',
        'cnpj_ente_consignante',
        'valor_credito',
    ];

    protected $casts = [
        'valor_credito' => 'float',
    ];
}
