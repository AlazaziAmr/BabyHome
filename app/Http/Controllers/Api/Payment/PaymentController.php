<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\Api\Payment\IPaymentRepository;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    private $IPayments;

    public function __construct(IPaymentRepository $IPayment)
    {
        $this->IPayments = $IPayment;
    }
    public function payment(){

        $data=[
            'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
            'InvoiceValue'       => '50',
            'CustomerName'       => 'fname lname',
            'DisplayCurrencyIso' => 'KWD',
            'CustomerEmail'      => 'email@example.com',
            'CallBackUrl'        => 'https://babyhomeadmin.unicomg.com/success-url',
            'ErrorUrl'           => 'https://babyhomeadmin.unicomg.com/error-url',//or example.com/error.php'
            //'MobileCountryCode'  => '+965',
            //'CustomerMobile'     => '1234567890',
            //Fill optional data
            //'Language'           => 'en', //or 'ar'
        //'CustomerReference'  => 'orderId',
        //'CustomerCivilId'    => 'CivilId',
        //'UserDefinedField'   => 'This could be string, number, or array',
        //'ExpiryDate'         => '', //The Invoice expires after 3 days by default. Use 'Y-m-d\TH:i:s' format in the 'Asia/Kuwait' time zone.
        //'SourceInfo'         => 'Pure PHP', //For example: (Symfony, CodeIgniter, Zend Framework, Yii, CakePHP, etc)
        //'CustomerAddress'    => $customerAddress,
        //'InvoiceItems'       => $invoiceItems,
        ];

      return  $this->IPayments->sendPayment($data);


    }
    public function successPayment(Request $request){
        $data=[];
        $data['Key']=$request->paymentId;
        $data['KeyType']='paymentId';

        return $this->IPayments->getPaymentStatus($data);

    }
    public function error(){
        return "jsdnfk";

    }
}
