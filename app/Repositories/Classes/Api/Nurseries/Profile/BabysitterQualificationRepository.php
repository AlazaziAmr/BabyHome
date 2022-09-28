<?php

namespace App\Repositories\Classes\Api\Nurseries\Profile;

use App\Models\Api\Nurseries\BabysitterQualification;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Nurseries\Profile\IBabysitterQualificationRepository;

class BabysitterQualificationRepository extends BaseRepository implements IBabysitterQualificationRepository
{

    function model()
    {
        return BabysitterQualification::class;
    }

    public function create($payload)
    {
        if (!empty($payload['qualifications'])) {
            foreach ($payload['qualifications'] as $qualification) {
                $q = $this->model->where('qualification_id', $qualification['id'])
                    ->where('babysitter_id', $payload['babysitter_id'])
                    ->get()->first();
                if ($q) {
                   $q->update([
                       'description' => $qualification['description'],
                   ]);
                }else{
                    BabysitterQualification::create([
                        'description' => $qualification['description'],
                        'qualification_id' => $qualification['id'],
                        'babysitter_id' => $payload['babysitter_id'],
                    ]);
                }
            }
        }
    }
}
