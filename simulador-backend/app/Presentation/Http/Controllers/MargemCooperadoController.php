<?php

namespace App\Presentation\Http\Controllers;

use Illuminate\Http\Request;
use App\Infra\Broken\SimularQueue;
use App\Infra\Broken\AtualizaMargemQueue;
use App\Application\UseCases\SimularUseCase;
use Symfony\Component\HttpFoundation\Response;
use App\Presentation\Http\Controllers\Controller;
use App\Application\UseCases\AtualizarMargemUseCase;
use App\Infra\Repositories\EmprestimoRepositoryEloquent;
use Exception;

class MargemCooperadoController extends Controller
{
    public function __construct(){

    }

    public function atualizar(Request $request){
        try{

            $input = $request->input();
            $emprestimoRepository = new EmprestimoRepositoryEloquent();
            $margemQueue = new AtualizaMargemQueue();
            $atualizarMargemUseCase = new AtualizarMargemUseCase(
                $margemQueue,
                $emprestimoRepository
            );
            $atualizarMargemUseCase->handle($input);
            return response()->json([
                'status' => 'Sucesso',
                'message' => 'Margem atualizada com sucesso.'
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'Error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
