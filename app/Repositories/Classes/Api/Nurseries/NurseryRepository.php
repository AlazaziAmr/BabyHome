<?php

namespace App\Repositories\Classes\Api\Nurseries;

use App\Helpers\JsonResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Api\Nurseries\Nursery;
use App\Models\Api\Nurseries\PackageInfo;
use App\Models\Api\Nurseries\BabysitterInfo;
use App\Repositories\Classes\BaseRepository;
use App\Models\Api\Admin\Inspections\Inspection;
use App\Models\Api\Generals\Service;
use App\Models\Api\Nurseries\BabysitterQualification;
use App\Models\Api\Nurseries\BabysitterSkill;
use App\Models\Api\Nurseries\JoinRequest\JoinRequest;
use App\Models\Api\Nurseries\NurseryAmenity;
use App\Models\Api\Nurseries\NurseryAvailability;
use App\Repositories\Interfaces\Api\Nurseries\INurseryRepository;

class NurseryRepository extends BaseRepository implements INurseryRepository
{
    public function model()
    {
        return Nursery::class;
    }

    public function fetchAllForCurrentUser($with = [], $columns = array('*'))
    {
        return !empty($with) ? user()->nurseries()->with($with)->get($columns) : user()->nurseries()->get($columns);
    }
    public function nurseriesCloseToMaster($with = [], $columns = array('*'))
    {
        return !empty($with) ? $this->model->with($with)->orderBy('created_at', 'DESC')->get($columns) : $this->model->orderBy('created_at', 'DESC')->get($columns);
    }
    public function approveJoinigRequest($id)
    {
        $request = JoinRequest::where('id', $id)->first();
        $request->update([
            'is_approved' => 1,
            'approved_at' => Carbon::now(),
        ]);
        $childrenIds = $request->children()->pluck('child_id')->toArray();
        $this->model->where('id', $request['nursery_id'])->first()->children()->sync($childrenIds);
    }

    public function getRegisteredChildren($request, $id)
    {
        return $this->model->where('id', $id)->first()->children()->with('gender', 'master.children.attachmentable', 'master.children.gender', 'languages:name', 'phones:child_id,phone', 'attachmentable')->get();
    }

    public function updateUser()
    {
        user()->update(['has_nursery' => 1]);
    }

    public function babySitterInfo($request, $nursery)
    {
        $babySitter = BabysitterInfo::create([
            'years_of_experince' => $request['years_of_experince'],
            'date_of_birth' => $request['date_of_birth'],
            'national_id' => $request['national_id'],
            'nationality' => $request['nationality_id'],
            'free_of_disease' => $request['free_of_disease'],
            'nursery_id' =>  $nursery['id'],
            'user_id' =>  user()->id ?? null,
        ]);

        $this->syncLanguages($request, $babySitter);

        // qualicfications
        if (!empty($request['qualifications'])) {
            foreach ($request['qualifications'] as $qualification) {
                BabysitterQualification::create([
                    'description' => $qualification['description'],
                    'qualification_id' => $qualification['id'],
                    'babysitter_id' => $babySitter['id'],
                ]);
            }
        }

        if (!empty($request['skills'])) {
            foreach ($request['skills'] as $skill) {
                BabysitterSkill::create([
                    'description' => $skill,
                    'babysitter_id' => $babySitter['id'],
                ]);
            }
        }

        if (!empty($request['attachments'])) uploadAttachment($babySitter, $request, 'attachments', 'baby-sitters');
    }

    public function syncLanguages($request, $babySitter)
    {
        // languages
        $babySitter->languages()->sync($request['languages']);
    }
    public function availabilities($days, $nursery)
    {
        foreach ($days as $day) {
            NurseryAvailability::create([
                'day_id' => $day['id'],
                'from_hour' => $day['from'],
                'to_hour' => $day['to'],
                'nursery_id' =>  $nursery['id'],
            ]);
        }
    }

    public function createRequest($request)
    {

        try {
            DB::beginTransaction();

            if(!user()->id){
                DB::rollBack();
                return ['status' => false, 'error' => 'no_user'];
            }

            $nursery = $this->model->create([
                'capacity' => $request['capacity'],
                'acceptance_age_from' => $request['acceptance_age_from'],
                'acceptance_age_to' => $request['acceptance_age_to'],
                'national_address' => $request['national_address'],
                'address_description' => $request['address_description'],
                'latitude' => $request['latitude'],
                'longitude' => $request['longitude'],
                'building_type' => $request['building_type'],
                'country_id' => 1,
                'city_id' => $request['city_id'],
                'neighborhood_id' => $request['neighborhood_id'],
                'price' => $request['price'],
                'nationality_id' => $request['nationality_id'],
                'user_id' =>  user()->id ?? null,
            ]);

            $this->updateUser();

            $this->babySitterInfo($request, $nursery);
            // availabilities
            if (!empty($request['days'])) {
                $this->availabilities($request['days'], $nursery);
            }

            // utilities
            if (!empty($request['utilities'])) {
                $nursery->utilities()->sync($request['utilities']);
            }
            // amenities
            if (!empty($request['amenities'])) {
                foreach ($request['amenities'] as $amenity) {
                    $savedAmenity = NurseryAmenity::create([
                        'nursery_id' => $nursery['id'],
                        'amenity_id' => $amenity['id'],

                    ]);
                    if (!empty($amenity['attachments'])) uploadAttachment($savedAmenity, $amenity, 'attachments', 'amenities');
                }
            }
            // services
            if (!empty($request['services'])) {
                $nursery->services()->sync($request['services']);
            }


            // additional_activities
            if (!empty($request['additional_services'])) {
                $additional_services = [];
                foreach ($request['additional_services'] as $service) {
                    $savedService = Service::create([
                        'name' => $service['name'],
                        'description' => $service['description'],
                        'price' => $service['price'] ?? null,
                        'is_paid' => $service['is_paid'] ?? null,
                        'type_id' =>  $service['type_id'],
                        'user_id' =>  user()->id,
                        'sub_category_id' =>  $service['sub_category_id'],
                    ]);
                    $additional_services[] += $savedService['id'];
                    if (!empty($service['attachments'])) uploadAttachment($savedService, $service, 'attachments', 'services');
                    $nursery->services()->sync($additional_services);
                }
            }
            DB::commit();
            return ['status' => true];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => false, 'error' => $e->getMessage()];
        }
    }


    // Admin
    public function fetchAllForAdmin($with = [], $columns = array('*'))
    {
        return !empty($with) ? $this->model->with($with)->get($columns) : $this->model->get($columns);
    }

    public function assignTo($request)
    {
        Inspection::create([
            'nursery_id' => $request['nursery'],
            'inspector_id' =>  $request['admin'],
            'from' =>  $request['from'],
            'to' =>  $request['to'],
            'notes' =>  $request['note'] ?? null,
        ]);
    }

    public function profile($id)
    {
        $data['nursery'] = $this->model->where('user_id',$id)
            ->get()->first();
        $data['babysitter'] =  BabysitterInfo::select(
            'years_of_experince',
            'date_of_birth',
            'national_id',
            'nationality',
            'free_of_disease',
            'nursery_id',
            'user_id')
            ->with(['nationalitydata','languages'])
            ->where('user_id',$id)->get()->first();
        $data['babysitter']->image = $data['babysitter']->getMainAttachmentAttribute();
        $data['qualifications'] = BabysitterQualification::where('babysitter_id',$data['babysitter']->id)->get();
        $data['skills'] = BabysitterSkill::where('babysitter_id',$data['babysitter']->id)->get();
        $data['days'] = NurseryAvailability::where('nursery_id',$data['nursery']->id)->get();
        return $data;
    }
}
