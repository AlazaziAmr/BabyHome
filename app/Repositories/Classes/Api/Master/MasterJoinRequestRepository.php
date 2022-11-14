<?php

namespace App\Repositories\Classes\Api\Master;

use App\Models\Api\Generals\Activity;
use App\Models\Api\Generals\Day;
use App\Models\Api\Generals\Neighborhood;
use App\Models\Api\Master\Child;
use App\Models\Api\Master\Master;
use App\Models\Api\Nurseries\JoinRequest\JoinRequest;
use App\Models\Api\Nurseries\Nursery;
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

    public function filterMaster($request)
    {
        if($request->from_hour !=null?$from_hour=$request->from_hour: $from_hour="7:00")
        if($request->to_hour !=null?$to_hour=$request->to_hour: $to_hour="7:00")
        if($request->day !=null?explode($day=',',$request->day): $day=Day::pluck('id')->toArray())

        $day_select=  Nursery::with('availabilities', 'availabilities.day')->whereIn('id',$day)->select('id','name')->get();

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

        if ($request->city_id != null && $request->neighborhood_id != null) {

            $NurseryFilter = $blog_query::where('is_active', 0)->where('status', 5)
                ->where('city_id', $request->city_id)->where('neighborhood_id', $request->neighborhood_id)
                ->where('address_description', 'LIKE', '%' . $search . '%')
                ->where('acceptance_age_from', '>=', $age_find)->where('acceptance_age_to', '<=', $age_find)
              ->with([
                    'country:id,name', 'city:id,name', 'neighborhood:id,name',
                    'packages' => function ($query1) {
                        $query1->select('id', 'name', 'description', 'nursery_id', 'type_id')
                            ->where('is_active', 1);
                    },
                   'babySitter:id,nursery_id',
                ])->with('availabilities:id,from_hour,to_hour,day_id,nursery_id', 'availabilities.day')->whereIn('id',$day)->select('id','name')
                ->select(['id', 'name', 'first_name', 'last_name', 'license_no', 'capacity', 'acceptance_age_from',
                    'acceptance_age_to', 'national_address', 'address_description', 'price', 'latitude', 'longitude', 'city_id', 'country_id'])
                ->orderBy('price', $sortOrder)->paginate(10)->withQueryString();
        } elseif ($request->city_id != null && $request->neighborhood_id == null) {
            $NurseryFilter = $blog_query::where('is_active', 0)->where('status', 5)
                ->where('city_id', $request->city_id)
                ->where('address_description', 'LIKE', '%' . $search . '%')
                ->where('acceptance_age_from', '>=', $age_find)->where('acceptance_age_to', '<=', $age_find)
               ->with([
                    'country:id,name', 'city:id,name', 'neighborhood:id,name',
                    'packages' => function ($query1) {
                        $query1->select('id', 'name', 'description', 'nursery_id', 'type_id')
                            ->where('is_active', 1);
                    }, 'babySitter:id,nursery_id',
                ])->with('availabilities:id,from_hour,to_hour,day_id,nursery_id', 'availabilities.day')->whereIn('id',$day)->select('id','name')
                ->select(['id', 'name', 'first_name', 'last_name', 'license_no', 'capacity', 'acceptance_age_from',
                    'acceptance_age_to', 'national_address', 'address_description', 'price', 'latitude', 'longitude', 'city_id', 'country_id'])
                ->orderBy('price', $sortOrder)->paginate(10)->withQueryString();

        } else {
            $NurseryFilter = $blog_query::where('is_active', 0)->where('status', 5)
                ->where('address_description', 'LIKE', '%' . $search . '%')
                ->where('acceptance_age_from', '>=', $age_find)->where('acceptance_age_to', '<=', $age_find)
                ->with([
                    'country:id,name', 'city:id,name', 'neighborhood:id,name',
                    'packages' => function ($query1) {
                        $query1->select('id', 'name', 'description', 'nursery_id', 'type_id')
                            ->where('is_active', 1);
                    }, 'babySitter:id,nursery_id',
                ])->with('availabilities:id,from_hour,to_hour,day_id,nursery_id', 'availabilities.day')->whereIn('id',$day)->select('id','name')
                ->select(['id', 'name', 'first_name', 'last_name', 'license_no', 'capacity', 'acceptance_age_from',
                    'acceptance_age_to', 'national_address', 'address_description', 'price', 'latitude', 'longitude', 'city_id', 'country_id'])
                ->orderBy('price', $sortOrder)->paginate(10)->withQueryString();

        }

        return $NurseryFilter;
    }

    public function booking(Request $request){
        
    }

    public function nurseriesDetails($id){
        $blog_query = new Nursery();

        $nurseryDetails = $blog_query::where('id',$id)
            ->with([
                'country:id,name', 'city:id,name', 'neighborhood:id,name',
                'packages' => function ($query1) {
                    $query1->select('id', 'name', 'description', 'nursery_id', 'type_id')
                        ->where('is_active', 1);
                }, 'babySitter:id,nursery_id',
            ])->with('availabilities:id,from_hour,to_hour,day_id,nursery_id', 'availabilities.day')->select('id','name')
            ->with('services.attachmentable')->where('is_active',0)->select('id','name','nursery_id')
            ->select(['id', 'name', 'first_name', 'last_name', 'license_no', 'capacity', 'acceptance_age_from',
                'acceptance_age_to', 'national_address', 'address_description', 'price', 'latitude', 'longitude', 'city_id', 'country_id'])
            ->paginate(10)->withQueryString();

        return $nurseryDetails;

    }





}
