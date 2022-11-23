<?php

namespace App\Repositories\Classes\Api\Generals;

use App\Models\Api\Generals\Relative;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Generals\IRelationRepository;


class RelationRepository extends BaseRepository implements IRelationRepository
{
    public function model()
    {
        return Relative::class;
    }


}
