<?php

namespace App\Http\Requests\Api\Master\Children;

use Illuminate\Foundation\Http\FormRequest;

class ChildAllergyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'child_id' => 'integer|required|exists:children,id',
            'allergy_name' => 'string|required',
        ];
    }
}

