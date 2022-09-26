<?php

namespace App\Http\Requests\Api\Generals;

use Illuminate\Foundation\Http\FormRequest;

class NationalityRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name.ar' => 'required|string',
            'name.en' => 'required|string',
        ];
    }
}
