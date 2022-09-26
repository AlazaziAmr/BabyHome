<?php

namespace App\Http\Controllers\Api\Generals;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Generals\BankRequest;
use App\Http\Resources\Api\Generals\BankResource;
use App\Models\Api\Generals\Bank;
use App\Repositories\Interfaces\Api\Generals\IBankRepository;

class BankController extends Controller
{
    private $bankRepository;

    public function __construct(IBankRepository $bankRepository)
    {
        $this->bankRepository = $bankRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return JsonResponse::successfulResponse('', BankResource::collection($this->bankRepository->fetchAll()));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankRequest $request)
    {

        return JsonResponse::successfulResponse('msg_created_succssfully', $this->bankRepository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  Bank $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        try {
            $bank = new BankResource($bank);
            return JsonResponse::successfulResponse('msg_success', $bank);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Bank $bank
     * @return \Illuminate\Http\Response
     */
    public function update(BankRequest $request, Bank $bank)
    {
        try {
            $this->bankRepository->update($request->validated(), $bank['id']);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Bank $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        try {
            $this->bankRepository->delete($bank['id']);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
