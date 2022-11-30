<?php

namespace App\Http\Requests\Api\Master\Children;

use Illuminate\Foundation\Http\FormRequest;

class ChildPhoneRequest extends FormRequest
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
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            return [
                'child_id' => 'required|numeric',
                'phones' => 'required|array',
                'phones.*.value' => 'required|phone_number',
                'phones.*.name' => 'string|nullable',
                'phones.*.relation_id' => 'required|exists:relations,id',
            ];
        }else{
            return [
                'phones' => 'required|array',
                'phones.*.value' => 'required|phone_number',
                'phones.*.name' => 'string|nullable',
                'phones.*.relation_id' => 'required|exists:relations,id',
            ];
        }
    }
}
