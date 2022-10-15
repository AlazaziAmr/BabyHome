<?php

namespace App\Http\Controllers\Admin\User;

use App\DataTables\Admin\User\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Models\Api\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index(AdminDataTable $dataTable)
    {
        $data['title'] = __('site.admins');
        $data['roles'] = Role::all();
        return $dataTable->render('dashboard.users.admins.index', compact('data'));
    }

    private function validate_page($request, $data)
    {
        $rules = [
            'name' => 'required|string|max:255|min:4',
            // 'password_confirmation' => 'required',
            'role' => 'required|exists:roles,id',

        ];

        if ($data) {
            $rules += ['email' => [ 'required','email',
                Rule::unique('admins')->ignore($data->id, 'id')
            ],'phone' => [ 'required',
                Rule::unique('admins')->ignore($data->id, 'id')
            ],'username' => [ 'required',
                Rule::unique('admins')->ignore($data->id, 'id')
            ]
            ];
        } else {
            $rules += [
                'password' => 'required|string|min:6|confirmed',
                'phone' => 'nullable|max:15|unique:admins,phone',
                'username' => 'required|unique:admins,username',
                'email' => 'nullable|string|email|max:191|unique:admins,email',

            ];
        }

        $validator = Validator::make($request->all(), $rules);

        return $validator;

    }

    public function show($id)
    {
        $form_data = Admin::findOrFail($id);
        return json_encode($form_data);
    }

    public function store(Request $request)
    {
        $validator = $this->validate_page($request);
        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 200);
        } else {

            $request_data = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'is_active' => $request->is_active ? 1 : 0,
                'password' => bcrypt($request->password),
                'fcm_token' => '',
            ];
            $admin = Admin::create($request_data);
            $role = Role::find($request->role);
            $admin->assignRole($role);
            return response()->json(array('success' => true), 200);
        }
    }

    public function edit($id)
    {
        $form_data = Admin::findOrFail($id);
        $data['roles'] = Role::all();
        $returnHTML = view('dashboard.users.admins.partials._edit', compact('form_data', 'data'))->render();
        return $returnHTML;
    }

    public function update($id, Request $request)
    {
        $admin = Admin::findOrFail($request->id);
        $validator = $this->validate_page($request, $admin);
        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 200);
        } else {
            $request_data = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'is_active' => $request->is_active ? 1 : 0,
                'fcm_token' => '',
            ];
            $role = Role::find($request->role);
            $admin->update($request_data);
            $admin->assignRole($role);
            return response()->json(array('success' => true), 200);
        }
    }

    public function remove($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return response()->json(array('success' => true));
    }
}
