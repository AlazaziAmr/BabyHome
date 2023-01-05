<?php

namespace App\Http\Requests\Api\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class UserRegistrationRequest extends FormRequest
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
            'password'    => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'phone' => 'required|max:15|phone_number',
//            'email'        => 'required|string|email|max:191',
//            'phone' => 'required|max:15|phone_number|unique:users,phone',
            // 'national_id' => 'required|max:15|string|unique:users,national_id',
        ];
    }

//    protected function failedValidation(Validator $validator)
//    {
//        throw new HttpResponseException(response()->json($validator->errors()),442);
//    }
}
