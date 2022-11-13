<?php

namespace App\Http\Requests\Api\Master\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RestoreMasterRequest extends FormRequest
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
            'phone' => 'phone_number|exists:masters,phone',
            'email'        => 'email|exists:masters,email',
        ];
    }
}
