<?php

namespace App\Repositories\Classes\Api\Inspector;

use App\Models\Api\Inspector\NurseryEvaluation;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Inspector\INurseryEvaluationRepository;

class NurseryEvaluationRepository extends BaseRepository implements INurseryEvaluationRepository
{

    function model()
    {
        return NurseryEvaluation::class;
    }

    public function create($payload)
    {
        $c = 0;
        if($payload['nursery_id'] == 'activities'){
            $c = 0;
        }elseif($payload['nursery_id'] == 'babySetter'){
            $c = 1;
        }elseif($payload['nursery_id'] == 'nurseryInfo'){
            $c = 2;
        }elseif($payload['nursery_id'] == 'packages'){
            $c = 3;
        }
        $pre_evaluation = NurseryEvaluation::where('nursery_id',$payload['nursery_id'])
            ->where('criteria',$c)
            ->first();
        $data = [
            'nursery_id' => $payload['nursery_id'],
            'inspector_id ' => 1,
            'criteria' => $c,
            'comment' => $payload['comment'],
            'rating' => $payload['rating'],
            'lat' => $payload['lat'],
            'lng' => $payload['lng'],
            'matching' => $payload['matching'],
            'recommendation' => $payload['recommendation']
        ];
        if($pre_evaluation){
            $pre_evaluation->update($data);
            if (!empty($payload['attachments'])) uploadAttachment($pre_evaluation, $payload, 'attachments', 'evaluations');
        }else{
            $evaluation = NurseryEvaluation::create($data);
            if (!empty($payload['attachments'])) uploadAttachment($evaluation, $payload, 'attachments', 'evaluations');
        }

    }
}
