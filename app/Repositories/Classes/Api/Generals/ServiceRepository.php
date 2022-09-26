<?php

namespace App\Repositories\Classes\Api\Generals;

use App\Models\Api\Generals\Service;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Generals\IServiceRepository;


class ServiceRepository extends BaseRepository implements IServiceRepository
{
    public function model()
    {
        return Service::class;
    }
    public function fetchAllFromAdmin($with = [], $columns = array('*'))
    {
        $query = $this->model;
        return !empty($with) ? $query->where('user_id', null)->with($with)->get($columns) : $query->where('user_id', null)->get($columns);
    }
    public function createRequest($request)
    {
        $activity = $this->model->create([
            // 'name' => $request['name'],
            'description' => $request['description'],
            'unit' => $request['unit'] ?? null,
            'price' => $request['price'] ?? null,
            'is_paid' => $request['is_paid'],
            // 'is_active' => $request['is_active'],
            'type_id' =>  $request['type_id'],
            'user_id' =>  user()->id ?? null,
        ]);
        if (!empty($request['attachments'])) uploadAttachment($activity, $request, 'attachments', 'activities');
    }
}
