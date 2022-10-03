<?php

namespace App\Http\Requests\Api\Admin\Inspections;

use Illuminate\Foundation\Http\FormRequest;

class AdminInspectionResultRequest extends FormRequest
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
            'inspection_id' => 'required|exists:inspections,id',
            'nursery_id' => 'required|exists:nurseries,id',
            'latitude' => 'nullable|numeric|gt:0|between:0,99.99',
            'longitude' => 'nullable|numeric|gt:0|between:0,99.99',

            'result' => 'required|array',

            'result.babySetter.rating' => 'required|numeric',
            'result.babySetter.matching' => 'required|numeric',
            'result.babySetter.recommendation' => 'required|numeric',
            'result.babySetter.comment' => 'required|string',

            'result.nurseryInfo.rating' => 'required|numeric',
            'result.nurseryInfo.matching' => 'required|numeric',
            'result.nurseryInfo.recommendation' => 'required|numeric',
            'result.nurseryInfo.comment' => 'required|string',

            'result.utilities.rating' => 'required|numeric',
            'result.utilities.matching' => 'required|numeric',
            'result.utilities.recommendation' => 'required|numeric',
            'result.utilities.comment' => 'required|string',

            'result.amenities.rating' => 'required|numeric',
            'result.amenities.matching' => 'required|numeric',
            'result.amenities.recommendation' => 'required|numeric',
            'result.amenities.comment' => 'required|string',

            'result.services.rating' => 'required|numeric',
            'result.services.matching' => 'required|numeric',
            'result.services.recommendation' => 'required|numeric',
            'result.services.comment' => 'required|string',

            'attachments' => 'array',
            'attachments.*.file' => 'mimes:jpeg,png,jpg,gif',
        ];
    }
}
