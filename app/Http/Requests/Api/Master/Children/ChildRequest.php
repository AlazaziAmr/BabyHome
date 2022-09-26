<?php

namespace App\Http\Requests\Api\Master\Children;

use Illuminate\Foundation\Http\FormRequest;

class ChildRequest extends FormRequest
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
