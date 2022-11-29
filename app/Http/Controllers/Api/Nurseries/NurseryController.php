<?php

namespace App\Http\Controllers\Api\Nurseries;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Nurseries\NurseryRequest;
use App\Http\Resources\Api\Generals\ActivityResource;
use App\Http\Resources\Api\Master\Children\ChildResource;
use App\Http\Resources\Api\Master\Nursery\PackageResource;
use App\Http\Resources\Api\Nurseries\AllNurseriesResources;
use App\Http\Resources\Api\Nurseries\NurseryResource;
use App\Http\Resources\Api\Nurseries\NurseryResourceCollection;
use App\Models\Api\Generals\PackagesType;
use App\Models\Api\Nurseries\JoinRequest\JoinRequest;
use App\Models\Api\Nurseries\Nursery;
use App\Repositories\Interfaces\Api\Nurseries\INurseryRepository;
use Illuminate\Http\Request;

class NurseryController extends Controller
{
    private $nurseryRepository;

    public function __construct(INurseryRepository $nurseryRepository)
    {
        $this->nurseryRepository = $nurseryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return JsonResponse::successfulResponse('', NurseryResource::collection($this->nurseryRepository->fetchAllForCurrentUser(['country', 'city', 'neighborhood','owner'])));
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
    public function store(NurseryRequest $request)
    {
        try {
            if(user()->id){
                return $this->nurseryRepository->createRequest($request->
                validated())['status'] ? JsonResponse::successfulResponse('msg_created_successfully'):
                    JsonResponse::errorResponse($this->nurseryRepository->createRequest($request->validated())['error']);
            }else{
                return JsonResponse::errorResponse('Unauthenticated');
            }
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Nursery $nursery
     * @return \Illuminate\Http\Response
     */
    public function show(Nursery $nurseries)
    {
        try {
            $nurseries = new NurseryResource($nurseries->with(['country', 'city', 'neighborhood','owner'])->firstOrFail());
            return JsonResponse::successfulResponse('msg_success', $nurseries);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function nurseryProfile(Request $request){
        $user_id = auth('api')->user()->id;
        try {
            return JsonResponse::successfulResponse('', $this->nurseryRepository->profile($user_id));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Nursery $nursery
     * @return \Illuminate\Http\Response
     */
    public function update(NurseryRequest $request, Nursery $nurseries)
    {
        try {
            $this->nurseryRepository->update($request->validated(), $nurseries['id']);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Nursery $nursery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nursery $nurseries)
    {
        try {
            $this->nurseryRepository->delete($nurseries['id']);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
    /**
     * Display the nearest nurseries.
     * @return \Illuminate\Http\Response
     */
    public function nurseriesCloseToMaster()
    {
        try {
            $data = $this->nurseryRepository->nurseriesCloseToMaster(['country', 'city', 'neighborhood','owner:id,name','babysitter','babySitter.attachmentable']);
//            echo json_encode($data);
//            return;
            return JsonResponse::successfulResponse('', AllNurseriesResources::collection($data));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPackages(Nursery $nursery, PackagesType $type)
    {
        try {
            return JsonResponse::successfulResponse('', PackageResource::collection($nursery->packagesOfType($type['id'])->load('type')));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getActivities(Nursery $nursery)
    {
        try {
            return JsonResponse::successfulResponse('', ActivityResource::collection($nursery->customerActivities()));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approveJoinigRequest($id)
    {
        try {
            $this->nurseryRepository->approveJoinigRequest($id);

            return JsonResponse::successfulResponse('done');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNurseryChildren(Request $request, Nursery $nursery)
    {
        try {
            // TODO:validate type_id
            return JsonResponse::successfulResponse('', ChildResource::collection($this->nurseryRepository->getRegisteredChildren($request, $nursery['id'])));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
