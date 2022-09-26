<?php

namespace App\Http\Requests\Api\Master\Auth;

use Illuminate\Foundation\Http\FormRequest;

class MasterRegistrationRequest extends FormRequest
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
            'name'         => 'required|string|max:255|min:4',
            'email'        => 'required|string|email|max:191|unique:masters,email',
            'password'    => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'phone' => 'required|max:15|phone_number|unique:masters,phone',
            'national_id' => 'required|max:15|string|unique:masters,national_id',
            'address' => 'required|string',
            'latitude' => 'required|between:0,99.99',
            'longitude' => 'required|between:0,99.99',
        ];
    }
}
