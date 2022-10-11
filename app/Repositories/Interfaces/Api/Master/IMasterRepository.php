<?php

namespace App\Repositories\Interfaces\Api\Master;

use App\Repositories\Interfaces\IBaseRepository;

interface IMasterRepository extends IBaseRepository
{
    public function register($payload);

    public function profile($master_id);

    public function IsAskedToReset($phone, $table = 'password_resets');

    public function updateToReset($attribute, $key, $payload, $table = 'password_resets');

    public function askToReset($payload, $table = 'password_resets');

    public function cleanUp($attribute, $key, $table = 'password_resets');
}
