<?php

namespace App\Http\Requests\Api\Inspector;

use Illuminate\Foundation\Http\FormRequest;

class EvaluationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(){
        return [
            'nursery_id' => 'required|exists:nurseries,id',
            'criteria' => 'required',
            'comment' => 'required',
            'rating' => 'required',
            'matching' => 'required',
            'recommendation' =>'required',
            'lat' =>'required',
            'lng' =>'required',
            'attachments' => 'array',
            'attachments.*.file' => 'required|mimes:jpeg,png,jpg,gif',
        ];
    }
}
