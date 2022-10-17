<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Api\Admin\Admin;
use App\Models\Api\Generals\City;
use App\Models\Api\Master\Child;
use App\Models\Api\Master\Master;
use App\Models\Api\Nurseries\Nursery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function index()
    {
        $data['title'] = __('site.home');
        $data['children'] = Child::count();
        $data['nurseries'] = Nursery::count();
        $data['inspectors'] = Admin::whereHas('roles',function ($query){
            return $query->where('name','inspector');
        })->count();
        $data['cities'] = City::whereIn('id',Nursery::get()->pluck('city_id')->toArray())->get();
        $data['latest_nurseries'] = Nursery::with('owner')->latest()->get()->take(5);
        $data['masters'] = Master::count();
        return view('dashboard.index', compact('data'));

    }

    public function profile()
    {
        $data['title'] = __('site.profile');
        $data['icon'] = __('icons.profile');
        $form_data = auth()->user();
        return view('dashboard.profile.index', compact('data', 'form_data'));

    }

    public function update_profile(Request $request)
    {
        $user = Admin::findOrFail(auth('dashboard')->user()->id);
        $rules = [
            'name' => 'required|string|max:255|min:4',
        ];
        $rules += ['email' => ['required', 'email',
            Rule::unique('admins')->ignore(auth()->user()->id, 'id')
        ], 'phone' => ['required',
            Rule::unique('admins')->ignore(auth()->user()->id, 'id')
        ], 'username' => ['required',
            Rule::unique('admins')->ignore(auth()->user()->id, 'id')
        ]
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 200);
        } else {

            $request_data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'username' => $request->username,
            ];
            $user->update($request_data);
            return response()->json(array('success' => true), 200);
        }
    }

    public function change_password()
    {
        $data['title'] = __('site.change_password');
        $data['icon'] = __('icons.change_password');
        $form_data = auth()->user();
        return view('dashboard.profile.password', compact('data', 'form_data'));
    }

    public function update_password(Request $request)
    {
        $user = Admin::findOrFail(auth('dashboard')->user()->id);
        $rules = [
            'password' => 'required|string|min:6|confirmed',
            'old_password' => 'required|string|min:6',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 200);
        }

        $oldpassword = $request->input('old_password');
        if (!Hash::check($oldpassword, $user->password)) {
            //اذا كانت كلمة المرور الحالية غلط
        }

        $user->password = Hash::make($request['password']);
        $user->save();
        return response()->json(array('success' => true), 200);
    }
}
