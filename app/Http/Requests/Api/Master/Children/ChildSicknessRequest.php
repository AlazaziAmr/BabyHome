<?php

namespace App\Http\Requests\Api\Master\Children;

use Illuminate\Foundation\Http\FormRequest;

class ChildSicknessRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'child_id' => 'integer|required|exists:children,id',
            'sickness_name' => 'string|required',
            'sickness_date' => 'date|required',
            'sickness_desc' => 'string|required',
            'sickness_status' => 'integer|required',
        ];
    }
}
