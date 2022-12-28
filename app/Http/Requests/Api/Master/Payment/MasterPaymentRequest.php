<?php

namespace App\Http\Requests\Api\Master\Payment;

use Illuminate\Foundation\Http\FormRequest;

class MasterPaymentRequest extends FormRequest
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
            //
            "amount" => 'required',
            "paymentBrand" => 'required',
            "cardNumber" => 'required',
            "cardHolder" => 'required',
            "expiryMonth" => 'required|digits:2',
            "expiryYear" => 'required|digits:4',
            "cvv" => 'required|digits:3',
            "master_id" => 'required',
            "email" => 'required',
            "street1" => 'required',
            "city" => 'required',
            "state" => 'required',
            "country" => 'required',
            "postcode" => 'required',
            "givenName" => 'required',
            "surname" => 'required'
        ];
    }
}
