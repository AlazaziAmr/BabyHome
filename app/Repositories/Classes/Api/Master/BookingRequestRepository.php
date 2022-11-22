<?php

namespace App\Repositories\Classes\Api\Master;

use App\Helpers\JsonResponse;
use App\Models\Api\Generals\Activity;
use App\Models\Api\Generals\City;
use App\Models\Api\Generals\Country;
use App\Models\Api\Generals\Day;
use App\Models\Api\Generals\Language;
use App\Models\Api\Generals\Neighborhood;
use App\Models\Api\Master\BookingServices\Booking;
use App\Models\Api\Master\BookingServices\BookingLog;
use App\Models\Api\Master\BookingServices\BookingService;
use App\Models\Api\Master\BookingServices\BookingsStatus;
use App\Models\Api\Master\BookingServices\ReservedTime;
use App\Models\Api\Master\Child;
use App\Models\Api\Nurseries\BabysitterInfo;
use App\Models\Api\Nurseries\BabysitterQualification;
use App\Models\Api\Nurseries\BabysitterSkill;
use App\Models\Api\Nurseries\JoinRequest\JoinRequest;
use App\Models\Api\Nurseries\Nursery;
use App\Models\Api\Nurseries\NurseryAmenity;
use App\Models\Api\Nurseries\NurseryService;
use App\Models\Api\Nurseries\NurseryUtility;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Master\IBookingRequestRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;


class BookingRequestRepository extends BaseRepository implements IBookingRequestRepository
{
    public function model()
    {
        return JoinRequest::class;
    }

    public function Nursery()
    {
        return Nursery::class;
    }


    protected function prices($request)
    {
        $startTime = Carbon::parse($request->start_time);
        $endTime = Carbon::parse($request->end_time);
        $totalTime = $startTime->diff($endTime)->format('%H:%I');
        $totalHoure = $startTime->diff($endTime)->format('%H');
        $totalMinutes = $startTime->diff($endTime)->format('%I');
        $priceTotalHoure = $totalHoure * $request->price;

        $priceTotalMinutes = $totalMinutes * ($request->price / 60);
        $totalPrice = $priceTotalHoure + $priceTotalMinutes;

        return ['totalPrice' => $totalPrice,
            'totalTime' => $totalTime];
    }

    protected function bookingLog($last)
    {
        $babySitter = BookingLog::create([
            'user_id' => $last->nursery_id,
            'user_type' => 2,
            'booking_id' => $last->id,
            'status_id' => "0",

        ]);
    }

    protected function bookingServices($request, $last)
    {
        if (!empty($request['services'])) {
            foreach ($request['services'] as $k => $service) {

                $babySitter = BookingService::create([
                    'nursery_id' => $last->nursery_id,
                    'booking_id' => $last->id,
                    'service_id' => $service['id'],
                    'master_id' => $last->master_id,
                    'child_id' => $last->child_id,
                    'service_type_id' => $service['service_type_id'],
                    'service_price' => $service['service_price'],
                    'service_quantity' => $service['service_quantity'],
                    'notes' => $service['notes'],
                    'status' => 0,

                ]);
            }
        }
    }

    protected function bookingStatus($request)
    {

        $babySitter = BookingsStatus::create([
            'name' => $request->nursery_id,
            'description' => $request->master_id,

        ]);
    }

    protected function reservedTimes($request)
    {

        if (!empty($request['date'])) {

            foreach ($request['date'] as $data) {


                $babySitter = ReservedTime::create([

                    'nursery_id' => $request->nursery_id,
                    'date' => $data['date'],
                    'start_hour' => $request->start_time,
                    'end_hour' => $request->end_time,
                    'num_of_confirmed_res' => "0",
                    'num_of_unconfirmed_res' => 0,

                ]);
            }
        }

    }

    public function checkBookingNursery($request){


        if (!empty($request['date'])) {

            foreach ($request['date'] as $data) {
                $startTime = Carbon::parse($request->start_time);
                $endTime = Carbon::parse($request->end_time);
                $bookingCount = ReservedTime::with('Nurseries')->with('Nurseries')
                    ->where('start_hour', '<=', $startTime)
                    ->where('end_hour', '>=', $endTime)
                    ->whereNotIn('num_of_confirmed_res',[2])
                    ->whereIn('date', $data)->get();
            }
        }
        return $bookingCount->count();
    }
    public function createRequest($request)
    {
        /*يتم إرجاع السعر جاهز */

        /*
                if (!empty($request['payment'])) {
                    $status_id=3;
                }else{
                    $status_id=0;
                }*/
        $checkBooking=$this->checkBookingNursery($request);
        if ($checkBooking <=2) {
            $total = $this->prices($request);
            $total_hours = Carbon::parse($total['totalTime']);
            $id = $request['services'];
            /*        foreach ($request['child_id'] as $child) {*/
            $last = Booking::create([
                'nursery_id' => $request->nursery_id,
                'master_id' => $request->master_id,
                'child_id' => $request->child_id,
                'status_id' => "0",
                'booking_date' => $request->booking_date,
                'start_datetime' => $request->start_datetime,
                'end_datetime' => $request->end_datetime,
                'total_hours' => $total_hours,
                'created_by' => $request->created_by,
            ]);
            $this->bookingLog($last);
            $this->reservedTimes($request);
            /*            $this->bookingStatus($request,$last);*/
            $this->bookingServices($request, $last);
            /*   }

               if (!empty($request['payment'])) {
                    $this->payment($request['services'], $request);
                }

               // qualicfications
               if (!empty($request['services'])) {
                    $this->services($request['services'], $request);
                }*/
        }else{
            return "عذراً الحاضنة ممتلئة";
        }

    }


    public function fetchCustomerRequest($id)
    {
    }


    public function showNurseries()
    {

        $Nursery = Nursery::where('is_active', 1)->where('status', 5)
            ->with([
                'country:id,name', 'city:id,name', 'neighborhood:id,name',
                'packages' => function ($query1) {
                    $query1->select('id', 'name', 'description', 'nursery_id', 'type_id')
                        ->where('is_active', 1);
                },
                'babySitter:id,nursery_id',
            ])->with('availabilities:id,from_hour,to_hour,day_id,nursery_id', 'availabilities.day')->select('id', 'name')
            ->select(['id', 'name', 'first_name', 'last_name', 'license_no', 'capacity', 'acceptance_age_from',
                'acceptance_age_to', 'national_address', 'address_description', 'price', 'latitude', 'longitude', 'city_id', 'country_id'])
            ->orderBy('price', 'desc')->paginate(10)->withQueryString();
        return $Nursery;


    }

    private function check($request)
    {
        if ($request->from_hour != null ? $from_hour = $request->from_hour : $from_hour = "00:00")
            if ($request->to_hour != null ? $to_hour = $request->to_hour : $to_hour = "24:00")
                if ($request->day != null ? explode($day = ',', $request->day) : $day = Day::pluck('id')->toArray())
                    if ($request->children_lang != null ? explode($children_lang = ',', $request->dchildren_lang) : $children_lang = Language::pluck('id')->toArray())


                    $from_hour = gmdate('H:i', strtotime($from_hour));
        $to_hour = gmdate('H:i', strtotime($to_hour));
        if ($request->children_id != null) {
            $find = Child::where('id', $request->children_id)->first();
            $age_find = Carbon::parse($find->date_of_birth)->diff(Carbon::now())->format('%y');
        } else {
            $age_find = 1;
        }

        $model = new Nursery();
        $search = $request->search;

        #############Order By Price#################################
        if ($request->sortOrder && in_array($request->sortOrder, ['asc', 'desc'])) {
            $sortOrder = $request->sortOrder;
        } else {
            $sortOrder = 'desc';
        }

        $country_id = $request->country_id != null ? $request->country_id : Country::pluck('id')->toArray();
        $neighborhood_id = $request->neighborhood_id != null ? $request->neighborhood_id : Neighborhood::pluck('id')->toArray();
        $city_id = $request->city_id != null ? $request->city_id : City::pluck('id')->toArray();


        return [
            'sortOrder' => $sortOrder,
            'age_find' => $age_find,
            'from_hour' => $from_hour,
            'to_hour' => $to_hour,
            'blog_query' => $model,
            'search' => $search,
            'day' => $day,
            'country_id' => $country_id,
            'neighborhood_id' => $neighborhood_id,
            'city_id' => $city_id,
            'children_lang' => $children_lang,

        ];
    }

    public function filterMaster($request)
    {

        $check = $this->check($request);

        $sortOrder = $check['sortOrder'];
        $age_find = $check['age_find'];
        $from_hour = $check['from_hour'];
        $to_hour = $check['to_hour'];
        $model = $check['blog_query'];
        $search = $check['search'];
        $day = $check['day'];
        $country_id = $check['country_id'];
        $neighborhood_id = $check['neighborhood_id'];
        $city_id = $check['city_id'];
        $children_lang = $check['children_lang'];


        $NurseryFilter = $model::
        where('is_active', 1)->where('status', 5)->whereIn('neighborhood_id', $check['neighborhood_id'])
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('first_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('uid', 'LIKE', '%' . $search . '%')
                    ->orWhere('address_description', 'LIKE', '%' . $search . '%');
            })
            ->where('acceptance_age_from', '<=', $age_find)->where('acceptance_age_to', '>=', $age_find)
            ->whereIn('country_id', $country_id)
            ->whereIn('neighborhood_id', $neighborhood_id)
            ->with([
                'country:id,name',
                'city:id,country_id,name',
                'neighborhood:id,city_id,name',
                'babySitter:id,nursery_id',
                'babySitter.skills',
                'babySitter.attachmentable',
                'services',
                'services.getMainAttachmentAttribute',
                'services.sub_type:id,name',
            ])
            ->with(['availabilities' => function ($item) use ($from_hour, $to_hour) {
                $item->select('id', 'from_hour', 'to_hour', 'day_id', 'nursery_id');
                $item->where('from_hour', '<=', $from_hour);
                $item->where('to_hour', '>=', $to_hour);
            }, 'availabilities.day:name', 'attachmentable'])->whereIn('id', $day)->whereIn('city_id', $city_id)
            ->select(['id', 'uid', 'user_id', 'name', 'first_name', 'last_name', 'license_no', 'capacity', 'acceptance_age_from',
                'acceptance_age_to', 'national_address', 'address_description', 'price', 'latitude', 'longitude', 'city_id', 'country_id', 'neighborhood_id'])
            ->orderBy('price', $sortOrder)->paginate(10)->withQueryString();

        return $NurseryFilter;

    }

    public function booking(Request $request)
    {

    }

    public function nurseriesDetails($id)
    {
        $data['title'] = __('site.nurseries');
        $data['nursery'] = Nursery::with(['country:id,name', 'city:id,name', 'neighborhood:id,name', 'owner:id,name,phone,email', 'attachmentable'])->findOrFail($id);
        $data['babysitter'] = BabysitterInfo::with(['languages', 'nationalitydata', 'attachmentable'])
            ->where('nursery_id', $id)
            ->first();

        $data['amenities'] = NurseryAmenity::with(['amenity', 'attachmentable'])
            ->where('nursery_id', $id)
            ->get();

        $data['utilities'] = NurseryUtility::with(['utility'])->where('nursery_id', $id)
            ->get();

        $data['services'] = NurseryService::with(['service.attachmentable'])->where('nursery_id', $id)
            ->get();

        if ($data['babysitter']) {
            $data['skills'] = BabysitterSkill::where('babysitter_id', $data['babysitter']->id)
                ->get();
            $data['qualifications'] = BabysitterQualification::with(['qualification'])
                ->where('babysitter_id', $data['babysitter']->id)
                ->get();
        }

        return $data;

    }


}
