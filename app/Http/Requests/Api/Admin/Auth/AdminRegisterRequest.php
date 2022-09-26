<?php

namespace App\Http\Requests\Api\Admin\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;

class AdminRegisterRequest extends FormRequest
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
            'name'         => 'required|string|max:255|min:4',
            'username'   => 'required|unique:admins,username',
            'email'        => 'nullable|string|email|max:191|unique:admins,email',
            'password'    => 'required|string|min:6',
            // 'password_confirmation' => 'required',
            'phone' => 'nullable|max:15|phone_number|unique:admins,phone',
            'role' => 'required|exists:roles,id',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new JsonResponse([
            'message' => 'The given data is invalid',
            'errors' => $validator->errors(),
            'status' => 422
        ]);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
