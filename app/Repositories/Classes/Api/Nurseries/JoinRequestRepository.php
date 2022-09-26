<?php

namespace App\Repositories\Classes\Api\Nurseries;

use App\Models\Api\Generals\Activity;
use App\Models\Api\Nurseries\JoinRequest\JoinRequest;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Nurseries\IJoinRequestRepository;

class JoinRequestRepository extends BaseRepository implements IJoinRequestRepository
{
    public function model()
    {
        return JoinRequest::class;
    }

    public function createRequest($request)
    {
        $joinRequest = $this->model->create([
            'nursery_id' => $request['nursery_id'],
            'master_id' => master()->id,
            'joining_date' => $request['joining_date']
        ]);

        // children
        if (!empty($request['children']))   $joinRequest->children()->sync($request['children']);

        // activities
        if (!empty($request['activities']))  $joinRequest->activities()->sync($request['activities']);

        // // services
        // if (!empty($request['services']))  $joinRequest->services()->sync($request['services']);

        // // foods
        // if (!empty($request['foods']))  $joinRequest->foods()->sync($request['foods']);

        // packages
        if (!empty($request['packages']))  $joinRequest->packages()->sync($request['packages']);
    }

    public function fetchCustomerRequest($id)
    {
        return user()->nurseries()->where('id', $id)->first()->joiningRequests()->where('is_approved', 0)->with('children','activities','packages')->get();
    }
}
