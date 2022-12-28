<?php

namespace App\Http\Resources\Api\Nurseries;

use App\Http\Resources\Api\Generals\LanguageResource;
use App\Http\Resources\Api\Generals\NameResource;
use App\Http\Resources\Api\Generals\NationalityResource;
use App\Models\Api\Master\BookingServices\Booking;
use App\Models\Api\Master\BookingServices\ConfirmedBooking;
use App\Models\Api\Nurseries\Nursery;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class BookingActivityTodayResource extends JsonResource
{
    public function toArray($attended)
    {

        $children = array();
        $images = array();
        $details = array();
        $nursery = Nursery::where('user_id',user()->id)->first();
        $dateToday= now()->format('Y:m:d');
        $booking= Booking::where('status_id',2)->where('nursery_id',$nursery->id)
            ->where('booking_date',$dateToday)
            ->pluck('id')->toArray();
        $ConfirmedBooking= ConfirmedBooking::whereIn('booking_id',$booking)->where('nursery_id',$nursery->id)
            ->where('status',2)
            ->pluck('booking_id')->toArray();

        foreach($this->booking_service()->whereIn('booking_id',$ConfirmedBooking)->get() as $k => $kids){
            $details[$k]['id'] = $kids->id;
            $details[$k]['service_id'] = $kids->service_id;
            $details[$k]['booking_id'] = $kids->booking_id;
            $details[$k]['child_id'] = $kids->child_id;
            $details[$k]['status'] = $kids->status;
            $details[$k]['notes'] = $kids->notes;
            $details[$k]['complete'] = $kids->complete;
            foreach($kids->childrens()->get() as $kid) {
                $children[$k]['id'] = $kid->id;
                $children[$k]['name'] = $kid->name;
                $children[$k]['image'] = config('app.url').'/storage/children/'.$kid->attachmentable()->first()->path;
            }
        }

        $data = [
            'activity' => [
                'id'=>$this->id,
                'booking_service_details' => $details,
                'name'=>$this->name,
                'description'=>$this->description,
                'is_paid'=>$this->is_paid,
                'is_active'=>$this->is_active,
                'image' => $this->mainAttachment,
                'child' => $children,
            ],
        ];

       /* $data['child']=[
            $this->children->service_id->id
        ];*/

        return $data;
    }
}
