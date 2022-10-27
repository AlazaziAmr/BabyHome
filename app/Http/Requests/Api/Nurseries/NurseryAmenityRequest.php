<?php

namespace App\Http\Requests\Api\Nurseries;

use Illuminate\Foundation\Http\FormRequest;

class NurseryAmenityRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'amenity_id' => 'required|exists:amenities,id',
            'attachments.*.file' => 'required|mimes:jpeg,png,jpg,gif,pdf',
        ];
    }
}

