<?php

namespace App\Http\Requests\Api\Master\Auth;

use Illuminate\Foundation\Http\FormRequest;

class MasterLoginRequest extends FormRequest
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
            'phone' => 'required|max:15|phone_number',
            'password'    => 'required|string|min:6',
        ];
    }
}
