<?php

namespace App\Repositories\Classes\Api\Admin;

use App\Models\Api\Admin\Admin;
use App\Repositories\Classes\BaseRepository;
use App\Models\Api\Admin\Inspections\Inspection;
use App\Models\Api\Admin\Inspections\InspectionResult;
use App\Repositories\Interfaces\Api\Admin\IInspectionRepository;

class InspectionRepository extends BaseRepository implements IInspectionRepository
{
    public function model()
    {
        return Inspection::class;
    }

    public function fetchAllForAuthAdmin()
    {
        return admin()->inspectionOrders()->with(['nursery.owner'])->get(['id', 'notes', 'nursery_id', 'status', 'from', 'to']);
    }

    public function submitResult($result)
    {
        $inspection = $this->model->where('id', $result['inspection_id'])->first();

        $resultObject = $inspection->result()->create([
            'inspection_id' =>  $result['inspection_id'],
            'latitude' =>  $result['latitude'],
            'longitude' =>  $result['longitude'],
        ]);

        foreach ($result['result'] as $key => $value) {
            $resultObject->details()->create([
                'criteria' => $key,
                'rating' => $value['rating'],
                'matching' => $value['matching'],
                'recommendation' => $value['recommendation'],
                'comment' => $value['comment'],
            ]);
        }
        if (!empty($result['attachments'])) uploadAttachment($resultObject, $result, 'attachments', 'inspections-results');

        return true;
    }


    public function getResult($request)
    {
        $model = $this->model->where('nursery_id', $request['nursery_id'])->with('result', 'inspector', 'result.details', 'result.attachmentable')->first();
        return $model;
        // return InspectionResult::where('inspection_id', $model['id'])->with('inspector', 'details', 'attachmentable')->limit(1)->get();
    }
}
