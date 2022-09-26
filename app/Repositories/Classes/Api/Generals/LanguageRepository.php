<?php

namespace App\Repositories\Classes\Api\Generals;

use App\Models\Api\Generals\Language;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Generals\ILanguageRepository;


class LanguageRepository extends BaseRepository implements ILanguageRepository
{
    public function model()
    {
        return Language::class;
    }


}
