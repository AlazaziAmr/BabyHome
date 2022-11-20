<?php

namespace App\Repositories\Classes\Api\Payment;



use App\Models\Api\Nurseries\JoinRequest\JoinRequest;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Payment\IPaymentRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Request;



class PaymentRepository extends BaseRepository implements IPaymentRepository
{
    private $base_url;
    private $headers;
    private $request_client;


    public function __construct(Client $request_client)
    {
        $this->request_client=$request_client;
        $this->base_url= env('base_url');
        $this->headers=[
            'Content_Type'=>'application/json',
            'Authorization'=>'Bearer ' .env('HyperPay_token')
        ];
    }


    public function buildRequest($url, $method, $data = [])
    {

        $ursl=$this->base_url . $url;
        $request=new Request($method ,$this->base_url . $url, $this->headers);
       /* if(!$data)
            return false;*/
        $response=$this->request_client->send($request,[
            'json'=>$data
        ]);

        if ($response->getStatusCode() !=200){
/*            return false;*/
        }
        $response= json_decode($response->getBody(),true);

        return $response;
    }


    public function sendPayment($data){
        return $requestData= $this->buildRequest('/v2/SendPayment','POST',$data);

    }

    public function getPaymentStatus($data){
        return $requestData= $this->buildRequest('/v2/getPaymentStatus','POST',$data);

    }


    function model()
    {
        // TODO: Implement model() method.
    }
}
