<?php

namespace App\Http\Requests\Api\Master\Booking;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       // $time=now()->format('H:i');

        return [
            'nursery_id'      => 'required|exists:nurseries,id',
            'master_id'      => 'required|exists:masters,id',
            'child_id.*'      => 'required|exists:children,id',
            'booking_date'      => 'required|date|after_or_equal:'.now()->format('Y-m-d').'',
            'start_datetime'      => 'required|date|after_or_equal:'.now()->format('Y-m-d').'',
            'end_datetime'      => 'required|date|after_or_equal:start_datetime',
         //   'start_time' => 'required|after_or_equal:'.$time,
            'start_time' => 'required',
            'end_time' => 'required|after_or_equal:start_time',
            'service_id' => 'nullable|array|exists:services',

        ];
    }
    public function messages()
    {
        return [
            'nursery_id.required'=>__('booking.nursery_id_required'),
            'nursery_id.exists'=>__('booking.nursery_id_exists'),
            'child_id.required'=>__('booking.child_id_required'),
            'child_id.array'=>__('booking.child_id_array'),
            'child_id.exists'=>__('booking.child_id_exists'),
            'booking_date.required'=>__('booking.booking_date_required'),
            'booking_date.date'=>__('booking.booking_date_date'),
            'start_time.required'=>__('booking.start_time_required'),
         //   'start_time.after_or_equal'=>__('booking.start_time_after_or_equal'),
            'end_time.required'=>__('booking.end_time_required'),
            'end_time.after_or_equal'=>__('booking.end_time_after'),
            'service_id.array'=>__('booking.service_id_array'),
            'service_id.exists'=>__('booking.service_id_exists'),

        ];
    }
}
