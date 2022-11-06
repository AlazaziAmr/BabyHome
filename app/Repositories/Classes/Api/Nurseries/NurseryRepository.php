<?php

namespace App\Repositories\Classes\Api\Nurseries;

use App\Functions\FcmNotification;
use App\Helpers\JsonResponse;
use App\Models\AdminNotification;
use App\Models\Api\Generals\Activity;
use App\Models\Api\Nurseries\Notification;
use App\Models\Api\Nurseries\NurseryService;
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

    public function FindOne($with = [], $user_id = 0)
    {
        if ($user_id == 0) {
            return $this->model->with($with)
                ->where('user_id', user()->id)
                ->first();
        } else {
            return $this->model->with($with)
                ->where('user_id', $user_id)
                ->first();
        }
    }

    public function BabySitter($nursery_id)
    {
        return BabysitterInfo::with(['languages', 'nationalitydata', 'attachmentable'])
            ->where('nursery_id', $nursery_id)->first();
    }

    public function skills($babysitter_id)
    {
        return BabysitterSkill::where('babysitter_id', $babysitter_id)
            ->get();
    }

    public function qualifications($babysitter_id)
    {
        return BabysitterQualification::with(['qualification'])
            ->where('babysitter_id', $babysitter_id)
            ->get();
    }

    public function NurseryAmenity($nursery_id)
    {
        return NurseryAmenity::where('nursery_id', $nursery_id)
            ->with(['amenity', 'attachmentable'])->get();
    }

    public function NurseryService($nursery_id)
    {
        return NurseryService::where('nursery_id', $nursery_id)
            ->with(['service', 'service.attachmentable','service.type','service.sub_type'])->get();
    }

    public function profile($id)
    {
        $data['nursery'] = Nursery::with(
            ['country', 'city', 'neighborhood']
        )
            ->where('user_id', $id)->first();

        $data['babysitter_info'] = $data['nursery'] ?
            BabysitterInfo::with(['languages', 'qualifications', 'skills', 'nationalitydata'])
                ->where('nursery_id', $data['nursery']->id)
                ->first() : '';

        $data['activities'] = $data['nursery'] ?
            Activity::where('user_id', $id)
                ->get() : '';

        $data['services'] = NurseryService::with(['service.attachmentable'])->where('nursery_id', $id)
            ->get();

        foreach ($data['activities'] as $activity) {
            $activity->image = $activity->getMainAttachmentAttribute();
        }

        $data['nursery_availabilities'] = $data['nursery'] ? NurseryAvailability::where('nursery_id', $data['nursery']->id)->get() : '';

        $data['babysitter_info']->image = ($data['babysitter_info']) ? $data['babysitter_info']->getMainAttachmentAttribute() : '';

        $data['qualifications'] = ($data['babysitter']) ? BabysitterQualification::with('qualification')->where('babysitter_id', $data['babysitter']->id)->get() : '';
        $data['skills'] = ($data['babysitter']) ? BabysitterSkill::where('babysitter_id', $data['babysitter']->id)->get() : '';

        return $data;
    }

    public function fetchAllForCurrentUser($with = [], $columns = array('*'))
    {
        return !empty($with) ? user()->nurseries()->with($with)->get($columns) : user()->nurseries()->get($columns);
    }

    public function nurseriesCloseToMaster($with = [], $columns = array('*'))
    {
        return !empty($with) ? $this->model->with($with)->orderBy('created_at', 'DESC')->select($columns)->paginate() : $this->model->orderBy('created_at', 'DESC')->select($columns)->paginate();
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
            'nursery_id' => $nursery['id'],
            'user_id' => user()->id ?? null,
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
                'nursery_id' => $nursery['id'],
            ]);
        }
    }

    public function createRequest($request)
    {

        try {
            DB::beginTransaction();

            if (!user()->id) {
                DB::rollBack();
                return ['status' => false, 'error' => 'no_user'];
            }

            $name = user()->name;

            $nursery = $this->model->create([
                'capacity' => $request['capacity'],
                'acceptance_age_from' => $request['acceptance_age_from'],
                'acceptance_age_type' => $request['acceptance_age_type'],
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
                'user_id' => user()->id ?? null,
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
                        'type_id' => $service['type_id'],
                        'user_id' => user()->id,
                        'sub_category_id' => $service['sub_category_id'],
                    ]);
                    $additional_services[] += $savedService['id'];
                    if (!empty($service['attachments'])) uploadAttachment($savedService, $service, 'attachments', 'services');
                    $nursery->services()->sync($additional_services);
                }
            }

            AdminNotification::create([
                'notifiable_type' => 'App\Models\Api\Admin\Admin',
                'notifiable_id' => 0,
                'title' => 'حاضنه جديدة',
                'description' => '',
                'link' => route('__bh_.nurseries.index'),
                'mark_as_read' => 0,
                'type' => 1,
            ]);
            DB::commit();

            $fcm = new FcmNotification();
//            $message = 'اهلين ………….<br> تم تسجيلك بنجاح كحاضنة<br> بيتم تحديد موعد وإبلاغك بزيارة احد فريق Baby Home <br> مع تمنياتنا لك بالتوفيق <br> فريق Baby Home';
            $message = 'اهلين '. user()->name . '

تم تسجيلك بنجاح كحاضنة
بيتم تحديد موعد وإبلاغك بزيارة احد فريق Baby Home

مع تمنياتنا لك بالتوفيق
 فريق Baby Home';
//            $fcm->save_notification('تسجيل حاضنة',$message,user()->id,user()->phone);
            sendAdMessage(user()->phone,$message);
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
            'inspector_id' => $request['admin'],
            'from' => $request['from'],
            'to' => $request['to'],
            'notes' => $request['note'] ?? null,
        ]);
    }
}
