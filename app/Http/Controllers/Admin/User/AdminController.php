<?php

namespace App\Http\Controllers\Admin\User;

use App\DataTables\Admin\User\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Models\Api\Admin\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(AdminDataTable $dataTable){
        $data['title'] = __('site.admins');
        return $dataTable->render('dashboard.users.admins.index',compact('data'));
    }
}
