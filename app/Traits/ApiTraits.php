<?php

namespace App\Traits;
trait ApiTraits
{
    public function returnData($data,$msg)
    {
        return response()->json([
            'status'=>true,
            'msg'=>$msg,
            'data'=>$data
        ]);

    }
    public function returnEmpty($msg){
        return response()->json([
            'status'=>false,
            'err'=>'500',
            'msg'=>$msg,
            'data'=>null
        ]);
    }
}
