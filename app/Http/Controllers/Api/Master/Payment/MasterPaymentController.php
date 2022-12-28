<?php

namespace App\Http\Controllers\Api\Master\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Master\Payment\MasterPaymentRequest;
use Illuminate\Http\Request;

class MasterPaymentController extends Controller
{
    //

    public function newPayment(MasterPaymentRequest $request)
    {
        $transactionType = 1;
        if ($request->paymentBrand == 'VISA' || $request->paymentBrand == 'MASTER'){
            return paymentViMs($request->validated());
        }else{
            return paymentMaAp($request->validated());
        }
    }

    public function storedPayment(Request $request)
    {

    }
}
