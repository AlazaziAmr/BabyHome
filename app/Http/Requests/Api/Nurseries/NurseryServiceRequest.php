<?php

namespace App\Http\Requests\Api\Nurseries;

use Illuminate\Foundation\Http\FormRequest;

class NurseryServiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'price'  => 'required|between:0,999999999999999.99',
            'is_paid'  => 'required',
            'type_id'  => 'required|exists:nursery_service_types,id',
            'is_active'   => 'required',
            'sub_category_id' => 'required|integer',
            'attachments.*.file' => 'required|mimes:jpeg,png,jpg,gif,pdf',
        ];
    }
}

