<?php

namespace App\Http\Requests\Api\Generals;

use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest
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
            'name.ar' => 'required|string',
            'name.en' => 'required|string',
            'logo' => 'string',
            'status' => 'integer',
            'country_id'      => 'required|exists:countries,id',
        ];
    }
}
