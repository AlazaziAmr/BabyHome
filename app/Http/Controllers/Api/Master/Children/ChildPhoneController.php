<?php

namespace App\Http\Controllers\Api\Master\Children;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Master\Children\ChildPhoneRequest;
use App\Http\Resources\Api\Master\Children\ChildPhoneResource;
use App\Models\Api\Master\Phone;
use App\Repositories\Interfaces\Api\Master\IChildPhoneRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChildPhoneController extends Controller
{

    private $childPhoneRepository;

    public function __construct(IChildPhoneRepository $childPhoneRepository)
    {
        $this->childPhoneRepository = $childPhoneRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($child_id)
    {
        //
        try {
            return JsonResponse::successfulResponse('', ChildPhoneResource::collection($this->childPhoneRepository->fetchForChild($child_id,['relationType'])));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChildPhoneRequest $request)
    {
        //
        try {
            return JsonResponse::successfulResponse('msg_created_succssfully',$this->childPhoneRepository->createRequest($request->validated()));
        }catch (\Exception $e){
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChildPhoneRequest $request, $id)
    {
        try {
            $this->childPhoneRepository->update($request->validated(),$id);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        }catch (\Exception $e){
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->childPhoneRepository->delete($id);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
