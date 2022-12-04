<?php

namespace App\Http\Requests\Api\Nurseries;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class ActivityRequest extends FormRequest
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

        return [
            'name'      => 'required',
            'description'      => 'required',
            'unit'      => 'required',
            'price'      => 'required',
            'is_paid'      => 'required',
            'is_active'      => 'required',
            'type_id' => 'required',
            'user_id' => 'required',
            'nursery_id' => 'nullable',

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
            'start_time.after_or_equal'=>__('booking.start_time_after_or_equal'),
            'end_time.required'=>__('booking.end_time_required'),
            'end_time.after'=>__('booking.end_time_after'),
            'service_id.array'=>__('booking.service_id_array'),
            'service_id.exists'=>__('booking.service_id_exists'),

        ];
    }
}
