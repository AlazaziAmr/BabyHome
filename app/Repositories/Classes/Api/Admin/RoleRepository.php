<?php

namespace App\Repositories\Classes\Api\Admin;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Admin\IRoleRepository;

class RoleRepository extends BaseRepository implements IRoleRepository
{
    public function model()
    {
        return Role::class;
    }

    public function fetchPermissions()
    {
        return Permission::get(['id', 'name']);
    }

    public function createRequest($request)
    {
        $role = $this->model->create(['name' => $request['name'], 'guard_name' => 'admin',]);
        $role->syncPermissions($request['permissions']);
    }

    public function updateRequest($request, $role)
    {
        $role->update(['name' => $request['name']]);
        $role->syncPermissions($request['permissions']);
    }
}
