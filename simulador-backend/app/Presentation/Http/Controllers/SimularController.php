<?php

namespace App\Presentation\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Application\UseCases\SimularUseCase;
use Symfony\Component\HttpFoundation\Response;
use App\Presentation\Http\Controllers\Controller;
use App\Infra\Broken\SimuladorService\SimularQueue;
use App\Infra\Repositories\EmprestimoRepositoryEloquent;
use App\Infra\Broken\SimuladorService\EmailEnteConsignanteQueue;

class SimularController extends Controller
{
    public function __construct(){

    }

    public function simular(Request $request){
        try{
            DB::beginTransaction();
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
            DB::commit();
            return response()->json([
                'status' => 'Sucesso',
                'message' => 'Simulação realizada com sucesso.'
            ], Response::HTTP_OK);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => 'Error',
                'message' => 'Erro ao realizar a simulação.',
                'message_error' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    function formatCnpj($cnpj) {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        return $cnpj;
    }

}
