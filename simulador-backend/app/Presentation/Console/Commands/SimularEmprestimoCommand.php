<?php

namespace App\Presentation\Console\Commands;

use Illuminate\Console\Command;
use App\Infra\Broken\SimuladorService\SimularQueue;
use App\Application\UseCases\SimularUseCase;
use App\Infra\Repositories\EmprestimoRepositoryEloquent;

class SimularEmprestimoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:simular';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = [
            'valor_credito' => rand(400.00, 2000.00),
            'cpf_cooperado' => '05907569662',
            'num_simulacoes' => '1'
        ];
        $data = json_encode($data);

        $qtde = isset($data['num_simulacoes']) ? $data['num_simulacoes'] : 1;


        $simularUseCase = new SimularUseCase(
            new SimularQueue(),
            new EmprestimoRepositoryEloquent()
        );
        for($i = 0; $i < $qtde; $i++){
            $simularUseCase->simular($data);
        }

    }
}
