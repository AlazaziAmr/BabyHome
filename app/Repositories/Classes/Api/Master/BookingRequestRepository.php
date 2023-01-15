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
use App\Models\Api\Master\BookingServices\ConfirmedBooking;
use App\Models\Api\Master\BookingServices\ReservedTime;
use App\Models\Api\Master\Child;
use App\Models\Api\Master\Master;
use App\Models\Api\Nurseries\BabysitterInfo;
use App\Models\Api\Nurseries\BabysitterQualification;
use App\Models\Api\Nurseries\BabysitterSkill;
use App\Models\Api\Nurseries\JoinRequest\JoinRequest;
use App\Models\Api\Nurseries\Nursery;
use App\Models\Api\Nurseries\NurseryAmenity;
use App\Models\Api\Nurseries\NurseryAvailability;
use App\Models\Api\Nurseries\NurseryService;
use App\Models\Api\Nurseries\NurseryUtility;
use App\Models\User;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Master\IBookingRequestRepository;
use App\Traits\ApiTraits;
use Carbon\Carbon;
use Illuminate\Http\Request;


class BookingRequestRepository extends BaseRepository implements IBookingRequestRepository
{
    use ApiTraits;

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
            'status_id' => "1",

        ]);
    }

    protected function bookingServices($request, $booking_id, $child_id)
    {

        if (!empty($request['services'])) {
            foreach ($request['services'] as $k => $service) {
                foreach($service['child_id']as $k => $child_id){
                    foreach ($booking_id as  $booking) {
                        if ($booking->child_id==$child_id){



                        $babySitter = BookingService::create([
                    'nursery_id' => $booking->nursery_id,
                    'booking_id' => $booking->id,
                    'service_id' => $service['id'],
                    'master_id' => $booking->master_id,
                    'child_id' => $child_id,
                    'service_type_id' => $service['service_type_id'],
                    'service_price' => $service['service_price'],
                    'service_quantity' => $service['service_quantity'],
                    'notes' => $service['notes'],
                    'status' => 1,

                ]);
                        }
                }
                }
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

    protected function reservedTimes($request,$last)
    {

        if (!empty($request['date'])) {

            foreach ($request['date'] as $data) {

                $babySitter = ReservedTime::create([

                    'nursery_id' => $request->nursery_id,
                    'date' => $data['date'],
                    'start_hour' => $request->start_time,
                    'end_hour' => $request->end_time,
                    'booking_id' => $last->id,
                    'num_of_confirmed_res' => "0",
                    'num_of_unconfirmed_res' => 0,

                ]);
            }
        }

    }

    public function checkBookingNursery($request)
    {


        if (!empty($request['date'])) {

            foreach ($request['date'] as $data) {
                $startTime = Carbon::parse($request->start_time);
                $endTime = Carbon::parse($request->end_time);
                $bookingCount = ReservedTime::where('nursery_id',$request->nursery_id)->with('Nurseries')->with('Nurseries')
                    ->where('start_hour', '<=', $startTime)
                    ->where('end_hour', '>=', $endTime)
                    ->whereNotIn('num_of_confirmed_res', [2])->where('num_of_unconfirmed_res',0)
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


        if (!empty($request['child_id'])) {
            $countChild=count($request['child_id']);
            $booking_time = Carbon::now()->format('H:i:m');



                $nursery_capacity = Nursery::select('capacity')->where('id', $request->nursery_id)
                    ->where('online',1)->first();
                $capacity = $nursery_capacity->capacity;
                $checkBooking = $this->checkBookingNursery($request);
                if ($checkBooking <= $capacity) {
                    $capacityFree=$capacity-$checkBooking;
                    $checkCapacity=$capacityFree -$countChild;
                    if ($checkCapacity >=0){
                        $total = $this->prices($request);
                        $total_hours = Carbon::parse($total['totalTime']);
                        $id = $request['services'];
                             //   foreach ($request['child_id'] as $child) {
                        $booking_id = array();

                        foreach ($request['child_id'] as $child_id) {
                            $last = Booking::create([
                            'nursery_id' => $request->nursery_id,
                            'master_id' => $request->master_id,
                            'child_id' => $child_id,
                            'status_id' => "1",
                            'booking_date' => $request->booking_date,
                            'booking_time' => $booking_time,
                            'start_datetime' => $request->start_datetime,
                            'end_datetime' => $request->end_datetime,
                            'total_hours' => $request->total_hours,
                            'created_by' => $request->created_by,
                        ]);
                            $booking_id[] = $last;

                       $this->bookingLog($last);
                        $this->reservedTimes($request,$last);

                        $this->bookingStatus($request,$last);

                       $user_id=Nursery::where("id",$request->nursery_id)->first();
                        $user_id=$user_id->user_id;
                        $user=User::where("id",$user_id)->first();
                        $fcm = new \App\Functions\FcmNotification();
                        $phone = str_replace("+9660","966",$user->phone);
                        $phone = str_replace("+966","966",$phone);
                        $fcm->send_notification("حجز جديد",'هناك حجز جديد.',$phone);
                        }
                           /* }


                           if (!empty($request['payment'])) {
                                $this->payment($request['services'], $request);
                            }

                           // qualicfications
                           if (!empty($request['services'])) {
                                $this->services($request['services'], $request);
                            }*/
                    }else{

                        $msg='عذراَ لايتوفر العدد المطلوب من المقاعد .َ';
                        return $this->returnEmpty($msg);


                    }

                } else {
                    $msg='عذراً الحاضنة ممتلئة .';
                    return $this->returnEmpty($msg);

                }


            }


        $this->bookingServices($request, $booking_id, $child_id);
        $msg='تم حفظ البيانات بنجاح';
        return $this->returnData($last,$msg);

    }
    public function extension($request)
    {

                    $booking_time = Carbon::now()->format('H:i:m');
                        $total = $this->prices($request);
                        $total_hours = Carbon::parse($total['totalTime']);
                        $id = $request['services'];
                             //   foreach ($request['child_id'] as $child) {
                        $booking_id = array();

                        foreach ($request['child_id'] as $child_id) {
                            $last = Booking::create([
                            'nursery_id' => $request->nursery_id,
                            'master_id' => $request->master_id,
                            'child_id' => $child_id,
                            'status_id' => "1",
                            'booking_date' => $request->booking_date,
                            'booking_time' => $booking_time,
                            'start_datetime' => $request->start_datetime,
                            'end_datetime' => $request->end_datetime,
                            'total_hours' => $request->total_hours,
                            'created_by' => $request->created_by,
                        ]);
                            $booking_id[] = $last;

                       $this->bookingLog($last);
                        $this->reservedTimes($request,$last);
                        $this->bookingStatus($request,$last);

                       $user_id=Nursery::where("id",$request->nursery_id)->first();
                        $user_id=$user_id->user_id;
                        $user=User::where("id",$user_id)->first();
                        $fcm = new \App\Functions\FcmNotification();
                        $phone = str_replace("+9660","966",$user->phone);
                        $phone = str_replace("+966","966",$phone);
                        $fcm->send_notification("حجز جديد",'هناك حجز جديد.',$phone);
                        }
      //  $this->bookingServices($request, $booking_id, $child_id);
        $msg='تم حفظ البيانات بنجاح';
        return $this->returnData($last,$msg);

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

        if ($request->children_lang != null ? explode($children_lang = ',', $request->dchildren_lang)
            : $children_lang = 1)

            if ($request->children_id != null) {
                $find = Child::whereIn('id', $request->children_id)->first();
                $age_find_y = Carbon::parse($find->date_of_birth)->diffInYears(Carbon::now());
                $age_find_m = Carbon::parse($find->date_of_birth)->diffInMonths(Carbon::now());
            } else {
                $age_find_m = 1;
            }
        if ($age_find_y>0){
            $age_find=$age_find_y;
            $age_type=2;
        }else{
            $age_find=$age_find_m;
            $age_type=1;


        }

        if ($request->children_lang != null ? explode($children_lang = ',', $request->dchildren_lang) : $children_lang = Language::pluck('id')->toArray())

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
            'age_type' => $age_type,
            /*            'from_hour' => $from_hour,*/
            /*            'to_hour' => $to_hour,*/
            'blog_query' => $model,
            'search' => $search,
            /*            'day' => $day,*/
            'country_id' => $country_id,
            'neighborhood_id' => $neighborhood_id,
            'city_id' => $city_id,
            'children_lang' => $children_lang,

        ];
    }

    public function nurseryAvailability($request)
    {
        if ($request->to_hour =="00:00" ||$request->to_hour =="00:30"){
            $to_hour="23:59";
        }else{
            $to_hour=$request->to_hour;
        }



        $from_hour=$request->from_hour != null ? $request->from_hour :"00:00";
        $to_hour=$to_hour != null ? $to_hour : "23:59";
        $day = $request->day != null ? $request->day : Day::pluck('id')->toArray();

        /* $from_hour = gmdate('H:i', strtotime($request->start_time));
      $to_hour = gmdate('H:i', strtotime($request->end_time));
      $to = Carbon::createFromFormat('H:m',$to_hour );
      $from = Carbon::createFromFormat('H:m',$from_hour );*/
        /*  $today_check_in = Carbon::parse($request->start_time);
          $check_out = Carbon::parse($request->end_time);
          $duration = $today_check_in->diff($check_out)->format('%H:%I');*/

        $from_hour = gmdate('H:i', strtotime($from_hour));

        $to_hour = gmdate('H:i', strtotime($to_hour));


        if ($request->to_hour !=null){

            $NurseryAvailability = NurseryAvailability::where('from_hour', '<=', Carbon::parse($from_hour))
                ->where('to_hour', '>=', Carbon::parse($to_hour))
                ->whereIn('day_id', $day)->
                select('id', 'from_hour', 'to_hour', 'day_id', 'nursery_id')
                ->get();
        }else{
            $NurseryAvailability = NurseryAvailability::whereIn('day_id', $day)->
            select('id', 'from_hour', 'to_hour', 'day_id', 'nursery_id')
                ->get();
        }



        $nursery_id = $NurseryAvailability->pluck('nursery_id');
        $day_id = $NurseryAvailability->pluck('day_id');
        $from_hour = $NurseryAvailability->pluck('from_hour');
        $to_hour = $NurseryAvailability->pluck('to_hour');


        return [
            'nursery_id' => $nursery_id,
            'day_id' => $day_id,
            'from_hour' => $from_hour,
            'to_hour' => $to_hour,
        ];

    }
    public function showBookingDetails($id)
    {
        $masterId=  auth('master')->user()->id;

        $nurseryBooking=Booking::where('id',$id)->where('master_id',$masterId)->with([
            'masters.children:id,name,date_of_birth',
            'serviceBooking.service',
            'BookingStatus:id,name',
            'children.sicknesses',
            'children.languages',
            'children.allergies',
            'children.attachmentable',

        ])->get();
       /* $nurseryBooking['services']=BookingService::where('booking_id',$id)->where('child_id',$nurseryBooking->child_id)->with([
            'masters.children:id,name,date_of_birth',
            'BookingStatus:id,name',
            'children.sicknesses',
            'children.languages',
            'children.allergies',
            'children.attachmentable',

        ])->get();*/

        return $nurseryBooking;

    }

    public function filterMaster($request)
    {


        $time=now()->format('H:i');
        $validation= $request->validate([
            'children_id' => 'exists:children,id',
            'city_id' => 'exists:cities,id',
            'day' => 'exists:days,id',
          //  'from_hour' => 'required',
           // 'to_hour' => 'required|before_or_equal:from_hour',
           // 'to_hour' => 'required|after:from_hour',
        ]);

        $check = $this->check($request);
        $NurseryAvailability = $this->nurseryAvailability($request);
        $sortOrder = $check['sortOrder'];
        $age_find = $check['age_find'];
        $age_type = $check['age_type'];
        $from_hour = $NurseryAvailability['from_hour'];
        $to_hour = $NurseryAvailability['to_hour'];
        $model = $check['blog_query'];
        $search = $check['search'];
        /*        $country_id = $check['country_id'];*/
        $neighborhood_id = $check['neighborhood_id'];
        $city_id = $check['city_id'];
        $children_lang = $check['children_lang'];
        $nursery_id = $NurseryAvailability['nursery_id'];
        $day_id = $NurseryAvailability['day_id'];

if ($age_type==2) {
    $x = $model::where('is_active', 1)->where('acceptance_age_type',2)->where('status', 5)->whereIn('id', $nursery_id)
        ->where('acceptance_age_from', '<=', $age_find)->where('acceptance_age_to', '>=', $age_find)
        ->whereIn('city_id', $city_id)->whereIn('neighborhood_id', $neighborhood_id)
        ->where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('first_name', 'LIKE', '%' . $search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                ->orWhere('uid', 'LIKE', '%' . $search . '%')
                ->orWhere('address_description', 'LIKE', '%' . $search . '%');
        })->with(['availabilities' =>
            function ($item) use ($from_hour, $to_hour) {
                $item->select('id', 'from_hour', 'to_hour', 'day_id', 'nursery_id')
                    ->whereTime('from_hour', '>=', Carbon::parse($from_hour))
                    ->whereTime('to_hour', '<=', Carbon::parse($to_hour));
            },])
        ->with([
            'country:id,name',
            'city:id,country_id,name',
            'neighborhood:id,city_id,name',
            'babySitter:id,nursery_id',
            'babySitter.skills',
            'babySitter.attachmentable',
            'services',
            'services.sub_type:id,name',
            'availabilities'
        ])
        ->select(['id', 'uid', 'user_id', 'name', 'first_name', 'last_name', 'license_no', 'capacity', 'acceptance_age_from',
            'acceptance_age_to', 'national_address', 'address_description', 'price', 'latitude', 'longitude', 'city_id', 'country_id', 'neighborhood_id'])
        ->orderBy('price', $sortOrder)->paginate(10)->withQueryString();
}else{

    $x = $model::where('is_active', 1)->where('acceptance_age_type',1)->where('status', 5)->whereIn('id', $nursery_id)
        ->where('acceptance_age_from', '<=', $age_find)->where('acceptance_age_to', '>=', $age_find)
        ->whereIn('city_id', $city_id)->whereIn('neighborhood_id', $neighborhood_id)
        ->where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('first_name', 'LIKE', '%' . $search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                ->orWhere('uid', 'LIKE', '%' . $search . '%')
                ->orWhere('address_description', 'LIKE', '%' . $search . '%');
        })->with(['availabilities' =>
            function ($item) use ($from_hour, $to_hour) {
                $item->select('id', 'from_hour', 'to_hour', 'day_id', 'nursery_id')
                    ->whereTime('from_hour', '>=', Carbon::parse($from_hour))
                    ->whereTime('to_hour', '<=', Carbon::parse($to_hour));
            },])
        ->with([
            'country:id,name',
            'city:id,country_id,name',
            'neighborhood:id,city_id,name',
            'babySitter:id,nursery_id',
            'babySitter.skills',
            'babySitter.attachmentable',
            'services',
            'services.sub_type:id,name',
            'availabilities'
        ])
        ->select(['id', 'uid', 'user_id', 'name', 'first_name', 'last_name', 'license_no', 'capacity', 'acceptance_age_from',
            'acceptance_age_to', 'national_address', 'address_description', 'price', 'latitude', 'longitude', 'city_id', 'country_id', 'neighborhood_id'])
        ->orderBy('price', $sortOrder)->paginate(10)->withQueryString();
}
        if ($x->isEmpty()){
            return null;
        }
        return $x;




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

    public function showBooking()
    {

        $user_id = auth('master')->user()->id;
        $dateToday=now()->format('Y:m:d');

        $nurseryBooking=Booking::where("master_id",$user_id)->where('status_id', 1)->where('booking_date',$dateToday)->with([
            'masters:id,uid,first_name',
            'children:id,name,date_of_birth',
            'BookingStatus:id,name',
            'nurseries',
            'children.attachmentable',

        ])->get();


        if ($nurseryBooking->isEmpty()) {
            return null;
        }else{
            return $nurseryBooking;
        }



    }

    public function rejectBooking()
    {

        $user_id = auth('master')->user()->id;
        $nurseryBooking=Booking::where("master_id",$user_id)->where('status_id', 3)->with([
            'masters:id,uid,first_name',
            'children:id,name,date_of_birth',
            'BookingStatus:id,name',
            'nurseries',
            'children.attachmentable:id,attachmentable_type,attachmentable_id,title,description,path',
            'RejectResReasons',
        ])->get();
        if ($nurseryBooking->isEmpty()) {
            return null;
        }else{
            return $nurseryBooking;
        }
    }
    public function confirmedShow()
    {
        $user_id = auth('master')->user()->id;
        $booking=Booking::where('status_id',2)->where('master_id',$user_id)
            ->pluck('id');

        $ConfirmedBooking=ConfirmedBooking::whereIn('booking_id',$booking)->with([
            "Booking",
            "Booking.children",
            "PaymentMethod",
            "Booking.nurseries",
            "Booking.masters",
            'Booking.children.sicknesses',
            'Booking.children.languages',
            'Booking.children.allergies',
            'Booking.children.attachmentable',
        ])->get();



        if ($ConfirmedBooking->isEmpty()) {
            return null;
        }else{
            return $ConfirmedBooking;
        }
    }



}
