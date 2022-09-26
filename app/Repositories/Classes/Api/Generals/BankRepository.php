<?php

namespace App\Repositories\Classes\Api\Generals;

use App\Models\Api\Generals\Bank;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Generals\IBankRepository;


class BankRepository extends BaseRepository implements IBankRepository
{
    public function model()
    {
        return Bank::class;
    }


}
