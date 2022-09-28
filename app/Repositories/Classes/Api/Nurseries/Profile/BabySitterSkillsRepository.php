<?php

namespace App\Repositories\Classes\Api\Nurseries\Profile;

use App\Models\Api\Nurseries\BabysitterSkill;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Nurseries\Profile\IBabySitterSkillsRepository;

class BabySitterSkillsRepository extends BaseRepository implements IBabySitterSkillsRepository
{
    function model()
    {
        return BabysitterSkill::class;
    }

    public function babySitterSkills($baby_sitter_id)
    {
        return $this->model->where('babysitter_id',$baby_sitter_id)->get();
    }
}
