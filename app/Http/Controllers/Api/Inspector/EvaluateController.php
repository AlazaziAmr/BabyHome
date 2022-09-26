<?php

namespace App\Http\Controllers\Api\Inspector;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Inspector\EvaluationRequest;
use App\Repositories\Interfaces\Api\Inspector\INurseryEvaluationRepository;
use Illuminate\Http\Request;


class EvaluateController extends Controller
{
    private $evaluationRepository;

    public function __construct(INurseryEvaluationRepository $evaluationRepository)
    {
        $this->evaluationRepository = $evaluationRepository;
    }
    public function store(EvaluationRequest $request){
        return JsonResponse::successfulResponse('created_successfully', $this->evaluationRepository->create($request->validated()));
    }
}
