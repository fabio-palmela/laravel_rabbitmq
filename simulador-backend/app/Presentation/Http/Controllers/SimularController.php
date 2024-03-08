<?php

namespace App\Presentation\Http\Controllers;

use Illuminate\Http\Request;
use App\Infra\Broken\SimuladorService\SimularQueue;
use App\Application\UseCases\SimularUseCase;
use Symfony\Component\HttpFoundation\Response;
use App\Presentation\Http\Controllers\Controller;
use App\Infra\Repositories\EmprestimoRepositoryEloquent;
use App\Infra\Broken\SimuladorService\EmailEnteConsignanteQueue;

class SimularController extends Controller
{
    public function __construct(){

    }

    public function simular(Request $request){
        $input = $request->input();
        $qtde = isset($input['num_simulacoes']) ? $input['num_simulacoes'] : 1;
        // return response()->json($input, 200);
        $simularUseCase = new SimularUseCase(
            new SimularQueue(),
            new EmprestimoRepositoryEloquent()
        );
        $input['cnpj_ente_consignante'] = $this->formatCnpj($input['cnpj_ente_consignante']);
        for($i = 0; $i < $qtde; $i++){
            $simularUseCase->simular($input);
        }

        return response()->json([
			'status' => 'Sucesso',
			'message' => 'Simulação realizada com sucesso.'
		], Response::HTTP_OK);
    }

    function formatCnpj($cnpj) {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        return $cnpj;
    }

}
