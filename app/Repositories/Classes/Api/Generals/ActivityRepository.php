<?php

namespace App\Repositories\Classes\Api\Generals;

use App\Models\Api\Generals\Activity;
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
        $query = $this->model;
        return !empty($with) ? $query->where('user_id', null)->with($with)->get($columns) : $query->where('user_id', null)->get($columns);
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
}
