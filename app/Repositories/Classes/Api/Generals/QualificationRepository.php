<?php

namespace App\Repositories\Classes\Api\Generals;

use App\Models\Api\Generals\Qualification;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Generals\IQualificationRepository;


class QualificationRepository extends BaseRepository implements IQualificationRepository
{
    public function model()
    {
        return Qualification::class;
    }


}
