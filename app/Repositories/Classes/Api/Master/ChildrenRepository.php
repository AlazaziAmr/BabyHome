<?php

namespace App\Repositories\Classes\Api\Master;

use App\Models\Api\Master\Child;
use App\Models\Api\Master\Phone;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Master\IChildrenRepository;

class ChildrenRepository extends BaseRepository implements IChildrenRepository
{
    public function model()
    {
        return Child::class;
    }

    public function fetchAllForCurrentUser()
    {
        return master()->children()->with('gender','attachmentable')->get();
    }
    public function createRequest($payload)
    {
        // Child
        $child = $this->model->create([
            'name' => $payload['name'],
            'gender_id' => $payload['gender_id'],
            'relation_id' => $payload['relation_id'],
            'date_of_birth' => $payload['date_of_birth'],
            'description' => $payload['description'],
            'has_disability' => $payload['has_disability'],
        ]);

        //Parent
        master()->children()->sync($child['id'],false);

        //Languages
        if ($payload['languages'])  $child->languages()->sync($payload['languages']);

        //phones
        if ($payload['phones']) {
            foreach ($payload['phones'] as $phone) {
                Phone::create([
                    'child_id' => $child['id'],
                    'phone' => $phone,
                ]);
            }
        }

        //attachments
        if (!empty($payload['attachments'])) uploadAttachment($child, $payload, 'attachments', 'children');
    }
}
