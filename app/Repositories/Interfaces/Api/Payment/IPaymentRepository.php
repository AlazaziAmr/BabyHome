<?php

namespace App\Repositories\Interfaces\Api\Payment;

use App\Repositories\Interfaces\IBaseRepository;
use Illuminate\Http\Request;

interface IPaymentRepository extends IBaseRepository
{


    public function buildRequest($url,$method,$body=[]);
    public function sendPayment($data);
/*    public function successPayment($data);*/

    public function getPaymentStatus(array $data);


}
