<?php

namespace App\Http\Requests\Api\Master\Children;

use Illuminate\Foundation\Http\FormRequest;

class ChildRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            return [
                'name' => 'required|string',
                'gender_id'      => 'required|exists:genders,id',
                'relation_id'      => 'required|exists:relations,id',
                'date_of_birth' => 'required|date',
                'description' => 'required|string',
                'has_disability' => 'required|boolean',
                'languages' => 'required|array',
                'languages.*'      => 'required|exists:languages,id',
                'phones' => 'required|array',
                'phones.*'      => 'required|phone_number',
                'allergies'      => 'array|nullable',
                'allergies.*'      => 'string|nullable',
                'sicknesses'      => 'array|nullable',
                'sicknesses.*.sickness_name' => 'string|nullable',
                'sicknesses.*.sickness_date' => 'date|nullable',
                'sicknesses.*.sickness_status' => 'integer|nullable',
                'attachments' => 'array',
                'attachments.*.file' => 'required|mimes:jpeg,png,jpg,gif',
            ];
        }else{
            return [
                'name' => 'required|string',
                'gender_id'      => 'required|exists:genders,id',
                'relation_id'      => 'required|exists:relations,id',
                'date_of_birth' => 'required|date',
                'description' => 'required|string',
                'has_disability' => 'required|boolean',
                'languages' => 'required|array',
                'languages.*'      => 'required|exists:languages,id',
                'phones' => 'required|array',
                'phones.*'      => 'required|phone_number',
                'attachments' => 'array',
                'attachments.*.file' => 'required|mimes:jpeg,png,jpg,gif',
            ];
        }
    }
}
