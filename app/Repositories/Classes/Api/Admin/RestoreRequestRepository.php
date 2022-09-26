<?php

namespace App\Repositories\Classes\Api\Admin;

use App\Models\User;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Admin\IRestoreRequestRepository;

class RestoreRequestRepository extends BaseRepository implements IRestoreRequestRepository
{
    public function model()
    {
        return User::class;
    }

    public function fetchUsers()
    {
        return $this->model->withTrashed()->where('restore_request', 1)->get();
    }
    public function restoreUser($id)
    {
        return $this->model->withTrashed()->where('id', $id)->update([
            'deleted_at' => null,
            'restore_request' => 0,
        ]);
    }
}
