<?php

namespace App\Http\Controllers\Admin\Nursery;

use App\DataTables\Admin\Nursery\NurseryDataTable;
use App\Http\Controllers\Controller;
use App\Mail\NurseryMail;
use App\Models\AdminNotification;
use App\Models\Api\Admin\Admin;
use App\Models\Api\Admin\Inspections\Inspection;
use App\Models\Api\Nurseries\BabysitterInfo;
use App\Models\Api\Nurseries\BabysitterQualification;
use App\Models\Api\Nurseries\BabysitterSkill;
use App\Models\Api\Nurseries\Nursery;
use App\Models\Api\Nurseries\NurseryAmenity;
use App\Models\Api\Nurseries\NurseryService;
use App\Models\Api\Nurseries\NurseryUtility;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class NurseryController extends Controller
{
    public function index(NurseryDataTable $dataTable){
        $data['title'] = __('site.nurseries');
        return $dataTable->render('dashboard.nurseries.nurseries.index',compact('data'));
    }

    public function show($id){
        $data['title'] = __('site.nurseries');
        $data['nursery'] = Nursery::with(['country:id,name', 'city:id,name', 'neighborhood:id,name', 'owner:id,name,phone'])->findOrFail($id);
        $data['babysitter'] = BabysitterInfo::with(['languages','nationalitydata','attachmentable'])
            ->where('nursery_id',$id)
            ->first();

        $data['amenities'] = NurseryAmenity::with(['amenity','attachmentable'])
            ->where('nursery_id',$id)
            ->get();

        $data['utilities'] = NurseryUtility::with(['utility'])->where('nursery_id',$id)
            ->get();

        $data['services'] = NurseryService::with(['service.attachmentable'])->where('nursery_id',$id)
            ->get();

        if($data['babysitter']){
            $data['skills'] = BabysitterSkill::where('babysitter_id',$data['babysitter']->id)
                ->get();
            $data['qualifications'] =BabysitterQualification::with(['qualification'])
                ->where('babysitter_id',$data['babysitter']->id)
                ->get();
        }
        return view('dashboard.nurseries.nurseries.show',compact('data'));
    }
    private function validate_page($request)
    {
        $rules = [
            'nursery_id' => 'required',
            'inspector_id',
            'notes' => 'required',
            'from' => 'required',
            'to' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        return $validator;

    }
    public function inspector_view(Request $request){
        $data['id'] = $request->id;
        $data['inspectors'] = Admin::all();
        $returnHTML = view('dashboard.nurseries.nurseries.partials._edit',compact('data'))->render();
        return $returnHTML;
    }

    public function set_inspector(Request $request){
        $validator = $this->validate_page($request);
        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 200);
        } else {

            $request_data = [
                'nursery_id' => $request->nursery_id,
                'inspector_id' => $request->admin_id,
                'notes' => $request->notes,
                'from' => $request->from,
                'to' => $request->to,
                'status' =>0
            ];

            $ins = Inspection::create($request_data);
            AdminNotification::create([
                'notifiable_type' => 'App\Models\Api\Admin\Admin',
                'notifiable_id' => $request->admin_id,
                'title' => 'set_inspector',
                'description' => 'check_nursery',
                'link' => route('__bh_.inspections.show',$ins->id),
                'mark_as_read' => 0,
                'type' => 1,
            ]);
            $nursery = Nursery::where('id',$request->nursery_id)->update(['status' => 2]);
            return response()->json(array('success' => true), 200);
        }
    }

    public function active($id){
        $nursery = Nursery::findOrFail($id);
        $nursery->update(['status' => 5]);
        $user = User::find($nursery->user_id);
        $data = [
            'name' => $user->name,
            'message' => 'تم قبولك في منصة بيبي هوم.',
            'details' => 'أهلاً بك.'
        ];
//        Mail::to($user->email)->send(new NurseryMail($data));
        return response()->json(array('success' => true), 200);
    }

    public function block($id){
        $nursery = Nursery::findOrFail($id);
        $nursery->update(['status' => 4]);
        $user = User::find($nursery->user_id);
        $data = [
            'name' => $user->name,
            'message' => 'تم رفضكِ في منصة بيبي هوم.',
            'details' => 'سيتم التواصل معكم وتوضيح الأسباب.'
        ];
//        Mail::to($user->email)->send(new NurseryMail($data));
        return response()->json(array('success' => true), 200);
    }
}
