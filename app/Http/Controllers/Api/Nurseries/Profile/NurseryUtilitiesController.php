<?php

namespace App\Http\Controllers\Api\Nurseries\Profile;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Nurseries\NurseryUtilitiesRequest;
use App\Http\Resources\Api\Nurseries\Profile\NurseryUtilitiesResource;
use App\Models\Api\Nurseries\Nursery;
use App\Models\Api\Nurseries\NurseryUtility;
use Illuminate\Http\Request;

class NurseryUtilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(NurseryUtilitiesRequest $request)
    {
        //
        try {
            $nursery = Nursery::where('id',$request->nursery_id)->first();
            if ($nursery != null){
                $nursery->utilities()->detach();
                $nursery->utilities()->sync($request['utilities']);
                return JsonResponse::successfulResponse('msg_updated_successfully');
            }
            return JsonResponse::errorResponse('msg_not_found');
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
        try {
            $utilities = NurseryUtility::where('nursery_id',$id)->with('utility:id,name')->get();

            if ($utilities->count() > 0){
                return JsonResponse::successfulResponse('msg_success',NurseryUtilitiesResource::collection($utilities));
            }
            return JsonResponse::errorResponse('msg_not_found');
        }catch (\Exception $e){
            return JsonResponse::errorResponse($e->getMessage());
        }
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
