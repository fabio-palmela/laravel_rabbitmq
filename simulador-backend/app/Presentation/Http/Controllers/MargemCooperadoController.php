<?php

namespace App\Presentation\Http\Controllers;

use App\Application\UseCases\AtualizarMargemUseCase;
use Illuminate\Http\Request;
use App\Infra\Broken\SimularQueue;
use App\Infra\Broken\AtualizaMargemQueue;
use App\Application\UseCases\SimularUseCase;
use Symfony\Component\HttpFoundation\Response;
use App\Presentation\Http\Controllers\Controller;

class MargemCooperadoController extends Controller
{
    public function __construct(){

    }

    public function atualizar(Request $request){
        $input = $request->input();
    
        $margemQueue = new AtualizaMargemQueue();
        $atualizarMargemUseCase = new AtualizarMargemUseCase($margemQueue);
        $atualizarMargemUseCase->handle($input);
        return response()->json([
			'status' => 'Sucesso',
			'message' => 'Margem atualizada com sucesso.'
		], 200);
    }
}
