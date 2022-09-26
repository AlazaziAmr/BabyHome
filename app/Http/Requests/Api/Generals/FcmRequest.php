<?php

namespace App\Http\Requests\Api\Generals;

use Illuminate\Foundation\Http\FormRequest;

class FcmRequest extends FormRequest
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
            'type' => 'required|string|in:user,master,admin',
            'fcm_token' => 'string',
        ];
    }
}
