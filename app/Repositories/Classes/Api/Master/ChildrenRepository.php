<?php

namespace App\Repositories\Classes\Api\Master;

use App\Models\Api\Master\Child;
use App\Models\Api\Master\ChildAllergy;
use App\Models\Api\Master\ChildSickness;
use App\Models\Api\Master\Phone;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Master\IChildrenRepository;
use Illuminate\Support\Facades\DB;

class ChildrenRepository extends BaseRepository implements IChildrenRepository
{
    public function model()
    {
        return Child::class;
    }

    public function profile($id){
        return $this->model->with(
            ['gender','languages:name','phones:child_id,phone,name','attachmentable','master'])
            ->find($id);
    }

    public function fetchAllForCurrentUser()
    {
        return master()->children()->with('gender', 'attachmentable')->get();
    }

    public function createRequest($payload)
    {
        try {
            DB::beginTransaction();
            $child = $this->model->create([
                'name' => $payload['name'],
                'gender_id' => $payload['gender_id'],
                'relation_id' => $payload['relation_id'],
                'date_of_birth' => $payload['date_of_birth'],
                'description' => $payload['description'],
                'has_disability' => $payload['has_disability'],
            ]);

            if($payload['allergies']){
                foreach ($payload['allergies'] as $allergy){
                    ChildAllergy::create([
                        'child_id' => $child['id'],
                        'allergy_name' => $allergy,
                    ]);
                }
            }

            if($payload['sicknesses']){
                foreach ($payload['sicknesses'] as $sickness){
                    ChildSickness::create([
                        'child_id' => $child['id'],
                        'sickness_name' => $sickness['sickness_name'],
                        'sickness_date' => $sickness['sickness_date'],
                        'sickness_desc' => $sickness['sickness_desc'],
                        'sickness_status' => $sickness['sickness_status'],
                    ]);
                }
            }

            //Parent
            master()->children()->sync($child['id'], false);

            //Languages
            if ($payload['languages']) $child->languages()->sync($payload['languages']);

            //phones
            if ($payload['phones']) {
                foreach ($payload['phones'] as $phone) {
                    Phone::create([
                        'child_id' => $child['id'],
                        'phone' => $phone,
//                        'name' => $phone,
                    ]);
                }
            }

            //attachments
            if (!empty($payload['attachments'])) uploadAttachment($child, $payload, 'attachments', 'children');
            DB::commit();
            return ['status' => true];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => false, 'error' => $e->getMessage()];
        }
    }

    public function update(array $payload, $id, $attribute = "id")
    {
        $child = $this->model->where('id',$id)->first();
        try {
            DB::beginTransaction();
            $child->update([
                'name' => $payload['name'],
                'gender_id' => $payload['gender_id'],
                'relation_id' => $payload['relation_id'],
                'date_of_birth' => $payload['date_of_birth'],
                'description' => $payload['description'],
                'has_disability' => $payload['has_disability'],
            ]);

            //Languages
            if ($payload['languages']) $child->languages()->sync($payload['languages']);

            //phones
            Phone::where('child_id',$child['id'])->delete();
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
            DB::commit();
            return ['status' => true];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => false, 'error' => $e->getMessage()];
        }
    }
}
