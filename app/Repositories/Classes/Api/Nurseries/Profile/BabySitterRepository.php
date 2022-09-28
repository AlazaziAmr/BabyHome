<?php

namespace App\Repositories\Classes\Api\Nurseries\Profile;

use App\Models\Api\Nurseries\BabysitterInfo;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Nurseries\Profile\IBabySitterRepository;

class BabySitterRepository extends BaseRepository implements IBabySitterRepository
{
    function model()
    {
        return BabysitterInfo::class;
    }

    public function create($payload)
    {
        $babySitter = $this->model()::create([
            'years_of_experince' => $payload['years_of_experince'],
            'date_of_birth' => $payload['date_of_birth'],
            'national_id' => $payload['national_id'],
            'nationality' => $payload['nationality_id'],
            'free_of_disease' => $payload['free_of_disease'],
            'nursery_id' => $payload['id'],
            'user_id' => user()->id ?? null,
        ]);

        if ($payload['languages'])
            $babySitter->languages()->sync($payload['languages']);

        if (!empty($payload['attachments'])) uploadAttachment($babySitter, $payload, 'attachments', 'baby-sitters');

    }

    public function update(array $payload, $id, $attribute = "id")
    {
        $babySitter = $this->model->where('id',$id)->update([
            'years_of_experince' => $payload['years_of_experince'],
            'date_of_birth' => $payload['date_of_birth'],
            'national_id' => $payload['national_id'],
            'nationality' => $payload['nationality_id'],
            'free_of_disease' => $payload['free_of_disease'],
        ]);

        if ($payload['languages'])
            $babySitter->languages()->sync($payload['languages']);

        if (!empty($payload['attachments'])) uploadAttachment($babySitter, $payload, 'attachments', 'baby-sitters');

    }
}
