<?php

namespace App\Http\Controllers\Api\Admin\Nurseries;

use Illuminate\Http\Request;
use App\Helpers\JsonResponse;
use App\Models\Api\Admin\Admin;
use App\Http\Controllers\Controller;
use App\Models\Api\Nurseries\Nursery;
use App\Http\Requests\Api\Admin\Nursery\AssignRequest;
use App\Http\Resources\Api\Admin\Nurseries\AdminNurseryResource;
use App\Http\Resources\Api\Admin\Nurseries\SingleAdminNurseryResource;
use App\Repositories\Interfaces\Api\Nurseries\INurseryRepository;

class AdminNurseryController extends Controller
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
            return JsonResponse::successfulResponse('', AdminNurseryResource::collection($this->nurseryRepository->fetchAllForAdmin(['country:id,name', 'city:id,name', 'neighborhood:id,name', 'owner:id,name,phone,email'])));
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
    public function show(Nursery $nursery)
    {
        try {
            $nursery = new SingleAdminNurseryResource($nursery->load([
                'country:id,name', 'city:id,name', 'neighborhood:id,name',
                'owner:id,name,phone,email',
                'owner.info:id,user_id,years_of_experince,date_of_birth',
                'owner.info.attachmentable:id,attachmentable_id,title,description,path',
                'owner.info.languages:id,name', 'owner.info.skills:babysitter_id,id,description',
                'owner.info.qualifications:id,babysitter_id,qualification_id,description',
                'owner.info.qualifications.qualification:id,name',
                'amenitiesInfo:amenity_id,name,is_required',
                'services',
                'services.type',
                'services.attachmentable',
                'utilities:id,name',
            ]));
            return JsonResponse::successfulResponse('msg_success', $nursery);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * activate the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function activate(Nursery $nursery)
    {
        try {
            $this->nurseryRepository->update(['status' => 5], $nursery['id']);
            // TODO:send message to the customer
            return JsonResponse::successfulResponse('msg_activated_succssfully');
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
    public function destroy(Nursery $nursery)
    {
        try {
            $this->nurseryRepository->update(['status' => 4], $nursery['id']);

            // $this->nurseryRepository->delete($nursery['id']);
            return JsonResponse::successfulResponse('msg_suspended_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * assign the specified resource to specified admin.
     *
     * @param  Nursery $nursery
     * @param  Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function assignTo(AssignRequest $request)
    {
        try {
            $this->nurseryRepository->assignTo($request->validated());
            $this->nurseryRepository->update(['status' => 1], $request->validated()['nursery']);

            return JsonResponse::successfulResponse('msg_assigned_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
