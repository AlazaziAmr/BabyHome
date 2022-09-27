<?php

namespace App\Http\Requests\Api\Nurseries;

use Illuminate\Foundation\Http\FormRequest;

class NurseryRequest extends FormRequest
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


            // personal Info
            'date_of_birth' => 'required|date',
            'years_of_experince' => 'nullable|numeric',
            'national_id' => 'required|max:15|string|unique:babysitter_infos,national_id',
            'qualifications' => 'array',
            'qualifications.*.id' => 'required|exists:qualifications,id',
            'qualifications.*.description' => 'required|string',
            'attachments' => 'nullable|array',
            'attachments.*.file' => 'required|mimes:jpeg,png,jpg,gif,pdf',
            'languages'      => 'required|array',
            'free_of_disease' => 'required|boolean',
            'nationality_id' => 'required|exists:nationalities,id',

            // skills
            'skills' => 'array',
            'skills.*' => 'string',

            'capacity'      => 'required|numeric|max:5',
            'acceptance_age_from'      => 'required|numeric',
            'acceptance_age_to'      => 'required|numeric',
            'national_address'      => 'required|string',
            // 'country_id'      => 'required|exists:countries,id',
            'city_id'      => 'required|exists:cities,id',
            'neighborhood_id'      => 'required|exists:neighborhoods,id',
            'address_description' => 'required|string',
            'latitude' => 'required|between:0,99.99',
            'longitude' => 'required|between:0,99.99',
            'building_type' => 'required|numeric',
            'price' => 'required|between:0,999999999999999.99',

            'days' => 'required|array',
            'days.*.from' => 'required|date_format:H:i',
            'days.*.to' => 'required|date_format:H:i',

            // utilities
            'utilities' => 'array',
            'utilities.*' => 'exists:utilities,id',

            // amenities
            'amenities' => 'array',
            'amenities.*.id' => 'required|exists:amenities,id',
            'amenities.*.attachments.*.file' => 'required|mimes:jpeg,png,jpg,gif,pdf',


            // services
            'services' => 'array',
            'services.*' => 'required|exists:services,id',




            // additional_activities
            'additional_services.*' => 'array',
            'additional_services.*.name.ar' => 'nullable|string',
            'additional_services.*.name.en' => 'nullable|string',
            'additional_services.*.description' => 'nullable|string',
            'additional_services.*.price' => 'nullable|between:0,999999999999.99',
            'additional_services.*.is_paid' => 'nullable|boolean',
            'additional_services.*.type_id'      => 'nullable|exists:nursery_service_types,id',
            'additional_services.*.sub_category_id'      => 'nullable|integer',
            'additional_services.*.attachments.*.file' => 'nullable|mimes:jpeg,png,jpg,gif,pdf',
        ];
    }
}
