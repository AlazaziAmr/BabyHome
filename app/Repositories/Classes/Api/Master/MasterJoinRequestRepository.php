<?php

namespace App\Repositories\Classes\Api\Master;

use App\Helpers\JsonResponse;
use App\Models\Api\Generals\Activity;
use App\Models\Api\Generals\City;
use App\Models\Api\Generals\Country;
use App\Models\Api\Generals\Day;
use App\Models\Api\Generals\Neighborhood;
use App\Models\Api\Master\Child;
use App\Models\Api\Master\Master;
use App\Models\Api\Nurseries\BabysitterInfo;
use App\Models\Api\Nurseries\BabysitterQualification;
use App\Models\Api\Nurseries\BabysitterSkill;
use App\Models\Api\Nurseries\JoinRequest\JoinRequest;
use App\Models\Api\Nurseries\Nursery;
use App\Models\Api\Nurseries\NurseryAmenity;
use App\Models\Api\Nurseries\NurseryService;
use App\Models\Api\Nurseries\NurseryUtility;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Master\IMasterJoinRequestRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;


class MasterJoinRequestRepository extends BaseRepository implements IMasterJoinRequestRepository
{
    public function model()
    {
        return JoinRequest::class;
    } public function Nursery()
{
    return Nursery::class;
}

    public function createRequest($request)
    {
    }

    public function fetchCustomerRequest($id)
    {
    }


    public function showNurseries(){

        $Nursery = Nursery::where('is_active', 1)->where('status', 5)
            ->with([
                'country:id,name', 'city:id,name', 'neighborhood:id,name',
                'packages' => function ($query1) {
                    $query1->select('id', 'name', 'description', 'nursery_id', 'type_id')
                        ->where('is_active', 1);
                },
                'babySitter:id,nursery_id',
            ])->with('availabilities:id,from_hour,to_hour,day_id,nursery_id', 'availabilities.day')->select('id','name')
            ->select(['id', 'name', 'first_name', 'last_name', 'license_no', 'capacity', 'acceptance_age_from',
                'acceptance_age_to', 'national_address', 'address_description', 'price', 'latitude', 'longitude', 'city_id', 'country_id'])
            ->orderBy('price', 'desc')->paginate(10)->withQueryString();
        return $Nursery;


    }



    public function filterMaster($request)
    {
        if($request->from_hour !=null ?$from_hour=$request->from_hour: $from_hour="00:00")
            if($request->to_hour !=null ?$to_hour=$request->to_hour: $to_hour="24:00")
                if($request->day !=null ? explode($day=',',$request->day) : $day=Day::pluck('id')->toArray())

                    $from_hour= gmdate('H:i', strtotime($from_hour));
        $to_hour= gmdate('H:i', strtotime($to_hour));

        if ($request->children_id != null) {
            $find = Child::where('id', $request->children_id)->first();
            $age_find = Carbon::parse($find->date_of_birth)->diff(Carbon::now())->format('%y');
        } else {
            $age_find = 1;
        }

        $blog_query = new Nursery();
        $search = $request->search;

        #############Order By Price#################################
        if ($request->sortOrder && in_array($request->sortOrder, ['asc', 'desc'])) {
            $sortOrder = $request->sortOrder;
        } else {
            $sortOrder = 'desc';
        }

        $country_id= $request->country_id != null ? $request->country_id : Country::pluck('id')->toArray() ;
        $neighborhood_id= $request->neighborhood_id != null ? $request->neighborhood_id : Neighborhood::pluck('id')->toArray();
        $city_id= $request->city_id != null ? $request->city_id : City::pluck('id')->toArray();
        $NurseryFilter = $blog_query::
        where('is_active', 1)->where('status', 5)->
        whereIn('neighborhood_id', $neighborhood_id)
            ->where(function($query) use ($search) {
                $query->where('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('first_name', 'LIKE', '%'.$search.'%')
                    ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                    ->orWhere('uid', 'LIKE', '%'.$search.'%')
                    ->orWhere('address_description', 'LIKE', '%'.$search.'%')
                ;})
            ->where('acceptance_age_from', '<=', $age_find)->where('acceptance_age_to', '>=', $age_find)
            ->whereIn('country_id',$country_id)
            ->whereIn('city_id',$city_id)
            ->whereIn('neighborhood_id',$neighborhood_id)
            ->with([
                'country:id,name',
                'city:id,country_id,name',
                'neighborhood:id,city_id,name',
                'babySitter:id,nursery_id',
            ])
            ->with(['availabilities' => function ($item) use ($from_hour,$to_hour){
                $item->select('id','from_hour','to_hour','day_id','nursery_id');
                $item->where('from_hour','>=',$from_hour);
                $item->where('to_hour','>=',$to_hour);
            }, 'availabilities.day:name','attachmentable'])->whereIn('id',$day)
            ->select(['id','uid','user_id', 'name', 'first_name', 'last_name', 'license_no', 'capacity', 'acceptance_age_from',
                'acceptance_age_to', 'national_address', 'address_description', 'price', 'latitude', 'longitude', 'city_id', 'country_id','neighborhood_id'])
            ->orderBy('price', $sortOrder)->paginate(10)->withQueryString();

        return $NurseryFilter;

    }

    public function booking(Request $request){

    }

    public function nurseriesDetails($id){
        $data['title'] = __('site.nurseries');
        $data['nursery'] = Nursery::with(['country:id,name', 'city:id,name', 'neighborhood:id,name', 'owner:id,name,phone,email','attachmentable'])->findOrFail($id);
        $data['babysitter'] = BabysitterInfo::with(['languages','nationalitydata','attachmentable'])
            ->where('nursery_id',$id)
            ->first();

        $data['amenities'] = NurseryAmenity::with(['amenity','attachmentable'])
            ->where('nursery_id',$id)
            ->get();

        $data['utilities'] = NurseryUtility::with(['utility'])->where('nursery_id',$id)
            ->get();

        $data['services'] = NurseryService::with(['service.attachmentable'])->where('nursery_id',$id)
            ->get();

        if($data['babysitter']){
            $data['skills'] = BabysitterSkill::where('babysitter_id',$data['babysitter']->id)
                ->get();
            $data['qualifications'] =BabysitterQualification::with(['qualification'])
                ->where('babysitter_id',$data['babysitter']->id)
                ->get();
        }

        return $data;

    }





}
