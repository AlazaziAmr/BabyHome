<?php

namespace App\Repositories\Interfaces\Api\Nurseries\Profile;

use App\Repositories\Interfaces\IBaseRepository;

interface IBabysitterQulificationRepository extends IBaseRepository
{
    public function babySitterQualifications($id);
}
