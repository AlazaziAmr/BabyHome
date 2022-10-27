<?php

namespace App\Repositories\Interfaces\Api\Nurseries\Profile;

use App\Repositories\Interfaces\IBaseRepository;

interface INurseryServiceRepository extends IBaseRepository
{
    public function delete_attachment($id);
    public function nursery_services();
}
