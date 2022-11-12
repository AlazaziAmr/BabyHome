<?php

namespace App\Repositories\Classes\Api\Users;

use App\Models\User;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Users\IUserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function model()
    {
        return User::class;
    }

    public function register($payload)
    {
        return $this->model->create(
            [

                'name'         => $payload['name'],
                'uid'=> uidn($this->model()),
                'email'        => $payload['email'],
                'phone' => $payload['phone'],
                // 'national_id' => $payload['national_id'],
                'password'     => Hash::make($payload['password']),
                'activation_code'  => $payload['activation_code'],
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
        return User::withTrashed()->when(isset($request['phone']), function ($q) use ($request) {
            $q->where('phone', $request['phone']);
        })->when(isset($request['email']), function ($q)  use ($request) {
            $q->where('email', $request['email']);
        })
            ->update([
                'restore_request' => 1
            ]);
    }
}
