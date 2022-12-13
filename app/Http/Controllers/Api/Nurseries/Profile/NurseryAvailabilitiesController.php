<?php

namespace App\Http\Controllers\Api\Nurseries\Profile;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Nurseries\NurseryAvailabilityRequest;
use App\Http\Resources\Api\Nurseries\Profile\NurseryAvailabilityResource;
use App\Models\Api\Nurseries\NurseryAvailability;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NurseryAvailabilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NurseryAvailabilityRequest $request)
    {
        //
        try {
            $from = Carbon::parse($request->from_hour);
            $to = Carbon::parse($request->to_hour);
            $data = $request->validated();
            $data['from_hour'] = gmdate('H:i', strtotime($from));
            $data['to_hour'] = gmdate('H:i', strtotime($to));
            $availabilties = NurseryAvailability::create($data);
            return JsonResponse::successfulResponse('msg_added_successfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            $availabilties = NurseryAvailability::with('day')->where('nursery_id', $id)->get();
            return JsonResponse::successfulResponse('', NurseryAvailabilityResource::collection($availabilties));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(NurseryAvailabilityRequest $request, $id)
    {
        //
        try {
            $from = Carbon::parse($request->from_hour);
            $to = Carbon::parse($request->to_hour);
            $data = $request->validated();
            $data['from_hour'] = gmdate('H:i', strtotime($from));
            $data['to_hour'] = gmdate('H:i', strtotime($to));

            $availabilties = NurseryAvailability::findOrFail($id);
            $availabilties->update($data);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $availability = NurseryAvailability::findOrFail($id);
            $availability->delete();
            return JsonResponse::successfulResponse('msg_deleted_successfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
