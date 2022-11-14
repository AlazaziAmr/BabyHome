<?php

namespace App\Repositories\Classes\Api\Master;

use App\Models\Api\Master\Master;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Master\IMasterRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MasterRepository extends BaseRepository implements IMasterRepository
{
    public function model()
    {
        return Master::class;
    }

    public function profile($master_id){
        return $this->model()->with(['nationality'])->find($master_id);
    }
    public function register($payload)
    {
        return $this->model->create(
            [
                'name'         => $payload['name'],
                'uid' => uid($this->model()),
                'email'        => $payload['email'],
                'phone' => $payload['phone'],
                'national_id' => $payload['national_id'],
                'address' => $payload['address'],
                'latitude' => $payload['latitude'],
                'longitude' => $payload['longitude'],
                'password'     => Hash::make($payload['password']),
                'activation_code'  => $payload['activation_code'],
                'nationality_id'  => $payload['nationality_id'],
                "preferred_language" => "ar",
                'created_at'     => date("Y-m-d h:i:s"),
                'updated_at'     => date("Y-m-d h:i:s"),
            ]
        );
    }

    public function IsAskedToReset($attributes, $table = 'password_resets')
    {
        $record = DB::table($table)->where($attributes)->first();
        return isset($record) ? true : false;
    }

    public function updateToReset($attribute, $key, $payload, $table = 'password_resets')
    {
        DB::table($table)->where($attribute, $key)->update($payload);
    }
    public function askToReset($payload, $table = 'password_resets')
    {
        DB::table($table)->insert($payload);
    }
    public function cleanUp($attribute, $key, $table = 'password_resets')
    {
        DB::table($table)->where($attribute, $key)->delete();
    }
    public function restoreRequest($request)
    {
        $master = Master::withTrashed()->when(isset($request['phone']), function ($q) use ($request) {
            $q->where('phone', $request['phone']);
        })->when(isset($request['email']), function ($q)  use ($request) {
            $q->where('email', $request['email']);
        })->firstOrFail();
        $OTP = OTPGenrator();
        sendOTP($OTP,$master->phone,'');
        $master->restore();
        $master->update(['activation_code'=>$OTP]);
        return $master;
    }
}
