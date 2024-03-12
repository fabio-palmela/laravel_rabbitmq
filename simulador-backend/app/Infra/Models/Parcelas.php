<?php

namespace App\Infra\Models;

use Illuminate\Database\Eloquent\Model;

class Parcelas extends Model
{
    protected $connection = 'simulador';

    protected $table = 'parcelas';

    protected $fillable = [
        'mes',
        'prestacao_mensal',
        'juros_mensais',
        'amortizacao',
        'saldo_devedor',
        'simulacaoId'
    ];
}
