<?php

namespace App\Http\Requests\Api\Nurseries;

use Illuminate\Foundation\Http\FormRequest;

class LicenseRequest extends FormRequest
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
            'nursery_id' => 'required|numeric',
            'license_no' => 'required|unique:nurseries,license_no',
            'licenses.attachments.*.file' => 'required|mimes:jpeg,png,jpg,pdf',
        ];
    }
}
