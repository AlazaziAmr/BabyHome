<?php

namespace App\Repositories\Classes\Api\Generals;

use App\Models\Api\Generals\Activity;
use App\Models\Api\Master\BookingServices\Booking;
use App\Models\Api\Nurseries\Nursery;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Generals\IActivityRepository;


class ActivityRepository extends BaseRepository implements IActivityRepository
{
    public function model()
    {
        return Activity::class;
    }
    public function fetchAllFromAdmin($with = [], $columns = array('*'))
    {
    }
    public function createRequest($request)
    {
        $activity = $this->model->create([
            'name' => $request['name'],
            'description' => $request['description'],
            'unit' => $request['unit'],
            'price' => $request['price'],
            'is_paid' => $request['is_paid'],
            // 'is_active' => $request['is_active'],
            'type_id' =>  $request['type_id'],
            'user_id' =>  user()->id ?? null,
        ]);
        if (!empty($request['attachments'])) uploadAttachment($activity, $request, 'attachments', 'activities');
    }

    public function index()
    {
        $user_id = auth('api')->user()->id;
        $nursery_id=Nursery::where('user_id',$user_id)->pluck('id');
        $activeBooking=Activity::whereIn("user_id",$nursery_id)->where('is_active', 1)->with([
            'attachmentable',
            'getMainAttachmentAttribute',
        ])->get();
        if ($activeBooking->isEmpty()) {
            return null;
        }else{
            return $activeBooking;
        }
    }
}
