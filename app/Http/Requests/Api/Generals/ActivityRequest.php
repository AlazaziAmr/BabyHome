<?php

namespace App\Http\Requests\Api\Generals;

use Illuminate\Foundation\Http\FormRequest;

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
            'name.en' => 'required|string',
            'name.ar' => 'required|string',
            'description' => 'required|string',
            'unit' => 'required|string',
            'price' => 'required|between:0,99.99',
            'is_paid' => 'required|boolean',
            'type_id'      => 'required|exists:nursery_service_types,id',
            'attachments.*.description' => 'required|string',
            'attachments.*.file' => 'required|mimes:jpeg,png,jpg,gif,pdf',
        ];
    }
}
