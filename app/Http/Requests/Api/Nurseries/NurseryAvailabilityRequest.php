<?php

namespace App\Http\Requests\Api\Nurseries;

use Illuminate\Foundation\Http\FormRequest;

class NurseryAvailabilityRequest extends FormRequest
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
            //
            'from_hour' => 'required|date_format:H:i',
            'to_hour' => 'required|date_format:H:i',
        ];
    }
}
