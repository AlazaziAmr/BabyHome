<?php

namespace App\Repositories\Classes\Api\Admin;

use App\Models\Api\Admin\Admin;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Admin\IAdminRepository;
use Illuminate\Support\Facades\Hash;

class AdminRepository extends BaseRepository implements IAdminRepository
{
    public function model()
    {
        return Admin::class;
    }

    public function createRequest($request)
    {
        $admin = $this->model->create([
            'name'     => $request['name'],
            'username'     => $request['username'],
            'email'    => $request['email'] ?? null,
            'phone'    => $request['phone'] ?? null,
            'password' => Hash::make($request['password']),
        ]);
        $admin->assignRole($request['role']);
    }

    public function notifications()
    {
        $notifications['notifications'] = admin()->notificationsWithCount()->get();
        $notifications['count'] = admin()->notifiable()->where('mark_as_read', 0)->count();
        return $notifications;
    }
}
