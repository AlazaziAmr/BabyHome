<?php

namespace App\Repositories\Classes\Api\Generals;

use App\Models\Api\Generals\PackagesType;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Generals\IPackagesTypeRepository;


class PackagesTypeRepository extends BaseRepository implements IPackagesTypeRepository
{
    public function model()
    {
        return PackagesType::class;
    }

    public function fetchAllActive()
    {
        return $this->model->where('is_active', 1)->get();
    }
}
