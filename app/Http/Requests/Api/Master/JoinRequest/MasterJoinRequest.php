<?php

namespace App\Http\Requests\Api\Master\JoinRequest;

use Illuminate\Foundation\Http\FormRequest;

class MasterJoinRequest extends FormRequest
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
            'nursery_id'      => 'required|exists:nurseries,id',
            'joining_date' => 'required|date',
            'children' => 'required|array',
            'children.*'      => 'required|exists:children,id',
            'activities' => 'required|array',
            'activities.*'      => 'required|exists:activities,id',
            'packages' => 'required|array',
            'packages.*'      => 'required|exists:package_infos,id',
        ];
    }
}
