<?php

namespace App\Http\Requests\Api\Admin\Nursery;

use Illuminate\Foundation\Http\FormRequest;

class AssignRequest extends FormRequest
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
            'nursery' => 'required|exists:nurseries,id',
            'admin' => 'required|exists:admins,id',
            'from' => 'required|date_format:Y-m-d H:i',
            'to' => 'required|date_format:Y-m-d H:i',
            'note' => 'nullable|string',

        ];
    }
}
